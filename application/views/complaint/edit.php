<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit new complaint page</title>
    </head>
    <body>
        <?php $this->load->view("head/nav"); ?>

        <div class="container" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">

                <h1 class="h1_add">Complaint Form ( Edit ): <?php echo $view_cp['cp_no']; ?></h1><hr>
                <!-- <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div> -->

                <form name="frmMain" action="<?php echo base_url('complaint/savedata_edit/'); ?><?php echo $view_cp['cp_no']; ?>" method="post" enctype="multipart/form-data">
                    <input hidden="" type="text" name="getuser_check" id="getuser_check" value="<?php echo $getuser['username']; ?>" /><!--Get user for check-->

                    <input hidden="" type="text" name="history_cpno" id="history_cpno" value="<?php echo $view_cp['cp_no']; ?>" /><!-- For history table-->
                    <input hidden="" type="text" name="history_cpusername" id="history_cpusername" value="<?php echo $view_cp['cp_user_name']; ?>" /><!-- For history table-->
                    <input hidden="" type="text" name="history_cpuserempid" id="history_cpuserempid" value="<?php echo $view_cp['cp_user_empid']; ?>" /><!-- For history table-->
                    <input hidden="" type="text" name="history_cpuserdept" id="history_cpuserdept" value="<?php echo $view_cp['cp_user_dept']; ?>" /><!-- For history table-->
                    <input hidden="" type="text" name="history_cpstatus" id="history_cpstatus" value="<?php echo $view_cp['cp_status_code']; ?>" /><!-- For history table-->

                <div class="panel panel-primary">
                    <div class="panel-heading">Topic </div>
                    <div class="panel-body">

                        <div class="form-row">
                            <div class="col-md-2 pri">
                                <label><b>ID</b></label>
                                <input type="text" name="cp_no_edit" id="cp_no_edit" class="form-control form-control-sm form-width" readonly="" placeholder="CP NO." value="<?php echo $view_cp['cp_no']; ?>"/>
                            </div>
                            <div class="col-md-2 pri">
                                <label><b>Date</b></label>
                                <input type="text" name="cp_date_show" id="cp_date_show" class="form-control form-control-sm form-width" value="<?php echo date('d/m/Y'); ?>" readonly=""/>
                                <input type="text" name="cp_date_edit" id="cp_date_edit" value="<?php echo date('Y-m-d'); ?>" hidden=""/>
                                <input hidden="" type="text" name="cp_date_get" id="cp_date_get" value="<?php echo $view_cp['cp_date']; ?>" />
                            </div>

                            <!-- Code สำหรับการ ตัดคำที่ดึงมา 2 Value และคั่นด้วย | -->
                            <script language="JavaScript">
                                function resutName(strCusName)
                                {
                                    frmMain.cp_topic_hide_edit.value = strCusName.split("|")[0];
                                    frmMain.cp_topic_cat_edit.value = strCusName.split("|")[1];
                                }
                            </script>
                            <!-- Code สำหรับการ ตัดคำที่ดึงมา 2 Value และคั่นด้วย | -->

                            <div class="col-md-3 pri">
                                <label><b>Category</b></label>
                                <select name="cp_category" id="cp_category" class="form-control form-control-sm" >
                                    <option value="<?php echo $view_cp['topic_cat_id']; ?>"><?php echo $view_cp['topic_cat_name']; ?></option>
                                    <?php
                                    foreach ($topic_category as $row)
                                    {
                                        echo '<option value="'.$row->topic_cat_id.'">'.$row->topic_cat_name.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="col-md-3 pri">
                                <label><b>Topic</b></label>
                                <select name="cp_topic" id="cp_topic" class="form-control form-control-sm" >
                                    <option value="<?php echo $view_cp['topic_id']; ?>"><?php echo $view_cp['topic_name']; ?></option>

                                </select>
                            </div>




                            <div class="col-md-2">
                                <label hidden=""><b>Status</b></label>
                                <input type="text" name="cp_status" id="cp_status" value="New Complaint" hidden=""/>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-primary"><!--************* Priority ******************-->
                    <div class="panel-heading">Priority</div>
                    <div class="panel-body">

                        <div class="form-row">
                            <?php foreach ($get_pri_use as $gpt): ?>
                            <div class="col-md-3 pri">

                                <label ><b><?php echo $gpt['pricat_name']; ?></b></label>
                                <input hidden="" type="text" name="cp_pri_topic_edit" id="cp_pri_topic_edit" value="<?php ?>" />

                                <select name="cp_pri_name_get_edit[]" id="cp_pri_name_get_edit" class="form-control form-control-sm" required="" >
                                    <option value="<?php echo $gpt['cp_pri_use_id']; ?>"><?php echo $gpt['pri_name']; ?></option>

                                     <?php
                                     $pricatid = $gpt['pri_catid'];
                                     $not = $gpt['cp_pri_use_id'];
                                     $result = $this->db->query("SELECT * FROM complaint_priorityn WHERE pri_catid=$pricatid AND NOT pri_id=$not ");
                                     foreach ($result->result_array() as $gpdetail) :
                                     ?>
                                     <option value="<?php echo $gpdetail['pri_id'] ?>"><?php echo $gpdetail['pri_name'] ?>|<?php echo $gpdetail['pri_score'] ?></option>
                                     <?php endforeach; ?>

                                </select>

                            </div>


                            <?php endforeach; ?>

                        </div>




                    </div>
                </div><!--************* Priority ******************-->



                <div class="panel panel-primary"><!--************* User Information ******************-->
                    <div class="panel-heading">User Information</div>
                    <div class="panel-body">

                        <div class="form-row">
                            <div class="col-md-3 pri">
                                <label><b>Complaint Person</b></label>
                                <input type="text" name="cp_user_name_edit" id="cp_user_name_edit" class="form-control form-control-sm form-width" readonly="" placeholder="Complaint Person" value="<?php echo $view_cp['cp_user_name']; ?>"/>
                            </div>

                            <div class="col-md-3 pri">
                                <label><b>Employee ID</b></label>
                                <input type="text" name="cp_user_empid_edit" id="cp_user_empid_edit" class="form-control form-control-sm form-width" readonly="" placeholder="Employee ID" value="<?php echo $view_cp['cp_user_empid']; ?>"/>
                            </div>

                            <div class="col-md-3 pri">
                                <label><b>Department</b></label>
                                <input type="text" name="cp_user_dept_edit" id="cp_user_dept_edit" class="form-control form-control-sm form-width" readonly="" placeholder="Department" value="<?php echo $view_cp['cp_user_dept']; ?>"/>
                            </div>

                            <div class="col-md-3">
                                <label hidden=""><b>Department Code</b></label>
                                <input hidden="" type="text" name="cp_user_dept_code_edit" id="cp_user_dept_code_edit"  readonly="" placeholder="Department Code" value="<?php echo $getuser['DeptCode']; ?>"/>
                            </div>
                        </div>

                    </div>
                </div><!--************* User Information ******************-->


                <div class="panel panel-primary"><!-- Details of Complaint / Damages -->
                    <div class="panel-heading">Details of Complaint / Damages</div>
                    <div class="panel-body">

                        <div class="form-row">
                            <div class="col-md-3 pri" id="h_username">
                                <a href="#"><i class="fas fa-plus-circle iconcolor"></i></a>&nbsp;<label><b>Customer Name</b></label>
                                <input type="text" name="cp_cus_name_edit" id="cp_cus_name_edit" class="form-control form-control-sm form-width"  placeholder="Customer Name" value="<?php echo $view_cp['cp_cus_name']; ?>"/>
                            </div>

                            <div class="col-md-3 pri" id="h_cusref">
                                <label><b>Customer Ref.</b></label>
                                <input type="text" name="cp_cus_ref_edit" id="cp_cus_ref_edit" class="form-control form-control-sm form-width"  placeholder="Customer Ref." value="<?php echo $view_cp['cp_cus_ref']; ?>"/>
                            </div>

                            <div class="col-md-3 pri" id="h_inv">
                                <label><b>Invoice Number</b></label>
                                <input type="text" name="cp_invoice_no_edit" id="cp_invoice_no_edit" class="form-control form-control-sm form-width"  placeholder="Invoice Number" value="<?php echo $view_cp['cp_invoice_no']; ?>"/>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 pri" id="h_procode">
                                <label><b>Product Code</b></label>
                                <input type="text" name="cp_pro_code_edit" id="cp_pro_code_edit" class="form-control form-control-sm form-width"  placeholder="Product Code" value="<?php echo $view_cp['cp_pro_code']; ?>"/>
                            </div>

                            <div class="col-md-4 pri" id="h_lotno">
                                <label><b>Lot No.</b></label>
                                <input type="text" name="cp_pro_lotno_edit" id="cp_pro_lotno_edit" class="form-control form-control-sm form-width"  placeholder="Lot No." value="<?php echo $view_cp['cp_pro_lotno']; ?>"/>
                            </div>

                            <div class="col-md-4 pri" id="h_qty">
                                <label><b>Quantity</b></label>
                                <input type="text" name="cp_pro_qty_edit" id="cp_pro_qty_edit" class="form-control form-control-sm form-width"  placeholder="Quantity" value="<?php echo $view_cp['cp_pro_qty']; ?>"/>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 form-group pri" style="margin-top: 15px;">
                                <textarea name="cp_detail_edit" class="form-control form-control-sm" type="textarea" id="message" placeholder="Message" maxlength="2000" rows="7" required=""><?php echo $view_cp['cp_detail']; ?></textarea>
                                <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
                            </div>
                            <div class="col-md-6 pri">
                                <p><label><a href="<?php echo base_url("asset/add/".$view_cp['cp_file']); ?>" target="_blank"><?php echo $view_cp['cp_file']; ?></label></a></p>
                                <input hidden="" type="text" name="showfile" id="showfile" value="<?php echo $view_cp['cp_file']; ?>"/>
                                <p><input name="file_add_edit" id="file_add_edit" type="file" class="form-control form-control-sm"/></p>
                                <span style="color:red;font-size:12px;">Max file size = 10MB and word , pdf only</span>
                            </div>

                        </div>

                    </div>
                </div><!-- Details of Complaint / Damages -->


                <div class="panel panel-primary"><!--**********Related Department************-->
                    <div class="panel-heading">Related Department</div>
                    <div class="panel-body">
                    <?php
                    $dept_code = $getuser['DeptCode'];
                        $get_dept_respons = $this->db->query("SELECT * FROM complaint_department_main WHERE cp_dept_main_code NOT IN ('$dept_code')");

                    ?>

                        <div class="form-row">
                            <?php foreach ($get_dept_respons->result_array() as $gdr): ?>

                            <div class="col-md-4">

                                <?php /*************CODE CHECKED CHECKBOX******************/
                                $checked = "";
                                foreach ($getdept_checkbox->result_array() as $gc) {
                                if($gdr['cp_dept_main_code'] == $gc['cp_dept_code']){
                                    $checked = ' checked="" ';
                                    continue;
                                }
                                    }
                                    /*************CODE CHECKED CHECKBOX******************/
                                ?>

                                <label class="checkbox-inline"><input <?php echo $checked;  ?> type="checkbox" name="dept_edit[]" id="dept_edit" value="<?php echo $gdr['cp_dept_main_code']; ?>"/><?php echo $gdr['cp_dept_main_name']; ?></label>


                            </div>
                            <?php endforeach; ?>

                        </div>

                    </div>
                </div>



                <div class="panel panel-primary">
                    <div class="panel-heading">Memo.</div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            <label class="sec4label">Reason for revision. * Require *</label>
                            <textarea class="form-control" name="cp_modify_reason" id="cp_modify_reason" required=""></textarea>
                        </div>
                    </div>
                </div>



                <div><input class="btn btn-primary" type="submit" name="add_btn_edit" id="add_btn_edit" value="Update" onclick="javascript:return confirm('คุณต้องการบันทึกข้อมูล ใช่หรือไม่');"/>&nbsp;<input class="btn btn-warning" type="reset" name="reset_btn_edit" id="reset_btn_edit" value="Reset"/></div><hr>
                <!-- <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div> -->



                <div>

                    <input hidden="" type="text" name="his_action" id="his_action" value="Edit Complete" />
                    <input hidden="" type="text" name="his_user_modify" id="his_user_modify" value="<?php echo $getuser['username']; ?>" />
                    <input hidden="" type="text" name="his_date_modify" id="his_date_modify" value="<?php echo date("Y/m/d H:i:s"); ?>" />
                </div>


            </form>
        </div>
    </body>
</html>
