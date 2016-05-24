<?php
class Tpengguna extends CI_Controller {

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
    //digunakan untuk menampilkan data sub tingkat pengguna yang ada di dalam table tb_level
    public function show($menu = "",$submenu = ""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_tpengguna');
        $this->load->model('admin/m_menu');

        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("tpengguna/show");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Pengguna</a></li><li><a href='".site_url('tpengguna/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Daftar Tingkat Pengguna</a></li>";
            $data_bread['active'] = "<h3>Daftar Tingkat Pengguna</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){
                //setting table
                $this->table->set_template($this->fungsi_umum->getsetting());
                $this->table->set_heading('No', 'Nama Level','Status Toko','Keterangan','Aksi');
                
                $send['cari'] = $cari;
                $send['limit'] = $page;
                $send['count'] = false;                
                $menu_ = $this->m_tpengguna->getdata($send);
                $page++;
                foreach ($menu_->result() as $datam) {
                    $c['edit'] = site_url('tpengguna/edit/'.$menu.'/'.$submenu.'/'.$datam->id_level);
                    $c['hapus'] = site_url('tpengguna/delete/'.$datam->id_level);

                    $this->table->add_row($page++,$datam->nama_level,$datam->statustoko,$datam->keterangan,$this->fungsi_umum->actionbutton($c));
                }
                //end setting table

                //set pagination
                if($countpage == 0){
                    $send['count'] = true;
                    $countpage=$this->m_tpengguna->getdata($send);
                }

                $this->fungsi_umum->setpagination($countpage,
                    site_url('tpengguna/show/'.$menu."/".$submenu.'?cari='.$cari.'&countpage='.$countpage),
                    10,6);
                
                //end set pagination
                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['cari'] = $cari;

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_pengguna/tingkat_pengguna/show",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function create($menu = '',$submenu =""){
      
        $this->load->model('admin/m_link');
        $this->load->model('admin/m_menu');

        $checkfungsi =  $this->m_menu->checklinkmenu("tpengguna/create");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Pengguna</a></li><li><a href='".site_url('tpengguna/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Tingkat Pengguna</a></li><li><a href='#'/>Tambah Tinggkat Pengguna</a></li>";
            $data_bread['active'] = "<h3>Tambah Tingkat Pengguna</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['listmenu'] = $this->m_menu->getmenu("",0,false,true,true);

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_pengguna/tingkat_pengguna/create",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function edit($menu = '',$submenu ="",$id=""){

        $this->load->model('admin/m_link');
        $this->load->model('admin/m_menu');
        $this->load->model('admin/m_tpengguna');

        $checkfungsi =  $this->m_menu->checklinkmenu("tpengguna/edit");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Pengguna</a></li><li><a href='".site_url('tpengguna/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Tingkat Pengguna</a></li><li><a href='#'/>Edit Tinggkat Pengguna</a></li>";
            $data_bread['active'] = "<h3>Edit Tingkat Pengguna</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){
                $send['id'] = $id;
                $tp = $this->m_tpengguna->getdataid($send);
                if($tp->num_rows() > 0){
                    $data['ntp'] = $tp->row(0)->nama_level;
                    $data['keterangan'] = $tp->row(0)->keterangan;
                    $data['sttoko'] = $tp->row(0)->statustoko;
                    $data['id'] = $tp->row(0)->id_level;
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
                $this->load->view("admin/module_pengguna/tingkat_pengguna/edit",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //perintah yang digunakan untuk manambah data tingkat pengguna
    public function add(){
        $this->load->model('admin/m_tpengguna');
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("tpengguna/add");
        if($checkfungsi->num_rows() > 0){
            $alert = "Input data tingkat pengguna GAGAL";
            $type = "fail";
            $reload = "false";

            $send['ntp'] = $this->input->post('ntp');
            $send['sttoko'] = $this->input->post('sttoko');
            $send['keterangan'] = $this->input->post('keterangan');
            $send['send'] = $this->input->post('send');

            if($send['ntp'] && $send['sttoko'] && $send['keterangan'] && $send['send']){
               
                $hasil = $this->m_tpengguna->addtpengguna($send);
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
    //perintah yang digunakan untuk memperbaharui data tingkat pengguna
    public function update($id = 0){
        $this->load->model('admin/m_tpengguna');
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("tpengguna/update");
        if($checkfungsi->num_rows() > 0){
            $alert = "Input data tingkat pengguna GAGAL";
            $type = "fail";
            $reload = "false";

            $send['ntp'] = $this->input->post('ntp');
            $send['sttoko'] = $this->input->post('sttoko');
            $send['keterangan'] = $this->input->post('keterangan');
            $send['id'] = $id;

            $send['send'] = $this->input->post('send');

            if($send['ntp'] && $send['sttoko'] && $send['keterangan'] && $send['send']){
               
                $hasil = $this->m_tpengguna->updatetpengguna($send);
                if($hasil > 0){
                    $alert = "update Data Berhasil";
                    $type = "success";
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function delete($id = ''){
        $this->load->model('admin/m_menu');
        $this->load->model('admin/m_tpengguna');
        $checkfungsi =  $this->m_menu->checklinkmenu("tpengguna/delete");
        if($checkfungsi->num_rows() > 0){
            $alert = "Hapus Data Batal";
            $type = "fail";
            $reload = false;
            $content = "<h5>Data pengguna yang menggunakan MENU ini diantaranya</h5>";

            $send['send'] = $this->input->post('send');
            if($send['send']){
                $type = "success";
                $data['id'] = $id;
                $info = $this->m_tpengguna->cektb_pengguna($data);
                if($info->num_rows() > 0){
                    $alert = "Hapus data batal disebabkan data mesih digunakan oleh data pengguna";
                }else{
                    $info = $this->m_tpengguna->cektb_lsmenu($data);
                    if($info->num_rows() > 0){
                        $alert = "Hapus data batal disebabkan data mesih digunakan oleh data sub menu";
                    }else{
                        $info = $this->m_tpengguna->cektb_lmenu($data);
                        if($info->num_rows() > 0){
                          $alert = "Hapus data batal disebabkan data mesih digunakan oleh data menu";  
                        }else{
                            $hasil = $this->m_tpengguna->deletetpengguna($data);
                            if($hasil > 0){
                                $alert = "Hapus Data Berhasil";
                                $type = "success";
                                $reload = true;
                            }
                        }
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