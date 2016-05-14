<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TypeEncryption {
    
/* 
 * Encryption Versi Demon 0.0.1 (2016-05-13)
 * Use the third encryption type to encrypt the username and email into database
 * Use the second encryption type to encrypt the password into database
 * Use the first decryption type to validate the username from login form
 * Use the form encryption to encrypt username login form to checking controller
 * After checking controller, decrypt the username form encrypted using formDecryption function
 * 
 * Use second decryption to decrypt the password from database into checking controller
 * Use second 
 * 
 * Use the third encryption type for encrypting database
 * Use the form encryption type for get and post method in form (include the login form)
 */
    protected $CI;
    function __construct(){
        $this->ci =& get_instance();
    }
    
    public function firstEncryption($value) {
        //call AES function
        $this->ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $this->ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        //encrypt using first method
        $encrypted_string = $this->ci->encrypt->encode(md5(md5(sha1(sha1($value)))));
        //returning encrypted $value
        return $encrypted_string;
    }
    
    public function secondEncryption($value){
        //call AES function
        $this->ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $this->ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        //encrypt using first method
        $encrypted_string = $this->ci->encrypt->encode(sha1(sha1(sha1(md5(sha1($value))))));
        //returning encrypted $value
        return $encrypted_string;
    }
    
    public function thirdEncryption($value){
        //call AES function
        $this->ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $this->ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        //encrypt using first method
        $encrypted_string = $this->ci->encrypt->encode($this->ci->encrypt->encode($this->ci->encrypt->encode($value)));
        //returning encrypted $value
        return $encrypted_string;
    }
    
    public function formEncryption($value){
        //call AES function
        $this->ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $this->ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        //encrypt using first method
        $encrypted_string = base64_encode($this->ci->encrypt->encode($value));
        //returning encrypted $value
        return $encrypted_string;
    }
    
    
/* It's Decryption using just for decrypt all from database
 * Using this decryption for login as database
 */
    
    public function firstDecryption($value){
        //call AES function
        $this->ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $this->ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        //decrypt the value using first method
        $decrypted_string = $this->ci->encrypt->decode($value);
        //returning decrypted $value
        return $decrypted_string;
    }
    
    public function secondDecryption($value){
        //call AES function
        $this->ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $this->ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        //decrypt the value using first method
        $decrypted_string = $this->ci->encrypt->decode($value);
        //returning decrypted $value
        return $decrypted_string;
    }
    
    public function thirdDecryption($value){
        //call AES function
        $this->ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $this->ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        //decrypt the value using first method
        $decrypted_string = $this->ci->encrypt->decode($this->ci->encrypt->decode($this->ci->encrypt->decode($value)));
        //returning decrypted $value
        return $decrypted_string;
    }
    
    public function formDecryption($value){
        //call AES function
        $this->ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $this->ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        //decrypt the value using first method
        $decrypted_string = $this->ci->encrypt->decode(base64_decode($value));
        //returning decrypted $value
        return $decrypted_string;
    }
    
    /*
     * Use this function for login decryption as checking the form
     */
    
    public function firstloginEncryption($value){
        //don't use AES for the function
        //AES function just for database security
        $hash = md5(md5(sha1(sha1($value))));
        return $hash;
    }
    
    public function secondloginEncryption($value){
        //don't use AES for the function
        //AES function just for database security
        $hash = sha1(sha1(sha1(md5(sha1($value)))));
        return $hash;
    }
    
}