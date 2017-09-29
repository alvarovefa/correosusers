<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	 public function __construct()
	 	{
	 		parent::__construct();
			$this->load->helper('url');
			$this->load->library('encrypt');
	 		$this->load->model('User_model');
				if (!$this->session->userdata("login")) {
				redirect(base_url());
            }
	 	}

	public function user()
	{

		$data['users']=$this->User_model->get_all_users();
		$this->load->view('user_view', $data);
	}

		public function user_add()
		{
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('correo', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required'
			);
			$this->form_validation->set_rules('password2', 'Confirmar', 'required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
					echo "<script> alert('Verificar los datos ingresados')</script>";
			}else{

			$data = array(
					'nombres'  => $this->input->post('nombre'),
					'email' 	 => $this->input->post('correo'),
					'password' => sha1($this->input->post('password')),
					'id_tipo_usuario' => '2'
				);
	
					$insert = $this->User_model->user_add($data);
					echo json_encode(array("status" => TRUE));
				}
		
			}

		public function ajax_edit($id)
		{
			$data = $this->User_model->get_by_id($id);

			echo json_encode($data);
		}

		public function user_update()
	{
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('correo', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required'
			);
			$this->form_validation->set_rules('password2', 'Confirmar', 'required|matches[password]');
			if ($this->form_validation->run() == FALSE) {
			
				echo "<script> alert('Verificar los datos ingresados')</script>";
			}else{
				
		$data = array(
					'nombres'  => $this->input->post('nombre'),
					'email' 	 => $this->input->post('correo'),
					'password' => sha1($this->input->post('password'))
			);

		$this->User_model->user_update(array('id_usuario' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
			}
	}

	public function user_delete($id)
	{
		$this->User_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	
	public function crearFirma(){

		$this->load->view('crearFirma');
	}

	function upload_firma() {

				$id = $this->session->userdata('id');
        //upload firma
        $config['upload_path'] = './uploads/firmas';
        $config['allowed_types'] = '*';
        $config['file_name'] = $id;
        $config['max_filename'] = '255';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '50000';
        $config['overwrite'] = TRUE;
        
        $this->load->library('upload', $config);
 	
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error durante la carga' . $_FILES['file']['error'];
            } else {
                if (file_exists('./uploads/firmas' . $_FILES['file']['name'])) {
                    echo 'Nombre de archivo ya existe : uploads/firmas' . $_FILES['file']['name'];
                } else {
									$this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                        echo 'Firma agregada con éxito!'. $firma;
                    }
                }
            }
        } else {
            echo 'Porfavor selecciona un archivo';
        }
    } 


}
