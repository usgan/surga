<?php
class Toko extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model("admin/M_login");
        $this->load->model("admin/M_auth");
        $this->load->library("typeencryption");
        $this->load->model("M_toko");
        
        
        if($this->session->userdata('id_pengguna')==null) {
            $this->session->set_flashdata('flash_data', 'Anda Tidak Mempunyai Hak Akses!');
                    redirect('Login/view');
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
    
    function index(){
        $this->data();
    }
    
    public function data(){
        //error_reporting(0);
        $data['toko'] = $this->M_toko->data();
        $this->load->view("admin/header");
        $this->load->view("admin/notification");
        $this->load->view("admin/menu");
        $this->load->view("admin/module_toko/toko", $data);
        $this->load->view("admin/navigation");
        $this->load->view("admin/footer");
    }
    
    public function insert(){
        
    }
}


