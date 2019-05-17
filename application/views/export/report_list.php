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
        <?php
        $this->load->view("head/nav");
        ?>
        <div class="container">
            <h1 style="text-align: center;">Export Form</h1>
            <div class="col-md-12">

                    <select name="export_type" id="export_type" class="form-control form-control-sm" style="margin-bottom: 5px;">
                        <option value="">- Please choose choice -</option>
                        <option value="Complaint">Complaint</option>
                        <option value="NC">NC</option>
                    </select>
          </div>

          <div class="col-md-12">
              <select class="form-control" name="nctype_export" id="nctype_export">
                  <option value="">- Please Choose NC Choice -</option>
                  <option value="All">By All</option>
                  <option value="Status">By Status</option>
                  <option value="Department">By Department</option>
                  <option value="User">By User</option>
                  <option value="Category">By Category</option>
              </select>
          </div>

          <!-- Complaint List -->
          <div class="col-md-12">
              <select class="form-control" name="cptype_export" id="cptype_export">
                  <option value="">- Please Choose CP Choice -</option>
                  <option value="All">By All</option>
                  <option value="Status">By Status</option>
                  <option value="Department">By Department</option>
                  <option value="User">By User</option>
                  <option value="Category">By Category</option>
              </select>
          </div>


          <!--CP By All -->
          <form action="<?php echo base_url('report/exp_cpby_all/'); ?>" method="post">
            <div class="col-md-12 step2"  style="margin-top:5px;">
                <input class="btn btn-success btn_all" type="submit" name="btn_all" value="Export All">
            </div>
          </form>


          <!--CP By status -->
          <form  action="<?php echo base_url('report/exp_cpby_status/'); ?>" method="post">
            <div class="col-md-12 step2" style="margin-top:5px;">
                <select class="form-control" name="by_status" id="by_status">
                  <?php foreach ($expcp_getstatus->result() as $expcp) { ?>

                    <option value="<?php echo $expcp->cp_status_id; ?>"><?php echo $expcp->cp_status_name; ?></option>

                  <?php } ?>
                </select>
                <input style="margin-top:5px;" class="btn btn-success btn_status" type="submit" name="btn_status" value="Export">
            </div>
          </form>

          <!--CP By Dept -->
          <form  action="<?php echo base_url('report/exp_cpby_dept/'); ?>" method="post">
          <div class="col-md-12 step2">
              <select class="form-control" name="by_dept" id="by_dept">
              <?php foreach ($expcp_getdept->result() as $expcp_getdepts) { ?>
                  <option value="<?php echo $expcp_getdepts->cp_user_dept; ?>"><?php echo $expcp_getdepts->cp_user_dept; ?></option>
              <?php  } ?>
            </select>
              <input style="margin-top:5px;" class="btn btn-success btn_dept" type="submit" name="btn_dept" value="Export">
          </div>
        </form>


        <!--CP By User -->
        <form  action="<?php echo base_url('report/exp_cpby_user/'); ?>" method="post">
        <div class="col-md-12 step2">
            <select class="form-control" name="by_user" id="by_user">
            <?php foreach ($expcp_getuser->result() as $expcp_getusers) { ?>
                <option value="<?php echo $expcp_getusers->cp_user_name; ?>"><?php echo $expcp_getusers->cp_user_name; ?></option>
            <?php  } ?>
          </select>
            <input style="margin-top:5px;" class="btn btn-success btn_user" type="submit" name="btn_user" value="Export">
        </div>
      </form>


      <!--CP By Category -->
      <form  action="<?php echo base_url('report/exp_cpby_cat/'); ?>" method="post">
      <div class="col-md-12 step2">
          <select class="form-control" name="by_category" id="by_category">
          <?php foreach ($expcp_getcat->result() as $expcp_getcats) { ?>
              <option value="<?php echo $expcp_getcats->topic_cat_id; ?>"><?php echo $expcp_getcats->topic_cat_name; ?></option>
          <?php  } ?>
        </select>
          <input style="margin-top:5px;" class="btn btn-success btn_cat" type="submit" name="btn_cat" value="Export">
      </div>
    </form>

<!-- **************************************** -->

    <!--NC By All -->
    <form action="<?php echo base_url('report/exp_ncby_all/'); ?>" method="post">
      <div class="col-md-12 step2nc"  style="margin-top:5px;">
          <input class="btn btn-success btn_all_nc" type="submit" name="btn_all_nc" value="Export All">
      </div>
    </form>


    <!--NC By status -->
    <form  action="<?php echo base_url('report/exp_ncby_status/'); ?>" method="post">
      <div class="col-md-12 step2nc" style="margin-top:5px;">
          <select class="form-control" name="by_status_nc" id="by_status_nc">
            <?php foreach ($expnc_getstatus->result() as $expnc) { ?>

              <option value="<?php echo $expnc->cp_status_id; ?>"><?php echo $expnc->cp_status_name; ?></option>

            <?php } ?>
          </select>
          <input style="margin-top:5px;" class="btn btn-success btn_status_nc" type="submit" name="btn_status_nc" value="Export">
      </div>
    </form>

    <!--NC By Dept -->
    <form  action="<?php echo base_url('report/exp_ncby_dept/'); ?>" method="post">
    <div class="col-md-12 step2nc">
        <select class="form-control" name="by_dept_nc" id="by_dept_nc">
        <?php foreach ($expnc_getdept->result() as $expnc_getdepts) { ?>
            <option value="<?php echo $expnc_getdepts->cp_dept_main_code; ?>"><?php echo $expnc_getdepts->cp_dept_main_name; ?></option>
        <?php  } ?>
      </select>
        <input style="margin-top:5px;" class="btn btn-success btn_dept_nc" type="submit" name="btn_dept_nc" value="Export">
    </div>
  </form>


  <!--NC By User -->
  <form  action="<?php echo base_url('report/exp_ncby_user/'); ?>" method="post">
  <div class="col-md-12 step2nc">
      <select class="form-control" name="by_user_nc" id="by_user_nc">
      <?php foreach ($expnc_getuser->result() as $expnc_getusers) { ?>
          <option value="<?php echo $expnc_getusers->cp_user_name; ?>"><?php echo $expnc_getusers->cp_user_name; ?></option>
      <?php  } ?>
    </select>
      <input style="margin-top:5px;" class="btn btn-success btn_user_nc" type="submit" name="btn_user_nc" value="Export">
  </div>
</form>


<!--NC By Category -->
<form  action="<?php echo base_url('report/exp_ncby_cat/'); ?>" method="post">
<div class="col-md-12 step2nc">
    <select class="form-control" name="by_category_nc" id="by_category_nc">
    <?php foreach ($expnc_getcat->result() as $expnc_getcats) { ?>
        <option value="<?php echo $expnc_getcats->topic_cat_id; ?>"><?php echo $expnc_getcats->topic_cat_name; ?></option>
    <?php  } ?>
  </select>
    <input style="margin-top:5px;" class="btn btn-success btn_cat_nc" type="submit" name="btn_cat_nc" value="Export">
</div>
</form>











        </div>



    </body>
</html>
