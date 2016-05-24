<?php
class Link extends CI_Controller {
    
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
    //digunakan untuk menampilkan data link yang ada di dalam table tb_link
    public function show($menu = '',$submenu =""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_link');
        $this->load->model('admin/m_menu');

        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("link/show");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('link/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Link Pengguna</a></li>";
            $data_bread['active'] = "<h3>Link Pengguna</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){
                //setting table
                $this->table->set_template($this->fungsi_umum->getsetting());
                $this->table->set_heading('No', 'Url', 'Tingkat Pengguna','Fungsi','Keterangan','Aksi');

                $menu_ = $this->m_link->getlink($cari,$page,false);
                $page++;
                foreach ($menu_->result() as $datam) {
                    $c['edit'] = site_url('link/edit/'.$menu.'/'.$submenu.'/'.$datam->id_url);
                    $c['hapus'] = site_url('link/delete/'.$datam->id_url);

                    $this->table->add_row($page++,$datam->url,$datam->nama_level,$datam->fungsi,$datam->keterangan,$this->fungsi_umum->actionbutton($c));
                }
                //end setting table

                //set pagination
                if($countpage == 0){
                    $countpage=$this->m_link->getlink($cari,$page,true);
                }

                $this->fungsi_umum->setpagination($countpage,
                    site_url('link/show/'.$menu."/".$submenu.'?cari='.$cari.'&countpage='.$countpage),
                    10,6);
                
                //end set pagination
                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['cari'] = $cari;

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/link/link",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //versi usgan 0.0.1
    //digunakan untuk membuka halaman membuat link baru
    public function create($menu = '',$submenu = ''){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_link');
        $this->load->model('admin/m_menu');

        $checkfungsi =  $this->m_menu->checklinkmenu("link/create");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('link/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Link Pengguna</a></li><li><a href='#'/>Tambah Link</a></li>";
            $data_bread['active'] = "<h3>Tambah Link</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['levelp'] = $this->m_menu->getlevelp();

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/link/createlink",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function add(){
        $this->load->model('admin/m_link');
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("link/add");
        if($checkfungsi->num_rows() > 0){
            $alert = "Input data link GAGAL";
            $type = "fail";
            $reload = "false";

            $send['pengguna'] = $this->input->post('pengguna');
            $send['url'] = $this->input->post('url');
            $send['fungsi'] = $this->input->post('fungsi');
            $send['keterangan'] = $this->input->post('keterangan');
            $send['send'] = $this->input->post('send');

            if($send['pengguna'] && $send['url'] && $send['keterangan'] && $send['fungsi'] && $send['send']){
                if($this->m_link->ceklink($send)->num_rows() == 0){
                    $hasil = $this->m_link->addlink($send);
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
    //digunakan untuk membuka halam edit link
    public function edit($menu = '',$submenu = '',$id = ''){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_link');
        $this->load->model('admin/m_menu');

        $checkfungsi =  $this->m_menu->checklinkmenu("link/edit");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Menu Admin</a></li><li><a href='".site_url('link/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Link Pengguna</a></li><li><a href='#'/>Edit Link</a></li>";
            $data_bread['active'] = "<h3>Edit Link</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['levelp'] = $this->m_menu->getlevelp();

                $link = $this->m_link->getlinkid($id);
                if($link->num_rows() > 0){
                    $data['id'] = $link->row(0)->id_url;
                    $data['id_level'] = $link->row(0)->id_level;
                    $data['url'] = $link->row(0)->url;
                    $data['fungsi'] = $link->row(0)->fungsi;
                    $data['keterangan'] = $link->row(0)->keterangan;
                }else{
                    header('location:'.site_url('home/failaccess'));
                }
                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_menu/link/editlink",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function update($id = ''){
        $this->load->model('admin/m_link');
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("link/update");
        if($checkfungsi->num_rows() > 0){
            $alert = "Update data link GAGAL";
            $type = "fail";
            $reload = "false";

            $send['pengguna'] = $this->input->post('pengguna');
            $send['url'] = $this->input->post('url');
            $send['fungsi'] = $this->input->post('fungsi');
            $send['keterangan'] = $this->input->post('keterangan');
            $send['send'] = $this->input->post('send');
            $send['id'] = $id;

            if($send['pengguna'] && $send['url'] && $send['keterangan'] && $send['fungsi'] && $send['send']){
                if($this->m_link->ceklink($send)->num_rows() == 0){
                    $hasil = $this->m_link->updatelink($send);
                    if($hasil > 0){
                        $alert = "Update Data Berhasil";
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
    //perintah yang digunakan untuk menghapus data link yang terdapat pada tb_link
    public function delete($id = ''){
        $this->load->model('admin/m_menu');
        $this->load->model('admin/m_link');

        $checkfungsi =  $this->m_menu->checklinkmenu("link/delete");
        if($checkfungsi->num_rows() > 0){
            $alert = "Hapus Data Batal";
            $type = "fail";
            $reload = false;
            $content = "";

            $send['send'] = $this->input->post('send');
            if($send['send']){
                $type = "success";
                $data['id'] = $id;

                $hasil = $this->m_link->delete($data);
                if($hasil > 0){
                    $alert = "Hapus Data Berhasil";
                    $type = "success";
                    $reload = true;
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload,'content' => $content);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
}