<?php
class Search extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model("search_model");
        $this->load->model("login_model");
        $this->load->model("complaint_model");
        $this->load->model("history_model");
        $this->load->model("nc_model");
    }


    public function searchby_date(){
        $this->login_model->call_login();

        $data['getuser'] = $this->login_model->getuser();
        $data['list_cp'] = $this->search_model->searchby_date();
        $data['get_topic_search'] = $this->complaint_model->get_topic_search();


        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
//        $this->load->view("search/searchby_date",$data);
        $this->load->view("complaint/index",$data);
    }


    public function searchby_docnum(){
        $this->login_model->call_login();

        $data['getuser'] = $this->login_model->getuser();
        $data['list_cp'] = $this->search_model->searchby_docnum();
        $data['get_topic_search'] = $this->complaint_model->get_topic_search();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/index",$data);
    }


    public function searchby_userinform(){
        $this->login_model->call_login();

        $data['getuser'] = $this->login_model->getuser();
        $data['list_cp'] = $this->search_model->searchby_userinform();
        $data['get_topic_search'] = $this->complaint_model->get_topic_search();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/index",$data);
    }


    public function searchby_topic(){
        $this->login_model->call_login();

        $data['getuser'] = $this->login_model->getuser();
        $data['list_cp'] = $this->search_model->searchby_topic();
        $data['get_topic_search'] = $this->complaint_model->get_topic_search();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/index",$data);
    }


    public function searchby_other(){
        $this->login_model->call_login();

        $data['getuser'] = $this->login_model->getuser();
        $data['list_cp'] = $this->search_model->searchby_other();
        $data['get_topic_search'] = $this->complaint_model->get_topic_search();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/index",$data);
    }


    public function export(){
        $this->search_model->excel();


    }

    public function export_section(){
        $data['getuser'] = $this->login_model->getuser();
        $data['expcp_getstatus'] = $this->search_model->expcp_getstatus();
        $data['expcp_getdept'] = $this->search_model->expcp_getdept();
        $data['expcp_getuser'] = $this->search_model->expcp_getuser();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("export/report_list",$data);
    }



    public function searchby_date_nc(){
        $this->login_model->call_login();

        $data['getuser'] = $this->login_model->getuser();
        $data['list_nc'] = $this->search_model->searchby_date_nc();
        $data['get_topic_search'] = $this->complaint_model->get_topic_search();


        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
//        $this->load->view("search/searchby_date",$data);
        $this->load->view("nc/index",$data);
    }

    public function searchby_docnum_nc(){
        $this->login_model->call_login();

        $data['getuser'] = $this->login_model->getuser();
        $data['list_nc'] = $this->search_model->searchby_docnum_nc();
        $data['get_topic_search'] = $this->complaint_model->get_topic_search();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("nc/index",$data);
    }

    public function searchby_userinform_nc(){
        $this->login_model->call_login();

        $data['getuser'] = $this->login_model->getuser();
        $data['list_nc'] = $this->search_model->searchby_userinform_nc();
        $data['get_topic_search'] = $this->complaint_model->get_topic_search();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("nc/index",$data);
    }


    public function searchby_topic_nc(){
        $this->login_model->call_login();

        $data['getuser'] = $this->login_model->getuser();
        $data['list_nc'] = $this->search_model->searchby_topic_nc();
        $data['get_topic_search'] = $this->complaint_model->get_topic_search();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("nc/index",$data);
    }





}


?>
