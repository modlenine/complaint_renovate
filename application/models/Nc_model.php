<?php
class Nc_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->model("login_model");
        require("PHPMailer_5.2.0/class.phpmailer.php");
    }
    
    public function list_nc(){
        return $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_topic, complaint_main.cp_user_name, complaint_main.cp_user_empid, complaint_main.nc_status_code, complaint_status.cp_status_id, complaint_status.cp_status_name, complaint_main.cp_cus_name, complaint_main.cp_priority FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.nc_status_code WHERE cp_status_code='cp05' " );
    }
    
    public function getdata_main($cp_no){
        $result = $this->db->query("SELECT * FROM complaint_main WHERE cp_no='$cp_no' ");
        return $result->row();
    }
    
    public function save_ncsec3($cp_no){
        $data = array(
            "nc_sec31" => $this->input->post("nc_sec31"),
            "nc_sec32" => $this->input->post("nc_sec32"),
            "nc_sec32date" => $this->input->post("datetime32"),
//            "nc_sec32time" => $this->input->post("nc_sec32time"),
            "nc_sec33" => $this->input->post("nc_sec33"),
            "nc_sec33date" => $this->input->post("datetime33"),
//            "nc_sec33time" => $this->input->post("nc_sec33time"),
            "nc_sec3owner" => $this->input->post("nc_sec3owner"),
            "nc_sec3empid" => $this->input->post("nc_sec3empid"),
            "nc_sec3dept" => $this->input->post("nc_sec3dept"),
            "nc_sec3date" => $this->input->post("nc_sec3date"),
            "nc_status_code" => "nc02"
        );
        
        $this->db->where("cp_no",$cp_no);
        $this->db->update("complaint_main",$data);
        
        
        
 //****************************Email***Zone*********************************************//       
  $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' ");
            
    $get_owner_email = $this->get_owner_email($cp_no);      
                        
    $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้ 
        $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
        $mail->Host = "mail.saleecolour.com";  // specify main and backup server
//        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // พอร์ท
//        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "websystem@saleecolour.com";  // SMTP username
        //websystem@saleecolour.com
//        $mail->Username = "chainarong039@gmail.com";
        $mail->Password = "Ae8686#"; // SMTP password
        //Ae8686#
//        $mail->Password = "ShctBkk1";

        $mail->From = "websystem@saleecolour.com";
        $mail->FromName = "Salee Colour WEB System";
        foreach ($getEmail->result_array() as $fetch) {
            $mail->AddAddress($fetch['email']);   
        }
        
        $mail->AddCC($get_owner_email->cp_user_email);
// $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
// $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
// $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        
        if(!$mail->send()){
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
        }
        

 //************************Email***Zone***********************************//  
        
        
        
    }
    
    
    public function savenc_sec3edit($cp_no){
//        $date = date_create($this->input->post("datetime1_edit"));
//        $dateformat = date_format($date, "Y-m-d H:i:s");
        
        $data = array(
            "nc_sec31" => $this->input->post("nc_sec31edit"),
            "nc_sec32" => $this->input->post("nc_sec32edit"),
            "nc_sec32date" => $this->input->post("datetime1_edit"),
//            "nc_sec32time" => $this->input->post("nc_sec32timeedit"),
            "nc_sec33" => $this->input->post("nc_sec33edit"),
            "nc_sec33date" => $this->input->post("datetime2_edit"),
//            "nc_sec33time" => $this->input->post("nc_sec33timeedit"),
            "nc_sec3edit_memo" => $this->input->post("nc_sec3edit_memo"),
            "nc_modify_by" => $this->input->post("nc_modify_by"),
            "nc_modify_date" => $this->input->post("nc_modify_date")
            
        );
        
        $this->db->where("cp_no",$cp_no);
        
        if(!$this->db->update("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Update data Failed !!")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Update data Success")';
            echo '</script>';
            
            header("refresh:0; url=http://192.190.10.27/complaint/nc/main/$cp_no");
        }
        
    }
    
    
    public function save_sec4f1($cp_no){
        
            //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec4f1_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['nc_sec4f1_file']['size'];
		$file_tmp =$_FILES['nc_sec4f1_file']['tmp_name'];
		$file_type=$_FILES['nc_sec4f1_file']['type'];  
		move_uploaded_file($file_tmp,"asset/nc/sec4/f1/".$file_name_date);
                
                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";
        
        if($this->input->post("nc_sec4f1_status") == "yes"){
            $nc_status_4f1 = "nc06";
        }else{
            $nc_status_4f1 = "nc03";
        }
        
        $data = array(
            "nc_sec4f1" => $this->input->post("nc_sec4f1"),
            "nc_sec4f1_file" => $file_name_date,
            "nc_sec4f1_status" => $this->input->post("nc_sec4f1_status"),
            "nc_sec4f1_date" => $this->input->post("datetime41"),
//            "nc_sec4f1_time" => $this->input->post("nc_sec4f1_time"),
            "nc_sec4f1_signature" => $this->input->post("nc_sec4f1_signature"),
            "nc_status_code" => $nc_status_4f1
        );
        
        $this->db->where("cp_no",$cp_no);
        
        if(!$this->db->update("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Update data Failed !!")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Update data Success")';
            echo '</script>';
            
            header("refresh:0; url=http://192.190.10.27/complaint/nc/main/$cp_no");
        }
        
    }
    
    
    public function save_sec4f2($cp_no){
                    //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec4f2_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['nc_sec4f2_file']['size'];
		$file_tmp =$_FILES['nc_sec4f2_file']['tmp_name'];
		$file_type=$_FILES['nc_sec4f2_file']['type'];  
		move_uploaded_file($file_tmp,"asset/nc/sec4/f2/".$file_name_date);
                
                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";
        
        if($this->input->post("nc_sec4f2_status") == "yes"){
            $nc_status_4f2 = "nc07";
        }else{
            $nc_status_4f2 = "nc04";
        }
        
        $data = array(
            "nc_sec4f2" => $this->input->post("nc_sec4f2"),
            "nc_sec4f2_file" => $file_name_date,
            "nc_sec4f2_status" => $this->input->post("nc_sec4f2_status"),
            "nc_sec4f2_date" => $this->input->post("datetime42"),
//            "nc_sec4f2_time" => $this->input->post("nc_sec4f2_time"),
            "nc_sec4f2_signature" => $this->input->post("nc_sec4f2_signature"),
            "nc_status_code" => $nc_status_4f2
        );
        
        $this->db->where("cp_no",$cp_no);
        
        if(!$this->db->update("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Update data Failed !!")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Update data Success")';
            echo '</script>';
            
            header("refresh:0; url=http://192.190.10.27/complaint/nc/main/$cp_no");
        }
    }
    
    
        public function save_sec4f3($cp_no){
            $dept_code = $this->input->post("getdeptcode");
            
            if($this->input->post("nc_sec4f3_status")=="no"){
                $linkurl = "complaint/add_failed/$cp_no/$dept_code";
                $nc_sec4f3_status = "nc09";
            }else{ $linkurl="nc/main/$cp_no";$nc_sec4f3_status="nc08";}
            
                    //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec4f3_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['nc_sec4f3_file']['size'];
		$file_tmp =$_FILES['nc_sec4f3_file']['tmp_name'];
		$file_type=$_FILES['nc_sec4f3_file']['type'];  
		move_uploaded_file($file_tmp,"asset/nc/sec4/f3/".$file_name_date);
                
                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";
        
        $data = array(
            "nc_sec4f3" => $this->input->post("nc_sec4f3"),
            "nc_sec4f3_file" => $file_name_date,
            "nc_sec4f3_status" => $this->input->post("nc_sec4f3_status"),
            "nc_sec4f3_signature" => $this->input->post("nc_sec4f3_signature"),
            "nc_status_code" => $nc_sec4f3_status
        );
        
        $this->db->where("cp_no",$cp_no);
        
        if(!$this->db->update("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Update data Failed !!")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Update data Success")';
            echo '</script>';
            
            header("refresh:0; url=http://192.190.10.27/complaint/$linkurl");
        }
    }
    
    
    public function save_sec5($cp_no){
                    //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec5file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['nc_sec5file']['size'];
		$file_tmp =$_FILES['nc_sec5file']['tmp_name'];
		$file_type=$_FILES['nc_sec5file']['type'];  
		move_uploaded_file($file_tmp,"asset/nc/sec5/".$file_name_date);
                
                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";
        
        $sec5_convert = $this->input->post("nc_sec5cost");
        $sec5_cut_comma = str_replace(",", "", $sec5_convert);
        
        $data = array(
            "nc_sec5" => $this->input->post("nc_sec5"),
            "nc_sec5file" => $file_name_date,
            "nc_sec5cost" => $sec5_cut_comma,
            "nc_status_code" => "nc11"
        );
        
        $this->db->where("cp_no",$cp_no);
        
        if(!$this->db->update("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Update data Failed !!")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Update data Success")';
            echo '</script>';
            
            header("refresh:0; url=http://192.190.10.27/complaint/nc/main/$cp_no");
        }
    }
    
    
        public function save_sec5failed($cp_no){
            $dept_code = $this->input->post("getdeptcode");
                    //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec5file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['nc_sec5file']['size'];
		$file_tmp =$_FILES['nc_sec5file']['tmp_name'];
		$file_type=$_FILES['nc_sec5file']['type'];  
		move_uploaded_file($file_tmp,"asset/nc/sec5/failed/".$file_name_date);
                
                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";
        
        $data = array(
            "nc_sec5failed" => $this->input->post("nc_sec5"),
            "nc_sec5filefailed" => $file_name_date,
            "nc_sec5costfailed" => $this->input->post("nc_sec5cost"),
            "nc_status_code" => "nc10"
        );
        
        $this->db->where("cp_no",$cp_no);
        
        if(!$this->db->update("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Update data Failed !!")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Update data Success")';
            echo '</script>';
            
            header("refresh:0; url=http://192.190.10.27/complaint/nc/main/$cp_no");
        }
    }
    
    
    public function create_cpfailed($cp_no){
        $dept_code = $this->input->post("getdeptcode");
        header("refresh:0; url=http://192.190.10.27/complaint/complaint/add_failed/$cp_no/$dept_code");
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}


?>