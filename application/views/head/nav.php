<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$this->load->view("head/javascript");
    $this->load->model("complaint_model");
?>
<html>
    <head>
        <meta charset="UTF-8">


    </head>
    <body>
    <?php
    $cutLname = substr($getuser['Lname'],0,1);
    $convert_name = $getuser['Fname']."_".$cutLname;
    ?>


<nav class="navbar navbar-inverse navbar-fixed-left">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
          <a class="navbar-brand" href="#">Salee Colour</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
          <div>
              <p><span style="padding-left: 10px;"><i class="fas fa-user"></i>&nbsp;Hi <?php echo $convert_name; ?></span></p>
              <p><span style="padding-left: 10px;" class="check_dept">Dept. <?php echo $getuser['Dept']; ?></span></p>

              <input hidden="" type="text" name="check_user" id="check_user" value="<?php echo $convert_name; ?>" /><!--Check User-->
              <input hidden="" type="text" name="check_dept" id="check_dept" value="<?php echo $getuser['Dept']; ?>" /><!-- Check Dept -->
              <input hidden="" type="text" name="check_posi" id="check_posi" value="<?php echo $getuser['posi']; ?>" /><!-- Check Posi -->
              <input hidden type="text" name="check_tecnical" id="check_tecnical" value="<?php echo $getuser['memberemail']; ?>"><!-- Check Technical -->


              <a href="<?php echo base_url('complaint/logout'); ?>"><button style="margin:5px;" class="btn btn-danger btn-sm" type="button" name="button" onclick="javascript:return confirm('คุณต้องการออกจากระบบใช่หรือไม่')">Logout</button></a>
          </div>

        <ul class="nav navbar-nav">
<!--          <li><a href="#"><i class="far fa-eye"></i>&nbsp;View Complaint&nbsp;<h6><span class="label label-success">New&nbsp;<span class="badge bg_new">3</span></span></h6></a></li>
          <li><a href="#"><i class="fas fa-plus-circle"></i>&nbsp;New Complaint</a></li>
          <li><a href="#"><i class="far fa-eye"></i>&nbsp;View NC</a></li>-->

            <li class="dropdown" style="border-top:0.5px solid #54acf3;"><a href="<?php echo base_url("dashboard"); ?>"><i class="fas fa-tachometer-alt"></i>&nbsp;Dash Board</a></li>


            <?php
                if($this->complaint_model->get_newcp() == 0){
                    $newcp = 'display:none;';
                }else{
                    $newcp = "";
                }
                if($this->complaint_model->get_newnc() == 0){
                    $newnc = 'display:none;';
                }else{
                    $newnc = "";
                }
            ?>

            <li class="dropdown" style="border-top:0.5px solid #54acf3;"><a href="<?php echo base_url(); ?>complaint"><i class="fas fa-book-open"></i>&nbsp;Complaint &nbsp;&nbsp;<span class="label label-success" style="<?php echo $newcp; ?>">New&nbsp;<span class="badge bg_new"><?php echo $this->complaint_model->get_newcp(); ?></span></span></a></li>



            <li class="dropdown" style="border-top:0.5px solid #54acf3;"><a href="<?php echo base_url(); ?>nc"><i class="fas fa-book-open"></i>&nbsp;NC &nbsp;&nbsp;<span class="label label-success" style="<?php echo $newnc; ?>">New&nbsp;<span class="badge bg_new"><?php echo $this->complaint_model->get_newnc(); ?></span></span></a></li>
            <input hidden="" type="text" name="check_numrow_nc" id="check_numrow_nc" value="<?php echo $this->complaint_model->get_newnc(); ?>"/><!--check nc row-->


            <li class="dropdown" style="border-top:0.5px solid #54acf3;"><a href="<?php echo base_url("search/export_section"); ?>"><i class="fas fa-file-export"></i>&nbsp;Export</a></li>



<!--          <li class="dropdown" style="border-top:0.5px solid #54acf3;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>&nbsp;User Profile <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Nav header</li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>-->

          <?php
            if($getuser['posi'] == 15 || $getuser['posi'] == 55 || $getuser['posi'] == 85 || $getuser['posi'] == 65 || $getuser['posi'] == 45 || $getuser['posi'] == 75 || $getuser['posi'] == 35){
                $display = 'display:none;';
            }
            if($getuser['DeptCode'] == 1002){
                $display = '';
            }
          ?>
<!--Check permission-->

          <li class="dropdown user_permission" style="border-top:0.5px solid #54acf3;border-bottom:1px solid #54acf3;<?php echo $display; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-tools"></i>&nbsp;Setting <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="dropdown-header">Complaint</li>
              <li><a href="<?php echo base_url("setting/topic_setting"); ?>">Topic Setting</a></li>
              <li><a href="<?php echo base_url("setting/dept_setting"); ?>">Department Setting</a></li>
              <li><a href="<?php echo base_url("setting/priority_setting"); ?>">Priority Setting</a></li>
              <li role="separator" class="divider"></li>
<!--              <li class="dropdown-header">NC</li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li>-->
            </ul>
          </li>
        </ul>

<!--        <ul class="nav navbar-nav navbar-right">
          <li>
            <a data-class="navbar-fixed-left">
              <i class="fa fa-arrow-left"></i>
              Fixed Left
            </a>
          </li>
          <li>
            <a data-class="navbar-fixed-top">
              <i class="fa fa-arrow-up"></i>
              Fixed Top
              <small>(original)</small>
            </a>
          </li>
          <li>
            <a data-class="navbar-fixed-right">
              <i class="fa fa-arrow-right"></i>
              Fixed Right
            </a>
          </li>
        </ul>-->
        <div style="margin-top:10px;"></div>
        <div id="user_login_status" style="margin-top:10px;width:90%;margin:auto;"></div>
      </div>
    </div>
  </nav>
    </body>
</html>
