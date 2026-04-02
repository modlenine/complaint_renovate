<?php
class emailfn{
    public $ci;
    function __construct()
    {
        $this->ci = &get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }
    public function gci()
    {
        return $this->ci;
    }
}



function emailobj()
{
    $obj = new emailfn();
    return $obj->gci();
}



function getEmailUser()
{
    $query = emailobj()->db->query("SELECT * FROM email_information");
    return $query->row();
}



function emailSaveData($subject , $body ,$to = "", $cc = "" , $cc2 = "")
{
    require("PHPMailer_5.2.0/class.phpmailer.php");

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
    $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
    $mail->Host = "mail.saleecolour.net";  // specify main and backup server

    $mail->Port = 587; // พอร์ท

    $mail->SMTPAuth = true;     // turn on SMTP authentication
    $mail->Username = getEmailUser()->email_user;  // SMTP username

    $mail->Password = getEmailUser()->email_password; // SMTP password

    $mail->From = getEmailUser()->email_user;
    $mail->FromName = "Complaint System";


    if($to != ""){
        foreach($to as $email){
            $mail->AddAddress($email);
        }
    }



    if($cc != ""){
        foreach($cc as $email){
            $mail->AddCC($email);
        }
    }

    if($cc2 != ""){
        $mail->AddCC($cc2);
    }


    

    // $mail->AddAddress("chainarong_k@saleecolour.com");
    $mail->AddBCC("chainarong_k@saleecolour.com");
    // $mail->AddCC("chainarong_k@saleecolour.onmicrosoft.com");

    $mail->WordWrap = 50;                                 // set word wrap to 50 characters
    $mail->IsHTML(true);                                  // set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = '
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Sarabun&display=swap");

        h3{
            font-family: Tahoma, sans-serif;
            font-size:14px;
        }

        table {
            font-family: Tahoma, sans-serif;
            font-size:14px;
            border-collapse: collapse;
            width: 90%;
          }
          
          td, th {
            border: 1px solid #ccc;
            text-align: left;
            padding: 8px;
          }
          
          tr:nth-child(even) {
            background-color: #F5F5F5;
          }

          .bghead{
              text-align:center;
              background-color:#D3D3D3;
          }
        </style>
    '.$body;
    

    if($_SERVER['HTTP_HOST'] != "localhost"){
        $mail->send();
    }

    // $mail->send();
}



// Get Data For use Advance send Email
function getDataForEmail_adv($formcode , $formno)
{
    if($formcode != "" && $formno != ""){
        $sql = emailobj()->db->query("SELECT
        wdf_master.wdf_autoid,
        wdf_master.wdf_formno,
        wdf_master.wdf_formcode,
        wdf_master.wdf_areaid,
        wdf_master.wdf_doctype,
        wdf_master.wdf_status,
        wdf_master.wdf_memo,
        wdf_master.wdf_userreceive,
        wdf_master.wdf_userreceived_detail,
        wdf_master.wdf_vat1,
        wdf_master.wdf_vat2,
        wdf_master.wdf_pricenonevat,
        wdf_master.wdf_pricevat1,
        wdf_master.wdf_pricevat2,
        wdf_master.wdf_pricewithvat,
        wdf_master.wdf_vat1_clear,
        wdf_master.wdf_vat2_clear,
        wdf_master.wdf_pricenonevat_clear,
        wdf_master.wdf_pricevat1_clear,
        wdf_master.wdf_pricevat2_clear,
        wdf_master.wdf_pricewithvat_clear,
        wdf_master.wdf_user,
        wdf_master.wdf_ecode,
        wdf_master.wdf_deptcode,
        wdf_master.wdf_dept,
        wdf_master.wdf_datetime,
        wdf_master.wdf_bg_creditlimit,
        wdf_master.wdf_bg_memo,
        wdf_master.wdf_bg_user,
        wdf_master.wdf_bg_dept,
        wdf_master.wdf_bg_ecode,
        wdf_master.wdf_bg_deptcode,
        wdf_master.wdf_bg_datetime,
        wdf_master.wdf_mgr_appr,
        wdf_master.wdf_mgr_memo,
        wdf_master.wdf_mgr_user,
        wdf_master.wdf_mgr_dept,
        wdf_master.wdf_mgr_deptcode,
        wdf_master.wdf_mgr_datetime,
        wdf_master.wdf_paygroup,
        wdf_master.wdf_appgroup,
        wdf_master.wdf_areaidgroup,
        wdf_master.wdf_ap_appr,
        wdf_master.wdf_ap_memo,
        wdf_master.wdf_ap_moneymethod,
        wdf_master.wdf_ap_user,
        wdf_master.wdf_ap_dept,
        wdf_master.wdf_ap_deptcode,
        wdf_master.wdf_ap_ecode,
        wdf_master.wdf_ap_datetime,
        wdf_master.wdf_acc_appr,
        wdf_master.wdf_acc_memo,
        wdf_master.wdf_acc_user,
        wdf_master.wdf_acc_dept,
        wdf_master.wdf_acc_deptcode,
        wdf_master.wdf_acc_ecode,
        wdf_master.wdf_acc_datetime,
        wdf_master.wdf_fn_appr,
        wdf_master.wdf_fn_memo,
        wdf_master.wdf_fn_user,
        wdf_master.wdf_fn_dept,
        wdf_master.wdf_fn_deptcode,
        wdf_master.wdf_fn_ecode,
        wdf_master.wdf_fn_datetime,
        wdf_master.wdf_ur_signature,
        wdf_master.wdf_ur_memo,
        wdf_master.wdf_ur_user,
        wdf_master.wdf_ur_dept,
        wdf_master.wdf_ur_deptcode,
        wdf_master.wdf_ur_ecode,
        wdf_master.wdf_ur_datetime,
        wdf_master.wdf_urc_money,
        wdf_master.wdf_urc_memo,
        wdf_master.wdf_urc_user,
        wdf_master.wdf_urc_dept,
        wdf_master.wdf_urc_deptcode,
        wdf_master.wdf_urc_ecode,
        wdf_master.wdf_urc_datetime,
        wdf_master.wdf_urc_datetime_modify,
        wdf_master.wdf_fnc_stepcode,
        wdf_master.wdf_fnc_method,
        wdf_master.wdf_fnc_money,
        wdf_master.wdf_fnc_appgroup,
        wdf_master.wdf_fnc_appr,
        wdf_master.wdf_fnc_memo,
        wdf_master.wdf_fnc_user,
        wdf_master.wdf_fnc_dept,
        wdf_master.wdf_fnc_deptcode,
        wdf_master.wdf_fnc_ecode,
        wdf_master.wdf_fnc_datetime,
        wdf_master.wdf_apc_stepcode,
        wdf_master.wdf_apc_appr,
        wdf_master.wdf_apc_memo,
        wdf_master.wdf_apc_user,
        wdf_master.wdf_apc_dept,
        wdf_master.wdf_apc_deptcode,
        wdf_master.wdf_apc_ecode,
        wdf_master.wdf_apc_datetime,
        wdf_master.wdf_accc_stepcode,
        wdf_master.wdf_accc_appr,
        wdf_master.wdf_accc_memo,
        wdf_master.wdf_accc_user,
        wdf_master.wdf_accc_dept,
        wdf_master.wdf_accc_deptcode,
        wdf_master.wdf_accc_ecode,
        wdf_master.wdf_accc_datetime,
        wdf_master.wdf_mgrc_stepcode,
        wdf_master.wdf_mgrc_appr,
        wdf_master.wdf_mgrc_memo,
        wdf_master.wdf_mgrc_user,
        wdf_master.wdf_mgrc_dept,
        wdf_master.wdf_mgrc_deptcode,
        wdf_master.wdf_mgrc_ecode,
        wdf_master.wdf_mgrc_datetime,
        wdf_master.wdf_paygroup_clear,
        wdf_master.wdf_appgroup_clear,
        wdf_master.wdf_areaidgroup_clear,
        wdf_master.wdf_fnc2_stepcode,
        wdf_master.wdf_fnc2_appr,
        wdf_master.wdf_fnc2_memo,
        wdf_master.wdf_fnc2_user,
        wdf_master.wdf_fnc2_dept,
        wdf_master.wdf_fnc2_deptcode,
        wdf_master.wdf_fnc2_ecode,
        wdf_master.wdf_fnc2_datetime,
        wdf_master.wdf_urc2_signature,
        wdf_master.wdf_urc2_memo,
        wdf_master.wdf_urc2_user,
        wdf_master.wdf_urc2_dept,
        wdf_master.wdf_urc2_deptcode,
        wdf_master.wdf_urc2_ecode,
        wdf_master.wdf_urc2_datetime,
        wdf_master.wdf_clearingstatus
        FROM
        wdf_master
        WHERE wdf_formcode = '$formcode' AND wdf_formno = '$formno'
        ");

        if($sql->num_rows() != 0){
            return $sql->row();
        }
    }
}

function getDataForEmail($formcode , $formno , $doctype)
{
    if($formcode != "" && $formno != ""){
        $sql = emailobj()->db->query("SELECT
        wdf_master.wdf_autoid,
        wdf_master.wdf_formno,
        wdf_master.wdf_formcode,
        wdf_master.wdf_areaid,
        wdf_master.wdf_doctype,
        wdf_master.wdf_status,
        wdf_master.wdf_memo,
        wdf_master.wdf_userreceive,
        wdf_master.wdf_userreceived_detail,
        wdf_master.wdf_vat1,
        wdf_master.wdf_vat2,
        wdf_master.wdf_pricenonevat,
        wdf_master.wdf_pricevat1,
        wdf_master.wdf_pricevat2,
        wdf_master.wdf_pricewithvat,
        wdf_master.wdf_vat1_clear,
        wdf_master.wdf_vat2_clear,
        wdf_master.wdf_pricenonevat_clear,
        wdf_master.wdf_pricevat1_clear,
        wdf_master.wdf_pricevat2_clear,
        wdf_master.wdf_pricewithvat_clear,
        wdf_master.wdf_user,
        wdf_master.wdf_ecode,
        wdf_master.wdf_deptcode,
        wdf_master.wdf_dept,
        wdf_master.wdf_datetime,
        wdf_master.wdf_bg_creditlimit,
        wdf_master.wdf_bg_memo,
        wdf_master.wdf_bg_user,
        wdf_master.wdf_bg_dept,
        wdf_master.wdf_bg_ecode,
        wdf_master.wdf_bg_deptcode,
        wdf_master.wdf_bg_datetime,
        wdf_master.wdf_mgr_appr,
        wdf_master.wdf_mgr_memo,
        wdf_master.wdf_mgr_user,
        wdf_master.wdf_mgr_dept,
        wdf_master.wdf_mgr_deptcode,
        wdf_master.wdf_mgr_datetime,
        wdf_master.wdf_paygroup,
        wdf_master.wdf_appgroup,
        wdf_master.wdf_areaidgroup,
        wdf_master.wdf_ap_appr,
        wdf_master.wdf_ap_memo,
        wdf_master.wdf_ap_moneymethod,
        wdf_master.wdf_ap_user,
        wdf_master.wdf_ap_dept,
        wdf_master.wdf_ap_deptcode,
        wdf_master.wdf_ap_ecode,
        wdf_master.wdf_ap_datetime,
        wdf_master.wdf_acc_appr,
        wdf_master.wdf_acc_memo,
        wdf_master.wdf_acc_user,
        wdf_master.wdf_acc_dept,
        wdf_master.wdf_acc_deptcode,
        wdf_master.wdf_acc_ecode,
        wdf_master.wdf_acc_datetime,
        wdf_master.wdf_fn_appr,
        wdf_master.wdf_fn_memo,
        wdf_master.wdf_fn_user,
        wdf_master.wdf_fn_dept,
        wdf_master.wdf_fn_deptcode,
        wdf_master.wdf_fn_ecode,
        wdf_master.wdf_fn_datetime,
        wdf_master.wdf_ur_signature,
        wdf_master.wdf_ur_memo,
        wdf_master.wdf_ur_user,
        wdf_master.wdf_ur_dept,
        wdf_master.wdf_ur_deptcode,
        wdf_master.wdf_ur_ecode,
        wdf_master.wdf_ur_datetime,
        wdf_master.wdf_urc_money,
        wdf_master.wdf_urc_memo,
        wdf_master.wdf_urc_user,
        wdf_master.wdf_urc_dept,
        wdf_master.wdf_urc_deptcode,
        wdf_master.wdf_urc_ecode,
        wdf_master.wdf_urc_datetime,
        wdf_master.wdf_urc_datetime_modify,
        wdf_master.wdf_fnc_stepcode,
        wdf_master.wdf_fnc_method,
        wdf_master.wdf_fnc_money,
        wdf_master.wdf_fnc_appgroup,
        wdf_master.wdf_fnc_appr,
        wdf_master.wdf_fnc_memo,
        wdf_master.wdf_fnc_user,
        wdf_master.wdf_fnc_dept,
        wdf_master.wdf_fnc_deptcode,
        wdf_master.wdf_fnc_ecode,
        wdf_master.wdf_fnc_datetime,
        wdf_master.wdf_apc_stepcode,
        wdf_master.wdf_apc_appr,
        wdf_master.wdf_apc_memo,
        wdf_master.wdf_apc_user,
        wdf_master.wdf_apc_dept,
        wdf_master.wdf_apc_deptcode,
        wdf_master.wdf_apc_ecode,
        wdf_master.wdf_apc_datetime,
        wdf_master.wdf_accc_stepcode,
        wdf_master.wdf_accc_appr,
        wdf_master.wdf_accc_memo,
        wdf_master.wdf_accc_user,
        wdf_master.wdf_accc_dept,
        wdf_master.wdf_accc_deptcode,
        wdf_master.wdf_accc_ecode,
        wdf_master.wdf_accc_datetime,
        wdf_master.wdf_mgrc_stepcode,
        wdf_master.wdf_mgrc_appr,
        wdf_master.wdf_mgrc_memo,
        wdf_master.wdf_mgrc_user,
        wdf_master.wdf_mgrc_dept,
        wdf_master.wdf_mgrc_deptcode,
        wdf_master.wdf_mgrc_ecode,
        wdf_master.wdf_mgrc_datetime,
        wdf_master.wdf_paygroup_clear,
        wdf_master.wdf_appgroup_clear,
        wdf_master.wdf_areaidgroup_clear,
        wdf_master.wdf_fnc2_stepcode,
        wdf_master.wdf_fnc2_appr,
        wdf_master.wdf_fnc2_memo,
        wdf_master.wdf_fnc2_user,
        wdf_master.wdf_fnc2_dept,
        wdf_master.wdf_fnc2_deptcode,
        wdf_master.wdf_fnc2_ecode,
        wdf_master.wdf_fnc2_datetime,
        wdf_master.wdf_urc2_signature,
        wdf_master.wdf_urc2_memo,
        wdf_master.wdf_urc2_user,
        wdf_master.wdf_urc2_dept,
        wdf_master.wdf_urc2_deptcode,
        wdf_master.wdf_urc2_ecode,
        wdf_master.wdf_urc2_datetime,
        wdf_master.wdf_clearingstatus
        FROM
        wdf_master
        WHERE wdf_formcode = '$formcode' AND wdf_formno = '$formno' AND wdf_doctype = '$doctype'
        ");

        if($sql->num_rows() != 0){
            return $sql->row();
        }
    }
}

function getDataAppGroup($formcode , $areaid)
{
    if($formcode != "" && $areaid != ""){
        $sql = emailobj()->db->query("SELECT
        wdf_appgroup,
        wdf_appgroup_clear
        FROM wdf_master
        WHERE wdf_formcode = '$formcode' AND wdf_areaid = '$areaid' 
        ");

        if($sql->num_rows() != 0){
            return $sql->row();
        }
    }
}

function getDataAppUser($appGroup , $formcode , $areaid)
{
    if($appGroup != "" && $formcode != "" && $areaid != ""){
        $sql = emailobj()->db->query("SELECT
        apv_group,
        apv_user,
        apv_ecode,
        apv_posiname,
        apv_email,
        apv_approve,
        apv_approve_memo,
        apv_approve_user,
        apv_approve_datetime
        FROM approve_user
        WHERE apv_group = '$appGroup' AND apv_formcode = '$formcode' AND apv_areaid = '$areaid' AND apv_type IS NULL ORDER BY apv_email ASC
        ");

        if($sql->num_rows() != 0){
            return $sql;
        }
    }
}

function getDataAppUserClear($appGroupClear , $formcode , $areaid)
{
    if($appGroupClear != "" && $formcode != "" && $areaid != ""){
        $sql = emailobj()->db->query("SELECT
        apv_group,
        apv_user,
        apv_ecode,
        apv_posiname,
        apv_email,
        apv_approve,
        apv_approve_memo,
        apv_approve_user,
        apv_approve_datetime
        FROM approve_user
        WHERE apv_group = '$appGroupClear' AND apv_formcode = '$formcode' AND apv_areaid = '$areaid' AND apv_type = 'Clear money' ORDER BY apv_email ASC
        ");

        if($sql->num_rows() != 0){
            return $sql;
        }
    }
}


function getDataApprovedUser($appGroup , $formcode , $areaid)
{
    if($appGroup != "" && $formcode != "" && $areaid != ""){
        $sql = emailobj()->db->query("SELECT
        apv_group,
        apv_user,
        apv_ecode,
        apv_posiname,
        apv_email,
        apv_approve,
        apv_approve_memo,
        apv_approve_user,
        apv_approve_datetime
        FROM approve_user
        WHERE apv_group = '$appGroup' AND apv_formcode = '$formcode' AND apv_areaid = '$areaid' AND apv_type IS NULL ORDER BY apv_email ASC
        ");

        if($sql->num_rows() != 0){
            return $sql;
        }
    }
}


function getDataApprovedUserClear($appGroupClear , $formcode , $areaid)
{
    if($appGroupClear != "" && $formcode != "" && $areaid != ""){
        $sql = emailobj()->db->query("SELECT
        apv_group,
        apv_user,
        apv_ecode,
        apv_posiname,
        apv_email,
        apv_approve,
        apv_approve_memo,
        apv_approve_user,
        apv_approve_datetime
        FROM approve_user
        WHERE apv_group = '$appGroupClear' AND apv_formcode = '$formcode' AND apv_areaid = '$areaid' AND apv_type = 'Clear money' ORDER BY apv_email ASC
        ");

        if($sql->num_rows() != 0){
            return $sql;
        }
    }
}


// Get Email Address
function getEmail_acc_BySection($section)
{
    if($section != ""){

        $sql = emailobj()->db->query("SELECT
        u_email,
        u_ecode,
        u_username
        FROM user_permission WHERE $section = 'yes'
        ");

        if($sql->num_rows() != 0){
            return $sql;
        }
    }
}

function getEmail_onMemberTbl($ecode)
{
    emailobj()->db2 = emailobj()->load->database('saleecolour', TRUE);
    if($ecode != ""){
        $sql = emailobj()->db2->query("SELECT
        memberemail,
        ecode
        FROM member
        WHERE ecode IN $ecode
        ");

        if($sql->num_rows() != 0){
            return $sql;
        }
    }
}

// function getEmail_manager($formcode , $formno , $userdeptcode , $areaid)
// {
//     emailobj()->db2 = emailobj()->load->database('saleecolour', TRUE);
//     if($areaid != "tb"){

//         $sql = emailobj()->db2->query("SELECT
//         memberemail,
//         ecode
//         FROM member
//         WHERE DeptCode = '$userdeptcode' AND posi in (55,75) AND resigned != 1
//         ");

//         if($sql->num_rows() != 0){
//             return $sql;
//         }
//     }else if($userdeptcode == 1007){
//         $sql = emailobj()->db2->query("SELECT
//         memberemail,
//         ecode
//         FROM member
//         WHERE ecode IN ('M0506' , 'M0040') AND resigned != 1
//         ");

//         if($sql->num_rows() != 0){
//             return $sql;
//         }
//     }else{
//         $sql = emailobj()->db2->query("SELECT
//         memberemail,
//         ecode
//         FROM member
//         WHERE ecode = 'M0051'
//         ");

//         if($sql->num_rows() != 0){
//             return $sql;
//         }
//     }
// }

function getEmail_manager($formcode , $formno , $userdeptcode , $areaid)
{
    $userareaid = getUser()->areaid;
    emailobj()->db2 = emailobj()->load->database('saleecolour', TRUE);
    if($areaid != "tb"){

        $sql = emailobj()->db2->query("SELECT
        memberemail,
        ecode
        FROM member
        WHERE DeptCode = '$userdeptcode' AND posi in (55,75) AND resigned != 1
        ");

        if($sql->num_rows() != 0){
            return $sql;
        }
    }else if($userdeptcode == 1007){

        if($userareaid != "st"){
            $sql = emailobj()->db2->query("SELECT
            memberemail,
            ecode
            FROM member
            WHERE ecode IN ('M0506' , 'M0040') AND resigned != 1
            ");
    
            if($sql->num_rows() != 0){
                return $sql;
            }
        }else if($userareaid == "st"){
            $sql = emailobj()->db2->query("SELECT
            memberemail,
            ecode
            FROM member
            WHERE ecode IN ('M2180') AND resigned != 1
            ");
    
            if($sql->num_rows() != 0){
                return $sql;
            }
        }

    }else{
        $sql = emailobj()->db2->query("SELECT
        memberemail,
        ecode
        FROM member
        WHERE ecode = 'M0051'
        ");

        if($sql->num_rows() != 0){
            return $sql;
        }
    }
}









?>