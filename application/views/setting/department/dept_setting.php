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

        <div class="container-fulid">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                    <!-- panel -->
                    <h2 style="text-align: center;">Department Setting</h2>
                    <div class="panel panel-info">
                        <div class="panel-heading">Department Setting</div>
                        <div class="panel-body">


                            <table id="topic_cat" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:20%;text-align: center;">Department Code</th>
                                        <th style="width:100px;text-align: center;">Department Name</th>
                                        <th style="width:20%;text-align: center;">Modify</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($get_dept_setting as $vcate): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $vcate['cp_dept_main_code']; ?></td>
                                            <td style="text-align: center;"><?php echo $vcate['cp_dept_main_name']; ?></td>
                                            <td style="text-align: center;"><a href="javascript:popup_dept('<?php echo base_url("setting/dept_edit_setting/"); ?><?php echo $vcate['cp_dept_main_id']; ?>','',500,500)"><button class="btn btn-warning btn-xs">edit</button></a>&nbsp;<a href="<?php echo base_url("setting/del_dept_setting/"); ?><?php echo $vcate['cp_dept_main_id']; ?>"><button name="btn_cat_del" id="btn_cat_del" class="btn btn-danger btn-xs" onclick="javascript:return confirm('Are you sure?');">Del</button></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                                <!-- Start code popup -->
                            <script type="text/javascript">
                                function popup_dept(url, name, windowWidth, windowHeight) {
                                    myleft = (screen.width) ? (screen.width - windowWidth) / 2 : 100;
                                    mytop = (screen.height) ? (screen.height - windowHeight) / 2 : 100;
                                    properties = "width=" + windowWidth + ",height=" + windowHeight;
                                    properties += ",scrollbars=yes, top=" + mytop + ",left=" + myleft;
                                    window.open(url, name, properties);
                                }
                            </script>

                            </table>

                            <script type="text/javascript" >
                                $(document).ready(function () {
                                    $('#topic_cat').DataTable({
                                        "order": [[0, "asc"]]
                                    });
                                });
                            </script>
                            <hr>
                            <div class="col-md-12 form-inline">
                                <form action="<?php echo base_url("setting/add_dept/"); ?>" method="post" name="frm_addcate">
                                    <div class=" form-inline">
                                        <input type="text" name="add_catename" id="add_catename" placeholder="Add Category Name" class="form-control"/>
                                        <input type="text" name="add_catcode" id="add_catcode" placeholder="Add Category Code" class="form-control" />
                                        <input type="submit" name="btn_addcate" id="btn_addcate" class="btn btn-primary btn-xs" value="ADD"/>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <!-- endpanel -->

                </div>
            <div class="col-md-3"></div>

        </div>
    </body>
</html>
