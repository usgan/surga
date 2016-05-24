<?php
class Home extends CI_Controller {
    
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
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function pengguna(){
        $data_m["menu"] = $this->fungsi_umum->getmenu("","");
        $this->load->view("admin/header");
        $this->load->view("admin/notification");
        $this->load->view("admin/menu",$data_m);
        $this->load->view("admin/content");
        $this->load->view("admin/navigation");
        $this->load->view("admin/footer");
    }
    
    function index(){
        $this->data();
    }
    
    public function data(){
        $data_m["menu"] = $this->fungsi_umum->getmenu("","");
        
        $this->load->view("admin/header");
        $this->load->view("admin/notification");
        $this->load->view("admin/menu",$data_m);
        $this->load->view("admin/breadcrumb");
        $this->load->view("admin/content");
        $this->load->view("admin/navigation");
        $this->load->view("admin/footer");
    }
    public function failaccess(){
        echo "Halaman Tidak Dapat Anda Akses";
    }
}


