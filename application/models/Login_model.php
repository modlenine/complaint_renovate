<?php



class login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


    // public function escape_string() {
    //     if($_SERVER['HTTP_HOST'] == "localhost"){
    //         $mysqlServer = "192.168.20.22";
    //         return mysqli_connect("192.168.20.22", "ant", "Ant1234", "saleecolour");
    //     }else{
    //         $mysqlServer = "localhost";
    //         return mysqli_connect("localhost", "ant", "Ant1234", "saleecolour");
    //     }
    // }

    // public function check_login() {
    //      $this->load->library('user_agent');
    //     // เข้ารหัส input
    //     $username = mysqli_escape_string($this->escape_string(), isset($_POST['username']) ? ($_POST['username']) : '');
    //     $password = mysqli_escape_string($this->escape_string(), isset($_POST['password']) ? md5($_POST['password']) : '');
    //     $checkuser = $this->db->query(sprintf("SELECT * FROM member WHERE `username` = '%s' and `password` = '%s' ", $username, $password
    //     ));

    //     $checkdata = $checkuser->num_rows();

    //     if ($checkdata == 0) {
    //         echo '<script language="javascript">';
    //         echo 'alert("Username หรือ Password ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง")';
    //         echo '</script>';
    //         header("refresh:1; url=".base_url('login'));
    //         die();
    //     } else {
    //         echo "<h2 style='text-align:center;color:green;margin-top:30px;'>เข้าสู่ระบบสำเร็จ กรุณารอสักครู่ระบบกำลังพาท่านเข้าสู่หน้าโปรแกรม</h2>";

    //         // check duplicate user
    //         foreach ($checkuser->result_array() as $r) {
    //           $check_user = $r['ecode'];
    //             $check_useronline = $this->db->query("select * from complaint_login_detail where cp_login_ecode='$check_user' ");
    //             foreach($check_useronline->result_array() as $cku_online){
    //                 if($cku_online['cp_login_status2']=="null")
    //                 {
    //                     $ar = array(
    //                         "cp_login_lastactivity2" => date("Y-m-d H:m:s"),
    //                         "cp_login_status2" => "logout"
    //                     );

    //                     $this->db->where("cp_login_ecode",$check_user);
    //                     $this->db->update("complaint_login_detail",$ar);
    //                 }

    //             }


    //           $times = time();

    //           $login_id = $this->db->query("insert into complaint_login_detail (cp_login_ecode , cp_login_lastactivity , cp_login_status , cp_login_session )values('" . $r['ecode'] . "' , '" . date("Y-m-d H:i:s") . "' , 'login', '$times' )");

    //           $_SESSION['username'] = $r['username'];
    //           $_SESSION['password'] = $r['password'];
    //           $_SESSION['Dept'] = $r['Dept'];
    //           $_SESSION['DeptCode'] = $r['DeptCode'];
    //           $_SESSION['memberemail'] = $r['memberemail'];
    //           $_SESSION['file_img'] = $r['file_img'];
    //           $_SESSION['Fname'] = $r['Fname'];
    //           $_SESSION['Lname'] = $r['Lname'];
    //           $_SESSION['ecode'] = $r['ecode'];
    //           $_SESSION['posi'] = $r['posi'];
    //           $_SESSION['login_id'] = $login_id;

    //           // insert login log

    //             $logindata = array(
    //             "cp_loginlog_username" => $r['username'],
    //             "cp_loginlog_datetime" => date("Y-m-d H:i:s"),
    //             "cp_loginlog_status" => "login",
    //             "cp_loginlog_browser" => $this->agent->browser(),
    //             "cp_loginlog_browser_version" => $this->agent->version(),
    //             "cp_loginlog_ip" => $this->input->ip_address(),
    //             "cp_loginlog_os" => $this->agent->platform()
    //             );

    //             $this->db->insert("complaint_loginlog" , $logindata);



    //             if($r['posi']==75){
    //                  echo "<h3 style='color:green;text-align:center;'>" . "Welcome &nbsp;" . $r['Fname'] . "&nbsp;Permission : Admin" . "</h3>";
    //                  $uri =isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe']: '/intsys/complaint/';
    //                  header('location:'.$uri);
    //             }

    //             if($r['posi']==15 || $r['posi']==55 || $r['posi']==85 || $r['posi']==65){

    //                 echo "<h3 style='color:green;text-align:center;'>" . "Welcome &nbsp;" . $r['Fname'] . "&nbsp;Permission : User" . "</h3>";
    //                 $uri =isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe']: '/intsys/complaint/';
    //                 header('location:'.$uri);
    //             }

    //         }

    //     }

    // }





//   public function call_login() {//*****Check Session******//
//       if (isset($_SESSION['username']) == "") {
//           $_SESSION['RedirectKe'] = $_SERVER['REQUEST_URI'];
//           header("refresh:0; url=".base_url('login'));
//           die();
//       }
//   }





    public function getuser(){
        // รองรับทั้ง ecode (SSO) และ username (legacy)
        $ecode = $this->session->userdata('ecode');
        $username = $this->session->userdata('username');
        
        if(!empty($ecode)){
            // ใช้ ecode จาก SSO (แนะนำ)
            $this->db->where('ecode', $ecode);
        }elseif(!empty($username)){
            // fallback ไปใช้ username (สำหรับ legacy support)
            $this->db->where('username', $username);
        }else{
            // ไม่มี session
            return null;
        }
        
        $result = $this->db->get('member');
        
        if($result->num_rows() > 0){
            return $result->row_array();
        }
        
        return null;



        return $gu;

    }





    public function logout(){

        $ecode = $this->session->userdata('ecode');

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
      // $this->session->unset_userdata('referrer_url');
      // เก็บ URL ปัจจุบันเพื่อกลับมาหลัง login
      $current_url = $_SERVER['REQUEST_URI'];
      $return_url = urlencode($current_url);
      
      // Intranet login URL (same domain)
      $url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
      $intranet_login = "$url/intranet/login?return_url=$return_url";
      
      header("Location: " . $intranet_login);
      exit();

    }





}//*******End of Model***********//





?>

