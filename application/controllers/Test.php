<?php
class Test extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model("test_model");
    }
    
    public function index(){
        $this->test_model->send_email();
    }
    
}


?>