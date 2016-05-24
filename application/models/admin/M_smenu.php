<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_smenu extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    //to get sub menu from tb_smenu for get data in limit or count data table -> untuk mengambil data dari table tb_smenu untuk memperoleh total data table atau mengambil data yang di limit
    public function getsubmenu($cari="",$limit,$count=false,$combosearch = false){
        //$limit sebagai batas total data
        //$count sebagai parameter apakah ingin mengambil total data atau tidak
        $this->db->select('tb_smenu.id_smenu');
        $this->db->from('tb_smenu,tb_menu');
        $this->db->where('tb_smenu.id_menu = tb_menu.id_menu','',false);

        if($cari !=""){
            $this->db->group_start()
                ->like('tb_smenu.nama_smenu',$cari)
                ->or_like('tb_smenu.link',$cari)
                ->or_like('tb_menu.nama_menu',$cari)
            ->group_end();
        }
        if($count == true){
            return $this->db->count_all_results();
        }else{
            if($combosearch == false){
                $this->db->select('tb_smenu.nama_smenu,tb_smenu.link,tb_smenu.tampil');
                $this->db->select('tb_menu.nama_menu');
                $this->db->order_by('tb_menu.urut asc, tb_smenu.urut asc');
                $this->db->limit(10,$limit);
                return $this->db->get();
            }else{
                $this->db->select('tb_smenu.nama_smenu,tb_menu.nama_menu');
                $this->db->order_by('tb_smenu.nama_smenu asc, tb_menu.nama_menu asc');
                return $this->db->get();
            }
        }
    }
    //perintah untuk mengambil data sub menu berdasarkan id
    public function getsubmenuid($data){
        $this->db->select('id_smenu,id_menu,nama_smenu,icon,link,urut,tampil');
        $this->db->where('tb_smenu.id_smenu',$data['id']);
        return $this->db->get('tb_smenu');
    }
    //perintah untuk melakukan cek sub menu berdasarkan link
    public function ceksmenu($data){
        $this->db->where('tb_smenu.link',$data['link']);
        return $this->db->get('tb_smenu');
    }
    //perintah untuk mengambil data2 level pengguna yang menggunakan sub menu
    public function getmenuinfo($data){
        $this->db->select('tb_levelpengguna.nama_level');
        $this->db->from('tb_levelpengguna,tb_lsmenu');
        $this->db->where('tb_levelpengguna.id_level = tb_lsmenu.id_level','',false);
        $this->db->where('tb_lsmenu.id_smenu',$data['id']);
        return $this->db->get();
    }
    //perintah untuk menghapus data2 sub menu berdasarkan id 
    public function deletesmenu($data){
        $this->db->where('tb_smenu.id_smenu',$data['id']);
        $this->db->delete('tb_smenu');
        return $this->db->affected_rows();
    }
    //perintah untuk menghapus data-data sub menu
    public function addsmenu($data){
        $this->db->set('id_menu',$data['menu']);
        $this->db->set('nama_smenu',$data['smenu']);
        $this->db->set('icon',$data['icon']);
        $this->db->set('link',$data['link']);
        $this->db->set('urut',$data['urut']);
        $this->db->set('tampil',$data['tampil']);
        $this->db->insert('tb_smenu');
        return $this->db->affected_rows();
    }
    //perintah untuk memperbaharui data-data sub menu
    public function updatesmenu($data){
        $this->db->set('id_menu',$data['menu']);
        $this->db->set('nama_smenu',$data['smenu']);
        $this->db->set('icon',$data['icon']);
        $this->db->set('link',$data['link']);
        $this->db->set('urut',$data['urut']);
        $this->db->set('tampil',$data['tampil']);
        $this->db->where('id_smenu',$data['id']);
        $this->db->update('tb_smenu');
        return $this->db->affected_rows();
    }

    //perintah yang digunakan untuk mengambil data tabel tingkat pengguna
    public function getsmenutp($cari = "",$limit = 0, $count = false){
        //$limit sebagai batas total data
        //$count sebagai parameter apakah ingin mengambil total data atau tidak
        $this->db->select('tb_lsmenu.id_lsmenu');
        $this->db->from('tb_smenu,tb_menu,tb_lsmenu,tb_levelpengguna');
        $this->db->where('tb_menu.id_menu = tb_smenu.id_menu','',false);
        $this->db->where('tb_smenu.id_smenu = tb_lsmenu.id_smenu','',false);
        $this->db->where('tb_lsmenu.id_level = tb_levelpengguna.id_level','',false);
        
        if($cari !=""){
            $this->db->group_start()
                ->like('tb_smenu.nama_smenu',$cari)
                ->or_like('tb_smenu.link',$cari)
                ->or_like('tb_menu.nama_menu',$cari)
                ->or_like('tb_levelpengguna.nama_level',$cari)
            ->group_end();
        }

        if($count == true){
            return $this->db->count_all_results();
        }else{
            $this->db->select('tb_menu.nama_menu,tb_smenu.nama_smenu,tb_smenu.icon,tb_smenu.link,tb_smenu.tampil,tb_levelpengguna.nama_level');
            $this->db->limit(10,$limit);
            return $this->db->get();
        }
    }
    //perintah yang dilakukan untuk mengecek data
    public function ceksubmenupengguna($data){
        $this->db->select('id_lsmenu');
        $this->db->where('tb_lsmenu.id_level',$data['tp']);
        $this->db->where('tb_lsmenu.id_smenu',$data['smenu']);
        return $this->db->get('tb_lsmenu');
    }
    //perintah yang dilakukan untuk menambah data sub menu pengguna
    public function addsubmenutp($data){
        $this->db->set('id_smenu',$data['smenu']);
        $this->db->set('id_level',$data['tp']);
        $this->db->insert('tb_lsmenu');
        return $this->db->affected_rows();
    }
    //perintah yang dilakukan untuk menghapus data sub menu pengguna
    public function deletesubmenutp($data){
        $this->db->where('tb_lsmenu.id_lsmenu',$data['id']);
        $this->db->delete('tb_lsmenu');
        return $this->db->affected_rows();
    }
}