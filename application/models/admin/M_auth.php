<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('form_validation','session','encrypt'));
        $this->load->library("typeencryption");
    }
    
    public function auth($id) {
        //$this->db->where('username', $data['username']);
        //$this->db->where('password',$data['password']));
        //$this->db->where('active', "Y");
        
        $query = $this->db->query("SELECT a.*, b.* FROM auth_table a, user_table b WHERE a.user_id=b.user_id AND a.user_id='$id'");
        //$query = $this->db->get('user_table', 1);
        return $query->result();
        //return $this->db->get('table_user')->row();
    }
    
    public function authNow($id,$now) {
        //$this->db->where('username', $data['username']);
        //$this->db->where('password',$data['password']));
        //$this->db->where('active', "Y");
        
        $query = $this->db->query("SELECT a.*, b.* FROM auth_table a, user_table b WHERE a.user_id=b.user_id AND a.user_id='$id' AND a.status='F' AND a.time like '%$now%'");
        //$query = $this->db->get('user_table', 1);
        return $query->result();
        //return $this->db->get('table_user')->row();
    }
       
    public function authTrue($id,$now) {
        //$this->db->where('username', $data['username']);
        //$this->db->where('password',$data['password']));
        //$this->db->where('active', "Y");
        
        $query = $this->db->query("SELECT a.*, b.* FROM auth_table a, user_table b WHERE a.user_id=b.user_id AND a.user_id='$id' AND a.status='T' AND a.time like '%$now%'");
        //$query = $this->db->get('user_table', 1);
        return $query->result();
        //return $this->db->get('table_user')->row();
    }
    
    public function createAuth($data){
        $this->auth_id = $data['auth_id'];
        $this->user_id = $data['user_id'];
        $this->time = $data['time'];
        $this->ip_address = $data['ip_address'];
        $this->mac_address = $data['mac_address'];
        $this->status = $data['status'];
        
        //insert data
        $this->db->insert('auth_table', $this);
    }
    
    function __destruct() {
        $this->db->close();
    }
}
?>

    
