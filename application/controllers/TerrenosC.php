<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TerrenosC extends CI_Controller {

    function __construct() {
        parent::__construct();  
            $this->load->model('TerrenosM');
            if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }

 public function index(){

        $data['regs'] = $this->TerrenosM->lista();
        $this->load->view('terrenosV', $data);
     }
 
    }