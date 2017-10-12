<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriaC extends CI_Controller {

    function __construct() {
        parent::__construct();  
            $this->load->helper('date');
            $this->load->model('CategoriasM');
            if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }

     public function index(){

            $data['cat'] = $this->CategoriasM->lista();
            $this->load->view('redactar', $data);
         }

     public function modal(){

        $data['cat'] = $this->CategoriasM->lista();
        $this->load->view('redactar', $data);
     }

    public function mostrarCat(){

        //echo "<script> alert('hola');</script>";
        //die();
        //valor a Buscar
        $id = $this->input->post('categoria');
        
        $data = array(
            "cat" => $this->CategoriasM->buscar_cat($id)          
        );

        echo json_encode($data);
    }
 
    public function categorias(){

        $data['categoria'] = $this->CategoriasM->lista(); 
        $this->load->view('categoriaV', $data);

    }

    public function book_add()
        {
            $data = array(
                    'nombre' => $this->input->post('categoria')
                );
            $insert = $this->CategoriasM->book_add($data);
            echo json_encode(array("status" => TRUE));
        }


        public function ajax_edit($id_categoria)
        {
            $data = $this->CategoriasM->get_by_id($id_categoria);


            echo json_encode($data);
        }

        public function book_update()
    {

        $data = array(

            'nombre' => $this->input->post('categoria')

            );

        $this->CategoriasM->book_update(array('id_categoria' => $this->input->post('id_categoria')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function book_delete($id)
    {
        $this->CategoriasM->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    }