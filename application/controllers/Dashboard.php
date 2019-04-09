<?php
class Dashboard extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model("complaint_model");
        $this->load->model("login_model");
        $this->load->model("nc_model");
        $this->load->model("dashboard_model");
    }
    
    public function index(){
        $this->login_model->call_login();
        
        $data['get_cpstatus'] = $this->dashboard_model->get_cpstatus();
        $data['get_ncstatus'] = $this->dashboard_model->get_ncstatus();
        $data['getby_username'] = $this->dashboard_model->getby_username();
        $data['getby_dept'] = $this->dashboard_model->getby_dept();
        $data['getby_topic'] = $this->dashboard_model->getby_topic();
        
        
        $data['getuser'] = $this->login_model->getuser();
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("dashboard/index",$data);
    }
    
    
    public function viewcpby_status($cp_status_code){
        $this->login_model->call_login();
        
        $data['viewcpby_status'] = $this->dashboard_model->viewcpby_status($cp_status_code);
        $data['getuser'] = $this->login_model->getuser();
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("dashboard/viewcpby_status",$data);
    }
    
    public function viewncby_status($cp_status_code){
        $this->login_model->call_login();
        
        $data['getuser'] = $this->login_model->getuser();
        $data['viewncby_status'] = $this->dashboard_model->viewncby_status($cp_status_code);
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("dashboard/viewncby_status",$data);
    }
    
    public function viewby_user($cp_username){
        $this->login_model->call_login();
        
        $data['getuser'] = $this->login_model->getuser();
        $data['viewby_user'] = $this->dashboard_model->viewby_user($cp_username);
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("dashboard/viewby_user",$data);
    }
    
    public function viewby_dept($cp_userdept){
        $this->login_model->call_login();
        
        $data['getuser'] = $this->login_model->getuser();
        $data['viewby_dept'] = $this->dashboard_model->viewby_dept($cp_userdept);
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("dashboard/viewby_department",$data);
    }
    
    public function viewby_topic($cp_topic_id){
        $this->login_model->call_login();
        
        $data['getuser'] = $this->login_model->getuser();
        $data['viewby_topic'] = $this->dashboard_model->viewby_topic($cp_topic_id);
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("dashboard/viewby_topic",$data);
    }
    
    
    public function graph1(){
       
    }
    
    
    
}


?>