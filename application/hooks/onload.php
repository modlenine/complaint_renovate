<?php
class Onload
{
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        // โหลด User Agent library สำหรับตรวจสอบ browser
        $this->ci->load->library('user_agent');
    }



    ////////////////////////////////////////////////////////////////
    /////////////// CHECK LOGIN HOOK ทำงานในระดับบนสุด (SSO with Intranet)
    ///////////////////////////////////////////////////////////////
    public function checklogin()
    {
        $controller = $this->ci->router->class;
        $method = $this->ci->router->method;
        $checkpage = $this->ci->uri->segment(1);

        $browserUser = $this->ci->agent->browser();
        if($browserUser == "Internet Explorer"){
            echo "<script>";
            echo "alert('โปรแกรมไม่ Support Internet Explorer กรุณาเข้าใช้งานโปรแกรมด้วย Browser อื่น เช่น Google chrome , Firefox , Safari')";
            echo "</script>";
            die();
        }else{
            // เช็ค session จาก Intranet SSO
            $ecode = $this->ci->session->userdata("ecode");
            
            if (empty($ecode)) {
                // ยังไม่ได้ login - redirect ไป Intranet login
                if ($controller != "login" && $controller != "Login") {
                    // เก็บ URL ปัจจุบันเพื่อกลับมาหลัง login
                    // แต่ไม่เก็บถ้าเป็นหน้า logout (ป้องกัน infinite loop)
                    $current_url = $_SERVER['REQUEST_URI'];
                    
                    // ตรวจสอบว่า URL ไม่ใช่ logout หรือ login
                    if (stripos($current_url, 'logout') === false && 
                        stripos($current_url, 'login') === false) {
                        $return_url = urlencode($current_url);
                        $return_param = "?return_url=$return_url";
                    } else {
                        $return_param = ""; // ไม่ส่ง return_url ถ้าเป็นหน้า logout/login
                    }
                    
                    // Intranet login URL (same domain)
                    $url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
                    $intranet_login = "$url/intranet/login$return_param";
                    
                    header("Location: " . $intranet_login);
                    exit();
                }
            }
        }
    }

    ////////////////////////////////////////////////////////////////
    /////////////// CHECK LOGIN HOOK ทำงานในระดับบนสุด
    ///////////////////////////////////////////////////////////////








}//End onload Class
