<?php
class Complaint extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model("complaint_model");
        $this->load->model("login_model");
        $this->load->model("history_model");
        $this->load->model("nc_model");
    }

    public function index(){/***************List Page***************/
        $data['list_cp'] = $this->complaint_model->list_cp();
        $data['getuser'] = $this->login_model->getuser();
        $data['get_topic_search'] = $this->complaint_model->get_topic_search();
        $data['get_relateddept_search'] = $this->complaint_model->get_relateddept_search();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/index",$data);
    }


    public function view($cp_no){/***************View Page***************/
        $this->complaint_model->check_status_page($cp_no);

        $data['view_cp'] = $this->complaint_model->view_cp($cp_no);

        $data['get_dept'] = $this->complaint_model->get_dept_view($cp_no);
        $data['getuser'] = $this->login_model->getuser();
        $data['get_pri_use'] = $this->complaint_model->get_pri_view($cp_no);

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/view",$data);
    }

    public function view_fail($cp_no){/***************View Page***************/
        $this->complaint_model->check_status_page($cp_no);

        $data['view_cp'] = $this->complaint_model->view_cp($cp_no);

        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);
        $data['getuser'] = $this->login_model->getuser();
        $data['get_pri_use'] = $this->complaint_model->get_pri_view($cp_no);

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/view_fail",$data);
    }


    public function inves_starting($cp_no){/*******Change New Complaint to Complaint Analyzed**********/
        $this->complaint_model->change_status_to1($cp_no);

        header("refresh:0; url=".base_url('complaint/investigate/').$cp_no);
    }

    public function inves_starting_fail($cp_no){/*******Change New Complaint to Complaint Analyzed**********/
        $this->complaint_model->change_status_to1($cp_no);

        header("refresh:0; url=".base_url('complaint/investigate_fail/').$cp_no);
    }


    public function add($dept_code , $raoFormno = ''){/***************Add Page***************/
        $data['topic_category'] = $this->complaint_model->fetch_topic_category();


        $data['get_category'] = $this->complaint_model->get_category();

        $data['getuser'] = $this->login_model->getuser();
        $data['get_dept_respons'] = $this->complaint_model->get_dept_respons($dept_code);
        $data['get_pri_topic'] = $this->complaint_model->get_pri_topic();

        $data['raoformno'] = $raoFormno;


        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/add",$data);
    }


    public function fetch_topic(){
        if($this->input->post("topic_cat_id")){
            echo $this->complaint_model->fetch_topic($this->input->post("topic_cat_id"));
        }
    }


    public function edit($cp_no){/************Edit data Page**************/
        $data['get_pri_use'] = $this->complaint_model->get_pri_view($cp_no);
        $data['view_cp'] = $this->complaint_model->view_cp($cp_no);
        $data['topic_category'] = $this->complaint_model->fetch_topic_category();
//        $data['get_toppic'] = $this->complaint_model->get_toppic();
        $data['getuser'] = $this->login_model->getuser();
        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);
        $data['getdept_checkbox'] = $this->complaint_model->getdept_checkbox($cp_no);


        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/edit",$data);
    }


    public function savedata_edit($cp_no){/*********Save data edit**************/

        $this->complaint_model->savedata_edit($cp_no);
        $this->history_model->saveedit_history();
        header("refresh:1; url=".base_url('complaint/view/').$cp_no);
    }



    public function logout(){/************Logout btn*************/
        $this->login_model->logout();
    }

    public function investigate($cp_no){
        $this->complaint_model->check_status_page2($cp_no);

        $data['view_cp'] = $this->complaint_model->view_cp($cp_no);
        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);
        $data['getuser'] = $this->login_model->getuser();
        $data['get_pri_use'] = $this->complaint_model->get_pri_view($cp_no);
        $data['getdept_checkbox'] = $this->complaint_model->getdept_checkbox($cp_no);

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/investigate",$data);
    }

    public function investigate_fail($cp_no){
        $this->complaint_model->check_status_page2($cp_no);

        $data['view_cp'] = $this->complaint_model->view_cp($cp_no);
        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);
        $data['getuser'] = $this->login_model->getuser();
        $data['get_pri_use'] = $this->complaint_model->get_pri_view($cp_no);

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/investigate_fail",$data);
    }


    public function edit_investigate($cp_no){
        $data['view_cp'] = $this->complaint_model->view_cp($cp_no);
        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);
        $data['getuser'] = $this->login_model->getuser();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint_edit/edit_inves",$data);
    }

    public function save_edit_investigate($cp_no){
        $this->history_model->saveedit_inves_history();
        $this->complaint_model->save_edit_inves($cp_no);
        redirect('/complaint/investigate/'.$cp_no);
       header("refresh:1; url=".base_url('complaint/investigate/').$cp_no);
    }


    public function add_detail_inves($cp_no){
        $this->complaint_model->add_detail_inves($cp_no);
        header("refresh:1; url=".base_url('complaint/investigate/').$cp_no);
    }


    public function add_sum_inves($cp_no){
        $this->complaint_model->add_sum_inves($cp_no);
        header("refresh:1; url=".base_url('complaint/investigate/').$cp_no);
    }


    public function add_conclusion($cp_no){
        $this->complaint_model->add_conclusion($cp_no);
        header("refresh:1; url=".base_url('complaint/investigate/').$cp_no);
    }


    public function saveData(){
        $this->complaint_model->check_pri_empty();
        $this->complaint_model->check_dept_empty();

        $this->complaint_model->active_email();
        $this->complaint_model->save_newcomplaint();
        $this->complaint_model->deactive_email();

        header("refresh:1; url=".base_url());
    }

    public function add_failed($cp_no,$nc_related_dept){
        $data['view_cp'] = $this->complaint_model->view_cp($cp_no);
//        $data['get_toppic'] = $this->complaint_model->get_toppic();
        $data['get_dept_respons'] = $this->complaint_model->get_dept_respons($nc_related_dept);
        $data['getuser'] = $this->login_model->getuser();
        $data['get_pri_use'] = $this->complaint_model->get_pri_view($cp_no);
        $data['get_pri_topic'] = $this->complaint_model->get_pri_topic();
        $data['getdatamain'] = $this->nc_model->getdata_main($cp_no,$nc_related_dept);

        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);
        $data['getdept_checkbox'] = $this->complaint_model->getdept_checkbox($cp_no);

        $data['topic_category'] = $this->complaint_model->fetch_topic_category();

        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/add_failed",$data);
    }

    public function saveData_failed($cp_no,$nc_related_dept){
        $this->complaint_model->update_ncstatus($cp_no,$nc_related_dept);
        $this->complaint_model->saveData_failed();


        redirect('/nc/main/'.$cp_no.'/'.$nc_related_dept);
    }

    public function test(){
       echo $this->complaint_model->conpriority(5);


        $this->load->view("test");
    }


    public function cancel_complaint($cp_no){
        $this->complaint_model->cancel_complaint($cp_no);
        header("refresh:1; url=".base_url());
    }


    public function edit_newcomplaint($cp_no)
    {
        $this->complaint_model->edit_newcomplaint($cp_no);
    }


    public function resend_email($get_cp_no)
    {
        $action_reset = $this->complaint_model->resend_email($get_cp_no);
        if($action_reset)
        {
            echo "<script>alert('Resend Email Success.');</script>";
            header("refresh:1; url=".base_url());
            die();
        }

    }

    // public function testemail()
    // {
    //     $subject = "Test Email";
    //     $body = "This is a test email.";
    //     $to = ["chainarong_k@saleecolour.com"];
    //     $cc = [];
        
    //     $result = emailSaveData($subject, $body, $to, $cc);
        
    //     // ส่ง response กลับเป็น JSON
    //     header('Content-Type: application/json');
    //     echo json_encode($result, JSON_UNESCAPED_UNICODE);
    // }




}//***End of controller****//
?>
