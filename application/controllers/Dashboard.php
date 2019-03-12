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
        
        
        $this->load->view("head/head_code");
        $this->load->view("dashboard/index");
    }
    
    
    
    
}


?>