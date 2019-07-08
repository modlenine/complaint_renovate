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

// check duplicate user
            foreach ($checkuser->result_array() as $r) {
              $check_user = $r['ecode'];
                $check_useronline = $this->db->query("select * from complaint_login_detail where cp_login_ecode='$check_user' ");
                foreach($check_useronline->result_array() as $cku_online){
                    if($cku_online['cp_login_status2']=="null")
                    {
                        $ar = array(
                            "cp_login_lastactivity2" => date("Y-m-d H:m:s"),
                            "cp_login_status2" => "logout"
                        );
                        $this->db->where("cp_login_ecode",$check_user);
                        $this->db->update("complaint_login_detail",$ar);
                    }
                }


                // check timeout
                                $result = $this->db->query("select * from complaint_login_detail");
                                foreach ($result->result_array() as $re) {
                                    $cktime = time() - $re['cp_login_session'];
                                    if ($cktime > 14400) {
                                        $timeout = $re['cp_login_ecode'];
                                        $ar_timeout = array(
                                            "cp_login_lastactivity2" => date("Y-m-d H:m:s"),
                                            "cp_login_status2" => "logout"
                                        );
                                        $this->db->where("cp_login_ecode", $timeout);
                                        $this->db->where("cp_login_status2", "null");
                                        $this->db->update("complaint_login_detail", $ar_timeout);
                                    }
                                }



              $times = time();
              $login_id = $this->db->query("insert into complaint_login_detail (cp_login_ecode , cp_login_lastactivity , cp_login_status , cp_login_session )values('" . $r['ecode'] . "' , '" . date("Y-m-d H:m:s") . "' , 'login', '$times' )");

              $_SESSION['username'] = $r['username'];
              $_SESSION['password'] = $r['password'];
              $_SESSION['Fname'] = $r['Fname'];
              $_SESSION['Lname'] = $r['Lname'];
              $_SESSION['ecode'] = $r['ecode'];
              $_SESSION['posi'] = $r['posi'];
              $_SESSION['login_id'] = $login_id;


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
      $ecode = $_SESSION['ecode'];

              $sqlget = $this->db->query("SELECT
              MAX(complaint_login_detail.cp_login_id) as cp_login_id,
              complaint_login_detail.cp_login_ecode,
              complaint_login_detail.cp_login_lastactivity,
              complaint_login_detail.cp_login_status,
              complaint_login_detail.cp_login_lastactivity2,
              complaint_login_detail.cp_login_status2
              FROM
              complaint_login_detail
              WHERE cp_login_ecode ='$ecode' ");

              $loginids = $sqlget->row();
              $loginid = $loginids->cp_login_id;
              $datenow = date("Y-m-d H:m:s");

              $this->db->query("UPDATE complaint_login_detail SET cp_login_lastactivity2='$datenow' , cp_login_status2='logout' WHERE cp_login_id='$loginid' ");


        session_destroy();
        $this->session->unset_userdata('referrer_url');
	header("location:http://203.107.156.180/intsys/complaint/login");
    }


}//*******End of Model***********//


?>
