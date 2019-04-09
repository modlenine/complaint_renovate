<?php
class Test extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model("test_model");
    }
    
    public function index(){
        $this->test_model->send_email();
    }


    public function testcpno(){
        $cur_year = date("Y");
        $cut_cur_year = substr($cur_year,2,2);

        $query = $this->db->query("select cp_no from complaint_main order by SUBSTR(cp_no,3) desc LIMIT 1");
        foreach($query->result_array() as $q){
               $sum = $q['cp_no'];
        }

        $cut1 = substr($sum,2,2);
        
        if($cut1 != $cut_cur_year){
            // $start_newyear = "CP".$cut_cur_year."001";
            // $cp_no = $start_newyear;
            echo "ไม่เท่ากัน<br>";
        }else{
            // $cut_cp = substr($sum, 2); // 18100
            // $cut_cp++;
            // $cp_no = $cut_cp;
            echo "เท่ากัน<br>";
        }




        echo $cut1."<br>";
        echo $cut_cur_year."<br>";
        echo $sum;

    }




    
}


?>