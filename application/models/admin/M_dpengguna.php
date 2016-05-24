<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dpengguna extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('form_validation','session','encrypt'));
        $this->load->library("typeencryption");
    }
    //mengambil data pada tb_pengguna 
    public function getdata($data){
    	//$data['limit'] sebagai batas total data
        //$data['count'] sebagai parameter apakah ingin mengambil total data atau tidak
        //$data['combosearch'] sebagai parameter apakah ingin mengambil data yang akan digunakan sebagai combobox ataut tidak
        $this->db->select('tb_pengguna.id_pengguna');
        $this->db->from('tb_pengguna,tb_levelpengguna');
        $this->db->where('tb_levelpengguna.id_level = tb_pengguna.id_level','',false);
        if($data['cari'] !=""){
            $this->db->group_start()
                ->like('tb_pengguna.nama_pengguna',$data['cari'])
            ->group_end();
        }
        if($data['count'] == true){
            return $this->db->count_all_results();
        }else{
            $this->db->select('tb_levelpengguna.nama_level');
            $this->db->select('tb_pengguna.nama_pengguna,tb_pengguna.jenkel,tb_pengguna.foto_pengguna,tb_pengguna.status,tb_pengguna.tgl,tb_pengguna.email');
            $this->db->limit(10,$data['limit']);
            return $this->db->get();
        }
    }
}