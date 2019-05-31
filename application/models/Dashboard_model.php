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
        return $this->db->query("SELECT
nc_main.nc_no,
nc_main.nc_status_code,
complaint_status.cp_status_name,
count(nc_main.nc_status_code) as sum
FROM
nc_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = nc_main.nc_status_code GROUP BY nc_main.nc_status_code ORDER BY nc_main.nc_status_code ASC");
    }

    public function getby_username(){
        return $this->db->query("SELECT Count(complaint_main.cp_user_name) AS num_user, complaint_main.cp_user_name , complaint_main.cp_status_code FROM complaint_main GROUP BY cp_user_name ASC");
    }

    public function getby_dept(){
        return $this->db->query("SELECT complaint_main.cp_user_dept , COUNT(cp_user_dept) as num_dept FROM complaint_main GROUP BY cp_user_dept");
    }

    public function getby_topic_cat(){
        return $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_cus_name, complaint_main.cp_priority, complaint_main.cp_status_code, complaint_main.cp_user_dept, complaint_main.cp_topic, count(complaint_main.cp_topic_cat) as cat_num,complaint_main.cp_topic_cat, complaint_topic_catagory.topic_cat_name, complaint_topic.topic_name FROM complaint_main INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic GROUP BY cp_topic_cat");
    }

    public function viewcpby_status($cp_status_code){
        $result = $this->db->query("SELECT
complaint_main.cp_id,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_topic,
complaint_main.cp_user_name,
complaint_main.cp_cus_name,
complaint_status.cp_status_id,
complaint_status.cp_status_name,
complaint_main.cp_priority,
complaint_main.cp_status_code,
complaint_topic.topic_name,
complaint_topic_catagory.topic_cat_name
FROM
complaint_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
 WHERE cp_status_code='$cp_status_code' ");
        return $result;
    }

    public function viewncby_status($nc_status_code){
        $result = $this->db->query("SELECT
nc_main.nc_id,
nc_main.nc_related_dept,
nc_main.nc_status_code,
complaint_status.cp_status_name,
complaint_department_main.cp_dept_main_name,
nc_main.nc_no,
complaint_main.cp_date,
complaint_main.cp_topic,
complaint_main.cp_topic_cat,
complaint_topic.topic_name,
complaint_topic_catagory.topic_cat_name,
complaint_main.cp_user_name,
complaint_main.cp_cus_name,
complaint_main.cp_priority
FROM
nc_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = nc_main.nc_status_code
INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = nc_main.nc_related_dept
INNER JOIN complaint_main ON complaint_main.cp_no = nc_main.nc_no
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
WHERE nc_main.nc_status_code='$nc_status_code' ");
        return $result->result_array();
    }


    public function viewby_user($cp_username){
        $result = $this->db->query("SELECT
complaint_main.cp_id,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_user_name,
complaint_main.cp_cus_name,
complaint_main.cp_priority,
complaint_status.cp_status_id,
complaint_status.cp_status_name,
complaint_main.cp_status_code,
complaint_topic.topic_name,
complaint_topic_catagory.topic_cat_name,
complaint_topic.topic_name
FROM
complaint_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
WHERE cp_user_name='$cp_username' ");
        return $result->result_array();
    }

    public function viewby_dept($cp_userdept){
        $result = $this->db->query("SELECT
complaint_main.cp_id,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_user_name,
complaint_main.cp_cus_name,
complaint_main.cp_priority,
complaint_status.cp_status_id,
complaint_status.cp_status_name,
complaint_main.cp_status_code,
complaint_topic.topic_name,
complaint_topic_catagory.topic_cat_name,
complaint_topic.topic_name,
complaint_main.cp_user_dept
FROM
complaint_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic WHERE cp_user_dept='$cp_userdept' ");
        return $result->result_array();
    }

    public function viewby_topic_cat($cp_topiccat_id){
        $result = $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_cus_name, complaint_main.cp_priority, complaint_main.cp_user_dept, complaint_main.cp_topic, complaint_main.cp_topic_cat, complaint_topic_catagory.topic_cat_name, complaint_topic.topic_name, complaint_main.cp_user_name, complaint_status.cp_status_name, complaint_main.cp_status_code FROM complaint_main INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code WHERE cp_topic_cat ='$cp_topiccat_id'");
        return $result->result_array();
    }


    public function graph1CP(){
        $result = $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_date, count(complaint_main.cp_date) as total, complaint_main.cp_status_code , substr(cp_date,6,2) AS months FROM complaint_main WHERE cp_status_code in ('cp01','cp02','cp03','cp04' ,'cp05','cp06','cp07','cp08') GROUP BY months");
        return $result->result_array();
    }

    public function graph1NC(){
        $result = $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_date, count(complaint_main.cp_date) as total, complaint_main.cp_status_code FROM complaint_main WHERE cp_status_code = 'cp05' GROUP BY cp_date");
        return $result->result_array();
    }


    public function graph_cp_day($graph_month){
$cutdate = substr($graph_month,0,2);

      $result = $this->db->query("SELECT
complaint_main.cp_id,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_topic_catagory.topic_cat_name,
COUNT(complaint_topic_catagory.topic_cat_name) AS sum
FROM
complaint_main
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
WHERE complaint_main.cp_date LIKE '%$cutdate%'
GROUP BY complaint_topic_catagory.topic_cat_name");

    return $result;
    }


    public function viewgraph_topic_cat($topiccat,$graph_month){

      $cutdate = substr($graph_month,0,2);

        $result = $this->db->query("SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_cus_name, complaint_main.cp_priority, complaint_main.cp_user_dept, complaint_main.cp_topic, complaint_main.cp_topic_cat, complaint_topic_catagory.topic_cat_name, complaint_topic.topic_name, complaint_main.cp_user_name, complaint_status.cp_status_name, complaint_main.cp_status_code FROM complaint_main INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code WHERE topic_cat_name ='$topiccat' && cp_date LIKE '%$cutdate%' ");
        return $result->result_array();
    }






}


?>
