<?php
class Nc extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model("complaint_model");
        $this->load->model("login_model");
        $this->load->model("nc_model");
        $this->load->model("history_model");

    }

    public function index(){
       $this->login_model->call_login();
       $data['getuser'] = $this->login_model->getuser();
       $data['list_nc'] = $this->nc_model->list_nc();
       $data['get_topic_search'] = $this->complaint_model->get_topic_search();


        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("nc/index",$data);
    }

    public function main($cp_no,$nc_related_dept){
        $this->login_model->call_login();
        $data['getuser'] = $this->login_model->getuser();
        $data['getdatamain'] = $this->nc_model->getdata_main($cp_no,$nc_related_dept);
        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);


        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("nc/main", $data);
    }



    /******************************Save Zone**************************************/

    public function save_sec3($cp_no,$nc_related_dept){
        $this->nc_model->save_ncsec3($cp_no,$nc_related_dept);
        header("refresh:1; url=http://203.107.156.180/intsys/complaint/nc/main/$cp_no/$nc_related_dept");
    }


    public function nc_sec3edit($cp_no,$nc_related_dept){
        $this->login_model->call_login();
        $data['getuser'] = $this->login_model->getuser();
        $data['getdatamain'] = $this->nc_model->getdata_main($cp_no,$nc_related_dept);
        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);


        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("nc/nc_sec3edit", $data);
    }


    public function savenc_sec3edit($cp_no,$nc_related_dept){
        $this->history_model->save_editnc_sec3();
        $this->nc_model->savenc_sec3edit($cp_no,$nc_related_dept);
    }


    public function save_sec4f1($cp_no,$nc_related_dept){
        $this->nc_model->save_sec4f1($cp_no,$nc_related_dept);
    }

    public function save_sec4f2($cp_no,$nc_related_dept){
        $this->nc_model->save_sec4f2($cp_no,$nc_related_dept);
    }

    public function save_sec4f3($cp_no,$nc_related_dept){
        $this->nc_model->save_sec4f3($cp_no,$nc_related_dept);
    }

    public function save_sec5($cp_no,$nc_related_dept){
        $this->nc_model->save_sec5($cp_no,$nc_related_dept);
    }

    public function save_sec5failed($cp_no,$nc_related_dept){
        $this->nc_model->save_sec5failed($cp_no,$nc_related_dept);
    }

    public function create_cpfailed($cp_no){
        $this->nc_model->create_cpfailed($cp_no);
    }













}



?>
