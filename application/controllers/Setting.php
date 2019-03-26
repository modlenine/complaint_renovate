<?php
class Setting extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->model("complaint_model");
        $this->load->model("login_model");
        $this->load->model("nc_model");
        $this->load->model("dashboard_model");
        $this->load->model("setting_model");
    }
    
    public function topic_setting(){
        $this->login_model->call_login();
        
        $data['getuser'] = $this->login_model->getuser();
        $data['view_topic'] = $this->setting_model->view_topic();
        $data['get_topiccat'] = $this->setting_model->get_topiccat();
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("setting/topic_setting",$data);
    }
    
    public function topic_edit($topicid){
        $this->login_model->call_login();
        $data['getedit_topic'] = $this->setting_model->getedit_topic($topicid);
        $data['get_topiccat'] = $this->setting_model->get_topiccat();
        
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("setting/topic_edit",$data);
    }
    
    public function save_topic_edit($topicid){
        $this->setting_model->save_topic_edit($topicid);
    }
    
    public function thkpage(){
        $this->load->view("head/head_code");
        $this->load->view("setting/thankyou_page");
    }
    
    public function add_topic(){
        $this->setting_model->add_topic();
        redirect('setting/topic_setting/');
    }
    
    public function category_edit($catid){
        $this->login_model->call_login();
        $data['get_category'] = $this->setting_model->get_category($catid);
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("setting/cat_edit",$data);
    }
    
    public function save_cat_edit($catid){
        $this->setting_model->save_cat_edit($catid);
    }
    
    public function add_category(){
        $this->setting_model->add_category();
        redirect('setting/topic_setting/');
    }
    
    public function del_topic($topic_id){
        $this->setting_model->del_topic($topic_id);
        redirect('setting/topic_setting/');
    }
    
    public function del_category($cat_id){
        $this->setting_model->del_category($cat_id);
        redirect('setting/topic_setting/');
    }
    
    public function dept_setting(){
        $this->login_model->call_login();
        $data['getuser'] = $this->login_model->getuser();
        $data['get_dept_setting'] = $this->setting_model->get_dept_setting();
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("setting/department/dept_setting",$data);
    }
    
    public function dept_edit_setting(){
        $this->login_model->call_login();
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("setting/department/dept_edit_setting");
    }
    
    public function del_dept_setting(){
        
    }
    
    public function add_dept_setting(){
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
}




?>