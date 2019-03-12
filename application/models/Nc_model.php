<?php
class Nc_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function list_nc(){
        return $this->db->query("SELECT * FROM complaint_main WHERE cp_status='Transfered to NC' " );
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
            "nc_status" => "Waiting Action"
        );
        
        $this->db->where("cp_no",$cp_no);
        if(!$this->db->update("complaint_main",$data)){
            echo "บันทึกข้อมูลไม่สำเร็จ";
        }else{
            echo "บันทึกข้อมูลสำเร็จ";
        }
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
        
        $data = array(
            "nc_sec4f1" => $this->input->post("nc_sec4f1"),
            "nc_sec4f1_file" => $file_name_date,
            "nc_sec4f1_status" => $this->input->post("nc_sec4f1_status"),
            "nc_sec4f1_date" => $this->input->post("nc_sec4f1_date"),
            "nc_sec4f1_time" => $this->input->post("nc_sec4f1_time"),
            "nc_status" => $this->input->post("nc_status_sec4f1")
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
        
        $data = array(
            "nc_sec4f2" => $this->input->post("nc_sec4f2"),
            "nc_sec4f2_file" => $file_name_date,
            "nc_sec4f2_status" => $this->input->post("nc_sec4f2_status"),
            "nc_sec4f2_date" => $this->input->post("nc_sec4f2_date"),
            "nc_sec4f2_time" => $this->input->post("nc_sec4f2_time"),
            "nc_status" => $this->input->post("nc_status_sec4f2")
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
                $nc_sec4f3_status = "NC Failed";
            }else{ $linkurl="nc/main/$cp_no";$nc_sec4f3_status="Followup_3rd";}
            
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
            "nc_status" => $nc_sec4f3_status
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
        
        $data = array(
            "nc_sec5" => $this->input->post("nc_sec5"),
            "nc_sec5file" => $file_name_date,
            "nc_sec5cost" => $this->input->post("nc_sec5cost"),
            "nc_status" => $this->input->post("nc_status_sec5")
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
            "nc_status" => "Conclusion of NC Failed!"
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