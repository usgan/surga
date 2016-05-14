<?php
class Login extends CI_Controller {
    
    
 
    public function __construct() {
        parent::__construct();
        $this->load->model("admin/M_login");
        $this->load->model("admin/M_auth");
        $this->load->model("admin/M_user");
        $this->load->library("typeencryption");
        
        if(!empty($_SESSION['user_id'])){
            redirect('home');
        }
    }
    
    public function view(){
        $data['notif'] = "";
        $data['user_verified'] = 0;
        $this->load->view("admin/login", $data);
    }
    
    public function enc($value){
        $this->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $this->encrypt->set_mode(MCRYPT_MODE_CBC);
        //encrypt using first method
        $encrypted_string = md5(md5(sha1(sha1($value))));
        //returning encrypted $value
        return $encrypted_string;
    }

    public function tes(){
        
        $tes = $this->typeencryption->secondEncryption('password');
        echo 'ini database : '.$tes.'<br>';
        echo 'strlen : '.strlen($tes).'<br>';
        
        $de = $this->typeencryption->secondDecryption($tes);
        echo 'ini hasil decrypt database : '.$de.'<br>';
       
        $ini = $this->typeencryption->formencryption($de);
        echo 'ini form encrypt : '.$ini.'<br>';
        echo "strlen : ".strlen($ini)."<br>";
        
        $itu = $this->typeencryption->formdecryption($ini);
        echo 'ini form decrypt : '.$itu.'<br>';
        
        $en = $this->typeencryption->secondloginEncryption('password');
        echo 'ini login form : '.$en.'<br>';
    }
    
    public function login(){
        $data['notif'] = "";
        $data['pass_verified'] = 2;
        //$data['status'] = $data['user'][0]->status;
        //take array data from user_table without password
        $data['userdata'] = $this->M_login->user();
        $user = array();
        $data['user'] = array();
        array_push($user, array($data['userdata'][0]->user_id, $data['userdata'][0]->username, $data['userdata'][0]->email, $data['userdata'][0]->status));
        for ($i=0; $i<count($user); $i++){
            if ($this->typeencryption->thirddecryption($user[$i][1])==$this->input->post('username')){
                array_push($data['user'], array($user[$i][0], $user[$i][1], $user[$i][2], $user[$i][3]));
            } else {
                $data['user'] = array();
            }
        }
       
        $data['user_verified'] = 0;
        if ($data['user'] != null || !empty($data['user'])){
            $data['user_verified'] = 1;
            $data['username'] = $this->typeencryption->thirddecryption($data['user'][0][1]);
            $pass = $this->input->post('password');
            //take array data from user with password
            $ver = $this->M_login->user_verified();
            $data['check'] = array();
            $data['verified'] = array();
            //array_push($data['check'], array($ver[0]->user_id, $ver[0]->username, $ver[0]->email, $ver[0]->status));
            if ($pass != "" || $pass != null){
                if ($ver!=null && $ver!=""){
                    for ($j=0; $j<count($ver); $j++){
                        if (($this->typeencryption->thirddecryption($ver[$j]->username)==$this->input->post('username')) && ($this->typeencryption->seconddecryption($ver[$j]->password)==$this->typeencryption->secondloginencryption($pass))){
                            array_push($data['verified'], array($ver[$j]->user_id, $ver[$j]->username, $ver[$j]->email, $ver[$j]->status));
                        } else{
                            $data['notif'] = "Password Salah";
                            //$this->load->view("admin/login",$data);
                        }
                    }
                } else {
                    $data['notif'] = "Masukkan Password";
                    $this->load->view("admin/login",$data);
                }
            } else{
            }
            
            if ($data['verified'] != null && $data['verified']!= ""){
                $data['pass_verified'] = 1;
            } else { 
                if ($pass == null || $pass == ""){
                    $data['pass_verified'] = 2;
                } else {
                    $data['pass_verified'] = 0;
                }
            }
            
            if ($data['user_verified']==1 && $data['pass_verified']==0){
                $this->falseAuth($data['user'][0][0]);
                $this->load->view("admin/login",$data);
            } else if ($data['user_verified']==1 && $data['pass_verified']==1){
                $this->trueAuth($data['verified'][0][0]);
                $sesi = array(
                            'user_id' => $data['verified'],
                            'ip_addr' => $this->get_client_ip(),
                            'mac_address' => $this->get_real_mac_addr()
                        );
                        $this->session->set_userdata($sesi);
                $this->in();
            } else if ($data['user_verified']==1 && $data['pass_verified']==2){
                $this->load->view("admin/login",$data);
            }
            
        } else {
            $data['notif'] = "Username Salah";
            $this->load->view("admin/login",$data);
        }
    }
    
    public function time(){
        echo $date = date('Y-m-d H:i:s');
        return $date;
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
    
    public function verify($id){
        $data = $this->M_auth->auth($id);
        $Cdata = count($data);
        $auth_id = "";
        if ($data==null || $Cdata == 0){
            $auth_id = $id;
        } else {
            $auth = rand(2, 9999);
            if (strlen($auth) == 1){
                $auth_id = 'auth000'.$auth;
            } else if (strlen($auth) ==  2){
                $auth_id = 'auth00'.$auth;
            } else if (strlen($auth) ==  3){
                $auth_id = 'auth0'.$auth;
            } else if (strlen($auth) ==  4){
                $auth_id = 'auth'.$auth;
            } else {
                $auth_id = 'auth'.rand(1000, 9999);
            }
            $this->verify($auth_id);
        }
        return $auth_id;
    }
    
    public function falseAuth($id){
        $auth_id = rand(2, 9999);
        if (strlen($auth_id) == 1){
            $data['auth_id'] = 'auth000'.$auth_id;
        } else if (strlen($auth_id) ==  2){
            $data['auth_id'] = 'auth00'.$auth_id;
        } else if (strlen($auth_id) ==  3){
            $data['auth_id'] = 'auth0'.$auth_id;
        } else if (strlen($auth_id) ==  4){
            $data['auth_id'] = 'auth'.$auth_id;
        } else {
            $data['auth_id'] = 'auth'.rand(1000, 9999);
        }
        $data['auth_id'] = $this->verify($data['auth_id']);
        $data['user_id'] = $id;
        $data['ip_address'] = $this->typeencryption->thirdEncryption($this->input->ip_address());
        $data['mac_address'] = $this->typeencryption->thirdEncryption($this->get_real_mac_addr());
        $data['status'] = 'F';
        
        //create authetification data table
        $this->M_auth->createAuth($data);
    }
    
    public function trueAuth($id){
        $auth_id = rand(2, 9999);
        if (strlen($auth_id) == 1){
            $data['auth_id'] = 'auth000'.$auth_id;
        } else if (strlen($auth_id) ==  2){
            $data['auth_id'] = 'auth00'.$auth_id;
        } else if (strlen($auth_id) ==  3){
            $data['auth_id'] = 'auth0'.$auth_id;
        } else if (strlen($auth_id) ==  4){
            $data['auth_id'] = 'auth'.$auth_id;
        } else {
            $data['auth_id'] = 'auth'.rand(1000, 9999);
        }
        $data['auth_id'] = $this->verify($data['auth_id']);
        $data['user_id'] = $id;
        $data['ip_address'] = $this->typeencryption->thirdEncryption($this->input->ip_address());
        $data['mac_address'] = $this->typeencryption->thirdEncryption($this->get_real_mac_addr());
        $data['status'] = 'T';
        
        //create authetification data table
        $this->M_auth->createAuth($data);
    }
    
    public function selectionAuth($id='user000'){
        $now = date("Y-m-d");
        $data['auth'] = $this->M_auth->auth($id,$now);
        $user = $this->M_login->userID($id);
        $data['username'] = $user[0]->username;
        $Cdata = count($data['auth']);
        $data['notif'] = "";
        if ($Cdata < 10){
            $data['user_verified'] = 1;
            $this->load->view("admin/login",$data);
        } else if ($Cdata >=10 ){
            $data['notif'] = "Apakah Anda Tidak Melupakan Password ?";
            $data['user_verified'] = 1;
            $this->load->view("admin/login",$data);
        } else if ($Cdata >=20){
            $data['notif'] = "Anda Terblock Selama 20 Menit";
            $data['user_verified'] = 1;
            $this->load->view("admin/login",$data);
        } else if ($Cdata >=30){
            $this->M_user->blockUser($id);
            $data['notif'] = "Anda Terblokir, Silahkan Verifikasi Kembali";
            $data['user_verified'] = 1;
            $this->load->view("admin/login",$data);
        }
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


