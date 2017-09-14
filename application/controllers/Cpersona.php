<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpersona extends CI_Controller {

	function __construct() {
	    parent::__construct();	
			$this->load->model('Modelo_datos');
			$this->load->library('encrypt');
	}

	public function verLista(){
		
		$this->load->view("redactar");
		
	}

	public function mostrar(){
		//valor a Buscar
		$buscar = $this->input->post("buscar");
		
		$data = array(
			"clientes" => $this->Modelo_datos->buscar($buscar)			
		);
		echo json_encode($data);
	}

		function sendMail(){
		    
		$this->load->helper('text');    
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*';

		    
		$this->load->library('upload', $config);
		    
		$this->load->helper('path');

		   $config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'correopruebas@consultoramda.cl', 
		  'smtp_pass' => 'lar10279',
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
            $this->load->helper('url');
			$this->load->library('email', $config);
		    $to_email = $this->input->post("email");
		    $lista = explode(',', $to_email);
		    $mensaje = $this->input->post("mensaje");
		    $asunto = utf8_decode($this->input->post("asunto"));
		    
            $archivo = $_FILES['file']['name'];
            
            if (empty($_FILES['file']['name'])) {

		    foreach ($lista as $key => $value) {

				$alias = $this->Modelo_datos->alias($value);
			    $saludo = $alias['alias'];
			    $saludo = htmlentities($saludo, ENT_QUOTES,'UTF-8');
			    $mensaje = ascii_to_entities($mensaje);
			    $enviar = $saludo." ".$mensaje;

		        $this->email->set_newline("\r\n");
		        $this->email->from('correopruebas@consultoramda.cl');
		        $this->email->to($value);
		        $this->email->subject($asunto);
		        $this->email->message($enviar);
		        
			    
			    if($this->email->send())
			     {
			      
                    $this->load->helper("file");
                    delete_files('./uploads/');
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Correo Enviado!!')
                    window.location.href='/';
                    </SCRIPT>");

                }
                else
			    {
    			     show_error($this->email->print_debugger());
    			     $this->load->helper("file");
                     delete_files('./uploads/');
			    }

		    }
        }else{
            
             foreach ($lista as $key => $value) {
        
        				$alias = $this->Modelo_datos->alias($value);
        			    $saludo = $alias['alias'];
        			    $saludo = htmlentities($saludo, ENT_QUOTES,'UTF-8');
        			    $mensaje = ascii_to_entities($mensaje);
        			    $enviar = $saludo." ".$mensaje;
        
        		        $this->email->set_newline("\r\n");
        		        $this->email->from('correopruebas@consultoramda.cl');
        		        $this->email->to($value);
        		        $this->email->subject($asunto);
        		        $this->email->message($enviar);
        
        		        $path = set_realpath('./uploads/');
        		        $adjunto = $path.$archivo;
        
        				$this->email->attach($adjunto);
        			    
        			    if($this->email->send())
        			     {
                            $this->load->helper("file");
                            delete_files('./uploads/');
                            redirect('Cpersona/verLista');
                                  
        			     }
        			     else
        			    {
        			     show_error($this->email->print_debugger());
        			     $this->load->helper("file");
                         delete_files('./uploads/');
        			    }
        
        		    }
            
            }

		}
		
    function upload_file() {

        //upload file

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '50000';
        $config['overwrite'] = TRUE;
        
        $this->load->library('upload', $config);
 
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error durante la carga' . $_FILES['file']['error'];
            } else {
                if (file_exists('./uploads/' . $_FILES['file']['name'])) {
                    echo 'Nombre de archivo ya existe : uploads/' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                        echo 'Archivo cargado! : ./uploads/' . $_FILES['file']['name'];
                    }
                }
            }
        } else {
            echo 'Porfavor selecciona un archivo';
        }
    } 
 }