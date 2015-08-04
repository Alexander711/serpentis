<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authorization extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/authorization_model');
        $this->load->library('session');
    }

    public function login() {
        if ($this->authorization_model->check_auth()) {
            redirect('/admin/generate_window/widgets', 'refresh');
        }

        $data['title'] = 'Авторизация';

        $data['other_js'] = array('js/script.js');

        if ($_POST) {
            $error_mass = '';

            if ($this->input->post('email_user') == '') {
                $error_mass .= 'Заполните поле "Email"</span><br/>';
            }

            if ($this->input->post('pass') == '') {
                $error_mass .= '<span>Заполните поле "Пароль"</span><br/>';
            }

            if (mb_strlen($this->input->post('pass')) < 6 && $this->input->post('pass') != '') {
                $error_mass .= '<span>Длина поля "Пароль" должна быть не меньше 6 символов</span><br/>';
            }

            if ($error_mass == '') {
                $user_data = $this->authorization_model->check_user($this->input->post());

                if (!empty($user_data)) {
                    $data_session = array(
                        'id_user' => (int) $user_data['id'],
                        'name' => $user_data['name'],
                        'last_name' => $user_data['last_name'],
                        'email' => $user_data['email'],
                        'pass' => $user_data['pass'],
                        'phone' => $user_data['phone'],
                    );

                    $this->session->set_userdata($data_session);

                    echo 'ok';
                    exit;
                } else {
                    echo '<span>Введен неправильный логин или пароль!<span>';
                    exit;
                }
            } else {
                echo $error_mass;
                exit;
            }
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('/admin/authorization/login', $data);
            $this->load->view('templates/footer');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/admin/authorization/login', 'refresh');
    }

    public function edit_user_data() {
        if (!$this->authorization_model->check_auth()) {
            redirect('/admin/authorization/login', 'refresh');
        }
        
        $id_user = $this->session->userdata('id_user');

        if ($this->input->post()) {
            $error_mass = '';

            if ($this->input->post('name') == '') {
                $error_mass .= '<span>Заполните поле "Имя"</span><br/>';
            }

            if ($this->input->post('last_name') == '') {
                $error_mass .= '<span>Заполните поле "Фамилия"</span><br/>';
            }

            if ($this->input->post('email_user') == '') {
                $error_mass .= '<span>Заполните поле "Email"</span><br/>';
            }

            if (mb_strlen($this->input->post('pass')) < 6 && $this->input->post('pass') != '') {
                $error_mass .= '<span>Длина поля "Пароль" должна быть не меньше 6 символов</span><br/>';
            }

            if ($this->input->post('pass') != $this->input->post('confirm_pass')) {
                $error_mass .= '<span>Поля "Пароль" и "Подтвердить пароль" должны совпадать</span><br/>';
            }

            if ($this->input->post('phone') == '') {
                $error_mass .= '<span>Заполните поле "Телефон"</span><br/>';
            }

            if (mb_strlen($this->input->post('phone')) < 11 && $this->input->post('phone') != '') {
                $error_mass .= '<span>Длина поля "Телефон" должна быть не меньше 11 символов</span><br/>';
            }

            $email_exist = $this->authorization_model->check_email_exist($this->input->post('email_user'));

            if (!empty($email_exist) && $this->session->userdata('email') != $this->input->post('email_user')) {
                $error_mass .= '<span>Такой email уже зарегистрирован</span><br/>';
            }

            if ($error_mass == '') {
                $post_data = $this->input->post();

                $update_result = $this->authorization_model->update_user_data($id_user, $post_data);

                if ($update_result) {
                    $data_session = array(
                        'name' => strip_tags($post_data['name']),
                        'last_name' => strip_tags($post_data['last_name']),
                        'email' => strip_tags($post_data['email_user']),
                        'phone' => strip_tags($post_data['phone']),
                    );

                    $data_ajax = $data_session;

                    if ($post_data['pass'] != '') {
                        $data_session['pass'] = md5($post_data['pass']);
                    } else {
                        $data_session['pass'] = $this->session->userdata('pass');
                    }

                    $this->session->set_userdata($data_session);

                    $data_ajax['status_ajax'] = 'ok';

                    print_r(json_encode($data_ajax));
                    exit;
                } else {
                    $data_ajax['status_ajax'] = 'error';
                    $data_ajax['error_mass'] = '<span>Произошла ошибка, попробуйте позже!</span><br/>';;

                    print_r(json_encode($data_ajax));
                    exit;
                }
            } else {
                $data_ajax['status_ajax'] = 'error';
                $data_ajax['error_mass'] = $error_mass;

                print_r(json_encode($data_ajax));
                exit;
            }
        }

        $data['title'] = 'Редактирование профиля';

        $data['other_js'] = array('js/script.js');

        $data['data_user'] = $this->authorization_model->get_data_user_by_id($id_user);

        $this->load->view('templates/header', $data);
        $this->load->view('/admin/authorization/edit_user_data', $data);
        $this->load->view('templates/footer');
    }

}

?>