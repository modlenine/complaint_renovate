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
        
        
        <div class="container" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;"><!--Main Container-->
            
            <h1 class="h1_add">Investigation ( Edit ): <?php echo $view_cp['cp_no']; ?></h1><hr>
                <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
            
            <div class="panel panel-warning">
    <div class="panel-heading">Investigation (Edit)</div>
      
      <form name="invesform_edit" method="post" action="<?php echo base_url(); ?>complaint/save_edit_investigate/<?php echo $view_cp['cp_no']; ?>" enctype="multipart/form-data">
      <div class="panel-body">
          
                <div class="form-group">
                <div class="col-md-12">
                        <label><b>Detail of investigate</b></label>
                        <textarea name="cp_detail_inves_edit" id="cp_detail_inves_edit" class="form-control pri" rows="3"><?php echo $view_cp['cp_detail_inves']; ?></textarea>
                    </div>
                </div>
          

                <div class="form-group">
                    <div class="col-md-8 pri">
                        <p><label><b>Attached file : </b><a href="<?php echo base_url(); ?>asset/investigate/detail_inves/<?php echo $view_cp['cp_detail_inves_file']; ?>" target="_blank"><?php echo $view_cp['cp_detail_inves_file']; ?></a></label></p>
                        <input hidden="" type="text" name="inves_showfile" id="inves_showfile" value="<?php echo $view_cp['cp_detail_inves_file']; ?>" />
                        <p><input type="file" name="cp_detail_inves_file_edit" id="cp_detail_inves_file_edit" class="form-control"/></p>
                        <span style="color:red;font-size:12px;">Max file size = 1MB and word , pdf only</span>
                    </div>
                </div>

          
          
          <div class="form-inline col-md-8">
              <label><b>Signature : </b><?php echo $view_cp['cp_detail_inves_signature']; ?></label>
              <label><b>Department : </b><?php echo $view_cp['cp_detail_inves_dept']; ?></label>
              <label><b>Date : </b><?php $date = date_create($view_cp['cp_detail_inves_date']);
                            echo date_format($date, "d/m/Y"); ?></label>
          </div>
          
          
                <div class="col-md-12 pri">
<!--                    <div class="col-md-4"><label><b>Signature : </b><?php echo $view_cp['cp_detail_inves_signature']; ?></label></div>
                    <div class="col-md-4"><label><b>Department : </b><?php echo $view_cp['cp_detail_inves_dept']; ?></label></div>
                    <div class="col-md-4"><label><b>Date : </b><?php $date = date_create($view_cp['cp_detail_inves_date']);
                            echo date_format($date, "d/m/Y"); ?></label></div>-->

                    <input type="text" name="cp_detail_inves_signature" id="cp_detail_inves_signature" hidden="" value="<?php echo $view_cp['cp_detail_inves_signature']; ?>"/>
                    <input type="text" name="cp_detail_inves_dept" id="cp_detail_inves_dept" hidden="" value="<?php echo $view_cp['cp_detail_inves_dept']; ?>"/>
                    <input type="text" name="cp_detail_inves_date" id="cp_detail_inves_date" hidden="" value="<?php echo $view_cp['cp_detail_inves_date']; ?>"/>
                    
                    <input hidden="" type="text" name="cp_detail_inves_action" id="cp_detail_inves_action" value="Edit Complete" />
                    <input hidden="" type="text" name="cp_detail_inves_usermodify" id="cp_detail_inves_usermodify" value="<?php echo $getuser['username']; ?>" />
                    <input hidden="" type="text" name="cp_detail_inves_datemodify" id="cp_detail_inves_datemodify" value="<?php echo date("Y/m/d H:i:s"); ?>" />
                </div>
          
          
          

          
          <div class="col-md-12 pri">
              <div><!--Zone history-->
                  <input hidden="" type="text" name="his_cpno" id="his_cpno" value="<?php echo $view_cp['cp_no']; ?>" />
          </div>
              
              
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
          
        <div class="form-group col-md-8">
              <label class="sec4label">Reason for revision</label>
              <textarea name="his_memo" id="his_memo" class="form-control"></textarea>
              <input style="margin-top: 5px;" type="submit" name="btn_inves_edit" id="btn_inves_edit" value="Update" class="btn btn-primary" onclick="javascript:return confirm('ก่อนที่ท่านจะทำการยืนยันการบันทึกข้อมูลนั้น ท่านได้ทำการสอบสวนเหตุกาณ์ที่เกิดขึ้น ร่วมกับ หน่วยงานที่เกี่ยวข้อง มาเป็นอย่างดีแล้ว ใช่หรือไม่ หากใช่ กรุณาทำการกดยืนยันการบันทึกข้อมูล เพื่อเข้าสู่ขั้นตอนต่อไป');"/>
        </div>
          

          
          
          
      </div>
          
          </form>
</div>  
            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
        </div><!--Main Container-->
        
 
    </body>
</html>
