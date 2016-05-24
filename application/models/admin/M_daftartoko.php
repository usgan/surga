<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_daftartoko extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    //mengambil data pada tb_toko
    public function getdata($data){
    	//$data['limit'] sebagai batas total data
        //$data['count'] sebagai parameter apakah ingin mengambil total data atau tidak
        //$data['combosearch'] sebagai parameter apakah ingin mengambil data yang akan digunakan sebagai combobox ataut tidak
        $this->db->select('tb_toko.id_toko');
        $this->db->from('tb_toko');
        if($data['cari'] !=""){
            $this->db->group_start()
                ->like('tb_toko.nama_toko',$data['cari'])
                ->or_like('tb_toko.pemilik',$data['cari'])
            ->group_end();
        }
        if($data['count'] == true){
            return $this->db->count_all_results();
        }else{
            $this->db->select('tb_toko.nama_toko,tb_toko.pemilik,tb_toko.informasi,tb_toko.email,tb_toko.email,tb_toko.tgl');
            $this->db->limit(10,$data['limit']);
            return $this->db->get();
        }
    }
    //perintah untuk mengambil data toko berdasarkan id
    public function getdataid($data){
        $this->db->select('id_toko,nama_toko,pemilik,email,informasi,nohp');
        $this->db->from('tb_toko');
        $this->db->where('tb_toko.id_toko',$data['id']);
        return $this->db->get();
    }
    //perintah untuk menambah data toko pada tb_toko di database
    public function addtoko($data){
        $this->db->set('id_toko',$data['id']);
        $this->db->set('nama_toko',$data['ntoko']);
        $this->db->set('pemilik',$data['pemilik']);
        $this->db->set('email',$data['email']);
        $this->db->set('informasi',$data['info']);
        $this->db->set('nohp',$data['hp']);
        $this->db->insert('tb_toko');
        return $this->db->affected_rows();
    }
    //perintah untuk menambah data toko pada tb_toko di database
    public function updatetoko($data){
        $this->db->set('nama_toko',$data['ntoko']);
        $this->db->set('pemilik',$data['pemilik']);
        $this->db->set('email',$data['email']);
        $this->db->set('informasi',$data['info']);
        $this->db->set('nohp',$data['hp']);
        $this->db->where('id_toko',$data['id']);
        $this->db->update('tb_toko');
        return $this->db->affected_rows();
    }
    //perintah yang digunakan untuk menghapus data toko pada tb_toko
    public function deletetoko($data){
        $this->db->where('id_toko',$data['id']);
        $this->db->delete('tb_toko');
        return $this->db->affected_rows();
    }
    //perintah untuk mengecek id toko pada tb_lokasi
    public function gettoko_tb_lokasi($data){
        $this->db->select('id_toko');
        $this->db->from('tb_lokasi');
        $this->db->where('tb_lokasi.id_toko',$data['id']);
        return $this->db->get();
    }
}