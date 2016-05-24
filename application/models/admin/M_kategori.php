<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    //mengambil data pada tb_levelpengguna
    public function getdata($data){
    	//$data['limit'] sebagai batas total data
        //$data['count'] sebagai parameter apakah ingin mengambil total data atau tidak
        //$data['combosearch'] sebagai parameter apakah ingin mengambil data yang akan digunakan sebagai combobox ataut tidak
        $this->db->select('tb_kategori.id_kategori');
        $this->db->from('tb_kategori');
        if($data['cari'] !=""){
            $this->db->group_start()
                ->like('tb_kategori.nama',$data['cari'])
            ->group_end();
        }
        if($data['count'] == true){
            return $this->db->count_all_results();
        }else{
            $this->db->select('tb_kategori.nama,tb_kategori.gambar,tb_kategori.keterangan');
            $this->db->limit(10,$data['limit']);
            return $this->db->get();
        }
    }
    //perintah yang dilakukan untuk mengambil data kategori berdasarkan id
    public function getdataid($data){
        $this->db->select('id_kategori,nama,gambar,keterangan');
        $this->db->from('tb_kategori');
        $this->db->where('tb_kategori.id_kategori',$data['id']);
        return $this->db->get();
    }
    //perintah yang digunakan untuk menambah data kategori baru
    public function addkategori($data){
        $this->db->set('nama',$data['nkategori']);
        $this->db->set('keterangan',$data['info']);
        $this->db->set('gambar',$data['gambar']);
        $this->db->insert('tb_kategori');
        return $this->db->affected_rows();
    }
    //perintah yang digunakan untuk memperbaharui data kategori
    public function updatekategori($data){
        $this->db->set('nama',$data['nkategori']);
        $this->db->set('keterangan',$data['info']);
        if($data['gambar'] != ""){
            $this->db->set('gambar',$data['gambar']);
        }
        $this->db->where('id_kategori',$data['id']);
        $this->db->update('tb_kategori');
        return $this->db->affected_rows();
    }
    public function deletekategori($data){
        $this->db->where('id_kategori',$data['id']);
        $this->db->delete('tb_kategori');
        return $this->db->affected_rows();
    }
}