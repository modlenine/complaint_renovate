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
    </head>
    <body>
        <?php
        $this->load->view("head/nav");
        ?>
        
        <div class="container" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;"><!-- Start main container -->
            <h1>ใบรายงานปัญหา / ข้อบกพร่อง NC</h1><br>
            <h3><?php echo $getdatamain->cp_no; ?></h3><hr>
            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
            
            
            <div class="panel panel-primary"><!--SECTION 1-->
                <div class="panel-heading">1. รายละเอียดปัญหา/ข้อบกพร่อง สำหรับผู้พบปัญหา</div>
                <div class="panel-body">
                    <p><label class="ncmain_s1_label">เรียน ผู้จัดการฝ่าย</label></p>
                    <p class="gdmcp_hover"><label class="ncmain_s1_label">Transform Complaint No.</label>&nbsp;
                        <a href="<?php echo base_url("complaint/investigate/"); ?><?php echo $getdatamain->cp_no; ?>" target="_blank"><label data-toggle="tooltip" title="คลิกที่นี่เพื่อดู Complaint ต้นฉบับ"><?php echo $getdatamain->cp_no; ?></label></a>
                    </p>
                    
                    
                    <p><label class="ncmain_s1_label">Detail of Complaint / Damage</label>&nbsp;<label><?php echo $getdatamain->cp_detail; ?></label></p>
                    <p><label class="ncmain_s1_label">Detail of Investigate</label>&nbsp;<label><?php echo $getdatamain->cp_detail_inves; ?></label></p>
                    <p><label class="ncmain_s1_label">Summary of Investigate</label>&nbsp;<label><?php echo $getdatamain->cp_sum_inves; ?></label></p>
<!--                    <p><label>Complaint ต้นฉบับ</label>&nbsp;<a href="<?php echo base_url("complaint/investigate/"); ?><?php echo $getdatamain->cp_no; ?>"><label><?php echo $getdatamain->cp_no; ?></label></a></p>-->
                    
                    
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
                        <?php foreach ($get_dept as $gdn): ?>
                            <label><?php echo $gdn['Dept'] . "&nbsp;,"; ?></label>&nbsp;
                        <?php endforeach; ?> 
                    </p>
                    
                    <?php
                    $ckd_result = 0;
                    foreach ($get_dept as $check_dept) {
                        if ($check_dept['cp_dept_code'] !== $getuser['DeptCode']) {
                            continue;
                        }
                        $ckd_result = 1;
                    }
                    ?>
                    
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
                    
                    <form name="sec1" method="post" action="<?php echo base_url("nc/save_sec3/"); ?><?php echo $getdatamain->cp_no; ?>" enctype="multipart/form-data">
                    <div class="form-group col-md-10">
                        <label>3.1 สาเหตุ</label>
                        <textarea class="form-control" rows="5" name="nc_sec31" id="nc_sec31"><?php echo $getdatamain->nc_sec31; ?></textarea>
                    </div>
                    
                    
                    <div class="form-group col-md-10">
                        <label>3.2 วิธีแก้ไข</label>
                        <textarea class="form-control" rows="5" name="nc_sec32" id="nc_sec32"><?php echo $getdatamain->nc_sec32; ?></textarea>
                        <label style="margin-top: 5px;">กำหนดเสร็จ</label>
                        <div class="form-inline">
                            <input type="date" name="nc_sec32date" id="nc_sec32date" class="form-control" value="<?php echo $getdatamain->nc_sec32date; ?>"/>
                            <input type="time" name="nc_sec32time" id="nc_sec32time" class="form-control" value="<?php echo $getdatamain->nc_sec32time; ?>"/>
                        </div>
                    </div>
                    
                    
                    <div class="form-group col-md-10">
                        <label>3.3 วิธีป้องกัน</label>
                        <textarea class="form-control" rows="5" name="nc_sec33" id="nc_sec33"><?php echo $getdatamain->nc_sec33; ?></textarea>
                        <label style="margin-top: 5px;">กำหนดเสร็จ</label>
                        <div class="form-inline">
                            <input type="date" name="nc_sec33date" id="nc_sec33date" class="form-control" value="<?php echo $getdatamain->nc_sec33date; ?>"/>
                            <input type="time" name="nc_sec33time" id="nc_sec33time" class="form-control" value="<?php echo $getdatamain->nc_sec33time; ?>"/>
                        </div>
                        <input type="submit" name="sec3save" id="sec3save" class="btn btn-primary" style="margin-top: 10px;"/>
                        
                    </div>
                    <input hidden="" type="text" name="nc_sec3owner" id="nc_sec3owner" value="<?php echo $getuser['username']; ?>" />
                <input hidden="" type="text" name="nc_sec3empid" id="nc_sec3empid" value="<?php echo $getuser['ecode'];?>"/>
                <input hidden="" type="text" name="nc_sec3dept" id="nc_sec3dept" value="<?php echo $getuser['Dept'];?>"/>
                <input hidden="" type="text" name="nc_sec3date" id="nc_sec3date" value="<?php echo date("Y-m-d"); ?>"/>
                </form>
                    
                    
                    <div class="col-md-10">
                        <form name="sec1" method="post" action="<?php echo base_url("history/savenc_sec3_history/"); ?><?php echo $getdatamain->cp_no; ?>" enctype="multipart/form-data">
                            <input hidden="" type="text" name="his_cpno" id="his_cpno" value="<?php echo $getdatamain->cp_no; ?>" />
                            <input hidden="" type="text" name="his_nc_sec31" id="his_nc_sec31" value="<?php echo $getdatamain->nc_sec31; ?>" />
                            <input hidden="" type="text" name="his_nc_sec32" id="his_nc_sec32" value="<?php echo $getdatamain->nc_sec32; ?>" />
                            <input hidden="" type="text" name="his_nc_sec32date" id="his_nc_sec32date" value="<?php echo $getdatamain->nc_sec32date; ?>" />
                            <input hidden="" type="text" name="his_nc_sec32time" id="his_nc_sec32time" value="<?php echo $getdatamain->nc_sec32time; ?>" />
                            <input hidden="" type="text" name="his_nc_sec33" id="his_nc_sec33" value="<?php echo $getdatamain->nc_sec33; ?>" />
                            <input hidden="" type="text" name="his_nc_sec33date" id="his_nc_sec33date" value="<?php echo $getdatamain->nc_sec33date; ?>" />
                            <input hidden="" type="text" name="his_nc_sec33time" id="his_nc_sec33time" value="<?php echo $getdatamain->nc_sec33time; ?>" />
                            <input hidden="" type="text" name="his_nc_sec3owner" id="his_nc_sec3owner" value="<?php echo $getdatamain->nc_sec3owner; ?>" />
                            <input hidden="" type="text" name="his_nc_sec3empid" id="his_nc_sec3empid" value="<?php echo $getdatamain->nc_sec3empid; ?>" />
                            <input hidden="" type="text" name="his_nc_sec3dept" id="his_nc_sec3dept" value="<?php echo $getdatamain->nc_sec3dept; ?>" />
                            <input hidden="" type="text" name="his_nc_sec3date" id="his_nc_sec3date" value="<?php echo $getdatamain->nc_sec3date; ?>" />

                            <input hidden="" type="text" name="his_action" id="his_action" value="Start Edit NC Sec3" />
                            <input hidden="" type="text" name="his_user_modify" id="his_user_modify" value="<?php echo $getuser['username']; ?>" />
                            <input hidden="" type="text" name="his_date_modify" id="his_date_modify" value="<?php echo date("Y/m/d H:i:s") ?>" />
                            <a href="<?php echo base_url("nc/nc_sec3edit/"); ?><?php echo $getdatamain->cp_no; ?>"><button class="btn btn-warning" name="btn_sec3edit" id="btn_sec3edit">Edit</button></a> 
                        </form>

                    </div>
                    
                </div>
                
                <div class="panel-footer">
                    <?php if($getdatamain->nc_sec31 == ""){ ?>
                    <label>ผู้รับผิดชอบ : </label>&nbsp;<label><?php echo $getuser['username']; ?></label> | <label>รหัสพนักงาน : </label>&nbsp;<label><?php echo $getuser['ecode']; ?></label> | <label>แผนก : </label><label><?php echo $getuser['Dept']; ?></label> | <label>วันที่ : </label><label><?php echo date("d/m/Y"); ?></label>
                    <?php }else{ ?>
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
                    
                    <div class="form-group col-md-10">
                        <form name="sec4f1" method="post" action="<?php echo base_url("nc/save_sec4f1/"); ?><?php echo $getdatamain->cp_no; ?>" enctype="multipart/form-data">
                        <label>ผลการติดตามครั้งที่ 1</label>
                        <textarea class="form-control" rows="5" name="nc_sec4f1" id="nc_sec4f1"><?php echo $getdatamain->nc_sec4f1; ?></textarea>
                        <label style="margin-top: 5px;">เอกสารประกอบ</label>
                        <input type="file" class="form-control" name="nc_sec4f1_file" id="nc_sec4f1_file" value="<?php echo $getdatamain->nc_sec4f1_file; ?>"/>
                        <label id="get_nc_sec4f1_file">&nbsp;:&nbsp;<a href="<?php echo base_url("asset/nc/sec4/f1/"); ?><?php echo $getdatamain->nc_sec4f1_file; ?>" target="_blank"><?php echo $getdatamain->nc_sec4f1_file; ?></a></label>
                        <div class="form-inline" style="margin-top: 5px;">
                            <input type="radio" name="nc_sec4f1_status" id="nc_sec4f1_status_yes" value="yes"/>&nbsp;<label>ปิดสรุป</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="nc_sec4f1_status" id="nc_sec4f1_status_no" value="no"/>&nbsp;<label>ไม่ปิดสรุป</label>
                        </div>
                        
                        <input hidden="" type="text" name="nc_sec4f1_radiocheck" id="nc_sec4f1_radiocheck" value="<?php echo $getdatamain->nc_sec4f1_status; ?>" /><!-- radio check -->
                        
                        <label>การติดตามผลครั้งที่ 2</label>
                        <div class="form-inline">
                            <input type="date" class="form-control" name="nc_sec4f1_date" id="nc_sec4f1_date" value="<?php echo $getdatamain->nc_sec4f1_date; ?>"/>
                            <input type="time" class="form-control" name="nc_sec4f1_time" id="nc_sec4f1_time" value="<?php echo $getdatamain->nc_sec4f1_time; ?>"/>
                            <input type="submit" class="btn btn-primary" name="btn_sec4f1" id="btn_sec4f1"/>
                        </div>
                        <label class="sec4label">สำหรับ qmr เท่านั้น</label>
                        <hr>
                        <input hidden="" type="text" name="nc_status_sec4f1" id="nc_status_sec4f1" value="Followup_1st" /><!-- Status -->
                        </form>
                    </div>
                    
                    <div class="form-group col-md-10">
                        <form name="sec4f2" method="post" action="<?php echo base_url("nc/save_sec4f2/"); ?><?php echo $getdatamain->cp_no; ?>" enctype="multipart/form-data">
                        <label>ผลการติดตามครั้งที่ 2</label>
                        <textarea class="form-control" rows="5" name="nc_sec4f2" id="nc_sec4f2"><?php echo $getdatamain->nc_sec4f2; ?></textarea>
                        <label style="margin-top: 5px;">เอกสารประกอบ</label>
                        <input type="file" class="form-control" name="nc_sec4f2_file" id="nc_sec4f2_file" value="<?php echo $getdatamain->nc_sec4f2_file; ?>"/>
                        <label id="get_nc_sec4f2_file">&nbsp;:&nbsp;<a href="<?php echo base_url("asset/nc/sec4/f2/"); ?><?php echo $getdatamain->nc_sec4f2_file; ?>" target="_blank"><?php echo $getdatamain->nc_sec4f2_file; ?></a></label>
                        <div class="form-inline" style="margin-top: 5px;">
                            <input type="radio" name="nc_sec4f2_status" id="nc_sec4f2_status_yes" value="yes"/>&nbsp;<label>ปิดสรุป</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="nc_sec4f2_status" id="nc_sec4f2_status_no" value="no"/>&nbsp;<label>ไม่ปิดสรุป</label>
                        </div>
                        
                        <input hidden="" type="text" name="nc_sec4f2_radiocheck" id="nc_sec4f2_radiocheck" value="<?php echo $getdatamain->nc_sec4f2_status; ?>" /><!-- radio check -->
                        
                        <label>การติดตามผลครั้งที่ 3</label>
                        <div class="form-inline">
                            <input type="date" class="form-control" name="nc_sec4f2_date" id="nc_sec4f2_date" value="<?php echo $getdatamain->nc_sec4f2_date; ?>"/>
                            <input type="time" class="form-control" name="nc_sec4f2_time" id="nc_sec4f2_time" value="<?php echo $getdatamain->nc_sec4f2_time; ?>"/>
                            <input type="submit" class="btn btn-primary" name="btn_sec4f2" id="btn_sec4f2"/>
                        </div>
                        <label class="sec4label">สำหรับ qmr เท่านั้น</label>
                        <hr>
                        <input hidden="" type="text" name="nc_status_sec4f2" id="nc_status_sec4f2" value="Followup_2nd" /><!-- Status -->
                        </form>
                    </div>
                           
                    <div class="form-group col-md-10">
                        <form name="sec4f3" method="post" action="<?php echo base_url("nc/save_sec4f3/"); ?><?php echo $getdatamain->cp_no; ?>" enctype="multipart/form-data">
                        <label>ผลการติดตามครั้งที่ 3</label>
                        <textarea class="form-control" rows="5" name="nc_sec4f3" id="nc_sec4f3"><?php echo $getdatamain->nc_sec4f3; ?></textarea>
                        <label style="margin-top: 5px;">เอกสารประกอบ</label>
                        <input type="file" class="form-control" name="nc_sec4f3_file" id="nc_sec4f3_file" value="<?php echo $getdatamain->nc_sec4f2_file; ?>"/>
                        <label id="get_nc_sec4f3_file">&nbsp;:&nbsp;<a href="<?php echo base_url("asset/nc/sec4/f3/"); ?><?php echo $getdatamain->nc_sec4f3_file; ?>" target="_blank"><?php echo $getdatamain->nc_sec4f3_file; ?></a></label>
                        <div class="form-inline" style="margin-top: 5px;">
                            <input type="radio" name="nc_sec4f3_status" id="nc_sec4f3_status_yes" value="yes"/>&nbsp;<label>ปิดสรุป</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="nc_sec4f3_status" id="nc_sec4f3_status_no" value="no"/>&nbsp;<label>ไม่ปิดสรุป</label><br>
                            
            <input hidden="" type="text" name="nc_sec4f3_radiocheck" id="nc_sec4f3_radiocheck" value="<?php echo $getdatamain->nc_sec4f3_status; ?>" /><!-- radio check -->
                            
                            <label class="sec4label">สำหรับ qmr เท่านั้น</label>
                        </div>
                        <input type="submit" class="btn btn-primary" name="btn_sec4f3" id="btn_sec4f3"/>
                        
                        <input hidden="" type="text" name="getdeptcode" id="getdeptcode" value="<?php echo $getuser['DeptCode']; ?>"/>
                        </form>
                        <input type="text" name="checkstatus_failed" id="checkstatus_failed" value="<?php echo $getdatamain->nc_status; ?>" />
                        
                        <form name="sec4f3" method="post" action="<?php echo base_url("nc/create_cpfailed/"); ?><?php echo $getdatamain->cp_no; ?>" enctype="multipart/form-data">
                            <button class="btn btn-danger">Create New Complaint</button>
                            <input hidden="" type="text" name="getdeptcode" id="getdeptcode" value="<?php echo $getuser['DeptCode']; ?>"/>
                        </form>

                    </div>
                    
                    
                </div>
            </div>
<!-- *********************************SECTION**4***AREA************************************ -->


            
<!-- *********************************SECTION5****AREA**************************************--> 
<?php  
    if($getdatamain->nc_sec4f3_status == "no"){
        $ncfailed = "( Failed )";
        $baseurl = "nc/save_sec5failed/";
    }else{$ncfailed= "";$baseurl = "nc/save_sec5/";}
    
    if($getdatamain->nc_status == "Conclusion of NC Failed!"){
        $show = $getdatamain->nc_sec5failed;
        $showfile = $getdatamain->nc_sec5filefailed;
        $showcost = $getdatamain->nc_sec5costfailed;
    }else{
        $show = $getdatamain->nc_sec5;
        $showfile = $getdatamain->nc_sec5file;
        $showcost = $getdatamain->nc_sec5cost;
    }
?>
            <div class="panel panel-primary"><!--SECTION 5-->
                <div class="panel-heading">5. Conclusion Of NC <?php echo $ncfailed; ?></div>
                <div class="panel-body">
                    <form name="sec4f2" method="post" action="<?php echo base_url($baseurl); ?><?php echo $getdatamain->cp_no; ?>" enctype="multipart/form-data">
                    <div class="form-group col-md-10">
                        <label>Conclusion Of NC</label>
                        <textarea class="form-control" rows="5" name="nc_sec5" id="nc_sec5"><?php echo $show; ?></textarea>
                        <label style="margin-top: 5px;">เอกสารประกอบ</label>
                        <input type="file" class="form-control" name="nc_sec5file" id="nc_sec5file" value="<?php echo $showfile; ?>"/>
                        <label id="get_nc_sec5_file">&nbsp;:&nbsp;<a href="<?php echo base_url("asset/nc/sec5/"); ?><?php echo $showfile; ?>" target="_blank"><?php echo $showfile; ?></a></label><br>
                        <label style="margin-top: 5px;">ค่าใช้จ่ายที่เกิดขึ้น โดยประมาณ</label>
                        <div class="form-inline">
                            <input type="number" class="form-control" name="nc_sec5cost" id="nc_sec5cost" value="<?php echo $showcost; ?>"/>&nbsp;<label>บาท</label>
                        </div>
                        <label class="sec4label">สำหรับ qmr เท่านั้น</label>
                    </div>
                    <div class="col-md-10">
                        <input type="submit" class="btn btn-primary" name="btn_sec5" id="btn_sec5"/>
                    </div>
                        <input hidden="" type="text" name="nc_status_sec5" id="nc_status_sec5" value="Conclusion of NC" /><!-- Status -->
                        <input hidden="" type="text" name="getdeptcode" id="getdeptcode" value="<?php echo $getuser['DeptCode']; ?>"/>
                    </form>
                    
                    
                </div>

            </div>
<!-- *********************************SECTION5****AREA**************************************--> 


            
            
            
         <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>   
        </div><!--End Main container-->
    </body>
</html>
