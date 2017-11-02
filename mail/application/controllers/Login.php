<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Login_model');
	}

    //tomo datos de la vista, los envío al modelo
	function ingresar(){
		$email = $this->input->post("email");
		$password = sha1($this->input->post("password"));
		
		$resp = $this->Login_model->login($email, $password);
		
		//defino datos de sesion
		
		if ($resp) {
			$data = [
			"id" => $resp->id_usuario,
			"tipo" => $resp->id_tipo_usuario,
			"name" => $resp->nombres,
			"login" => TRUE
			];
		$this->session->set_userdata($data);
		}else{
			echo "error";
		}
	}

    //cierro sesión
	public function cerrar(){
		$this->session->sess_destroy();
	}
}