<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php $this->load->view("head/nav"); ?>

        <div class="container-fulid" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">
            <h1 class="head_list_cp">List of Complaint</h1>

                        <div class="form-inline">
                <a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a>
                <a href="<?php echo base_url(); ?>complaint/add/<?php echo $getuser['DeptCode']; ?>"><button class="btn btn-primary btn-sm btn_back"><i class="fas fa-plus-circle"></i>&nbsp;New Complaint</button></a>


                <label><i class="fas fa-search"></i>&nbsp;ค้นหาเอกสาร โดย :</label>
                <select class="form-control" name="search_form" id="search_form">
                    <option value="">กรุณาเลือกประเภทการค้นหา</option>
                    <option value="searchby_date">วันที่</option>
                    <option value="searchby_docnum">เลขเอกสาร</option>
                    <option value="searchby_userinform">ผู้แจ้ง</option>
                    <option value="searchby_topic">หัวข้อเรื่อง</option>
                    <option value="searchby_related_dept">แผนกที่ถูกแจ้ง</option>
                    <option value="searchby_wording">ค้นหาด้วยคำ</option>
<!--                    <option value="searchby_status">Status</option>-->
                </select>

<!--                <button style="float:right;" class="btn btn-success btn-sm">Export</button>-->



                <form action="<?php echo base_url("search/searchby_date"); ?>" method="post" name="searchby_date" style="margin-top:5px;">
                <span id="searchby_date" hidden="">
                    <input type="date" class="form-control" name="date_start"/>&nbsp;<label>TO</label>&nbsp;
                    <input type="date" class="form-control" name="date_end"/>&nbsp;
                    <button class="btn btn-warning btn-sm">Search</button></span>
                </form>



                <form action="<?php echo base_url("search/searchby_docnum"); ?>" method="post" name="searchby_docnum" style="margin-top:5px;">
                <span id="searchby_docnum" hidden=""><input type="text" name="searchby_docnum" id="searchby_docnum" class="form-control" placeholder="ค้นหาด้วยเลขเอกสาร CP1234"/>&nbsp;<button class="btn btn-warning btn-sm">Search</button></span>
                </form>



                <form action="<?php echo base_url("search/searchby_userinform"); ?>" method="post" name="searchby_userinform" style="margin-top:5px;">
                <span id="searchby_userinform" hidden=""><input type="text" name="searchby_userinform" id="searchby_userinform" class="form-control" placeholder="ค้นหาด้วยชื่อผู้แจ้ง"/>&nbsp;<button class="btn btn-warning btn-sm">Search</button></span>
                </form>



                <form action="<?php echo base_url("search/searchby_topic"); ?>" method="post" name="searchby_topic" style="margin-top:5px;">
                <span id="searchby_topic" hidden="">
<!--                    <input type="text" name="searchby_topic" id="searchby_topic" class="form-control" placeholder="ค้นหาด้วยหัวข้อเรื่อง"/>&nbsp;-->
                    <select class="form-control" name="searchby_topic" id="searchby_topic">
                        <option>Please select topic.</option>

                        <?php foreach ($get_topic_search as $gtop): ?>
                        <option value="<?php echo $gtop['topic_id'] ?>"><?php echo $gtop['topic_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-warning btn-sm">Search</button>
                </span>
                </form>


                <form action="<?php echo base_url("search/searchby_wording"); ?>" method="post" name="searchby_wording" style="margin-top:5px;">
                <span id="searchby_wording" hidden>
                    <input type="text" name="searchby_wording" id="searchby_wording" class="form-control" placeholder="กรุณาพิมพ์คำที่ต้องการค้นหา">
                    <button class="btn btn-warning btn-sm">Search</button>
                    <span style="color:red;">ค้นหาจาก : Email , ชื่อลูกค้า , ข้อมูลอ้างอิง , หมายเลขอินวอยว์ , รหัสสินค้า , หมายเลข Lot number , รายละเอียด Complaint</span>
                </span>
                </form>


                <form action="<?php echo base_url("search/searchby_related_dept"); ?>" method="post" name="searchby_related_dept" style="margin-top:5px;">
                <span id="searchby_related_dept" hidden="">
<!--                    <input type="text" name="searchby_topic" id="searchby_topic" class="form-control" placeholder="ค้นหาด้วยหัวข้อเรื่อง"/>&nbsp;-->
                    <select class="form-control" name="searchby_related_dept" id="searchby_related_dept">
                        <option>Please select Data.</option>

                        <?php foreach ($get_relateddept_search as $grds): ?>
                        <option value="<?php echo $grds['cp_dept_code']; ?>"><?php echo $grds['cp_dept_main_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-warning btn-sm">Search</button>
                </span>
                </form>








<!--                <input type="date" class="form-control"/>&nbsp;<label>TO</label>&nbsp;<input type="date" class="form-control"/>&nbsp;<button class="btn btn-warning btn-sm">Search</button>-->

            </div><hr>

<!--            <div class="btn_back">
                <a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a>
                <a href="<?php echo base_url(); ?>complaint/add/<?php echo $getuser['DeptCode']; ?>"><button class="btn btn-primary btn-sm btn_back">New Complaint</button></a>
            </div><hr>-->

            <table id="view_cp" class="table table-hover table-bordered dt-responsive " style="width:100%">
              <!-- ตอนนี้ไม่ได้ใช้ nowrap -->
                <thead>
                    <tr>
                        <th style="width:80px;text-align: center;">ID</th>
                        <th style="width:60px;text-align: center;">DATE</th>
                        <th style="width:100px;text-align: center;">COMPLAINT BY</th>
                        <th style="text-align: center;">CATEGORY</th>
                        <th style="text-align: center;">TOPIC</th>
                        <th style="text-align: center;">FROM</th>
                        <th style="width:300px;text-align: center;">RELATED DEPARTMENT.</th>
                        <th style="width:200px;text-align: center;">STATUS</th>
                        <th style="width:80px;text-align: center;">PRIORITY</th>
                    </tr>
                </thead>
                <tbody>



<?php foreach ($list_cp as $l_cp): ?>

                   <?php
                            if($l_cp['cp_status_code']=="cp01" || $l_cp['cp_status_code']=="cp07"){
                                $url_page = "complaint/view/";
                            }else{
                                $url_page = "complaint/investigate/";
                            }

                            if($l_cp['cp_no_old']!=""){
                                $url_page = "complaint/view_fail/";
                                $bg_color = " background-color:#FF7F50;color:white; ";
                            }else{
                                $bg_color = " ";
                            }

                            if($l_cp['cp_status_code']=="cp01"){
                                $newgif = '&nbsp;<img src="http://203.107.156.180/intsys/complaint/asset/new.gif" alt=""/>';
                            }else{$newgif="";}
                        ?>
                    <tr>

                        <td style="text-align: left;font-weight: 600;"><a href="<?php echo base_url().$url_page; ?><?php echo $l_cp['cp_no']; ?>"><?php echo $l_cp['cp_no']; ?></a><?php echo $newgif; ?></td>
                        <td style="text-align: left;">
                            <?php
                            $date = date_create($l_cp['cp_date']);
                            echo date_format($date, "d/m/Y");

                            ?>
                        </td>
                        <td style="text-align: left;"><?php echo $l_cp['cp_user_name']; ?></td>
                        <td style="text-align: left;"><?php echo $l_cp['topic_cat_name']; ?></td>
                        <td style="text-align: left;"><?php echo $l_cp['topic_name']; ?></td>
                        <td style="text-align: left;"><?php echo $l_cp['cp_cus_name']; ?></td>

                        <?php
                            if($l_cp['cp_status_id']== "cp01"){
                                $color = "#0066FF";
                            }
                            if($l_cp['cp_status_id']== "cp02"){
                                $color = "#00BFFF";
                            }
                            if($l_cp['cp_status_id']== "cp03"){
                                $color = "#33CC33";
                            }
                            if($l_cp['cp_status_id']== "cp04"){
                                $color = "#BEBEBE";
                            }
                            if($l_cp['cp_status_id']== "cp05"){
                                $color = "#FF4500";
                            }
                            if($l_cp['cp_status_id']== "cp06"){
                                $color = "#228B22";
                            }
                            if($l_cp['cp_status_id']== "cp07"){
                                $color = "#FF4500";
                            }

                        ?>

                        <td style="text-align: left;">
                          <?php
                          $cp_no = $l_cp['cp_no'];
                            $getdept = $this->db->query("SELECT complaint_department.cp_dept_id, complaint_department.cp_dept_code, complaint_department.cp_dept_cp_no, member.Dept FROM complaint_department INNER JOIN member ON member.DeptCode = complaint_department.cp_dept_code WHERE complaint_department.cp_dept_cp_no = '$cp_no' GROUP BY complaint_department.cp_dept_code DESC");
                          ?>

                          <?php foreach ($getdept->result_array() as $gdn): ?>
                              <?php echo $gdn['Dept'] . "&nbsp;,"; ?>
                          <?php endforeach; ?>
                        </td>



                        <td style="font-weight:500;text-align: left;color:<?php echo $color; ?>;"><?php echo $l_cp['cp_status_name']; ?></td>

                        <?php

                                   $number =  $l_cp['cp_priority'];
                                   if($number >= 1 && $number <= 1.5){
                                       $level = "<span style='color:#696969;'>Very Low</span>";
                                   }else if ($number >= 1.6 && $number <= 2.5){
                                       $level = "Low";
                                   }else if ($number >= 2.6 && $number <= 3.5){
                                       $level = "<span style='color:#87CEEB;'>Normal</span>";
                                   }else if ($number >= 3.6 && $number <= 4.5){
                                       $level = "<span style='color:#FF4500;'>Hight</span>";
                                   }else{
                                       $level = "<span style='color:#FF0000;'>Very Hight</span>";
                                   }
                            ?>

                        <td style="text-align: center;"><?php echo $level; ?></td>
                    </tr>
<?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align: center;">ID</th>
                        <th style="text-align: center;">DATE</th>
                        <th style="text-align: center;">COMPLAINT BY</th>
                        <th style="text-align: center;">CATEGORY</th>
                        <th style="text-align: center;">TOPIC</th>
                        <th style="text-align: center;">FROM</th>
                        <th style="text-align: center;">RELATED DEPARTMENT.</th>
                        <th style="text-align: center;">STATUS</th>
                        <th style="text-align: center;">PRIORITY</th>
                    </tr>
                </tfoot>
            </table>
            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
            <script type="text/javascript" >
    $(document).ready(function () {
                $('#view_cp').DataTable({
                    "order": [[0, "desc"]]
                });
            });
    </script>
        </div>
    </body>
</html>
