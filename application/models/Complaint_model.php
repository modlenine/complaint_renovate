<?php  
    class Complaint_model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->model("login_model");
        }
        
        
        public function list_cp(){
            $result = $this->db->query("SELECT * FROM complaint_main");
            return $result->result_array();
        }
        
        public function view_cp($cp_no){
            $result = $this->db->query("SELECT * FROM complaint_main WHERE cp_no='$cp_no' ");
            return $result->row_array();
        }
        
        
/***************GET ZONE*******************/
        public function get_priority($sql){/****Get Priority to view page********/
            $result = $this->db->query($sql);
            return $result->row_array();
        }
        
        public function get_file($cp_no){
            $result = $this->db->query("SELECT * FROM complaint_file_upload WHERE file_cp_no ='$cp_no' ");
            return $result->result_array();
        }
        
        public function get_dept($cp_no){
            $result = $this->db->query("SELECT complaint_department.cp_dept_id, complaint_department.cp_dept_code, complaint_department.cp_dept_cp_no, member.Dept FROM complaint_department INNER JOIN member ON member.DeptCode = complaint_department.cp_dept_code WHERE complaint_department.cp_dept_cp_no = '$cp_no' GROUP BY complaint_department.cp_dept_code DESC");
            return $result->result_array();
        }
        
        
        public function getdept_checkbox($cp_no){
            $result = $this->db->query("SELECT complaint_department_main.cp_dept_main_name, complaint_department.cp_dept_code, complaint_department.cp_dept_cp_no FROM complaint_department_main INNER JOIN complaint_department ON complaint_department.cp_dept_code = complaint_department_main.cp_dept_main_code WHERE cp_dept_cp_no = '$cp_no' ");
            
            return $result;
        }
        
        
        
        public function get_toppic(){
            $result = $this->db->query("SELECT topic_name , topic_cat_name  FROM complaint_topic LEFT JOIN complaint_topic_catagory ON complaint_topic.topic_cat_id = complaint_topic_catagory.topic_cat_id");
            return $result->result_array();
        }
        
        public function get_priority_main($sql){
            $result = $this->db->query($sql);
            return $result->result_array();
        }
        
//        public function get_dept_respons($dept_code){
//            $result = $this->db->query("SELECT * FROM complaint_department_main WHERE cp_dept_main_code NOT IN ('$dept_code')");
//            return $result->result_array();
//        }
        
        public function get_pri_topic(){
            $result = $this->db->query("SELECT * FROM complaint_priority GROUP BY cp_pri_group ASC");
            return $result->result_array();
        }
        

        
        
        public function getCPno() { //สร้าง Auto complaint number
        $query = $this->db->query("select cp_no from complaint_main"); //ไปนับแถวของ cp_no ก่อน
        $numrow = $query->num_rows(); //ไปนับแถวของ cp_no ก่อน
        $year_cur = date("Y"); //กำหนด ปีปัจจุบันใส่ตัวแปร year_cur
        $cut_year_cur = substr($year_cur, 2, 2); // ตัดจากเดิม 2018 เหลือ 18

        if ($numrow == 0) { //นับแถวของข้อมูล ถ้าเท่ากับ 0
            $cp_no = "CP" . $cut_year_cur . "001"; // กำหนดค่าลงไปเลย
        } else { // ถ้าไม่เป็นตามเงื่อนไขบน
            $query2 = $this->db->query("select cp_no from complaint_main order by SUBSTR(cp_no,5) desc LIMIT 1"); //ไป query เอา cp_no มาโดยตัดเอาแค่ 3 ตัวหลังตัวล่าสุดมา 1 ตัว

            foreach ($query2->result_array() as $rs) { //ไปวิ่งเช็คข้อมูล
                $cal = $rs['cp_no']; //ตรงนี้เราจะได้ค่า CP18100
            }
            $cut_yold = substr($cal, 2,2);//ตัดปี 2 ตัวท้าย
            $cut_cp = substr($cal, 2); // 18100
            $cut_cp ++;
            $set_y = str_replace($cut_yold, "CP".$cut_year_cur, $cut_cp); //ทำการ Get Year ของปัจจุบันลงไป
                       
            $cp_no = $set_y;
            
        }
        return $cp_no; // ส่งค่ากลับไป
    }
    
    
    
    public function get_pri_view($cp_no){
        $result = $this->db->query("SELECT complaint_priority.cp_pri_group, complaint_priority.cp_pri_topic, complaint_priority_use.cp_pri_use_id, complaint_priority_use.cp_pri_use_cpno, complaint_priority.cp_pri_name FROM complaint_priority INNER JOIN complaint_priority_use ON complaint_priority_use.cp_pri_use_id = complaint_priority.cp_pri_id WHERE complaint_priority_use.cp_pri_use_cpno='$cp_no' ");
        return $result->result_array();
    }
    
    
    public function update_dept_related(){
        
    }
    

        
        
/***************GET ZONE*******************/
        
        
        
/**************INSERT ZONE******************/
        public function save_newcomplaint(){/***start save_newcomplaint***/
            
        $get_cp_no = $this->getCPno();/********Get new cp_no**********/
            
        $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
        $file_name = $_FILES['file_add']['name'];
        $file_name_cut = str_replace(" ", "", $file_name);
        $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
        $file_size = $_FILES['file_add']['size'];
        $file_tmp = $_FILES['file_add']['tmp_name'];
        $file_type = $_FILES['file_add']['type'];
        move_uploaded_file($file_tmp, "asset/add/" . $file_name_date);

        print_r($file_name);
        echo "<br>" . "Copy/Upload Complete" . "<br>";
        
        
        
        $get_input_priority = $this->input->post("cp_pri_name_get");/*******Code Insert select array********/
        foreach ($get_input_priority as $gp){/*******Check array input select*********/
            $save_pri = array(
                "cp_pri_use_id" => $gp,
                "cp_pri_use_cpno" => $get_cp_no
            );
            $this->db->insert("complaint_priority_use",$save_pri); 
        }/*******Code Insert select array********/
        
        
        
        
        $get_input_dept = $this->input->post("dept");/****Code Insert radio array******/
        foreach ($get_input_dept as $gd){/******Check array input radio**********/
            $save_dept = array(
            "cp_dept_cp_no" => $get_cp_no,
            "cp_dept_code" => $gd
        );
        $this->db->insert("complaint_department",$save_dept);
            
        }/****Code Insert radio array******/
        
        
        
        

        $data = array(/*******Insert data to complaint_main table********/
                "cp_no" => $get_cp_no,
                "cp_date" => $this->input->post("cp_date"),
                "cp_topic" => $this->input->post("cp_topic_hide"),
                "cp_topic_cat" => $this->input->post("cp_topic_cat"),
//                "cp_priority" => $this->input->post(""),
                "cp_user_name" => $this->input->post("cp_user_name"),
                "cp_user_empid" => $this->input->post("cp_user_empid"),
                "cp_user_dept" => $this->input->post("cp_user_dept"),
                "cp_cus_name" => $this->input->post("cp_cus_name"),
                "cp_cus_ref" => $this->input->post("cp_cus_ref"),
                "cp_invoice_no" => $this->input->post("cp_invoice_no"),
                "cp_pro_code" => $this->input->post("cp_pro_code"),
                "cp_pro_lotno" => $this->input->post("cp_pro_lotno"),
                "cp_pro_qty" => $this->input->post("cp_pro_qty"),
                "cp_detail" => $this->input->post("cp_detail"),
                "cp_file" => $file_name_date,
                "cp_status" => "New Complaint"
            );
            
            if($this->db->insert("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed !!!!")';
            echo '</script>';
            
        }/*******Insert data to complaint_main table********/
    }/***end save_newcomplaint***/
    
    

    
    
    
/**************INSERT ZONE******************/
        
        

/**************UPDATE ZONE******************/
        public function change_status_to1($cp_no){/*******Change New Complaint to Complaint Analyzed**********/
           return $this->db->query("UPDATE complaint_main SET cp_status='Complaint Analyzed' WHERE cp_no='$cp_no' ");
        }
        
        
        public function add_detail_inves($cp_no){/*********Add Detail investigate+Upload file to db**********************/
            //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['cp_detail_inves_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['cp_detail_inves_file']['size'];
		$file_tmp =$_FILES['cp_detail_inves_file']['tmp_name'];
		$file_type=$_FILES['cp_detail_inves_file']['type'];  
		move_uploaded_file($file_tmp,"asset/investigate/detail_inves/".$file_name_date);
                
                print_r($file_name);
                

	echo "<br>"."Copy/Upload Complete"."<br>";
            
            $data = array(
                "cp_detail_inves" => $this->input->post("cp_detail_inves"),
                "cp_detail_inves_signature" => $this->input->post("cp_detail_inves_signature"),
                "cp_detail_inves_dept" => $this->input->post("cp_detail_inves_dept"),
                "cp_detail_inves_date" => $this->input->post("cp_detail_inves_date"),
                "cp_status" => "Investigation Complete",
                "cp_detail_inves_file" => $file_name_date
            );
            
            $this->db->where("cp_no",$cp_no);
            $this->db->update("complaint_main",$data);
            
        }
        
        
        public function add_sum_inves($cp_no){/*************SUMMARY OF INVESTIGATION*****************/
            
            //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['cp_sum_inves_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['cp_sum_inves_file']['size'];
		$file_tmp =$_FILES['cp_sum_inves_file']['tmp_name'];
		$file_type=$_FILES['cp_sum_inves_file']['type'];  
		move_uploaded_file($file_tmp,"asset/investigate/sum_inves/".$file_name_date);
                
                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";
        
        
        
        if($this->input->post("cp_sum")=="yes"){
            $update_status = "Transfered to NC";
            $update_status_nc = "Transfrom Complaint";
        }else{ 
            $update_status = "Normal Complaint"; 
            $update_status_nc = "";
        }
            
            $data = array(
                "cp_sum_inves" => $this->input->post("cp_sum_inves"),
                "cp_sum_inves_signature" => $this->input->post("cp_sum_inves_signature"),
                "cp_sum_inves_dept" => $this->input->post("cp_sum_inves_dept"),
                "cp_sum_inves_date" => $this->input->post("cp_sum_inves_date"),
                "cp_sum_inves_file" => $file_name_date,
                "cp_status" => $update_status,
                "nc_status" => $update_status_nc,
                "cp_sum" => $this->input->post("cp_sum")
            );
            
            $this->db->where("cp_no",$cp_no);
            
            if($this->db->update("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed !!!!")';
            echo '</script>';
            
        }
        }
        
        
        
        public function add_conclusion($cp_no){
                        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['cp_conclu_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['cp_conclu_file']['size'];
		$file_tmp =$_FILES['cp_conclu_file']['tmp_name'];
		$file_type=$_FILES['cp_conclu_file']['type'];  
		move_uploaded_file($file_tmp,"asset/investigate/conclusion_inves/".$file_name_date);
                
                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";
        
        $conclu_cost = $this->input->post("cp_conclu_cost");
        $cut_comma = str_replace(",", "", $conclu_cost);
            
            
         $data = array(
             "cp_conclu_detail" => $this->input->post("cp_conclu_detail"),
             "cp_conclu_signature" => $this->input->post("cp_conclu_signature"),
             "cp_conclu_dept" => $this->input->post("cp_conclu_dept"),
             "cp_conclu_date" => $this->input->post("cp_conclu_date"),
             "cp_conclu_file" => $file_name_date,
             "cp_conclu_costdetail" => $this->input->post("cp_conclu_costdetail"),
             "cp_conclu_cost" => $cut_comma

         );
         
         $this->db->where("cp_no",$cp_no);
            if($this->db->update("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed !!!!")';
            echo '</script>';
            
        }
            
        }
        
        
        
        
        public function savedata_edit($cp_no){
            
            if($this->input->post("file_add_edit")!= ""){
                $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
        $file_name = $_FILES['file_add']['name'];
        $file_name_cut = str_replace(" ", "", $file_name);
        $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
        $file_size = $_FILES['file_add']['size'];
        $file_tmp = $_FILES['file_add']['tmp_name'];
        $file_type = $_FILES['file_add']['type'];
        move_uploaded_file($file_tmp, "asset/add/" . $file_name_date);

        print_r($file_name);
        echo "<br>" . "Copy/Upload Complete" . "<br>";
            }else{
                $file_name_date = $this->input->post("showfile");
            }
        
        
        $this->db->where("cp_pri_use_cpno",$cp_no);
        $this->db->delete("complaint_priority_use");
        
        $get_input_priority = $this->input->post("cp_pri_name_get_edit");/*******Code Insert select array********/
        foreach ($get_input_priority as $gp){/*******Check array input select*********/
            $save_pri = array(
                "cp_pri_use_id" => $gp,
                "cp_pri_use_cpno" => $cp_no
            );
            $this->db->insert("complaint_priority_use",$save_pri); 
        }/*******Code Insert select array********/
        
        
        
        $this->db->where("cp_dept_cp_no",$cp_no);
        $this->db->delete("complaint_department");
        
        $get_input_dept = $this->input->post("dept_edit");/****Code Insert radio array******/
        foreach ($get_input_dept as $gd){/******Check array input radio**********/
            $save_dept = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $gd
        );
        $this->db->insert("complaint_department",$save_dept);
            
        }/****Code Insert radio array******/
        
        
        
        

        $data = array(/*******Insert data to complaint_main table********/
//                "cp_no" => $get_cp_no,
//                "cp_date" => $this->input->post("cp_date"),
                "cp_topic" => $this->input->post("cp_topic_hide_edit"),
                "cp_topic_cat" => $this->input->post("cp_topic_cat_edit"),
//                "cp_priority" => $this->input->post(""),
//                "cp_user_name" => $this->input->post("cp_user_name"),
//                "cp_user_empid" => $this->input->post("cp_user_empid"),
//                "cp_user_dept" => $this->input->post("cp_user_dept"),
                "cp_cus_name" => $this->input->post("cp_cus_name_edit"),
                "cp_cus_ref" => $this->input->post("cp_cus_ref_edit"),
                "cp_invoice_no" => $this->input->post("cp_invoice_no_edit"),
                "cp_pro_code" => $this->input->post("cp_pro_code_edit"),
                "cp_pro_lotno" => $this->input->post("cp_pro_lotno_edit"),
                "cp_pro_qty" => $this->input->post("cp_pro_qty_edit"),
                "cp_detail" => $this->input->post("cp_detail_edit"),
                "cp_file" => $file_name_date,
                "cp_status" => "New Complaint",
                "cp_modify_by" => $this->input->post("getuser_check"),
                "cp_modify_datetime" => date("Y/m/d H:i:s"),
                "cp_modify_action" => "Modify Success"
            );
            
            $this->db->where("cp_no",$cp_no);
            if($this->db->update("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Save Edit Data Success")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Save Edit Data Failed !!!!")';
            echo '</script>';
            
        }/*******Insert data to complaint_main table********/
        }
        
        
/**************UPDATE ZONE******************/
        
  
        
        
        

/*************SET ZONE***********************/
        public function set_activeEmail() {
        $lab = $this->input->post("lab");
        $admin = $this->input->post("admin");
        $hr = $this->input->post("hr");
        $account = $this->input->post("account");
        $qc = $this->input->post("qc");
        $maintenance = $this->input->post("maintenance");
        $pd = $this->input->post("pd");
        $sales = $this->input->post("sales");
        $warehouse = $this->input->post("warehouse");
        $planning = $this->input->post("planning");
        $it = $this->input->post("it");
        $pu = $this->input->post("pu");
        $qmr = "1099";

        //เช็คว่ามีการติ๊กเลือกแผนกเพื่อส่ง Email หรือไม่ ถ้าไม่มีจะขึ้นการแจ้งเตือน
        if ($lab == "" and $admin == "" and $hr == "" and $account == "" and $qc == "" and $maintenance == "" and $pd == "" and $sales == "" and $warehouse == "" and $planning == "" and $it == "" && $pu == "") {
            echo "please choose department for sent email";
            exit();
        } else {//ถ้ามีการติ๊กเลือก ให้ดำเนินการปรับ สถานะ
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$lab' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$admin' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$hr' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$account' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$qc' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$maintenance' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$pd' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$sales' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$warehouse' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$planning' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$it' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$pu' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$qmr' ");
        }
    }
/*************SET ZONE***********************/
    
    
    
    
/*****************CHECK ZONE*********************/
    
    public function check_status_page($cp_no){/*******Check status page********/
        $result = $this->db->query("SELECT cp_status FROM complaint_main WHERE cp_no='$cp_no' ");
        $get_status = $result->row();
        if($get_status->cp_status !== "New Complaint"){
            redirect('/complaint/investigate/'.$cp_no);
        }
    }
    
    public function check_status_page2($cp_no){/*******Check status page********/
        $result = $this->db->query("SELECT cp_status FROM complaint_main WHERE cp_no='$cp_no' ");
        $get_status = $result->row();
        if($get_status->cp_status == "New Complaint"){
            redirect('/complaint/view/'.$cp_no);
        }
    }
    
    
    
    
    
/*****************CHECK ZONE*********************/
    
        
        
    }
?>