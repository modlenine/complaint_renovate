<?php
class History_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function save_history(){
        
        $data = array(
            "his_cpno" => $this->input->post("history_cpno"),
            "his_date" => $this->input->post("history_cpdate"),
            "his_topic" => $this->input->post("history_cptopic"),
            "his_cat" => $this->input->post("history_cptopiccat"),
            "his_username" => $this->input->post("history_cpusername"),
            "his_empid" => $this->input->post("history_cpuserempid"),
            "his_dept" => $this->input->post("history_cpuserdept"),
            "his_status" => $this->input->post("history_cpstatus"),
            "his_cusname" => $this->input->post("history_cpcusname"),
            "his_cusref" => $this->input->post("history_cpcusref"),
            "his_inv" => $this->input->post("history_cpinvoiceno"),
            "his_procode" => $this->input->post("history_cpprocode"),
            "his_lotno" => $this->input->post("history_cpprolotno"),
            "his_qty" => $this->input->post("history_cpproqty"),
            "his_cpdetail" => $this->input->post("detail_of_complaint"),
            "his_file" => $this->input->post("history_cpfile"),
            "his_action" => $this->input->post("his_action"),
            "his_user_modify" => $this->input->post("his_user_modify"),
            "his_date_modify" => $this->input->post("his_date_modify")
        );
        
        $this->db->insert("complaint_history_main",$data);

    }/**********test*/
    
    
    public function saveedit_history(){
        
        if($_FILES['file_add_edit']['tmp_name'] ==""){
            $fileupdate = $this->input->post("showfile");
        }else{
            $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
            $file_name = $_FILES['file_add_edit']['name'];
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
            $fileupdate = $file_name_date;
        }
        
        $data = array(
            "his_cpno" => $this->input->post("history_cpno"),
            "his_date" => $this->input->post("cp_date_get"),
            "his_topic" => $this->input->post("cp_topic"),
            "his_cat" => $this->input->post("cp_category"),
            
            "his_username" => $this->input->post("history_cpusername"),
            "his_empid" => $this->input->post("history_cpuserempid"),
            "his_dept" => $this->input->post("history_cpuserdept"),
            "his_status" => $this->input->post("history_cpstatus"),
            
            "his_cusname" => $this->input->post("cp_cus_name_edit"),
            "his_cusref" => $this->input->post("cp_cus_ref_edit"),
            "his_inv" => $this->input->post("cp_invoice_no_edit"),
            "his_procode" => $this->input->post("cp_pro_code_edit"),
            "his_lotno" => $this->input->post("cp_pro_lotno_edit"),
            "his_qty" => $this->input->post("cp_pro_qty_edit"),
            "his_cpdetail" => $this->input->post("cp_detail_edit"),
            "his_file" => $fileupdate,
            "his_action" => $this->input->post("his_action"),
            "his_memo" => $this->input->post("cp_modify_reason"),
            "his_user_modify" => $this->input->post("getuser_check"),
            "his_date_modify" => $this->input->post("his_date_modify")
        );
        
        $this->db->insert("complaint_history_main",$data);
        
        
    }
    
    
    
    public function save_inves_history($cp_no){
        $data = array(
            "his_cpno" => $this->input->post("cp_detail_inves_cpno"),
            "his_detail_inves" => $this->input->post("cp_detail_inves_his"),
            "his_detail_invesfile" => $this->input->post("cp_detail_inves_filehis"),
            "his_detail_invessignature" => $this->input->post("cp_detail_inves_signaturehis"),
            "his_detail_invesdept" => $this->input->post("cp_detail_inves_depthis"),
            "his_detail_invesdate" => $this->input->post("cp_detail_inves_datehis"),
            "his_action" => $this->input->post("his_action"),
            "his_user_modify" => $this->input->post("his_user_modify"),
            "his_date_modify" => $this->input->post("his_date_modify")
            
        );
        
        $this->db->insert("complaint_history_main",$data);
        
    }
    
    public function saveedit_inves_history(){
        
        if($_FILES['cp_detail_inves_file_edit']['tmp_name'] ==""){
            $file_name_date = $this->input->post("inves_showfile");
        }else{
            //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
            $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน

            $file_name = $_FILES['cp_detail_inves_file_edit']['name'];
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
        }
        
        
        $data = array(
            "his_cpno" => $this->input->post("his_cpno"),
            "his_detail_inves" => $this->input->post("cp_detail_inves_edit"),
            "his_detail_invesfile" => $file_name_date,
            "his_detail_invessignature" => $this->input->post("cp_detail_inves_signature"),
            "his_detail_invesdept" => $this->input->post("cp_detail_inves_dept"),
            "his_detail_invesdate" => $this->input->post("cp_detail_inves_date"),
            "his_action" => $this->input->post("cp_detail_inves_action"),
            "his_user_modify" => $this->input->post("cp_detail_inves_usermodify"),
            "his_date_modify" => $this->input->post("cp_detail_inves_datemodify"),
            "his_memo" => $this->input->post("his_memo")
            
        );
        
        $this->db->insert("complaint_history_main",$data);
    }
    
    
    public function savenc_sec3($cp_no){
        $data = array(
            "his_cpno" => $this->input->post("his_cpno"),
            "his_nc_sec31" => $this->input->post("his_nc_sec31"),
            "his_nc_sec32" => $this->input->post("his_nc_sec32"),
            "his_nc_sec32date" => $this->input->post("his_nc_sec32date"),
            
            "his_nc_sec33" => $this->input->post("his_nc_sec33"),
            "his_nc_sec33date" => $this->input->post("his_nc_sec33date"),
            
            "his_nc_sec3owner" => $this->input->post("his_nc_sec3owner"),
            "his_nc_sec3empid" => $this->input->post("his_nc_sec3empid"),
            "his_nc_sec3dept" => $this->input->post("his_nc_sec3dept"),
            "his_nc_sec3date" => $this->input->post("his_nc_sec3date"),
            "his_action" => $this->input->post("his_action"),
            "his_user_modify" => $this->input->post("his_user_modify"),
            "his_date_modify" => $this->input->post("his_date_modify")
        );
        
        $this->db->insert("complaint_history_main",$data);
        
    }
    
    
    public function save_editnc_sec3(){
        if($_FILES['nc_sec3file_edit']['tmp_name'] == ""){
            $file_name_date = $this->input->post("old_nc_sec3file");
        }else{
            //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
            $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน

            $file_name = $_FILES['nc_sec3file_edit']['name'];
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
        }
        $data = array(
            "his_cpno" => $this->input->post("his_cpno"),
            "his_nc_sec31" => $this->input->post("nc_sec31edit"),
            "his_nc_sec32" => $this->input->post("nc_sec32edit"),
            "his_nc_sec32date" => $this->input->post("datetime1_edit"),
            
            "his_nc_sec33" => $this->input->post("nc_sec33edit"),
            "his_nc_sec33date" => $this->input->post("datetime2_edit"),
            
            "his_nc_sec3owner" => $this->input->post("his_nc_sec3owner"),
            "his_nc_sec3empid" => $this->input->post("his_nc_sec3empid"),
            "his_nc_sec3dept" => $this->input->post("his_nc_sec3dept"),
            "his_nc_sec3date" => $this->input->post("his_nc_sec3date"),
            "his_nc_sec3_file" => $file_name_date,
            "his_action" => $this->input->post("his_action"),
            "his_user_modify" => $this->input->post("his_user_modify"),
            "his_date_modify" => $this->input->post("his_date_modify"),
            "his_memo" => $this->input->post("nc_sec3edit_memo")
        );
        
        $this->db->insert("complaint_history_main",$data);
    }
 
    
    
    
    
    
    
    
    
    
    
}/******************MAIN***FUNCTION*******************************/



?>