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
            "nc_sec32date" => $this->input->post("nc_sec3date"),
            "nc_sec32time" => $this->input->post("nc_sec32time"),
            "nc_sec33" => $this->input->post("nc_sec33"),
            "nc_sec33date" => $this->input->post("nc_sec33date"),
            "nc_sec33time" => $this->input->post("nc_sec33time"),
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
        
        $data = array(
            "nc_sec31" => $this->input->post("nc_sec31edit"),
            "nc_sec32" => $this->input->post("nc_sec32edit"),
            "nc_sec32date" => $this->input->post("nc_sec32dateedit"),
            "nc_sec32time" => $this->input->post("nc_sec32timeedit"),
            "nc_sec33" => $this->input->post("nc_sec33edit"),
            "nc_sec33date" => $this->input->post("nc_sec33dateedit"),
            "nc_sec33time" => $this->input->post("nc_sec33timeedit"),
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
    
    
    
    
    
    
    
    
    
    
    
    
    
}


?>