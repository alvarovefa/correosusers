<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistorialC extends CI_Controller {

    function __construct() {
        parent::__construct();
            $this->load->helper('date');
            $this->load->model('HistorialM');
            if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }

 public function index(){

        $data['regs'] = $this->HistorialM->lista();
        $this->load->view('historialV', $data);
     }

    }
