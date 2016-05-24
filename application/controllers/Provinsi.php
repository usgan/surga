<?php
class Provinsi extends CI_Controller {

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
    //digunakan untuk menampilkan data provinsi pada table dati tabel tb_provinsi
    public function show($menu = "",$submenu = ""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_kategori');
        $this->load->model('admin/m_menu');

        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("provinsi/show");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Data Area</a></li><li><a href='".site_url('provinsi/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Daftar Provinsi</a></li>";
            $data_bread['active'] = "<h3>Daftar Provinsi</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){
                //setting table
                $this->table->set_template($this->fungsi_umum->getsetting());
                $this->table->set_heading('No', 'Kategori','Gambar','Keterangan','Aksi');
                
                $send['cari'] = $cari;
                $send['limit'] = $page;
                $send['count'] = false;                
                $menu_ = $this->m_kategori->getdata($send);
                $page++;
                foreach ($menu_->result() as $datam) {
                    $c['edit'] = site_url('kategori/edit/'.$menu.'/'.$submenu.'/'.$datam->id_kategori);
                    $c['hapus'] = site_url('kategori/delete/'.$datam->id_kategori);

                    $this->table->add_row($page++,$datam->nama,"<img  src='".base_url('assets/image/kategori/'.$datam->gambar)."' class='img-responsive img-thumbnail img-table'>",$datam->keterangan,$this->fungsi_umum->actionbutton($c));
                }
                //end setting table

                //set pagination
                if($countpage == 0){
                    $send['count'] = true;
                    $countpage=$this->m_kategori->getdata($send);
                }

                $this->fungsi_umum->setpagination($countpage,
                    site_url('kategori/show/'.$menu."/".$submenu.'?cari='.$cari.'&countpage='.$countpage),
                    10,6);
                
                //end set pagination
                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['cari'] = $cari;

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_toko/kategori/show",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }

}