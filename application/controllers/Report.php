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

    public function export_cpby_status($cp_status_code){
      $this->report_model->export_cpby_status($cp_status_code);
    }

    public function export_ncby_status($nc_status_code){
      $this->report_model->export_ncby_status($nc_status_code);
    }

    public function expcp_getstatus(){
      $this->report_model->expcp_getstatus();
    }





}




?>
