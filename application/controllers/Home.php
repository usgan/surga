<?php
class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index(){
        
        $this->home();
    }
    
    public function home(){
        $this->load->view("admin/header");
        $this->load->view("admin/notification");
        $this->load->view("admin/menu");
        $this->load->view("admin/content");
        $this->load->view("admin/navigation");
        $this->load->view("admin/footer");
    }
}


