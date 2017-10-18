<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageM extends CI_Model {

    function __construct() {
        parent::__construct();  
    }

    function mostrar($id){

        $this->db->select('firma');
        $this->db->where('id_usuario', $id);
        $query = $this->db->get("usuarios");

            if($query->num_rows()>0){
              return $query->result();
            }else{
              return false;
            }  

    }
}