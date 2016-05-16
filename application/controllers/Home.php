<?php
class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model("admin/M_login");
        $this->load->model("admin/M_auth");
        $this->load->library("typeencryption");
        
        if($this->session->userdata('user_id')==null) {
            $this->session->set_flashdata('flash_data', 'Anda Tidak Mempunyai Hak Akses!');
                    redirect('Login/view');
        }
        else{
            $auth = $this->M_auth->authTrue($this->session->userdata('user_id'),$this->session->userdata('time'));
            for ($i=0; $i<count($auth); $i++){
                if ($auth[$i]->user_id==$this->session->userdata('user_id') && 
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
    
    function index(){
        $this->data();
    }
    
    public function data(){
        $this->load->view("admin/header");
        $this->load->view("admin/notification");
        $this->load->view("admin/menu");
        $this->load->view("admin/content");
        $this->load->view("admin/navigation");
        $this->load->view("admin/footer");
    }
}


