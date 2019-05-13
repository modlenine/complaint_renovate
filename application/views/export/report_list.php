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
                        <!--nc_status_code LIKE '%nc%'-->
                    </select>
                    <!-- <input type="date" name="start_date_export" id="start_date_export" class="form-control"/>
                    <input type="date" name="end_date_export" id="end_date_export" class="form-control" style="margin-top: 5px;"/>
                    <input type="submit" name="export_btn" id="export_btn" value="Export" class="btn btn-success btn-block" style="margin-top: 5px;"/> -->



          </div>

          <!-- Complaint List -->
          <div class="col-md-12">
              <select class="form-control" name="cptype_export" id="cptype_export">
                  <option value="">- Please choose choice -</option>
                  <option value="Status">By Status</option>
                  <option value="Department">By Department</option>
                  <option value="">By User</option>
                  <option value="">By Topic</option>
                  <option value="">By Category</option>
              </select>
          </div>


          <!-- By status -->
          <form  action="#" method="post">
            <div class="col-md-12" style="margin-top:5px;">
                <select class="form-control" name="by_status" id="by_status">
                  <?php foreach ($expcp_getstatus->result() as $expcp) { ?>

                    <option value="<?php echo $expcp->cp_status_id; ?>"><?php echo $expcp->cp_status_name; ?></option>

                  <?php } ?>
                </select>
            </div>
          </form>

          <!-- By Dept -->
          <form  action="#" method="post">
          <div class="col-md-12">
              <select class="form-control" name="by_dept" id="by_dept">
              <?php foreach ($expcp_getdept->result() as $expcp_getdepts) { ?>
                  <option value="<?php echo $expcp_getdepts->cp_user_dept; ?>"><?php echo $expcp_getdepts->cp_user_dept; ?></option>
              <?php  } ?>
              </select>
          </div>
        </form>


        <!-- By User -->
        <form  action="#" method="post">
        <div class="col-md-12">
            <select class="form-control" name="by_user" id="by_user">
            <?php foreach ($expcp_getdept->result() as $expcp_getdepts) { ?>
                <option value="<?php echo $expcp_getdepts->cp_user_dept; ?>"><?php echo $expcp_getdepts->cp_user_dept; ?></option>
            <?php  } ?>
            </select>
        </div>
      </form>






          <div class="col-md-12">
              <select class="form-control" name="nctype_export" id="nctype_export">
                  <option value="">- Please choose choice -</option>
                  <option value="">By Status</option>
                  <option value="">By Department</option>
                  <option value="">By User</option>
                  <option value="">By Topic</option>
                  <option value="">By Category</option>
              </select>
          </div>




        </div>



    </body>
</html>
