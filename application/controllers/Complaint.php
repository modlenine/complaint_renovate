<?php
class Complaint extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model("complaint_model");
        $this->load->model("login_model");
        $this->load->model("history_model");
    }
    
    public function index(){/***************List Page***************/
        $this->login_model->call_login();
        
        $data['list_cp'] = $this->complaint_model->list_cp();
        $data['getuser'] = $this->login_model->getuser();
        
        $this->load->view("head/head_code");
        $this->load->view("complaint/index",$data);
    }
    
    public function view($cp_no){/***************View Page***************/
        $this->login_model->call_login();
        $this->complaint_model->check_status_page($cp_no);
        
        $data['view_cp'] = $this->complaint_model->view_cp($cp_no);
        
        
        $data['get_file'] = $this->complaint_model->get_file($cp_no);
        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);
        $data['getuser'] = $this->login_model->getuser();
        $data['get_pri_use'] = $this->complaint_model->get_pri_view($cp_no);
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/view",$data);
    }
    
    
    public function inves_starting($cp_no){/*******Change New Complaint to Complaint Analyzed**********/
        $change1 = $this->complaint_model->change_status_to1($cp_no);
        if(!$change1){
            echo '<script language="javascript">';
            echo 'alert("Start Investigate Failed !!")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Start Investigate Success")';
            echo '</script>';
            
            header("refresh:0; url=http://192.190.10.27/complaint/complaint/investigate/$cp_no");
        }
    }
    
    
    public function add($dept_code){/***************Add Page***************/
        $this->login_model->call_login();
        
        $data['get_toppic'] = $this->complaint_model->get_toppic();
        
        $data['getuser'] = $this->login_model->getuser();
        $data['get_dept_respons'] = $this->complaint_model->get_dept_respons($dept_code);
        $data['get_pri_topic'] = $this->complaint_model->get_pri_topic();
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/add",$data);
    }
    
    public function edit($cp_no){/************Edit data Page**************/
        $this->login_model->call_login();
        
        $data['get_toppic'] = $this->complaint_model->get_toppic();
        $data['view_cp'] = $this->complaint_model->view_cp($cp_no);
        
        $data['getuser'] = $this->login_model->getuser();
        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);
        $data['getdept_checkbox'] = $this->complaint_model->getdept_checkbox($cp_no);

        $data['get_pri_topic'] = $this->complaint_model->get_pri_topic();
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/edit",$data);
    }
    
    
    public function savedata_edit($cp_no){
        $this->history_model->saveedit_history();
        
        $this->complaint_model->savedata_edit($cp_no);
        header("refresh:1; url=http://192.190.10.27/complaint/");
    }
    
    
    
    public function logout(){/************Logout btn*************/
        $this->login_model->logout();
    }
    
    public function investigate($cp_no){
        $this->login_model->call_login();
        $this->complaint_model->check_status_page2($cp_no);
        
        $data['view_cp'] = $this->complaint_model->view_cp($cp_no);
        

        $data['get_file'] = $this->complaint_model->get_file($cp_no);
        $data['get_dept'] = $this->complaint_model->get_dept($cp_no);
        $data['getuser'] = $this->login_model->getuser();
        $data['get_pri_use'] = $this->complaint_model->get_pri_view($cp_no);
        
        $this->load->view("head/head_code");
        $this->load->view("head/javascript");
        $this->load->view("complaint/investigate",$data);
    }
    
    
    public function add_detail_inves($cp_no){
        $this->login_model->call_login();
        
        $this->complaint_model->add_detail_inves($cp_no);
        
        header("refresh:1; url=http://192.190.10.27/complaint/complaint/investigate/$cp_no");
    }
    
    
    public function add_sum_inves($cp_no){
        $this->complaint_model->add_sum_inves($cp_no);
        header("refresh:1; url=http://192.190.10.27/complaint/complaint/investigate/$cp_no");
    }
    
    
    public function add_conclusion($cp_no){
        $this->complaint_model->add_conclusion($cp_no);
        header("refresh:1; url=http://192.190.10.27/complaint/complaint/investigate/$cp_no");
    }
    
    
    public function saveData(){
        $this->complaint_model->save_newcomplaint();
        
        header("refresh:0; url=http://192.190.10.27/complaint");
    }
    
    
    
}//***End of controller****//
?>
