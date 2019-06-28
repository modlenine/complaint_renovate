<?php

class login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


    public function escape_string() {
        return mysqli_connect("192.190.2.3", "pasakorn", "Palm2018", "saleecolour");
    }


    public function check_login() {
// เข้ารหัส input
        $username = mysqli_escape_string($this->escape_string(), isset($_POST['username']) ? ($_POST['username']) : '');
        $password = mysqli_escape_string($this->escape_string(), isset($_POST['password']) ? md5($_POST['password']) : '');

        $checkuser = $this->db->query(sprintf("SELECT * FROM member WHERE `username` = '%s' and `password` = '%s' ", $username, $password
        ));

        $checkdata = $checkuser->num_rows();

        if ($checkdata == 0) {
            echo '<script language="javascript">';
            echo 'alert("Username หรือ Password ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง")';
            echo '</script>';

            header("refresh:1; url=http://203.107.156.180/intsys/complaint/login");
            die();
        } else {
            echo "<h2 style='text-align:center;color:green;margin-top:30px;'>เข้าสู่ระบบสำเร็จ กรุณารอสักครู่ระบบกำลังพาท่านเข้าสู่หน้าโปรแกรม</h2>";

            foreach ($checkuser->result_array() as $r) {
                $_SESSION['username'] = $r['username'];
                $_SESSION['password'] = $r['password'];
                $_SESSION['Fname'] = $r['Fname'];
                $_SESSION['Lname'] = $r['Lname'];


                session_write_close();

                if($r['posi']==75){
                     echo "<h3 style='color:green;text-align:center;'>" . "Welcome &nbsp;" . $r['Fname'] . "&nbsp;Permission : Admin" . "</h3>";
                     $uri =isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe']: '/intsys/complaint/';
                     header('location:'.$uri);
                }

                if($r['posi']==15 || $r['posi']==55 || $r['posi']==85 || $r['posi']==65){
                    echo "<h3 style='color:green;text-align:center;'>" . "Welcome &nbsp;" . $r['Fname'] . "&nbsp;Permission : User" . "</h3>";
                    $uri =isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe']: '/intsys/complaint/';
                    header('location:'.$uri);
                }


            }


        }
    }


    public function call_login() {//*****Check Session******//
        if (isset($_SESSION['username']) == "") {

            $_SESSION['RedirectKe'] = $_SERVER['REQUEST_URI'];

            echo "<h1 style='text-align:center;margin-top:50px;'>กรุณา Login เข้าสู่ระบบ</h1>";
            header("refresh:1; url=http://203.107.156.180/intsys/complaint/login/");
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
            $gu['memberemail'];
        }

        return $gu;
    }


    public function logout(){
        session_destroy();
        $this->session->unset_userdata('referrer_url');
	header("location:http://203.107.156.180/intsys/complaint/login");
    }


}//*******End of Model***********//


?>
