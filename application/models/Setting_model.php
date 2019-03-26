<?php
class Setting_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
  
    
    
//    TOPIC SETTING++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function view_topic(){
        $result = $this->db->query("SELECT complaint_topic.topic_id, complaint_topic.topic_name, complaint_topic.topic_cat_id, complaint_topic_catagory.topic_cat_name FROM complaint_topic INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_topic.topic_cat_id");
        return $result->result_array();
    }
    
    public function get_topiccat(){
        $result = $this->db->query("SELECT complaint_topic_catagory.topic_cat_name,complaint_topic_catagory.topic_cat_id FROM complaint_topic_catagory ");
        return $result->result_array();
    }
    
    public function getedit_topic($topicid){
         $result = $this->db->query("SELECT complaint_topic.topic_id, complaint_topic.topic_name, complaint_topic.topic_cat_id, complaint_topic_catagory.topic_cat_name FROM complaint_topic INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_topic.topic_cat_id WHERE topic_id='$topicid' ");
         return $result->row();
    }
    
    public function save_topic_edit($topicid){
        $edit_topic = array(
            "topic_name" => $this->input->post("topic_edit"),
            "topic_cat_id" => $this->input->post("cateshow_edit")
        );
        
        $this->db->where("topic_id",$topicid);
        $this->db->update("complaint_topic",$edit_topic);
        
        redirect('setting/thkpage/');
    }
    
    public function add_topic(){
        
        $cat_id = $this->input->post("topic_category");
        $check_num = $this->db->query("SELECT topic_id FROM complaint_topic WHERE topic_cat_id='$cat_id' ");
        $numrow = $check_num->num_rows();
        if($numrow == ""){
            $top_id = $cat_id."0";
            $top_id++;
        }else{
            $result = $this->db->query("SELECT topic_id FROM complaint_topic WHERE topic_cat_id='$cat_id' ORDER BY topic_id DESC LIMIT 1 ");
            $results = $result->row();
            $top_id = $results->topic_id;
            $top_id++;
        }
        
        $add_topic = array(
            "topic_id" => $top_id,
            "topic_name" => $this->input->post("add_topicname"),
            "topic_cat_id" => $cat_id
        );

        $this->db->insert("complaint_topic",$add_topic);
        
    }
    
    
    public function get_category($catid){
        $result = $this->db->query("SELECT complaint_topic_catagory.topic_cat_id, complaint_topic_catagory.topic_cat_name FROM complaint_topic_catagory WHERE topic_cat_id='$catid' ");
        return $result->row();
    }
    
    
    public function save_cat_edit($catid){
        $cat_name = $this->input->post("cat_edit");
       $this->db->query("UPDATE complaint_topic_catagory SET topic_cat_name='$cat_name' WHERE topic_cat_id='$catid' ");
       
       redirect('setting/thkpage/');
    }
    
    public function add_category(){
        $add_cat_name = $this->input->post("add_catename");
        $result = $this->db->query("SELECT topic_cat_id FROM complaint_topic_catagory ORDER BY topic_cat_id DESC LIMIT 1");
        $results = $result->row();
        $cat_id = $results->topic_cat_id;
        $cat_id++;
        
        $add_cat = array(
            "topic_cat_id" => $cat_id,
            "topic_cat_name" =>$add_cat_name
        );
        
        $this->db->insert("complaint_topic_catagory",$add_cat);
    }
    
    public function del_topic($topic_id){
        $this->db->delete('complaint_topic', array('topic_id' => $topic_id));
    }
    
    public function del_category($cat_id){
        $this->db->delete('complaint_topic_catagory' , array('topic_cat_id' => $cat_id));
    }
//    END TOPIC SETTING++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    
    
    
    
 
    
    
//DEPARTMENT SETTING ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
public function get_dept_setting(){
    $result = $this->db->query("SELECT cp_dept_main_name , cp_dept_main_code FROM complaint_department_main");
    return $result->result_array();
}

public function get_dept_edit(){
    $result = $this->db->query("SELECT cp_dept_main_name , cp_dept_main_code FROM complaint_depart");
}

public function dept_edit_setting(){
    
}
    
    
    
    
    
    
    
    
    
//END DEPARTMENT SETTING +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    
    
    
    
}



?>