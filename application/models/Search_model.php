<?php
class Search_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        require ("PHPExcel/Classes/PHPExcel.php");

    }

    public function searchby_date(){
        $date_start = $this->input->post("date_start");
        $date_end = $this->input->post("date_end");


       $result = $this->db->query("SELECT
complaint_main.cp_id,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_user_name,
complaint_main.cp_cus_name,
complaint_main.cp_priority,
complaint_main.cp_status_code,
cp_status_id,
complaint_main.cp_no_old,
complaint_status.cp_status_name,
complaint_topic.topic_name
FROM
complaint_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic WHERE cp_date BETWEEN '$date_start' AND '$date_end' ORDER BY cp_date ASC");

       return $result->result_array();


    }


public function searchby_date_nc(){
        $date_start = $this->input->post("date_start");
        $date_end = $this->input->post("date_end");


      return $result = $this->db->query("SELECT complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_user_name, complaint_main.cp_user_empid, complaint_main.cp_user_dept, complaint_main.cp_cus_name, complaint_main.cp_cus_ref, complaint_main.cp_invoice_no, complaint_main.cp_pro_code, complaint_main.cp_pro_lotno, complaint_main.cp_pro_qty, complaint_main.cp_file, complaint_main.cp_detail, complaint_main.nc_status_code, complaint_main.nc_sec31, complaint_main.nc_sec32, complaint_main.nc_sec32date, complaint_main.nc_sec32time, complaint_main.nc_sec33, complaint_main.nc_sec33date, complaint_main.nc_sec33time, complaint_main.nc_sec3owner, complaint_main.nc_sec3empid, complaint_main.nc_sec3dept, complaint_main.nc_sec3date, complaint_main.nc_sec4f1, complaint_main.nc_sec4f1_file, complaint_main.nc_sec4f1_status, complaint_main.nc_sec4f1_date, complaint_main.nc_sec4f1_time, complaint_main.nc_sec4f1_signature, complaint_main.nc_sec4f2, complaint_main.nc_sec4f2_file, complaint_main.nc_sec4f2_status, complaint_main.nc_sec4f2_date, complaint_main.nc_sec4f2_time, complaint_main.nc_sec4f2_signature, complaint_main.nc_sec4f3, complaint_main.nc_sec4f3_file, complaint_main.nc_sec4f3_status, complaint_main.nc_sec4f3_signature, complaint_main.nc_sec5, complaint_main.nc_sec5file, complaint_main.nc_sec5cost, complaint_main.nc_sec5cost_detail, complaint_main.nc_sec5failed, complaint_main.nc_sec5filefailed, complaint_main.nc_sec5costfailed, complaint_main.cp_no_old, complaint_topic.topic_name, complaint_topic_catagory.topic_cat_name, complaint_main.cp_status_code, complaint_status.cp_status_name,complaint_main.cp_priority FROM complaint_main INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.nc_status_code WHERE cp_status_code = 'cp05' AND cp_date BETWEEN '$date_start' AND '$date_end' ORDER BY cp_date ASC");

    }





    public function searchby_docnum(){
        $searchby_docnum = $this->input->post("searchby_docnum");

        $result = $this->db->query("SELECT
complaint_main.cp_id,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_user_name,
complaint_main.cp_cus_name,
complaint_main.cp_priority,
complaint_main.cp_no_old,
complaint_main.cp_status_code,
cp_status_id,
complaint_status.cp_status_name,
complaint_topic.topic_name
FROM
complaint_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic WHERE cp_no LIKE '%$searchby_docnum%' ORDER BY cp_no ASC ");

        return $result->result_array();

    }



    public function searchby_docnum_nc(){
        $searchby_docnum = $this->input->post("searchby_docnum");

        return $result = $this->db->query("SELECT complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_user_name, complaint_main.cp_user_empid, complaint_main.cp_user_dept, complaint_main.cp_cus_name, complaint_main.cp_cus_ref, complaint_main.cp_invoice_no, complaint_main.cp_pro_code, complaint_main.cp_pro_lotno, complaint_main.cp_pro_qty, complaint_main.cp_file, complaint_main.cp_detail, complaint_main.nc_status_code, complaint_main.nc_sec31, complaint_main.nc_sec32, complaint_main.nc_sec32date, complaint_main.nc_sec32time, complaint_main.nc_sec33, complaint_main.nc_sec33date, complaint_main.nc_sec33time, complaint_main.nc_sec3owner, complaint_main.nc_sec3empid, complaint_main.nc_sec3dept, complaint_main.nc_sec3date, complaint_main.nc_sec4f1, complaint_main.nc_sec4f1_file, complaint_main.nc_sec4f1_status, complaint_main.nc_sec4f1_date, complaint_main.nc_sec4f1_time, complaint_main.nc_sec4f1_signature, complaint_main.nc_sec4f2, complaint_main.nc_sec4f2_file, complaint_main.nc_sec4f2_status, complaint_main.nc_sec4f2_date, complaint_main.nc_sec4f2_time, complaint_main.nc_sec4f2_signature, complaint_main.nc_sec4f3, complaint_main.nc_sec4f3_file, complaint_main.nc_sec4f3_status, complaint_main.nc_sec4f3_signature, complaint_main.nc_sec5, complaint_main.nc_sec5file, complaint_main.nc_sec5cost, complaint_main.nc_sec5cost_detail, complaint_main.nc_sec5failed, complaint_main.nc_sec5filefailed, complaint_main.nc_sec5costfailed, complaint_main.cp_no_old, complaint_topic.topic_name, complaint_topic_catagory.topic_cat_name, complaint_main.cp_status_code, complaint_status.cp_status_name,complaint_main.cp_priority FROM complaint_main INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.nc_status_code WHERE cp_status_code = 'cp05' AND cp_no LIKE '%$searchby_docnum%' ORDER BY cp_no ASC ");


    }




    public function searchby_userinform(){
        $searchby_userinform = $this->input->post("searchby_userinform");

        $result = $this->db->query("SELECT
complaint_main.cp_id,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_user_name,
complaint_main.cp_cus_name,
complaint_main.cp_priority,
complaint_main.cp_status_code,
complaint_main.cp_no_old,
cp_status_id,
complaint_status.cp_status_name,
complaint_topic.topic_name
FROM
complaint_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic WHERE cp_user_name LIKE '%$searchby_userinform%' ORDER BY cp_no ASC ");

        return $result->result_array();

    }


public function searchby_userinform_nc(){
        $searchby_userinform = $this->input->post("searchby_userinform");

        return $result = $this->db->query("SELECT complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_user_name, complaint_main.cp_user_empid, complaint_main.cp_user_dept, complaint_main.cp_cus_name, complaint_main.cp_cus_ref, complaint_main.cp_invoice_no, complaint_main.cp_pro_code, complaint_main.cp_pro_lotno, complaint_main.cp_pro_qty, complaint_main.cp_file, complaint_main.cp_detail, complaint_main.nc_status_code, complaint_main.nc_sec31, complaint_main.nc_sec32, complaint_main.nc_sec32date, complaint_main.nc_sec32time, complaint_main.nc_sec33, complaint_main.nc_sec33date, complaint_main.nc_sec33time, complaint_main.nc_sec3owner, complaint_main.nc_sec3empid, complaint_main.nc_sec3dept, complaint_main.nc_sec3date, complaint_main.nc_sec4f1, complaint_main.nc_sec4f1_file, complaint_main.nc_sec4f1_status, complaint_main.nc_sec4f1_date, complaint_main.nc_sec4f1_time, complaint_main.nc_sec4f1_signature, complaint_main.nc_sec4f2, complaint_main.nc_sec4f2_file, complaint_main.nc_sec4f2_status, complaint_main.nc_sec4f2_date, complaint_main.nc_sec4f2_time, complaint_main.nc_sec4f2_signature, complaint_main.nc_sec4f3, complaint_main.nc_sec4f3_file, complaint_main.nc_sec4f3_status, complaint_main.nc_sec4f3_signature, complaint_main.nc_sec5, complaint_main.nc_sec5file, complaint_main.nc_sec5cost, complaint_main.nc_sec5cost_detail, complaint_main.nc_sec5failed, complaint_main.nc_sec5filefailed, complaint_main.nc_sec5costfailed, complaint_main.cp_no_old, complaint_topic.topic_name, complaint_topic_catagory.topic_cat_name, complaint_main.cp_status_code, complaint_status.cp_status_name,complaint_main.cp_priority FROM complaint_main INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.nc_status_code WHERE cp_status_code = 'cp05' AND cp_user_name LIKE '%$searchby_userinform%' ORDER BY cp_no ASC ");


    }


    public function searchby_topic(){
        $searchby_topic = $this->input->post("searchby_topic");


        $result = $this->db->query("SELECT
complaint_main.cp_id,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_user_name,
complaint_main.cp_cus_name,
complaint_main.cp_priority,
complaint_main.cp_status_code,
complaint_main.cp_no_old,
complaint_main.cp_topic,
complaint_status.cp_status_id,
complaint_status.cp_status_name,
complaint_topic.topic_name
FROM
complaint_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic WHERE cp_topic LIKE '%$searchby_topic%' ");

        return $result->result_array();
    }


    public function searchby_topic_nc(){
        $searchby_topic = $this->input->post("searchby_topic");


        return $result = $this->db->query("SELECT complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_user_name, complaint_main.cp_user_empid, complaint_main.cp_user_dept, complaint_main.cp_cus_name, complaint_main.cp_cus_ref, complaint_main.cp_invoice_no, complaint_main.cp_pro_code, complaint_main.cp_pro_lotno, complaint_main.cp_pro_qty, complaint_main.cp_file, complaint_main.cp_detail, complaint_main.nc_status_code, complaint_main.nc_sec31, complaint_main.nc_sec32, complaint_main.nc_sec32date, complaint_main.nc_sec32time, complaint_main.nc_sec33, complaint_main.nc_sec33date, complaint_main.nc_sec33time, complaint_main.nc_sec3owner, complaint_main.nc_sec3empid, complaint_main.nc_sec3dept, complaint_main.nc_sec3date, complaint_main.nc_sec4f1, complaint_main.nc_sec4f1_file, complaint_main.nc_sec4f1_status, complaint_main.nc_sec4f1_date, complaint_main.nc_sec4f1_time, complaint_main.nc_sec4f1_signature, complaint_main.nc_sec4f2, complaint_main.nc_sec4f2_file, complaint_main.nc_sec4f2_status, complaint_main.nc_sec4f2_date, complaint_main.nc_sec4f2_time, complaint_main.nc_sec4f2_signature, complaint_main.nc_sec4f3, complaint_main.nc_sec4f3_file, complaint_main.nc_sec4f3_status, complaint_main.nc_sec4f3_signature, complaint_main.nc_sec5, complaint_main.nc_sec5file, complaint_main.nc_sec5cost, complaint_main.nc_sec5cost_detail, complaint_main.nc_sec5failed, complaint_main.nc_sec5filefailed, complaint_main.nc_sec5costfailed, complaint_main.cp_no_old, complaint_topic.topic_name, complaint_topic_catagory.topic_cat_name, complaint_main.cp_status_code, complaint_status.cp_status_name,complaint_main.cp_priority FROM complaint_main INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.nc_status_code WHERE cp_status_code = 'cp05' AND cp_topic LIKE '%$searchby_topic%' ");

    }



    public function excel(){

        $objPHPExcel = new PHPExcel();


$objPHPExcel->getActiveSheet()->mergeCells('B1:H1');

//Add Head column
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'comid')
            ->setCellValue('B2', 'comstatus')
            ->setCellValue('C2', 'comdepartment')
            ->setCellValue('D2', 'comtype')
            ->setCellValue('E2', 'combrand');

//Set Column width
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);


// Write data from MySQL result

$objConnect = mysqli_connect("localhost","root","1234","saleecolour") or die("Error Connect to Database");
mysqli_set_charset($objConnect,"utf8");
$strSQL = "SELECT * FROM complaint_main";
$objQuery = mysqli_query($objConnect,$strSQL);



$i = 2;
while($objResult = mysqli_fetch_array($objQuery))
{
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $objResult["cp_no"]);
	$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $objResult["cp_no"]);
	$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $objResult["cp_no"]);
	$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $objResult["cp_no"]);
	$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $objResult["cp_no"]);


}




$objPHPExcel->getActiveSheet()->setTitle('Computer');



header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Computer Inventory.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');


    }

    // Export cp section
        public function expcp_getstatus(){
            $result = $this->db->query("SELECT
complaint_status.cp_status_name,
complaint_status.cp_status_id
FROM
complaint_status
INNER JOIN complaint_main ON complaint_status.cp_status_id = complaint_main.cp_status_code
WHERE cp_status_id LIKE '%cp%'
GROUP BY cp_status_id ");

            return $result;
        }

        public function expcp_getdept(){
          $result_getdept = $this->db->query("SELECT
complaint_main.cp_user_dept
FROM
complaint_main
GROUP BY cp_user_dept");
          return $result_getdept;
        }


        public function expcp_getuser(){
          $result_getuser = $this->db->query("SELECT
complaint_main.cp_user_name
FROM
complaint_main GROUP BY cp_user_name
");
        return $result_getuser;
        }


        public function expcp_getcat(){
          $result_getcat = $this->db->query("SELECT
complaint_topic_catagory.topic_cat_name,
complaint_topic_catagory.topic_cat_id
FROM
complaint_main
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
GROUP BY topic_cat_id");

        return $result_getcat;
        }


// NC
        public function expnc_getstatus(){
          $resultnc_getstatus = $this->db->query("SELECT
complaint_status.cp_status_name,
complaint_status.cp_status_id
FROM
nc_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = nc_main.nc_status_code
GROUP BY cp_status_id
");
          return $resultnc_getstatus;
        }


        public function expnc_getdept(){
          $resultnc_getdept = $this->db->query("SELECT
complaint_department_main.cp_dept_main_name,
complaint_department_main.cp_dept_main_code
FROM
nc_main
INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = nc_main.nc_related_dept
GROUP BY cp_dept_main_code
");
        return $resultnc_getdept;

        }


        public function expnc_getuser(){
          $resultnc_getuser = $this->db->query("SELECT
complaint_main.cp_user_name,
nc_main.nc_no
FROM
nc_main
INNER JOIN complaint_main ON nc_main.nc_no = complaint_main.cp_no
GROUP BY cp_user_name");
        return $resultnc_getuser;
        }


        public function expnc_getcat(){
          $resultnc_getcat = $this->db->query("SELECT
nc_main.nc_no,
complaint_main.cp_topic_cat,
complaint_topic_catagory.topic_cat_name,
complaint_topic_catagory.topic_cat_id
FROM
nc_main
INNER JOIN complaint_main ON nc_main.nc_no = complaint_main.cp_no
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
GROUP BY cp_topic_cat
");
return $resultnc_getcat;
        }












}




?>
