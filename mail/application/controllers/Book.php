<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

	 public function __construct()
	 	{
	 		parent::__construct();
			$this->load->helper('url');
	 		$this->load->model('book_model');
	 	}

    //configuro página de inicio por defecto
    
	public function index()
	{
		$this->load->view('inicio');
	}
    
    //paso los datos a la vista
    
	public function book()
	{

		$data['books']=$this->book_model->get_all_books();
		$this->load->view('book_view',$data);
	}
	
	//agrego contactos al sistema
	
	public function book_add()
		{
			$data = array(
					'categoria' => $this->input->post('categoria'),
					'nombre_empresa' => $this->input->post('empresa'),
					'contacto' => $this->input->post('contacto'),
					'correo' => $this->input->post('correo'),
					'celular' => $this->input->post('celular'),
					'alias' => $this->input->post('alias')
				);
			$insert = $this->book_model->book_add($data);
			echo json_encode(array("status" => TRUE));
		}
		public function ajax_edit($id)
		{
			$data = $this->book_model->get_by_id($id);

			echo json_encode($data);
		}

	//actualizo contactos
	
	public function book_update()
	
	{
		$data = array(
			'categoria' => $this->input->post('categoria'),
			'nombre_empresa' => $this->input->post('empresa'),
			'contacto' => $this->input->post('contacto'),
			'correo' => $this->input->post('correo'),
			'celular' => $this->input->post('celular'),
			'alias' => $this->input->post('alias'),
			);

		$this->book_model->book_update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

    //elimino contactos

	public function book_delete($id)
	{
		$this->book_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



}
