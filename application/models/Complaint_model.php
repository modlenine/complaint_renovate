<?php



class Complaint_model extends CI_Model

{



    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        // require("PHPMailer_5.2.0/class.phpmailer.php");
    }



    public function active_email()
    {
        $get_input_dept = $this->input->post("dept"); /*         * **Code Insert radio array***** */
        foreach ($get_input_dept as $gd) { /*         * ****Check array input radio********* */
            $save_dept = array(
                "cp_mail_active" => 1
            );
            $this->db->where("deptcode", $gd);
            $this->db->where("cp_mail_status","1");
            $this->db->update("maillist", $save_dept);

        } /*         * **Code Insert radio array***** */

    }

    public function deactive_email()
    {
        $this->db->query("UPDATE maillist SET cp_mail_active =0 ");
    }

    public function list_cp()
    {
        $result = $this->db->query("SELECT
        complaint_main.cp_no,
        complaint_main.cp_date,
        complaint_status.cp_status_name,
        complaint_topic.topic_name,
        complaint_topic_catagory.topic_cat_name,
        complaint_main.cp_user_name,
        complaint_main.cp_cus_name,
        complaint_main.cp_status_code,
        complaint_main.cp_no_old,
        complaint_status.cp_status_id,
        complaint_main.cp_priority
        FROM
        complaint_main
        INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
        INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
        INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
        ");
        return $result->result_array();
    }


    public function view_cp($cp_no)
    {
        $result = $this->db->query("SELECT
        complaint_main.cp_id,
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
        complaint_status.cp_status_name,
        complaint_topic_catagory.topic_cat_name,
        complaint_topic.topic_name,
        complaint_main.cp_no_old,
        complaint_topic.topic_id,
        complaint_topic_catagory.topic_cat_id,
        complaint_main.rao_formno
        FROM
        complaint_main
        INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
        INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
        INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
        WHERE cp_no='$cp_no' ");

        return $result->row_array();

    }


    /*     * *************GET ZONE****************** */

    public function get_priority($sql)
    { /*     * **Get Priority to view page******* */
        $result = $this->db->query($sql);
        return $result->row_array();
    }

    public function get_file($cp_no)
    {
        $result = $this->db->query("SELECT * FROM complaint_file_upload WHERE file_cp_no ='$cp_no' ");
        return $result->result_array();
    }

    public function get_dept($cp_no)//old code
    {
        $result = $this->db->query("SELECT complaint_department.cp_dept_id, complaint_department.cp_dept_code, complaint_department.cp_dept_cp_no, member.Dept FROM complaint_department INNER JOIN member ON member.DeptCode = complaint_department.cp_dept_code WHERE complaint_department.cp_dept_cp_no = '$cp_no' GROUP BY complaint_department.cp_dept_code DESC");

        return $result->result_array();
    }

    public function get_dept_view($cp_no)//New Get dept
    {
        $result = $this->db->query("SELECT
        complaint_department_main.cp_dept_main_name,
        complaint_department_main.cp_dept_main_code,
        complaint_department.cp_dept_cp_no
        FROM
        complaint_department
        INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = complaint_department.cp_dept_code
        WHERE cp_dept_cp_no ='$cp_no'  ");

        return $result->result_array();
    }


    public function getdept_checkbox($cp_no)
    {
        $result = $this->db->query("SELECT complaint_department_main.cp_dept_main_name, complaint_department.cp_dept_code, complaint_department.cp_dept_cp_no FROM complaint_department_main INNER JOIN complaint_department ON complaint_department.cp_dept_code = complaint_department_main.cp_dept_main_code WHERE cp_dept_cp_no = '$cp_no' ");

        return $result;
    }


    public function get_toppic($toppic_cat)
    {
        $result = $this->db->query("SELECT topic_name , topic_cat_name  FROM complaint_topic LEFT JOIN complaint_topic_catagory ON complaint_topic.topic_cat_id = complaint_topic_catagory.topic_cat_id WHERE topic_cat_name='$toppic_cat' ");
        return $result->result_array();
    }


    public function get_category(){
        $result = $this->db->query("SELECT * FROM complaint_topic_catagory");
        return $result->result_array();
    }


    public function get_priority_main($sql)
    {
        $result = $this->db->query($sql);
        return $result->result_array();
    }


    public function get_dept_respons($dept_code)
    {
        $result = $this->db->query("SELECT * FROM complaint_department_main WHERE cp_dept_main_code NOT IN ('$dept_code')");
        return $result->result_array();
    }

    public function get_pri_topic()
    {
        $result = $this->db->query("SELECT * FROM complaint_priorityn_category GROUP BY pricat_id ASC");
        return $result->result_array();
    }

    public function get_topic_search(){

        $result = $this->db->query("SELECT * FROM complaint_topic");

        return $result->result_array();

    }


    public function get_relateddept_search(){

      $result = $this->db->query("SELECT
        complaint_department.cp_dept_code,
        complaint_department.cp_dept_cp_no,
        complaint_department_main.cp_dept_main_name
        FROM
        complaint_department
        INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = complaint_department.cp_dept_code
        GROUP BY cp_dept_code");

      return $result->result_array();

    }


    public function get_relateddept_search_nc(){

      $result = $this->db->query("SELECT
        complaint_department_main.cp_dept_main_name,
        nc_main.nc_related_dept,
        nc_main.nc_no
        FROM
        complaint_department_main
        INNER JOIN nc_main ON complaint_department_main.cp_dept_main_code = nc_main.nc_related_dept
        GROUP BY nc_related_dept");
      return $result->result_array();

    }


    public function getCPno()
    { //สร้าง Auto complaint number

        $query = $this->db->query("select cp_no from complaint_main"); //ไปนับแถวของ cp_no ก่อน
        $numrow = $query->num_rows(); //ไปนับแถวของ cp_no ก่อน
        $year_cur = date("Y"); //กำหนด ปีปัจจุบันใส่ตัวแปร year_cur
        $cut_year_cur = substr($year_cur, 2, 2); // ตัดจากเดิม 2018 เหลือ 18

        if ($numrow == 0) { //นับแถวของข้อมูล ถ้าเท่ากับ 0
            $cp_no = "CP" . $cut_year_cur . "107"; // กำหนดค่าลงไปเลย
        } else { // ถ้าไม่เป็นตามเงื่อนไขบน
            $query2 = $this->db->query("select cp_no from complaint_main order by SUBSTR(cp_no,3) desc LIMIT 1"); //ไป query เอา cp_no มาโดยตัดเอาแค่ 3 ตัวหลังตัวล่าสุดมา 1 ตัว
            foreach ($query2->result_array() as $rs) { //ไปวิ่งเช็คข้อมูล
                $cal = $rs['cp_no']; //ตรงนี้เราจะได้ค่า CP18100
            }

            $cut_yold = substr($cal, 2, 2); //ตัดปี 2 ตัวท้ายเพื่อเอาไว้เช็ค

            if($cut_yold != $cut_year_cur){
                $start_newyear = "CP".$cut_year_cur."001";
                $cp_no = $start_newyear;
            }else{
                $cut_cp = substr($cal, 2); // 18100
                $cut_cp++;
                $set_y = str_replace($cut_cp, "CP" . $cut_cp, $cut_cp); //ทำการ Get Year ของปัจจุบันลงไป
                $cp_no = $set_y;

            }
        }

        return $cp_no; // ส่งค่ากลับไป

    }


    public function get_pri_view($cp_no)
    {
        $result = $this->db->query("SELECT complaint_priority_use.cp_pri_use_cpno, complaint_priority_use.cp_pri_use_id, complaint_priorityn.pri_name, complaint_priorityn.pri_catid, complaint_priorityn.pri_score, complaint_priorityn_category.pricat_name FROM complaint_priority_use INNER JOIN complaint_priorityn ON complaint_priorityn.pri_id = complaint_priority_use.cp_pri_use_id INNER JOIN complaint_priorityn_category ON complaint_priorityn_category.pricat_id = complaint_priorityn.pri_catid WHERE cp_pri_use_cpno ='$cp_no' ");
        return $result->result_array();
    }


    public function get_newcp()
    {
        $get_newcp = $this->db->query("SELECT cp_status_code FROM complaint_main WHERE cp_status_code='cp01' ");
        return $get_newcp->num_rows();
    }


    public function get_newnc()
    {
        $get_newnc = $this->db->query("SELECT nc_status_code FROM nc_main WHERE nc_status_code='nc01' ");
        return $get_newnc->num_rows();
    }


    public function get_owner_email($cp_no)
    {
        $result = $this->db->query("SELECT
        complaint_main.cp_id,
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
        complaint_topic.topic_name,
        complaint_topic.topic_id,
        complaint_topic_catagory.topic_cat_name,
        complaint_topic_catagory.topic_cat_id,
        complaint_status.cp_status_name,
        complaint_status.cp_status_id
        FROM
        complaint_main
        INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
        INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
        INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
        WHERE cp_no='$cp_no' 
        ");

        return $result->row();

    }


    public function conpriority($priscore)
    {

        $number =  $priscore;
        if ($number >= 1 && $number <= 1.5) {
            $level = "<span style='color:#696969;'>Very Low</span>";
        } else if ($number >= 1.6 && $number <= 2.5) {
            $level = "Low";
        } else if ($number >= 2.6 && $number <= 3.5) {
            $level = "<span style='color:#87CEEB;'>Normal</span>";
        } else if ($number >= 3.6 && $number <= 4.5) {
            $level = "<span style='color:#FF4500;'>Height</span>";
        } else {
            $level = "<span style='color:#FF0000;'>Very Height</span>";
        }
        return $level;

    }

    /*     * *************GET ZONE****************** */






    /*     * ************INSERT ZONE***************** */

    public function save_newcomplaint()
    { /*     * *start save_newcomplaint** */
        $get_cp_no = $this->getCPno();
        /** ******Get new cp_no********* */
        
        // แก้ PHP 8.2: เช็ค $_FILES ก่อนเข้าถึง
        $file_name_date = "";
        if(isset($_FILES['file_add']) && isset($_FILES['file_add']['tmp_name']) && $_FILES['file_add']['tmp_name'] != ""){
            $date = date("d-m-Y-H-i-s");
            $file_name = $_FILES['file_add']['name'] ?? "";
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
            $file_size = $_FILES['file_add']['size'] ?? 0;
            $file_tmp = $_FILES['file_add']['tmp_name'];
            $file_type = $_FILES['file_add']['type'] ?? "";
            move_uploaded_file($file_tmp, "asset/add/" . $file_name_date);
            print_r($file_name);
            echo "<br>" . "Copy/Upload Complete" . "<br>";
        }

        // แก้ PHP 8.2: ป้องกัน foreach กับ null
        $get_input_priority = $this->input->post("cp_pri_name_get") ?? []; /*         * *****Code Insert select array******* */
        foreach ($get_input_priority as $gp) { /*         * *****Check array input select******** */
            $save_pri = array(
                "cp_pri_use_id" => $gp,
                "cp_pri_use_cpno" => $get_cp_no
            );
            $this->db->insert("complaint_priority_use", $save_pri);

        } /*         * *****Code Insert select array******* */

        //        Query เพื่อเอาค่าของ Score ออกมาเพื่อเอาไปคำนวนต่อ
        $sumscore = $this->db->query("SELECT complaint_priority_use.cp_pri_use_cpno, SUM(complaint_priorityn.pri_score) as score FROM complaint_priority_use INNER JOIN complaint_priorityn ON complaint_priorityn.pri_id = complaint_priority_use.cp_pri_use_id INNER JOIN complaint_priorityn_category ON complaint_priorityn_category.pricat_id = complaint_priorityn.pri_catid WHERE cp_pri_use_cpno ='$get_cp_no' ");

        $result_score = $sumscore->row();
        //        ดึงค่าออกมาเป็น Row


        $sum_score = (double)$result_score->score / 7;
        //        นำค่าที่ได้มา Convert เป็น Double จากนั้นเอามาหาร 7


        // รับค่าและบังคับให้เป็น array เสมอ (รองรับ radio/checkbox/ไม่มีค่า)
        $get_input_dept = $this->input->post('dept', true);
        $selected = is_array($get_input_dept)
        ? $get_input_dept
        : ($get_input_dept !== null && $get_input_dept !== '' ? [$get_input_dept] : []);

        // Insert และสะสมรายการ dept code
        $dept_code_list = [];
        foreach ($selected as $gd) {
            $save_dept = [
                'cp_dept_cp_no' => $get_cp_no,
                'cp_dept_code'  => $gd
            ];
            $this->db->insert('complaint_department', $save_dept);
            $dept_code_list[] = trim($gd);
        }


        // แก้ PHP 8.2: ป้องกัน str_replace และ date_format กับ null
        $qty_convert = $this->input->post("cp_pro_qty") ?? "";
        $qty_cut_comma = str_replace(",", "", $qty_convert);
        
        $cp_date = $this->input->post("cp_date");
        $conmonth2 = "";
        $conyear2 = "";
        if($cp_date){
            $conmonth = date_create($cp_date);
            $conyear = date_create($cp_date);
            if($conmonth && $conyear){
                $conmonth2 = date_format($conmonth, "m");
                $conyear2 = date_format($conyear, "Y");
            }
        }


        $data = array( /*             * *****Insert data to complaint_main table******* */
            "cp_no" => $get_cp_no,
            "cp_date" => $this->input->post("cp_date"),
            "cp_month" => $conmonth2 ,
            "cp_year" => $conyear2 ,
            "cp_topic" => $this->input->post("cp_topic"),
            "cp_topic_cat" => $this->input->post("cp_category"),
            "cp_priority" => number_format($sum_score, 1),
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
            "cp_status_code" => "cp01",
            "rao_formno" => $this->input->post("rao_formno")
        );



        if ($this->db->insert("complaint_main", $data)) {
            echo '<script language="javascript">';
            echo 'alert("Save Data Success")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Save Data Failed !!!!")';
            echo '</script>';

        } /*         * *****Insert data to complaint_main table******* */



        $this->rao_db = $this->load->database("rao" , true);
        $arUpdateRao = array(
            "m_complaint_formno" => $get_cp_no,
            "m_status" => "Complete"
        );
        $this->rao_db->where("m_formno" , $this->input->post("rao_formno"));
        $this->rao_db->update("acci_main" , $arUpdateRao);



        //************************************ZONE***SEND****EMAIL*************************************//

        $getdata_foremail = $this->db->query("SELECT
            complaint_main.cp_id,
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
            complaint_topic.topic_name,
            complaint_topic.topic_id,
            complaint_topic_catagory.topic_cat_name,
            complaint_topic_catagory.topic_cat_id,
            complaint_status.cp_status_name,
            complaint_status.cp_status_id
            FROM
            complaint_main
            INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
            INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
            INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
            WHERE cp_no='$get_cp_no' 
        ");

        $getdata_email = $getdata_foremail->row();


        /*  -------------------------SEND--EMAIL------------------------------------------   */

        // $sqlEmail = "SELECT email FROM maillist WHERE cp_mail_active = 1 AND cp_mail_status != 0 ";
        // ถ้าต้องการ query email ที่ cp_mail อยู่ใน $dept_code_list

        $dept_code_list = array_values(array_unique($dept_code_list));
        $focusPosi = "";
        if (in_array('1007', $dept_code_list, true)) {  // true = เทียบแบบเข้มงวด
        // มี 1007 ในอาเรย์
            $focusPosi = "AND posi > 15 AND Company NOT IN ('TB' , 'ST')";
        }
        $dept_code_list_str = implode(',', array_fill(0, count($dept_code_list), '?'));
        $sqlEmail = "SELECT DISTINCT memberemail FROM member WHERE DeptCode IN ($dept_code_list_str) $focusPosi AND resigned = 0";
        $query = $this->db->query($sqlEmail , $dept_code_list);

        // แก้ PHP 8.2: เช็ค null ก่อน date_format
        $condate = "";
        if(isset($getdata_email->cp_date) && $getdata_email->cp_date){
            $date = date_create($getdata_email->cp_date);
            if($date){
                $condate = date_format($date, "d/m/Y");
            }
        }


        if ($getdata_email->cp_topic_cat == "3" || $getdata_email->cp_topic_cat == "4" || $getdata_email->cp_topic_cat == "5") {
            $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_internal='1' || default_sd='1' ";
            $sqlget_query = $this->db->query($sqlget_ccemail);


            $subject = "New Complaint";
            $body = "<h3>New Complaint for Validation.</h3>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $getdata_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $getdata_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $getdata_email->topic_cat_name . "<br>";
            $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $getdata_email->cp_status_name . "<br><br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

            foreach ($this->get_pri_view($get_cp_no) as $getpv) {
                $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
            }

            $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority(number_format($sum_score, 1)) . "<br>";
            $body .= "<br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
            $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_dept . "<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";

            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $getdata_email->cp_detail . "<br>";

            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$getdata_email->cp_file>" . $getdata_email->cp_file . "</a>" . "<br>";

            $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $get_cp_no . ">" . "Go to Page</a>";


            $to = "";
            $cc = "";
            $cc2 = "";

            $cc = array();
            foreach($sqlget_query->result_array() as $rsCC){
                $cc[] = $rsCC['cp_email_user'];
            }

            $to = array();
            foreach ($query->result_array() as $result) {
                $to[] = $result['memberemail'];
             }

            $cc2 = $getdata_email->cp_user_email;

            emailSaveData($subject , $body ,$to , $cc , $cc2);

        }else if($getdata_email->cp_topic_cat == "1"){

          $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_tecnical='1' || default_cp_external='1' || default_sd='1' ";
          $sqlget_query = $this->db->query($sqlget_ccemail);
          $subject = "New Complaint";
          $body = "<h3>New Complaint for Validation.</h3>";
          $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $getdata_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
          $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $getdata_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $getdata_email->topic_cat_name . "<br>";
          $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $getdata_email->cp_status_name . "<br><br>";
          $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

          foreach ($this->get_pri_view($get_cp_no) as $getpv) {

              $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";

          }

          $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority(number_format($sum_score, 1)) . "<br>";
          $body .= "<br>";
          $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
          $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_dept . "<br><br>";
          $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";

          $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $getdata_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $getdata_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $getdata_email->cp_invoice_no . "<br>";

          $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_qty . "<br>";

          $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $getdata_email->cp_detail . "<br>";



          $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$getdata_email->cp_file>" . $getdata_email->cp_file . "</a>" . "<br>";



          $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $get_cp_no . ">" . "Go to Page</a>";


          $to = "";
          $cc = "";
          $cc2 = "";

        $to = array();
          foreach ($query->result_array() as $result) {
              $to[] = $result['memberemail'];
           }

        $cc = array();
          foreach ($sqlget_query->result_array() as $result) {
              $cc[] = $result['cp_email_user'];
           }

        $cc2 = $getdata_email->cp_user_email;
          emailSaveData($subject , $body ,$to , $cc , $cc2);

        }else{

          $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_external='1' || default_sd='1' ";
          $sqlget_query = $this->db->query($sqlget_ccemail);
            $subject = "New Complaint";
            $body = "<h3>New Complaint for Validation.</h3>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $getdata_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $getdata_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $getdata_email->topic_cat_name . "<br>";
            $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $getdata_email->cp_status_name . "<br><br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

            foreach ($this->get_pri_view($get_cp_no) as $getpv) {

                $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";

            }

            $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority(number_format($sum_score, 1)) . "<br>";
            $body .= "<br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
            $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_dept . "<br><br>";

            $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
            $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $getdata_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $getdata_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $getdata_email->cp_invoice_no . "<br>";

            $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_qty . "<br>";

            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $getdata_email->cp_detail . "<br>";

            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$getdata_email->cp_file>" . $getdata_email->cp_file . "</a>" . "<br>";

            $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $get_cp_no . ">" . "Go to Page</a>";


            $to = "";
            $cc = "";
            $cc2 = "";
    
            $to = array();
              foreach ($query->result_array() as $result) {
                  $to[] = $result['memberemail'];
               }
    
            $cc = array();
              foreach ($sqlget_query->result_array() as $result) {
                  $cc[] = $result['cp_email_user'];
               }

            $cc2 = $getdata_email->cp_user_email;

            emailSaveData($subject , $body ,$to , $cc , $cc2);

        }


    }
    /*     * *end save_newcomplaint** */



    public function saveData_failed()
    {
        $get_cp_no = $this->getCPno(); /*         * ******Get new cp_no********* */
        
        // แก้ PHP 8.2: เช็ค $_FILES ก่อนเข้าถึง
        $file_name_date = "";
        if(isset($_FILES['file_add']) && isset($_FILES['file_add']['tmp_name']) && $_FILES['file_add']['tmp_name'] != ""){
            $date = date("d-m-Y-H-i-s");
            $file_name = $_FILES['file_add']['name'] ?? "";
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
            $file_size = $_FILES['file_add']['size'] ?? 0;
            $file_tmp = $_FILES['file_add']['tmp_name'];
            $file_type = $_FILES['file_add']['type'] ?? "";
            move_uploaded_file($file_tmp, "asset/add/" . $file_name_date);
            print_r($file_name);
            echo "<br>" . "Copy/Upload Complete" . "<br>";
        }


        $get_input_priority = $this->input->post("cp_pri_name_get"); /*         * *****Code Insert select array******* */
        foreach ($get_input_priority as $gp) { /*         * *****Check array input select******** */
            $save_pri = array(
                "cp_pri_use_id" => $gp,
                "cp_pri_use_cpno" => $get_cp_no
            );
            $this->db->insert("complaint_priority_use", $save_pri);

        } /*         * *****Code Insert select array******* */



        $get_input_dept = $this->input->post("dept_edit"); /*         * **Code Insert radio array***** */
        foreach ($get_input_dept as $gd) { /*         * ****Check array input radio********* */
            $save_dept = array(
                "cp_dept_cp_no" => $get_cp_no,
                "cp_dept_code" => $gd
            );

            $this->db->insert("complaint_department", $save_dept);
        } /*         * **Code Insert radio array***** */



        $data = array( /*             * *****Insert data to complaint_main table******* */
            "cp_no" => $get_cp_no,
            "cp_date" => $this->input->post("cp_date"),
            "cp_topic" => $this->input->post("cp_topic"),
            "cp_topic_cat" => $this->input->post("cp_category"),
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
            "cp_status_code" => "cp08",
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

        } /*         * *****Insert data to complaint_main table******* */


    }

    /*     * ************INSERT ZONE***************** */


    /*     * ************UPDATE ZONE***************** */

    public function change_status_to1($cp_no)
    { /*     * *****Change New Complaint to Complaint Analyzed********* */

        $this->db->query("UPDATE complaint_main SET cp_status_code='cp02' WHERE cp_no='$cp_no' ");

        // $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' AND cp_mail_status='1' ");

        $sqlRelatedEmail = "SELECT cp_dept_code FROM complaint_department WHERE cp_dept_cp_no = '$cp_no'";
        $query = $this->db->query($sqlRelatedEmail);

        $dept_code_list = [];
        foreach ($query->result() as $row) {
            $dept_code_list[] = trim($row->cp_dept_code);
        }

        $to = [];
        $cc = "";
        $cc2 = "";

        if (!empty($dept_code_list)) {
            $dept_code_list = array_values(array_unique($dept_code_list));
            $focusPosi = "";
            if (in_array('1007', $dept_code_list, true)) {  // true = เทียบแบบเข้มงวด
            // มี 1007 ในอาเรย์
                $focusPosi = "AND posi > 15 AND Company NOT IN ('TB' , 'ST')";
            }
            $dept_code_list_str = implode(',', array_fill(0, count($dept_code_list), '?'));
            $sqlEmail = "SELECT DISTINCT memberemail FROM member WHERE DeptCode IN ($dept_code_list_str) $focusPosi AND resigned = 0";
            $query = $this->db->query($sqlEmail , $dept_code_list);

            foreach ($query->result_array() as $result) {
                $to[] = $result['memberemail'];
            }
        }


        $get_owner_email = $this->get_owner_email($cp_no);


        // แก้ PHP 8.2: เช็ค null ก่อน date_format
        $cpdate = "";
        if(isset($get_owner_email->cp_date) && $get_owner_email->cp_date){
            $date = date_create($get_owner_email->cp_date);
            if($date){
                $cpdate = date_format($date, "d-m-Y");
            }
        }


        $subject = "Investigate Start !";
        $body = "<h3>The Complaint is starting an investigation.</h3>";
        $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$cpdate. "<br>";

        $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";

        $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br>";

        $body .= "<strong>Link Program : </strong>" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";


        $cc2 = $get_owner_email->cp_user_email;
        emailSaveData($subject , $body ,$to , $cc , $cc2);

    }




    public function add_detail_inves($cp_no)
    { /*     * *******Add Detail investigate+Upload file to db********************* */

        //*******************Check**การกรอกข้อมูล***********************//
        if ($this->input->post("cp_detail_inves") == "") {
            echo '<script language="javascript">';
            echo 'alert("Please fill data!")';
            echo '</script>';
            echo '<script lanaguage="javascript">';
            echo 'history.back()';
            echo '</script>';
            exit();
        }


        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        // แก้ PHP 8.2: เช็ค $_FILES ก่อนเข้าถึง
        $file_name_date = "";
        if(isset($_FILES['cp_detail_inves_file']) && isset($_FILES['cp_detail_inves_file']['tmp_name']) && $_FILES['cp_detail_inves_file']['tmp_name'] != ""){
            $date = date("d-m-Y-H-i-s");
            $file_name = $_FILES['cp_detail_inves_file']['name'] ?? "";
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
            $file_size = $_FILES['cp_detail_inves_file']['size'] ?? 0;
            $file_tmp = $_FILES['cp_detail_inves_file']['tmp_name'];
            $file_type = $_FILES['cp_detail_inves_file']['type'] ?? "";
            move_uploaded_file($file_tmp, "asset/investigate/detail_inves/" . $file_name_date);
            print_r($file_name);
            echo "<br>" . "Copy/Upload Complete" . "<br>";
        }

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

        // $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' AND cp_mail_status ='1' ");

        $sqlRelatedEmail = "SELECT cp_dept_code FROM complaint_department WHERE cp_dept_cp_no = '$cp_no'";
        $query = $this->db->query($sqlRelatedEmail);

        $dept_code_list = [];
        foreach ($query->result() as $row) {
            $dept_code_list[] = trim($row->cp_dept_code);
        }

        $to = [];

        if (!empty($dept_code_list)) {
            $dept_code_list = array_values(array_unique($dept_code_list));
            $focusPosi = "";
            if (in_array('1007', $dept_code_list, true)) {  // true = เทียบแบบเข้มงวด
            // มี 1007 ในอาเรย์
                $focusPosi = "AND posi > 15 AND Company NOT IN ('TB' , 'ST')";
            }
            $dept_code_list_str = implode(',', array_fill(0, count($dept_code_list), '?'));
            $sqlEmail = "SELECT DISTINCT memberemail FROM member WHERE DeptCode IN ($dept_code_list_str) $focusPosi AND resigned = 0";
            $query = $this->db->query($sqlEmail , $dept_code_list);

            foreach ($query->result_array() as $result) {
                $to[] = $result['memberemail'];
            }
        }

        $get_owner_email = $this->get_owner_email($cp_no);

        // แก้ PHP 8.2: เช็ค null ก่อน date_format
        $condate = "";
        $condate2 = "";
        if(isset($get_owner_email->cp_date) && $get_owner_email->cp_date){
            $date = date_create($get_owner_email->cp_date);
            if($date){
                $condate = date_format($date, "d/m/Y");
            }
        }

        if(isset($get_owner_email->cp_detail_inves_date) && $get_owner_email->cp_detail_inves_date){
            $date2 = date_create($get_owner_email->cp_detail_inves_date);
            if($date2){
                $condate2 = date_format($date2, "d/m/Y");
            }
        }



        if($get_owner_email->cp_topic_cat == "3" || $get_owner_email->cp_topic_cat == "4" || $get_owner_email->cp_topic_cat == "5"){

          $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_internal='1' || default_sd='1' ";
          $sqlget_query = $this->db->query($sqlget_ccemail);

            $subject = "Investigation Complete";
            $body = "<h3>The Complaint Investigation Complete.</h3>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
            $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

            foreach ($this->get_pri_view($cp_no) as $getpv) {
                $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
            }

            $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority($get_owner_email->cp_priority) . "<br>";
            $body .= "<br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
            $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
            $body .= "<br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
            $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
            $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate2. "<br>";
            $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";


            $cc = "";
            $cc2 = "";
    
    
            $cc = array();
            foreach ($sqlget_query->result_array() as $result) {
                $cc[] = $result['cp_email_user'];
            }

            $cc2 = $get_owner_email->cp_user_email;
            emailSaveData($subject , $body ,$to , $cc , $cc2);

        }else if($get_owner_email->cp_topic_cat == "1"){


          $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_tecnical='1' || default_cp_external='1' || default_sd='1' ";
          $sqlget_query = $this->db->query($sqlget_ccemail);

          $subject = "Investigation Complete";
          $body = "<h3>The Complaint Investigation Complete.</h3>";
          $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
          $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
          $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";
          $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

          foreach ($this->get_pri_view($cp_no) as $getpv) {
              $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
          }

          $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority($get_owner_email->cp_priority) . "<br>";
          $body .= "<br>";
          $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
          $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";
          $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
          $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_invoice_no . "<br>";
          $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_qty . "<br>";
          $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
          $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
          $body .= "<br>";
          $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
          $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
          $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
          $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate2. "<br>";

          $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";

          $cc = "";
          $cc2 = "";
  
          $cc = array();
          foreach ($sqlget_query->result_array() as $result) {
              $cc[] = $result['cp_email_user'];
          }
          $cc2 = $get_owner_email->cp_user_email;
          emailSaveData($subject , $body ,$to , $cc , $cc2);

        }else{

          $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_external='1' || default_sd='1' ";
          $sqlget_query = $this->db->query($sqlget_ccemail);

            $subject = "Investigation Complete";
            $body = "<h3>The Complaint Investigation Complete.</h3>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
            $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

            foreach ($this->get_pri_view($cp_no) as $getpv) {
                $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
            }

            $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority($get_owner_email->cp_priority) . "<br>";
            $body .= "<br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
            $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
            $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_invoice_no . "<br>";
            $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_qty . "<br>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
            $body .= "<br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
            $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
            $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate2. "<br>";
            $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";


            $cc = "";
            $cc2 = "";
    
    
            $cc = array();
            foreach ($sqlget_query->result_array() as $result) {
                $cc[] = $result['cp_email_user'];
            }
            $cc2 = $get_owner_email->cp_user_email;
            emailSaveData($subject , $body ,$to , $cc , $cc2);

        }
    }




    public function add_sum_inves($cp_no)
    { /*     * ***********SUMMARY OF INVESTIGATION**************** */

        //*******************Check**การกรอกข้อมูล***********************//
        if ($this->input->post("cp_sum_inves") == "") {
            echo '<script language="javascript">';
            echo 'alert("Please fill data!")';
            echo '</script>';
            echo '<script lanaguage="javascript">';
            echo 'history.back()';
            echo '</script>';
            exit();
        }

        if ($this->input->post("cp_sum") == "") {
            echo '<script language="javascript">';
            echo 'alert("Please choose choice!")';
            echo '</script>';
            header("refresh:0; url=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/$cp_no");
            //                redirect('/complaint/investigate/'.$cp_no);
            exit();
        }


        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        // แก้ PHP 8.2: เช็ค $_FILES ก่อนเข้าถึง
        $file_name_date = "";
        if(isset($_FILES['cp_sum_inves_file']) && isset($_FILES['cp_sum_inves_file']['tmp_name']) && $_FILES['cp_sum_inves_file']['tmp_name'] != ""){
            $date = date("d-m-Y-H-i-s");
            $file_name = $_FILES['cp_sum_inves_file']['name'] ?? "";
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
            $file_size = $_FILES['cp_sum_inves_file']['size'] ?? 0;
            $file_tmp = $_FILES['cp_sum_inves_file']['tmp_name'];
            $file_type = $_FILES['cp_sum_inves_file']['type'] ?? "";
            move_uploaded_file($file_tmp, "asset/investigate/sum_inves/" . $file_name_date);
            print_r($file_name);
            echo "<br>" . "Copy/Upload Complete" . "<br>";
        }


        if ($this->input->post("cp_sum") == "yes") {
            $update_status = "cp05";
            $update_status_nc = "nc01";
            $this->db->where("cp_dept_cp_no", $cp_no);
            $this->db->delete("complaint_department");
            $get_input_dept = $this->input->post("dept_edit"); /*         * **Code Insert radio array***** */

            foreach ($get_input_dept as $gd) { /*         * ****Check array input radio********* */
                $save_dept = array(
                    "cp_dept_cp_no" => $cp_no,
                    "cp_dept_code" => $gd
                );
                $this->db->insert("complaint_department", $save_dept);


                $data_nc = array(
                  "nc_no" => $cp_no,
                  "nc_related_dept" => $gd,
                  "nc_status_code" => $update_status_nc
                );
                $this->db->insert("nc_main",$data_nc);

            } /*         * **Code Insert radio array***** */


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
            "cp_sum" => $this->input->post("cp_sum")
        );

        $this->db->where("cp_no", $cp_no);
        $result_cp = $this->db->update("complaint_main", $data);
        if(!$result_cp){
          echo "บันทึกข้อมูล cp_main table ไม่สำเร็จ";
        }else{
          echo "บันทึกข้อมูล cp_main table สำเร็จ";
        }



        //************************Email***Zone***********************************//
        $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' AND cp_mail_status ='1' ");

        $get_owner_email = $this->get_owner_email($cp_no);

            $date = date_create($get_owner_email->cp_date);
             $condate = date_format($date, "d/m/Y");
             $date2 = date_create( $get_owner_email->cp_detail_inves_date );
             $condate2 = date_format($date2, "d/m/Y");
             $date3 = date_create( $get_owner_email->cp_sum_inves_date );
             $condate3 = date_format($date2, "d/m/Y");

        if ($get_owner_email->cp_sum == "no") {  /***ถ้าไม่เป็นข้อบกพร้่อง***/
            if ($get_owner_email->cp_topic_cat == "3" || $get_owner_email->cp_topic_cat == "4" || $get_owner_email->cp_topic_cat == "5") { /******ถ้าเป็นประเภท Internal*******/

              // code select email for addcc
              $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_internal='1' || default_sd='1' ";
              $sqlget_query = $this->db->query($sqlget_ccemail);
              // code select email for addcc

                $subject = "Normal Complaint";
                $body = "<h3>The Complaint is normal complaint.</h3>";
                $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
                $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
                $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

                foreach ($this->get_pri_view($cp_no) as $getpv) {
                    $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
                }

                $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority($get_owner_email->cp_priority) . "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
                $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
                $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
                $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
                $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate2. "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Summary of Investigation</strong><br>";
                $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_sum_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
                $body .= "<strong>ไม่เป็นข้อบกพร่องของบริษัท</strong><br>";
                $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" .$condate3. "<br>";
                $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";


                $to = "";
                $cc = "";
                $cc2 = "";
        
                $to = array();
                foreach ($getEmail->result_array() as $result) {
                    $to[] = $result['email'];
                }
        
                $cc = array();
                foreach ($sqlget_query->result_array() as $result) {
                    $cc[] = $result['cp_email_user'];
                }
                $cc2 = $get_owner_email->cp_user_email;
                emailSaveData($subject , $body ,$to , $cc , $cc2);

            }else if($get_owner_email->cp_topic_cat == "1") {

              $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_tecnical='1' || default_cp_external='1' || default_sd='1' ";

              $sqlget_query = $this->db->query($sqlget_ccemail);

              $subject = "Normal Complaint";
              $body = "<h3>The Complaint is normal complaint.</h3>";
              $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
              $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
              $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";
              $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

              foreach ($this->get_pri_view($cp_no) as $getpv) {
                  $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
              }

              $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority($get_owner_email->cp_priority) . "<br>";
              $body .= "<br>";
              $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
              $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";
              $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
              $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_invoice_no . "<br>";
              $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_qty . "<br>";
              $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
              $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
              $body .= "<br>";
              $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
              $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
              $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
              $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate2. "<br>";
              $body .= "<br>";
              $body .= "<strong style='font-size:18px;font-weight:600;'>Summary of Investigation</strong><br>";
              $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_sum_inves . "<br>";
              $body .= "<strong>Link Attached File : </strong>" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
              $body .= "<strong>ไม่เป็นข้อบกพร่องของบริษัท</strong><br>";
              $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" .$condate3. "<br>";
              $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";



              $to = "";
              $cc = "";
              $cc2 = "";
      
              $to = array();
              foreach ($getEmail->result_array() as $result) {
                  $to[] = $result['email'];
              }
      
              $cc = array();
              foreach ($sqlget_query->result_array() as $result) {
                  $cc[] = $result['cp_email_user'];
              }
              $cc2 = $get_owner_email->cp_user_email;
              emailSaveData($subject , $body ,$to , $cc , $cc2);


            }else {

              $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_external='1' || default_sd='1' ";
              $sqlget_query = $this->db->query($sqlget_ccemail);

                $subject = "Normal Complaint";
                $body = "<h3>The Complaint is normal complaint.</h3>";
                $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
                $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
                $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

                foreach ($this->get_pri_view($cp_no) as $getpv) {
                    $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
                }

                $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority($get_owner_email->cp_priority) . "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
                $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
                $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_invoice_no . "<br>";
                $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_qty . "<br>";
                $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
                $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
                $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate2. "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Summary of Investigation</strong><br>";
                $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_sum_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
                $body .= "<strong>ไม่เป็นข้อบกพร่องของบริษัท</strong><br>";
                $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" .$condate3. "<br>";
                $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";



                $to = "";
                $cc = "";
                $cc2 = "";
        
                $to = array();
                foreach ($getEmail->result_array() as $result) {
                    $to[] = $result['email'];
                }
        
                $cc = array();
                foreach ($sqlget_query->result_array() as $result) {
                    $cc[] = $result['cp_email_user'];
                }
                $cc2 = $get_owner_email->cp_user_email;
                emailSaveData($subject , $body ,$to , $cc , $cc2);

            }

        } else {



            if ($this->input->post('cp_topic_cat') == "3" || $this->input->post('cp_topic_cat') == "4" || $this->input->post('cp_topic_cat') == "5") {


              $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_internal='1' || default_sd='1' ";
              $sqlget_query = $this->db->query($sqlget_ccemail);

                $subject = "Transfered to NC";
                $body = "<h3>The Complaint is normal complaint.</h3>";
                $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
                $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
                $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

                foreach ($this->get_pri_view($cp_no) as $getpv) {
                    $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
                }

                $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority($get_owner_email->cp_priority) . "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
                $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
                $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
                $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
                $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate2. "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Summary of Investigation</strong><br>";
                $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_sum_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
                $body .= "<strong>เป็นข้อบกพร่องของบริษัท</strong><br>";
                $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" .$condate3. "<br>";
                $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/nc/>" . "Go to Page</a>";


                $to = "";
                $cc = "";
                $cc2 = "";
        
                $to = array();
                foreach ($getEmail->result_array() as $result) {
                    $to[] = $result['email'];
                }
        
                $cc = array();
                foreach ($sqlget_query->result_array() as $result) {
                    $cc[] = $result['cp_email_user'];
                }
                $cc2 = $get_owner_email->cp_user_email;
                emailSaveData($subject , $body ,$to , $cc , $cc2);


            } else if($get_owner_email->cp_topic_cat == "1"){

              $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_tecnical='1' || default_cp_external='1' || default_sd='1' ";
              $sqlget_query = $this->db->query($sqlget_ccemail);
              $subject = "Transfered to NC";
              $body = "<h3>The Complaint is Transfered to NC.</h3>";
              $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
              $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
              $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";
              $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

              foreach ($this->get_pri_view($cp_no) as $getpv) {
                  $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
              }

              $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority($get_owner_email->cp_priority) . "<br>";
              $body .= "<br>";
              $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
              $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";
              $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
              $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_invoice_no . "<br>";
              $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_qty . "<br>";
              $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
              $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
              $body .= "<br>";
              $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
              $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
              $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
              $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate2. "<br>";
              $body .= "<br>";
              $body .= "<strong style='font-size:18px;font-weight:600;'>Summary of Investigation</strong><br>";
              $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_sum_inves . "<br>";
              $body .= "<strong>Link Attached File : </strong>" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
              $body .= "<strong>เป็นข้อบกพร่องของบริษัท</strong><br>";
              $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" .$condate3. "<br>";
              $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/nc/>" . "Go to Page</a>";


              $to = "";
              $cc = "";
              $cc2 = "";
      
              $to = array();
              foreach ($getEmail->result_array() as $result) {
                  $to[] = $result['email'];
              }
      
              $cc = array();
              foreach ($sqlget_query->result_array() as $result) {
                  $cc[] = $result['cp_email_user'];
              }
              $cc2 = $get_owner_email->cp_user_email;
              emailSaveData($subject , $body ,$to , $cc , $cc2);

            }else{


              $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_external='1' || default_sd='1' ";
              $sqlget_query = $this->db->query($sqlget_ccemail);

                $subject = "Transfered to NC";
                $body = "<h3>The Complaint is Transfered to NC.</h3>";
                $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
                $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $get_owner_email->topic_cat_name . "<br>";
                $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_status_name . "<br><br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

                foreach ($this->get_pri_view($cp_no) as $getpv) {
                    $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
                }

                $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority($get_owner_email->cp_priority) . "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
                $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_user_dept . "<br><br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
                $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_invoice_no . "<br>";
                $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_pro_qty . "<br>";
                $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Investigation</strong><br>";
                $body .= "<strong>Detail of Investigate : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
                $body .= "<strong>Signature : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate2. "<br>";
                $body .= "<br>";
                $body .= "<strong style='font-size:18px;font-weight:600;'>Summary of Investigation</strong><br>";
                $body .= "<strong>Detail Summary of Investigation : </strong>&nbsp;&nbsp;" . $get_owner_email->cp_sum_inves . "<br>";
                $body .= "<strong>Link Attached File : </strong>" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
                $body .= "<strong>เป็นข้อบกพร่องของบริษัท</strong><br>";
                $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" .$condate3. "<br>";
                $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/nc/>" . "Go to Page</a>";


                $to = "";
                $cc = "";
                $cc2 = "";
        
                $to = array();
                foreach ($getEmail->result_array() as $result) {
                    $to[] = $result['email'];
                }
        
                $cc = array();
                foreach ($sqlget_query->result_array() as $result) {
                    $cc[] = $result['cp_email_user'];
                }
                $cc2 = $get_owner_email->cp_user_email;
                emailSaveData($subject , $body ,$to , $cc , $cc2);

            }
            //Section ส่ง Email แจ้งเรื่อง New NC ให้แก่ผู้ที่เกี่ยวข้องรับทราบ
        }
        //************************Email***Zone***********************************//
    }











    public function add_conclusion($cp_no)
    {
        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        // แก้ PHP 8.2: เช็ค $_FILES ก่อนเข้าถึง
        $file_name_date = "";
        if(isset($_FILES['cp_conclu_file']) && isset($_FILES['cp_conclu_file']['tmp_name']) && $_FILES['cp_conclu_file']['tmp_name'] != ""){
            $date = date("d-m-Y-H-i-s");
            $file_name = $_FILES['cp_conclu_file']['name'] ?? "";
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
            $file_size = $_FILES['cp_conclu_file']['size'] ?? 0;
            $file_tmp = $_FILES['cp_conclu_file']['tmp_name'];
            $file_type = $_FILES['cp_conclu_file']['type'] ?? "";
            move_uploaded_file($file_tmp, "asset/investigate/conclusion_inves/" . $file_name_date);
            print_r($file_name);
            echo "<br>" . "Copy/Upload Complete" . "<br>";
        }

        // แก้ PHP 8.2: ป้องกัน str_replace กับ null
        $conclu_cost = $this->input->post("cp_conclu_cost") ?? "";
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

        $getEmail = $this->db->query("SELECT maillist.deptcode, maillist.email, complaint_department.cp_dept_cp_no FROM complaint_department INNER JOIN maillist ON maillist.deptcode = complaint_department.cp_dept_code WHERE cp_dept_cp_no = '$cp_no' AND cp_mail_status='1' ");
        $get_owner_email = $this->get_owner_email($cp_no);
        $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email ";
        $sqlget_query = $this->db->query($sqlget_ccemail);


        $subject = "Conclusion of Complaint";
        $body = "<h2>The Complaint is Conclusion of Complaint.</h2>";
        $body .= "<strong>Complaint No. : </strong>" . $get_owner_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_date . "<br>";
        $body .= "<strong>Topic : </strong>" . $get_owner_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>" . $get_owner_email->topic_cat_name . "<br>";
        $body .= "<strong>Status : </strong>" . $get_owner_email->cp_status_name . "<br>";
        $body .= "<strong><h2>Priority</h2></strong>";

        foreach ($this->get_pri_view($cp_no) as $getpv) {
            $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>" . $getpv['pri_name'] . "<br>";
        }

        $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . $this->conpriority($get_owner_email->cp_priority) . "<br>";
        $body .= "<br>";
        $body .= "<h2>User Information</h2>";
        $body .= "<strong>Complaint Person :</strong>" . $get_owner_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>" . $get_owner_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>" . $get_owner_email->cp_user_dept;
        $body .= "<h2>Details of Complaint / Damages</h2>";
        $body .= "<strong>Complaint Detail : </strong>" . $get_owner_email->cp_detail . "<br>";
        $body .= "<strong>Link Attached File : </strong>" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$get_owner_email->cp_file>" . $get_owner_email->cp_file . "</a>" . "<br>";
        $body .= "<h2>Investigation</h2>";
        $body .= "<strong>Detail of Investigate : </strong>" . $get_owner_email->cp_detail_inves . "<br>";
        $body .= "<strong>Link Attached File : </strong>" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/detail_inves/$get_owner_email->cp_detail_inves_file'>" . $get_owner_email->cp_detail_inves_file . "</a><br>";
        $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_detail_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_detail_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_detail_inves_date . "<br>";
        $body .= "<h2>Summary of Investigation</h2>";
        $body .= "<strong>Detail Summary of Investigation : </strong>" . $get_owner_email->cp_sum_inves . "<br>";
        $body .= "<strong>Link Attached File : </strong>" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/sum_inves/$get_owner_email->cp_sum_inves_file'>" . $get_owner_email->cp_sum_inves_file . "</a><br>";
        $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_sum_inves_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_sum_inves_dept . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_sum_inves_date . "<br>";
        $body .= "<h2>Conclusion of Complaint</h2>";
        $body .= "<strong>Detail Conclusion of Complaint : </strong>" . $get_owner_email->cp_conclu_detail . "<br>";
        $body .= "<strong>Detail of Cost : </strong>" . $get_owner_email->cp_conclu_costdetail . "&nbsp;&nbsp;<strong>Cost : </strong>" . $get_owner_email->cp_conclu_cost . "<br>";
        $body .= "<strong>Link Attached File : </strong>" . "<a href='http://intranet.saleecolour.com/intsys/complaint/asset/investigate/conclusion_inves/$get_owner_email->cp_conclu_file'>" . $get_owner_email->cp_conclu_file . "</a><br>";
        $body .= "<strong>Signature : </strong>" . $get_owner_email->cp_conclu_signature . "&nbsp;&nbsp;<strong>Department : </strong>" . $get_owner_email->cp_conclu_dept . "&nbsp;&nbsp;<strong>Date : </strong>" . $get_owner_email->cp_conclu_date . "<br>";
        $body .= "<strong>Link Program : </strong>" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $cp_no . ">" . "Go to Page</a>";


        $to = "";
        $cc = "";
        $cc2 = "";

        $to = array();
        foreach ($getEmail->result_array() as $result) {
            $to[] = $result['email'];
        }

        $cc = array();
        foreach ($sqlget_query->result_array() as $result) {
            $cc[] = $result['cp_email_user'];
        }
        $cc2 = $get_owner_email->cp_user_email;
        emailSaveData($subject , $body ,$to , $cc , $cc2);

        //************************Email***Zone***********************************//

    }


    public function savedata_edit($cp_no)
    {
        if ($_FILES['file_add_edit']['tmp_name'] !== "") {
            $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
            $file_name = $_FILES['file_add_edit']['name'];
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = str_replace(".", "-" . $date . ".", $file_name_cut);
            $file_size = $_FILES['file_add_edit']['size'];
            $file_tmp = $_FILES['file_add_edit']['tmp_name'];
            $file_type = $_FILES['file_add_edit']['type'];

            move_uploaded_file($file_tmp, "asset/add/" . $file_name_date);

            print_r($file_name);
            echo "<br>" . "Copy/Upload Complete" . "<br>";

        } else {
            $file_name_date = $this->input->post("showfile");
        }
        $this->db->where("cp_pri_use_cpno", $cp_no);
        $this->db->delete("complaint_priority_use");

        $get_input_priority = $this->input->post("cp_pri_name_get_edit"); /*         * *****Code Insert select array******* */

        foreach ($get_input_priority as $gp) { /*         * *****Check array input select******** */
            $save_pri = array(
                "cp_pri_use_id" => $gp,
                "cp_pri_use_cpno" => $cp_no
            );
            $this->db->insert("complaint_priority_use", $save_pri);
        } /*         * *****Code Insert select array******* */

        //        Query เพื่อเอาค่าของ Score ออกมาเพื่อเอาไปคำนวนต่อ

        $sumscore = $this->db->query("SELECT complaint_priority_use.cp_pri_use_cpno, SUM(complaint_priorityn.pri_score) as score FROM complaint_priority_use INNER JOIN complaint_priorityn ON complaint_priorityn.pri_id = complaint_priority_use.cp_pri_use_id INNER JOIN complaint_priorityn_category ON complaint_priorityn_category.pricat_id = complaint_priorityn.pri_catid WHERE cp_pri_use_cpno ='$cp_no' ");

        $result_score = $sumscore->row();

        //        ดึงค่าออกมาเป็น Row

        $sum_score = (double)$result_score->score / 7;

        //        นำค่าที่ได้มา Convert เป็น Double จากนั้นเอามาหาร 7

        $this->db->where("cp_dept_cp_no", $cp_no);
        $this->db->delete("complaint_department");

        $get_input_dept = $this->input->post("dept_edit"); /*         * **Code Insert radio array***** */

        foreach ($get_input_dept as $gd) { /*         * ****Check array input radio********* */
            $save_dept = array(
                "cp_dept_cp_no" => $cp_no,
                "cp_dept_code" => $gd
            );
            $this->db->insert("complaint_department", $save_dept);
        } /*         * **Code Insert radio array***** */


        $data = array( /*             * *****Update data to complaint_main table******* */
            //                "cp_no" => $get_cp_no,
            //                "cp_date" => $this->input->post("cp_date"),
            "cp_topic" => $this->input->post("cp_topic"),
            "cp_topic_cat" => $this->input->post("cp_category"),
            "cp_priority" => number_format($sum_score, 1),
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
        } /*         * *****Insert data to complaint_main table******* */
    }

    public function save_edit_inves($cp_no)
    {
        if ($_FILES['cp_detail_inves_file_edit']['tmp_name'] == "") {
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


    public function update_ncstatus($cp_no,$nc_related_dept){

        $data = array(
            "nc_status_code" => "nc12"
        );

        $this->db->where("nc_no",$cp_no);
        $this->db->where("nc_related_dept",$nc_related_dept);
        $this->db->update("nc_main",$data);

    }
    /*     * ************UPDATE ZONE***************** */




    /*     * ***********SET ZONE********************** */
    public function set_activeEmail()
    {

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
        } else { //ถ้ามีการติ๊กเลือก ให้ดำเนินการปรับ สถานะ
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
    public function check_status_page($cp_no)/******เช็คหน้า View************/
    { /*     * *****Check status page******* */
        $result = $this->db->query("SELECT cp_status_code FROM complaint_main WHERE cp_no='$cp_no' ");
        $get_status = $result->row();
        if ($get_status->cp_status_code != "cp07" && $get_status->cp_status_code != "cp01") {
            redirect('/complaint/investigate/' . $cp_no);
        }
    }



    public function check_status_page2($cp_no)/******เช็คหน้า Investigate************/
    { /*     * *****Check status page******* */
        $result = $this->db->query("SELECT cp_status_code FROM complaint_main WHERE cp_no='$cp_no' ");
        $get_status = $result->row();
        if ($get_status->cp_status_code == "cp07" || $get_status->cp_status_code == "cp01") {
            redirect('/complaint/view/' . $cp_no);
        }
    }

    public function getcpno_test()
    { //สร้าง Auto complaint number
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
            $cut_cp++;
            $set_y = str_replace($cut_cp, "CP" . $cut_cp, $cut_cp); //ทำการ Get Year ของปัจจุบันลงไป
        }

        return $set_y; // ส่งค่ากลับไป
    }

    public function check_pri_empty(){
        $get_input_priority = $this->input->post("cp_pri_name_get"); /*         * *****Code Insert select array******* */

        foreach ($get_input_priority as $gp) { /*         * *****Check array input select******** */
            if($gp == ""){
                echo '<script language="javascript">';
                echo 'alert("Please choose priority fill!")';
                echo '</script>';
                echo '<script lanaguage="javascript">';
                echo 'history.back()';
                echo '</script>';
                exit();
            }
        }

    }


    public function check_dept_empty(){
        $get_input_dept = $this->input->post("dept"); /*         * **Code Insert radio array***** */
            if($get_input_dept == ""){
                echo '<script language="javascript">';
                echo 'alert("Please choose dept fill!")';
                echo '</script>';
                echo '<script lanaguage="javascript">';
                echo 'history.back()';
                echo '</script>';
                exit();
            } /*         * **Code Insert radio array***** */

    }

    /*     * ***************CHECK ZONE******************** */

    public function fetch_topic_category(){
        $this->db->order_by("topic_cat_name","ASC");
        $query = $this->db->get("complaint_topic_catagory");
        return $query->result();
    }


    public function fetch_topic($topic_cat_id)
    {
        $this->db->where("topic_cat_id",$topic_cat_id);
        $query = $this->db->get("complaint_topic");
        $output = '<option value="">Select Topic</option>';
        foreach ($query->result() as $row )
        {
            $output .= '<option value="'.$row->topic_id.'">'.$row->topic_name.'</option>';
        }
        return $output;
    }


    public function cancel_complaint($cp_no){
        $data = array(
            "cp_status_code" => "cp07"
        );

        $this->db->where("cp_no",$cp_no);
        $this->db->update("complaint_main",$data);


        $arinsertCancelLog = array(
            "cancel_cp_no" => $cp_no,
            "cancel_username" => $this->session->userdata('Fname')." ".$this->session->userdata('Lname'),
            "cancel_ecode" => $this->session->userdata('ecode'),
            "cancel_datetime" => date("Y-m-d H:i:s")
        );
        $this->db->insert("complaint_cancel_log" , $arinsertCancelLog);

    }


    public function resend_email($get_cp_no)
    {
          //************************************ZONE***SEND****EMAIL*************************************//
          $getdata_foremail = $this->db->query("SELECT
          complaint_main.cp_id,
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
          complaint_topic.topic_name,
          complaint_topic.topic_id,
          complaint_topic_catagory.topic_cat_name,
          complaint_topic_catagory.topic_cat_id,
          complaint_status.cp_status_name,
          complaint_status.cp_status_id
          FROM
          complaint_main
          INNER JOIN complaint_topic ON complaint_topic.topic_id = complaint_main.cp_topic
          INNER JOIN complaint_topic_catagory ON complaint_topic_catagory.topic_cat_id = complaint_main.cp_topic_cat
          INNER JOIN complaint_status ON complaint_status.cp_status_id = complaint_main.cp_status_code
          WHERE cp_no='$get_cp_no' ");

        $getdata_email = $getdata_foremail->row();

        $check_email = $this->db->query("SELECT
        complaint_department.cp_dept_cp_no,
        complaint_department_main.cp_dept_main_name,
        complaint_department_main.cp_dept_main_code
        FROM
        complaint_department
        INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = complaint_department.cp_dept_code
        where cp_dept_cp_no='$get_cp_no'  ");



        foreach ($check_email->result_array() as $get_check_email){
            $ar= array(
                "cp_mail_active" => "1"
            );

            $calldept = $get_check_email['cp_dept_main_code'];
            $this->db->where("deptcode",$calldept);
            $this->db->update("maillist",$ar);
        }

        /*  -------------------------SEND--EMAIL------------------------------------------   */
        $sqlEmail = "SELECT email FROM maillist WHERE cp_mail_active = 1 AND cp_mail_status != 0 "; //1=it , 2=sales , 3=cs
        $query = $this->db->query($sqlEmail);

        $date = date_create($getdata_email->cp_date);
        $condate = date_format($date, "d/m/Y");

        if ($getdata_email->cp_topic_cat == "3" || $getdata_email->cp_topic_cat == "4" || $getdata_email->cp_topic_cat == "5") {

            $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_internal='1' || default_sd='1' ";
            $sqlget_query = $this->db->query($sqlget_ccemail);

            $subject = "New Complaint";
            $body = "<h3>New Complaint for Validation.</h3>";
            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $getdata_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $getdata_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $getdata_email->topic_cat_name . "<br>";
            $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $getdata_email->cp_status_name . "<br><br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

            foreach ($this->get_pri_view($get_cp_no) as $getpv) {
                $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
            }

            $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . "<br>";
            $body .= "<br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
            $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_dept . "<br><br>";
            $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $getdata_email->cp_detail . "<br>";
            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$getdata_email->cp_file>" . $getdata_email->cp_file . "</a>" . "<br>";
            $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $get_cp_no . ">" . "Go to Page</a>";


            $to = "";
            $cc = "";
            $cc2 = "";
    
            $to = array();
            foreach ($query->result_array() as $result) {
                $to[] = $result['email'];
            }
    
            $cc = array();
            foreach ($sqlget_query->result_array() as $result) {
                $cc[] = $result['cp_email_user'];
            }
            $cc2 = $getdata_email->cp_user_email;
            emailSaveData($subject , $body ,$to , $cc , $cc2);

            //************************************ZONE***SEND****EMAIL*************************************//





        }else if($getdata_email->cp_topic_cat == "1"){

        $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_tecnical='1' || default_cp_external='1' || default_sd='1' ";
        $sqlget_query = $this->db->query($sqlget_ccemail);

        $subject = "New Complaint";
        $body = "<h3>New Complaint for Validation.</h3>";
        $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $getdata_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";
        $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $getdata_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $getdata_email->topic_cat_name . "<br>";
        $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $getdata_email->cp_status_name . "<br><br>";
        $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

        foreach ($this->get_pri_view($get_cp_no) as $getpv) {
            $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";
        }

        $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . "<br>";
        $body .= "<br>";
        $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";
        $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_dept . "<br><br>";
        $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";
        $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $getdata_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $getdata_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $getdata_email->cp_invoice_no . "<br>";
        $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_qty . "<br>";
        $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $getdata_email->cp_detail . "<br>";
        $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$getdata_email->cp_file>" . $getdata_email->cp_file . "</a>" . "<br>";
        $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $get_cp_no . ">" . "Go to Page</a>";


        $to = "";
        $cc = "";
        $cc2 = "";

        $to = array();
        foreach ($query->result_array() as $result) {
            $to[] = $result['email'];
        }

        $cc = array();
        foreach ($sqlget_query->result_array() as $result) {
            $cc[] = $result['cp_email_user'];
        }
        $cc2 = $getdata_email->cp_user_email;
        emailSaveData($subject , $body ,$to , $cc , $cc2);

        //************************************ZONE***SEND****EMAIL*************************************//

        }else{

        $sqlget_ccemail = "SELECT cp_email_user FROM complaint_email WHERE default_cp_external='1' || default_sd='1' ";

        $sqlget_query = $this->db->query($sqlget_ccemail);



            $subject = "New Complaint";

            $body = "<h3>New Complaint for Validation.</h3>";

            $body .= "<strong>Complaint No. : </strong>&nbsp;&nbsp;" . $getdata_email->cp_no . "&nbsp;&nbsp;<strong>Date : </strong>&nbsp;&nbsp;" .$condate. "<br>";

            $body .= "<strong>Topic : </strong>&nbsp;&nbsp;" . $getdata_email->topic_name . "&nbsp;&nbsp;<strong>Category : </strong>&nbsp;&nbsp;" . $getdata_email->topic_cat_name . "<br>";

            $body .= "<strong>Status : </strong>&nbsp;&nbsp;" . $getdata_email->cp_status_name . "<br><br>";



            $body .= "<strong style='font-size:18px;font-weight:600;'>Priority</strong><br>";

            foreach ($this->get_pri_view($get_cp_no) as $getpv) {

                $body .= "<strong>" . $getpv['pricat_name'] . ": </strong>&nbsp;&nbsp;" . $getpv['pri_name'] . "<br>";

            }

            $body .= "<strong> Priority Level : </strong>&nbsp;&nbsp;" . "<br>";

            $body .= "<br>";



            $body .= "<strong style='font-size:18px;font-weight:600;'>User Information</strong><br>";

            $body .= "<strong>Complaint Person :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_name . "&nbsp;&nbsp;<strong>Employee ID :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_empid . "&nbsp;&nbsp;<strong>Department :</strong>&nbsp;&nbsp;" . $getdata_email->cp_user_dept . "<br><br>";



            $body .= "<strong style='font-size:18px;font-weight:600;'>Details of Complaint / Damages</strong><br>";

            $body .= "<strong>Customer Name :</strong>&nbsp;&nbsp;" . $getdata_email->cp_cus_name . "&nbsp;&nbsp;<strong>Customer Ref : </strong>&nbsp;&nbsp;" . $getdata_email->cp_cus_ref . "&nbsp;&nbsp;<strong>Invoice Number : </strong>&nbsp;&nbsp;" . $getdata_email->cp_invoice_no . "<br>";

            $body .= "<strong>Product Code :</strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_code . "&nbsp;&nbsp;<strong>Lot No : </strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_lotno . "&nbsp;&nbsp;<strong>Quantity : </strong>&nbsp;&nbsp;" . $getdata_email->cp_pro_qty . "<br>";

            $body .= "<strong>Complaint Detail : </strong>&nbsp;&nbsp;" . $getdata_email->cp_detail . "<br>";



            $body .= "<strong>Link Attached File : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/asset/add/$getdata_email->cp_file>" . $getdata_email->cp_file . "</a>" . "<br>";



            $body .= "<strong>Link Program : </strong>&nbsp;&nbsp;" . "<a href=http://intranet.saleecolour.com/intsys/complaint/complaint/investigate/" . $get_cp_no . ">" . "Go to Page</a>";





            $mail = new PHPMailer();

            $mail->IsSMTP();

            $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้

            $mail->SMTPDebug = 1;                                      // set mailer to use SMTP

            $mail->Host = "mail.saleecolour.net";  // specify main and backup server

            //        $mail->Host = "smtp.gmail.com";

            $mail->Port = 587; // พอร์ท

            //        $mail->SMTPSecure = 'tls';

            $mail->SMTPAuth = true;     // turn on SMTP authentication

            $mail->Username = "complaint_system@saleecolour.net";  // SMTP username

            //websystem@saleecolour.com

            //        $mail->Username = "chainarong039@gmail.com";

            $mail->Password = "ComPlaint*1234"; // SMTP password

            //Ae8686#

            //        $mail->Password = "ShctBkk1";



            $mail->From = "complaint_system@saleecolour.net";

            $mail->FromName = "Complaint System";

            foreach ($query->result_array() as $fetch) {

                $mail->AddAddress($fetch['email']);

            }



            $mail->AddCC($getdata_email->cp_user_email);

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

            $mail->send();

            //************************************ZONE***SEND****EMAIL*************************************//

        }

        foreach ($check_email->result_array() as $get_check_email){
            $ar= array(
                "cp_mail_active" => "0"
            );

            $calldept = $get_check_email['cp_dept_main_code'];
            $this->db->where("deptcode",$calldept);
            $this->db->update("maillist",$ar);
        }
    }

}

