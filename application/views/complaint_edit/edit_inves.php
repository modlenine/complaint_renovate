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
        <div class="panel panel-warning">
    <div class="panel-heading">Investigation (Edit)</div>
      
      <form name="invesform" method="post" action="<?php echo base_url(); ?>complaint/add_detail_inves/<?php echo $view_cp['cp_no']; ?>" enctype="multipart/form-data">
      <div class="panel-body">
          
                <div class="form-row">
                <div class="col-md-8">
                        <label><b>Detail of investigate</b></label>
                        <textarea name="cp_detail_inves" id="cp_detail_inves" class="form-control pri" rows="3"><?php echo $view_cp['cp_detail_inves']; ?></textarea>
                    </div>
                </div>
          

                <div class="form-row">
                    <div class="col-md-6 pri">
                        <p><label><b>Attached file : </b><a href="<?php echo base_url(); ?>asset/<?php echo $view_cp['cp_detail_inves_file']; ?>" target="_blank"><?php echo $view_cp['cp_detail_inves_file']; ?></a></label></p>
                    </div>
                </div>

                <div class="col-md-12 pri">
                    <div class="col-md-3"><label><b>Signature : </b><?php echo $view_cp['cp_detail_inves_signature']; ?></label></div>
                    <div class="col-md-3"><label><b>Department : </b><?php echo $view_cp['cp_detail_inves_dept']; ?></label></div>
                    <div class="col-md-3"><label><b>Date : </b><?php $date = date_create($view_cp['cp_detail_inves_date']);
                            echo date_format($date, "d/m/Y"); ?></label></div>

                    <input type="text" name="cp_detail_inves_signature" id="cp_detail_inves_signature" hidden="" value="<?php echo $getuser['username']; ?>"/>
                    <input type="text" name="cp_detail_inves_dept" id="cp_detail_inves_dept" hidden="" value="<?php echo $getuser['Dept']; ?>"/>
                    <input type="text" name="cp_detail_inves_date" id="cp_detail_inves_date" hidden="" value="<?php echo date("Y-m-d"); ?>"/>
                </div>

          
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
          
          
      </div>
          </form>
</div>              
    </body>
</html>
