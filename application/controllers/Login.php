<?php
class Login extends CI_Controller {
    
   // var $CI = null;
    
    public function __construct() {
        parent::__construct();
        $this->load->model("admin/M_login");
    }
    
    public function view(){
        $data['user_verified'] = 0;
        $this->load->view("admin/login", $data);
    }

    public function login(){
        $data['pass_verified'] = 0;
        $data['user'] = $this->M_login->user($this->input->post('user'));
        $data['status'] = $data['user'][0]->status;
        $data['user_verified'] = 0;
        if ($data['user'] != null || $data['user'] != ""){
            $data['user_verified'] = 1;
            $data['username'] = $data['user'][0]->username;
            $data['verified'] = $this->M_login->user_verified($this->input->post('user'), $this->input->post('password'));
            if ($data['verified'] != null && $data['verified']!= ""){
                $data['pass_verified'] = 1;
            } else { $data['pass_verified'] = 0; }
            
            if ($data['user_verified']==1 && $data['pass_verified']==0){
                $this->load->view("admin/login",$data);
            } else if ($data['user_verified']==1 && $data['pass_verified']==1){
                $this->auth();
            }
        } else {
            $this->view();
        }
    }
    
    function get_client_ip() {
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    
    public function auth(){
        $ip_addr = $this->input->ip_address();
        echo $ip_addr;
        $mac_address = $this->get_real_mac_addr();
        echo "mac : ".$mac_address;
    }
    
    public function in(){
        header('location:'.base_url().'index.php/home');
    }
    
    function get_real_mac_addr(){
        exec("ipconfig /all", $arr, $retval);
        $arr[14];
        $ph=explode(":",$arr[14]);
          return trim($ph[1]);
    }
}


