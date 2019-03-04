<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
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
              <p><span style="padding-left: 10px;">Hi <?php echo $getuser['username']; ?></span></p>
              <p><span style="padding-left: 10px;" class="check_dept">Dept. <?php echo $getuser['Dept']; ?></span></p>
              <input hidden="" type="text" name="check_user" id="check_user" value="<?php echo $getuser['username']; ?>" /><!--Check User-->
              <a href="<?php echo base_url('complaint/logout'); ?>" onclick="javascript:return confirm('คุณต้องการออกจากระบบหรือไม่');"><i class="fas fa-sign-out-alt fa-2x logout_btn"></i></a>
          </div>
          
        <ul class="nav navbar-nav">
<!--          <li><a href="#"><i class="far fa-eye"></i>&nbsp;View Complaint&nbsp;<h6><span class="label label-success">New&nbsp;<span class="badge bg_new">3</span></span></h6></a></li>
          <li><a href="#"><i class="fas fa-plus-circle"></i>&nbsp;New Complaint</a></li>
          <li><a href="#"><i class="far fa-eye"></i>&nbsp;View NC</a></li>-->
          
          <li class="dropdown" style="border-top:0.5px solid #54acf3;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-book-open"></i>&nbsp;Complaint <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>complaint"><i class="far fa-eye"></i>&nbsp;View&nbsp;<span class="label label-success">New&nbsp;<span class="badge bg_new">7</span></span></a></li>
              <li><a href="<?php echo base_url(); ?>complaint/add/<?php echo $getuser['DeptCode']; ?>"><i class="fas fa-plus-circle"></i>&nbsp;Add</a></li>
            </ul>
          </li>
          
          <li class="dropdown" style="border-top:0.5px solid #54acf3;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-book-open"></i>&nbsp;NC <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#"><i class="far fa-eye"></i>&nbsp;View&nbsp;<span class="label label-success">New&nbsp;<span class="badge bg_new">7</span></span></a></li>
              <li><a href="#"><i class="fas fa-plus-circle"></i>&nbsp;Add</a></li>
            </ul>
          </li>

          <li class="dropdown" style="border-top:0.5px solid #54acf3;">
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
          </li>
          
          <li class="dropdown" style="border-top:0.5px solid #54acf3;border-bottom:1px solid #54acf3;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-tools"></i>&nbsp;Setting <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Nav header</li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li>
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

      </div>
    </div>
  </nav>
    </body>
</html>
