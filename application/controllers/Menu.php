<?php
class Menu extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model("admin/M_login");
        $this->load->model("admin/M_auth");
        
        if($this->session->userdata('id_pengguna')==null) {
            $this->session->set_flashdata('flash_data', 'Anda Tidak Mempunyai Hak Akses!');
                    header('location:'.site_url('Login/view'));
        }
        else{
            $auth = $this->M_auth->authTrue($this->session->userdata('id_pengguna'),$this->session->userdata('time'));
            for ($i=0; $i<count($auth); $i++){
                if ($auth[$i]->id_pengguna==$this->session->userdata('id_pengguna') && 
                        $this->typeencryption->thirddecryption($auth[$i]->ip_address)==$this->typeencryption->thirddecryption($this->session->userdata('ip_address')) && 
                        $this->typeencryption->thirddecryption($auth[$i]->mac_address)==$this->typeencryption->thirddecryption($this->session->userdata('mac_address')))
                {
                } else{
                    //$this->session->set_flashdata('flash_data', 'Anda Tidak Mempunyai Hak Akses!');
                    //redirect('Login/view');
                }  
            }
        }
    }

    public function index(){

    }
    //versi usgan 0.0.1
    //digunakan untuk membuka daftar menu yang telah dibuat sebelumnya yang akan ditampilkan pada tabel
    public function menu($menu = "",$submenu = ""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_menu');
        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("menu/menu");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('menu/menu/'.$menu.'/'.$menu.'/'.$submenu)."'>Menu</a></li>";
            $data_bread['active'] = "<h3>Menu</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){
                //setting table
                $this->table->set_template($this->fungsi_umum->getsetting());
                $this->table->set_heading('No', 'Menu', 'Link','Icon','Punya Sub','Tampil','Aksi');

                $menu_ = $this->m_menu->getmenu($cari,$page,false,false);
                $page++;
                foreach ($menu_->result() as $datam) {
                    $c['info'] = site_url('menu/imenu/'.$datam->id_menu);
                    $c['edit'] = site_url('menu/emenu/'.$menu.'/'.$submenu.'/'.$datam->id_menu);
                    $c['hapus'] = site_url('menu/dmenu/'.$datam->id_menu);

                    $this->table->add_row($page++,$datam->nama_menu,$datam->link,"<span class='".$datam->icon."'></span>",$datam->punyasub,$datam->tampil,$this->fungsi_umum->actionbutton($c));
                }
                //end setting table

                //set pagination
                if($countpage == 0){
                    $countpage=$this->m_menu->getmenu($cari,$page,true,false);
                }

                $this->fungsi_umum->setpagination($countpage,
                    site_url('menu/menu/'.$menu."/".$submenu.'?cari='.$cari.'&countpage='.$countpage),
                    10,6);
                
                //end set pagination
                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['cari'] = $cari;

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/menu/depan",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }

    //versi usgan 0.0.1
    //digunakan untuk membuka halaman create menu yang digunakan untuk membuat menu baru -> create menu -> cmenu
    public function cmenu($menu = "",$submenu = ""){
        $this->load->model('admin/m_menu');
        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("menu/cmenu");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('menu/menu/'.$menu.'/'.$menu.'/'.$submenu)."'>Menu</a></li><li><a href='#'>Tambah Menu</a></li>";
            $data_bread['active'] = "<h3>Tambah Menu</h3>";

            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/menu/cmenu",$data);
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //varsi usgan 0.0.1
    //digunakan untuk memasukkan data menu baru kedalam database -> add create menu -> acmenu
    public function acmenu(){
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("menu/acmenu");
        if($checkfungsi->num_rows() > 0){
            $alert = "Input data menu GAGAL";
            $type = "fail";
            $send['nama'] = $this->input->post('nama');
            $send['urutan'] = $this->input->post('urutan');
            $send['link'] = $this->input->post('link');
            $send['icon'] = $this->input->post('icon');
            $send['psub'] = $this->input->post('psub');
            $send['tampil'] = $this->input->post('tampil');
            $send['send'] = $this->input->post('send');

            if($send['nama'] && $send['urutan'] && $send['link'] && $send['send']){
                $hasil = $this->m_menu->addmenu($send);
                if($hasil == 1){
                    $alert = "Input data menu Berhasil";
                    $type = "success";
            
                }
            }

            $ar = array('alert' => $alert,'type' => $type);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //versi usgan 0.0.1
    //digunakan untuk membuka halaman edit menu yang digunakan yang telah ada di database -> edit menu -> emenu
    public function emenu($menu = "",$submenu = "",$id = '0'){
        $this->load->model('admin/m_menu');
        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("menu/emenu");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('menu/menu/'.$menu.'/'.$menu.'/'.$submenu)."'>Menu</a></li><li><a href='#'>Edit Menu</a></li>";
            $data_bread['active'] = "<h3>Edit Menu</h3>";

            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $send['id'] = $id; 
                $getdata = $this->m_menu->getmenuid($send);
                if($getdata->num_rows() > 0){
                    $data['menu'] = $getdata->row(0)->nama_menu;
                    $data['urutan'] = $getdata->row(0)->urut;
                    $data['link'] = $getdata->row(0)->link;
                    $data['icon'] = $getdata->row(0)->icon;
                    $data['punyasub'] = $getdata->row(0)->punyasub;
                    $data['tampil'] = $getdata->row(0)->tampil;
                    $data['id'] = $getdata->row(0)->id_menu;
                }else{
                    header('location:'.site_url('home/failaccess'));
                }

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/menu/emenu",$data);
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //varsi usgan 0.0.1
    //digunakan untuk mengubah data menu yang telah ada didatabase -> update edit menu -> uemenu
    public function uemenu($id = '0'){
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("menu/uemenu");
        if($checkfungsi->num_rows() > 0){
            $alert = "Update data menu GAGAL";
            $type = "fail";

            $send['id'] = $id;
            $send['nama'] = $this->input->post('nama');
            $send['urutan'] = $this->input->post('urutan');
            $send['link'] = $this->input->post('link');
            $send['icon'] = $this->input->post('icon');
            $send['psub'] = $this->input->post('psub');
            $send['tampil'] = $this->input->post('tampil');
            $send['send'] = $this->input->post('send');

            if($send['nama'] && $send['urutan'] && $send['link'] && $send['send']){
                $hasil = $this->m_menu->updatemenu($send);
                if($hasil == 1){
                    $alert = "Update data menu Berhasil";
                    $type = "success";
                }
            }

            $ar = array('alert' => $alert,'type' => $type);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //versi 0.0.1 usgan
    //digunakan untuk menampilkan informasi menu informasi menu -> imenu
    public function imenu($id = '0'){
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("menu/imenu");
        if($checkfungsi->num_rows() > 0){
            $alert = "Informasi Batal";
            $type = "fail";
            $reload = "false";
            $content = "<h5>Data pengguna yang menggunakan MENU ini diantaranya</h5>";

            $send['send'] = $this->input->post('send');
            if($send['send']){
                $type = "success";
                $data['id'] = $id;
                $info = $this->m_menu->getmenuinfo($data);
                if($info->num_rows() > 0){
                    $content = $content."<ol>";
                    foreach ($info->result() as $mp) {
                        $content = $content."<li>".$mp->nama_level."</li>";                    
                    }
                    $content = $content."</ol>";
                }else{
                    $content = $content." Data Tidak ADA";
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload,'content' => $content);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    
    //versi 0.0.1 usgan
    //digunakan untuk menghapus data menu pada tb_menu delete menu -> dmenu
    public function dmenu($id = '0'){
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("menu/dmenu");
        if($checkfungsi->num_rows() > 0){
            $alert = "Hapus Data Batal";
            $type = "fail";
            $reload = false;
            $content = "<h5>Data pengguna yang menggunakan MENU ini diantaranya</h5>";

            $send['send'] = $this->input->post('send');
            if($send['send']){
                $type = "success";
                $data['id'] = $id;
                $info = $this->m_menu->getmenuinfo($data);
                if($info->num_rows() > 0){
                    $alert = "Hapus data batal disebabkan data mesih digunakan";
                }else{
                    $hasil = $this->m_menu->deletemenu($data);
                    if($hasil > 0){
                        $alert = "Hapus Data Berhasil";
                        $type = "success";
                        $reload = true;
                    }
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload,'content' => $content);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }

    //versi usgan 0.0.1
    //digunakan untuk menambah menu yang digunakan pada tingkatan pengguna create menu pengguna -> cmpengguna
    public function cmpengguna($menu = "",$submenu = ""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_menu');
        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("menu/cmpengguna");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('menu/menu/'.$menu.'/'.$menu.'/'.$submenu)."'>Menu</a></li><li><a href='#'>Menu Pengguna</a></li>";
            $data_bread['active'] = "<h3>Menu Pengguna</h3>";

            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){    
                
                 //setting table
                $this->table->set_template($this->fungsi_umum->getsetting());
                $this->table->set_heading('No', 'Menu', 'Tingkat Pengguna','Link','icon','Punya Sub','Tampil','Aksi');

                $menu_ = $this->m_menu->getmenutp($cari,$page,false);
                $page++;
                foreach ($menu_->result() as $datam) {
                    $c['hapus'] = site_url('menu/dmpengguna/'.$datam->id_lmenu);

                    $this->table->add_row($page++,$datam->nama_menu,$datam->nama_level,$datam->link,"<span class='".$datam->icon."'></span>",$datam->punyasub,$datam->tampil,$this->fungsi_umum->actionbutton($c));
                }
                //end setting table

                //set pagination
                if($countpage == 0){
                    $countpage=$this->m_menu->getmenu($cari,$page,true);
                }

                $this->fungsi_umum->setpagination($countpage,
                    site_url('menu/cmpengguna/'.$menu."/".$submenu.'?cari='.$cari.'&countpage='.$countpage),
                    10,6);
                
                //end set pagination

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['menu_list'] = $this->m_menu->getmenu("",0,0,false,true);
                $data['levelp'] = $this->m_menu->getlevelp();
                $data['cari'] = $cari;

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/menu/cmpengguna",$data);
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //versi usgan 0.0.1
    //digunakan untuk menambah data menu pada tingkatan pengguna add create menu pengguna -> acmpengguna
    public function acmpengguna(){
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("menu/acmenu");
        if($checkfungsi->num_rows() > 0){
            $alert = "Input data menu GAGAL";
            $type = "fail";
            $reload = "false";

            $send['menu'] = $this->input->post('menu');
            $send['tp'] = $this->input->post('tp');
            $send['send'] = $this->input->post('send');

            if($send['menu'] && $send['tp'] && $send['send']){
                if($this->m_menu->cektpmenu($send)->num_rows() == 0){
                    $hasil = $this->m_menu->addmenutp($send);
                    if($hasil == 1){
                        $alert = "Input data menu tingkat pengguna  Berhasil";
                        $type = "success";
                        $reload = true;
                    }
                }else{
                    $alert = "Data telah ada";
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //vaersi usgan 0.0.1
    //digunakan untuk menghapus data menu tingkatan pengguna delete menu pengguna -> dmpengguna
    public function dmpengguna($id = '0'){
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("menu/dmpengguna");
        if($checkfungsi->num_rows() > 0){
            $alert = "Hapus data menu tingkat pengguna GAGAL";
            $type = "fail";
            $reload = "false";

            $send['send'] = $this->input->post('send');

            if($send['send']){
                $data['id'] = $id;
                if($this->m_menu->deletemenutp($data) > 0){
                    $alert = "Hapus data menu tingkat pengguna  Berhasil";
                    $type = "success";
                    $reload = true;
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
}


