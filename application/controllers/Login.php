<?php
class Login extends CI_Controller {
    
    /*
     * -----------Login Controller----------------
     * -----------Created by Demon (2016-05-14)---
     * -----------Changed Database : auth_table (structure on time changed by varchar 21)
     * -----------Login View() as the index
     */
 
    public function __construct() {
        parent::__construct();
        //get model for database function
        $this->load->model("admin/M_login");
        $this->load->model("admin/M_auth");
        $this->load->model("admin/M_user");
        $this->load->library("typeencryption");
        
        //check the session if session is not empty go to home controller
        if(!empty($_SESSION['user_id'])){
            redirect('home');
        }
    }
    
    //view as the index function
    public function view(){
        $data['notif'] = ""; //start notif is "" so the notification on login view is empty--------------------
        $data['user_verified'] = 0; //using for checking the login view didn't submit the user in login form---
        $this->load->view("admin/login", $data); //load the login view-----------------------------------------
    }
    
    
    //this function is testing function for the encryption from database and login form
    //use it if you want to test or show the encryption process
    public function test(){
        
        echo $this->time().'<br>';
        
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
    //end of test function
    
    public function login(){
        
        //error_reporting(0);                         //don't show the error, warning, and notice message
        $data['notif'] = "";                        //set the notification as empty
        $data['pass_verified'] = 2;                 //set password verified in 2, 
        //take array data from user_table without password
        $data['userdata'] = $this->M_login->user(); //take array data from database user_table into array
        $user = array();                            //set user as empty array
        $data['user'] = array();                    //set data[user] as empty array

        if ($data['userdata']==null)
        {
            $user = array();
        } else {
        //push the user data into $user without password
        array_push($user, array($data['userdata'][0]->user_id, $data['userdata'][0]->username, $data['userdata'][0]->email, $data['userdata'][0]->status));
        }
        //checking if the user in login form is true then push data in $data[user]
        for ($i=0; $i<count($user); $i++){
            if ($this->typeencryption->thirddecryption($user[$i][1])==$this->input->post('username')){
                array_push($data['user'], array($user[$i][0], $user[$i][1], $user[$i][2], $user[$i][3]));
            } else {
                $data['user'] = array();                        //set the user is empty
            }
        }
        //end of checking
       
        $data['user_verified'] = 0;                             //set user verified is 0
        if ($data['user'] != null || !empty($data['user'])){    //check if user is not empty
            $data['user_verified'] = 1;                         //if user is not empty then set user verified is 1 (true)
            $data['username'] = $this->typeencryption->thirddecryption($data['user'][0][1]); //set the username is decrypted from database
            $pass = $this->input->post('password');             //take password post from login form
            //take array data from user_table with password
            $ver = $this->M_login->user_verified();                      
            $data['verified'] = array();                        //set $data['verified'] as an empty array
            if ($pass != "" || $pass != null){                  //check if password in login form is not empty
                if ($ver!=null && $ver!=""){                    //check if data array from user_table is not empty with status is not blocked
                    //checking the username and password is true with standard decryption method
                    for ($j=0; $j<count($ver); $j++){           
                        if (($this->typeencryption->thirddecryption($ver[$j]->username)==$this->input->post('username')) && ($this->typeencryption->seconddecryption($ver[$j]->password)==$this->typeencryption->secondloginencryption($pass))){
                            array_push($data['verified'], array($ver[$j]->user_id, $ver[$j]->username, $ver[$j]->email, $ver[$j]->status));
                        } else{
                            $data['notif'] = "Password Salah";  //set notification if password is false
                            //$this->load->view("admin/login",$data);
                        }
                    }
                    //end of checking
                } else {
                    $data['notif'] = "Masukkan Password";       //set notification if password wasn't submited
                    //$this->load->view("admin/login",$data);
                }
            } else{
            }
            
            //checking if data username and password is true then set pass_verified as 1(true)
            //if data username and password is false then set pass_verified as 0 (false)
            //pass_verified are set by 2 means password field in login form is empty
            if ($data['verified'] != null && $data['verified']!= ""){
                $data['pass_verified'] = 1;
            } else { 
                if ($pass == null || $pass == ""){
                    $data['pass_verified'] = 2;
                } else {
                    $data['pass_verified'] = 0;
                }
            }
            //end of checking the login form
            //checking the username and password are verified
            if ($data['user_verified']==1 && $data['pass_verified']==0){        //true username and false password condition
                $this->falseAuth($data['user'][0][0]);                          //record the username, login time, ip_address and mac_address into auth_table with status is false
                $this->selectionAuth($data['user'][0][0]);                      //checking for brute force attack
                //$this->load->view("admin/login",$data);                       //back to load login view with the username is true and password is false
            } else if ($data['user_verified']==1 && $data['pass_verified']==1){ //true username and true password condition 
                $this->trueAuth($data['verified'][0][0]);                       //record the username, login time ip_address and mac_address into auth_table with status is true
                //set the user_id, ip_address, mac_address, login time in sesi array from login form
                $sesi = array(
                            'user_id' => $data['verified'][0][0],
                            'ip_address' => $this->typeencryption->thirdencryption($this->get_client_ip()),         //encrypt the ip_client
                            'mac_address' => $this->typeencryption->thirdencryption($this->get_real_mac_addr()),    //encrypt the mac address client
                            'time' => $this->time()
                        );
                $this->session->set_userdata($sesi);                            //save the sesi array in userdata session
                $this->in();                                                    //call home in() function means goto home controller
            } else if ($data['user_verified']==1 && $data['pass_verified']==2){ //true username and password is empty
                $this->load->view("admin/login",$data);                         //load login form with true username
            }
            //end of checking
            
        } else {                                    //username from login form is false
            $data['notif'] = "Username Salah";      //set notification 
            $this->load->view("admin/login",$data); //back to login form
        }
    }
    
    //set time on function and returning a time
    public function time(){
        date_default_timezone_set('Asia/Singapore');
        $date = date('Y-m-d H:i:s');
        return $date;
    }
    
    //get client ip function and returning an IP_Address 
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
    
    //get MAC_Address client
    function get_real_mac_addr(){
        exec("ipconfig /all", $arr, $retval);
        $arr[14];
        $ph=explode(":",$arr[14]);
          return trim($ph[1]);
    }
    
    //verify the the is didn't  use for another user
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
    //end of verify function
    
    //record the false authentification function 
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
        $data['time'] = $this->time();
        $data['ip_address'] = $this->typeencryption->thirdEncryption($this->input->ip_address());
        $data['mac_address'] = $this->typeencryption->thirdEncryption($this->get_real_mac_addr());
        $data['status'] = 'F';
        
        //create authetification data table
        $this->M_auth->createAuth($data);
    }
    
    //record the true authentification function
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
        $data['time'] = $this->time();
        $data['ip_address'] = $this->typeencryption->thirdEncryption($this->input->ip_address());
        $data['mac_address'] = $this->typeencryption->thirdEncryption($this->get_real_mac_addr());
        $data['status'] = 'T';
        
        //create authetification data table
        $this->M_auth->createAuth($data);
    }
    
    //selection auth function
    //using for brute force attack
    public function selectionAuth($id){
        $now = date("Y-m-d");
        $data['auth'] = $this->M_auth->authNow($id,$now);
        $user = $this->M_login->userID($id);
        $data['username'] = $this->typeencryption->thirddecryption($user[0]->username);
        $Cdata = count($data['auth']);
        $data['notif'] = "";
        if ($Cdata < 10){
            $data['user_verified'] = 1;
            $this->load->view("admin/login",$data);
        } else if ($Cdata >=10 && $Cdata < 20){
            $data['notif'] = "Apakah Anda Tidak Melupakan Password ?";
            $data['user_verified'] = 1;
            $this->load->view("admin/login",$data);
        } else if ($Cdata >=20 && $Cdata < 30){
            $data['notif'] = "Anda Terblock Selama 20 Menit";
            $data['user_verified'] = 1;
            $this->load->view("admin/login",$data);
        } else if ($Cdata >=30){
            $this->M_user->blockUser($id);
            $data['notif'] = "Anda Terblokir, Silahkan Verifikasi Kembali";
            $data['user_verified'] = 0;
            $this->load->view("admin/login",$data);
        }
        //return $data;
    }
    
    //goto home controller
    public function in(){
        header('location:'.base_url().'index.php/home');
    }
    
    
}


