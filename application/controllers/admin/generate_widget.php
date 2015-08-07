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
        $this->load->model('admin/authorization_model');
        $this->load->library('session');
        $this->load->helper('work_helper');
    }

    public function add_widget($id_widget = 0) {
        if (!$this->authorization_model->check_auth()) {
            redirect('/admin/authorization/login', 'refresh');
        }

        if ($id_widget == 0) {
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

            $check_exist_site = $this->generate_widget_model->check_exist_site($this->input->post('site_url'), $id_widget);

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
                } elseif (isset($data_post['default_img']) == '' && $data_post['img_map_from_db'] != '' && $data_post['img_marker_from_db'] != '') {
                    $final_data['new_img_marker'] = $data_post['img_marker_from_db'];
                    $final_data['new_img_map'] = $data_post['img_map_from_db'];
                } else {
                    $final_data['new_img_marker'] = self::DEFAULT_IMG_MARKER;
                    $final_data['new_img_map'] = self::DEFAULT_IMG_MAP;
                }

                if (isset($final_data['new_img_marker']) && isset($final_data['new_img_map'])) {

                    $id_user = $this->session->userdata('id_user');

                    if ($id_widget == 0) {
                        $insert_result = $this->generate_widget_model->save_new_widget($final_data, $id_user);

                        if ($insert_result == 'error_insert') {
                            $data['errors'][] = 'Произошла ошибка при сохранении виджета';
                            $data['data_widget'] = $data_post;
                        } else {
                            if (!$this->generate_widget($insert_result)) {
                                $data['errors'][] = 'Произошла ошибка при сохранении виджета';
                                $data['data_widget'] = $data_post;
                            } else {
                                redirect('/admin/generate_widget/add_widget_success', 'refresh');
                            }
                        }
                    } else {
                        $update_result = $this->generate_widget_model->update_widget($final_data, $id_widget, $id_user);

                        if ($update_result == 'error_update') {
                            $data['errors'][] = 'Произошла ошибка при сохранении виджета';
                            $data['data_widget'] = $data_post;
                        } else {
                            if (!$this->generate_widget($id_widget)) {
                                $data['errors'][] = 'Произошла ошибка при сохранении виджета';
                                $data['data_widget'] = $data_post;
                            } else {
                                redirect('/admin/generate_widget/add_widget_success', 'refresh');
                            }
                        }
                    }
                } else {
                    $data['errors'][] = 'Произошла ошибка при сохранении виджета';
                    $data['data_widget'] = $data_post;
                }
            }
        } elseif ($id_widget != 0) {
            $data['data_widget']['id_widget'] = $id_widget;
            $data['data_widget'] = $this->generate_widget_model->get_data_widget($id_widget);

            $data['data_widget']['img_marker_from_db'] = $data['data_widget']['img_marker'];
            $data['data_widget']['img_map_from_db'] = $data['data_widget']['img_map'];

            if ($data['data_widget']['img_marker'] == self::DEFAULT_IMG_MARKER && $data['data_widget']['img_map'] == self::DEFAULT_IMG_MAP) {
                $data['data_widget']['type_img_from_db'] = 'default';
            } else {
                $data['data_widget']['type_img_from_db'] = 'new';
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/generate_widget/add_widget', $data);
        $this->load->view('templates/footer');
    }

    public function add_widget_success() {
        if (!$this->authorization_model->check_auth()) {
            redirect('/admin/authorization/login', 'refresh');
        }

        $data['title'] = 'Виджет добавлен!';

        $this->load->view('templates/header', $data);
        $this->load->view('admin/generate_widget/add_widget_success');
        $this->load->view('templates/footer');
    }

    public function widgets() {
        if (!$this->authorization_model->check_auth()) {
            redirect('/admin/authorization/login', 'refresh');
        }

        $data['title'] = 'Список виджетов';

        if ($this->input->post()) {
            $search_data = $this->input->post();

            $data['search_data'] = $search_data;

            $data['all_widgets'] = $this->generate_widget_model->get_all_widgets($search_data);
        } else {
            $data['all_widgets'] = $this->generate_widget_model->get_all_widgets();
        }

        $data['other_js'] = array('js/jquery.ba-throttle-debounce.min.js',
            'js/jquery.stickyheader.js',
            'js/script.js');

        $this->load->view('templates/header', $data);
        $this->load->view('admin/generate_widget/widgets', $data);
        $this->load->view('templates/footer');
    }

    public function delete_widget() {
        if (!$this->authorization_model->check_auth()) {
            redirect('/p404', 'refresh');
        }

        $this->load->helper('file');

        $id = $this->input->post('id');

        $img_window = $this->generate_widget_model->get_img_window_for_widget($id);

        $del_status = $this->generate_widget_model->delete_widget($id);

        if ($del_status == 'del_ok') {
            if ($img_window['img_marker'] != self::DEFAULT_IMG_MARKER && $img_window['img_map'] != self::DEFAULT_IMG_MAP) {
                @unlink("uploads/img_attention_window/" . $img_window['img_marker']);
                @unlink("uploads/img_attention_window/" . $img_window['img_map']);
            }

            @unlink("widgets/widget_" . md5($id) . ".js");
        }
    }

    public function install_widget($id) {
        if (!$this->authorization_model->check_auth()) {
            redirect('/p404', 'refresh');
        }

        $data = $this->generate_widget_model->get_site_url_code_widget_by_id($id);

        if (empty($data)) {
            redirect('/p404', 'refresh');
        }

        $data['id'] = md5($id);

        $data['title'] = 'Установка виджета';

        $this->load->view('templates/header', $data);
        $this->load->view('admin/generate_widget/install_widget', $data);
        $this->load->view('templates/footer');
    }

    public function installation_check() {
        if (!$this->authorization_model->check_auth()) {
            redirect('/p404', 'refresh');
        }

        $id = $this->input->post('id');

        $data = $this->generate_widget_model->get_site_url_code_widget_by_id($id);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $data['site_url']);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);

        $curl_data = curl_exec($ch);

        preg_match('/var conversioner_code="' . $data['code_widget'] . '"/si', $curl_data, $result);

        if (!empty($result)) {
            $this->generate_widget_model->update_field_is_installed($id, 1);

            echo 'installed';
            exit;
        } else {
            $this->generate_widget_model->update_field_is_installed($id, 0);

            echo 'not installed';
            exit;
        }
    }

    public function change_active_widget() {
        if (!$this->authorization_model->check_auth()) {
            redirect('/p404', 'refresh');
        }

        $id = $this->input->post('id');
        $active_status = $this->input->post('active_status');

        $this->generate_widget_model->update_field_is_active($id, $active_status);

        if ($this->generate_widget($id)) {
            echo "ok";
            exit;
        }
    }

    private function generate_widget($id_widget = 0) {
        $this->load->helper('file');
        $this->load->library('zip');

        $data = $this->generate_widget_model->generate_widget_body($id_widget);

        if (write_file('widgets/widget_' . md5($id_widget) . '.js', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function sms_history_list() {
        if (!$this->authorization_model->check_auth()) {
            redirect('/admin/authorization/login', 'refresh');
        }

        $data['title'] = 'Собранные контакты';
        $data['other_js'] = array('js/jquery.ba-throttle-debounce.min.js', 'js/jquery.stickyheader.js', 'js/jquery-ui.js', 'js/script.js', 'js/sms_history.js');
        $data['other_css'] = array('css/jquery-ui.css');

        if ($this->input->post()) {
            $search_data = $this->input->post();

            $data['search_data'] = $search_data;

            $data['sms_history_list'] = $this->generate_widget_model->get_sms_history($search_data);
        } else {
            $data['sms_history_list'] = $this->generate_widget_model->get_sms_history();
        }

        $data['all_sites'] = $this->generate_widget_model->get_all_sites_from_history();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/generate_widget/sms_history_list', $data);
        $this->load->view('templates/footer');
    }

}

?>