<?php
class History extends CI_Controller{
    public function __construct() {
        parent::__construct();

        $this->load->model("history_model");
    }

    public function add_history($cp_no){
        $this->history_model->save_history();

        header("refresh:0; url=http://192.190.10.27/complaint/complaint/edit/$cp_no");
    }


    public function save_inves_history($cp_no){
        $this->history_model->save_inves_history($cp_no);
        redirect('/complaint/edit_investigate/'.$cp_no);
//        header("refresh:0; url=http://192.190.10.27/complaint/complaint/edit_investigate/$cp_no");
    }

    public function savenc_sec3_history($cp_no,$nc_related_dept){
        $this->history_model->savenc_sec3($cp_no);
        redirect('/nc/nc_sec3edit/'.$cp_no.'/'.$nc_related_dept);
    }






}


?>
