<?php
class Daftartoko extends CI_Controller {

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
    //digunakan untuk menampilkan daftar toko
    public function show($menu = "",$submenu = ""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_daftartoko');
        $this->load->model('admin/m_menu');

        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("Daftartoko/show");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Toko</a></li><li><a href='".site_url('Daftartoko/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Daftar Toko</a></li>";
            $data_bread['active'] = "<h3>Daftar Toko</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){
                //setting table
                $this->table->set_template($this->fungsi_umum->getsetting());
                $this->table->set_heading('No', 'Nama Toko','Pemilik','Email','tgl','Aksi');

                $send['cari'] = $cari;
                $send['limit'] = $page;
                $send['count'] = false;                
                $menu_ = $this->m_daftartoko->getdata($send);
                $page++;
                foreach ($menu_->result() as $datam) {
                    $c['edit'] = site_url('daftartoko/edit/'.$menu.'/'.$submenu.'/'.$datam->id_toko);
                    $c['hapus'] = site_url('daftartoko/delete/'.$datam->id_toko);

                    $this->table->add_row($page++,$datam->nama_toko,$datam->pemilik,$datam->email,$datam->tgl,$this->fungsi_umum->actionbutton($c));
                }
                //end setting table

                //set pagination
                if($countpage == 0){
                    $send['count'] = true;
                    $countpage=$this->m_daftartoko->getdata($send);
                }

                $this->fungsi_umum->setpagination($countpage,
                    site_url('daftartoko/show/'.$menu."/".$submenu.'?cari='.$cari.'&countpage='.$countpage),
                    10,6);
                
                //end set pagination
                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['cari'] = $cari;

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_toko/daftartoko/show",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //digunakan untuk membuka form daftar toko
    public function create($menu = "",$submenu = ""){
        $this->load->model('admin/m_menu');

        $checkfungsi =  $this->m_menu->checklinkmenu("daftartoko/create");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Toko</a></li><li><a href='".site_url('Daftartoko/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Daftar Toko</a></li><li>Tambah toko</li>";
            $data_bread['active'] = "<h3>Tambah Toko</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_toko/daftartoko/create",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function edit($menu = "",$submenu = "",$id = ''){
        $this->load->model('admin/m_menu');
        $this->load->model('admin/m_daftartoko');

        $checkfungsi =  $this->m_menu->checklinkmenu("daftartoko/create");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Toko</a></li><li><a href='".site_url('Daftartoko/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Daftar Toko</a></li><li>Edit toko</li>";
            $data_bread['active'] = "<h3>Edit Toko</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){
                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $send['id'] = $id;
                $toko = $this->m_daftartoko->getdataid($send);
                if($toko->num_rows() > 0){
                    $data['namatoko'] = $toko->row(0)->nama_toko;
                    $data['pemilik'] = $toko->row(0)->pemilik;
                    $data['email'] = $toko->row(0)->email;
                    $data['nohp'] = $toko->row(0)->nohp;
                    $data['informasi'] = $toko->row(0)->informasi;
                    $data['id'] = $toko->row(0)->id_toko;
                }else{
                    header('location:'.site_url('home/failaccess'));
                }
                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_toko/daftartoko/edit",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //digunakan untuk memasukkan data toko kwdalam database
    public function add(){
        $this->load->model('admin/m_daftartoko');
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("daftartoko/add");
        if($checkfungsi->num_rows() > 0){
            $alert = "Input data tingkat pengguna GAGAL";
            $type = "fail";
            $reload = "false";
            
            $send['ntoko'] = $this->input->post('ntoko');
            $send['pemilik'] = $this->input->post('pemilik');
            $send['email'] = $this->input->post('email');
            $send['hp'] = $this->input->post('hp');
            $send['send'] = $this->input->post('send');
            $send['info'] = $this->input->post('info');
            $send['id'] = $this->fungsi_umum->newgetid();

            if($send['ntoko'] && $send['pemilik'] && $send['hp'] && $send['info'] && $send['send']){
               
                $hasil = $this->m_daftartoko->addtoko($send);
                if($hasil > 0){
                    $alert = "Input Data Berhasil";
                    $type = "success";
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //digunakan untuk memperbaharui data toko didalam database
    public function update($id){
        $this->load->model('admin/m_daftartoko');
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("daftartoko/update");
        if($checkfungsi->num_rows() > 0){
            $alert = "Update data GAGAL";
            $type = "fail";
            $reload = "false";
            
            $send['ntoko'] = $this->input->post('ntoko');
            $send['pemilik'] = $this->input->post('pemilik');
            $send['email'] = $this->input->post('email');
            $send['hp'] = $this->input->post('hp');
            $send['send'] = $this->input->post('send');
            $send['info'] = $this->input->post('info');
            $send['id'] = $id;

            if($send['ntoko'] && $send['pemilik'] && $send['hp'] && $send['info'] && $send['send']){
                $hasil = $this->m_daftartoko->updatetoko($send);
                if($hasil > 0){
                    $alert = "Update Data Berhasil";
                    $type = "success";
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //digunakan untuk menghapus data toko berdasarkan id
    public function delete($id = ''){
        $this->load->model('admin/m_daftartoko');
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("daftartoko/delete");
        if($checkfungsi->num_rows() > 0){
            $alert = "Hapus data GAGAL";
            $type = "fail";
            $reload = false;
            $content = "<h5>Data pengguna yang menggunakan MENU ini diantaranya</h5>";

            $send['send'] = $this->input->post('send');
            $send['id'] = $id;

            if($send['send']){
                $valid = $this->m_daftartoko->gettoko_tb_lokasi($send);
                if($valid->num_rows() > 0){
                    $alert = "Hapus Data Gagal. Data toko sementara digunakan di tb_lokasi";
                }else{
                    $hasil = $this->m_daftartoko->deletetoko($send);
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
}