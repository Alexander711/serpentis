<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate_widget extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('generate_widget_model');
        //$this->load->helper('work_helper');
    }

    public function add_widget() {
        $data['title'] = 'Создать новый виджет';

        $data['other_js'] = array('js/script.js');
        
        if($this->input->post()) {
            print_r($this->input->post());exit;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/generate_widget/add_widget', $data);
        $this->load->view('templates/footer');
    }

}

?>