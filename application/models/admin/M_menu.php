<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }

    //to check url in table tb_link, what like level for get name fungsinya  -> mengecek url di table tb_link sesuai levelnya untuk mengambil fungsinya
    public function checklinkmenu($url = ""){
        $level = $this->typeencryption->thirdDecryption($this->session->userdata('levelp'));
        $this->db->select('tb_link.id_level,tb_link.id_level,tb_link.url,tb_link.fungsi,tb_link.keterangan');
        $this->db->from('tb_link');
        $this->db->where('tb_link.id_level',$level);
        $this->db->where('tb_link.url',$url);
        return $this->db->get();
    }

    //to get menu from tb_menu for get data in limit or count data table -> untuk mengambil data dari table tb_menu untuk memperoleh total data table atau mengambil data yang di limit
    public function getmenu($cari="",$limit,$count=false,$combosearch=false,$punyasub = false){
        //$limit sebagai batas total data
        //$count sebagai parameter apakah ingin mengambil total data atau tidak
        //$combosearch sebagai parameter apakah ingin mengambil data yang akan digunakan sebagai combobox ataut tidak
        $this->db->select('id_menu');
        $this->db->from('tb_menu');
        if($cari !=""){
            $this->db->group_start()
                ->like('tb_menu.nama_menu',$cari)
                ->or_like('tb_menu.link',$cari)
            ->group_end();
        }
        if($count == true){
            return $this->db->count_all_results();
        }else{
            if($combosearch == false){
                $this->db->select('tb_menu.id_menu,tb_menu.nama_menu,tb_menu.icon,tb_menu.link,tb_menu.punyasub,tb_menu.tampil');
                $this->db->limit(10,$limit);
            }else{
                $this->db->select('tb_menu.id_menu,tb_menu.nama_menu');
                if($punyasub == true){
                    $this->db->where('punyasub','Y');
                }
                $this->db->where('tb_menu.tampil','Y');
            }
            return $this->db->get();
        }
    }
    //perintah yang digunakan mengambil menu berdasarkan id
    public function getmenuid($data){
        $this->db->select('tb_menu.id_menu,tb_menu.nama_menu,tb_menu.icon,tb_menu.link,tb_menu.punyasub,tb_menu.tampil,tb_menu.urut');
        $this->db->select('id_menu');
        $this->db->from('tb_menu');
        $this->db->where('tb_menu.id_menu',$data['id']);
        return $this->db->get();
    }

    //perintah yang digunakan untuk mengisi data ke tb_menu
    public function addmenu($data){
        $this->db->set('nama_menu',$data['nama']);
        $this->db->set('icon',$data['icon']);
        $this->db->set('link',$data['link']);
        $this->db->set('urut',$data['urutan']);
        $this->db->set('punyasub',$data['psub']);
        $this->db->set('tampil',$data['tampil']);
        $this->db->insert('tb_menu');
        return $this->db->affected_rows();
    }
    //perintah yang digunakan untuk mengubah data di tb_menu
    public function updatemenu($data){
        $this->db->set('nama_menu',$data['nama']);
        $this->db->set('icon',$data['icon']);
        $this->db->set('link',$data['link']);
        $this->db->set('urut',$data['urutan']);
        $this->db->set('punyasub',$data['psub']);
        $this->db->set('tampil',$data['tampil']);
        $this->db->where('id_menu',$data['id']);
        $this->db->update('tb_menu');
        return $this->db->affected_rows();
    }
    //perintah yang digunakan untuk mengambil informasi tingkat pada menu
    public function getmenuinfo($data){
        $this->db->select('tb_levelpengguna.nama_level');
        $this->db->from('tb_lmenu,tb_levelpengguna');
        $this->db->where('tb_lmenu.id_level = tb_levelpengguna.id_level','',false);
        $this->db->where('tb_lmenu.id_menu',$data['id']);
        return $this->db->get();
    }
    //perintah yang digunakan untuk menghapus data menu
    public function deletemenu($data){
        $this->db->where('tb_menu.id_menu',$data['id']);
        $this->db->from('tb_menu');
        $this->db->delete();
        return $this->db->affected_rows();
    }    

    //perintah yang dilakukan untuk melakukan cek data menu tingkat pengguna apakah telah ada sebelumnya atatu tidak
    public function cektpmenu($data){
        $this->db->select('tb_lmenu.id_lmenu');
        $this->db->from('tb_lmenu');
        $this->db->where('tb_lmenu.id_menu',$data['menu']);
        $this->db->where('tb_lmenu.id_level',$data['tp']);
        return $this->db->get();
    }
    //perintah yang digunakan untuk mengambah menu tingkat pengguna pada tabel tb_lmnu
    public function addmenutp($data){
        $this->db->set('tb_lmenu.id_menu',$data['menu']);
        $this->db->set('tb_lmenu.id_level',$data['tp']);
        $this->db->insert('tb_lmenu');
        return $this->db->affected_rows();
    }
    //perintah yang digunakan untuk menghapus menu tingkat pengguna pada tabel tb_lmnu
    public function deletemenutp($data){
        $this->db->where('tb_lmenu.id_lmenu',$data['id']);
        $this->db->delete('tb_lmenu');
        return $this->db->affected_rows();
    }

    //perintah yang digunakan untuk mengambil data yang ada didalam tabel tb_lmenu
    public function getmenutp($cari="",$limit,$count=false){
        //$limit sebagai batas total data
        //$count sebagai parameter apakah ingin mengambil total data atau tidak
        $this->db->select('id_lmenu');
        $this->db->from('tb_menu,tb_lmenu,tb_levelpengguna');
        $this->db->where('tb_menu.id_menu = tb_lmenu.id_menu','',false);
        $this->db->where('tb_lmenu.id_level = tb_levelpengguna.id_level','',false);
        if($cari !=""){
            $this->db->group_start()
                ->like('tb_menu.nama_menu',$cari)
                ->or_like('tb_menu.link',$cari)
                ->or_like('tb_levelpengguna.nama_level',$cari)
            ->group_end();
        }
        if($count == true){
            return $this->db->count_all_results();
        }else{
            $this->db->select('tb_menu.id_menu,tb_menu.nama_menu,tb_menu.icon,tb_menu.link,tb_menu.punyasub,tb_menu.tampil');
            $this->db->select('tb_levelpengguna.nama_level');
            $this->db->limit(10,$limit);
        
            return $this->db->get();
        }
    }

    //perintah yang digunakan mengambil tingkatan pengguna di dalam database
    public function getlevelp(){
        $this->db->select('id_level,nama_level');
        return $this->db->get('tb_levelpengguna');
    }
}
    