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
            "his_action" => "Click edit button",
            "his_user_modify" => $this->input->post("his_user_modify"),
            "his_date_modify" => $this->input->post("his_date_modify")
        );
        
        $this->db->insert("complaint_history_main",$data);

        
        
        
    }
    
    public function getdept_main(){
        
    }
    
    
    
    
}



?>