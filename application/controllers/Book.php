<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

	 public function __construct()
	 	{
	 		parent::__construct();
			$this->load->helper('url');
	 		$this->load->model('Book_model');
	 		$this->load->model('CategoriasM');
	 	}

	public function book()
	{

		$data['books']=$this->Book_model->get_all_books();
		$data['cat'] = $this->CategoriasM->lista();
		$this->load->view('book_view',$data);
	}

	public function book_add()
		{
			$data = array(
					'id_categoria' => $this->input->post('categoria'),
					'nombre_empresa' => $this->input->post('empresa'),
					'contacto' => $this->input->post('contacto'),
					'correo' => $this->input->post('correo'),
					'celular' => $this->input->post('celular'),
					'alias' => $this->input->post('alias')
				);
			$insert = $this->Book_model->book_add($data);
			echo json_encode(array("status" => TRUE));
		}


		public function user_add()
		{
			$data = array(
					'nombre' 	 => $this->input->post('nombre'),
					'correo' 	 => $this->input->post('correo'),
					'password' => $this->input->post('password')
				);
			$insert = $this->Book_model->book_add($data);
			echo json_encode(array("status" => TRUE));
		}


		public function ajax_edit($id)
		{
			$data = $this->Book_model->get_by_id($id);


			echo json_encode($data);
		}

		public function book_update()
	{

		$data = array(
			'id_categoria' => $this->input->post('categoria'),
			'nombre_empresa' => $this->input->post('empresa'),
			'contacto' => $this->input->post('contacto'),
			'correo' => $this->input->post('correo'),
			'celular' => $this->input->post('celular'),
			'alias' => $this->input->post('alias'),
			);

		$this->Book_model->book_update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function book_delete($id)
	{
		$this->Book_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



}
