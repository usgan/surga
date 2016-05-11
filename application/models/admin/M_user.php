<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('form_validation','session','encrypt'));
    }
    
    public function decrypt($value){
        $this->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $this->encrypt->set_mode(MCRYPT_MODE_CBC);
        $decrypted_string = $this->encrypt->decode($value);
        return $decrypted_string;
    }
    
    public function user() {
        //$this->db->where('username', $data['username']);
        //$this->db->where('password',$data['password']));
        //$this->db->where('active', "Y");
        $query = $this->db->get('user_table', 1);
        return $query->result();
        //return $this->db->get('table_user')->row();
    }
    
    
    function __destruct() {
        $this->db->close();
    }
}
?>

    