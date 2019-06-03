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
complaint_topic.topic_name,
complaint_topic_catagory.topic_cat_name
FROM
complaint_main
INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat WHERE cp_date BETWEEN '$date_start' AND '$date_end' ORDER BY cp_date ASC");

       return $result->result_array();


    }


public function searchby_date_nc(){
        $date_start = $this->input->post("date_start");
        $date_end = $this->input->post("date_end");


      return $result = $this->db->query("SELECT
nc_main.nc_no,
nc_main.nc_related_dept,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_topic,
complaint_main.cp_topic_cat,
complaint_main.cp_priority,
complaint_main.cp_user_name,
complaint_main.cp_user_empid,
complaint_main.cp_user_email,
complaint_main.cp_user_dept,
complaint_main.cp_cus_name,
complaint_main.cp_cus_ref,
complaint_main.cp_invoice_no,
complaint_main.cp_pro_code,
complaint_main.cp_pro_lotno,
complaint_main.cp_pro_qty,
complaint_main.cp_detail,
complaint_main.cp_file,
complaint_main.cp_status_code,
complaint_main.cp_detail_inves,
complaint_main.cp_detail_inves_signature,
complaint_main.cp_detail_inves_dept,
complaint_main.cp_detail_inves_date,
complaint_main.cp_detail_inves_file,
complaint_main.cp_sum_inves,
complaint_main.cp_sum_inves_signature,
complaint_main.cp_sum_inves_dept,
complaint_main.cp_sum_inves_date,
complaint_main.cp_sum_inves_file,
complaint_main.cp_sum,
complaint_department_main.cp_dept_main_name,
complaint_topic_catagory.topic_cat_name,
complaint_topic.topic_name,
nc_main.nc_status_code,
complaint_status.cp_status_name
FROM
nc_main
INNER JOIN complaint_main ON complaint_main.cp_no = nc_main.nc_no
INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = nc_main.nc_related_dept
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
INNER JOIN complaint_status ON complaint_status.cp_status_id = nc_main.nc_status_code
WHERE cp_status_code = 'cp05' AND cp_date BETWEEN '$date_start' AND '$date_end' ORDER BY cp_date ASC");

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
 complaint_main.cp_status_code,
 cp_status_id,
 complaint_main.cp_no_old,
 complaint_status.cp_status_name,
 complaint_topic.topic_name,
 complaint_topic_catagory.topic_cat_name
 FROM
 complaint_main
 INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
 INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
 INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat WHERE cp_no LIKE '%$searchby_docnum%' ORDER BY cp_no ASC ");

        return $result->result_array();

    }



    public function searchby_docnum_nc(){
        $searchby_docnum = $this->input->post("searchby_docnum");

        return $result = $this->db->query("SELECT
nc_main.nc_no,
nc_main.nc_related_dept,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_topic,
complaint_main.cp_topic_cat,
complaint_main.cp_priority,
complaint_main.cp_user_name,
complaint_main.cp_user_empid,
complaint_main.cp_user_email,
complaint_main.cp_user_dept,
complaint_main.cp_cus_name,
complaint_main.cp_cus_ref,
complaint_main.cp_invoice_no,
complaint_main.cp_pro_code,
complaint_main.cp_pro_lotno,
complaint_main.cp_pro_qty,
complaint_main.cp_detail,
complaint_main.cp_file,
complaint_main.cp_status_code,
complaint_main.cp_detail_inves,
complaint_main.cp_detail_inves_signature,
complaint_main.cp_detail_inves_dept,
complaint_main.cp_detail_inves_date,
complaint_main.cp_detail_inves_file,
complaint_main.cp_sum_inves,
complaint_main.cp_sum_inves_signature,
complaint_main.cp_sum_inves_dept,
complaint_main.cp_sum_inves_date,
complaint_main.cp_sum_inves_file,
complaint_main.cp_sum,
complaint_department_main.cp_dept_main_name,
complaint_topic_catagory.topic_cat_name,
complaint_topic.topic_name,
nc_main.nc_status_code,
complaint_status.cp_status_name
FROM
nc_main
INNER JOIN complaint_main ON complaint_main.cp_no = nc_main.nc_no
INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = nc_main.nc_related_dept
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
INNER JOIN complaint_status ON complaint_status.cp_status_id = nc_main.nc_status_code WHERE cp_status_code = 'cp05' AND cp_no LIKE '%$searchby_docnum%' ORDER BY cp_no ASC ");


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
 cp_status_id,
 complaint_main.cp_no_old,
 complaint_status.cp_status_name,
 complaint_topic.topic_name,
 complaint_topic_catagory.topic_cat_name
 FROM
 complaint_main
 INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
 INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
 INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat WHERE cp_user_name LIKE '%$searchby_userinform%' ORDER BY cp_no ASC ");

        return $result->result_array();

    }


public function searchby_userinform_nc(){
        $searchby_userinform = $this->input->post("searchby_userinform");

        return $result = $this->db->query("SELECT
nc_main.nc_no,
nc_main.nc_related_dept,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_topic,
complaint_main.cp_topic_cat,
complaint_main.cp_priority,
complaint_main.cp_user_name,
complaint_main.cp_user_empid,
complaint_main.cp_user_email,
complaint_main.cp_user_dept,
complaint_main.cp_cus_name,
complaint_main.cp_cus_ref,
complaint_main.cp_invoice_no,
complaint_main.cp_pro_code,
complaint_main.cp_pro_lotno,
complaint_main.cp_pro_qty,
complaint_main.cp_detail,
complaint_main.cp_file,
complaint_main.cp_status_code,
complaint_main.cp_detail_inves,
complaint_main.cp_detail_inves_signature,
complaint_main.cp_detail_inves_dept,
complaint_main.cp_detail_inves_date,
complaint_main.cp_detail_inves_file,
complaint_main.cp_sum_inves,
complaint_main.cp_sum_inves_signature,
complaint_main.cp_sum_inves_dept,
complaint_main.cp_sum_inves_date,
complaint_main.cp_sum_inves_file,
complaint_main.cp_sum,
complaint_department_main.cp_dept_main_name,
complaint_topic_catagory.topic_cat_name,
complaint_topic.topic_name,
nc_main.nc_status_code,
complaint_status.cp_status_name
FROM
nc_main
INNER JOIN complaint_main ON complaint_main.cp_no = nc_main.nc_no
INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = nc_main.nc_related_dept
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
INNER JOIN complaint_status ON complaint_status.cp_status_id = nc_main.nc_status_code WHERE cp_status_code = 'cp05' AND cp_user_name LIKE '%$searchby_userinform%' ORDER BY cp_no ASC ");


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
 cp_status_id,
 complaint_main.cp_no_old,
 complaint_status.cp_status_name,
 complaint_topic.topic_name,
 complaint_topic_catagory.topic_cat_name
 FROM
 complaint_main
 INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
 INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
 INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat WHERE cp_topic LIKE '%$searchby_topic%' ");

        return $result->result_array();
    }



public function searchby_wording(){
    $searchby_wording = $this->input->post("searchby_wording");

    $result = $this->db->query("SELECT
complaint_main.cp_id,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_user_name,
complaint_main.cp_user_empid,
complaint_main.cp_user_email,
complaint_main.cp_user_dept,
complaint_main.cp_cus_name,
complaint_main.cp_cus_ref,
complaint_main.cp_invoice_no,
complaint_main.cp_pro_code,
complaint_main.cp_pro_lotno,
complaint_main.cp_pro_qty,
complaint_main.cp_detail,
complaint_main.cp_detail_inves,
complaint_main.cp_detail_inves_signature,
complaint_main.cp_detail_inves_date,
complaint_main.cp_sum_inves,
complaint_main.cp_sum_inves_signature,
complaint_main.cp_sum_inves_dept,
complaint_main.cp_sum_inves_date,
complaint_main.cp_sum,
complaint_main.cp_conclu_detail,
complaint_main.cp_conclu_signature,
complaint_main.cp_conclu_dept,
complaint_main.cp_conclu_date,
complaint_main.cp_conclu_costdetail,
complaint_main.cp_conclu_cost,
complaint_main.cp_conclu_file,
complaint_main.cp_modify_by,
complaint_main.cp_modify_datetime,
complaint_main.cp_modify_reason,
complaint_main.cp_no_old,
complaint_main.nc_status_code,
complaint_topic_catagory.topic_cat_name,
complaint_topic.topic_name,
complaint_main.cp_status_code,
complaint_status.cp_status_name,
complaint_status.cp_status_id,
complaint_main.cp_priority
    FROM
    complaint_main
    INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
    INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
    INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
    WHERE complaint_main.cp_user_email LIKE '%$searchby_wording%' OR
    complaint_main.cp_cus_name LIKE '%$searchby_wording%' OR
    complaint_main.cp_cus_ref LIKE '%$searchby_wording%' OR
    complaint_main.cp_invoice_no LIKE '%$searchby_wording%' OR
    complaint_main.cp_pro_code LIKE '%$searchby_wording%' OR
    complaint_main.cp_pro_lotno LIKE '%$searchby_wording%' OR
    complaint_main.cp_pro_qty LIKE '%$searchby_wording%' OR
    complaint_main.cp_detail LIKE '%$searchby_wording%' OR
    complaint_main.cp_detail_inves LIKE '%$searchby_wording%' OR
    complaint_main.cp_sum_inves LIKE '%$searchby_wording%' OR
    complaint_main.cp_conclu_detail LIKE '%$searchby_wording%'");

    return $result->result_array();
}


public function searchby_wording_nc(){
    $searchby_wording = $this->input->post("searchby_wording");
    $result = $this->db->query("SELECT
nc_main.nc_related_dept,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_topic,
complaint_main.cp_topic_cat,
complaint_main.cp_priority,
complaint_main.cp_user_name,
complaint_main.cp_user_empid,
complaint_main.cp_user_email,
complaint_main.cp_user_dept,
complaint_main.cp_cus_name,
complaint_main.cp_cus_ref,
complaint_main.cp_invoice_no,
complaint_main.cp_pro_code,
complaint_main.cp_pro_lotno,
complaint_main.cp_pro_qty,
complaint_main.cp_detail,
complaint_main.cp_file,
complaint_main.cp_status_code,
complaint_main.cp_detail_inves,
complaint_main.cp_detail_inves_signature,
complaint_main.cp_detail_inves_dept,
complaint_main.cp_detail_inves_date,
complaint_main.cp_detail_inves_file,
complaint_main.cp_sum_inves,
complaint_main.cp_sum_inves_signature,
complaint_main.cp_sum_inves_dept,
complaint_main.cp_sum_inves_date,
complaint_main.cp_sum_inves_file,
complaint_main.cp_sum,
complaint_department_main.cp_dept_main_name,
complaint_topic_catagory.topic_cat_name,
complaint_topic.topic_name,
nc_main.nc_status_code,
complaint_status.cp_status_name,
nc_main.nc_id,
nc_main.nc_sec31,
nc_main.nc_sec32,
nc_main.nc_sec32date,
nc_main.nc_sec33,
nc_main.nc_sec33date,
nc_main.nc_sec3owner,
nc_main.nc_sec3empid,
nc_main.nc_sec3dept,
nc_main.nc_sec3date,
nc_main.nc_sec3file,
nc_main.nc_sec3edit_memo,
nc_main.nc_sec4f1,
nc_main.nc_sec4f1_file,
nc_main.nc_sec4f1_status,
nc_main.nc_sec4f1_date,
nc_main.nc_sec4f1_signature,
nc_main.nc_sec4f2,
nc_main.nc_sec4f2_file,
nc_main.nc_sec4f2_status,
nc_main.nc_sec4f2_date,
nc_main.nc_sec4f2_signature,
nc_main.nc_sec4f3,
nc_main.nc_sec4f3_file,
nc_main.nc_sec4f3_status,
nc_main.nc_sec4f3_signature,
nc_main.nc_sec5,
nc_main.nc_sec5_file,
nc_main.nc_sec5cost,
nc_main.nc_sec5cost_detail,
nc_main.nc_sec5failed,
nc_main.nc_sec5filefailed,
nc_main.nc_sec5costfailed,
nc_main.cp_no_old,
nc_main.nc_modify_by,
nc_main.nc_modify_date,
nc_main.nc_autoemail,
nc_main.nc_no
FROM
nc_main
INNER JOIN complaint_main ON complaint_main.cp_no = nc_main.nc_no
INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = nc_main.nc_related_dept
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
INNER JOIN complaint_status ON complaint_status.cp_status_id = nc_main.nc_status_code
WHERE complaint_status.cp_status_name LIKE '%$searchby_wording%' OR
nc_main.nc_sec31 LIKE '%$searchby_wording%' OR
nc_main.nc_sec32 LIKE '%$searchby_wording%' OR
nc_main.nc_sec33 LIKE '%$searchby_wording%' OR
nc_main.nc_sec4f1 LIKE '%$searchby_wording%' OR
nc_main.nc_sec4f2 LIKE '%$searchby_wording%' OR
nc_main.nc_sec4f3 LIKE '%$searchby_wording%' OR
nc_main.nc_sec5 LIKE '%$searchby_wording%' ");


    return $result;

}



    public function searchby_topic_nc(){
        $searchby_topic = $this->input->post("searchby_topic");


        return $result = $this->db->query("SELECT
nc_main.nc_no,
nc_main.nc_related_dept,
complaint_main.cp_no,
complaint_main.cp_date,
complaint_main.cp_topic,
complaint_main.cp_topic_cat,
complaint_main.cp_priority,
complaint_main.cp_user_name,
complaint_main.cp_user_empid,
complaint_main.cp_user_email,
complaint_main.cp_user_dept,
complaint_main.cp_cus_name,
complaint_main.cp_cus_ref,
complaint_main.cp_invoice_no,
complaint_main.cp_pro_code,
complaint_main.cp_pro_lotno,
complaint_main.cp_pro_qty,
complaint_main.cp_detail,
complaint_main.cp_file,
complaint_main.cp_status_code,
complaint_main.cp_detail_inves,
complaint_main.cp_detail_inves_signature,
complaint_main.cp_detail_inves_dept,
complaint_main.cp_detail_inves_date,
complaint_main.cp_detail_inves_file,
complaint_main.cp_sum_inves,
complaint_main.cp_sum_inves_signature,
complaint_main.cp_sum_inves_dept,
complaint_main.cp_sum_inves_date,
complaint_main.cp_sum_inves_file,
complaint_main.cp_sum,
complaint_department_main.cp_dept_main_name,
complaint_topic_catagory.topic_cat_name,
complaint_topic.topic_name,
nc_main.nc_status_code,
complaint_status.cp_status_name
FROM
nc_main
INNER JOIN complaint_main ON complaint_main.cp_no = nc_main.nc_no
INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = nc_main.nc_related_dept
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
INNER JOIN complaint_status ON complaint_status.cp_status_id = nc_main.nc_status_code WHERE cp_status_code = 'cp05' AND cp_topic LIKE '%$searchby_topic%' ");

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
