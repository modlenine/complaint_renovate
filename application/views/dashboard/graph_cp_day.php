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


          <div id="container" class="container-fulid" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">
            <div class="form-inline">
          <a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a>
          </div>


          <?php $this->load->view("dashboard/dashboard_sec1"); ?>
<hr>
          <?php $this->load->view("dashboard/graph_cp_year"); ?>

          <?php $this->load->view("dashboard/graph_cp_days"); ?>


        </div>
    </body>
</html>
