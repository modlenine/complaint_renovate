<?php
class Login extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model("login_model");
    }

    public function index(){
        // รับ return_url จาก query string (สำหรับ SSO redirect)
        $return_url = $this->input->get('return_url');
        if ($return_url) {
            // ป้องกัน redirect กลับไปที่ logout (ป้องกัน infinite loop)
            if (stripos($return_url, 'logout') === false && 
                stripos($return_url, 'login') === false) {
                // เก็บ return_url ไว้ใน session เฉพาะที่ไม่ใช่ logout/login
                $this->session->set_userdata('return_url', $return_url);
            }
        }
        
        $ecode = $this->session->userdata('ecode');
        if(empty($ecode)){
            $this->load->view("head/head_code_login");
            $this->load->view("head/javascript");
            $this->load->view("login/loginPage");
        }else{
            // ถ้า login แล้ว redirect กลับไปที่ return_url หรือ base_url
            $redirect_url = $this->session->userdata('return_url');
            if($redirect_url){
                $this->session->unset_userdata('return_url'); // ลบ return_url ออกจาก session
                header("Location: " . $redirect_url);
            }else{
                header("Location: " . base_url());
            }
            exit();
        }
    }

    public function loginPage()
    {
        $this->load->view("head/head_code_login");
        $this->load->view("head/javascript");
        $this->load->view("login/loginPage");
    }

    public function check_login(){
        $this->login_model->check_login();
    }

    public function logout()
    {
        // ลบ session ทั้งหมด
        $this->session->sess_destroy();
        // Redirect ไปหน้า login ของ Intranet
        $url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
        header("Location: " . $url . "/intranet/login/logout");
        exit();
    }

}//****End of controller*****//


?>
