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
            <h1>ใบรายงานปัญหา / ข้อบกพร่อง NC ( Edit )</h1><h4>Complaint : <?php echo $getdatamain->cp_no; ?>&nbsp;&nbsp;&nbsp;NC Status :&nbsp;<span class="fontfix"><?php echo $getdatamain->cp_status_name; ?></span></h4><hr>

            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>


            <div class="panel panel-primary"><!--SECTION 3-->


                <div class="panel-heading">3. สำหรับฝ่ายที่รับผิดชอบให้หาสาเหตุ. วิธีแก้ไขและป้องกันและกำหนดแผนการปฎิบัติการแก้ไข</div>
                <div class="panel-body">

                    <form name="sec1" method="post" action="<?php echo base_url("nc/savenc_sec3edit/"); ?><?php echo $getdatamain->cp_no; ?>/<?php echo $getdatamain->nc_related_dept; ?>" enctype="multipart/form-data">

                        <input hidden="" type="text" name="his_cpno" id="his_cpno" value="<?php echo $getdatamain->cp_no; ?>" />

                    <div class="form-group col-md-12">
                        <label>3.1 สาเหตุ</label>
                        <textarea class="form-control" rows="5" name="nc_sec31edit" id="nc_sec31edit"><?php echo $getdatamain->nc_sec31; ?></textarea>
                    </div>


                    <div class="form-group col-md-12">
                        <label>3.2 วิธีแก้ไข</label>
                        <textarea class="form-control" rows="5" name="nc_sec32edit" id="nc_sec32edit"><?php echo $getdatamain->nc_sec32; ?></textarea>
                        <label style="margin-top: 5px;">กำหนดเสร็จ</label>
                        <div class="form-inline">
<!--                            <input type="date" name="nc_sec32dateedit" id="nc_sec32dateedit" class="form-control" style="width:30%;" value="<?php echo $getdatamain->nc_sec32date; ?>"/>
                            <input type="time" name="nc_sec32timeedit" id="nc_sec32timeedit" class="form-control" style="width:30%;" value="<?php echo $getdatamain->nc_sec32time; ?>"/>-->
                        </div>

                        <div class='col-md-6 input-group date' id='datetimepicker322'>
                            <input type='datetime' class="form-control" name="datetime1_edit" id="datetime1_edit" value="<?php echo $getdatamain->nc_sec32date; ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div><!-- Input type datetime -->

                    </div>


                    <div class="form-group col-md-12">
                        <label>3.3 วิธีป้องกัน</label>
                        <textarea class="form-control" rows="5" name="nc_sec33edit" id="nc_sec33edit"><?php echo $getdatamain->nc_sec33; ?></textarea>
                        <label style="margin-top: 5px;">กำหนดเสร็จ</label>
                        <div class="form-inline">
<!--                            <input type="date" name="nc_sec33dateedit" id="nc_sec33dateedit" class="form-control" style="width:30%;" value="<?php echo $getdatamain->nc_sec33date; ?>"/>
                            <input type="time" name="nc_sec33timeedit" id="nc_sec33timeedit" class="form-control" style="width:30%;" value="<?php echo $getdatamain->nc_sec33time; ?>"/>-->
                        </div>

                        <div class='col-md-6 input-group date' id='datetimepicker333'>
                            <input type='datetime' class="form-control" name="datetime2_edit" id="datetime2_edit" value="<?php echo $getdatamain->nc_sec33date; ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div><!-- Input type datetime -->


                        <label style="margin-top: 5px;">เอกสารประกอบ</label>
                            <input type="file" class="form-control" name="nc_sec3file_edit" id="nc_sec3file_edit" value="<?php echo $getdatamain->nc_sec3file; ?>"/>

                            <label id="get_nc_sec3file_edit">&nbsp;&nbsp;<a href="<?php echo base_url("asset/nc/sec3/"); ?><?php echo $getdatamain->nc_sec3file; ?>" target="_blank"><?php echo $getdatamain->nc_sec3file; ?></a></label>
                            <span style="color:red;font-size:12px;">Max file size = 10MB and word , pdf only</span><br>

                        <label style="margin-top:5px;">เหตุผลในการแก้ไขครั้งนี้</label>
                        <input type="text" name="nc_sec3edit_memo" id="nc_sec3edit_memo" value="" class="form-control" required=""/>


                        <input hidden="" type="text" name="nc_modify_by" id="nc_modify_by" value="<?php echo $getuser['username']; ?>" />
                        <input hidden="" type="text" name="nc_modify_date" id="nc_modify_date" value="<?php echo date("Y/m/d H:i:s") ?>" />

                        <input hidden="" type="text" name="his_action" id="his_action" value="Edit NC Sec3 Success" />

                        <input type="submit" name="sec3saveedit" id="sec3saveedit" class="btn btn-primary" style="margin-top: 10px;" value="Update" onclick="javascript:return confirm('คุณต้องการ บันทึกการแก้ไขครั้งนี้หรือไม่');"/>
                    </div>
                        <input hidden="" type="text" name="his_nc_sec3owner" id="his_nc_sec3owner" value="<?php echo $getdatamain->nc_sec3owner; ?>"/>
                        <input hidden="" type="text" name="his_nc_sec3empid" id="his_nc_sec3empid" value="<?php echo $getdatamain->nc_sec3empid; ?>"/>
                        <input hidden="" type="text" name="his_nc_sec3dept" id="his_nc_sec3dept" value="<?php echo $getdatamain->nc_sec3dept; ?>"/>
                        <input hidden="" type="text" name="his_nc_sec3date" id="his_nc_sec3date" value="<?php echo $getdatamain->nc_sec3date; ?>"/>
                        <input hidden type="text" name="old_nc_sec3file" id="old_nc_sec3file" value="<?php echo $getdatamain->nc_sec3file; ?>"/>

                        <input hidden="" type="text" name="his_user_modify" id="his_user_modify" value="<?php echo $getuser['username']; ?>" />
                        <input hidden="" type="text" name="his_date_modify" id="his_date_modify" value="<?php echo date("Y/m/d H:i:s") ?>" />

                    </form>

                </div>
                    <?php
                    $datesec3 = date_create($getdatamain->nc_sec3date);
                    $datesec3re = date_format($datesec3, "d-m-Y");
                    ?>
                <div class="panel-footer">
                    <label>ผู้รับผิดชอบ : </label>&nbsp;<label><?php echo $getdatamain->nc_sec3owner; ?></label> | <label>รหัสพนักงาน : </label>&nbsp;<label><?php echo $getdatamain->nc_sec3empid; ?></label> | <label>แผนก : </label><label><?php echo $getdatamain->nc_sec3dept; ?></label> | <label>วันที่ : </label><label><?php echo $datesec3re; ?></label>
                </div>



            </div>
            <script>
                $(function() {
  $('#datetimepicker322').datetimepicker({
            format: 'YYYY/MM/DD HH:mm'

  });

  $('#datetimepicker333').datetimepicker({
            format: 'YYYY/MM/DD HH:mm'

  });


});

            </script>



         <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
        </div><!--End Main container-->
    </body>
</html>
