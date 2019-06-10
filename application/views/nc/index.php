<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nc Main Page</title>
    </head>
    <body>
        <?php $this->load->view("head/nav"); ?>

        <div class="container-fulid" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">
            <h1 class="head_text">LIST OF NC</h1><hr>

            <div class="form-inline">
                <a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a>
<!--                <a href="<?php echo base_url(); ?>complaint/add/<?php echo $getuser['DeptCode']; ?>"><button class="btn btn-primary btn-sm btn_back">New Complaint</button></a>-->


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



                <form action="<?php echo base_url("search/searchby_date_nc"); ?>" method="post" name="searchby_date" style="margin-top:5px;">
                <span id="searchby_date" hidden="">
                    <input type="date" class="form-control" name="date_start"/>&nbsp;<label>TO</label>&nbsp;
                    <input type="date" class="form-control" name="date_end"/>&nbsp;
                    <button class="btn btn-warning btn-sm">Search</button></span>
                </form>



                <form action="<?php echo base_url("search/searchby_docnum_nc"); ?>" method="post" name="searchby_docnum" style="margin-top:5px;">
                <span id="searchby_docnum" hidden=""><input type="text" name="searchby_docnum" id="searchby_docnum" class="form-control" placeholder="ค้นหาด้วยเลขเอกสาร CP1234"/>&nbsp;<button class="btn btn-warning btn-sm">Search</button></span>
                </form>



                <form action="<?php echo base_url("search/searchby_userinform_nc"); ?>" method="post" name="searchby_userinform" style="margin-top:5px;">
                <span id="searchby_userinform" hidden=""><input type="text" name="searchby_userinform" id="searchby_userinform" class="form-control" placeholder="ค้นหาด้วยชื่อผู้แจ้ง"/>&nbsp;<button class="btn btn-warning btn-sm">Search</button></span>
                </form>



                <form action="<?php echo base_url("search/searchby_topic_nc"); ?>" method="post" name="searchby_topic" style="margin-top:5px;">
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


                <form action="<?php echo base_url("search/searchby_wording_nc"); ?>" method="post" name="searchby_wording" style="margin-top:5px;">
                <span id="searchby_wording" hidden>
                    <input type="text" name="searchby_wording" id="searchby_wording" class="form-control" placeholder="กรุณาพิมพ์คำที่ต้องการค้นหา">
                    <button class="btn btn-warning btn-sm">Search</button>
                    <span style="color:red;">ค้นหาจาก : สถานะ , รายละเอียดปัญหา , รายละเอียดการติดตามผล</span>
                </span>
                </form>


                <form action="<?php echo base_url("search/searchby_related_dept_nc"); ?>" method="post" name="searchby_related_dept" style="margin-top:5px;">
                <span id="searchby_related_dept" hidden="">
<!--                    <input type="text" name="searchby_topic" id="searchby_topic" class="form-control" placeholder="ค้นหาด้วยหัวข้อเรื่อง"/>&nbsp;-->
                    <select class="form-control" name="searchby_related_dept" id="searchby_related_dept">
                        <option>Please select Data.</option>

                        <?php foreach ($get_relateddept_search as $grds): ?>
                        <option value="<?php echo $grds['nc_related_dept']; ?>"><?php echo $grds['cp_dept_main_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-warning btn-sm">Search</button>
                </span>
                </form>




            </div><hr>


             <table id="view_nc" class="table table-bordered table-hover dt-responsive " style="width:100%">
               <!-- ตอนนี้ไม่ได้ใช้ nowrap -->
                <thead>
                    <tr>
                        <th style="width:80px;text-align: center;">ID</th>
                        <th style="width:60px;text-align: center;">DATE</th>
                        <th style="width:100px;text-align: center;">COMPLAINT BY</th>
                        <th style="text-align: center;">CATEGORY</th>
                        <th style="text-align: center;">TOPIC</th>
                        <th style="text-align: center;">FROM</th>
                        <th style="width:200px;text-align: center;">RELATED DEPARTMENT.</th>
                        <th style="width:200px;text-align: center;">STATUS</th>
                        <th style="width:80px;text-align: center;">PRIORITY</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($list_nc->result_array() as $l_nc): ?>
                    <tr>
                        <?php
                            if($l_nc['nc_status_code']=="nc01"){
                                $newgif = '&nbsp;<img src="http://203.107.156.180/intsys/complaint/asset/new.gif" alt=""/>';
                            }else{$newgif="";}
                        ?>

                        <td style="text-align: left;font-weight: 600;"><a href="<?php echo base_url("nc/main/");?><?php echo $l_nc['cp_no']; ?>/<?php echo $l_nc['nc_related_dept']; ?>"><?php echo $l_nc['cp_no']; ?></a><?php echo $newgif; ?></td>
                        <td style="text-align: left;">
                            <?php
                            $date = date_create($l_nc['cp_date']);
                            echo date_format($date, "d/m/Y");

                            ?>
                        </td>
                        <td style="text-align: left;"><?php echo $l_nc['cp_user_name']; ?></td>
                        <td style="text-align: left;"><?php echo $l_nc['topic_cat_name']; ?></td>
                        <td style="text-align: left;"><?php echo $l_nc['topic_name']; ?></td>
                        <td style="text-align: left;"><?php echo $l_nc['cp_cus_name']; ?></td>

                        <?php

                            if($l_nc['cp_status_name'] == "Transform Complaint"){
                                $color = ' #87CEEB; ';
                            }
                            if($l_nc['cp_status_name'] == "Waiting Action"){
                                $color = ' #40E0D0; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_1st"){
                                $color = ' #DAA520; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_2nd"){
                                $color = ' #DAA520; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_3rd"){
                                $color = ' #DAA520; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_1st NC Close"){
                                $color = ' #F4A460; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_2nd NC Close"){
                                $color = ' #F4A460; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_3rd NC Close"){
                                $color = ' #F4A460; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_3rd Fail"){
                                $color = ' #F4A460; ';
                            }
                            if($l_nc['cp_status_name'] == "NC Failed"){
                                $color = ' #FF8C00; ';
                            }
                            if($l_nc['cp_status_name'] == "Conclusion of NC Failed"){
                                $color = ' #FF8C00; ';
                            }
                            if($l_nc['cp_status_name'] == "Conclusion of NC"){
                                $color = ' #32CD32; ';
                            }


                        ?>
                        <td style="text-align: left;"><?php echo $l_nc['cp_dept_main_name']; ?></td>
                        <td style="text-align: left;color:<?php echo $color; ?>"><?php echo $l_nc['cp_status_name']; ?></td>
                        <td style="text-align: center;"><?php echo $this->complaint_model->conpriority($l_nc['cp_priority']); ?></td>
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
                        <th style="width:200px;text-align: center;">RELATED DEPARTMENT.</th>
                        <th style="text-align: center;">STATUS</th>
                        <th style="text-align: center;">PRIORITY</th>
                    </tr>
                </tfoot>
            </table>
            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
            <script type="text/javascript" >
    $(document).ready(function () {
                $('#view_nc').DataTable({
                    "order": [[0, "desc"]]
                });
            });
    </script>



        </div>


    </body>
</html>
