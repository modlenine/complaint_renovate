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
        <div class="container login_margin">
            <!-- <div style="text-align:center;margin:10px;"><img src="<?php echo base_url("asset/NewLogo.png"); ?>" alt="" width="250"></div> -->

            <div class="panel panel-info form_layout">
                <div class="panel-heading"><h3>Complaint Login Form</h3></div>
                <div class="panel-body">
                    <form name="" id="" action="<?php echo base_url('login/check_login'); ?>" method="post">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username"/>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
                        </div><br>

                        <input type="submit" name="btn_login" id="btn_login" value="login" class="btn btn-primary"/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
