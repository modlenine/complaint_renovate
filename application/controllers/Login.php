<?php
class Login extends CI_Controller{
    public function __construct() {
        parent::__construct();

        $this->load->model("login_model");
    }

    public function index(){

//        $this->load->library('user_agent');
//        $this->session->set_userdata('referrer_url', $this->agent->referrer() );

        $this->load->view("head/head_code_login");
        $this->load->view("head/javascript");

        if(isset($_SESSION['username']) == ""){
           $this->load->view("login/index");

        }else{
            header("refresh:0; url=http://203.107.156.180/intsys/complaint/");
        }



    }


    public function check_login(){
        $this->login_model->check_login();
    }




    public function action()
    {
        if (isset($_POST["action"])) {
            if ($_POST["action"] == "update_time") {
                $datetimes = date("Y-m-d H:m:s");
                $logindetailid = $_SESSION["login_id"];
                $statement = $this->db->query("UPDATE complaint_login_detail SET cp_login_lastactivity = '$datetimes' WHERE cp_login_id = '$logindetailid' ");

            }
            if ($_POST["action"] == "fetch_data") {
                $output = '';

                $datenow = date("Y-m-d H:m:s");
                // echo $datenow ."<br>";

                $date = date_create($datenow);
                date_sub($date, date_interval_create_from_date_string('5 second'));
                $datewhere = date_format($date, 'Y-m-d H:m:s');

                // echo $datewhere;

                $statement = $this->db->query("SELECT member.Fname, member.Lname, member.ecode, complaint_login_detail.cp_login_id, complaint_login_detail.cp_login_ecode, complaint_login_detail.cp_login_lastactivity, complaint_login_detail.cp_login_status, complaint_login_detail.cp_login_lastactivity2, complaint_login_detail.cp_login_status2 FROM member INNER JOIN complaint_login_detail ON complaint_login_detail.cp_login_ecode = member.ecode WHERE cp_login_status = 'login' AND cp_login_status2 !='logout'  ");

                $count = $statement->num_rows();
                // echo  $count;
//                 $output .= '
//   <div class="table-responsive">
//    <div align="right">
//     ' . $count . ' &nbsp;<i class="fas fa-user-alt"></i>&nbsp;Users Online
//    </div>
//    <table class="table table-bordered">
//     <tr>
//      <th>No.</th>
//      <th>User</th>
//     </tr>
//   ';

//                 $i = 0;
//                 foreach($statement->result_array() as $row) {
//                     $i = $i + 1;

//    $output .= '
//    <tr>
//     <td>' . $i . '</td>
//     <td>' . $row["Fname"] . '&nbsp;&nbsp;<i class="fas fa-user-alt"></i></td>
//    </tr>
//    ';
//                 }
//                 $output .= '</table></div>';
//                 echo $output;


$output .= '<div class="panel panel-warning">
  <!-- Default panel contents -->
  <div class="panel-heading" style="font-size:12px;"><i class="fas fa-user-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;User Online</div>
  <div class="panel-body">
';

$i = 0;

                foreach($statement->result_array() as $row) {
                  $cutLnameOnline = substr($row['Lname'],0,1);
                  $convert_nameOnline = $row['Fname']."_".$cutLnameOnline;
                    $i = $i + 1;
$output .='
    <p><span style="color:black;font-size:11px;">'.$i.'</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:black;font-size:11px;">'.$convert_nameOnline.'&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-user-alt" style="color:#33CC00;"></i></span></p>
    ';
                }
$output .='
  </div>
  ';

  echo $output;




            }
        }
    }




}//****End of controller*****//


?>
