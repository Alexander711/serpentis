<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Widget_window extends CI_Controller {

    /**
     * Функция генерирует всплывающее окно для виджета
     */
    public function index($code) {
        $this->load->model('/admin/generate_widget_model');

        $data = $this->generate_widget_model->get_data_widget_by_code($code);

        if (isset($data['html_priv_transport'])) {
            $data['who_first'] = 'priv_transport';
        }

        if (!isset($data['html_priv_transport']) && isset($data['html_pub_transport'])) {
            $data['who_first'] = 'pub_transport';
        }

        if (!isset($data['html_priv_transport']) && !isset($data['html_pub_transport']) && isset($data['html_taxi'])) {
            $data['who_first'] = 'taxi';
        }

        if (!isset($data['html_priv_transport']) && !isset($data['html_pub_transport']) && !isset($data['html_taxi']) && isset($data['html_rent_car'])) {
            $data['who_first'] = 'rent_car';
        }

        $this->load->view('widget_window/widget_window', $data);
    }
    
    public function order_taxi() {
        $this->load->library('transport');
        $this->load->model('/admin/generate_widget_model');
        $this->load->model('/admin/authorization_model');
        $this->load->library('email');
        $this->load->helper('cookie');

        if (get_cookie('send_message_taxi_completed')) {
            echo 'error_time';
            exit;
        }

        $phone_client = $this->input->post('serpentis_number_phone_taxi');

        if ($phone_client == '') {
            echo 'empty_data_input';
            exit;
        }

        if($this->input->post('email') != '') {
            echo 'incorrect_phone';
            exit;
        }

        if($this->input->post('phone') != '') {
            echo 'incorrect_phone';
            exit;
        }

        preg_match('/^((\d|\+\d)[\- ]?)(\(?\d{3}\)?[\- ]?)[\d]{3}[\- ]?[\d]{2}[\- ]?[\d]{2}$/i', $phone_client, $result);

        if (empty($result)) {
            echo 'incorrect_phone';
            exit;
        }

        $code = $this->input->post('serpentis_code');

        if ($code == '') {
            echo 'empty_data_input';
            exit;
        }

        $data = $this->generate_widget_model->get_site_url_data_user_by_code($code);

        $params = array(
            "text" => "Клиент с веб-сайта " . $data['site_url'] . " хочет заказать такси. Перезвоните по номеру " . $phone_client,
            "source" => "Serpentis",
        );

        $phone_user = array($data['phone']);
        $send = $this->transport->send($params, $phone_user);

        $sms_send_status = $send['code'];

        $message = "Клиент с веб-сайта " . $data['site_url'] . " хочет заказать такси. Перезвоните по номеру " . $phone_client;

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.yandex.ru',
            'smtp_port' => '465',
            'smtp_user' => 'widget@conversioner.ru',
            'smtp_pass' => '7O3j5A7o',
            'smtp_timeout' => '5',
            'mailtype' => 'text',
            'starttls' => true,
            'newline' => "\r\n",
            'priority' => '1'
        );

        $this->email->initialize($config);

        $this->email->from('widget@conversioner.ru', 'Serpentis');
        $this->email->to($data['email']);

        $this->email->subject('Пришла заявка на такси');
        $this->email->message($message);

        if($this->email->send()) {
            $email_send_status = 1;
        }

        $data_sms_history = array(
            'phone_contact' => mysql_real_escape_string(strip_tags($phone_client)),
            'status' => $sms_send_status,
            'type' => 'taxi',
            'site_url' => mysql_real_escape_string($data['site_url']),
            'id_user' => mysql_real_escape_string($data['id_user']),
        );

        $this->generate_widget_model->save_sms_history($data_sms_history);

        if ($sms_send_status == 1 or $email_send_status == 1) {
            $this->input->set_cookie("send_message_taxi_completed", "1", 120);
            
            echo 'ok';
            exit;
        } else {
            echo 'send_error';
            exit;
        }
    }

    public function rent_car() {
        $this->load->library('transport');
        $this->load->model('/admin/generate_widget_model');
        $this->load->model('/admin/authorization_model');
        $this->load->library('email');
        $this->load->helper('cookie');

        if (get_cookie('send_message_rent_car_completed')) {
            echo 'error_time';
            exit;
        }

        $phone_client = $this->input->post('serpentis_number_phone_rent_car');

        if ($phone_client == '') {
            echo 'empty_data_input';
            exit;
        }

        if($this->input->post('email') != '') {
            echo 'incorrect_phone';
            exit;
        }

        if($this->input->post('phone') != '') {
            echo 'incorrect_phone';
            exit;
        }

        preg_match('/^((\d|\+\d)[\- ]?)(\(?\d{3}\)?[\- ]?)[\d]{3}[\- ]?[\d]{2}[\- ]?[\d]{2}$/i', $phone_client, $result);

        if (empty($result)) {
            echo 'incorrect_phone';
            exit;
        }

        $code = $this->input->post('serpentis_code');

        if ($code == '') {
            echo 'empty_data_input';
            exit;
        }

        $data = $this->generate_widget_model->get_site_url_data_user_by_code($code);

        $params = array(
            "text" => "Клиент с веб-сайта " . $data['site_url'] . " хочет заказать автомобиль. Перезвоните по номеру " . $phone_client,
            "source" => "Serpentis",
        );

        $phone_user = array($data['phone']);
        $send = $this->transport->send($params, $phone_user);

        $sms_send_status = $send['code'];

        $message = "Клиент с веб-сайта " . $data['site_url'] . " хочет заказать автомобиль. Перезвоните по номеру " . $phone_client;

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.yandex.ru',
            'smtp_port' => '465',
            'smtp_user' => 'widget@conversioner.ru',
            'smtp_pass' => '7O3j5A7o',
            'smtp_timeout' => '5',
            'mailtype' => 'text',
            'starttls' => true,
            'newline' => "\r\n",
            'priority' => '1'
        );

        $this->email->initialize($config);

        $this->email->from('widget@conversioner.ru', 'Serpentis');
        $this->email->to($data['email']);

        $this->email->subject('Пришла заявка на заказ автомобиля');
        $this->email->message($message);

        if($this->email->send()) {
            $email_send_status = 1;
        }

        $data_sms_history = array(
            'phone_contact' => mysql_real_escape_string(strip_tags($phone_client)),
            'status' => $sms_send_status,
            'type' => 'rent_car',
            'site_url' => mysql_real_escape_string($data['site_url']),
            'id_user' => mysql_real_escape_string($data['id_user']),
        );

        $this->generate_widget_model->save_sms_history($data_sms_history);

        if ($sms_send_status == 1 or $email_send_status == 1) {
            $this->input->set_cookie("send_message_rent_car_completed", "1", 120);
            
            echo 'ok';
            exit;
        } else {
            echo 'send_error';
            exit;
        }
    }
}
