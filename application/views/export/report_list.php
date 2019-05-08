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
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form name="form-export" method="post" action="<?php echo base_url("report/export_btn"); ?>">
                    <select name="export_type" id="export_type" class="form-control form-control-sm" style="margin-bottom: 5px;">
                        <option value="Complaint">Complaint</option>
                        <option value="NC">NC</option>
                        <!--nc_status_code LIKE '%nc%'-->
                    </select>
                    <input type="date" name="start_date_export" id="start_date_export" class="form-control"/>
                    <input type="date" name="end_date_export" id="end_date_export" class="form-control" style="margin-top: 5px;"/>
                    <input type="submit" name="export_btn" id="export_btn" value="Export" class="btn btn-success btn-block" style="margin-top: 5px;"/>
                </form>
            </div>
            <div class="col-md-3"></div>
            
        </div>
    </body>
</html>
