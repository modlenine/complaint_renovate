<?php
require_once 'PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();

//Add Head column
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'comid')
            ->setCellValue('B1', 'comstatus')
            ->setCellValue('C1', 'comdepartment')
            ->setCellValue('D1', 'comtype')
            ->setCellValue('E1', 'combrand')
            ->setCellValue('F1', 'commodel')
            ->setCellValue('G1', 'comcpu')
            ->setCellValue('H1', 'comram')
            ->setCellValue('I1', 'comharddisk')
            ->setCellValue('J1', 'comlan')
            ->setCellValue('K1', 'comwireless')
            ->setCellValue('L1', 'comos')
            ->setCellValue('M1', 'commonitor')
            ->setCellValue('N1', 'comups')
            ->setCellValue('O1', 'comlicense')
            ->setCellValue('P1', 'comuser')
            ->setCellValue('Q1', 'comsn')
            ->setCellValue('R1', 'commonitorsn')
            ->setCellValue('S1', 'comremark')
            ->setCellValue('T1', 'comip')
            ->setCellValue('U1', 'comasset')
            ->setCellValue('V1', 'comlocation')
            ->setCellValue('W1', 'compopr')
            ->setCellValue('X1', 'comvender')
            ->setCellValue('Y1', 'comstartdate');

//Set Column width
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(15);

// Write data from MySQL result
$objConnect = mysqli_connect("localhost","root","1234","it") or die("Error Connect to Database");
mysqli_set_charset($objConnect,"utf8");
$strSQL = "SELECT * FROM inventory ORDER BY comid ASC";
$objQuery = mysqli_query($objConnect,$strSQL);
$i = 2;
while($objResult = mysqli_fetch_array($objQuery))
{
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $objResult["comid"]);
	$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $objResult["comstatus"]);
	$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $objResult["comdepartment"]);
	$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $objResult["comtype"]);
	$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $objResult["combrand"]);
	$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $objResult["commodel"]);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $objResult["comcpu"]);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $objResult["comram"]);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $objResult["comharddisk"]);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $objResult["comlan"]);
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $objResult["comwireless"]);
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $objResult["comos"]);
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $objResult["commonitor"]);
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $objResult["comups"]);
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $objResult["comlicense"]);
        $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $objResult["comuser"]);
        $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $objResult["comsn"]);
        $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $objResult["commonitorsn"]);
        $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $objResult["comremark"]);
        $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $objResult["comip"]);
        $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $objResult["comasset"]);
        $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $objResult["comlocation"]);
        $objPHPExcel->getActiveSheet()->setCellValue('W' . $i, $objResult["compopr"]);
        $objPHPExcel->getActiveSheet()->setCellValue('X' . $i, $objResult["comvender"]);
        $objPHPExcel->getActiveSheet()->setCellValue('Y' . $i, $objResult["comstartdate"]);
	$i++;
}
mysqli_close($objConnect);



$objPHPExcel->getActiveSheet()->setTitle('Computer');



header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Computer Inventory.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>