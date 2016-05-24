<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tpengguna extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    //mengambil data pada tb_levelpengguna
    public function getdata($data){
    	//$data['limit'] sebagai batas total data
        //$data['count'] sebagai parameter apakah ingin mengambil total data atau tidak
        //$data['combosearch'] sebagai parameter apakah ingin mengambil data yang akan digunakan sebagai combobox ataut tidak
        $this->db->select('tb_levelpengguna.id_level');
        $this->db->from('tb_levelpengguna');
        if($data['cari'] !=""){
            $this->db->group_start()
                ->like('tb_levelpengguna.nama_level',$data['cari'])
            ->group_end();
        }
        if($data['count'] == true){
            return $this->db->count_all_results();
        }else{
            $this->db->select('tb_levelpengguna.nama_level,tb_levelpengguna.statustoko,tb_levelpengguna.keterangan');
            $this->db->limit(10,$data['limit']);
            return $this->db->get();
        }
    }
    //mengambil data pada tb_levelpengguna berdasarkan id
    public function getdataid($data){
        $this->db->select('id_level,nama_level,statustoko,keterangan');
        $this->db->where('id_level',$data['id']);
        return $this->db->get('tb_levelpengguna');
    }
    //digunakan untuk menambah data tingkat pengguna
    public function addtpengguna($data){
        $this->db->set('nama_level',$data['ntp']);
        $this->db->set('statustoko',$data['sttoko']);
        $this->db->set('keterangan',$data['keterangan']);
        $this->db->insert('tb_levelpengguna');
        return $this->db->affected_rows();
    }
     //digunakan untuk memperbaharui data tingkat pengguna
    public function updatetpengguna($data){
        $this->db->set('nama_level',$data['ntp']);
        $this->db->set('statustoko',$data['sttoko']);
        $this->db->set('keterangan',$data['keterangan']);
        $this->db->where('id_level',$data['id']);
        $this->db->update('tb_levelpengguna');
        return $this->db->affected_rows();
    }
    //perintah yang digunakan untuk mengecek data pengguna apakah menggunakan id level pada tb_pengguna atau tidak
    public function cektb_pengguna($data){
        $this->db->select('id_pengguna');
        $this->db->where('tb_pengguna.id_level',$data['id']);
        return $this->db->get('tb_pengguna');
    }
    //perintah yang digunakan untuk mengecek data pengguna apakah menggunakan id level pada tb_lsmenu atau tidak
    public function cektb_lsmenu($data){
        $this->db->select('id_lsmenu');
        $this->db->where('tb_lsmenu.id_level',$data['id']);
        return $this->db->get('tb_lsmenu');
    }
    //perintah yang digunakan untuk mengecek data pengguna apakah menggunakan id level pada tb_lmenu atau tidak
    public function cektb_lmenu($data){
        $this->db->select('id_lmenu');
        $this->db->where('tb_lmenu.id_level',$data['id']);
        return $this->db->get('tb_lmenu');
    }

    //perintah yang digunakan untuk menghapus data tingkat pengguna
    public function deletetpengguna($data){
        $this->db->where('id_level',$data['id']);
        $this->db->delete('tb_levelpengguna');
        return $this->db->affected_rows();
    }
}