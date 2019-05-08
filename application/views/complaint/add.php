<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create new complaint page</title>
    </head>
    <body>
        <?php $this->load->view("head/nav"); ?>

        <div class="container" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">

            <h1 class="h1_add">Complaint Form</h1><hr>
            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>

            <form name="frmMain" action="<?php echo base_url('complaint/saveData'); ?>" method="post" enctype="multipart/form-data">
                <div class="panel panel-primary">
                    <div class="panel-heading">Topic</div>
                    <div class="panel-body">

                        <div class="form-row">
                            <div class="col-md-2 pri">
                                <label><b>ID</b></label>
                                <input type="text" name="cp_no" id="cp_no" class="form-control form-control-sm form-width" readonly="" placeholder="CP NO." value=""/>
                            </div>
                            <div class="col-md-2 pri">
                                <label><b>Date</b></label>
                                <input type="text" name="cp_date_show" id="cp_date_show" class="form-control form-control-sm form-width" value="<?php echo date('d/m/Y'); ?>" readonly=""/>
                                <input type="text" name="cp_date" id="cp_date" value="<?php echo date('Y-m-d'); ?>" hidden=""/>
                            </div>

                            <!-- Code สำหรับการ ตัดคำที่ดึงมา 2 Value และคั่นด้วย | -->                                   
                            <script language="JavaScript">
                                function resutName(strCusName)
                                {
                                    frmMain.cp_topic_hide.value = strCusName.split("|")[0];
                                    frmMain.cp_topic_cat.value = strCusName.split("|")[1];
                                }
                            </script>
                            <!-- Code สำหรับการ ตัดคำที่ดึงมา 2 Value และคั่นด้วย | -->  
                            

                            
                            <div class="col-md-3 pri">
                                <label><b>Category</b></label>
                                <select name="cp_category" id="cp_category" class="form-control form-control-sm" required="">
                                    <option value="">Select Category</option>
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
                                <select name="cp_topic" id="cp_topic" class="form-control form-control-sm" required="">
                                    <option value="">Select Topic</option>
                                    
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
                            <?php foreach ($get_pri_topic as $gpt): ?>
                            
                                <div class="col-md-3 pri">

                                    <label ><b><?php echo $gpt['pricat_name']; ?></b></label>
                                    <input hidden="" type="text" name="cp_pri_topic" id="cp_pri_topic" value="<?php echo $gpt['pricat_name']; ?>" />

                                    <select name="cp_pri_name_get[]" id="cp_pri_name_get" class="form-control form-control-sm pri">
                                        <option value="">Please Choose Priority</option>
                                        <?php
                                        $pri_group = $gpt['pricat_id'];
                                        $result = $this->db->query("SELECT * FROM complaint_priorityn WHERE pri_catid=$pri_group ");

                                        foreach ($result->result_array() as $gpn):
                                            ?>

                                            <option value="<?php echo $gpn['pri_id']; ?>"><?php echo $gpn['pri_name']; ?></option>

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
                                <input type="text" name="cp_user_name" id="cp_user_name" class="form-control form-control-sm form-width" readonly="" placeholder="Complaint Person" value="<?php echo $getuser['username']; ?>"/>
                            </div>

                            <div class="col-md-3 pri">
                                <label><b>Employee ID</b></label>
                                <input type="text" name="cp_user_empid" id="cp_user_empid" class="form-control form-control-sm form-width" readonly="" placeholder="Employee ID" value="<?php echo $getuser['ecode']; ?>"/>
                            </div>

                            <div class="col-md-3 pri">
                                <label><b>Department</b></label>
                                <input type="text" name="cp_user_dept" id="cp_user_dept" class="form-control form-control-sm form-width" readonly="" placeholder="Department" value="<?php echo $getuser['Dept']; ?>"/>
                            </div>

                            <div class="col-md-3">
                                <label><b>Department Code</b></label>
                                <input type="text" name="cp_user_dept_code" id="cp_user_dept_code" class="form-control form-control-sm form-width" readonly="" placeholder="Department Code" value="<?php echo $getuser['DeptCode']; ?>"/>
                            </div>
                        </div>
                        <input hidden="" type="text" name="memberemail" id="memberemail" value="<?php echo $getuser['memberemail']; ?>" />
                        <!--Email check-->

                    </div>
                </div><!--************* User Information ******************-->


                <div class="panel panel-primary"><!-- Details of Complaint / Damages -->
                    <div class="panel-heading">Details of Complaint / Damages</div>
                    <div class="panel-body">

                        <div class="form-row">
                            <div class="col-md-3 pri" id="h_username">
                                <a href="#"><i class="fas fa-plus-circle iconcolor"></i></a>&nbsp;<label><b>Customer Name</b></label>
                                <input type="text" name="cp_cus_name" id="cp_cus_name" class="form-control form-control-sm form-width"  placeholder="Customer Name"/>
                            </div>

                            <div class="col-md-3 pri" id="h_cusref">
                                <label><b>Customer Ref.</b></label>
                                <input type="text" name="cp_cus_ref" id="cp_cus_ref" class="form-control form-control-sm form-width"  placeholder="Customer Ref."/>
                            </div>

                            <div class="col-md-3 pri" id="h_inv">
                                <label><b>Invoice Number</b></label>
                                <input type="text" name="cp_invoice_no" id="cp_invoice_no" class="form-control form-control-sm form-width"  placeholder="Invoice Number"/>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 pri" id="h_procode">
                                <label><b>Product Code</b></label>
                                <input type="text" name="cp_pro_code" id="cp_pro_code" class="form-control form-control-sm form-width"  placeholder="Product Code"/>
                            </div>

                            <div class="col-md-4 pri" id="h_lotno">
                                <label><b>Lot No.</b></label>
                                <input type="text" name="cp_pro_lotno" id="cp_pro_lotno" class="form-control form-control-sm form-width"  placeholder="Lot No."/>
                            </div>

                            <div class="col-md-4 pri" id="h_qty">
                                <label><b>Quantity</b></label>
                                <input type="text" name="cp_pro_qty" id="cp_pro_qty" class="form-control form-control-sm form-width number"  placeholder="Quantity"/>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 form-group pri" style="margin-top: 15px;">
                                <textarea name="cp_detail" class="form-control form-control-sm" type="textarea" id="message" placeholder="Message" maxlength="2000" rows="7" required=""></textarea>
                                <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>                    
                            </div>
                            <div class="col-md-6 pri">
                                <p><input name="file_add" id="file_add" type="file" class="form-control form-control-sm"/></p>
                                <span style="color:red;font-size:12px;">Max file size = 10MB and word , pdf only</span>
                            </div>

                        </div>

                    </div>
                </div><!-- Details of Complaint / Damages -->


                <div class="panel panel-primary"><!--**********Related Department************-->
                    <div class="panel-heading">Related Department</div>
                    <div class="panel-body">

                        <div class="form-row">
<?php foreach ($get_dept_respons as $gdr): ?>
                                <div class="col-md-4">
                                    <label class="checkbox-inline"><input type="checkbox" name="dept[]" id="dept" value="<?php echo $gdr['cp_dept_main_code']; ?>"/><?php echo $gdr['cp_dept_main_name']; ?></label>
                                </div>
<?php endforeach; ?>
                        </div>


                    </div>
                </div>
                <div><input class="btn btn-primary" type="submit" name="add_btn" id="add_btn" value="Submit" />&nbsp;<input class="btn btn-warning" type="reset" name="reset_btn" id="reset_btn" value="Reset"/></div><hr>
                <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>



            </form>
        </div>
    </body>
</html>
