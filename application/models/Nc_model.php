<?php
class Nc_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("complaint_model");

    }

    public function list_nc(){
        return $this->db->query("SELECT
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
" );
    }



    public function getdata_main($cp_no,$nc_related_dept){
        $result = $this->db->query("SELECT
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
complaint_status.cp_status_name,
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
nc_main.nc_modify_date
FROM
nc_main
INNER JOIN complaint_main ON complaint_main.cp_no = nc_main.nc_no
INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = nc_main.nc_related_dept
INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
INNER JOIN complaint_status ON complaint_status.cp_status_id = nc_main.nc_status_code WHERE nc_no='$cp_no' AND nc_related_dept='$nc_related_dept' ");
        return $result->row();
    }



    public function save_ncsec3($cp_no,$nc_related_dept){

        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec3file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);

		$file_size =$_FILES['nc_sec3file']['size'];
		$file_tmp =$_FILES['nc_sec3file']['tmp_name'];
		$file_type=$_FILES['nc_sec3file']['type'];
		move_uploaded_file($file_tmp,"asset/nc/sec3/".$file_name_date);

                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";


        $data = array(
            "nc_sec31" => $this->input->post("nc_sec31"),
            "nc_sec32" => $this->input->post("nc_sec32"),
            "nc_sec32date" => $this->input->post("datetime32"),
//            "nc_sec32time" => $this->input->post("nc_sec32time"),
            "nc_sec33" => $this->input->post("nc_sec33"),
            "nc_sec33date" => $this->input->post("datetime33"),
//            "nc_sec33time" => $this->input->post("nc_sec33time"),
            "nc_sec3owner" => $this->input->post("nc_sec3owner"),
            "nc_sec3empid" => $this->input->post("nc_sec3empid"),
            "nc_sec3dept" => $this->input->post("nc_sec3dept"),
            "nc_sec3date" => $this->input->post("nc_sec3date"),
            "nc_sec3file" => $file_name_date,
            "nc_status_code" => "nc02"
        );

        $this->db->where("nc_no",$cp_no);
        $this->db->where("nc_related_dept",$nc_related_dept);
        $this->db->update("nc_main",$data);



 //****************************Email***Zone*********************************************//
  $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' && cp_dept_code= '$nc_related_dept' ");

    $get_owner_email = $this->getdata_main($cp_no,$nc_related_dept);


            $date = date_create($get_owner_email->cp_date);
             $condate = date_format($date, "d/m/Y");

             $date2 = date_create($get_owner_email->cp_sum_inves_date);
             $condate2 = date_format($date2, "d/m/Y");



    $subject = "ใบรายงานปัญหา / ข้อบกพร่อง NC สถานะ รอดำเนินการ";
            $body = "<strong style='font-size:18px;font-weight:600;'>1. รายละเอียดปัญหา/ข้อบกพร่อง สำหรับผู้พบปัญหา</strong><br>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $condate . "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
            $body .="<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name ."<br><br>";


            $body .= "<strong>Details of Complaint / Damages</strong>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" .$get_owner_email->cp_file. "</a>" . "<br><br>";


            $body .= "<strong>Investigation</strong><br>";
            $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves ."<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>".$get_owner_email->cp_detail_inves_file . "</a><br><br>";


            $body .= "<strong>Summary of Investigation</strong><br>";
            $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves."<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>".$get_owner_email->cp_sum_inves_file . "</a><br>";
            $body .= "<strong>ผู้แจ้ง :</strong>&nbsp;&nbsp;".$get_owner_email->cp_user_name."&nbsp;&nbsp;<strong>วันที่แจ้ง : </strong>&nbsp;&nbsp;".$condate."&nbsp;&nbsp;<strong>ผู้อนุมัติ : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves_signature."&nbsp;&nbsp;<strong>วันที่อนุมัติ : </strong>&nbsp;&nbsp;".$condate2."<br><br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>2. สำหรับฝ่ายบริหาร (พิจารณาและกำหนดฝ่ายที่รับผิดชอบ แล้วส่งให้ MR. ดำเนินการ)</strong><br>";
            $body .= "<strong>ฝ่ายที่รับผิดชอบในการปฎิบัติการแก้ไขและป้องกันปัญหา ได้แก่ : </strong>";

            $body .="&nbsp;&nbsp;".$get_owner_email->cp_dept_main_name;

            $body .= "<br>";
            $body .= "<strong>ลงชื่อฝ่ายบริหาร : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves_signature."&nbsp;&nbsp;<strong>วันที่ : </strong>&nbsp;&nbsp;".$condate2."<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>3. สำหรับฝ่ายที่รับผิดชอบให้หาสาเหตุ. วิธีแก้ไขและป้องกันและกำหนดแผนการปฎิบัติการแก้ไข</strong><br>";
            $body .= "<strong style='font-size:16px;font-weight:600;'>Corrective</strong><br>";
            $body .= "<strong>3.1 สาเหตุ : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec31."<br>";
            $body .= "<strong>3.2 วิธีแก้ไข : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec32."<br>";

                                    $date1 = date_create($get_owner_email->nc_sec32date);
                                    $result_date = date_format($date1, "d/m/Y H:i:s");

                                    $date_2 = date_create($get_owner_email->nc_sec33date);
                                    $result_date2 = date_format($date_2, "d/m/Y H:i:s");

                                    $sec3date = date_create($get_owner_email->nc_sec3date);
                                    $result_sec3date = date_format($sec3date, "d/m/Y");

            $body .= "<strong>กำหนดเสร็จ :</strong>&nbsp;&nbsp;".$result_date."<br>";
            $body .= "<strong style='font-size:16px;font-weight:600;'>Preventive</strong><br>";
            $body .= "<strong>3.3 วิธีการป้องกัน (Action plan)</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec33."<br>";
            $body .= "<strong>กำหนดเสร็จ :</strong>&nbsp;&nbsp;".$result_date2."<br>";
            $body .= "<strong>ผู้รับผิดชอบ :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3owner."&nbsp;&nbsp;<strong>รหัสพนักงาน :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3empid."&nbsp;&nbsp;<strong>แผนก :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3dept."&nbsp;&nbsp;<strong>วันที่ : </strong>&nbsp;&nbsp;".$result_sec3date."<br>";

            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint/nc/main/".$cp_no."/".$nc_related_dept.">" . "Go to Page</a>";


    $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
        $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
        $mail->Host = "mail.saleecolour.com";  // specify main and backup server
//        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // พอร์ท
//        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "websystem@saleecolour.com";  // SMTP username
        //websystem@saleecolour.com
//        $mail->Username = "chainarong039@gmail.com";
        $mail->Password = "Ae8686#"; // SMTP password
        //Ae8686#
//        $mail->Password = "ShctBkk1";

        $mail->From = "websystem@saleecolour.com";
        $mail->FromName = "Salee Colour WEB System";
        foreach ($getEmail->result_array() as $fetch) {
            $mail->AddAddress($fetch['email']);
        }

        $mail->AddCC($get_owner_email->cp_user_email);

// $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
// $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
// $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        if(!$mail->send()){
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
        }


 //************************Email***Zone***********************************//
    }


    public function savenc_sec3edit($cp_no,$nc_related_dept){
//        $date = date_create($this->input->post("datetime1_edit"));
//        $dateformat = date_format($date, "Y-m-d H:i:s");
        if($_FILES['nc_sec3file_edit']['name']!= ""){
            //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec3file_edit']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);

		$file_size =$_FILES['nc_sec3file_edit']['size'];
		$file_tmp =$_FILES['nc_sec3file_edit']['tmp_name'];
		$file_type=$_FILES['nc_sec3file_edit']['type'];
		move_uploaded_file($file_tmp,"asset/nc/sec3/".$file_name_date);

                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";

        $data = array(
            "nc_sec31" => $this->input->post("nc_sec31edit"),
            "nc_sec32" => $this->input->post("nc_sec32edit"),
            "nc_sec32date" => $this->input->post("datetime1_edit"),
//            "nc_sec32time" => $this->input->post("nc_sec32timeedit"),
            "nc_sec33" => $this->input->post("nc_sec33edit"),
            "nc_sec33date" => $this->input->post("datetime2_edit"),
            "nc_sec3file" => $file_name_date,
//            "nc_sec33time" => $this->input->post("nc_sec33timeedit"),
            "nc_sec3edit_memo" => $this->input->post("nc_sec3edit_memo"),
            "nc_modify_by" => $this->input->post("nc_modify_by"),
            "nc_modify_date" => $this->input->post("nc_modify_date")

        );


        }else{
            $data = array(
            "nc_sec31" => $this->input->post("nc_sec31edit"),
            "nc_sec32" => $this->input->post("nc_sec32edit"),
            "nc_sec32date" => $this->input->post("datetime1_edit"),
//            "nc_sec32time" => $this->input->post("nc_sec32timeedit"),
            "nc_sec33" => $this->input->post("nc_sec33edit"),
            "nc_sec33date" => $this->input->post("datetime2_edit"),
//            "nc_sec33time" => $this->input->post("nc_sec33timeedit"),
            "nc_sec3edit_memo" => $this->input->post("nc_sec3edit_memo"),
            "nc_modify_by" => $this->input->post("nc_modify_by"),
            "nc_modify_date" => $this->input->post("nc_modify_date")

        );
        }



        $this->db->where("nc_no",$cp_no);
        $this->db->update("nc_main",$data);


        header("refresh:0; url=http://192.190.10.27/complaint/nc/main/$cp_no/$nc_related_dept");
        }




    public function save_sec4f1($cp_no,$nc_related_dept){

            //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec4f1_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);

		$file_size =$_FILES['nc_sec4f1_file']['size'];
		$file_tmp =$_FILES['nc_sec4f1_file']['tmp_name'];
		$file_type=$_FILES['nc_sec4f1_file']['type'];
		move_uploaded_file($file_tmp,"asset/nc/sec4/f1/".$file_name_date);

                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";

        if($this->input->post("nc_sec4f1_status") == "yes"){
            $nc_status_4f1 = "nc06";
        }else{
            $nc_status_4f1 = "nc03";
        }

        $data = array(
            "nc_sec4f1" => $this->input->post("nc_sec4f1"),
            "nc_sec4f1_file" => $file_name_date,
            "nc_sec4f1_status" => $this->input->post("nc_sec4f1_status"),
            "nc_sec4f1_date" => $this->input->post("datetime41"),
//            "nc_sec4f1_time" => $this->input->post("nc_sec4f1_time"),
            "nc_sec4f1_signature" => $this->input->post("nc_sec4f1_signature"),
            "nc_status_code" => $nc_status_4f1
        );

        $this->db->where("nc_no",$cp_no);
        $this->db->where("nc_related_dept",$nc_related_dept);
        $this->db->update("nc_main",$data);


                     //****************************Email***Zone*********************************************//
  $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' AND cp_dept_code = '$nc_related_dept' ");

    $get_owner_email = $this->getdata_main($cp_no,$nc_related_dept);


            $date0 = date_create($get_owner_email->cp_date);
             $condate = date_format($date0, "d/m/Y");

             $date2 = date_create($get_owner_email->cp_sum_inves_date);
             $condate2 = date_format($date2, "d/m/Y");


    $subject = "ใบรายงานปัญหา / ข้อบกพร่อง NC สถานะ รายงานผลการติดตามครั้งที่ 1";
            $body = "<strong style='font-size:18px;font-weight:600;'>1. รายละเอียดปัญหา/ข้อบกพร่อง สำหรับผู้พบปัญหา</strong><br>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
            $body .="<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name ."<br><br>";


            $body .= "<strong>Details of Complaint / Damages</strong>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" .$get_owner_email->cp_file. "</a>" . "<br><br>";


            $body .= "<strong>Investigation</strong><br>";
            $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves ."<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>".$get_owner_email->cp_detail_inves_file . "</a><br><br>";


            $body .= "<strong>Summary of Investigation</strong><br>";
            $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves."<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>".$get_owner_email->cp_sum_inves_file . "</a><br>";
            $body .= "<strong>ผู้แจ้ง :</strong>&nbsp;&nbsp;".$get_owner_email->cp_user_name."&nbsp;&nbsp;<strong>วันที่แจ้ง : </strong>&nbsp;&nbsp;".$condate."&nbsp;&nbsp;<strong>ผู้อนุมัติ : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves_signature."&nbsp;&nbsp;<strong>วันที่อนุมัติ : </strong>&nbsp;&nbsp;".$condate2."<br><br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>2. สำหรับฝ่ายบริหาร (พิจารณาและกำหนดฝ่ายที่รับผิดชอบ แล้วส่งให้ MR. ดำเนินการ)</strong><br>";

            $body .= "<strong>ฝ่ายที่รับผิดชอบในการปฎิบัติการแก้ไขและป้องกันปัญหา ได้แก่ : </strong>";

            $body .="&nbsp;&nbsp;".$get_owner_email->cp_dept_main_name;


            $body .= "<br>";
            $body .= "<strong>ลงชื่อฝ่ายบริหาร : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves_signature."&nbsp;&nbsp;<strong>วันที่ : </strong>&nbsp;&nbsp;".$condate2."<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>3. สำหรับฝ่ายที่รับผิดชอบให้หาสาเหตุ. วิธีแก้ไขและป้องกันและกำหนดแผนการปฎิบัติการแก้ไข</strong><br>";
            $body .= "<strong style='font-size:16px;font-weight:600;'>Corrective</strong><br>";
            $body .= "<strong>3.1 สาเหตุ : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec31."<br>";
            $body .= "<strong>3.2 วิธีแก้ไข : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec32."<br>";

                                    $date1 = date_create($get_owner_email->nc_sec32date);
                                    $result_date = date_format($date1, "d/m/Y H:i:s");

                                    $date_2 = date_create($get_owner_email->nc_sec33date);
                                    $result_date2 = date_format($date_2, "d/m/Y H:i:s");

                                    $sec3date = date_create($get_owner_email->nc_sec3date);
                                    $result_sec3date = date_format($sec3date, "d/m/Y");

            $body .= "<strong>กำหนดเสร็จ :</strong>&nbsp;&nbsp;".$result_date."<br>";
            $body .= "<strong style='font-size:16px;font-weight:600;'>Preventive</strong><br>";
            $body .= "<strong>3.3 วิธีการป้องกัน (Action plan)</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec33."<br>";
            $body .= "<strong>กำหนดเสร็จ :</strong>&nbsp;&nbsp;".$result_date2."<br>";
            $body .= "<strong>ผู้รับผิดชอบ :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3owner."&nbsp;&nbsp;<strong>รหัสพนักงาน :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3empid."&nbsp;&nbsp;<strong>แผนก :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3dept."&nbsp;&nbsp;<strong>วันที่ : </strong>&nbsp;&nbsp;".$result_sec3date."<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>4. สำหรับฝ่ายที่เกี่ยวข้อง (เพื่อติดตามและปิดสรุป)</strong><br>";
            $body .= "<strong>ผลการติดตามครั้งที่ 1 : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f1."<br>";
            $body .= "<strong>เอกสารประกอบ : </strong>&nbsp;&nbsp;<a href='http://192.190.10.27/complaint/asset/nc/sec4/f1/$get_owner_email->nc_sec4f1_file'>".$get_owner_email->nc_sec4f1_file . "</a>"."<br>";

            if($get_owner_email->nc_sec4f1_status == "no"){
                $f1status = "ไม่ปิดสรุป";
            }else{
                $f1status = "ปิดสรุป";
            }

            $body .= "<strong>สถานะ :</strong>&nbsp;&nbsp;".$f1status."<br>";

            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint/nc/main/".$cp_no."/".$nc_related_dept.">" . "Go to Page</a>";


    $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
        $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
        $mail->Host = "mail.saleecolour.com";  // specify main and backup server
//        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // พอร์ท
//        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "websystem@saleecolour.com";  // SMTP username
        //websystem@saleecolour.com
//        $mail->Username = "chainarong039@gmail.com";
        $mail->Password = "Ae8686#"; // SMTP password
        //Ae8686#
//        $mail->Password = "ShctBkk1";

        $mail->From = "websystem@saleecolour.com";
        $mail->FromName = "Salee Colour WEB System";
        foreach ($getEmail->result_array() as $fetch) {
            $mail->AddAddress($fetch['email']);
        }

        $mail->AddCC($get_owner_email->cp_user_email);
// $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
// $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
// $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        if(!$mail->send()){
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
            header("refresh:0; url=http://192.190.10.27/complaint/nc/main/$cp_no/$nc_related_dept");
        }


 //************************Email***Zone***********************************//

    }


    public function save_sec4f2($cp_no,$nc_related_dept){
                    //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec4f2_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);

		$file_size =$_FILES['nc_sec4f2_file']['size'];
		$file_tmp =$_FILES['nc_sec4f2_file']['tmp_name'];
		$file_type=$_FILES['nc_sec4f2_file']['type'];
		move_uploaded_file($file_tmp,"asset/nc/sec4/f2/".$file_name_date);

                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";

        if($this->input->post("nc_sec4f2_status") == "yes"){
            $nc_status_4f2 = "nc07";
        }else{
            $nc_status_4f2 = "nc04";
        }

        $data = array(
            "nc_sec4f2" => $this->input->post("nc_sec4f2"),
            "nc_sec4f2_file" => $file_name_date,
            "nc_sec4f2_status" => $this->input->post("nc_sec4f2_status"),
            "nc_sec4f2_date" => $this->input->post("datetime42"),
//            "nc_sec4f2_time" => $this->input->post("nc_sec4f2_time"),
            "nc_sec4f2_signature" => $this->input->post("nc_sec4f2_signature"),
            "nc_status_code" => $nc_status_4f2
        );

        $this->db->where("nc_no",$cp_no);
        $this->db->where("nc_related_dept",$nc_related_dept);
        $this->db->update("nc_main",$data);


  //****************************Email***Zone*********************************************//
  $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' && cp_dept_code = '$nc_related_dept' ");

    $get_owner_email = $this->getdata_main($cp_no,$nc_related_dept);


            $date0 = date_create($get_owner_email->cp_date);
             $condate = date_format($date0, "d/m/Y");

             $date2 = date_create($get_owner_email->cp_sum_inves_date);
             $condate2 = date_format($date2, "d/m/Y");


    $subject = "ใบรายงานปัญหา / ข้อบกพร่อง NC สถานะ รายงานผลการติดตามผลครั้งที่ 2";
            $body = "<strong style='font-size:18px;font-weight:600;'>1. รายละเอียดปัญหา/ข้อบกพร่อง สำหรับผู้พบปัญหา</strong><br>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
            $body .="<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name ."<br><br>";


            $body .= "<strong>Details of Complaint / Damages</strong>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" .$get_owner_email->cp_file. "</a>" . "<br><br>";


            $body .= "<strong>Investigation</strong><br>";
            $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves ."<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>".$get_owner_email->cp_detail_inves_file . "</a><br><br>";


            $body .= "<strong>Summary of Investigation</strong><br>";
            $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves."<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>".$get_owner_email->cp_sum_inves_file . "</a><br>";
            $body .= "<strong>ผู้แจ้ง :</strong>&nbsp;&nbsp;".$get_owner_email->cp_user_name."&nbsp;&nbsp;<strong>วันที่แจ้ง : </strong>&nbsp;&nbsp;".$condate."&nbsp;&nbsp;<strong>ผู้อนุมัติ : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves_signature."&nbsp;&nbsp;<strong>วันที่อนุมัติ : </strong>&nbsp;&nbsp;".$condate2."<br><br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>2. สำหรับฝ่ายบริหาร (พิจารณาและกำหนดฝ่ายที่รับผิดชอบ แล้วส่งให้ MR. ดำเนินการ)</strong><br>";
            $body .= "<strong>ฝ่ายที่รับผิดชอบในการปฎิบัติการแก้ไขและป้องกันปัญหา ได้แก่ : </strong>";

            $body .="&nbsp;&nbsp;".$get_owner_email->cp_dept_main_name;

            $body .= "<br>";
            $body .= "<strong>ลงชื่อฝ่ายบริหาร : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves_signature."&nbsp;&nbsp;<strong>วันที่ : </strong>&nbsp;&nbsp;".$condate2."<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>3. สำหรับฝ่ายที่รับผิดชอบให้หาสาเหตุ. วิธีแก้ไขและป้องกันและกำหนดแผนการปฎิบัติการแก้ไข</strong><br>";
            $body .= "<strong style='font-size:16px;font-weight:600;'>Corrective</strong><br>";
            $body .= "<strong>3.1 สาเหตุ : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec31."<br>";
            $body .= "<strong>3.2 วิธีแก้ไข : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec32."<br>";

                                    $date1 = date_create($get_owner_email->nc_sec32date);
                                    $result_date = date_format($date1, "d/m/Y H:i:s");

                                    $date_2 = date_create($get_owner_email->nc_sec33date);
                                    $result_date2 = date_format($date_2, "d/m/Y H:i:s");

                                    $sec3date = date_create($get_owner_email->nc_sec3date);
                                    $result_sec3date = date_format($sec3date, "d/m/Y");

            $body .= "<strong>กำหนดเสร็จ :</strong>&nbsp;&nbsp;".$result_date."<br>";
            $body .= "<strong style='font-size:16px;font-weight:600;'>Preventive</strong><br>";
            $body .= "<strong>3.3 วิธีการป้องกัน (Action plan)</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec33."<br>";
            $body .= "<strong>กำหนดเสร็จ :</strong>&nbsp;&nbsp;".$result_date2."<br>";
            $body .= "<strong>ผู้รับผิดชอบ :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3owner."&nbsp;&nbsp;<strong>รหัสพนักงาน :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3empid."&nbsp;&nbsp;<strong>แผนก :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3dept."&nbsp;&nbsp;<strong>วันที่ : </strong>&nbsp;&nbsp;".$result_sec3date."<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>4. สำหรับฝ่ายที่เกี่ยวข้อง (เพื่อติดตามและปิดสรุป)</strong><br>";
            $body .= "<strong>ผลการติดตามครั้งที่ 1 : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f1."<br>";
            $body .= "<strong>เอกสารประกอบ : </strong>&nbsp;&nbsp;<a href='http://192.190.10.27/complaint/asset/nc/sec4/f1/$get_owner_email->nc_sec4f1_file'>".$get_owner_email->nc_sec4f1_file . "</a>"."<br>";

            if($get_owner_email->nc_sec4f1_status == "no"){
                $f1status = "ไม่ปิดสรุป";
            }else{
                $f1status = "ปิดสรุป";
            }
            $body .= "<strong>สถานะ :</strong>&nbsp;&nbsp;".$f1status."<br><br>";


            $body .= "<strong>ผลการติดตามครั้งที่ 2 : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f2."<br>";
            $body .= "<strong>เอกสารประกอบ : </strong>&nbsp;&nbsp;<a href='http://192.190.10.27/complaint/asset/nc/sec4/f2/$get_owner_email->nc_sec4f2_file'>".$get_owner_email->nc_sec4f2_file . "</a>"."<br>";

            if($get_owner_email->nc_sec4f2_status == "no"){
                $f2status = "ไม่ปิดสรุป";
            }else{
                $f2status = "ปิดสรุป";
            }
            $body .= "<strong>สถานะ :</strong>&nbsp;&nbsp;".$f2status."<br>";

            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint/nc/main/".$cp_no."/".$nc_related_dept.">" . "Go to Page</a>";


    $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
        $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
        $mail->Host = "mail.saleecolour.com";  // specify main and backup server
//        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // พอร์ท
//        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "websystem@saleecolour.com";  // SMTP username
        //websystem@saleecolour.com
//        $mail->Username = "chainarong039@gmail.com";
        $mail->Password = "Ae8686#"; // SMTP password
        //Ae8686#
//        $mail->Password = "ShctBkk1";

        $mail->From = "websystem@saleecolour.com";
        $mail->FromName = "Salee Colour WEB System";
        foreach ($getEmail->result_array() as $fetch) {
            $mail->AddAddress($fetch['email']);
        }

        $mail->AddCC($get_owner_email->cp_user_email);
// $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
// $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
// $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        if(!$mail->send()){
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
            header("refresh:0; url=http://192.190.10.27/complaint/nc/main/$cp_no/$nc_related_dept");
        }


 //************************Email***Zone***********************************//


    }


        public function save_sec4f3($cp_no,$nc_related_dept){
            $dept_code = $this->input->post("getdeptcode");

            if($this->input->post("nc_sec4f3_status")=="no"){
                $linkurl = "complaint/add_failed/$cp_no/$dept_code";
                $nc_sec4f3_status = "nc09";
            }else{ $linkurl="nc/main/$cp_no/$nc_related_dept";$nc_sec4f3_status="nc08";}

                    //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec4f3_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);

		$file_size =$_FILES['nc_sec4f3_file']['size'];
		$file_tmp =$_FILES['nc_sec4f3_file']['tmp_name'];
		$file_type=$_FILES['nc_sec4f3_file']['type'];
		move_uploaded_file($file_tmp,"asset/nc/sec4/f3/".$file_name_date);

                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";

        $data = array(
            "nc_sec4f3" => $this->input->post("nc_sec4f3"),
            "nc_sec4f3_file" => $file_name_date,
            "nc_sec4f3_status" => $this->input->post("nc_sec4f3_status"),
            "nc_sec4f3_signature" => $this->input->post("nc_sec4f3_signature"),
            "nc_status_code" => $nc_sec4f3_status
        );

        $this->db->where("nc_no",$cp_no);
        $this->db->where("nc_related_dept",$nc_related_dept);
        $this->db->update("nc_main",$data);



       //****************************Email***Zone*********************************************//
  $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' && cp_dept_code = '$nc_related_dept' ");

    $get_owner_email = $this->getdata_main($cp_no,$nc_related_dept);


            $date0 = date_create($get_owner_email->cp_date);
             $condate = date_format($date0, "d/m/Y");

             $date2 = date_create($get_owner_email->cp_sum_inves_date);
             $condate2 = date_format($date2, "d/m/Y");


    $subject = "ใบรายงานปัญหา / ข้อบกพร่อง NC สถานะ รายงานผลการติดตามครั้งที่ 3";
            $body = "<strong style='font-size:18px;font-weight:600;'>1. รายละเอียดปัญหา/ข้อบกพร่อง สำหรับผู้พบปัญหา</strong><br>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
            $body .="<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name ."<br><br>";


            $body .= "<strong>Details of Complaint / Damages</strong>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" .$get_owner_email->cp_file. "</a>" . "<br><br>";


            $body .= "<strong>Investigation</strong><br>";
            $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves ."<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>".$get_owner_email->cp_detail_inves_file . "</a><br><br>";


            $body .= "<strong>Summary of Investigation</strong><br>";
            $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves."<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>".$get_owner_email->cp_sum_inves_file . "</a><br>";
            $body .= "<strong>ผู้แจ้ง :</strong>&nbsp;&nbsp;".$get_owner_email->cp_user_name."&nbsp;&nbsp;<strong>วันที่แจ้ง : </strong>&nbsp;&nbsp;".$condate."&nbsp;&nbsp;<strong>ผู้อนุมัติ : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves_signature."&nbsp;&nbsp;<strong>วันที่อนุมัติ : </strong>&nbsp;&nbsp;".$condate2."<br><br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>2. สำหรับฝ่ายบริหาร (พิจารณาและกำหนดฝ่ายที่รับผิดชอบ แล้วส่งให้ MR. ดำเนินการ)</strong><br>";
            $body .= "<strong>ฝ่ายที่รับผิดชอบในการปฎิบัติการแก้ไขและป้องกันปัญหา ได้แก่ : </strong>";

            $body .="&nbsp;&nbsp;".$get_owner_email->cp_dept_main_name;

            $body .= "<br>";
            $body .= "<strong>ลงชื่อฝ่ายบริหาร : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves_signature."&nbsp;&nbsp;<strong>วันที่ : </strong>&nbsp;&nbsp;".$condate2."<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>3. สำหรับฝ่ายที่รับผิดชอบให้หาสาเหตุ. วิธีแก้ไขและป้องกันและกำหนดแผนการปฎิบัติการแก้ไข</strong><br>";
            $body .= "<strong style='font-size:16px;font-weight:600;'>Corrective</strong><br>";
            $body .= "<strong>3.1 สาเหตุ : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec31."<br>";
            $body .= "<strong>3.2 วิธีแก้ไข : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec32."<br>";

                                    $date1 = date_create($get_owner_email->nc_sec32date);
                                    $result_date = date_format($date1, "d/m/Y H:i:s");

                                    $date_2 = date_create($get_owner_email->nc_sec33date);
                                    $result_date2 = date_format($date_2, "d/m/Y H:i:s");

                                    $sec3date = date_create($get_owner_email->nc_sec3date);
                                    $result_sec3date = date_format($sec3date, "d/m/Y");

            $body .= "<strong>กำหนดเสร็จ :</strong>&nbsp;&nbsp;".$result_date."<br>";
            $body .= "<strong style='font-size:16px;font-weight:600;'>Preventive</strong><br>";
            $body .= "<strong>3.3 วิธีการป้องกัน (Action plan)</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec33."<br>";
            $body .= "<strong>กำหนดเสร็จ :</strong>&nbsp;&nbsp;".$result_date2."<br>";
            $body .= "<strong>ผู้รับผิดชอบ :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3owner."&nbsp;&nbsp;<strong>รหัสพนักงาน :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3empid."&nbsp;&nbsp;<strong>แผนก :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3dept."&nbsp;&nbsp;<strong>วันที่ : </strong>&nbsp;&nbsp;".$result_sec3date."<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>4. สำหรับฝ่ายที่เกี่ยวข้อง (เพื่อติดตามและปิดสรุป)</strong><br>";
            $body .= "<strong>ผลการติดตามครั้งที่ 1 : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f1."<br>";
            $body .= "<strong>เอกสารประกอบ : </strong>&nbsp;&nbsp;<a href='http://192.190.10.27/complaint/asset/nc/sec4/f1/$get_owner_email->nc_sec4f1_file'>".$get_owner_email->nc_sec4f1_file . "</a>"."<br>";

            if($get_owner_email->nc_sec4f1_status == "no"){
                $f1status = "ไม่ปิดสรุป";
            }else{
                $f1status = "ปิดสรุป";
            }
            $body .= "<strong>สถานะ :</strong>&nbsp;&nbsp;".$f1status."<br>";
            $body .= "<strong>กำหนดติดตามครั้งที่ 2 :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f1_date."<br><br>";


            $body .= "<strong>ผลการติดตามครั้งที่ 2 : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f2."<br>";
            $body .= "<strong>เอกสารประกอบ : </strong>&nbsp;&nbsp;<a href='http://192.190.10.27/complaint/asset/nc/sec4/f2/$get_owner_email->nc_sec4f2_file'>".$get_owner_email->nc_sec4f2_file . "</a>"."<br>";

            if($get_owner_email->nc_sec4f2_status == "no"){
                $f2status = "ไม่ปิดสรุป";
            }else{
                $f2status = "ปิดสรุป";
            }
            $body .= "<strong>สถานะ :</strong>&nbsp;&nbsp;".$f2status."<br>";
            $body .= "<strong>กำหนดติดตามครั้งที่ 3 :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f2_date."<br><br>";


            $body .= "<strong>ผลการติดตามครั้งที่ 3 : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f3."<br>";
            $body .= "<strong>เอกสารประกอบ : </strong>&nbsp;&nbsp;<a href='http://192.190.10.27/complaint/asset/nc/sec4/f3/$get_owner_email->nc_sec4f3_file'>".$get_owner_email->nc_sec4f3_file . "</a>"."<br>";

            if($get_owner_email->nc_sec4f3_status == "no"){
                $f3status = "ไม่ปิดสรุป";
            }else{
                $f3status = "ปิดสรุป";
            }
            $body .= "<strong>สถานะ :</strong>&nbsp;&nbsp;".$f3status."<br>";



            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint/nc/main/".$cp_no."/".$nc_related_dept.">" . "Go to Page</a>";


    $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
        $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
        $mail->Host = "mail.saleecolour.com";  // specify main and backup server
//        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // พอร์ท
//        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "websystem@saleecolour.com";  // SMTP username
        //websystem@saleecolour.com
//        $mail->Username = "chainarong039@gmail.com";
        $mail->Password = "Ae8686#"; // SMTP password
        //Ae8686#
//        $mail->Password = "ShctBkk1";

        $mail->From = "websystem@saleecolour.com";
        $mail->FromName = "Salee Colour WEB System";
        foreach ($getEmail->result_array() as $fetch) {
            $mail->AddAddress($fetch['email']);
        }

        $mail->AddCC($get_owner_email->cp_user_email);
// $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
// $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
// $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        if(!$mail->send()){
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
            header("refresh:0; url=http://192.190.10.27/complaint/$linkurl");
        }


 //************************Email***Zone***********************************//


    }


    public function save_sec5($cp_no,$nc_related_dept){
                    //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec5file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);

		$file_size =$_FILES['nc_sec5file']['size'];
		$file_tmp =$_FILES['nc_sec5file']['tmp_name'];
		$file_type=$_FILES['nc_sec5file']['type'];
		move_uploaded_file($file_tmp,"asset/nc/sec5/".$file_name_date);

                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";

        $sec5_convert = $this->input->post("nc_sec5cost");
        $sec5_cut_comma = str_replace(",", "", $sec5_convert);

        $data = array(
            "nc_sec5" => $this->input->post("nc_sec5"),
            "nc_sec5_file" => $file_name_date,
            "nc_sec5cost_detail" => $this->input->post("nc_sec5cost_detail"),
            "nc_sec5cost" => $sec5_cut_comma,
            "nc_status_code" => "nc11"
        );

        $this->db->where("nc_no",$cp_no);
        $this->db->where("nc_related_dept",$nc_related_dept);
        $this->db->update("nc_main",$data);


           //****************************Email***Zone*********************************************//
  $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' && cp_dept_code = '$nc_related_dept' ");

    $get_owner_email = $this->getdata_main($cp_no,$nc_related_dept);


            $date0 = date_create($get_owner_email->cp_date);
             $condate = date_format($date0, "d/m/Y");

             $date2 = date_create($get_owner_email->cp_sum_inves_date);
             $condate2 = date_format($date2, "d/m/Y");

             $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email ";
             $sqlget_query = $this->db->query($sqlget_ccemail);


    $subject = "ใบรายงานปัญหา / ข้อบกพร่อง NC สถานะ Conclusion of nc";
            $body = "<strong style='font-size:18px;font-weight:600;'>1. รายละเอียดปัญหา/ข้อบกพร่อง สำหรับผู้พบปัญหา</strong><br>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
            $body .="<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name ."<br><br>";


            $body .= "<strong>Details of Complaint / Damages</strong>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" .$get_owner_email->cp_file. "</a>" . "<br><br>";


            $body .= "<strong>Investigation</strong><br>";
            $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves ."<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>".$get_owner_email->cp_detail_inves_file . "</a><br><br>";


            $body .= "<strong>Summary of Investigation</strong><br>";
            $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves."<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>".$get_owner_email->cp_sum_inves_file . "</a><br>";
            $body .= "<strong>ผู้แจ้ง :</strong>&nbsp;&nbsp;".$get_owner_email->cp_user_name."&nbsp;&nbsp;<strong>วันที่แจ้ง : </strong>&nbsp;&nbsp;".$condate."&nbsp;&nbsp;<strong>ผู้อนุมัติ : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves_signature."&nbsp;&nbsp;<strong>วันที่อนุมัติ : </strong>&nbsp;&nbsp;".$condate2."<br><br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>2. สำหรับฝ่ายบริหาร (พิจารณาและกำหนดฝ่ายที่รับผิดชอบ แล้วส่งให้ MR. ดำเนินการ)</strong><br>";
            $body .= "<strong>ฝ่ายที่รับผิดชอบในการปฎิบัติการแก้ไขและป้องกันปัญหา ได้แก่ : </strong>";

            $body .="&nbsp;&nbsp;".$get_owner_email->cp_dept_main_name;

            $body .= "<br>";
            $body .= "<strong>ลงชื่อฝ่ายบริหาร : </strong>&nbsp;&nbsp;".$get_owner_email->cp_sum_inves_signature."&nbsp;&nbsp;<strong>วันที่ : </strong>&nbsp;&nbsp;".$condate2."<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>3. สำหรับฝ่ายที่รับผิดชอบให้หาสาเหตุ. วิธีแก้ไขและป้องกันและกำหนดแผนการปฎิบัติการแก้ไข</strong><br>";
            $body .= "<strong style='font-size:16px;font-weight:600;'>Corrective</strong><br>";
            $body .= "<strong>3.1 สาเหตุ : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec31."<br>";
            $body .= "<strong>3.2 วิธีแก้ไข : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec32."<br>";

                                    $date1 = date_create($get_owner_email->nc_sec32date);
                                    $result_date = date_format($date1, "d/m/Y H:i:s");

                                    $date_2 = date_create($get_owner_email->nc_sec33date);
                                    $result_date2 = date_format($date_2, "d/m/Y H:i:s");

                                    $sec3date = date_create($get_owner_email->nc_sec3date);
                                    $result_sec3date = date_format($sec3date, "d/m/Y");

            $body .= "<strong>กำหนดเสร็จ :</strong>&nbsp;&nbsp;".$result_date."<br>";
            $body .= "<strong style='font-size:16px;font-weight:600;'>Preventive</strong><br>";
            $body .= "<strong>3.3 วิธีการป้องกัน (Action plan)</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec33."<br>";
            $body .= "<strong>กำหนดเสร็จ :</strong>&nbsp;&nbsp;".$result_date2."<br>";
            $body .= "<strong>ผู้รับผิดชอบ :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3owner."&nbsp;&nbsp;<strong>รหัสพนักงาน :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3empid."&nbsp;&nbsp;<strong>แผนก :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec3dept."&nbsp;&nbsp;<strong>วันที่ : </strong>&nbsp;&nbsp;".$result_sec3date."<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>4. สำหรับฝ่ายที่เกี่ยวข้อง (เพื่อติดตามและปิดสรุป)</strong><br>";
            $body .= "<strong>ผลการติดตามครั้งที่ 1 : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f1."<br>";
            $body .= "<strong>เอกสารประกอบ : </strong>&nbsp;&nbsp;<a href='http://192.190.10.27/complaint/asset/nc/sec4/f1/$get_owner_email->nc_sec4f1_file'>".$get_owner_email->nc_sec4f1_file . "</a>"."<br>";

            if($get_owner_email->nc_sec4f1_status == "no"){
                $f1status = "ไม่ปิดสรุป";
            }else{
                $f1status = "ปิดสรุป";
            }
            $body .= "<strong>สถานะ :</strong>&nbsp;&nbsp;".$f1status."<br>";
            $body .= "<strong>กำหนดติดตามครั้งที่ 2 :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f1_date."<br><br>";


            $body .= "<strong>ผลการติดตามครั้งที่ 2 : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f2."<br>";
            $body .= "<strong>เอกสารประกอบ : </strong>&nbsp;&nbsp;<a href='http://192.190.10.27/complaint/asset/nc/sec4/f2/$get_owner_email->nc_sec4f2_file'>".$get_owner_email->nc_sec4f2_file . "</a>"."<br>";

            if($get_owner_email->nc_sec4f2_status == "no"){
                $f2status = "ไม่ปิดสรุป";
            }else{
                $f2status = "ปิดสรุป";
            }
            $body .= "<strong>สถานะ :</strong>&nbsp;&nbsp;".$f2status."<br>";
            $body .= "<strong>กำหนดติดตามครั้งที่ 3 :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f2_date."<br><br>";


            $body .= "<strong>ผลการติดตามครั้งที่ 3 : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec4f3."<br>";
            $body .= "<strong>เอกสารประกอบ : </strong>&nbsp;&nbsp;<a href='http://192.190.10.27/complaint/asset/nc/sec4/f3/$get_owner_email->nc_sec4f3_file'>".$get_owner_email->nc_sec4f3_file . "</a>"."<br>";

            if($get_owner_email->nc_sec4f3_status == "no"){
                $f3status = "ไม่ปิดสรุป";
            }else{
                $f3status = "ปิดสรุป";
            }
            $body .= "<strong>สถานะ :</strong>&nbsp;&nbsp;".$f3status."<br><br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>5. Conclusion Of NC</strong><br>";
            $body .= "<strong>Conclusion Of NC : </strong>&nbsp;&nbsp;".$get_owner_email->nc_sec5."<br>";
            $body .= "<strong>เอกสารประกอบ : </strong>&nbsp;&nbsp;<a href='http://192.190.10.27/complaint/asset/nc/sec5/$get_owner_email->nc_sec5_file'>".$get_owner_email->nc_sec5_file . "</a>"."<br>";
            $body .= "<strong>รายละเอียดค่าใช้จ่ายที่เกิดขึ้น :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec5cost_detail."<br>";
            $body .= "<strong>ค่าใช้จ่ายที่เกิดขึ้น โดยประมาณ :</strong>&nbsp;&nbsp;".$get_owner_email->nc_sec5cost."<br>";



            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint/nc/main/".$cp_no."/".$nc_related_dept.">" . "Go to Page</a>";


    $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
        $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
        $mail->Host = "mail.saleecolour.com";  // specify main and backup server
//        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // พอร์ท
//        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "websystem@saleecolour.com";  // SMTP username
        //websystem@saleecolour.com
//        $mail->Username = "chainarong039@gmail.com";
        $mail->Password = "Ae8686#"; // SMTP password
        //Ae8686#
//        $mail->Password = "ShctBkk1";

        $mail->From = "websystem@saleecolour.com";
        $mail->FromName = "Salee Colour WEB System";
        foreach ($getEmail->result_array() as $fetch) {
            $mail->AddAddress($fetch['email']);
        }

        $mail->AddCC($get_owner_email->cp_user_email);
        foreach ($sqlget_query->result_array() as $sqlget_querys){
              $mail->AddCC($sqlget_querys['cp_email_user']);
        }
// $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
// $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
// $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        if(!$mail->send()){
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
            header("refresh:0; url=http://192.190.10.27/complaint/nc/main/$cp_no/$nc_related_dept");
        }


 //************************Email***Zone***********************************//



    }


        public function save_sec5failed($cp_no){
            $dept_code = $this->input->post("getdeptcode");
                    //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

		$file_name = $_FILES['nc_sec5file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);

		$file_size =$_FILES['nc_sec5file']['size'];
		$file_tmp =$_FILES['nc_sec5file']['tmp_name'];
		$file_type=$_FILES['nc_sec5file']['type'];
		move_uploaded_file($file_tmp,"asset/nc/sec5/failed/".$file_name_date);

                print_r($file_name);

	echo "<br>"."Copy/Upload Complete"."<br>";

        $data = array(
            "nc_sec5failed" => $this->input->post("nc_sec5"),
            "nc_sec5filefailed" => $file_name_date,
            "nc_sec5costfailed" => $this->input->post("nc_sec5cost"),
            "nc_status_code" => "nc10"
        );

        $this->db->where("cp_no",$cp_no);

        if(!$this->db->update("complaint_main",$data)){
            echo '<script language="javascript">';
            echo 'alert("Update data Failed !!")';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Update data Success")';
            echo '</script>';

            header("refresh:0; url=http://192.190.10.27/complaint/nc/main/$cp_no");
        }
    }


    public function create_cpfailed($cp_no){
        $dept_code = $this->input->post("getdeptcode");
        header("refresh:0; url=http://192.190.10.27/complaint/complaint/add_failed/$cp_no/$dept_code");
    }













}


?>
