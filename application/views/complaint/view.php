<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Complaint</title>
    </head>
    <body>
        <?php $this->load->view("head/nav"); ?>

        <div class="container-fulid" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">
            <form name="frmMain" action="<?php echo base_url('history/add_history/'); ?><?php echo $view_cp['cp_no']; ?>" method="post" enctype="multipart/form-data">
            <h1 class="h1_view">View Complaint : <?php echo $view_cp['cp_no']; ?></h1>
            <input hidden="" type="text" name="get_oldcp" id="get_oldcp" value="<?php echo $view_cp['cp_no_old']; ?>"/><!--Check cp_no old-->
            <h3 class="h1_view" id="view_oldcp"></h3>
            <div class="btn_back">
                <a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a>&nbsp;
                <input type="submit" name="edit" id="edit" class="btn btn-warning btn-sm btn_back" onclick="javascript:return confirm('ท่านยืนยันที่จะเข้าไปแก้ไขข้อมูล ใช่ หรือ ไม่');" value="Edit"/>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Basic Information</div>
                <div class="panel-body">

                    <div class="form-row">
                        <div class="col-md-3">
                            <label><b>ID :</b></label>
                            <label><?php echo $view_cp['cp_no']; ?></label>
                            <input hidden="" type="text" name="history_cpno" id="history_cpno" value="<?php echo $view_cp['cp_no']; ?>" />
                        </div>
                        <div class="col-md-3">
                            <label><b>Date :</b></label>
                            <label><?php
                            $date = date_create($view_cp['cp_date']);
                            echo date_format($date, "d-m-Y");
                            ?></label>
                            <input hidden="" type="text" name="history_cpdate" id="history_cpdate" value="<?php echo $view_cp['cp_date']; ?>" />
                        </div>


                        <div class="col-md-3">
                            <label><b>Topic :</b></label>
                            <label id="cp_topic"><?php echo $view_cp['topic_name']; ?></label>
                            <input hidden="" type="text" name="history_cptopic" id="history_cptopic" value="<?php echo $view_cp['cp_topic']; ?>" />
                        </div>


                        <div class="col-md-3">
                            <label><b>Category :</b></label>
                            <label><?php echo $view_cp['topic_cat_name']; ?></label>
                            <input type="text" name="cp_topic_cat" id="cp_topic_cat" hidden="" value="<?php echo $view_cp['topic_cat_name']; ?>" />
                            <input type="text" name="history_cptopiccat" id="history_cptopiccat" hidden="" value="<?php echo $view_cp['cp_topic_cat']; ?>" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3">
                            <label><b>Complaint Person :</b></label>
                            <label><?php echo $view_cp['cp_user_name']; ?></label>
                            <input hidden="" type="text" name="history_cpusername" id="history_cpusername" value="<?php echo $view_cp['cp_user_name'] ?>" />
                        </div>
                        <div class="col-md-3">
                            <label><b>Employee ID :</b></label>
                            <label><?php echo $view_cp['cp_user_empid']; ?></label>
                            <input hidden="" type="text" name="history_cpuserempid" id="history_cpuserempid" value="<?php echo $view_cp['cp_user_empid']; ?>" />
                        </div>
                        <div class="col-md-3">
                            <label><b>Department :</b></label>
                            <label><?php echo $view_cp['cp_user_dept']; ?></label>
                            <input hidden="" type="text" name="history_cpuserdept" id="history_cpuserdept" value="<?php echo $view_cp['cp_user_dept']; ?>" />
                        </div>
                        <div class="col-md-3">
                            <label><b>Status :</b></label>
                            <label><b style="color:blue;"><?php echo $view_cp['cp_status_name']; ?></b></label>
                            <input hidden="" type="text" name="history_cpstatus" id="history_cpstatus" value="<?php echo $view_cp['cp_status_code']; ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Priority</div>
                <div class="panel-body">

                    <div class="form-row col-md-12">
                        <?php foreach ($get_pri_use as $gpu): ?>
                        <div class="col-md-3 m_pri">
                            <label><b><?php echo $gpu['pricat_name']; ?></b></label>
                            <label><?php echo $gpu['pri_name']; ?></label>

                            <input hidden="" type="text" name="history_cppritopic" id="history_cppritopic" value="<?php echo $gpu['pricat_name']; ?>" />
                            <input hidden="" type="text" name="history_cppriname" id="history_cppriname" value="<?php echo $gpu['pri_name']; ?>" />
                        </div>
                        <?php endforeach;?>
                    </div>



                </div>

                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?php // $total = $total / 7 ; ?>
                            <div class="input-group ">
                            <span class="input-group-addon">Total Score</span>
                            <input readonly="" class="form-control" type="text" name="sumscore" id="sumscore" value="<?php echo $view_cp['cp_priority']; ?>"/>
                            </div>
                        </div>

                    <div class="col-md-6">

                            <div class="input-group ">
                            <span class="input-group-addon">Priority Level</span>
                            <?php

                                   $number =  $view_cp['cp_priority'];
                                   if($number >= 1 && $number <= 1.5){
                                       $level = "Very Low";
                                   }else if ($number >= 1.6 && $number <= 2.5){
                                       $level = "Low";
                                   }else if ($number >= 2.6 && $number <= 3.5){
                                       $level = "Normal";
                                   }else if ($number >= 3.6 && $number <= 4.5){
                                       $level = "Height";
                                   }else{
                                       $level = "Very Height";
                                   }
                            ?>
                            <input readonly="" class="form-control" type="text" name="sumscore" id="sumscore" value="<?php echo $level; ?>"/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Details of Complaint / Damages</div>
                <div class="panel-body">

                    <div class="form-row">
                        <div class="col-md-3" id="h_username">
                            <label><b>Customer Name :</b></label>
                            <label><?php echo $view_cp['cp_cus_name']; ?></label>
                            <input hidden="" type="text" name="history_cpcusname" id="history_cpcusname" value="<?php echo $view_cp['cp_cus_name']; ?>" />
                        </div>

                        <div class="col-md-3" id="h_cusref">
                            <label><b>Customer Ref. :</b></label>
                            <label><?php echo $view_cp['cp_cus_ref']; ?></label>
                            <input hidden="" type="text" name="history_cpcusref" id="history_cpcusref" value="<?php echo $view_cp['cp_cus_ref']; ?>"/>
                        </div>

                        <div class="col-md-3" id="h_inv">
                            <label><b>Invoice Number :</b></label>
                            <label><?php echo $view_cp['cp_invoice_no']; ?></label>
                            <input hidden="" type="text" name="history_cpinvoiceno" id="history_cpinvoiceno" value="<?php echo $view_cp['cp_invoice_no']; ?>" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3" id="h_procode">
                            <label><b>Product Code :</b></label>
                            <label><?php echo $view_cp['cp_pro_code']; ?></label>
                            <input hidden="" type="text" name="history_cpprocode" id="history_cpprocode" value="<?php echo $view_cp['cp_pro_code']; ?>" />
                        </div>

                        <div class="col-md-3" id="h_lotno">
                            <label><b>Lot No. :</b></label>
                            <label><?php echo $view_cp['cp_pro_lotno']; ?></label>
                            <input hidden="" type="text" name="history_cpprolotno" id="history_cpprolotno" value="<?php echo $view_cp['cp_pro_lotno']; ?>" />
                        </div>

                        <div class="col-md-3" id="h_qty">
                            <label><b>Quantity :</b></label>
                            <label><?php echo $view_cp['cp_pro_qty']; ?></label>
                            <input hidden="" type="text" name="history_cpproqty" id="history_cpproqty" value="<?php echo $view_cp['cp_pro_qty']; ?>" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <label><b>Detail of complaint :</b></label>
                            <textarea readonly="" class="form-control" rows="5" name="detail_of_complaint" id="detail_of_compltint"><?php echo $view_cp['cp_detail']; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                                <label><b>Attached file :</b></label>
                                <label><a href="<?php echo base_url("asset/add/".$view_cp['cp_file']); ?>" target="_blank"><?php echo $view_cp['cp_file']; ?></a></label>
                                <input hidden="" type="text" name="history_cpfile" id="history_cpfile" value="<?php echo $view_cp['cp_file']; ?>" />
                        </div>
                        <div class="col-md-6">
                            <label><b>Related Department.</b></label>
                            <?php foreach ($get_dept as $gdn): ?>
                            &nbsp;<label class="check_dept_view"><?php echo $gdn['Dept']; ?></label>&nbsp;,
                            <input hidden="" type="text" name="history_dept" id="history_dept" value="<?php echo $gdn['Dept']; ?>" />

                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php  /*********************Check Related Dept*************************/
                    $ckd_result = 0;
                        foreach ($get_dept as $check_dept){
                            if($check_dept['cp_dept_code'] !== $getuser['DeptCode']){
                                continue;
                            }
                            $ckd_result = 1;
                        }
                    ?>

                    <input hidden="" type="text" name="check_dept_view" id="check_dept_view" value="<?php echo $ckd_result;?>" />

                    <!-- user zone -->
                    <input hidden="" type="text" name="his_user_modify" id="his_user_modify" value="<?php echo $getuser['username']; ?>" />
                    <input hidden="" type="text" name="his_date_modify" id="his_date_modify" value="<?php echo date("Y/m/d H:i:s"); ?>" />
                    <input hidden="" type="text" name="his_action" id="his_action" value="Click Edit Button" />

                </div>
            </div>
              </form>
            <div class="btn_start_inves result_pms">
                <a href="<?php echo base_url(); ?>complaint/inves_starting/<?php echo $view_cp['cp_no']; ?>"><button name="btn_v_cp" id="btn_v_cp" onclick="javascript:return confirm('คุณต้องการเริ่มการสืบสวนใช่หรือไม่');" class="btn btn-primary">Start Investigation</button></a>
            </div>
            <a href="<?php echo base_url("complaint/cancel_complaint/"); ?><?php echo $view_cp['cp_no']; ?>"><button id="cancle_btn" class="btn btn-danger" style="margin-bottom: 5px;">Cancel Complaint</button></a>

            <footer>
              <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
            </footer>



</div><!-- Main content page -->



    </body>
</html>
