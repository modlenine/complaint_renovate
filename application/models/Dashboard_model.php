<?php
class Dashboard_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function plus_number($a,$b){
        $c = $a+ $b;
        return $c;
    }
    
    public function get_cpstatus(){
        return $this->db->query("SELECT complaint_main.cp_no, complaint_main.cp_status_code, complaint_status.cp_status_name , COUNT(cp_status_code) as sum FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code GROUP BY cp_status_code ASC");
    }
    
    public function get_ncstatus(){
        return $this->db->query("SELECT complaint_status.cp_status_id, complaint_status.cp_status_name, complaint_main.cp_no, complaint_main.nc_status_code , COUNT(nc_status_code) as sumnc FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.nc_status_code GROUP BY nc_status_code");
    }
    
    public function getby_username(){
        return $this->db->query("SELECT Count(complaint_main.cp_user_name) AS num_user, complaint_main.cp_user_name , complaint_main.cp_status_code FROM complaint_main GROUP BY cp_user_name ASC");
    }
    
    public function getby_dept(){
        return $this->db->query("SELECT complaint_main.cp_user_dept , COUNT(cp_user_dept) as num_dept FROM complaint_main GROUP BY cp_user_dept");
    }
    
    public function getby_topic(){
        return $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_cus_name, complaint_main.cp_priority, complaint_main.cp_status_code, complaint_status.cp_status_id, complaint_status.cp_status_name, complaint_main.cp_user_dept, complaint_topic.topic_id, complaint_topic.topic_name, complaint_main.cp_topic , COUNT(cp_topic) as num_topic FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code INNER JOIN complaint_topic ON complaint_topic.topic_name = complaint_main.cp_topic GROUP BY cp_topic ASC");
    }
    
    public function viewcpby_status($cp_status_code){
        $result = $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_topic, complaint_main.cp_user_name, complaint_main.cp_cus_name, complaint_status.cp_status_id, complaint_status.cp_status_name, complaint_main.cp_priority, complaint_main.cp_status_code FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code WHERE cp_status_code='$cp_status_code' ");
        return $result->result_array();
    }
    
    public function viewncby_status($cp_status_code){
        $result = $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_topic, complaint_main.cp_user_name, complaint_main.cp_cus_name, complaint_main.cp_priority, complaint_main.nc_status_code, complaint_status.cp_status_id, complaint_status.cp_status_name FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.nc_status_code WHERE nc_status_code='$cp_status_code' ");
        return $result->result_array();
    }
    
    
    public function viewby_user($cp_username){
        $result = $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_topic, complaint_main.cp_user_name, complaint_main.cp_cus_name, complaint_main.cp_priority, complaint_status.cp_status_id, complaint_status.cp_status_name, complaint_main.cp_status_code FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code WHERE cp_user_name='$cp_username' ");
        return $result->result_array();
    }
    
    public function viewby_dept($cp_userdept){
        $result = $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_topic, complaint_main.cp_cus_name, complaint_main.cp_priority, complaint_main.cp_status_code, complaint_status.cp_status_id, complaint_status.cp_status_name, complaint_main.cp_user_dept FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code WHERE cp_user_dept='$cp_userdept' ");
        return $result->result_array();
    }
    
    public function viewby_topic($cp_topic_id){
        $result = $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_cus_name, complaint_main.cp_priority, complaint_main.cp_status_code, complaint_status.cp_status_id, complaint_status.cp_status_name, complaint_main.cp_user_dept, complaint_topic.topic_id, complaint_topic.topic_name FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code INNER JOIN complaint_topic ON complaint_topic.topic_name = complaint_main.cp_topic WHERE complaint_topic.topic_id='$cp_topic_id'");
        return $result->result_array();
    }
    
    
    
    
    
    
}


?>