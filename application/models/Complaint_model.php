<?php

class Complaint_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model("login_model");
        require("PHPMailer_5.2.0/class.phpmailer.php");
    }

    public function smtpmail($email, $subject, $body) { //Email Function
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
        $mail->AddAddress($email);
//        $mail->AddCC("chainarong039@gmail.com");
// $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
// $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
// $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        $result = $mail->send();
        return $result;
    }

    public function active_email() {
        $get_input_dept = $this->input->post("dept"); /*         * **Code Insert radio array***** */
        foreach ($get_input_dept as $gd) {/*         * ****Check array input radio********* */
            $save_dept = array(
                "cp_mail_active" => 1
            );
            $this->db->where("deptcode", $gd);
            $this->db->update("maillist", $save_dept);
        }/*         * **Code Insert radio array***** */
    }

    public function deactive_email() {
        $this->db->query("UPDATE maillist SET cp_mail_active =0 ");
    }

    public function list_cp() {
        $result = $this->db->query("SELECT * FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code");
        return $result->result_array();
    }

    public function view_cp($cp_no) {
        $result = $this->db->query("SELECT * FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code WHERE cp_no='$cp_no' ");
        return $result->row_array();
    }

    /*     * *************GET ZONE****************** */

    public function get_priority($sql) {/*     * **Get Priority to view page******* */
        $result = $this->db->query($sql);
        return $result->row_array();
    }

    public function get_file($cp_no) {
        $result = $this->db->query("SELECT * FROM complaint_file_upload WHERE file_cp_no ='$cp_no' ");
        return $result->result_array();
    }

    public function get_dept($cp_no) {
        $result = $this->db->query("SELECT complaint_department.cp_dept_id, complaint_department.cp_dept_code, complaint_department.cp_dept_cp_no, member.Dept FROM complaint_department INNER JOIN member ON member.DeptCode = complaint_department.cp_dept_code WHERE complaint_department.cp_dept_cp_no = '$cp_no' GROUP BY complaint_department.cp_dept_code DESC");
        return $result->result_array();
    }

    public function getdept_checkbox($cp_no) {
        $result = $this->db->query("SELECT complaint_department_main.cp_dept_main_name, complaint_department.cp_dept_code, complaint_department.cp_dept_cp_no FROM complaint_department_main INNER JOIN complaint_department ON complaint_department.cp_dept_code = complaint_department_main.cp_dept_main_code WHERE cp_dept_cp_no = '$cp_no' ");

        return $result;
    }

    public function get_toppic() {
        $result = $this->db->query("SELECT topic_name , topic_cat_name  FROM complaint_topic LEFT JOIN complaint_topic_catagory ON complaint_topic.topic_cat_id = complaint_topic_catagory.topic_cat_id");
        return $result->result_array();
    }

    public function get_priority_main($sql) {
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    public function get_dept_respons($dept_code) {
        $result = $this->db->query("SELECT * FROM complaint_department_main WHERE cp_dept_main_code NOT IN ('$dept_code')");
        return $result->result_array();
    }

    public function get_pri_topic() {
        $result = $this->db->query("SELECT * FROM complaint_priority GROUP BY cp_pri_group ASC");
        return $result->result_array();
    }

    public function getCPno() { //สร้าง Auto complaint number
        $query = $this->db->query("select cp_no from complaint_main"); //ไปนับแถวของ cp_no ก่อน
        $numrow = $query->num_rows(); //ไปนับแถวของ cp_no ก่อน
        $year_cur = date("Y"); //กำหนด ปีปัจจุบันใส่ตัวแปร year_cur
        $cut_year_cur = substr($year_cur, 2, 2); // ตัดจากเดิม 2018 เหลือ 18

        if ($numrow == 0) { //นับแถวของข้อมูล ถ้าเท่ากับ 0
            $cp_no = "CP" . $cut_year_cur . "001"; // กำหนดค่าลงไปเลย
        } else { // ถ้าไม่เป็นตามเงื่อนไขบน
            $query2 = $this->db->query("select cp_no from complaint_main order by SUBSTR(cp_no,5) desc LIMIT 1"); //ไป query เอา cp_no มาโดยตัดเอาแค่ 3 ตัวหลังตัวล่าสุดมา 1 ตัว

            foreach ($query2->result_array() as $rs) { //ไปวิ่งเช็คข้อมูล
                $cal = $rs['cp_no']; //ตรงนี้เราจะได้ค่า CP18100
            }
            $cut_yold = substr($cal, 2, 2); //ตัดปี 2 ตัวท้าย
            $cut_cp = substr($cal, 2); // 18100
            $cut_cp ++;
            $set_y = str_replace($cut_cp, "CP" . $cut_cp, $cut_cp); //ทำการ Get Year ของปัจจุบันลงไป

            $cp_no = $set_y;
        }
        return $cp_no; // ส่งค่ากลับไป
    }

    public function get_pri_view($cp_no) {
        $result = $this->db->query("SELECT complaint_priority.cp_pri_group, complaint_priority.cp_pri_topic, complaint_priority_use.cp_pri_use_id, complaint_priority_use.cp_pri_use_cpno, complaint_priority.cp_pri_name FROM complaint_priority INNER JOIN complaint_priority_use ON complaint_priority_use.cp_pri_use_id = complaint_priority.cp_pri_id WHERE complaint_priority_use.cp_pri_use_cpno='$cp_no' ");
        return $result->result_array();
    }

    public function get_newcp() {
        $get_newcp = $this->db->query("SELECT cp_status_code FROM complaint_main WHERE cp_status_code='cp01' ");
        return $get_newcp->num_rows();
    }

    public function get_newnc() {
        $get_newnc = $this->db->query("SELECT nc_status_code FROM complaint_main WHERE nc_status_code='nc01' ");
        return $get_newnc->num_rows();
    }

    public function get_owner_email($cp_no) {
        $result = $this->db->query("SELECT * FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code WHERE cp_no='$cp_no' ");
        return $result->row();
    }

    /*     * *************GET ZONE****************** */






    /*     * ************INSERT ZONE***************** */

    public function save_newcomplaint() {/*     * *start save_newcomplaint** */
        
      //*******************Check**การกรอกข้อมูล***********************//
            if($this->input->post("cp_topic_cat")==""){
                echo '<script language="javascript">';
                echo 'alert("Please choose topic!")';
                echo '</script>';
                
                echo '<script lanaguage="javascript">';
                echo 'history.back()';
                echo '</script>';
                exit();
            }
            if($this->input->post("cp_detail")==""){
                echo '<script language="javascript">';
                echo 'alert("Please fill data.!")';
                echo '</script>';
                
                echo '<script lanaguage="javascript">';
                echo 'history.back()';
                echo '</script>';
                exit();
            }
            if($this->input->post("dept")==""){
                echo '<script language="javascript">';
                echo 'alert("Please choose department.!")';
                echo '</script>';
                
                echo '<script lanaguage="javascript">';
                echo 'history.back()';
                echo '</script>';
                exit();
            }
        
        
        

        $get_cp_no = $this->getCPno(); /** ******Get new cp_no********* */

        $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
        $file_name = $_FILES['file_add']['name'];
        $file_name_cut = str_replace(" ", "", $file_name);
        $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
        $file_size = $_FILES['file_add']['size'];
        $file_tmp = $_FILES['file_add']['tmp_name'];
        $file_type = $_FILES['file_add']['type'];
        move_uploaded_file($file_tmp, "asset/add/" . $file_name_date);

        print_r($file_name);
        echo "<br>" . "Copy/Upload Complete" . "<br>";



        $get_input_priority = $this->input->post("cp_pri_name_get"); /*         * *****Code Insert select array******* */
        foreach ($get_input_priority as $gp) {/*         * *****Check array input select******** */
            $save_pri = array(
                "cp_pri_use_id" => $gp,
                "cp_pri_use_cpno" => $get_cp_no
            );
            $this->db->insert("complaint_priority_use", $save_pri);
        }/*         * *****Code Insert select array******* */




        $get_input_dept = $this->input->post("dept"); /*         * **Code Insert radio array***** */
        foreach ($get_input_dept as $gd) {/*         * ****Check array input radio********* */
            $save_dept = array(
                "cp_dept_cp_no" => $get_cp_no,
                "cp_dept_code" => $gd
            );
            $this->db->insert("complaint_department", $save_dept);
        }/*         * **Code Insert radio array***** */


        $qty_convert = $this->input->post("cp_pro_qty");
        $qty_cut_comma = str_replace(",", "", $qty_convert);


        $data = array(/*             * *****Insert data to complaint_main table******* */
            "cp_no" => $get_cp_no,
            "cp_date" => $this->input->post("cp_date"),
            "cp_topic" => $this->input->post("cp_topic_hide"),
            "cp_topic_cat" => $this->input->post("cp_topic_cat"),
//                "cp_priority" => $this->input->post(""),
            "cp_user_name" => $this->input->post("cp_user_name"),
            "cp_user_empid" => $this->input->post("cp_user_empid"),
            "cp_user_dept" => $this->input->post("cp_user_dept"),
            "cp_user_email" => $this->input->post("memberemail"),
            "cp_cus_name" => $this->input->post("cp_cus_name"),
            "cp_cus_ref" => $this->input->post("cp_cus_ref"),
            "cp_invoice_no" => $this->input->post("cp_invoice_no"),
            "cp_pro_code" => $this->input->post("cp_pro_code"),
            "cp_pro_lotno" => $this->input->post("cp_pro_lotno"),
            "cp_pro_qty" => $qty_cut_comma,
            "cp_detail" => $this->input->post("cp_detail"),
            "cp_file" => $file_name_date,
            "cp_status_code" => "cp01"
        );

        if ($this->db->insert("complaint_main", $data)) {
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed !!!!")';
            echo '</script>';
        }/*         * *****Insert data to complaint_main table******* */





//************************************ZONE***SEND****EMAIL*************************************// 
        $getdata_foremail = $this->db->query("SELECT * FROM complaint_main INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code WHERE cp_no='$get_cp_no' ");
        $getdata_email = $getdata_foremail->row();


        /*  -------------------------SEND--EMAIL------------------------------------------   */



        $sqlEmail = "SELECT email FROM maillist WHERE cp_mail_active = 1 "; //1=it , 2=sales , 3=cs
        $query = $this->db->query($sqlEmail);

        if ($getdata_email->cp_topic_cat == "Safety" || $getdata_email->cp_topic_cat == "System" || $getdata_email->cp_topic_cat == "Environment") {

            $subject = "New Complaint";
            $body = "<h3>New Complaint for Validation.</h3>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $getdata_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $getdata_email->cp_date . "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $getdata_email->cp_topic . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $getdata_email->cp_topic_cat . "<br>";
            $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $getdata_email->cp_status_name . "<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";
            foreach ($this->get_pri_view($get_cp_no) as $getpv) {
                $body .= "<strong>" . $getpv['cp_pri_topic'] . ": </strong>&nbsp;&nbsp;" . $getpv['cp_pri_name'] . "<br>";
            }
            $body .= "<br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
            $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_dept . "<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $getdata_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$getdata_email->cp_file>" . $getdata_email->cp_file . "</a>" . "<br>";
            $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/complaint/investigate/" . $get_cp_no . ">" . "Go to Page</a>";
        } else {

            $subject = "New Complaint";
            $body = "<h3>New Complaint for Validation.</h3>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $getdata_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $getdata_email->cp_date . "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $getdata_email->cp_topic . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $getdata_email->cp_topic_cat . "<br>";
            $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $getdata_email->cp_status_name . "<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";
            foreach ($this->get_pri_view($get_cp_no) as $getpv) {
                $body .= "<strong>" . $getpv['cp_pri_topic'] . ": </strong>&nbsp;&nbsp;" . $getpv['cp_pri_name'] . "<br>";
            }
            "<br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
            $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_dept . "<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
            $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $getdata_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $getdata_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $getdata_email->cp_invoice_no . "<br>";
            $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_qty . "<br>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $getdata_email->cp_detail . "<br>";

            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$getdata_email->cp_file>" . $getdata_email->cp_file . "</a>" . "<br>";

            $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/complaint/investigate/" . $get_cp_no . ">" . "Go to Page</a>";
        }


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
        foreach ($query->result_array() as $fetch) {
            $mail->AddAddress($fetch['email']);
        }

        $mail->AddCC($getdata_email->cp_user_email);
// $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
// $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
// $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
//        $mail->send();
//************************************ZONE***SEND****EMAIL*************************************//      
    }

/*     * *end save_newcomplaint** */

    public function saveData_failed() {
        $get_cp_no = $this->getCPno(); /*         * ******Get new cp_no********* */

        $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
        $file_name = $_FILES['file_add']['name'];
        $file_name_cut = str_replace(" ", "", $file_name);
        $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
        $file_size = $_FILES['file_add']['size'];
        $file_tmp = $_FILES['file_add']['tmp_name'];
        $file_type = $_FILES['file_add']['type'];
        move_uploaded_file($file_tmp, "asset/add/" . $file_name_date);

        print_r($file_name);
        echo "<br>" . "Copy/Upload Complete" . "<br>";



        $get_input_priority = $this->input->post("cp_pri_name_get"); /*         * *****Code Insert select array******* */
        foreach ($get_input_priority as $gp) {/*         * *****Check array input select******** */
            $save_pri = array(
                "cp_pri_use_id" => $gp,
                "cp_pri_use_cpno" => $get_cp_no
            );
            $this->db->insert("complaint_priority_use", $save_pri);
        }/*         * *****Code Insert select array******* */




        $get_input_dept = $this->input->post("dept_edit"); /*         * **Code Insert radio array***** */
        foreach ($get_input_dept as $gd) {/*         * ****Check array input radio********* */
            $save_dept = array(
                "cp_dept_cp_no" => $get_cp_no,
                "cp_dept_code" => $gd
            );
            $this->db->insert("complaint_department", $save_dept);
        }/*         * **Code Insert radio array***** */





        $data = array(/*             * *****Insert data to complaint_main table******* */
            "cp_no" => $get_cp_no,
            "cp_date" => $this->input->post("cp_date"),
            "cp_topic" => $this->input->post("cp_topic_f"),
            "cp_topic_cat" => $this->input->post("cp_topic_cat"),
//                "cp_priority" => $this->input->post(""),
            "cp_user_name" => $this->input->post("cp_user_name"),
            "cp_user_empid" => $this->input->post("cp_user_empid"),
            "cp_user_dept" => $this->input->post("cp_user_dept"),
            "cp_cus_name" => $this->input->post("cp_cus_name"),
            "cp_cus_ref" => $this->input->post("cp_cus_ref"),
            "cp_invoice_no" => $this->input->post("cp_invoice_no"),
            "cp_pro_code" => $this->input->post("cp_pro_code"),
            "cp_pro_lotno" => $this->input->post("cp_pro_lotno"),
            "cp_pro_qty" => $this->input->post("cp_pro_qty"),
            "cp_detail" => $this->input->post("cp_detail"),
            "cp_file" => $file_name_date,
            "cp_status_code" => "cp01",
            "cp_no_old" => $this->input->post("cp_noold")
        );



        if ($this->db->insert("complaint_main", $data)) {
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed !!!!")';
            echo '</script>';
        }/*         * *****Insert data to complaint_main table******* */
    }

    /*     * ************INSERT ZONE***************** */






    /*     * ************UPDATE ZONE***************** */

    public function change_status_to1($cp_no) {/*     * *****Change New Complaint to Complaint Analyzed********* */
        $this->db->query("UPDATE complaint_main SET cp_status_code='cp02' WHERE cp_no='$cp_no' ");

        $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' ");

        $get_owner_email = $this->get_owner_email($cp_no);


        $subject = "Investigate Start !";
        $body = "<h3>The Complaint is starting an investigation.</h3>";
        $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_date . "<br>";
        $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic_cat . "<br>";
        $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br>";
        $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";


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

//        if (!$mail->send()) {
//            echo '<script language="javascript">';
//            echo 'alert("Start Investigate Failed !!")';
//            echo '</script>';
//            exit();
//        } else {
//            echo '<script language="javascript">';
//            echo 'alert("Start Investigate Success")';
//            echo '</script>';
//        }
    }

    public function add_detail_inves($cp_no) {/*     * *******Add Detail investigate+Upload file to db********************* */
        
        //*******************Check**การกรอกข้อมูล***********************//
            if($this->input->post("cp_detail_inves")==""){
                echo '<script language="javascript">';
                echo 'alert("Please fill data!")';
                echo '</script>';
                
                echo '<script lanaguage="javascript">';
                echo 'history.back()';
                echo '</script>';
                exit();
            }
        
        
        
        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน

        $file_name = $_FILES['cp_detail_inves_file']['name'];
        $file_name_cut = str_replace(" ", "", $file_name);
        $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);

        $file_size = $_FILES['cp_detail_inves_file']['size'];
        $file_tmp = $_FILES['cp_detail_inves_file']['tmp_name'];
        $file_type = $_FILES['cp_detail_inves_file']['type'];
        move_uploaded_file($file_tmp, "asset/investigate/detail_inves/" . $file_name_date);

        print_r($file_name);


        echo "<br>" . "Copy/Upload Complete" . "<br>";

        $data = array(
            "cp_detail_inves" => $this->input->post("cp_detail_inves"),
            "cp_detail_inves_signature" => $this->input->post("cp_detail_inves_signature"),
            "cp_detail_inves_dept" => $this->input->post("cp_detail_inves_dept"),
            "cp_detail_inves_date" => $this->input->post("cp_detail_inves_date"),
            "cp_status_code" => "cp03",
            "cp_detail_inves_file" => $file_name_date
        );

        $this->db->where("cp_no", $cp_no);
        $this->db->update("complaint_main", $data);


        //***************************Email***Zone************************************************//           
        $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' ");

        $get_owner_email = $this->get_owner_email($cp_no);

        if ($get_owner_email->cp_topic_cat == "Safety" || $get_owner_email->cp_topic_cat == "System" || $get_owner_email->cp_topic_cat == "Environment") {

            $subject = "Investigation Complete";
            $body = "<h3>The Complaint Investigation Complete.</h3>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_date . "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic_cat . "<br>";
            $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";
            foreach ($this->get_pri_view($cp_no) as $getpv) {
                $body .= "<strong>" . $getpv['cp_pri_topic'] . ": </strong>&nbsp;&nbsp;" . $getpv['cp_pri_name'] . "<br>";
            }
            $body .= "<br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
            $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
            $body .= "<br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
            $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
            $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_date . "<br>";


            $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";
        } else {

            $subject = "Investigation Complete";
            $body = "<h3>The Complaint Investigation Complete.</h3>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_date . "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic_cat . "<br>";
            $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";
            foreach ($this->get_pri_view($cp_no) as $getpv) {
                $body .= "<strong>" . $getpv['cp_pri_topic'] . ": </strong>&nbsp;&nbsp;" . $getpv['cp_pri_name'] . "<br>";
            }
            $body .= "<br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
            $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";


            $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
            $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_invoice_no . "<br>";
            $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_qty . "<br>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
            $body .= "<br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
            $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
            $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_date . "<br>";


            $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";
        }



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
        
//        if (!$mail->send()) {
//            echo '<script language="javascript">';
//            echo 'alert("Start Investigate Failed !!")';
//            echo '</script>';
//            exit();
//        } else {
//            echo '<script language="javascript">';
//            echo 'alert("Start Investigate Success")';
//            echo '</script>';
//        }
    }

    public function add_sum_inves($cp_no) {/*     * ***********SUMMARY OF INVESTIGATION**************** */
        
        //*******************Check**การกรอกข้อมูล***********************//
            if($this->input->post("cp_sum_inves")==""){
                echo '<script language="javascript">';
                echo 'alert("Please fill data!")';
                echo '</script>';
                
                echo '<script lanaguage="javascript">';
                echo 'history.back()';
                echo '</script>';
                exit();
            }
            if($this->input->post("cp_sum")==""){
                echo '<script language="javascript">';
                echo 'alert("Please choose choice!")';
                echo '</script>';
                
                header("refresh:0; url=http://192.190.10.27/complaint/complaint/investigate/$cp_no");
//                redirect('/complaint/investigate/'.$cp_no);
                exit();
            }
            
            
            

        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน

        $file_name = $_FILES['cp_sum_inves_file']['name'];
        $file_name_cut = str_replace(" ", "", $file_name);
        $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);

        $file_size = $_FILES['cp_sum_inves_file']['size'];
        $file_tmp = $_FILES['cp_sum_inves_file']['tmp_name'];
        $file_type = $_FILES['cp_sum_inves_file']['type'];
        move_uploaded_file($file_tmp, "asset/investigate/sum_inves/" . $file_name_date);

        print_r($file_name);

        echo "<br>" . "Copy/Upload Complete" . "<br>";



        if ($this->input->post("cp_sum") == "yes") {
            $update_status = "cp05";
            $update_status_nc = "nc01";
        } else {
            $update_status = "cp04";
            $update_status_nc = "";
        }

        $data = array(
            "cp_sum_inves" => $this->input->post("cp_sum_inves"),
            "cp_sum_inves_signature" => $this->input->post("cp_sum_inves_signature"),
            "cp_sum_inves_dept" => $this->input->post("cp_sum_inves_dept"),
            "cp_sum_inves_date" => $this->input->post("cp_sum_inves_date"),
            "cp_sum_inves_file" => $file_name_date,
            "cp_status_code" => $update_status,
            "nc_status_code" => $update_status_nc,
            "cp_sum" => $this->input->post("cp_sum")
        );

        $this->db->where("cp_no", $cp_no);
        $this->db->update("complaint_main", $data);



        //************************Email***Zone***********************************//

        $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' ");

        $get_owner_email = $this->get_owner_email($cp_no);


        if ($get_owner_email->cp_sum == "no") {
            if ($get_owner_email->cp_topic_cat == "Safety" || $get_owner_email->cp_topic_cat == "System" || $get_owner_email->cp_topic_cat == "Environment") {

                $subject = "Normal Complaint";
                $body = "<h3>The Complaint is normal complaint.</h3>";
                $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_date . "<br>";
                $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic_cat . "<br>";
                $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";
                foreach ($this->get_pri_view($cp_no) as $getpv) {
                    $body .= "<strong>" . $getpv['cp_pri_topic'] . ": </strong>&nbsp;&nbsp;" . $getpv['cp_pri_name'] . "<br>";
                }
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
                $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
                $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
                $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
                $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_date . "<br>";
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Summary of Investigation</strong><br>";
                $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_sum_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>" . "<a href='http://192.190.10.27/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
                $body .= "<strong>ไม่เป็นข้อบกพร่องของบริษัท</strong><br>";
                $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_sum_inves_date . "<br>";


                $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";
            } else {

                $subject = "Normal Complaint";
                $body = "<h3>The Complaint is normal complaint.</h3>";
                $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_date . "<br>";
                $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic_cat . "<br>";
                $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";
                foreach ($this->get_pri_view($cp_no) as $getpv) {
                    $body .= "<strong>" . $getpv['cp_pri_topic'] . ": </strong>&nbsp;&nbsp;" . $getpv['cp_pri_name'] . "<br>";
                }
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
                $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
                $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_invoice_no . "<br>";
                $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_qty . "<br>";
                $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
                $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
                $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_date . "<br>";
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Summary of Investigation</strong><br>";
                $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_sum_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>" . "<a href='http://192.190.10.27/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
                $body .= "<strong>ไม่เป็นข้อบกพร่องของบริษัท</strong><br>";
                $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_sum_inves_date . "<br>";


                $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";
            }
        } else {

            if ($this->input->post('cp_topic_cat') == "Safety" || $this->input->post('cp_topic_cat') == "System" || $this->input->post('cp_topic_cat') == "Environment") {

                $subject = "Transfered to NC";
                $body = "<h3>The Complaint is normal complaint.</h3>";
                $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_date . "<br>";
                $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic_cat . "<br>";
                $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";
                foreach ($this->get_pri_view($cp_no) as $getpv) {
                    $body .= "<strong>" . $getpv['cp_pri_topic'] . ": </strong>&nbsp;&nbsp;" . $getpv['cp_pri_name'] . "<br>";
                }
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
                $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
                $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
                $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
                $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_date . "<br>";
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Summary of Investigation</strong><br>";
                $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_sum_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>" . "<a href='http://192.190.10.27/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
                $body .= "<strong>เป็นข้อบกพร่องของบริษัท</strong><br>";
                $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_sum_inves_date . "<br>";


                $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";
            } else {

                $subject = "Transfered to NC";
                $body = "<h3>The Complaint is Transfered to NC.</h3>";
                $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_date . "<br>";
                $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_topic_cat . "<br>";
                $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";
                foreach ($this->get_pri_view($cp_no) as $getpv) {
                    $body .= "<strong>" . $getpv['cp_pri_topic'] . ": </strong>&nbsp;&nbsp;" . $getpv['cp_pri_name'] . "<br>";
                }
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
                $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
                $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_invoice_no . "<br>";
                $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_qty . "<br>";
                $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
                $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
                $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_date . "<br>";
                $body .= "<br>";


                $body .= "<strong style='font-size:18px;font-weight:600;'>Summary of Investigation</strong><br>";
                $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_sum_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>" . "<a href='http://192.190.10.27/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
                $body .= "<strong>เป็นข้อบกพร่องของบริษัท</strong><br>";
                $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_sum_inves_date . "<br>";


                $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://192.190.10.27/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";
            }
        }



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

//        if (!$mail->send()) {
//            echo '<script language="javascript">';
//            echo 'alert("Start Investigate Failed !!")';
//            echo '</script>';
//            exit();
//        } else {
//            echo '<script language="javascript">';
//            echo 'alert("Start Investigate Success")';
//            echo '</script>';
//        }


        //************************Email***Zone***********************************//  
    }

    public function add_conclusion($cp_no) {
        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน

        $file_name = $_FILES['cp_conclu_file']['name'];
        $file_name_cut = str_replace(" ", "", $file_name);
        $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);

        $file_size = $_FILES['cp_conclu_file']['size'];
        $file_tmp = $_FILES['cp_conclu_file']['tmp_name'];
        $file_type = $_FILES['cp_conclu_file']['type'];
        move_uploaded_file($file_tmp, "asset/investigate/conclusion_inves/" . $file_name_date);

        print_r($file_name);

        echo "<br>" . "Copy/Upload Complete" . "<br>";

        $conclu_cost = $this->input->post("cp_conclu_cost");
        $cut_comma = str_replace(",", "", $conclu_cost);


        $data = array(
            "cp_conclu_detail" => $this->input->post("cp_conclu_detail"),
            "cp_conclu_signature" => $this->input->post("cp_conclu_signature"),
            "cp_conclu_dept" => $this->input->post("cp_conclu_dept"),
            "cp_conclu_date" => $this->input->post("cp_conclu_date"),
            "cp_conclu_file" => $file_name_date,
            "cp_conclu_costdetail" => $this->input->post("cp_conclu_costdetail"),
            "cp_conclu_cost" => $cut_comma,
            "cp_status_code" => "cp06"
        );

        $this->db->where("cp_no", $cp_no);
        $this->db->update("complaint_main", $data);



//************************Email***Zone***********************************//     
        $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' ");

        $get_owner_email = $this->get_owner_email($cp_no);


        $subject = "Conclusion of Complaint";
        $body = "<h2>The Complaint is Conclusion of Complaint.</h2>";
        $body .= "<strong>Complaint No. : </strong>" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_date . "<br>";
        $body .= "<strong>Topic : </strong>" . $get_owner_email->cp_topic . "&nbsp;&nbsp;<strong>Category : </strong>" . $get_owner_email->cp_topic_cat . "<br>";
        $body .= "<strong>Status : </strong>" . $get_owner_email->cp_status_name . "<br>";

        $body .= "<strong><h2>Priority</h2></strong>";
        foreach ($this->get_pri_view($cp_no) as $getpv) {
            $body .= "<strong>" . $getpv['cp_pri_topic'] . ": </strong>" . $getpv['cp_pri_name'] . "<br>";
        }

        $body .= "<h2>User Information</h2>";
        $body .= "<strong>Complaint Person :</strong>" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>" . $get_owner_email->cp_user_dept;

        $body .= "<h2>Details of Complaint / Damages</h2>";
        $body .= "<strong>Complaint Detail : </strong>" . $get_owner_email->cp_detail . "<br>";

        $body .= "<strong>Link Attached File : </strong>" . "<a href=http://192.190.10.27/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";

        $body .= "<h2>Investigation</h2>";
        $body .= "<strong>Detail of Investigate : </strong>" . $get_owner_email->cp_detail_inves . "<br>";
        $body .= "<strong>Link Attached File : </strong>" . "<a href='http://192.190.10.27/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
        $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_detail_inves_date . "<br>";

        $body .= "<h2>Summary of Investigation</h2>";
        $body .= "<strong>Detail Summary of Investigation : </strong>" . $get_owner_email->cp_sum_inves . "<br>";
        $body .= "<strong>Link Attached File : </strong>" . "<a href='http://192.190.10.27/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
        $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_sum_inves_date . "<br>";

        $body .= "<h2>Conclusion of Complaint</h2>";
        $body .= "<strong>Detail Conclusion of Complaint : </strong>" . $get_owner_email->cp_conclu_detail . "<br>";
        $body .= "<strong>Detail of Cost : </strong>" . $get_owner_email->cp_conclu_costdetail . "&nbsp;&nbsp;<strong>Cost : </strong>" . $get_owner_email->cp_conclu_cost . "<br>";
        $body .= "<strong>Link Attached File : </strong>" . "<a href='http://192.190.10.27/complaint/asset/investigate/conclusion_inves/$get_owner_email->cp_conclu_file'>" . $get_owner_email->cp_conclu_file . "</a><br>";
        $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_conclu_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_conclu_dept . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_conclu_date . "<br>";

        $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";


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

//        if (!$mail->send()) {
//            echo '<script language="javascript">';
//            echo 'alert("Save Data Failed")';
//            echo '</script>';
//        } else {
//            echo '<script language="javascript">';
//            echo 'alert("Save Data Success")';
//            echo '</script>';
//        }


        //************************Email***Zone***********************************//       
    }

    public function savedata_edit($cp_no) {

        if ($this->input->post("file_add_edit") != "") {
            $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
            $file_name = $_FILES['file_add']['name'];
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
            $file_size = $_FILES['file_add']['size'];
            $file_tmp = $_FILES['file_add']['tmp_name'];
            $file_type = $_FILES['file_add']['type'];
            move_uploaded_file($file_tmp, "asset/add/" . $file_name_date);

            print_r($file_name);
            echo "<br>" . "Copy/Upload Complete" . "<br>";
        } else {
            $file_name_date = $this->input->post("showfile");
        }


        $this->db->where("cp_pri_use_cpno", $cp_no);
        $this->db->delete("complaint_priority_use");

        $get_input_priority = $this->input->post("cp_pri_name_get_edit"); /*         * *****Code Insert select array******* */
        foreach ($get_input_priority as $gp) {/*         * *****Check array input select******** */
            $save_pri = array(
                "cp_pri_use_id" => $gp,
                "cp_pri_use_cpno" => $cp_no
            );
            $this->db->insert("complaint_priority_use", $save_pri);
        }/*         * *****Code Insert select array******* */



        $this->db->where("cp_dept_cp_no", $cp_no);
        $this->db->delete("complaint_department");

        $get_input_dept = $this->input->post("dept_edit"); /*         * **Code Insert radio array***** */
        foreach ($get_input_dept as $gd) {/*         * ****Check array input radio********* */
            $save_dept = array(
                "cp_dept_cp_no" => $cp_no,
                "cp_dept_code" => $gd
            );
            $this->db->insert("complaint_department", $save_dept);
        }/*         * **Code Insert radio array***** */





        $data = array(/*             * *****Update data to complaint_main table******* */
//                "cp_no" => $get_cp_no,
//                "cp_date" => $this->input->post("cp_date"),
            "cp_topic" => $this->input->post("cp_topic_hide_edit"),
            "cp_topic_cat" => $this->input->post("cp_topic_cat_edit"),
//                "cp_priority" => $this->input->post(""),
//                "cp_user_name" => $this->input->post("cp_user_name"),
//                "cp_user_empid" => $this->input->post("cp_user_empid"),
//                "cp_user_dept" => $this->input->post("cp_user_dept"),
            "cp_cus_name" => $this->input->post("cp_cus_name_edit"),
            "cp_cus_ref" => $this->input->post("cp_cus_ref_edit"),
            "cp_invoice_no" => $this->input->post("cp_invoice_no_edit"),
            "cp_pro_code" => $this->input->post("cp_pro_code_edit"),
            "cp_pro_lotno" => $this->input->post("cp_pro_lotno_edit"),
            "cp_pro_qty" => $this->input->post("cp_pro_qty_edit"),
            "cp_detail" => $this->input->post("cp_detail_edit"),
            "cp_file" => $file_name_date,
            "cp_status_code" => "cp01",
            "cp_modify_by" => $this->input->post("getuser_check"),
            "cp_modify_datetime" => date("Y/m/d H:i:s"),
            "cp_modify_reason" => $this->input->post("cp_modify_reason")
        );

        $this->db->where("cp_no", $cp_no);
        if ($this->db->update("complaint_main", $data)) {
            echo '<script language="javascript">';
            echo 'alert("Save Edit Data Success")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Save Edit Data Failed !!!!")';
            echo '</script>';
        }/*         * *****Insert data to complaint_main table******* */
    }

    public function save_edit_inves($cp_no) {

        if ($this->input->post("cp_detail_inves_file_edit") == "") {
            $file_name_date = $this->input->post("inves_showfile");
        } else {

            //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
            $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน

            $file_name = $_FILES['cp_detail_inves_file_edit']['name'];
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);

            $file_size = $_FILES['cp_detail_inves_file_edit']['size'];
            $file_tmp = $_FILES['cp_detail_inves_file_edit']['tmp_name'];
            $file_type = $_FILES['cp_detail_inves_file_edit']['type'];
            move_uploaded_file($file_tmp, "asset/investigate/detail_inves/" . $file_name_date);

            print_r($file_name);


            echo "<br>" . "Copy/Upload Complete" . "<br>";
        }

        $data = array(
            "cp_detail_inves" => $this->input->post("cp_detail_inves_edit"),
            "cp_detail_inves_file" => $file_name_date,
            "cp_modify_by" => $this->input->post("cp_detail_inves_signature"),
            "cp_modify_datetime" => $this->input->post("cp_detail_inves_datemodify"),
            "cp_modify_reason" => $this->input->post("his_memo")
        );

        $this->db->where("cp_no", $cp_no);
        $this->db->update("complaint_main", $data);
    }

//        public function update_ncstatus($cp_no){
//            $data = array(
//                "nc_status_code" => "Followup_3rd (Failed!)"
//            );
//            
//            $this->db->where("cp_no",$cp_no);
//            $this->db->update("complaint_main",$data);
//            
//        }


    /*     * ************UPDATE ZONE***************** */






    /*     * ***********SET ZONE********************** */
    public function set_activeEmail() {
        $lab = $this->input->post("lab");
        $admin = $this->input->post("admin");
        $hr = $this->input->post("hr");
        $account = $this->input->post("account");
        $qc = $this->input->post("qc");
        $maintenance = $this->input->post("maintenance");
        $pd = $this->input->post("pd");
        $sales = $this->input->post("sales");
        $warehouse = $this->input->post("warehouse");
        $planning = $this->input->post("planning");
        $it = $this->input->post("it");
        $pu = $this->input->post("pu");
        $qmr = "1099";

        //เช็คว่ามีการติ๊กเลือกแผนกเพื่อส่ง Email หรือไม่ ถ้าไม่มีจะขึ้นการแจ้งเตือน
        if ($lab == "" and $admin == "" and $hr == "" and $account == "" and $qc == "" and $maintenance == "" and $pd == "" and $sales == "" and $warehouse == "" and $planning == "" and $it == "" && $pu == "") {
            echo "please choose department for sent email";
            exit();
        } else {//ถ้ามีการติ๊กเลือก ให้ดำเนินการปรับ สถานะ
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$lab' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$admin' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$hr' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$account' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$qc' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$maintenance' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$pd' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$sales' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$warehouse' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$planning' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$it' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$pu' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$qmr' ");
        }
    }

    /*     * ***********SET ZONE********************** */




    /*     * ***************CHECK ZONE******************** */

    public function check_status_page($cp_no) {/*     * *****Check status page******* */
        $result = $this->db->query("SELECT cp_status_code FROM complaint_main WHERE cp_no='$cp_no' ");
        $get_status = $result->row();
        if ($get_status->cp_status_code !== "cp01") {
            redirect('/complaint/investigate/' . $cp_no);
        }
    }

    public function check_status_page2($cp_no) {/*     * *****Check status page******* */
        $result = $this->db->query("SELECT cp_status_code FROM complaint_main WHERE cp_no='$cp_no' ");
        $get_status = $result->row();
        if ($get_status->cp_status_code == "cp01") {
            redirect('/complaint/view/' . $cp_no);
        }
    }

    public function getcpno_test() { //สร้าง Auto complaint number
        $query = $this->db->query("select cptest_cp_no from complaint_test"); //ไปนับแถวของ cp_no ก่อน
        $numrow = $query->num_rows(); //ไปนับแถวของ cp_no ก่อน
        $year_cur = date("Y"); //กำหนด ปีปัจจุบันใส่ตัวแปร year_cur
        $cut_year_cur = substr($year_cur, 2, 2); // ตัดจากเดิม 2018 เหลือ 18

        if ($numrow == 0) { //นับแถวของข้อมูล ถ้าเท่ากับ 0
            $cp_no = "CP" . $cut_year_cur . "001"; // กำหนดค่าลงไปเลย
        } else { // ถ้าไม่เป็นตามเงื่อนไขบน
            $query2 = $this->db->query("select cptest_cp_no from complaint_test order by SUBSTR(cptest_cp_no,5) desc LIMIT 1"); //ไป query เอา cp_no มาโดยตัดเอาแค่ 3 ตัวหลังตัวล่าสุดมา 1 ตัว

            foreach ($query2->result_array() as $rs) { //ไปวิ่งเช็คข้อมูล
                $cal = $rs['cptest_cp_no']; //ตรงนี้เราจะได้ค่า CP18100
            }
            $cut_yold = substr($cal, 2, 2); //ตัดปี 2 ตัวท้าย
            $cut_cp = substr($cal, 2); // 18100
            $cut_cp ++;
            $set_y = str_replace($cut_cp, "CP" . $cut_cp, $cut_cp); //ทำการ Get Year ของปัจจุบันลงไป
        }
        return $set_y; // ส่งค่ากลับไป
    }

    /*     * ***************CHECK ZONE******************** */
}

?>