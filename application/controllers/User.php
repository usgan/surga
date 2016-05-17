<?php
class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model("admin/M_user");
    }
    
    public function data(){
        
        $data['user'] = $this->M_user->user();
        
        $this->load->view("admin/header");
        $this->load->view("admin/notification");
        $this->load->view("admin/menu");
        $this->load->view("admin/module_settings/user", $data);
        $this->load->view("admin/navigation");
        $this->load->view("admin/footer");
    }
}


