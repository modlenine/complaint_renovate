<?php

class login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    

    public function escape_string() {
        return mysqli_connect("localhost", "root", "1234", "saleecolour");
    }

    
    public function check_login() {

        $username = mysqli_escape_string($this->escape_string(), isset($_POST['username']) ? ($_POST['username']) : '');
        $password = mysqli_escape_string($this->escape_string(), isset($_POST['password']) ? ($_POST['password']) : '');

        $checkuser = $this->db->query(sprintf("SELECT * FROM member WHERE `username` = '%s' and `password` = '%s' ", $username, $password
        ));
        $checkdata = $checkuser->num_rows();

        if ($checkdata == 0) {
            echo '<script language="javascript">';
            echo 'alert("Username หรือ Password ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง")';
            echo '</script>';
            
            header("refresh:1; url=http://192.190.10.27/complaint/login");
            die();
        } else {
            echo "<h2 style='text-align:center;color:green;margin-top:30px;'>เข้าสู่ระบบสำเร็จ กรุณารอสักครู่ระบบกำลังพาท่านเข้าสู่หน้าโปรแกรม</h2>";
            foreach ($checkuser->result_array() as $r) {
                $_SESSION['username'] = $r['username'];
                $_SESSION['password'] = $r['password'];
                $_SESSION['Fname'] = $r['Fname'];
                $_SESSION['Lname'] = $r['Lname'];
                session_write_close();
                
                

                if ($r['posi'] == 75) {
                    echo "<h3 style='color:green;text-align:center;'>" . "Welcome &nbsp;" . $r['Fname'] . "&nbsp;Permission : Admin" . "</h3>";
                    if ($this->session->userdata('referrer_url')) {
                    //Store in a variable so that can unset the session
                    $redirect_back = $this->session->userdata('referrer_url');
                    $this->session->unset_userdata('referrer_url');
                    header("refresh:1; url=$redirect_back");
                    
                    }else{
                        header("refresh:1; url=http://192.190.10.27/complaint/complaint/");
                    }
                    
                } else if ($r['posi'] == 15) {
                    echo "<h3 style='color:green;text-align:center;'>" . "Welcome &nbsp;" . $r['Fname'] . "&nbsp;Permission : user" . "</h3>";
                    
                    if ($this->session->userdata('referrer_url')) {
                    //Store in a variable so that can unset the session
                    $redirect_back = $this->session->userdata('referrer_url');
                    $this->session->unset_userdata('referrer_url');
//                    redirect($redirect_back);
                    header("refresh:1; url=$redirect_back");
                    
                    }else{
                        header("refresh:1; url=http://192.190.10.27/complaint/complaint/");
                    }
                }
            }
            
            
        }
    }
    
    
    public function call_login() {//*****Check Session******//
        if (isset($_SESSION['username']) == "") {
            echo "<h1 style='text-align:center;margin-top:50px;'>กรุณา Login เข้าสู่ระบบ</h1>";
            header("refresh:2; url=http://192.190.10.27/complaint/login/");
            die();
        }
    }
    
    
    public function getuser(){
        $result = $this->db->query("SELECT * FROM member WHERE username = '".$_SESSION['username']."' ");
        foreach ($result->result_array() as $gu){
            $gu['Fname'];
            $gu['Lname'];
            $gu['ecode'];
            $gu['Dept'];
            $gu['username'];
            $gu['DeptCode'];
        }

        return $gu;
    }
    
    
    public function logout(){
        session_destroy();
        $this->session->unset_userdata('referrer_url');
	header("location:http://192.190.10.27/complaint/login");
    }
    

}//*******End of Model***********//


?>

