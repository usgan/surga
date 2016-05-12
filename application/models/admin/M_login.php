<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('form_validation','session','encrypt'));
    }
    
    public function user($data) {
        $this->db->select('user_id, username, email, status');
        $this->db->where('username', $data);
        $this->db->where('status !=', 'blocked');
        $query = $this->db->get('user_table', 1);
        return $query->result();
    }
    
    public function userID($id) {
        $this->db->select('user_id, username, email, status');
        $this->db->where('user_id', $id);
        $query = $this->db->get('user_table', 1);
        return $query->result();
    }
    
    public function user_verified($user, $pass){
        $this->db->select('user_id, username, email, password');
        $this->db->where('username', $user);
        $this->db->where('password', $pass);
        $query = $this->db->get('user_table', 1);
        return $query->result();
    }
    
    function __destruct() {
        $this->db->close();
    }
}
?>

    
