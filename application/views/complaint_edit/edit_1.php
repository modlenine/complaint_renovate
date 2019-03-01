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

        <div class="container">
            <h1 class="h1_view">Edit Complaint : <?php echo $view_cp['cp_no']; ?></h1>
            <div class="btn_back">
                <a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a>&nbsp;
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Basic Information</div>
                <div class="panel-body">
                    
                    <div class="form-row">
                        <div class="col-md-3">
                            <label><b>ID :</b></label>
                            <input class="form-control" type="text" name="cp_no_edit" id="cp_no_edit" value="<?php echo $view_cp['cp_no']; ?>" />
                        </div>
                        <div class="col-md-3">
                            <label><b>Date :</b></label>
                            <input class="form-control" type="text" name="cp_date_edit" id="cp_date_edit" value="<?php $date = date_create($view_cp['cp_date']); echo date_format($date, "d-m-Y"); ?>" />
                        </div>
   
                        <div class="col-md-3">
                            <label><b>Topic :</b></label>
                            <input class="form-control" type="text" name="cp_topic_edit" id="cp_topic_edit" value="<?php echo $view_cp['cp_topic']; ?>" />
                        </div>


                        <div class="col-md-3">
                            <label><b>Category :</b></label>
                            <input class="form-control" type="text" name="cp_topic_cat_edit" id="cp_topic_cat_edit" value="<?php echo $view_cp['cp_topic_cat']; ?>" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3">
                            <label><b>Complaint Person :</b></label>
                            <input class="form-control" type="text" name="cp_user_name_edit" id="cp_user_name_edit" value="<?php echo $view_cp['cp_user_name']; ?>"/>
                        </div>
                        <div class="col-md-3">
                            <label><b>Employee ID :</b></label>
                            <input class="form-control" type="text" name="cp_user_empid_edit" id="cp_user_empid_edit" value="<?php echo $view_cp['cp_user_empid']; ?>" />
                        </div>
                        <div class="col-md-3">
                            <label><b>Department :</b></label>
                            <input class="form-control" type="text" name="cp_user_dept_edit" id="cp_user_dept_edit" value="<?php echo $view_cp['cp_user_dept']; ?>" />
                        </div>
                        <div class="col-md-3">
                            <label><b>Status :</b></label>
                            <input class="form-control" type="text" name="cp_status_edit" id="cp_status_edit" value="<?php echo $view_cp['cp_status']; ?>" />
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Priority</div>
                <div class="panel-body">

                    <div class="form-row">
                        <?php foreach ($get_pri_use as $gpu): ?>
                        <div class="col-md-3 m_pri">
                            <label><b><?php echo $gpu['cp_pri_topic']; ?></b></label>
                            <input hidden="" type="text" name="cp_pri_topic_edit" id="cp_pri_topic_edit" value="<?php echo $gpu['cp_pri_topic']; ?>" />
                            <textarea class="form-control" rows="4" name="cp_pri_name_edit" id="cp_pri_name_edit"><?php echo $gpu['cp_pri_name']; ?></textarea>
                        </div>
                        <?php endforeach; ?>
                    </div><br>

                </div>
            </div>
            
            
            <div class="panel panel-default">
                <div class="panel-heading">Details of Complaint / Damages</div>
                <div class="panel-body">
                
                    <div class="form-row">
                        <div class="col-md-3" id="h_username">
                            <label><b>Customer Name :</b></label>
                            <input class="form-control" type="text" name="cp_cus_name_edit" id="cp_cus_name_edit" value="" />
                        </div>

                        <div class="col-md-3" id="h_cusref">
                            <label><b>Customer Ref. :</b></label>
                            <input class="form-control" type="text" name="cp_cus_ref_edit" id="cp_cus_ref_edit" value="<?php echo $view_cp['cp_cus_ref']; ?>" />
                        </div>

                        <div class="col-md-3" id="h_inv">
                            <label><b>Invoice Number :</b></label>
                            <input class="form-control" type="text" name="cp_invoice_edit" id="cp_invoice_edit" value="<?php echo $view_cp['cp_invoice_no']; ?>"/>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-3" id="h_procode">
                            <label><b>Product Code :</b></label>
                            <input class="form-control" type="text" name="cp_pro_code_edit" id="cp_pro_code_edit" value="<?php echo $view_cp['cp_pro_code']; ?>"/>
                        </div>

                        <div class="col-md-3" id="h_lotno">
                            <label><b>Lot No. :</b></label>
                            <input class="form-control" type="text" name="cp_pro_lotno_edit" id="cp_pro_lotno_edit" value="<?php echo $view_cp['cp_pro_lotno']; ?>" />
                        </div>

                        <div class="col-md-3" id="h_qty">
                            <label><b>Quantity :</b></label>
                            <input class="form-control" type="text" name="cp_pro_qty_edit" id="cp_pro_qty_edit" value="<?php echo $view_cp['cp_pro_qty']; ?>" />
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-8 form-group">
                            <label><b>Detail of complaint :</b></label>
                            <textarea class="form-control" rows="5" name="detail_of_complaint_edit" id="detail_of_compltint_edit"><?php echo $view_cp['cp_detail']; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                                <label><b>Attached file :</b></label>
                                <input class="form-control" type="text" name="cp_file_edit" id="cp_file_edit" value="<?php echo $view_cp['cp_file']; ?>" />
                        </div>
                        <div class="col-md-6">
                            <label><b>Related Department.</b></label>
                            <?php foreach ($get_dept as $gdn): ?>
                            &nbsp;<label class="check_dept_view"><?php echo $gdn['Dept']; ?></label>&nbsp;,
                            <input hidden="" type="text" name="dept_edit" id="dept_edit" value="<?php echo $gdn['Dept']; ?>" />

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

                </div>
                

            </div>
            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
            
                
</div><!-- Main content page -->
            

      
    </body>
</html>
