<?php
class Dpengguna extends CI_Controller {

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
    public function show($menu = "",$submenu = ""){

        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_dpengguna');
        $this->load->model('admin/m_menu');

        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("dpengguna/show");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Pengguna</a></li><li><a href='".site_url('dpengguna/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Daftar Pengguna</a></li>";
            $data_bread['active'] = "<h3>Daftar Pengguna</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){
                //setting table
                $this->table->set_template($this->fungsi_umum->getsetting());
                $this->table->set_heading('No', 'Nama Pengguna','Jenis Kelamin','Email','Status','Tingkat Pengguna','Foto','Aksi');

                $send['cari'] = $cari;
                $send['limit'] = $page;
                $send['count'] = false;                
                $menu_ = $this->m_dpengguna->getdata($send);
                $page++;
                foreach ($menu_->result() as $datam) {
                    $c['edit'] = site_url('dpengguna/edit/'.$menu.'/'.$submenu.'/'.$datam->id_pengguna);
                    $c['hapus'] = site_url('dpengguna/delete/'.$datam->id_pengguna);

                    $this->table->add_row($page++,
                        $this->typeencryption->thirdDecryption($datam->nama_pengguna),
                        $datam->jenkel,$this->typeencryption->thirdDecryption($datam->email),$datam->status,$datam->nama_level,$datam->foto_pengguna,$this->fungsi_umum->actionbutton($c));
                }
                //end setting table

                //set pagination
                if($countpage == 0){
                    $send['count'] = true;
                    $countpage=$this->m_dpengguna->getdata($send);
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
                $this->load->view("admin/module_pengguna/data_pengguna/show",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
}