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
    
    public function dept_edit_setting($deptid){
        $this->login_model->call_login();
        $data['get_dept_edit'] = $this->setting_model->get_dept_edit($deptid);
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("setting/department/dept_edit_setting",$data);
    }
    
    
    public function save_dept_edit_setting($deptid){
        $this->setting_model->save_dept_edit_setting($deptid);
    }
    
    
    
    public function del_dept_setting($deptid){
        $this->setting_model->del_dept_setting($deptid);
        redirect('setting/dept_setting/');
    }
    
    public function add_dept(){
        $this->setting_model->add_dept();
        redirect('setting/dept_setting/');
    }
    
    
    
    
    public function priority_setting(){
        $this->login_model->call_login();
        
        $data['getuser'] = $this->login_model->getuser();
        $data['get_pri_cat'] = $this->setting_model->get_pri_cat();
        $data['get_pri'] = $this->setting_model->get_pri();
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("setting/priority/view",$data);
    }
    
    
    public function add_priority($by_catid){
        $data['callcatid'] = $this->setting_model->callcatid($by_catid);
        $data['get_pri'] = $this->setting_model->get_pri();
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("setting/priority/add_priority",$data);
    }
    
    public function save_priority(){
        $this->setting_model->save_priority();
    }
    
    public function del_priority($pri_id,$pri_catid){
        $this->setting_model->del_priority($pri_id);
        $this->setting_model->delect_pri($pri_id);
        redirect('setting/selectby_cat/'.$pri_catid);
    }
    
    public function selectby_cat($by_catid){
        
        $this->login_model->call_login();
    
        $data['getuser'] = $this->login_model->getuser();
        $data['get_pri_cat'] = $this->setting_model->get_pri_cat();
        $data['selectby_cat'] = $this->setting_model->selectby_cat($by_catid);
        $data['callcatid'] = $this->setting_model->callcatid($by_catid);
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("setting/priority/view_select",$data);
    }
    
    
    public function select_toppicby_cat($toppic_cat_id){
        $this->login_model->call_login();
        $data['view_topic'] = $this->setting_model->view_topic($toppic_cat_id);
        $data['getuser'] = $this->login_model->getuser();
        $data['get_topiccat'] = $this->setting_model->get_topiccat();
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("setting/selectby_topic",$data);
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
}




?>