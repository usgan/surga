<?php
class Smenu extends CI_Controller {
    
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
    //digunakan untuk menampilkan data sub menu yang ada di dalam table tb_smenu
    public function show($menu = '',$submenu =""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_smenu');
        $this->load->model('admin/m_menu');

        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("smenu/show");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('smenu/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Sub Menu</a></li>";
            $data_bread['active'] = "<h3>Sub Menu</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){
                //setting table
                $this->table->set_template($this->fungsi_umum->getsetting());
                $this->table->set_heading('No', 'Menu','Sub Menu','Link','Tampil','Aksi');

                $menu_ = $this->m_smenu->getsubmenu($cari,$page,false);
                $page++;
                foreach ($menu_->result() as $datam) {
                    $c['edit'] = site_url('smenu/edit/'.$menu.'/'.$submenu.'/'.$datam->id_smenu);
                    $c['hapus'] = site_url('smenu/delete/'.$datam->id_smenu);
                    $c['info'] = site_url('smenu/info/'.$datam->id_smenu);

                    $this->table->add_row($page++,$datam->nama_menu,$datam->nama_smenu,$datam->link,$datam->tampil,$this->fungsi_umum->actionbutton($c));
                }
                //end setting table

                //set pagination
                if($countpage == 0){
                    $countpage=$this->m_smenu->getsubmenu($cari,$page,true);
                }

                $this->fungsi_umum->setpagination($countpage,
                    site_url('smenu/show/'.$menu."/".$submenu.'?cari='.$cari.'&countpage='.$countpage),
                    10,6);
                
                //end set pagination
                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['cari'] = $cari;

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/submenu/submenu",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function create($menu = '',$submenu =""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_link');
        $this->load->model('admin/m_menu');

        $checkfungsi =  $this->m_menu->checklinkmenu("smenu/create");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('smenu/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Sub Menu</a></li><li><a href='#'/>Tambah Sub Menu</a></li>";
            $data_bread['active'] = "<h3>Tambah Sub Menu</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['listmenu'] = $this->m_menu->getmenu("",0,false,true,true);

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/submenu/createsmenu",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function edit($menu = '',$submenu ="",$id=""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_link');
        $this->load->model('admin/m_menu');
        $this->load->model('admin/m_smenu');

        $checkfungsi =  $this->m_menu->checklinkmenu("smenu/edit");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('smenu/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Sub Menu</a></li><li><a href='#'/>Edit Sub Menu</a></li>";
            $data_bread['active'] = "<h3>Edit Sub Menu</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){
                $send['id'] = $id;
                $smenu = $this->m_smenu->getsubmenuid($send);
                if($smenu->num_rows() > 0){
                    $data['menu_id'] = $smenu->row(0)->id_menu;   
                    $data['nama_smenu'] = $smenu->row(0)->nama_smenu;   
                    $data['icon'] = $smenu->row(0)->icon;   
                    $data['link'] = $smenu->row(0)->link;   
                    $data['urut'] = $smenu->row(0)->urut;   
                    $data['tampil'] = $smenu->row(0)->tampil;    
                    $data['id'] = $smenu->row(0)->id_smenu;
                }else{
                    header('location:'.site_url('home/failaccess'));
                }
                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['listmenu'] = $this->m_menu->getmenu("",0,false,true,true);

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/submenu/editsmenu",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function add(){
        $this->load->model('admin/m_smenu');
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("smenu/add");
        if($checkfungsi->num_rows() > 0){
            $alert = "Input data link GAGAL";
            $type = "fail";
            $reload = "false";

            $send['menu'] = $this->input->post('menu');
            $send['smenu'] = $this->input->post('smenu');
            $send['link'] = $this->input->post('link');
            $send['urut'] = $this->input->post('urut');
            $send['icon'] = $this->input->post('icon');
            $send['tampil'] = $this->input->post('tampil');
            $send['send'] = $this->input->post('send');

            if($send['menu'] && $send['smenu'] && $send['link'] && $send['urut'] && $send['send']){
                if($this->m_smenu->ceksmenu($send)->num_rows() == 0){
                    $hasil = $this->m_smenu->addsmenu($send);
                    if($hasil > 0){
                        $alert = "Input Data Berhasil";
                        $type = "success";
                    }
                }else{
                    $alert = "Input Data Gagal. Data Telah ada";
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //perintah yang digunakan untuk meperbaharui data sub menu di tabel tb_smenu
    public function update($id = '0'){
        $this->load->model('admin/m_smenu');
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("smenu/update");
        if($checkfungsi->num_rows() > 0){
            $alert = "update data link GAGAL";
            $type = "fail";
            $reload = "false";

            $send['menu'] = $this->input->post('menu');
            $send['smenu'] = $this->input->post('smenu');
            $send['link'] = $this->input->post('link');
            $send['urut'] = $this->input->post('urut');
            $send['icon'] = $this->input->post('icon');
            $send['tampil'] = $this->input->post('tampil');
            $send['send'] = $this->input->post('send');
            $send['id'] = $id;

            if($send['menu'] && $send['smenu'] && $send['link'] && $send['urut'] && $send['send']){
                $periksa = $this->m_smenu->ceksmenu($send);
                if($periksa->num_rows() == 0 || $periksa->row(0)->id_smenu == $id){
                    $hasil = $this->m_smenu->updatesmenu($send);
                    if($hasil > 0){
                        $alert = "update Data Berhasil";
                        $type = "success";
                    }
                }else{
                    $alert = "Input Data Gagal. Data Telah ada";
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function info($id = ""){
        $this->load->model('admin/m_menu');
        $this->load->model('admin/m_smenu');
        $checkfungsi =  $this->m_menu->checklinkmenu("smenu/info");
        if($checkfungsi->num_rows() > 0){
            $alert = "Informasi Batal";
            $type = "fail";
            $reload = "false";
            $content = "<h5>Data pengguna yang menggunakan Sub MENU ini diantaranya</h5>";

            $send['send'] = $this->input->post('send');
            if($send['send']){
                $type = "success";
                $data['id'] = $id;
                $info = $this->m_smenu->getmenuinfo($data);
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
    public function delete($id = ''){
        $this->load->model('admin/m_menu');
        $this->load->model('admin/m_smenu');
        $checkfungsi =  $this->m_menu->checklinkmenu("smenu/delete");
        if($checkfungsi->num_rows() > 0){
            $alert = "Hapus Data Batal";
            $type = "fail";
            $reload = false;
            $content = "<h5>Data pengguna yang menggunakan MENU ini diantaranya</h5>";

            $send['send'] = $this->input->post('send');
            if($send['send']){
                $type = "success";
                $data['id'] = $id;
                $info = $this->m_smenu->getmenuinfo($data);
                if($info->num_rows() > 0){
                    $alert = "Hapus data batal disebabkan data mesih digunakan";
                }else{
                    $hasil = $this->m_smenu->deletesmenu($data);
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
    public function createspengguna($menu = '',$submenu =""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_menu');
        $this->load->model('admin/m_smenu');
        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("smenu/createspengguna");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('smenu/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Sub Menu</a></li><li><a href='#'/>Sub Menu Pengguna</a></li>";
            $data_bread['active'] = "<h3>Sub Menu Pengguna</h3>";

            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){    
                
                 //setting table
                $this->table->set_template($this->fungsi_umum->getsetting());
                $this->table->set_heading('No', 'Menu', 'Sub Menu','Tingkat Pengguna','Link','icon','Tampil','Aksi');

                //perintah yang digunakan untuk mengambil data sub menu tingkat pengguna
                $smenu_ = $this->m_smenu->getsmenutp($cari,$page,false);
                $page++;
                foreach ($smenu_->result() as $datam) {
                    $c['hapus'] = site_url('smenu/deletesmpengguna/'.$datam->id_lsmenu);

                    $this->table->add_row($page++,$datam->nama_menu,$datam->nama_smenu,$datam->nama_level,$datam->link,"<span class='".$datam->icon."'></span>",$datam->tampil,$this->fungsi_umum->actionbutton($c));
                }
                //end setting table

                //set pagination
                if($countpage == 0){
                    $countpage=$this->m_smenu->getsmenutp($cari,$page,true);
                }

                $this->fungsi_umum->setpagination($countpage,
                    site_url('smenu/createspengguna/'.$menu."/".$submenu.'?cari='.$cari.'&countpage='.$countpage),
                    10,6);
                
                //end set pagination

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['menu_list'] = $this->m_smenu->getsubmenu("",0,false,true);
                $data['levelp'] = $this->m_menu->getlevelp();
                $data['cari'] = $cari;

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/submenu/penggunasubmenu",$data);
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //perintah yang dilakukan untuk menambah sub menu pengguna
    public function addsmpengguna(){
        $this->load->model('admin/m_menu');
        $this->load->model('admin/m_smenu');

        $checkfungsi =  $this->m_menu->checklinkmenu("smenu/addsmpengguna");
        if($checkfungsi->num_rows() > 0){
            $alert = "Input data menu GAGAL";
            $type = "fail";
            $reload = "false";

            $send['smenu'] = $this->input->post('smenu');
            $send['tp'] = $this->input->post('tp');
            $send['send'] = $this->input->post('send');

            if($send['smenu'] && $send['tp'] && $send['send']){
                $periksa = $this->m_smenu->ceksubmenupengguna($send);
                if($periksa->num_rows() == 0){
                    $hasil = $this->m_smenu->addsubmenutp($send);
                    if($hasil == 1){
                        $alert = "Input data sub menu tingkat pengguna  Berhasil";
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
    //digunakan untuk menghapus data sub menu pengguna
    public function deletesmpengguna($id = '0'){
        $this->load->model('admin/m_menu');
        $this->load->model('admin/m_smenu');
        $checkfungsi =  $this->m_menu->checklinkmenu("smenu/deletesmpengguna");
        if($checkfungsi->num_rows() > 0){
            $alert = "Hapus data sub menu tingkat pengguna GAGAL";
            $type = "fail";
            $reload = "false";

            $send['send'] = $this->input->post('send');

            if($send['send']){
                $data['id'] = $id;
                if($this->m_smenu->deletesubmenutp($data) > 0){
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