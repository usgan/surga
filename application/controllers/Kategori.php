<?php
class Kategori extends CI_Controller {

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
    //digunakan untuk menampilkan data kategori pada table dati tabel tb_kategori
    public function show($menu = "",$submenu = ""){
        $countpage = $this->input->get('countpage');
        $page = $this->input->get('per_page');
        $cari = $this->input->get('cari');

        $this->load->model('admin/m_kategori');
        $this->load->model('admin/m_menu');

        $this->load->library('table');
        $checkfungsi =  $this->m_menu->checklinkmenu("kategori/show");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Toko</a></li><li><a href='".site_url('kategori/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Daftar Kategori</a></li>";
            $data_bread['active'] = "<h3>Daftar Kateogri</h3>";
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
    //digunakan untuk membuka form kategori yang digunakan membuat kategori baru
    public function create($menu = "",$submenu = ""){
        $this->load->model('admin/m_kategori');
        $this->load->model('admin/m_menu');

        $checkfungsi =  $this->m_menu->checklinkmenu("kategori/create");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Toko</a></li><li><a href='".site_url('kategori/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Daftar Kategori</a></li><li><a href='#'>Tambah Kategori</a></li>";
            $data_bread['active'] = "<h3>Tambah Kateogri</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['listmenu'] = $this->m_menu->getmenu("",0,false,true,true);

                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_toko/kategori/create",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    //digunakan untuk membuka form kategori yang digunakan membuat kategori baru
    public function edit($menu = "",$submenu = "",$id = ""){
        $this->load->model('admin/m_kategori');
        $this->load->model('admin/m_menu');

        $checkfungsi =  $this->m_menu->checklinkmenu("kategori/edit");
        if($checkfungsi->num_rows() > 0){
            $data_bread['breadcrumb'] = "<li><a href='#'>Toko</a></li><li><a href='".site_url('kategori/show/'.$menu.'/'.$menu.'/'.$submenu)."'>Daftar Kategori</a></li><li><a href='#'>Edit Kategori</a></li>";
            $data_bread['active'] = "<h3>Edit Kateogri</h3>";
            $data_m["menu"] = $this->fungsi_umum->getmenu($menu,$submenu);
            if($checkfungsi->row(0)->fungsi == "#"){

                $data['menu'] = $menu;
                $data['submenu'] = $submenu;
                $data['listmenu'] = $this->m_menu->getmenu("",0,false,true,true);
                $send['id'] = $id;
                $kategori = $this->m_kategori->getdataid($send);
                if($kategori->num_rows() > 0){
                    $data['nama'] = $kategori->row(0)->nama;
                    $data['gambar'] = $kategori->row(0)->gambar;
                    $data['keterangan'] = $kategori->row(0)->keterangan;
                    $data['id'] = $kategori->row(0)->id_kategori;
                }
                $this->load->view("admin/header");
                $this->load->view("admin/notification");
                $this->load->view("admin/menu",$data_m);
                $this->load->view("admin/breadcrumb",$data_bread);
                $this->load->view("admin/module_toko/kategori/edit",$data);
                $this->load->view("admin/navigation");
                $this->load->view("admin/footer");
            }
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function add(){
        $this->load->model('admin/m_kategori');
        $this->load->model('admin/m_menu');
        $checkfungsi =  $this->m_menu->checklinkmenu("kategori/add");
        if($checkfungsi->num_rows() > 0){
            $alert = "Input data Kategori GAGAL";
            $alertgambar = "";
            $type = "fail";
            $reload = "false";
            $gambar = '';

            $send['nkategori'] = $this->input->post('nkategori');
            $send['info'] = $this->input->post('info');
            $send['send'] = $this->input->post('send');
            $send['gambar'] = '';
            if($send['nkategori'] && $send['info'] && $send['send']){

                $config['upload_path']          = './assets/image/kategori/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 40;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('image')){
                    $alertgambar = " dan upload gambar gagal. silahkan periksa kembali gambar anda";
                }
                else
                {
                    $data = $this->upload->data();
                    $gambar = $data['file_name'];
                }
                $send['gambar'] = $gambar;
                $hasil = $this->m_kategori->addkategori($send);
                if($hasil > 0){
                    $alert = "Input Data Berhasil ".$alertgambar;
                    $type = "success";
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function update($id = ""){
        $this->load->model('admin/m_kategori');
        $this->load->model('admin/m_menu');
        $this->load->helper('file');

        $checkfungsi =  $this->m_menu->checklinkmenu("kategori/add");
        if($checkfungsi->num_rows() > 0){
            $alert = "Update kategori GAGAL";
            $alertgambar = "";
            $type = "fail";
            $reload = "false";
            $gambar = '';

            $send['nkategori'] = $this->input->post('nkategori');
            $send['info'] = $this->input->post('info');
            $send['id'] = $id;
            $send['send'] = $this->input->post('send');
            $send['gambar'] = '';
            if($send['nkategori'] && $send['info'] && $send['send']){

                    $config['upload_path']          = './assets/image/kategori/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 40;
                    $config['max_width']            = 5000;
                    $config['max_height']           = 5000;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('image')){
                        $alertgambar = " dan Tidak terjadi perubahan data gambar";
                    }
                    else
                    {
                        //perintah yang digunakan untuk menghapus file gambar sesuai dengan yang ada di database
                        $g['id'] = $id;
                        $gambar = $this->m_kategori->getdataid($g);
                        if($gambar->num_rows()>0){
                            $path = './assets/image/kategori/'.$gambar->row(0)->gambar;
                            if(read_file($path)){
                                unlink($path);
                            }
                        }
                        //end perintah yang digunakan untuk menghapus file gambar sesuai dengan yang ada di database
                        $alertgambar = " dan anda mengubah data gambar";
                        $data = $this->upload->data();
                        $gambar = $data['file_name'];
                    }
                

                $send['gambar'] = $gambar;
                $hasil = $this->m_kategori->updatekategori($send);
                if($hasil > 0){
                    $alert = "Update Data Berhasil ".$alertgambar;
                    $type = "success";
                }else{
                    $alert = $alert.' '.$alertgambar;
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }
    public function delete($id = ""){
        $this->load->model('admin/m_kategori');
        $this->load->model('admin/m_menu');
        $this->load->helper('file');

        $checkfungsi =  $this->m_menu->checklinkmenu("kategori/delete");
        if($checkfungsi->num_rows() > 0){
            $alert = "Hapus GAGAL";
            $alertgambar = "";
            $type = "fail";
            $reload = false;
            $gambar = '';

            $send['id'] = $id;
            $send['send'] = $this->input->post('send');

            if($send['send']){
                //perintah yang digunakan untuk menghapus file gambar sesuai dengan yang ada di database
                $gambar = $this->m_kategori->getdataid($send);
                if($gambar->num_rows()>0){
                    $path = './assets/image/kategori/'.$gambar->row(0)->gambar;
                    if(read_file($path)){
                        unlink($path);
                    }
                }
                //end perintah yang digunakan untuk menghapus file gambar sesuai dengan yang ada di database
                $hasil = $this->m_kategori->deletekategori($send);
                if($hasil > 0){
                    $alert = "Hapus Data Berhasil ".$alertgambar;
                    $type = "success";
                    $reload = true;
                }else{
                    $alert = $alert.' '.$alertgambar;
                }
            }
            $ar = array('alert' => $alert,'type' => $type,'reload' => $reload);
            echo json_encode($ar);
        }else{
            header('location:'.site_url('home/failaccess'));
        }
    }

}