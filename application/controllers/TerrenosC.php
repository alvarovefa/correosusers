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

    public function terreno_add()
        {
            $data = array(
                
                'codigo' => $this->input->post('codigo'),
                'inmueble' => $this->input->post('inmueble'),
                'tipo' => $this->input->post('tipo'),
                'direccion' => $this->input->post('direccion'),
                'region' => $this->input->post('region'),
                'ciudad' => $this->input->post('ciudad'),
                'mts2' => $this->input->post('mts2'),
                'uf' => $this->input->post('uf'),
                'ciudad' => $this->input->post('ciudad'),
                'mts2' => $this->input->post('mts2'),   
                'uf' => $this->input->post('uf'),
                'rol' => $this->input->post('rol'),
                'propietario' => $this->input->post('propietario'),
                'corredor' => $this->input->post('corredor'),
                'observaciones' => $this->input->post('observaciones'),
                'letrero' => $this->input->post('valor')
            );
            $insert = $this->TerrenosM->terreno_add($data);
            echo json_encode(array("status" => TRUE));
        }


        public function ajax_edit($id_terreno)
        {
            $data = $this->TerrenosM->get_by_id($id_terreno);

            echo json_encode($data);
        }

        public function terreno_update()
    {
        $data = array(
            'id_terreno' =>$this->input->post('id_terreno'),
            'codigo' => $this->input->post('codigo'),
            'inmueble' => $this->input->post('inmueble'),
            'tipo' => $this->input->post('tipo'),
            'direccion' => $this->input->post('direccion'),
            'region' => $this->input->post('region'),
            'ciudad' => $this->input->post('ciudad'),
            'mts2' => $this->input->post('mts2'),
            'uf' => $this->input->post('uf'),
            'ciudad' => $this->input->post('ciudad'),
            'mts2' => $this->input->post('mts2'),   
            'uf' => $this->input->post('uf'),
            'letrero' => $this->input->post('letrero'),
            'rol' => $this->input->post('rol'),
            'propietario' => $this->input->post('propietario'),
            'corredor' => $this->input->post('corredor'),
            'observaciones' => $this->input->post('observaciones')
            );

        $this->TerrenosM->terreno_update(array('id_terreno' => $this->input->post('id_terreno')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function terreno_delete($id_terreno)
    {
        $this->TerrenosM->delete_by_id($id_terreno);
        echo json_encode(array("status" => TRUE));
    }

    public function listaTerrenos(){

        $data['terreno'] = $this->TerrenosM->listaTerrenos();
        $this->load->view('categoriaV', $data);

    }

    }