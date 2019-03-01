<?php
class Login extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->model("login_model");
    }
    
    public function index(){
        $this->load->library('user_agent');
        $this->session->set_userdata('referrer_url', $this->agent->referrer() );
        
        $this->load->view("head/head_code_login");
        $this->load->view("head/javascript");
        
        if(isset($_SESSION['username']) == ""){
           $this->load->view("login/index"); 
           
        }else{
            header("refresh:0; url=http://192.190.10.27/complaint/");
        }
        
        

    }
    
    
    public function check_login(){
        $this->login_model->check_login();
    }
    
    
    
    
}//****End of controller*****//


?>

