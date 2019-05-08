<?php
class Report_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        
        require("PHPExcel/Classes/PHPExcel.php");
        
    }
    
    public function getpri($cp_no){
        $resultpri = $this->db->query("SELECT
complaint_priority_use.cp_pri_use_cpno,
complaint_priorityn.pri_name,
complaint_priorityn.pri_id,
complaint_priorityn_category.pricat_name
FROM
complaint_priority_use
INNER JOIN complaint_priorityn ON complaint_priorityn.pri_id = complaint_priority_use.cp_pri_use_id
INNER JOIN complaint_priorityn_category ON complaint_priorityn_category.pricat_id = complaint_priorityn.pri_catid
WHERE cp_pri_use_cpno = '$cp_no'
ORDER BY pri_id ASC");
        
        return $resultpri->result_array();
        
    }
    
    
    public function getdept(){
        $resultdept = $this->db->query("");
        
        return $resultdept->result_array();
    }
    
    


    public function main_report($cp_no){
       $query =  $this->db->query("SELECT
complaint_topic.topic_name,
complaint_topic_catagory.topic_cat_name,
complaint_status.cp_status_name,
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
complaint_main.cp_pro_qty,
complaint_main.cp_pro_lotno,
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
complaint_main.cp_conclu_detail,
complaint_main.cp_conclu_signature,
complaint_main.cp_conclu_dept,
complaint_main.cp_conclu_date,
complaint_main.cp_conclu_costdetail,
complaint_main.cp_conclu_cost,
complaint_main.cp_conclu_file,
complaint_main.cp_modify_by,
complaint_main.cp_modify_datetime,
complaint_main.cp_modify_reason
FROM
complaint_main
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code WHERE cp_no='$cp_no' ");
       $result = $query->row();
        
        
$objPHPExcel = new PHPExcel();

// Create a first sheet, representing sales data

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Complaint Report');


$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Basic Information');

$objPHPExcel->getActiveSheet()->setCellValue('A4', 'ID');
$objPHPExcel->getActiveSheet()->setCellValue('D4', 'DATE');
$objPHPExcel->getActiveSheet()->setCellValue('G4', 'TOPIC');
$objPHPExcel->getActiveSheet()->setCellValue('J4', 'CATEGORY');
$objPHPExcel->getActiveSheet()->setCellValue('A5', $result->cp_no);
$objPHPExcel->getActiveSheet()->setCellValue('D5', $result->cp_date);
$objPHPExcel->getActiveSheet()->setCellValue('G5', $result->topic_name);
$objPHPExcel->getActiveSheet()->setCellValue('J5', $result->topic_cat_name);


$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Priority');

// Write data from MySQL result
$objConnect = mysqli_connect("localhost","root","1234","saleecolour") or die("Error Connect to Database");
mysqli_set_charset($objConnect,"utf8");
$strSQL = "SELECT complaint_priority_use.cp_pri_use_cpno, complaint_priorityn.pri_name, complaint_priorityn.pri_id, complaint_priorityn_category.pricat_name FROM complaint_priority_use INNER JOIN complaint_priorityn ON complaint_priorityn.pri_id = complaint_priority_use.cp_pri_use_id INNER JOIN complaint_priorityn_category ON complaint_priorityn_category.pricat_id = complaint_priorityn.pri_catid WHERE cp_pri_use_cpno = '$cp_no' ORDER BY pri_id ASC";
$objQuery = mysqli_query($objConnect,$strSQL);

$i=7;
while ($fetch_pri = mysqli_fetch_array($objQuery)){
    
$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $fetch_pri['pricat_name'].' : ');
$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $fetch_pri['pri_name']);
$i++;

}

$strSQL2 = "SELECT complaint_department.cp_dept_code, complaint_department.cp_dept_cp_no, complaint_department_main.cp_dept_main_name FROM complaint_department INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' ";
$objQuery2 = mysqli_query($objConnect,$strSQL2);

$objPHPExcel->getActiveSheet()->setCellValue('A14', 'Details of Complaint / Damages');

$objPHPExcel->getActiveSheet()->setCellValue('A15', 'Detail of complaint : ');
$objPHPExcel->getActiveSheet()->setCellValue('D15', $result->cp_detail);
$objPHPExcel->getActiveSheet()->setCellValue('A16', 'Attached file : ');
$objPHPExcel->getActiveSheet()->setCellValue('D16', $result->cp_file);
$objPHPExcel->getActiveSheet()->setCellValue('A17', 'Related Department : ');

while ($fetch2 = mysqli_fetch_array($objQuery2)){
$objPHPExcel->getActiveSheet()->setCellValue('D17', $fetch2['cp_dept_main_name'].',');




$objPHPExcel->getActiveSheet()->setCellValue('A18', 'Investigation');

$objPHPExcel->getActiveSheet()->setCellValue('A19', 'Detail of investigate : ');
$objPHPExcel->getActiveSheet()->setCellValue('D19', $result->cp_detail_inves);
$objPHPExcel->getActiveSheet()->setCellValue('A20', 'Attached file : ');
$objPHPExcel->getActiveSheet()->setCellValue('D20', $result->cp_detail_inves_file);
$objPHPExcel->getActiveSheet()->setCellValue('A21', 'Signature : '.$result->cp_detail_inves_signature);
//$objPHPExcel->getActiveSheet()->setCellValue('C28', $result->cp_detail_inves_signature);
$objPHPExcel->getActiveSheet()->setCellValue('E21', 'Department : '.$result->cp_detail_inves_dept);
//$objPHPExcel->getActiveSheet()->setCellValue('G28', $result->cp_detail_inves_dept);
$objPHPExcel->getActiveSheet()->setCellValue('I21', 'Date : '.$result->cp_detail_inves_date);
//$objPHPExcel->getActiveSheet()->setCellValue('K28', $result->cp_detail_inves_date);
$objPHPExcel->getActiveSheet()->setCellValue('A22', 'Related Department : ');





$objPHPExcel->getActiveSheet()->setCellValue('D22', $fetch2['cp_dept_main_name'].',');




$objPHPExcel->getActiveSheet()->setCellValue('A23', 'Summary of Investigation');

$objPHPExcel->getActiveSheet()->setCellValue('A24', 'Detail Summary of Investigation : ');
$objPHPExcel->getActiveSheet()->setCellValue('D24', $result->cp_sum_inves);
$objPHPExcel->getActiveSheet()->setCellValue('A25', 'Attached file : ');
$objPHPExcel->getActiveSheet()->setCellValue('D25', $result->cp_sum_inves_file);

if($result->cp_sum == "yes"){
    $cp_sum_text = "เป็นข้อบกพร่องของบริษัท";
}else{
    $cp_sum_text = "ไม่เป็นข้อบกพร่องของบริษัท";
}

$objPHPExcel->getActiveSheet()->setCellValue('A26', $cp_sum_text);
$objPHPExcel->getActiveSheet()->setCellValue('A27', 'Signature : '.$result->cp_sum_inves_signature);
//$objPHPExcel->getActiveSheet()->setCellValue('B36', $result->cp_sum_inves_signature);
$objPHPExcel->getActiveSheet()->setCellValue('E27', 'Department : '.$result->cp_sum_inves_dept);
//$objPHPExcel->getActiveSheet()->setCellValue('F36', $result->cp_sum_inves_dept);
$objPHPExcel->getActiveSheet()->setCellValue('I27', 'Date : '.$result->cp_sum_inves_date);
//$objPHPExcel->getActiveSheet()->setCellValue('J36', $result->cp_sum_inves_date);
$objPHPExcel->getActiveSheet()->setCellValue('A28', 'Related Department : ');
$objPHPExcel->getActiveSheet()->setCellValue('D28', $fetch2['cp_dept_main_name'].',');

}

$objPHPExcel->getActiveSheet()->setCellValue('A29', 'Conclusion of Complaint');

$objPHPExcel->getActiveSheet()->setCellValue('A30', 'Detail Conclusion of Complaint : ');
$objPHPExcel->getActiveSheet()->setCellValue('D30', 'test');
$objPHPExcel->getActiveSheet()->setCellValue('A31', 'Detail of Cost');
$objPHPExcel->getActiveSheet()->setCellValue('D31', 'Cost');
$objPHPExcel->getActiveSheet()->setCellValue('A32', 'Attached file : '.'test');
$objPHPExcel->getActiveSheet()->setCellValue('D32', 'test');
$objPHPExcel->getActiveSheet()->setCellValue('A33', 'Signature : '.'test');
$objPHPExcel->getActiveSheet()->setCellValue('E33', 'Department : '.'test');
$objPHPExcel->getActiveSheet()->setCellValue('I33', 'Date : '.'test');



/////////// Merge cells/////////
$objPHPExcel->getActiveSheet()->mergeCells('D15:N15');
$objPHPExcel->getActiveSheet()->mergeCells('D19:N19');
//$objPHPExcel->getActiveSheet()->mergeCells('A8:N9');

/////////// Merge cells/////////



// Set alignments
//$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//$objPHPExcel->getActiveSheet()->getStyle('A18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//$objPHPExcel->getActiveSheet()->getStyle('A24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//$objPHPExcel->getActiveSheet()->getStyle('A31')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//$objPHPExcel->getActiveSheet()->getStyle('A39')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


//Set warp text
$objPHPExcel->getActiveSheet()->getStyle('D15')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('D19')->getAlignment()->setWrapText(true);



// Set fonts
//$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
//$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
//$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
//
//$objPHPExcel->getActiveSheet()->getStyle('A8')->getFont()->setSize(14);
//$objPHPExcel->getActiveSheet()->getStyle('A8')->getFont()->setBold(true);
//$objPHPExcel->getActiveSheet()->getStyle('A8')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
//
//$objPHPExcel->getActiveSheet()->getStyle('A18')->getFont()->setSize(14);
//$objPHPExcel->getActiveSheet()->getStyle('A18')->getFont()->setBold(true);
//$objPHPExcel->getActiveSheet()->getStyle('A18')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
//
//$objPHPExcel->getActiveSheet()->getStyle('A24')->getFont()->setSize(14);
//$objPHPExcel->getActiveSheet()->getStyle('A24')->getFont()->setBold(true);
//$objPHPExcel->getActiveSheet()->getStyle('A24')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
//
//$objPHPExcel->getActiveSheet()->getStyle('A31')->getFont()->setSize(14);
//$objPHPExcel->getActiveSheet()->getStyle('A31')->getFont()->setBold(true);
//$objPHPExcel->getActiveSheet()->getStyle('A31')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);

$objPHPExcel->getActiveSheet()->getStyle('A2:N38')->getFont()->setName('Tahoma');
$objPHPExcel->getActiveSheet()->getStyle('A2:N38')->getFont()->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

$objPHPExcel->getActiveSheet()->getStyle('A7:A13')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A15:A17')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A19:A20')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A22')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A24:A25')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A28')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A30:A32')->getFont()->setBold(true);

//
//$objPHPExcel->getActiveSheet()->getStyle('A39')->getFont()->setSize(14);
//$objPHPExcel->getActiveSheet()->getStyle('A39')->getFont()->setBold(true);
//$objPHPExcel->getActiveSheet()->getStyle('A39')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);


// Set thin black border outline around column
$styleThinBlackBorderOutline = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FFA500'),
		),
	),
);
$objPHPExcel->getActiveSheet()->getStyle('A3:N3')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('A6:N6')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('A14:N14')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('A18:N18')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('A23:N23')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('A29:N29')->applyFromArray($styleThinBlackBorderOutline);


// Set style for header row using alternative method
$fillcolor = array(
			'font'    => array(
				'bold'      => true
			),
			'borders' => array(
				'top'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			),
			'fill' => array(
	 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
	  			'rotation'   => 90,
	 			'startcolor' => array(
	 				'argb' => 'FFD700'
	 			),
	 			'endcolor'   => array(
	 				'argb' => 'FFD700'
	 			)
	 		)
		);
$objPHPExcel->getActiveSheet()->getStyle('A3:N3')->applyFromArray($fillcolor);
$objPHPExcel->getActiveSheet()->getStyle('A6:N6')->applyFromArray($fillcolor);
$objPHPExcel->getActiveSheet()->getStyle('A14:N14')->applyFromArray($fillcolor);
$objPHPExcel->getActiveSheet()->getStyle('A18:N18')->applyFromArray($fillcolor);
$objPHPExcel->getActiveSheet()->getStyle('A23:N23')->applyFromArray($fillcolor);
$objPHPExcel->getActiveSheet()->getStyle('A29:N29')->applyFromArray($fillcolor);






// Set page orientation and size

$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Complaint.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
        
        
        
    }
    
    
    
    
    public function main_report2(){
  
    }
    
    
    
    public function export_btn(){
        
$datestart = $this->input->post("start_date_export");
$dateend = $this->input->post("end_date_export");
        
        
       
$objPHPExcel = new PHPExcel();    

if($this->input->post("export_type") == "Complaint"){
    
            //Add Head column
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'CP No. :');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Date');
$objPHPExcel->getActiveSheet()->setCellValue('C2', 'Topic');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'Category');
$objPHPExcel->getActiveSheet()->setCellValue('E2', 'Complaint Person');
$objPHPExcel->getActiveSheet()->setCellValue('F2', 'Employee ID');
$objPHPExcel->getActiveSheet()->setCellValue('G2', 'Department');

$objPHPExcel->getActiveSheet()->setCellValue('H2', 'Customer Name');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'Customer Ref');
$objPHPExcel->getActiveSheet()->setCellValue('J2', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('K2', 'Product Code');
$objPHPExcel->getActiveSheet()->setCellValue('L2', 'Lot No');
$objPHPExcel->getActiveSheet()->setCellValue('M2', 'Quantity');


$objPHPExcel->getActiveSheet()->setCellValue('N2', 'Detail of complaint');
$objPHPExcel->getActiveSheet()->setCellValue('O2', 'Attached file');
$objPHPExcel->getActiveSheet()->setCellValue('P2', 'Related Department');

$objPHPExcel->getActiveSheet()->setCellValue('Q2', 'Detail of investigate');
$objPHPExcel->getActiveSheet()->setCellValue('R2', 'Attached file');
$objPHPExcel->getActiveSheet()->setCellValue('S2', 'Signature');
$objPHPExcel->getActiveSheet()->setCellValue('T2', 'Department');
$objPHPExcel->getActiveSheet()->setCellValue('U2', 'Date');
$objPHPExcel->getActiveSheet()->setCellValue('V2', 'Related Department');

$objPHPExcel->getActiveSheet()->setCellValue('W2', 'Detail Summary of Investigation');
$objPHPExcel->getActiveSheet()->setCellValue('X2', 'Attached file');
$objPHPExcel->getActiveSheet()->setCellValue('Y2', 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('Z2', 'Signature');
$objPHPExcel->getActiveSheet()->setCellValue('AA2', 'Department');
$objPHPExcel->getActiveSheet()->setCellValue('AB2', 'Date');

$objPHPExcel->getActiveSheet()->setCellValue('AC2', 'Detail Conclusion of Complaint');
$objPHPExcel->getActiveSheet()->setCellValue('AD2', 'Detail of Cost');
$objPHPExcel->getActiveSheet()->setCellValue('AE2', 'Cost');
$objPHPExcel->getActiveSheet()->setCellValue('AF2', 'Attached file');
$objPHPExcel->getActiveSheet()->setCellValue('AG2', 'Signature');
$objPHPExcel->getActiveSheet()->setCellValue('AH2', 'Department');
$objPHPExcel->getActiveSheet()->setCellValue('AI2','Date');
$objPHPExcel->getActiveSheet()->setCellValue('AJ2','CP Status');


    if($datestart == "" || $dateend == ""){
    $datesearch = "";
}else{
    $datesearch = " AND cp_date BETWEEN '$datestart' AND '$dateend' ";
}

 //Write data from MySQL result
$objConnect = mysqli_connect("localhost","root","1234","saleecolour") or die("Error Connect to Database");
mysqli_set_charset($objConnect,"utf8");
$strSQL = "SELECT complaint_main.cp_id, complaint_main.cp_no, complaint_main.cp_date, complaint_main.cp_priority, complaint_main.cp_user_name, complaint_main.cp_user_empid, complaint_main.cp_user_email, complaint_main.cp_user_dept, complaint_main.cp_cus_name, complaint_main.cp_cus_ref, complaint_main.cp_invoice_no, complaint_main.cp_pro_code, complaint_main.cp_pro_lotno, complaint_main.cp_pro_qty, complaint_main.cp_detail, complaint_main.cp_file, complaint_main.cp_detail_inves, complaint_main.cp_detail_inves_signature, complaint_main.cp_detail_inves_dept, complaint_main.cp_detail_inves_date, complaint_main.cp_detail_inves_file, complaint_main.cp_sum_inves, complaint_main.cp_sum_inves_signature, complaint_main.cp_sum_inves_dept, complaint_main.cp_sum_inves_date, complaint_main.cp_sum_inves_file, complaint_main.cp_sum, complaint_main.cp_conclu_detail, complaint_main.cp_conclu_signature, complaint_main.cp_conclu_dept, complaint_main.cp_conclu_date, complaint_main.cp_conclu_costdetail, complaint_main.cp_conclu_cost, complaint_main.cp_conclu_file, complaint_main.cp_modify_by, complaint_main.cp_modify_datetime, complaint_main.cp_modify_reason, complaint_main.nc_status_code, complaint_main.nc_sec31, complaint_main.nc_sec32, complaint_main.nc_sec32date, complaint_main.nc_sec32time, complaint_main.nc_sec33, complaint_main.nc_sec33date, complaint_main.nc_sec33time, complaint_main.nc_sec3owner, complaint_main.nc_sec3empid, complaint_main.nc_sec3dept, complaint_main.nc_sec3date, complaint_main.nc_sec3edit_memo, complaint_main.nc_sec4f1, complaint_main.nc_sec4f1_file, complaint_main.nc_sec4f1_status, complaint_main.nc_sec4f1_date, complaint_main.nc_sec4f1_time, complaint_main.nc_sec4f1_signature, complaint_main.nc_sec4f2, complaint_main.nc_sec4f2_file, complaint_main.nc_sec4f2_status, complaint_main.nc_sec4f2_date, complaint_main.nc_sec4f2_time, complaint_main.nc_sec4f2_signature, complaint_main.nc_sec4f3, complaint_main.nc_sec4f3_file, complaint_main.nc_sec4f3_status, complaint_main.nc_sec4f3_signature, complaint_main.nc_sec5, complaint_main.nc_sec5file, complaint_main.nc_sec5cost, complaint_main.nc_sec5cost_detail, complaint_main.nc_sec5failed, complaint_main.nc_sec5filefailed, complaint_main.nc_sec5costfailed, complaint_main.cp_no_old, complaint_main.nc_modify_by, complaint_main.nc_modify_date, complaint_topic.topic_name, complaint_topic_catagory.topic_cat_name, complaint_status.cp_status_name FROM complaint_main INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code WHERE cp_status_code LIKE '%cp%' $datesearch";
$objQuery = mysqli_query($objConnect,$strSQL);

$i = 3;
while ($fetch = mysqli_fetch_array($objQuery)){
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $fetch["cp_no"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $fetch["cp_date"]);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $fetch["topic_name"]);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $fetch["topic_cat_name"]);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $fetch["cp_user_name"]);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $fetch["cp_user_empid"]);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $fetch["cp_user_dept"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $fetch["cp_cus_name"]);
    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $fetch["cp_cus_ref"]);
    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $fetch["cp_invoice_no"]);
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $fetch["cp_pro_code"]);
    $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $fetch["cp_pro_lotno"]);
    $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $fetch["cp_pro_qty"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $fetch["cp_detail"]);
    $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $fetch["cp_file"]);
    $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $fetch["cp_no"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $fetch["cp_detail_inves"]);
    $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $fetch["cp_detail_inves_file"]);
    $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $fetch["cp_detail_inves_signature"]);
    $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $fetch["cp_detail_inves_dept"]);
    $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $fetch["cp_detail_inves_date"]);
    $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $fetch["cp_no"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('W' . $i, $fetch["cp_sum_inves"]);
    $objPHPExcel->getActiveSheet()->setCellValue('X' . $i, $fetch["cp_sum_inves_file"]);
    $objPHPExcel->getActiveSheet()->setCellValue('Y' . $i, $fetch["cp_sum"]);
    $objPHPExcel->getActiveSheet()->setCellValue('Z' . $i, $fetch["cp_sum_inves_signature"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AA' . $i, $fetch["cp_sum_inves_dept"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AB' . $i, $fetch["cp_sum_inves_date"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('AC' . $i, $fetch["cp_conclu_detail"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AD' . $i, $fetch["cp_conclu_costdetail"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AE' . $i, $fetch["cp_conclu_cost"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AF' . $i, $fetch["cp_conclu_file"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AG' . $i, $fetch["cp_conclu_signature"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AH' . $i, $fetch["cp_conclu_dept"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AI' . $i, $fetch["cp_conclu_date"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AJ' . $i, $fetch["cp_status_name"]);
    
    

    $i++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Complaint Report List.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
    
    
}else{//เลือก Export NC
    
     //Add Head column
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'CP No. :');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Date');
$objPHPExcel->getActiveSheet()->setCellValue('C2', 'Topic');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'Category');
$objPHPExcel->getActiveSheet()->setCellValue('E2', 'Complaint Person');
$objPHPExcel->getActiveSheet()->setCellValue('F2', 'Employee ID');
$objPHPExcel->getActiveSheet()->setCellValue('G2', 'Department');

$objPHPExcel->getActiveSheet()->setCellValue('H2', 'Customer Name');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'Customer Ref');
$objPHPExcel->getActiveSheet()->setCellValue('J2', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('K2', 'Product Code');
$objPHPExcel->getActiveSheet()->setCellValue('L2', 'Lot No');
$objPHPExcel->getActiveSheet()->setCellValue('M2', 'Quantity');

$objPHPExcel->getActiveSheet()->setCellValue('N2', 'Detail of complaint');
$objPHPExcel->getActiveSheet()->setCellValue('O2', 'Attached file');

$objPHPExcel->getActiveSheet()->setCellValue('P2', 'Detail of investigate');
$objPHPExcel->getActiveSheet()->setCellValue('Q2', 'Attached file');

$objPHPExcel->getActiveSheet()->setCellValue('R2', 'Detail Summary of Investigation');
$objPHPExcel->getActiveSheet()->setCellValue('S2', 'Attached file');
$objPHPExcel->getActiveSheet()->setCellValue('T2', 'Signature');
$objPHPExcel->getActiveSheet()->setCellValue('U2', 'Department');
$objPHPExcel->getActiveSheet()->setCellValue('V2', 'Date');

$objPHPExcel->getActiveSheet()->setCellValue('W2', 'Corrective(สาเหตุ)');
$objPHPExcel->getActiveSheet()->setCellValue('X2', 'Corrective(วิธีแก้ไข)');
$objPHPExcel->getActiveSheet()->setCellValue('Y2', 'Preventive(วิธีป้องกัน)');

$objPHPExcel->getActiveSheet()->setCellValue('Z2', 'ผลการติดตามครั้งที่1');
$objPHPExcel->getActiveSheet()->setCellValue('AA2', 'เอกสารประกอบ');
$objPHPExcel->getActiveSheet()->setCellValue('AB2', 'สถานะ');
$objPHPExcel->getActiveSheet()->setCellValue('AC2','ลงชื่อผู้ติดตาม');

$objPHPExcel->getActiveSheet()->setCellValue('AD2','ผลการติดตามครั้งที่2');
$objPHPExcel->getActiveSheet()->setCellValue('AE2','เอกสารประกอบ');
$objPHPExcel->getActiveSheet()->setCellValue('AF2','สถานะ');
$objPHPExcel->getActiveSheet()->setCellValue('AG2','ลงชื่อผู้ติดตาม');

$objPHPExcel->getActiveSheet()->setCellValue('AH2','ผลการติดตามครั้งที่3');
$objPHPExcel->getActiveSheet()->setCellValue('AI2','เอกสารประกอบ');
$objPHPExcel->getActiveSheet()->setCellValue('AJ2','สถานะ');
$objPHPExcel->getActiveSheet()->setCellValue('AK2','ลงชื่อผู้ติดตาม');

$objPHPExcel->getActiveSheet()->setCellValue('AL2','Conclusion of nc');
$objPHPExcel->getActiveSheet()->setCellValue('AM2','เอกสารประกอบ');
$objPHPExcel->getActiveSheet()->setCellValue('AN2','รายละเอียดค่าใช้จ่าย');
$objPHPExcel->getActiveSheet()->setCellValue('AO2','ค่าใช้จ่ายที่เกิดขึ้น');


    if($datestart == "" || $dateend == ""){
    $datesearch = "";
}else{
    $datesearch = " AND cp_date BETWEEN '$datestart' AND '$dateend' ";
}

 //Write data from MySQL result
$objConnect = mysqli_connect("localhost","root","1234","saleecolour") or die("Error Connect to Database");
mysqli_set_charset($objConnect,"utf8");
$strSQL = "SELECT complaint_main.cp_no_old, complaint_main.nc_sec5costfailed, complaint_main.nc_sec5filefailed, complaint_main.nc_sec5failed, complaint_main.nc_sec5cost_detail, complaint_main.nc_sec5cost, complaint_main.nc_sec5file, complaint_main.nc_sec5, complaint_main.nc_sec4f3_signature, complaint_main.nc_sec4f3_status, complaint_main.nc_sec4f3_file, complaint_main.nc_sec4f3, complaint_main.nc_sec4f2_signature, complaint_main.nc_sec4f2_time, complaint_main.nc_sec4f2_date, complaint_main.nc_sec4f2_status, complaint_main.nc_sec4f2_file, complaint_main.nc_sec4f1_time, complaint_main.nc_sec4f1_signature, complaint_main.nc_sec4f2, complaint_main.nc_sec4f1_date, complaint_main.nc_sec4f1_status, complaint_main.nc_sec4f1_file, complaint_main.nc_sec4f1, complaint_main.cp_sum, complaint_main.cp_sum_inves_file, complaint_main.cp_sum_inves_date, complaint_main.cp_sum_inves_dept, complaint_main.cp_sum_inves_signature, complaint_main.cp_sum_inves, complaint_main.cp_detail_inves_file, complaint_main.cp_detail_inves_date, complaint_main.cp_detail_inves_dept, complaint_main.cp_detail_inves_signature, complaint_main.cp_detail_inves, complaint_main.cp_status_code, complaint_main.cp_file, complaint_main.cp_detail, complaint_main.cp_pro_lotno, complaint_main.cp_pro_qty, complaint_main.cp_pro_code, complaint_main.cp_invoice_no, complaint_main.cp_cus_ref, complaint_main.cp_cus_name, complaint_main.cp_user_dept, complaint_main.cp_user_email, complaint_main.cp_user_empid, complaint_main.cp_user_name, complaint_main.cp_priority, complaint_main.cp_topic_cat, complaint_main.cp_topic, complaint_main.cp_date, complaint_main.cp_no, complaint_main.nc_status_code, complaint_main.nc_sec31, complaint_main.nc_sec32, complaint_main.nc_sec32date, complaint_main.nc_sec32time, complaint_main.nc_sec33, complaint_main.nc_sec33date, complaint_main.nc_sec33time, complaint_main.nc_sec3owner, complaint_main.nc_sec3empid, complaint_main.nc_sec3dept, complaint_main.nc_sec3date, complaint_main.nc_sec3edit_memo, complaint_status.cp_status_name, complaint_topic.topic_name, complaint_topic_catagory.topic_cat_name FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.nc_status_code INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat WHERE nc_status_code LIKE '%nc%' $datesearch";
$objQuery = mysqli_query($objConnect,$strSQL);

$i = 3;
while ($fetch = mysqli_fetch_array($objQuery)){
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $fetch["cp_no"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $fetch["cp_date"]);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $fetch["topic_name"]);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $fetch["topic_cat_name"]);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $fetch["cp_user_name"]);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $fetch["cp_user_empid"]);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $fetch["cp_user_dept"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $fetch["cp_cus_name"]);
    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $fetch["cp_cus_ref"]);
    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $fetch["cp_invoice_no"]);
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $fetch["cp_pro_code"]);
    $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $fetch["cp_pro_lotno"]);
    $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $fetch["cp_pro_qty"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $fetch["cp_detail"]);
    $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $fetch["cp_file"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $fetch["cp_detail_inves"]);
    $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $fetch["cp_detail_inves_file"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $fetch["cp_sum_inves"]);
    $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $fetch["cp_sum_inves_file"]);
    $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $fetch["cp_sum"]);
    $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $fetch["cp_sum_inves_dept"]);
    $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $fetch["cp_sum_inves_date"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('W' . $i, $fetch["nc_sec31"]);
    $objPHPExcel->getActiveSheet()->setCellValue('X' . $i, $fetch["nc_sec32"]);
    $objPHPExcel->getActiveSheet()->setCellValue('Y' . $i, $fetch["nc_sec33"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('Z' . $i, $fetch["nc_sec4f1"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AA' . $i, $fetch["nc_sec4f1_file"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AB' . $i, $fetch["nc_sec4f1_status"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AC' . $i, $fetch["nc_sec4f1_signature"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('AD' . $i, $fetch["nc_sec4f2"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AE' . $i, $fetch["nc_sec4f2_file"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AF' . $i, $fetch["nc_sec4f2_status"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AG' . $i, $fetch["nc_sec4f2_signature"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('AH' . $i, $fetch["nc_sec4f3"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AI' . $i, $fetch["nc_sec4f3_file"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AJ' . $i, $fetch["nc_sec4f3_status"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AK' . $i, $fetch["nc_sec4f3_signature"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('AL' . $i, $fetch["nc_sec5"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AM' . $i, $fetch["nc_sec5file"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AN' . $i, $fetch["nc_sec5cost_detail"]);
    $objPHPExcel->getActiveSheet()->setCellValue('AO' . $i, $fetch["nc_sec5cost"]);



                $i++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="NC Report List.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
    
    
}

        
    }
    
    
    
    
    
    
    
    
    public function nc_report($cp_no){
       $query = $this->db->query("SELECT complaint_main.cp_no, complaint_status.cp_status_name, complaint_main.cp_id, complaint_main.cp_date, complaint_main.cp_topic, complaint_main.cp_topic_cat, complaint_main.cp_priority, complaint_main.cp_user_name, complaint_main.cp_user_empid, complaint_main.cp_user_email, complaint_main.cp_user_dept, complaint_main.cp_cus_name, complaint_main.cp_cus_ref, complaint_main.cp_invoice_no, complaint_main.cp_pro_code, complaint_main.cp_pro_lotno, complaint_main.cp_pro_qty, complaint_main.cp_detail, complaint_main.cp_file, complaint_main.cp_status_code, complaint_main.cp_detail_inves, complaint_main.cp_detail_inves_signature, complaint_main.cp_detail_inves_dept, complaint_main.cp_detail_inves_date, complaint_main.cp_detail_inves_file, complaint_main.cp_sum_inves, complaint_main.cp_sum_inves_signature, complaint_main.cp_sum_inves_dept, complaint_main.cp_sum_inves_date, complaint_main.cp_sum_inves_file, complaint_main.cp_sum, complaint_main.cp_conclu_detail, complaint_main.cp_conclu_signature, complaint_main.cp_conclu_dept, complaint_main.cp_conclu_date, complaint_main.cp_conclu_costdetail, complaint_main.cp_conclu_cost, complaint_main.cp_conclu_file, complaint_main.cp_modify_by, complaint_main.cp_modify_datetime, complaint_main.cp_modify_reason, complaint_main.nc_status_code, complaint_main.nc_sec31, complaint_main.nc_sec32, complaint_main.nc_sec32date, complaint_main.nc_sec32time, complaint_main.nc_sec33, complaint_main.nc_sec33date, complaint_main.nc_sec33time, complaint_main.nc_sec3owner, complaint_main.nc_sec3empid, complaint_main.nc_sec3dept, complaint_main.nc_sec3date, complaint_main.nc_sec3edit_memo, complaint_main.nc_sec4f1, complaint_main.nc_sec4f1_file, complaint_main.nc_sec4f1_status, complaint_main.nc_sec4f1_date, complaint_main.nc_sec4f1_time, complaint_main.nc_sec4f1_signature, complaint_main.nc_sec4f2, complaint_main.nc_sec4f2_file, complaint_main.nc_sec4f2_status, complaint_main.nc_sec4f2_date, complaint_main.nc_sec4f2_time, complaint_main.nc_sec4f2_signature, complaint_main.nc_sec4f3, complaint_main.nc_sec4f3_file, complaint_main.nc_sec4f3_status, complaint_main.nc_sec4f3_signature, complaint_main.nc_sec5, complaint_main.nc_sec5file, complaint_main.nc_sec5cost_detail, complaint_main.nc_sec5cost, complaint_main.nc_sec5failed, complaint_main.nc_sec5filefailed, complaint_main.nc_sec5costfailed, complaint_main.cp_no_old, complaint_main.nc_modify_by, complaint_main.nc_modify_date FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.nc_status_code WHERE cp_no='$cp_no' ");
       
       $result = $query->row();
       
                $date = date_create($result->cp_date);
                $condate = date_format($date, "d/m/Y");

                $date2 = date_create($result->cp_sum_inves_date);
                $condate2 = date_format($date2, "d/m/Y");
       
       $objPHPExcel = new PHPExcel();
//       $objPHPExcel->getActiveSheet()->setCellValue('A4', '');
       
       // Create a first sheet, representing sales data

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ใบรายงานปัญหา / ข้อบกพร่อง NC');
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Complaint : '.$result->cp_no.'NC Status : '.$result->cp_status_name);

$objPHPExcel->getActiveSheet()->setCellValue('A4', '1. รายละเอียดปัญหา/ข้อบกพร่อง สำหรับผู้พบปัญหา');
$objPHPExcel->getActiveSheet()->setCellValue('A5', 'เรียน ผู้จัดการฝ่าย');
$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Transform Complaint No. : '.$result->cp_no);
$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Detail of Complaint / Damage : '.$result->cp_detail);
$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Detail of Investigate : '.$result->cp_detail_inves);
$objPHPExcel->getActiveSheet()->setCellValue('A9', 'Summary of Investigate : '.$result->cp_sum_inves);
$objPHPExcel->getActiveSheet()->setCellValue('A10', 'ผู้แจ้ง : '.$result->cp_user_name);
$objPHPExcel->getActiveSheet()->setCellValue('D10', 'วันที่แจ้ง : '.$condate);
$objPHPExcel->getActiveSheet()->setCellValue('G10', 'ผู้อนุมัติ : '.$result->cp_sum_inves_signature);
$objPHPExcel->getActiveSheet()->setCellValue('J10', 'วันที่อนุมัติ : '.$condate2);

$objPHPExcel->getActiveSheet()->setCellValue('A11', '2. สำหรับฝ่ายบริหาร (พิจารณาและกำหนดฝ่ายที่รับผิดชอบ แล้วส่งให้ MR. ดำเนินการ)');
$objPHPExcel->getActiveSheet()->setCellValue('A12', 'ฝ่ายที่รับผิดชอบในการปฎิบัติการแก้ไขและป้องกันปัญหา ได้แก่ : ');


$objConnect = mysqli_connect("localhost","root","1234","saleecolour") or die("Error Connect to Database");
mysqli_set_charset($objConnect,"utf8");
$sql = "SELECT complaint_department.cp_dept_cp_no, complaint_department.cp_dept_code, complaint_department_main.cp_dept_main_name FROM complaint_department INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = complaint_department.cp_dept_code WHERE cp_dept_cp_no ='$cp_no' ";

$querync = mysqli_query($objConnect, $sql);
$i=13;
while($fetchnc = mysqli_fetch_array($querync)){
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i , $fetchnc['cp_dept_main_name']);
$i++;
}
       
       
    }
    
    
    
    
    
    
    
    
}



?>