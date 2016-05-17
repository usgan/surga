<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('form_validation','session','encrypt'));
    }
    
    public function user() {
        //$this->db->where('username', $data['username']);
        //$this->db->where('password',$data['password']));
        //$this->db->where('active', "Y");
        $query = $this->db->get('tb_pengguna', 1);
        return $query->result();
        //return $this->db->get('table_user')->row();
    }
    
    public function blockUser($id){
        //get data
        $this->status = "blocked";

        //update data
        $this->db->update('tb_pengguna', $this, array('id_pengguna'=>$id));
    }
    
    
    function __destruct() {
        $this->db->close();
    }
}
?>

    