<?php
class Report extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model("report_model");
    }
    
    
    public function main_report($cp_no){
        $this->report_model->main_report($cp_no);
    }
    
    public function export_btn(){
        $this->report_model->export_btn();
    }
    
    
    
    
}




?>