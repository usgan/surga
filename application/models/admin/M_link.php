<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_link extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    //to get link from tb_link for get data in limit or count data table -> untuk mengambil data dari table tb_link untuk memperoleh total data table atau mengambil data yang di limit
    public function getlink($cari="",$limit,$count=false){
        //$limit sebagai batas total data
        //$count sebagai parameter apakah ingin mengambil total data atau tidak
        $this->db->select('tb_link.id_url');
        $this->db->from('tb_link,tb_levelpengguna');
        $this->db->where('tb_link.id_level = tb_levelpengguna.id_level','',false);
        if($cari !=""){
            $this->db->group_start()
                ->like('tb_link.url',$cari)
                ->or_like('tb_levelpengguna.nama_level',$cari)
            ->group_end();
        }
        if($count == true){
            return $this->db->count_all_results();
        }else{
            $this->db->select('tb_link.url,tb_link.fungsi,tb_link.keterangan');
            $this->db->select('tb_levelpengguna.nama_level');
            $this->db->limit(10,$limit);
            return $this->db->get();
        }
    }
    //perintah yang digunakan untuk mengambil data link berdasarkan id
    public function getlinkid($id = '0'){
        $this->db->select('tb_link.url,tb_link.fungsi,tb_link.keterangan,tb_link.id_level,tb_link.id_url');
        $this->db->where('tb_link.id_url',$id);
        return $this->db->get('tb_link');
    }
    //perintah yang dikukan untuk mengecek apakah link telah digunakan oleh pengguna atau belum
    public function ceklink($data){
        $this->db->select('id_url');
        $this->db->from('tb_link');
        $this->db->where('tb_link.url',$data['url']);
        $this->db->where('tb_link.id_level',$data['pengguna']);
        return $this->db->get();
    }
    //perintah yang digunakan untuk menambah data link
    public function addlink($data){
        $this->db->set('tb_link.url',$data['url']);
        $this->db->set('tb_link.id_level',$data['pengguna']);
        $this->db->set('tb_link.fungsi',$data['fungsi']);
        $this->db->set('tb_link.keterangan',$data['keterangan']);
        $this->db->insert('tb_link');
        return $this->db->affected_rows();
    }
    //perintah yang digunakan untuk memperbaharui data link
    public function updatelink($data){
        $this->db->set('tb_link.url',$data['url']);
        $this->db->set('tb_link.id_level',$data['pengguna']);
        $this->db->set('tb_link.fungsi',$data['fungsi']);
        $this->db->set('tb_link.keterangan',$data['keterangan']);
        $this->db->where('tb_link.id_url',$data['id']);
        $this->db->update('tb_link');
        return $this->db->affected_rows();
    }
    //perintah yang digunakan untuk menghapus data link
    public function delete($data){
        $this->db->where('id_url',$data['id']);
        $this->db->delete('tb_link');
        return $this->db->affected_rows();
    }
}
?>

    
