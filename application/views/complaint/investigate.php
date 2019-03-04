<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Investigate</title>

    </head>
    <body>
        <?php $this->load->view("head/nav"); ?>
        
        <div class="container">
            <h1 class="h1_view">Investigate Complaint : <?php echo $view_cp['cp_no']; ?></h1>
            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>

            
            <div class="panel panel-warning">
                <div class="panel-heading">Basic Information</div>
                <div class="panel-body">

                    <div class="form-row">
                        <div class="col-md-3">
                            <label><b>ID :</b></label>
                            <label><?php echo $view_cp['cp_no']; ?></label>
                        </div>
                        <div class="col-md-3">
                            <label><b>Date :</b></label>
                            <label><?php
                            $date = date_create($view_cp['cp_date']);
                            echo date_format($date, "d-m-Y"); 
                            ?></label>
                        </div>
  
                        <div class="col-md-3">
                            <label><b>Topic :</b></label>
                            <label id="cp_topic"><?php echo $view_cp['cp_topic']; ?></label>
                        </div>


                        <div class="col-md-3">
                            <label><b>Catagory :</b></label>
                            <label><?php echo $view_cp['cp_topic_cat']; ?></label>
                            <input type="text" name="cp_topic_cat" id="cp_topic_cat" hidden="" value="<?php echo $view_cp['cp_topic_cat']; ?>" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3">
                            <label><b>Complaint Person :</b></label>
                            <label><?php echo $view_cp['cp_user_name']; ?></label>
                        </div>
                        <div class="col-md-3">
                            <label><b>Employee ID :</b></label>
                            <label><?php echo $view_cp['cp_user_empid']; ?></label>
                        </div>
                        <div class="col-md-3">
                            <label><b>Department :</b></label>
                            <label><?php echo $view_cp['cp_user_dept']; ?></label>
                        </div>
                        <div class="col-md-3">
                            <label><b>Status :</b></label>
                            <label class="check_status"><b style="color:blue;"><?php echo $view_cp['cp_status']; ?></b></label>
                        </div>
                    </div>
                </div>
            </div>
            
            

            <div class="panel panel-warning">
                <div class="panel-heading">Priority</div>
                <div class="panel-body">

                    <div class="form-row">
                        <div class="form-row">
                        <?php foreach ($get_pri_use as $gpu): ?>
                        <div class="col-md-3 m_pri">
                            <label><b><?php echo $gpu['cp_pri_topic']; ?></b></label>
                            <label><?php echo $gpu['cp_pri_name']; ?></label>
                        </div>
                        <?php endforeach; ?>
                    </div><br>
                    </div><br>

                </div>
            </div>
            


            <div class="panel panel-warning">
                <div class="panel-heading">Details of Complaint / Damages</div>
                <div class="panel-body">

                    <div class="form-row">
                        <div class="col-md-3" id="h_username">
                            <label><b>Customer Name :</b></label>
                            <label><?php echo $view_cp['cp_cus_name']; ?></label>
                        </div>

                        <div class="col-md-3" id="h_cusref">
                            <label><b>Customer Ref. :</b></label>
                            <label><?php echo $view_cp['cp_cus_ref']; ?></label>
                        </div>

                        <div class="col-md-3" id="h_inv">
                            <label><b>Invoice Number :</b></label>
                            <label><?php echo $view_cp['cp_invoice_no']; ?></label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3" id="h_procode">
                            <label><b>Product Code :</b></label>
                            <label><?php echo $view_cp['cp_pro_code']; ?></label>
                        </div>

                        <div class="col-md-3" id="h_lotno">
                            <label><b>Lot No. :</b></label>
                            <label><?php echo $view_cp['cp_pro_lotno']; ?></label>
                        </div>

                        <div class="col-md-3" id="h_qty">
                            <label><b>Quantity :</b></label>
                            <label><?php echo $view_cp['cp_pro_qty']; ?></label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-8 form-group">
                            <label><b>Detail of complaint :</b></label>
                            <textarea readonly="" class="form-control" rows="3" name="detail_of_complaint" id="detail_of_compltint"><?php echo $view_cp['cp_detail']; ?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label><b>Attached file :</b></label>   
                            <label><a href="http://192.190.10.27/complaint_new/asset/<?php echo $view_cp['cp_file']; ?>" target="_blank"><?php echo $view_cp['cp_file']; ?></a></label><br>

                        </div>
                        <div class="col-md-12">
                            <label><b>Related Department.</b></label>
                            <?php foreach ($get_dept as $gdn): ?>
                                <label><?php echo $gdn['Dept']."&nbsp;,"; ?></label>&nbsp;

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
            
            
<!--********************************************************INVESTIGATION SECTION******************************************************************************-->                            
                
<div class="panel panel-warning">
    <div class="panel-heading">Investigation &nbsp;</div>
   
      
      
      <div class="panel-body">
          
          <form name="invesform" method="post" action="<?php echo base_url(); ?>complaint/add_detail_inves/<?php echo $view_cp['cp_no']; ?>" enctype="multipart/form-data">
          <?php if ($view_cp['cp_detail_inves'] == "") { ?>
            <div class="form-row">
                <div class="col-md-8">
                        <label><b>Detail of investigate</b></label>
                        <textarea name="cp_detail_inves" id="cp_detail_inves" class="form-control pri" rows="3"></textarea>
                    </div>
                </div>
          

                <div class="form-row">
                    <div class="col-md-6 pri">
                        <p><input name="cp_detail_inves_file" id="cp_detail_inves_file" type="file" class="form-control form-control-sm" value=""/></p>
                    </div>
                </div>

                <div class="col-md-12 pri">
                    <div class="col-md-3"><label><b>Signature : </b><?php echo $getuser['username']; ?></label></div>
                    <div class="col-md-3"><label><b>Department : </b><?php echo $getuser['Dept']; ?></label></div>
                    <div class="col-md-3"><label><b>Date : </b><?php echo date("d/m/Y"); ?></label></div>

                    <input type="text" name="cp_detail_inves_signature" id="cp_detail_inves_signature" hidden="" value="<?php echo $getuser['username']; ?>"/>
                    <input type="text" name="cp_detail_inves_dept" id="cp_detail_inves_dept" hidden="" value="<?php echo $getuser['Dept']; ?>"/>
                    <input type="text" name="cp_detail_inves_date" id="cp_detail_inves_date" hidden="" value="<?php echo date("Y-m-d"); ?>"/>
                </div>
                    
                            <?php }else{ ?>
          
                <div class="form-row">
                <div class="col-md-8">
                        <label><b>Detail of investigate</b></label>
                        <textarea name="cp_detail_inves" id="cp_detail_inves" class="form-control pri" rows="3"><?php echo $view_cp['cp_detail_inves']; ?></textarea>
                    </div>
                </div>
          

                <div class="form-row">
                    <div class="col-md-6 pri">
                        <p><label><b>Attached file : </b><a href="<?php echo base_url(); ?>asset/investigate/detail_inves/<?php echo $view_cp['cp_detail_inves_file']; ?>" target="_blank"><?php echo $view_cp['cp_detail_inves_file']; ?></a></label></p>
                    </div>
                </div>

                <div class="col-md-12 pri">
                    <div class="col-md-3"><label><b>Signature : </b><?php echo $view_cp['cp_detail_inves_signature']; ?></label></div>
                    <div class="col-md-3"><label><b>Department : </b><?php echo $view_cp['cp_detail_inves_dept']; ?></label></div>
                    <div class="col-md-3"><label><b>Date : </b><?php $date = date_create($view_cp['cp_detail_inves_date']);
                            echo date_format($date, "d/m/Y"); ?></label></div>

                    <input type="text" name="cp_detail_inves_signature" id="cp_detail_inves_signature" hidden="" value="<?php echo $view_cp['cp_detail_inves_signature']; ?>"/>
                    <input type="text" name="cp_detail_inves_dept" id="cp_detail_inves_dept" hidden="" value="<?php echo $view_cp['cp_detail_inves_dept']; ?>"/>
                    <input type="text" name="cp_detail_inves_date" id="cp_detail_inves_date" hidden="" value="<?php echo $view_cp['cp_detail_inves_date']; ?>"/>
                </div>

                            <?php } ?>
          
          <div class="col-md-12 pri">
              <label><b>Related Department.</b></label>
              <?php foreach ($get_dept as $gdn): ?>
                  <label><?php echo $gdn['Dept'] . "&nbsp;,"; ?></label>&nbsp;
              <?php endforeach; ?>  
          </div>
          
          
          <?php
          $ckd_result = 0;
          foreach ($get_dept as $check_dept) {
              if ($check_dept['cp_dept_code'] !== $getuser['DeptCode']) {
                  continue;
              }
              $ckd_result = 1;
          }
          ?>
          <input hidden="" type="text" name="check_dept_inves" id="check_dept_inves" value="<?php echo $ckd_result;?>" />
            <div class="col-md-3 result_pms_inves"><input type="submit" name="" id="" value="Submit" class="btn btn-primary btn-block" onclick="javascript:return confirm('ก่อนที่ท่านจะทำการยืนยันการบันทึกข้อมูลนั้น ท่านได้ทำการสอบสวนเหตุกาณ์ที่เกิดขึ้น ร่วมกับ หน่วยงานที่เกี่ยวข้อง มาเป็นอย่างดีแล้ว ใช่หรือไม่ หากใช่ กรุณาทำการกดยืนยันการบันทึกข้อมูล เพื่อเข้าสู่ขั้นตอนต่อไป');"/></div>             
          </form>
          
          
          
          <div class="form-row">
          <form name="history_invesform" method="post" action="<?php echo base_url(); ?>history/save_inves_history/<?php echo $view_cp['cp_no']; ?>" enctype="multipart/form-data">
                <div class="form-row">
                <div class="col-md-8">
                    <input hidden="" type="text" name="cp_detail_inves_cpno" id="cp_detail_inves_cpno" value="<?php echo $view_cp['cp_no']; ?>" />
                    <label hidden=""><b>Detail of investigate</b></label>
                    <textarea hidden="" name="cp_detail_inves_his" id="cp_detail_inves_his" rows="3"><?php echo $view_cp['cp_detail_inves']; ?></textarea>
                    </div>
                </div>
 
                <div class="form-row">
                    <div class="col-md-6 pri">
                        <input hidden="" type="text" name="cp_detail_inves_filehis" id="cp_detail_inves_filehis" value="<?php echo $view_cp['cp_detail_inves_file']; ?>" />
                    </div>
                </div>

                <div class="col-md-12 pri">
                    <input hidden="" type="text" name="cp_detail_inves_signaturehis" id="cp_detail_inves_signature"  value="<?php echo $view_cp['cp_detail_inves_signature']; ?>"/>
                    <input hidden="" type="text" name="cp_detail_inves_depthis" id="cp_detail_inves_dept"  value="<?php echo $view_cp['cp_detail_inves_dept']; ?>"/>
                    <input hidden="" type="text" name="cp_detail_inves_datehis" id="cp_detail_inves_date"  value="<?php echo $view_cp['cp_detail_inves_date']; ?>"/>
                    
                    <input hidden="" type="text" name="his_action" id="his_action" value="Start Edit Investigate" />
                    <input hidden="" type="text" name="his_user_modify" id="his_user_modify" value="<?php echo $getuser['username']; ?>" />
                    <input hidden="" type="text" name="his_date_modify" id="his_date_modify" value="<?php echo date("Y/m/d H:i:s"); ?>" />
                    
                </div>
              <div class="col-md-12"><input class="btn btn-info" type="submit" name="btn_save_history" id="btn_save_history" value="Edit" /></div>
            </form>
      </div>
      </div>
          
    
    
    
    
    
        
        
        
        
    
    
</div>              





<!--***************************************INVESTIGATION SECTION*******************************************-->





<!--***********************************SUMMARY OF INVESTIGATION***************************************-->

<div class="panel panel-warning">
      <div class="panel-heading">Summary of Investigation</div>
      <div class="panel-body">
      
      <form name="invesform" method="post" action="<?php echo base_url(); ?>complaint/add_sum_inves/<?php echo $view_cp['cp_no']; ?>" enctype="multipart/form-data"> 
       <?php if ($view_cp['cp_sum_inves'] == "") { ?>
            <div class="form-row">
                <div class="col-md-8">
                        <label><b>Detail Summary of Investigation</b></label>
                        <textarea name="cp_sum_inves" id="cp_sum_inves" class="form-control pri" rows="3"></textarea>
                    </div>
                </div>
          

                <div class="form-row">
                    <div class="col-md-6 pri">
                        <p><input name="cp_sum_inves_file" id="cp_sum_inves_file" type="file" class="form-control form-control-sm" value=""/></p>
                    </div>
                </div>
          
                <div class="form-row">
                    <div class="col-md-8 pri">
                        <div class="col-md-4 form-group">
                            <label><b>ไม่เป็นข้อบกพร่องของบริษัท :</b></label>
                            <input type="radio" id="cp_sum" name="cp_sum" value="no" />
                        </div>
                        <div class="col-md-4">
                            <label><b>เป็นข้อบกพร่องของบริษัท :</b></label>
                            <input type="radio" id="cp_sum" name="cp_sum" value="yes"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 pri">
                    <div class="col-md-3"><label><b>Signature : </b><?php echo $getuser['username']; ?></label></div>
                    <div class="col-md-3"><label><b>Department : </b><?php echo $getuser['Dept']; ?></label></div>
                    <div class="col-md-3"><label><b>Date : </b><?php echo date("d/m/Y"); ?></label></div>

                    <input type="text" name="cp_sum_inves_signature" id="cp_sum_inves_signature" hidden="" value="<?php echo $getuser['username']; ?>"/>
                    <input type="text" name="cp_sum_inves_dept" id="cp_sum_inves_dept" hidden="" value="<?php echo $getuser['Dept']; ?>"/>
                    <input type="text" name="cp_sum_inves_date" id="cp_sum_inves_date" hidden="" value="<?php echo date("Y-m-d"); ?>"/>
                </div>
                    
                            <?php }else{ ?>
          
                <div class="form-row">
                <div class="col-md-8">
                        <label><b>Detail Summary of Investigation</b></label>
                        <textarea name="cp_sum_inves" id="cp_sum_inves" class="form-control pri" rows="3"><?php echo $view_cp['cp_sum_inves']; ?></textarea>
                    </div>
                </div>
          

                <div class="form-row">
                    <div class="col-md-6 pri">
                        <p><label><b>Attached file : </b><a href="<?php echo base_url(); ?>asset/investigate/sum_inves/<?php echo $view_cp['cp_sum_inves_file']; ?>" target="_blank"><?php echo $view_cp['cp_sum_inves_file']; ?></a></label></p>
                    </div>
                </div>
          
          
          <input type="text" name="radio_check" id="radio_check" value="<?php echo $view_cp['cp_sum']; ?>" hidden=""/>
                <div class="form-row">
                    <div class="col-md-8 pri">
                    <div class="col-md-4">
                            <label><b>ไม่เป็นข้อบกพร่องของบริษัท :</b></label>
                            <input type="radio" id="cp_sum_no" name="cp_sum" value="no" />
                        </div>
                        <div class="col-md-4">
                            <label><b>เป็นข้อบกพร่องของบริษัท :</b></label>
                            <input type="radio" id="cp_sum_yes" name="cp_sum" value="yes"/>
                        </div>
                    </div>
                </div>
          
          

                <div class="col-md-12 pri">
                    <div class="col-md-3"><label><b>Signature : </b><?php echo $view_cp['cp_sum_inves_signature']; ?></label></div>
                    <div class="col-md-3"><label><b>Department : </b><?php echo $view_cp['cp_sum_inves_dept']; ?></label></div>
                    <div class="col-md-3"><label><b>Date : </b><?php $date = date_create($view_cp['cp_sum_inves_date']);
                            echo date_format($date, "d/m/Y"); ?></label></div>

                </div>

                            <?php } ?>
          
          <div class="col-md-12 pri">
              <label><b>Related Department.</b></label>
              <?php foreach ($get_dept as $gdn): ?>
                  <label><?php echo $gdn['Dept'] . "&nbsp;,"; ?></label>&nbsp;
              <?php endforeach; ?>  
          </div>
          
          
          <?php
          $ckd_result = 0;
          foreach ($get_dept as $check_dept) {
              if ($check_dept['cp_dept_code'] !== $getuser['DeptCode']) {
                  continue;
              }
              $ckd_result = 1;
          }
          ?>
          <input hidden="" type="text" name="check_dept_sum_inves" id="check_dept_sum_inves" value="<?php echo $ckd_result;?>" />
          
          
          <div class="col-md-12 pri">
              <span class="sum_text">For QMR only.</span>
              <input type="text" name="check_qmr" id="check_qmr" value="<?php echo $getuser['Dept']; ?>" hidden=""/>
          </div>
          
          <div class="col-md-3 result_pms_sum_inves"><input type="submit" name="btn_sum" id="btn_sum" value="Submit" class="btn btn-primary btn-block" onclick="javascript:return confirm('ยืนยันการบันทึกข้อมูล');"/></div>
          
          </form>
          
          
          
          
          
      </div>
      
      
</div>




<!--***********************************SUMMARY OF INVESTIGATION***************************************-->




<!--***********************************CONCLUSION OF COMPLAINT***************************************-->
<form name="invesform" method="post" action="<?php echo base_url(); ?>complaint/add_conclusion/<?php echo $view_cp['cp_no']; ?>" enctype="multipart/form-data">
<div class="panel panel-warning conclusion">
      <div class="panel-heading">Conclusion of Complaint</div>
      <div class="panel-body">
          
      <?php if($view_cp['cp_conclu_detail']==""){ ?>
          <div class="form-row">
                <div class="col-md-8">
                        <label><b>Detail Conclusion of Complaint</b></label>
                        <textarea name="cp_conclu_detail" id="cp_conclu_detail" class="form-control pri" rows="3"></textarea>
                    </div>
                </div>
          
          
                <div class="form-row">
                    <div class="col-md-7 pri">
                        <label><b>Detail of Cost</b></label>
                        <input type="text" name="cp_conclu_costdetail" id="cp_conclu_costdetail" class="form-control form-control-sm"/>
                    </div>
                    <div class="col-md-5 pri">
                        <label><b>Cost</b></label>
                        <input type="text" name="cp_conclu_cost" id="cp_conclu_cost" class="form-control form-control-sm number"/>
                    </div>
                </div>
          

                <div class="form-row">
                    <div class="col-md-6 pri">
                        <p><input name="cp_conclu_file" id="cp_conclu_file" type="file" class="form-control form-control-sm" value=""/></p>
                    </div>
                </div>
          
          
                <div class="col-md-12 pri">
                    <div class="col-md-3"><label><b>Signature : </b><?php echo $getuser['username']; ?></label></div>
                    <div class="col-md-3"><label><b>Department : </b><?php echo $getuser['Dept']; ?></label></div>
                    <div class="col-md-3"><label><b>Date : </b><?php echo date("d/m/Y"); ?></label></div>

                    <input type="text" name="cp_conclu_signature" id="cp_conclu_signature" hidden="" value="<?php echo $getuser['username']; ?>"/>
                    <input type="text" name="cp_conclu_dept" id="cp_conclu_dept" hidden="" value="<?php echo $getuser['Dept']; ?>"/>
                    <input type="text" name="cp_conclu_date" id="cp_conclu_date" hidden="" value="<?php echo date("Y-m-d"); ?>"/>
                </div>
          
      <?php }else{ ?>
          
                <div class="form-row">
                <div class="col-md-8">
                        <label><b>Detail Conclusion of Complaint</b></label>
                        <textarea name="cp_conclu_detail" id="cp_conclu_detail" class="form-control pri" rows="3"><?php echo $view_cp['cp_conclu_detail']; ?></textarea>
                    </div>
                </div>
          
          
                <div class="form-row">
                    <div class="col-md-7 pri">
                        <label><b>Detail of Cost</b></label>
                        <input type="text" name="cp_conclu_costdetail" id="cp_conclu_costdetail" class="form-control form-control-sm" value="<?php echo $view_cp['cp_conclu_costdetail']; ?>"/>
                    </div>
                    <div class="col-md-5 pri">
                        <label><b>Cost</b></label>
                        <input type="text" name="cp_conclu_cost_show" id="cp_conclu_cost_show" class="form-control form-control-sm number" value="<?php echo $view_cp['cp_conclu_cost'] ?>"/>
                    </div>
                </div>
          

                <div class="form-row">
                    <div class="col-md-6 pri">
                        <p><label><b>Attached file : </b><a href="<?php echo base_url(); ?>asset/investigate/conclusion_inves/<?php echo $view_cp['cp_conclu_file']; ?>" target="_blank"><?php echo $view_cp['cp_conclu_file']; ?></a></label></p>
                    </div>
                </div>
          
          
                <div class="col-md-12 pri">
                    <div class="col-md-3"><label><b>Signature : </b><?php echo $view_cp['cp_conclu_signature']; ?></label></div>
                    <div class="col-md-3"><label><b>Department : </b><?php echo $view_cp['cp_conclu_dept']; ?></label></div>
                    <div class="col-md-3"><label><b>Date : </b>
                            
                        <?php  
                                      $date = date_create($view_cp['cp_conclu_date']);
                                      echo date_format($date, "d/m/Y");
                        ?>
                        
                        </label></div>

                    <input type="text" name="cp_conclu_signature" id="cp_conclu_signature" hidden="" value="<?php echo $getuser['username']; ?>"/>
                    <input type="text" name="cp_conclu_dept" id="cp_conclu_dept" hidden="" value="<?php echo $getuser['Dept']; ?>"/>
                    <input type="text" name="cp_conclu_date" id="cp_conclu_date" hidden="" value="<?php echo date("Y-m-d"); ?>"/>
                </div>
          
          
      <?php } ?>
          
          
          
                <div class="col-md-12 pri">
              <span class="sum_text">For QMR only.</span>
              <input type="text" name="check_qmr" id="check_qmr" value="<?php echo $getuser['Dept']; ?>" hidden=""/>
          </div>
          
                <div class="col-md-3 result_pms_conclu"><input type="submit" name="btn_conclu" id="btn_conclu" value="Submit" class="btn btn-primary btn-block" onclick="javascript:return confirm('ยืนยันการบันทึกข้อมูล');"/></div>
          
      </div>
</div>
</form>

<!--***********************************CONCLUSION OF COMPLAINT***************************************-->
            
        <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
     
        

        
        </div><!-- Main content page -->

    </body>
</html>
