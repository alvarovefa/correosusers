<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Controller {

    function __construct() {
      parent::__construct();

      $this->load->model('ImageM');  
    }

	public function index()
	{

		$id = $this->session->userdata('id');
		$firma['img'] = $this->ImageM->mostrar($id);

		$this->load->view('imageV',$firma);

	}


}