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


// Export Menu CP
    public function exp_cpby_status(){
      $status = $this->input->post('by_status');
      $this->report_model->exp_cpby_status($status);
    }

    public function exp_cpby_dept(){
      $dept = $this->input->post('by_dept');
      $this->report_model->exp_cpby_dept($dept);
    }

    public function exp_cpby_user(){
      $user = $this->input->post('by_user');
      $this->report_model->exp_cpby_user($user);
    }

    public function exp_cpby_cat(){
      $category = $this->input->post('by_category');
      $this->report_model->exp_cpby_cat($category);
    }

    public function exp_cpby_all(){
      $this->report_model->exp_cpby_all();
    }

    public function exp_cpby_related_dept(){
      $related_dept = $this->input->post("by_related_dept");
      $this->report_model->exp_cpby_related_dept($related_dept);
    }


    // Export Menu NC
        public function exp_ncby_status(){
          $status = $this->input->post('by_status_nc');
          $this->report_model->exp_ncby_status($status);
        }

        public function exp_ncby_dept(){
          $dept = $this->input->post('by_dept_nc');
          $this->report_model->exp_ncby_dept($dept);
        }

        public function exp_ncby_user(){
          $user = $this->input->post('by_user_nc');
          $this->report_model->exp_ncby_user($user);
        }

        public function exp_ncby_cat(){
          $category = $this->input->post('by_category_nc');
          $this->report_model->exp_ncby_cat($category);
        }

        public function exp_ncby_all(){
          $this->report_model->exp_ncby_all();
        }

        public function exp_ncby_related_dept(){
          $related_dept = $this->input->post('by_related_dept_nc');
          $this->report_model->exp_ncby_related_dept($related_dept);
        }





}




?>
