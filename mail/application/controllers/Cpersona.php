<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpersona extends CI_Controller {

	function __construct() {
	    parent::__construct();	
			$this->load->model('Modelo_datos');
			$this->load->model('HistorialM');
			$this->load->library('encrypt');
			//verifico que la sesión esté iniciada
			if (!$this->session->userdata("login")) {
	  		redirect(base_url());
	  	}
	}


    //cargo vista redactar
    
	public function verLista(){
		
		$this->load->view("redactar");
		
	}

    //buscar contactos en vista redactar

	public function mostrar(){
		//valor a Buscar
		$buscar = $this->input->post("buscar");
		
		$data = array(
			"clientes" => $this->Modelo_datos->buscar($buscar)			
		);
		echo json_encode($data);
	}

        //enviar email
        
		function sendMail(){
		
		$from = 'correopruebas@consultoramda.cl';
		//defino zona horaria
		date_default_timezone_set("America/Santiago");
		//cargo helpers, librerías y defino path
		$this->load->helper('text');    
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*';

		$this->load->library('upload', $config);
		$this->load->helper('path');


        //array con configuraciones para envío de correo
        
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
		
		//cargo helper y librería
            $this->load->helper('url');
			$this->load->library('email', $config);
		    $to_email = $this->input->post("email"); //recibo email
		    $lista = explode(',', $to_email);       // divido string email
		    //$path = set_realpath('./uploads/');   
		    //$file = $this->upload->do_upload('file');
		    $mensaje = $this->input->post("mensaje"); //tomo el mensaje
		    $asunto = utf8_decode($this->input->post("asunto")); //agrego asunto codificado
		    
		    $usuario = $this->session->userdata('id'); //agrego id de usuario por sesion
            $fecha = date("Y-m-d H:i:s"); //defino fecha
		    
            $archivo =  $_FILES['file']['name'];
            //$archivoF = str_replace(" ", "_", $archivo);
            
            if (empty($_FILES['file']['name'])) {
                
//si el adjunto está vacío hago envío del mail sin adjunto

		    foreach ($lista as $key => $value) {
		        
	//defino cliente para agregar a historial
	//envío $value al modelo para que recupere datos de clientes con ese valor
		        $cliente = $this->Modelo_datos->registroUsuario($value);

				$alias = $this->Modelo_datos->alias($value);//recupero el alias 
			    $saludo = $alias['alias']; //asigno a variable
			    $saludo = htmlentities($saludo, ENT_QUOTES,'UTF-8');//codifico
			    $mensaje = ascii_to_entities($mensaje);//codifico mensaje
			    $mensaje .= '<img src=http://mail.mayordomus.cl/uploads/firma.png alt="Mi Firma"> <br>';
			    $enviar = $saludo." ".$mensaje;//concateno saludo y mensaje
			    
			    //array para agregar datos a historial
			    $data = array(
                    'id_usuario' => $usuario,
                    'fecha' => $fecha,
                    'id' => $cliente 
                    );
                //envío datos a modelo
                $this->Modelo_datos->historial($data);
                
                //defino formato de mail con variables ya creadas
                $headers = $this->email->from($from);
		        $this->email->set_newline("\r\n");
		        $this->email->from($headers);
		        $this->email->to($value);
		        $this->email->subject($asunto);
		        $this->email->message($enviar);

                
			    if($this->email->send())
			     {
  
                    $this->load->helper("file");//elimino adjunto de servidor
                   // delete_files('./uploads/');
                    //muestro alert de envío
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Correo Enviado!!')
                    window.location.href='verLista';
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
            
//si el archivo no está vacío hago envío del mail con adjunto            
            
             foreach ($lista as $key => $value) {
                 
                        $cliente = $this->Modelo_datos->registroUsuario($value);
        
        				$alias = $this->Modelo_datos->alias($value);
        			    $saludo = $alias['alias'];
        			    $saludo = htmlentities($saludo, ENT_QUOTES,'UTF-8');
        			    $mensaje = ascii_to_entities($mensaje);
        			    $mensaje .= '<img src=http://mail.mayordomus.cl/uploads/firma.png alt="Mi Firma"> <br>';
        			    $enviar = $saludo." ".$mensaje;
        			    
                	    $data = array(
                            'id_usuario' => $usuario,
                            'fecha' => $fecha,
                            'id' => $cliente 
                            );

                $this->Modelo_datos->historial($data);
        
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
                           // delete_files('./uploads/');
                            echo ("<SCRIPT LANGUAGE='JavaScript'>
                            window.alert('Correo Enviado!!')
                            window.location.href='verLista';
                            </SCRIPT>");
                                          
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
 
 	    //$this->load->helper('path');
	    //$path = set_realpath('./uploads/');

        //subir archivo adjunto a servidor

        //defino configuraciones de librería
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '50000';
        $config['overwrite'] = TRUE;
        
        // cargo librería y configuraciones
        
        $this->load->library('upload', $config); 
 
        //subo archivo a servidor
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