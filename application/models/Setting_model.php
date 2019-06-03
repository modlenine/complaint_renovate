<?php
class Setting_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }




//    TOPIC SETTING++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function view_topic($toppic_cat_id){
        $result = $this->db->query("SELECT complaint_topic.topic_id, complaint_topic.topic_name, complaint_topic.topic_cat_id, complaint_topic_catagory.topic_cat_name FROM complaint_topic INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_topic.topic_cat_id WHERE complaint_topic.topic_cat_id='$toppic_cat_id' ");
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
    $result = $this->db->query("SELECT * FROM complaint_department_main");
    return $result->result_array();
}

public function get_dept_edit($deptid){
    $result = $this->db->query("SELECT * FROM complaint_department_main WHERE cp_dept_main_id='$deptid' ");
    return $result->row();
}

public function save_dept_edit_setting($deptid){
    $data = array(
        "cp_dept_main_name" => $this->input->post("edit_deptname"),
        "cp_dept_main_code" => $this->input->post("edit_deptcode")
    );

    $this->db->where("cp_dept_main_id",$deptid);
    $update = $this->db->update("complaint_department_main",$data);

    if(!$update){
        echo '<script language="javascript">';
            echo 'alert("Start Investigate Failed !!")';
            echo '</script>';
            exit();
        } else {
            echo '<script language="javascript">';
            echo 'alert("Update Success")';
            echo '</script>';
            redirect('setting/thkpage/');
        }

}



public function add_dept(){
    $data = array(
        "cp_dept_main_name" => $this->input->post("add_catename"),
        "cp_dept_main_code" => $this->input->post("add_catcode")
    );

    $this->db->insert("complaint_department_main",$data);

}


public function del_dept_setting($deptid){
    $this->db->delete("complaint_department_main" , array("cp_dept_main_id" => $deptid) );
}









//END DEPARTMENT SETTING +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++





//PRIORITY SETTING ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
public function priority_setting(){

}

public function get_pri_cat(){
    return $this->db->query("SELECT * FROM complaint_priorityn_category");
}


public function get_pri(){
    return $this->db->query("SELECT * FROM complaint_priorityn ");
}

public function save_priority(){
    $check_score = $this->input->post("show_id");
    $update_score = $this->input->post("show_scoreN");

    $update_cat = array(
        "pricat_score" => $update_score
    );

    $this->db->where("pricat_id",$check_score);
    $this->db->update("complaint_priorityN_category",$update_cat);



    $data = array(
        "pri_name" => $this->input->post("priority_name"),
        "pri_catid" => $this->input->post("show_id"),
        "pri_score" => $this->input->post("set_score")
    );

    $result = $this->db->insert("complaint_priorityN",$data);

    if ($result) {
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
            redirect('setting/thkpage/');
        } else {
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed !!!!")';
            echo 'history.back()';
            echo '</script>';
            exit();
        }

}


public function del_priority($pri_id){
    $query = $this->db->query("SELECT complaint_priorityn.pri_score, complaint_priorityn_category.pricat_score, complaint_priorityn_category.pricat_name, complaint_priorityn_category.pricat_id FROM complaint_priorityn INNER JOIN complaint_priorityn_category ON complaint_priorityn_category.pricat_id = complaint_priorityn.pri_catid WHERE pri_id = $pri_id");
    $result = $query->row();

    $score_pri = $result->pri_score;
    $score_balance = $result->pricat_score;
    $pricat_id = $result->pricat_id;

    $sum = $score_pri + $score_balance;

    $return_score = array(
        "pricat_score" => $sum
    );


    $this->db->where("pricat_id",$pricat_id);
    $this->db->update("complaint_priorityN_category",$return_score);

}


public function delect_pri($pri_id){
    return $this->db->delete('complaint_priorityN', array('pri_id' => $pri_id));
}


public function selectby_cat($by_catid){
    return $this->db->query("SELECT * FROM complaint_priorityn INNER JOIN complaint_priorityn_category ON complaint_priorityn_category.pricat_id = complaint_priorityn.pri_catid WHERE pricat_id = $by_catid ");


}

public function callcatid($by_catid){
    $result = $this->db->query(" SELECT * FROM complaint_priorityN_category WHERE pricat_id =$by_catid ");
    return $result->row();
}






//PRIORITY SETTING ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++




}



?>
