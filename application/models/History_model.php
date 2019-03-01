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
        $data = array(
            "his_cpno" => $this->input->post("history_cpno"),
            "his_date" => $this->input->post("cp_date_get"),
            "his_topic" => $this->input->post("cp_topic_hide_edit"),
            "his_cat" => $this->input->post("cp_topic_cat_edit"),
            
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
            "his_file" => $this->input->post("showfile"),
            "his_action" => $this->input->post("his_action"),
            "his_user_modify" => $this->input->post("getuser_check"),
            "his_date_modify" => $this->input->post("his_date_modify")
        );
        
        $this->db->insert("complaint_history_main",$data);
        
        
    }
    
    
    public function getdept_main(){
        
    }
    
    
    
    
}



?>