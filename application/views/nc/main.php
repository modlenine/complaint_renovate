<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ใบรายงานปัญหา / ข้อบกพร่อง NC</title>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    </head>
    <body>
        <?php
        $this->load->view("head/nav");
        ?>

        <div class="container-fulid" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;"><!-- Start main container -->
            <h1>ใบรายงานปัญหา / ข้อบกพร่อง NC</h1><br>
            <h4>Complaint : <?php echo $getdatamain->cp_no; ?>&nbsp;&nbsp;&nbsp;NC Status :&nbsp;<span class="fontfix"><?php echo $getdatamain->cp_status_name; ?></span></h4><hr>

            <div class="btn_back">
                <a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a>
                <button class="btn btn-success btn-sm btn_back" onclick="myFunction()"><i class="fas fa-print"></i>&nbsp;Print</button>
            </div>

            <script>
function myFunction() {
  window.print();
}
</script>

            <div class="panel panel-primary"><!--SECTION 1-->
                <div class="panel-heading">1. รายละเอียดปัญหา/ข้อบกพร่อง สำหรับผู้พบปัญหา</div>
                <div class="panel-body">
                    <p><label class="ncmain_s1_label">เรียน ผู้จัดการฝ่าย &nbsp;<?php echo $getdatamain->cp_dept_main_name; ?></label></p>
                    <p class="gdmcp_hover"><label class="ncmain_s1_label">Transform Complaint No.</label>&nbsp;
                        <a href="<?php echo base_url("complaint/investigate/"); ?><?php echo $getdatamain->cp_no; ?>" target="_blank"><label data-toggle="tooltip" title="คลิกที่นี่เพื่อดู Complaint ต้นฉบับ"><i class="fas fa-book-open"></i>&nbsp;<?php echo $getdatamain->cp_no; ?></label></a>
                    </p>

                    <p><label class="ncmain_s1_label">Category</label>&nbsp;<label><?php echo $getdatamain->topic_cat_name; ?></label>&nbsp;&nbsp;<label class="ncmain_s1_label">Topic</label>&nbsp;<label><?php echo $getdatamain->topic_name; ?></label></p>
                    <!-- Check topic category  -->
                    <input hidden type="text" name="check_tecnical" id="check_tecnical" value="<?php echo $getdatamain->topic_cat_name; ?>">

                    <p><label class="ncmain_s1_label">Detail of Complaint / Damage</label>&nbsp;<label><?php echo $getdatamain->cp_detail; ?></label></p>
                    <p><label class="ncmain_s1_label">Detail of Investigate</label>&nbsp;<label><?php echo $getdatamain->cp_detail_inves; ?></label></p>
                    <p><label class="ncmain_s1_label">Summary of Investigate</label>&nbsp;<label><?php echo $getdatamain->cp_sum_inves; ?></label></p>
                    <p><label class="ncmain_s1_label">Priority Level</label>&nbsp;<label><?php echo $this->complaint_model->conpriority($getdatamain->cp_priority); ?></label></p>


                </div>
                <?php
                $date = date_create($getdatamain->cp_date);
                $condate = date_format($date, "d/m/Y");

                $date2 = date_create($getdatamain->cp_sum_inves_date);
                $condate2 = date_format($date2, "d/m/Y");
                ?>
                <div class="panel-footer">
                    <p><label class="ncmain_s1_label">ผู้แจ้ง : </label>&nbsp;<label><?php echo $getdatamain->cp_user_name; ?></label>&nbsp;|&nbsp;
                        <label class="ncmain_s1_label">วันที่แจ้ง :</label>&nbsp;<label><?php echo $condate; ?></label>&nbsp;|&nbsp;
                        <label class="ncmain_s1_label">ผู้อนุมัติ :</label>&nbsp;<label><?php echo $getdatamain->cp_sum_inves_signature; ?></label>&nbsp;|&nbsp;
                        <label class="ncmain_s1_label">วันที่อนุมัติ :</label>&nbsp;<label><?php echo $condate2; ?></label></p>
                </div>
            </div>


            <div class="panel panel-primary"><!--SECTION 2-->
                <div class="panel-heading">2. สำหรับฝ่ายบริหาร (พิจารณาและกำหนดฝ่ายที่รับผิดชอบ แล้วส่งให้ MR. ดำเนินการ)</div>
                <div class="panel-body">
                    <p><label class="ncmain_s1_label">ฝ่ายที่รับผิดชอบในการปฎิบัติการแก้ไขและป้องกันปัญหา ได้แก่ : </label>
                            <label><?php echo $getdatamain->cp_dept_main_name; ?></label>&nbsp;
                            <input type="text" name="check_related_deptcode" id="check_related_deptcode" value="<?php echo $getdatamain->nc_related_dept; ?>">
                    </p>

                    <?php
                    $ckd_result = 0;

                        if ($getdatamain->nc_related_dept == $getuser['DeptCode']) {
                          $ckd_result = 1;
                        }


                    ?>
                    <input hidden="" type="text" name="check_qmr" id="check_qmr" value="<?php echo $getuser['Dept']; ?>" /><!--Check qmr-->
                    <input hidden="" type="text" name="check_permit" id="check_permit" value="<?php echo $ckd_result; ?>"/><!-- Check permission -->
                </div>
                <div class="panel-footer">
                    <p><label class="ncmain_s1_label">ลงชื่อฝ่ายบริหาร : </label>&nbsp;<label><?php echo $getdatamain->cp_sum_inves_signature; ?></label>&nbsp;|&nbsp;<label class="ncmain_s1_label">วันที่ : </label>&nbsp;<label><?php echo $condate2; ?></label>

                    </p>
                </div>
            </div>




            <!-- *********************************SECTION**3**AREA******************************************************* -->

            <div class="panel panel-primary"><!--SECTION 3-->


                <div class="panel-heading">3. สำหรับฝ่ายที่รับผิดชอบให้หาสาเหตุ. วิธีแก้ไขและป้องกันและกำหนดแผนการปฎิบัติการแก้ไข</div>
                <div class="panel-body">

                    <form name="sec1" method="post" action="<?php echo base_url("nc/save_sec3/"); ?><?php echo $getdatamain->nc_no; ?>/<?php echo $getdatamain->nc_related_dept; ?>" enctype="multipart/form-data">
                        <span style="font-size: 18px;">Corrective</span><hr>
                        <div class="col-md-12" style="margin-bottom: 20px;">

                            <div class="form-group col-md-12">
                                <label>3.1 สาเหตุ</label>
                                <textarea class="form-control" rows="5" name="nc_sec31" id="nc_sec31"><?php echo $getdatamain->nc_sec31; ?></textarea>
                            </div>


                            <div class="form-group col-md-12">
                                <label>3.2 วิธีแก้ไข</label>
                                <textarea class="form-control" rows="5" name="nc_sec32" id="nc_sec32"><?php echo $getdatamain->nc_sec32; ?></textarea>
                                <label style="margin-top: 5px;">กำหนดเสร็จ</label>
                                <div class="form-inline">

                                    <?php
                                    $date1 = date_create($getdatamain->nc_sec32date);
                                    $result_date = date_format($date1, "d/m/Y H:i:s");

                                    $date_2 = date_create($getdatamain->nc_sec33date);
                                    $result_date2 = date_format($date_2, "d/m/Y H:i:s");
                                    ?>
                                    <input class="form-control" type="text" name="datetime32show" id="datetime32show" value="<?php echo $result_date; ?>"/><!--test countdown-->
                                    <span id="dateshow32" class="showdate3text"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="dateshow_text32" class="showdate3text"></span><!-- Show Countdown time -->
                                </div>

                                <div class='input-group date showdate32' id='datetimepicker32'>
                                    <input type='datetime' class="form-control" name="datetime32" id="datetime32" value="<?php echo $getdatamain->nc_sec32date; ?>"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div><!-- Input type datetime -->

                            </div>
                        </div>

                        <span style="font-size: 18px;">Preventive</span><hr>
                        <div class="col-md-12">
                        <div class="form-group col-md-12">
                            <label>3.3 วิธีป้องกัน ( Action Plan )</label>
                            <textarea class="form-control" rows="5" name="nc_sec33" id="nc_sec33"><?php echo $getdatamain->nc_sec33; ?></textarea>
                            <label style="margin-top: 5px;">กำหนดเสร็จ</label>
                            <div class="form-inline">
    <!--                            <input type="date" name="nc_sec33date" id="nc_sec33date" class="form-control" value="<?php echo $getdatamain->nc_sec33date; ?>"/>
                                <input type="time" name="nc_sec33time" id="nc_sec33time" class="form-control" value="<?php echo $getdatamain->nc_sec33time; ?>"/>-->

                                <input class="form-control" type="text" name="datetime33show" id="datetime33show" value="<?php echo $result_date2; ?>"/><!--test countdown-->
                                <span id="dateshow33" class="showdate3text"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="dateshow_text33" class="showdate3text"></span><!-- Show Countdown time -->

                            </div>

                            <div class='input-group date showdate33' id='datetimepicker33'>
                                <input type='datetime' class="form-control" name="datetime33" id="datetime33" value="<?php echo $getdatamain->nc_sec33date; ?>"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div><!-- Input type datetime -->

                             <label style="margin-top: 5px;">เอกสารประกอบ</label>
                            <input type="file" class="form-control" name="nc_sec3file" id="nc_sec3file" value="<?php echo $getdatamain->nc_sec3file; ?>"/>

                            <label id="get_nc_sec3file">&nbsp;&nbsp;<a href="<?php echo base_url("asset/nc/sec3/"); ?><?php echo $getdatamain->nc_sec3file; ?>" target="_blank"><?php echo $getdatamain->nc_sec3file; ?></a></label>
                            <span style="color:red;font-size:12px;">Max file size = 10MB and word , pdf only</span><br>

                            <input type="submit" name="sec3save" id="sec3save" class="btn btn-primary" style="margin-top: 10px;"/>

                        </div>
                        </div>
                        <input hidden="" type="text" name="nc_sec3owner" id="nc_sec3owner" value="<?php echo $getuser['username']; ?>" />
                        <input hidden="" type="text" name="nc_sec3empid" id="nc_sec3empid" value="<?php echo $getuser['ecode']; ?>"/>
                        <input hidden="" type="text" name="nc_sec3dept" id="nc_sec3dept" value="<?php echo $getuser['Dept']; ?>"/>
                        <input hidden="" type="text" name="nc_sec3date" id="nc_sec3date" value="<?php echo date("Y-m-d"); ?>"/>
                        <input type="text" name="check_related_deptcode_s3" id="check_related_deptcode_s3" value="<?php echo $getdatamain->nc_related_dept; ?>"> <!-- Check related dept code -->

                    </form>


                    <div class="col-md-10">
                        <form name="sec1" method="post" action="<?php echo base_url("history/savenc_sec3_history/"); ?><?php echo $getdatamain->cp_no; ?>/<?php echo $getdatamain->nc_related_dept; ?>" enctype="multipart/form-data">
                            <input hidden="" type="text" name="his_cpno" id="his_cpno" value="<?php echo $getdatamain->cp_no; ?>" />
                            <input hidden="" type="text" name="his_nc_sec31" id="his_nc_sec31" value="<?php echo $getdatamain->nc_sec31; ?>" />
                            <input hidden="" type="text" name="his_nc_sec32" id="his_nc_sec32" value="<?php echo $getdatamain->nc_sec32; ?>" />
                            <input hidden="" type="text" name="his_nc_sec32date" id="his_nc_sec32date" value="<?php echo $getdatamain->nc_sec32date; ?>" />

                            <input hidden="" type="text" name="his_nc_sec33" id="his_nc_sec33" value="<?php echo $getdatamain->nc_sec33; ?>" />
                            <input hidden="" type="text" name="his_nc_sec33date" id="his_nc_sec33date" value="<?php echo $getdatamain->nc_sec33date; ?>" />

                            <input hidden="" type="text" name="his_nc_sec3owner" id="his_nc_sec3owner" value="<?php echo $getdatamain->nc_sec3owner; ?>" />
                            <input hidden="" type="text" name="his_nc_sec3empid" id="his_nc_sec3empid" value="<?php echo $getdatamain->nc_sec3empid; ?>" />
                            <input hidden="" type="text" name="his_nc_sec3dept" id="his_nc_sec3dept" value="<?php echo $getdatamain->nc_sec3dept; ?>" />
                            <input hidden="" type="text" name="his_nc_sec3date" id="his_nc_sec3date" value="<?php echo $getdatamain->nc_sec3date; ?>" />
                            <input hidden="" type="text" name="his_nc_sec3file" id="his_nc_sec3file" value="<?php echo $getdatamain->nc_sec3file; ?>" />

                            <input hidden="" type="text" name="his_action" id="his_action" value="Start Edit NC Sec3" />
                            <input hidden="" type="text" name="his_user_modify" id="his_user_modify" value="<?php echo $getuser['username']; ?>" />
                            <input hidden="" type="text" name="his_date_modify" id="his_date_modify" value="<?php echo date("Y/m/d H:i:s") ?>" />
                            <a href="<?php echo base_url("nc/nc_sec3edit/"); ?><?php echo $getdatamain->cp_no; ?>"><button class="btn btn-warning" name="btn_sec3edit" id="btn_sec3edit">Edit</button></a>
                        </form>

                    </div>

                </div>

                <div class="panel-footer">
                    <?php if ($getdatamain->nc_sec31 == "") { ?>
                        <label>ผู้รับผิดชอบ : </label>&nbsp;<label><?php echo $getuser['username']; ?></label> | <label>รหัสพนักงาน : </label>&nbsp;<label><?php echo $getuser['ecode']; ?></label> | <label>แผนก : </label><label><?php echo $getuser['Dept']; ?></label> | <label>วันที่ : </label><label><?php echo date("d/m/Y"); ?></label>
                    <?php } else { ?>
                        <label>ผู้รับผิดชอบ : </label>&nbsp;<label><?php echo $getdatamain->nc_sec3owner; ?></label> | <label>รหัสพนักงาน : </label>&nbsp;<label><?php echo $getdatamain->nc_sec3empid; ?></label> | <label>แผนก : </label><label><?php echo $getdatamain->nc_sec3dept; ?></label> | <label>วันที่ : </label><label>
                            <?php
                            $date = date_create($getdatamain->nc_sec3date);
                            echo date_format($date, "d/m/Y");
                            ?>
                        </label>
                    <?php } ?>
                </div>



            </div><!-- SECTION 3 -->




            <!-- *********************************SECTION**3**AREA*********************************** -->








            <!-- *********************************SECTION**4***AREA************************************ -->
            <div class="panel panel-primary"><!--SECTION 4-->
                <div class="panel-heading">4. สำหรับฝ่ายที่เกี่ยวข้อง (เพื่อติดตามและปิดสรุป)</div>
                <div class="panel-body">

                    <div class="form-group col-md-12">
                      <!-- ติดตามผลครั้งที่ 1 -->
                        <form name="sec4f1" method="post" action="<?php echo base_url("nc/save_sec4f1/"); ?><?php echo $getdatamain->nc_no; ?>/<?php echo $getdatamain->nc_related_dept; ?>" enctype="multipart/form-data">
                            <label>ผลการติดตามครั้งที่ 1</label>
                            <textarea class="form-control" rows="5" name="nc_sec4f1" id="nc_sec4f1"><?php echo $getdatamain->nc_sec4f1; ?></textarea>
                            <label style="margin-top: 5px;">เอกสารประกอบ</label>
                            <input type="file" class="form-control" name="nc_sec4f1_file" id="nc_sec4f1_file" value="<?php echo $getdatamain->nc_sec4f1_file; ?>"/>

                            <label id="get_nc_sec4f1_file">&nbsp;:&nbsp;<a href="<?php echo base_url("asset/nc/sec4/f1/"); ?><?php echo $getdatamain->nc_sec4f1_file; ?>" target="_blank"><?php echo $getdatamain->nc_sec4f1_file; ?></a></label>
                            <span style="color:red;font-size:12px;">Max file size = 10MB and word , pdf only</span>

                            <div class="form-inline" style="margin-top: 5px;">
                                <input type="radio" name="nc_sec4f1_status" id="nc_sec4f1_status_yes" value="yes"/>&nbsp;<label>ปิดสรุป</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="nc_sec4f1_status" id="nc_sec4f1_status_no" value="no"/>&nbsp;<label>ไม่ปิดสรุป</label>
                            </div>

                            <input hidden="" type="text" name="nc_sec4f1_radiocheck" id="nc_sec4f1_radiocheck" value="<?php echo $getdatamain->nc_sec4f1_status; ?>" /><!-- radio check -->

                            <?php
                            $date41 = date_create($getdatamain->nc_sec4f1_date);
                            $result_date41 = date_format($date41, "d/m/Y H:i:s");

                            $date42 = date_create($getdatamain->nc_sec4f2_date);
                            $result_date42 = date_format($date42, "d/m/Y H:i:s");
                            ?>
                            <label id="label4f1">การติดตามผลครั้งที่ 2</label>
                            <div class="form-inline">
                                <input type="text" class="form-control" name="datetime41show" id="datetime41show" value="<?php echo $result_date41; ?>"/>
                                <span id="dateshow41" class="showdate3text"></span><!-- Show Countdown time -->

                                <div class='input-group date showdate41' id='datetimepicker41'>
                                    <input type='datetime' class="form-control" name="datetime41" id="datetime41" value="<?php echo $getdatamain->nc_sec4f1_date; ?>"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div><!-- Input type datetime -->

                                <input type="submit" class="btn btn-primary" name="btn_sec4f1" id="btn_sec4f1"/>
                            </div>

                            <label style="margin-top: 5px;">ลงชื่อผู้ติดตาม</label>
                            <div class="form-inline">
                                <input readonly="" type="text" name="nc_sec4f1_signature" id="nc_sec4f1_signature" class="form-control" value="<?php echo $getuser['Fname']; ?>"/>
                            </div>


                            <label class="sec4label">สำหรับ qmr เท่านั้น</label>
                            <hr>
                        </form>
                    </div>


                    <!-- ติดตามผลครั้งที่ 2 -->
                    <div class="form-group col-md-12">
                        <form name="sec4f2" method="post" action="<?php echo base_url("nc/save_sec4f2/"); ?><?php echo $getdatamain->cp_no; ?>/<?php echo $getdatamain->nc_related_dept; ?>" enctype="multipart/form-data">
                            <label>ผลการติดตามครั้งที่ 2</label>
                            <textarea class="form-control" rows="5" name="nc_sec4f2" id="nc_sec4f2"><?php echo $getdatamain->nc_sec4f2; ?></textarea>
                            <label style="margin-top: 5px;">เอกสารประกอบ</label>
                            <input type="file" class="form-control" name="nc_sec4f2_file" id="nc_sec4f2_file" value="<?php echo $getdatamain->nc_sec4f2_file; ?>"/>
                            <label id="get_nc_sec4f2_file">&nbsp;:&nbsp;<a href="<?php echo base_url("asset/nc/sec4/f2/"); ?><?php echo $getdatamain->nc_sec4f2_file; ?>" target="_blank"><?php echo $getdatamain->nc_sec4f2_file; ?></a></label>
                            <span style="color:red;font-size:12px;">Max file size = 1MB and word , pdf only</span>
                            <div class="form-inline" style="margin-top: 5px;">
                                <input type="radio" name="nc_sec4f2_status" id="nc_sec4f2_status_yes" value="yes"/>&nbsp;<label>ปิดสรุป</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="nc_sec4f2_status" id="nc_sec4f2_status_no" value="no"/>&nbsp;<label>ไม่ปิดสรุป</label>
                            </div>

                            <input hidden="" type="text" name="nc_sec4f2_radiocheck" id="nc_sec4f2_radiocheck" value="<?php echo $getdatamain->nc_sec4f2_status; ?>" /><!-- radio check -->

                            <label id="label4f2">การติดตามผลครั้งที่ 3</label>
                            <div class="form-inline">
                                <input type="text" class="form-control" name="datetime42show" id="datetime42show" value="<?php echo $result_date42; ?>"/>
                                <span id="dateshow42" class="showdate3text"></span><!-- Show Countdown time -->

                                <div class='input-group date showdate42' id='datetimepicker42'>
                                    <input type="datetime" class="form-control" name="datetime42" id="datetime42" value="<?php echo $getdatamain->nc_sec4f2_date; ?>"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div><!-- Input type datetime -->

                                <input type="submit" class="btn btn-primary" name="btn_sec4f2" id="btn_sec4f2"/>
                            </div>

                            <label style="margin-top: 5px;">ลงชื่อผู้ติดตาม</label>
                            <div class="form-inline">
                                <input readonly="" type="text" name="nc_sec4f2_signature" id="nc_sec4f2_signature" class="form-control" value="<?php echo $getuser['Fname']; ?>"/>
                            </div>

                            <label class="sec4label">สำหรับ qmr เท่านั้น</label>
                            <hr>
                            <input hidden="" type="text" name="nc_status_sec4f2" id="nc_status_sec4f2" value="nc04" /><!-- Status -->
                        </form>
                    </div>


                    <!-- ติดตามผลครั้งที่ 3 -->
                    <div class="form-group col-md-12">
                        <form name="sec4f3" method="post" action="<?php echo base_url("nc/save_sec4f3/"); ?><?php echo $getdatamain->cp_no; ?>/<?php echo $getdatamain->nc_related_dept; ?>" enctype="multipart/form-data">
                            <label>ผลการติดตามครั้งที่ 3</label>
                            <textarea class="form-control" rows="5" name="nc_sec4f3" id="nc_sec4f3"><?php echo $getdatamain->nc_sec4f3; ?></textarea>
                            <label style="margin-top: 5px;">เอกสารประกอบ</label>
                            <input type="file" class="form-control" name="nc_sec4f3_file" id="nc_sec4f3_file" value="<?php echo $getdatamain->nc_sec4f2_file; ?>"/>
                            <label id="get_nc_sec4f3_file">&nbsp;:&nbsp;<a href="<?php echo base_url("asset/nc/sec4/f3/"); ?><?php echo $getdatamain->nc_sec4f3_file; ?>" target="_blank"><?php echo $getdatamain->nc_sec4f3_file; ?></a></label>

                            <span style="color:red;font-size:12px;">Max file size = 1MB and word , pdf only</span>
                            <div class="form-inline" style="margin-top: 5px;">
                                <input type="radio" name="nc_sec4f3_status" id="nc_sec4f3_status_yes" value="yes"/>&nbsp;<label>ปิดสรุป</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="nc_sec4f3_status" id="nc_sec4f3_status_no" value="no"/>&nbsp;<label>ไม่ปิดสรุป</label><br>

                                <input hidden="" type="text" name="nc_sec4f3_radiocheck" id="nc_sec4f3_radiocheck" value="<?php echo $getdatamain->nc_sec4f3_status; ?>" /><!-- radio check -->

                                <label style="margin-top: 5px;">ลงชื่อผู้ติดตาม</label>
                                <div class="form-inline">
                                    <input readonly="" type="text" name="nc_sec4f3_signature" id="nc_sec4f3_signature" class="form-control" value="<?php echo $getuser['Fname']; ?>"/>
                                </div>

                                <label class="sec4label">สำหรับ qmr เท่านั้น</label>
                            </div>
                            <input type="submit" class="btn btn-primary" name="btn_sec4f3" id="btn_sec4f3"/>

                            <input hidden="" type="text" name="getdeptcode" id="getdeptcode" value="<?php echo $getuser['DeptCode']; ?>"/>
                        </form>
                        <input hidden="" type="text" name="checkstatus_failed" id="checkstatus_failed" value="<?php echo $getdatamain->nc_status_code; ?>" />

                        <form name="sec4f3" method="post" action="<?php echo base_url("nc/create_cpfailed/"); ?><?php echo $getdatamain->cp_no; ?>" enctype="multipart/form-data">
                            <button class="btn btn-danger" name="btn_cre_new" id="btn_cre_new">Create New Complaint</button>
                            <input hidden="" type="text" name="getdeptcode" id="getdeptcode" value="<?php echo $getuser['DeptCode']; ?>"/><br>
                            <label class="sec4label" id="label_cre_new">กรุณากดปุ่มนี้เพื่อทำการออก Complaint ใหม่เนื่องจากไม่สามารถปิดสรุปได้</label>
                        </form>

                    </div>


                </div>
            </div>
<!-- *********************************SECTION***4******AREA************************************ -->



<!-- *********************************SECTION5****AREA**************************************-->
<?php
if ($getdatamain->nc_sec4f3_status == "no") {
    $ncfailed = "( Failed )";
    $baseurl = "nc/save_sec5failed/";
} else {
    $ncfailed = "";
    $baseurl = "nc/save_sec5/";
}

if ($getdatamain->nc_status_code == "nc10") {
    $show = $getdatamain->nc_sec5failed;
    $showfile = $getdatamain->nc_sec5filefailed;
    $showcost = $getdatamain->nc_sec5costfailed;
} else {
    $show = $getdatamain->nc_sec5;
    $showfile = $getdatamain->nc_sec5_file;
    $showcost = $getdatamain->nc_sec5cost;

}
?>
            <div class="panel panel-primary"><!--SECTION 5-->
                <div class="panel-heading">5. Conclusion Of NC <?php echo $ncfailed; ?></div>
                <div class="panel-body">
                    <form name="sec4f2" method="post" action="<?php echo base_url($baseurl); ?><?php echo $getdatamain->nc_no; ?>/<?php echo $getdatamain->nc_related_dept; ?>" enctype="multipart/form-data">
                        <div class="form-group col-md-10">
                            <label>Conclusion Of NC</label>
                            <textarea class="form-control" rows="5" name="nc_sec5" id="nc_sec5"><?php echo $show; ?></textarea>
                            <label style="margin-top: 5px;">เอกสารประกอบ</label>
                            <input type="file" class="form-control" name="nc_sec5file" id="nc_sec5file" value="<?php echo $showfile; ?>"/>
                            <span style="color:red;font-size:12px;">Max file size = 1MB and word , pdf only</span>
                            <label id="get_nc_sec5_file">&nbsp;:&nbsp;<a href="<?php echo base_url("asset/nc/sec5/"); ?><?php echo $showfile; ?>" target="_blank"><?php echo $showfile; ?></a></label><br>


                            <div class="form-row">
                    <div class="col-md-7 pri">
                        <label><b>รายละเอียดค่าใช้จ่าย</b></label>
                        <input type="text" name="nc_sec5cost_detail" id="nc_sec5cost_detail" class="form-control form-control-sm" value="<?php echo $getdatamain->nc_sec5cost_detail; ?>"/>
                    </div>
                    <div class="col-md-5 pri">
                        <label><b>ค่าใช้จ่ายที่เกิดขึ้น</b></label>
                        <div class="input-group">
                            <input type="text" name="nc_sec5cost" id="nc_sec5cost" class="form-control form-control-sm number" value="<?php echo $showcost ?>"/>
                        <span class="input-group-addon">บาท</span>
                        </div>
                    </div>
                </div>


<!--                            <label style="margin-top: 5px;">ค่าใช้จ่ายที่เกิดขึ้น โดยประมาณ</label>
                            <div class="form-inline">
                                <input type="text" class="form-control" name="nc_sec5cost" id="nc_sec5cost" value="<?php echo $showcost; ?>"/>&nbsp;<label>บาท</label>
                            </div>-->


                            <label class="sec4label">สำหรับ qmr เท่านั้น</label>
                        </div>
                        <div class="col-md-10">
                            <input type="submit" class="btn btn-primary" name="btn_sec5" id="btn_sec5"/>
                        </div>
                        <input hidden="" type="text" name="nc_status_sec5" id="nc_status_sec5" value="nc11" /><!-- Status -->
                        <input hidden="" type="text" name="getdeptcode" id="getdeptcode" value="<?php echo $getuser['DeptCode']; ?>"/>
                    </form>


                </div>

            </div>
            <!-- *********************************SECTION5****AREA**************************************-->
            <script>
                $(document).ready(function () {

                var days;
                    /****************************COUNTDOWN***SEC32******************************************/
                    // Set the date we're counting down to
                    //var countDownDate = new Date("2019-03-12 09:37:25").getTime();
                    var countDownDate = new Date($('#datetime32').val()).getTime();

                    // Update the count down every 1 second
                    var x = setInterval(function () {

                        // Get todays date and time
                        var now = new Date().getTime();

                        // Find the distance between now and the count down date
                        var distance = countDownDate - now;

                        // Time calculations for days, hours, minutes and seconds
                        days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);


                        document.getElementById("dateshow32").innerHTML = days + "d " + hours + "h "
                                + minutes + "m " + seconds + "s ";



                        // If the count down is over, write some text
                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("dateshow_text32").innerHTML = "เกินระยะเวลาที่กำหนด";
                            $('#dateshow32').hide();
                        }
                        if ($('#nc_sec4f1_radiocheck').val() == "yes") {
                            clearInterval(x);
                            document.getElementById("dateshow_text32").innerHTML = "ดำเนินการเรียบร้อยแล้ว";
                            $('#dateshow32').hide();
                        }else if($('#nc_sec4f1_radiocheck').val() == "no"){
                            clearInterval(x);
                            document.getElementById("dateshow_text32").innerHTML = "จบการติดตามครั้งที่1";
                            $('#dateshow32').hide();
                        }
                        if ($('#nc_sec4f2_radiocheck').val() == "yes") {
                            clearInterval(x);
                            document.getElementById("dateshow_text32").innerHTML = "ดำเนินการเรียบร้อยแล้ว";
                            $('#dateshow32').hide();
                        }else if($('#nc_sec4f2_radiocheck').val() == "no"){
                            clearInterval(x);
                            document.getElementById("dateshow_text32").innerHTML = "จบการติดตามครั้งที่2";
                            $('#dateshow32').hide();
                        }
                        if ($('#nc_sec4f3_radiocheck').val() == "yes") {
                            clearInterval(x);
                            document.getElementById("dateshow_text32").innerHTML = "ดำเนินการเรียบร้อยแล้ว";
                            $('#dateshow32').hide();
                        }
//                        if (days == 3) {
//                            document.getElementById("dateshow_text32").innerHTML = "จะส่ง Email แจ้งเตือนแล้วนะ";
//                        }


                    }, 1000);


                    var days2;
                    /*********************COUNTDOWN****SEC33********************************************************/
                    // Set the date we're counting down to
                    //var countDownDate = new Date("2019-03-12 09:37:25").getTime();
                    var countDownDate2 = new Date($('#datetime33').val()).getTime();

                    // Update the count down every 1 second
                    var x2 = setInterval(function () {

                        // Get todays date and time
                        var now2 = new Date().getTime();

                        // Find the distance between now and the count down date
                        var distance2 = countDownDate2 - now2;

                        // Time calculations for days, hours, minutes and seconds
                        days2 = Math.floor(distance2 / (1000 * 60 * 60 * 24));
                        var hours2 = Math.floor((distance2 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes2 = Math.floor((distance2 % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds2 = Math.floor((distance2 % (1000 * 60)) / 1000);


                            // Output the result in an element with id="demo"
                        document.getElementById("dateshow33").innerHTML = days2 + "d " + hours2 + "h "
                                + minutes2 + "m " + seconds2 + "s ";



                        // If the count down is over, write some text
                        if (distance2 < 0) {
                            clearInterval(x2);
                            document.getElementById("dateshow_text33").innerHTML = "เกินระยะเวลาที่กำหนด";
                            $('#dateshow33').hide();
                        }

                        if ($('#nc_sec4f1_radiocheck').val() == "yes") {
                            clearInterval(x2);
                            document.getElementById("dateshow_text33").innerHTML = "ดำเนินการเรียบร้อยแล้ว";
                            $('#dateshow33').hide();
                        }else if($('#nc_sec4f1_radiocheck').val() == "no"){
                            clearInterval(x2);
                            document.getElementById("dateshow_text33").innerHTML = "จบการติดตามครั้งที่1";
                            $('#dateshow33').hide();
                        }
                        if ($('#nc_sec4f2_radiocheck').val() == "yes") {
                            clearInterval(x2);
                            document.getElementById("dateshow_text33").innerHTML = "ดำเนินการเรียบร้อยแล้ว";
                            $('#dateshow33').hide();
                        }else if($('#nc_sec4f2_radiocheck').val() == "no"){
                            clearInterval(x2);
                            document.getElementById("dateshow_text33").innerHTML = "จบการติดตามครั้งที่2";
                            $('#dateshow33').hide();
                        }
                        if ($('#nc_sec4f3_radiocheck').val() == "yes") {
                            clearInterval(x2);
                            document.getElementById("dateshow_text33").innerHTML = "ดำเนินการเรียบร้อยแล้ว";
                            $('#dateshow33').hide();
                        }
//                        if (days2 == 3) {
//                            document.getElementById("dateshow_text33").innerHTML = "จะส่ง Email แจ้งเตือนแล้วนะ";
//                        }


                    }, 1000);




                    var day41_32 , total41_32 , day41_33 , total41_33;
                    /*********************COUNTDOWN****SEC41********************************************************/
                    // Set the date we're counting down to
                    //var countDownDate = new Date("2019-03-12 09:37:25").getTime();
                    var countDownDate41 = new Date($('#datetime41').val()).getTime();

                    // Update the count down every 1 second
                    var x41 = setInterval(function () {

                        // Get todays date and time
                        var now41 = new Date().getTime();

                        // Find the distance between now and the count down date
                        var distance41 = countDownDate41 - now41;

                        // Time calculations for days, hours, minutes and seconds
                        var days41 = Math.floor(distance41 / (1000 * 60 * 60 * 24));
                        var hours41 = Math.floor((distance41 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes41 = Math.floor((distance41 % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds41 = Math.floor((distance41 % (1000 * 60)) / 1000);


                        // Output the result in an element with id="demo"
                        document.getElementById("dateshow41").innerHTML = days41 + "d " + hours41 + "h "
                                + minutes41 + "m " + seconds41 + "s ";


                        // If the count down is over, write some text
                        if (distance41 < 0) {
                            clearInterval(x41);
                            document.getElementById("dateshow41").innerHTML = "เกินระยะเวลาที่กำหนด";
                        }
                        if ($('#nc_sec4f1_radiocheck').val() == "yes" || $('#nc_sec4f3_radiocheck').val() !== "") {
                            clearInterval(x41);
                            document.getElementById("dateshow41").innerHTML = "เสร็จสิ้นการติดตาม";
                        }else if ($('#nc_sec4f1_radiocheck').val() == "no"){
                            clearInterval(x41);
                            document.getElementById("dateshow41").innerHTML = "กำลังดำเนินการติดตามครั้งที่2";
                        }



                    }, 1000);


                    var day42_32 , total42_32 , day42_33 , total42_33;
                    /*********************COUNTDOWN****SEC42********************************************************/
                    // Set the date we're counting down to
                    //var countDownDate = new Date("2019-03-12 09:37:25").getTime();
                    var countDownDate42 = new Date($('#datetime42').val()).getTime();

                    // Update the count down every 1 second
                    var x42 = setInterval(function () {

                        // Get todays date and time
                        var now42 = new Date().getTime();

                        // Find the distance between now and the count down date
                        var distance42 = countDownDate42 - now42;

                        // Time calculations for days, hours, minutes and seconds
                        var days42 = Math.floor(distance42 / (1000 * 60 * 60 * 24));
                        var hours42 = Math.floor((distance42 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes42 = Math.floor((distance42 % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds42 = Math.floor((distance42 % (1000 * 60)) / 1000);


                        // Output the result in an element with id="demo"
                        document.getElementById("dateshow42").innerHTML = days42 + "d " + hours42 + "h "
                                + minutes42 + "m " + seconds42 + "s ";



                        // If the count down is over, write some text
                        if (distance42 < 0) {
                            clearInterval(x42);
                            document.getElementById("dateshow42").innerHTML = "เกินระยะเวลาที่กำหนด";
                        }
                        if ($('#nc_sec4f2_radiocheck').val() == "yes" || $('#nc_sec4f3_radiocheck').val() !== "") {
                            clearInterval(x42);
                            document.getElementById("dateshow42").innerHTML = "เสร็จสิ้นการติดตาม";
                        }else if($('#nc_sec4f2_radiocheck').val() == "no"){
                            clearInterval(x42);
                            document.getElementById("dateshow42").innerHTML = "กำลังดำเนินการติดตามครั้งที่3";
                        }



                    }, 1000);

                    /*****************FUNCTION**COUNTDOWN******************************/
                    $(function () {
                        $('#datetimepicker32').datetimepicker({
                            format: 'YYYY/MM/DD HH:mm'
                        });

                        $('#datetimepicker33').datetimepicker({
                            format: 'YYYY/MM/DD HH:mm'
                        });

                        $('#datetimepicker41').datetimepicker({
                            format: 'YYYY/MM/DD HH:mm'
                        });

                        $('#datetimepicker42').datetimepicker({
                            format: 'YYYY/MM/DD HH:mm'
                        });

                    });


                });
            </script>


            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
        </div><!--End Main container-->
    </body>
</html>
