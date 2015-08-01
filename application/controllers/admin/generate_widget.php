<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate_widget extends CI_Controller {

    const UPLOAD_PATH = './uploads/img_attention_window';
    const ALLOWED_TYPES = 'jpg|png';
    const DEFAULT_IMG_MARKER = 'img_marker.png';
    const DEFAULT_IMG_MAP = 'img_map.png';

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/generate_widget_model');
        $this->load->helper('work_helper');
    }

    public function add_widget($id_site = 0) {
        if ($id_site == 0) {
            $data['title'] = 'Создать новый виджет';
        } else {
            $data['title'] = 'Редактирование виджета';
        }

        $data['other_js'] = array('js/script.js');

        if ($this->input->post()) {
            if ($this->input->post('site_url') == '') {
                $data['errors'][] = 'Заполните поле "Ссылка на сайт"';
            }

            if ($this->input->post('turn_on_priv_transport')) {
                if ($this->input->post('html_priv_transport') == '') {
                    $data['errors'][] = 'Введите HTML код для раздела "Добраться на авто"';
                }
            }

            if ($this->input->post('turn_on_pub_transport')) {
                if ($this->input->post('html_pub_transport') == '') {
                    $data['errors'][] = 'Введите HTML код для раздела "Добраться на общественном транспорте"';
                }
            }

            if ($this->input->post('turn_on_taxi')) {
                if ($this->input->post('html_taxi') == '') {
                    $data['errors'][] = 'Введите HTML код для раздела "Заказать такси"';
                }
            }

            if ($this->input->post('turn_on_rent_car')) {
                if ($this->input->post('html_rent_car') == '') {
                    $data['errors'][] = 'Введите HTML код для раздела "Аренда автомобиля"';
                }
            }

            if (!$this->input->post('default_img') && $this->input->post('img_map_from_db') == '' && $this->input->post('img_marker_from_db') == '') {
                if ($_FILES['new_img_marker']['name'] == '') {
                    $data['errors'][] = 'Выберите картинку маркера для виджета';
                }

                if ($_FILES['new_img_map']['name'] == '') {
                    $data['errors'][] = 'Выберите картинку карты для виджета';
                }
            }

            $check_exist_site = $this->generate_widget_model->check_exist_site($this->input->post('site_url'), $id_site);

            if ($check_exist_site) {
                $data['errors'][] = 'Виджет для данного сайта уже существует';
            }

            if (isset($data['errors'])) {
                $data['data_widget'] = $this->input->post();
            } else {
                $data_post = $this->input->post();

                $final_data = $data_post;

                if (!isset($data_post['default_img']) && $data_post['img_map_from_db'] == '' && $data_post['img_marker_from_db'] == '') {
                    $config['upload_path'] = self::UPLOAD_PATH;
                    $config['allowed_types'] = self::ALLOWED_TYPES;
                    $config['encrypt_name'] = TRUE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    $this->upload->do_upload('new_img_marker');

                    $data_upload_img = $this->upload->data();

                    $final_data['new_img_marker'] = $data_upload_img['file_name'];

                    $this->upload->do_upload('new_img_map');

                    $data_upload_img = $this->upload->data();

                    $final_data['new_img_map'] = $data_upload_img['file_name'];
                } elseif (!isset($data_post['default_img']) && $data_post['img_map_from_db'] != '' && $data_post['img_marker_from_db'] != '') {
                    $final_data['new_img_marker'] = $data_post['img_marker_from_db'];
                    $final_data['new_img_map'] = $data_post['img_map_from_db'];
                } else {
                    $final_data['new_img_marker'] = self::DEFAULT_IMG_MARKER;
                    $final_data['new_img_map'] = self::DEFAULT_IMG_MAP;
                }

                if (isset($final_data['new_img_marker']) && isset($final_data['new_img_map'])) {

                    if ($id_site == 0) {
                        $insert_result = $this->generate_widget_model->save_new_widget($final_data);

                        if ($insert_result == 'error_insert') {
                            $data['errors'][] = 'Произошла ошибка при сохранении виджета';
                            $data['data_widget'] = $data_post;
                        } else {
                            redirect('/admin/generate_widget/add_widget_success', 'refresh');
                        }
                    } else {
                        $update_result = $this->generate_widget_model->update_widget($final_data,$id_site);

                        if ($update_result == 'error_update') {
                            $data['errors'][] = 'Произошла ошибка при сохранении виджета';
                            $data['data_widget'] = $data_post;
                        } else {
                            redirect('/admin/generate_widget/add_widget_success', 'refresh');
                        }
                    }
                } else {
                    $data['errors'][] = 'Произошла ошибка при сохранении виджета';
                    $data['data_widget'] = $data_post;
                }
            }
        } elseif ($id_site != 0) {
            $data['data_widget']['id_site'] = $id_site;
            $data['data_widget'] = $this->generate_widget_model->get_data_widget($id_site);

            $data['data_widget']['img_marker_from_db'] = $data['data_widget']['img_marker'];
            $data['data_widget']['img_map_from_db'] = $data['data_widget']['img_map'];

            if ($data['data_widget']['img_marker'] == self::DEFAULT_IMG_MARKER && $data['data_widget']['img_map'] == self::DEFAULT_IMG_MAP) {
                $data['data_widget']['default_img'] = 1;
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/generate_widget/add_widget', $data);
        $this->load->view('templates/footer');
    }

    public function add_widget_success() {
        $data['title'] = 'Виджет добавлен!';
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/generate_widget/add_widget_success');
        $this->load->view('templates/footer');
    }
}

?>