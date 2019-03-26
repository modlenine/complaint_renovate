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
        <!-- navleft -->
        <?php
        $this->load->view("head/nav");
        ?>

        <!-- container -->
        <div class="container">
            <h2 style="text-align:center;">Topic Setting</h2>


            <!--View Topic name and category-->
            <div class="row">
                <div class="col-md-6">

                    <!-- panel -->
                    <div class="panel panel-info" id="topicreload">
                        <div class="panel-heading">Topic Setting</div>
                        <div class="panel-body">


                            <table id="topic" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:100px;text-align: center;">Topic Name</th>
                                        <th style="width:100px;text-align: center;">Category</th>
                                        <th style="width:20%;text-align: center;">Modify</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($view_topic as $vtopic): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $vtopic['topic_name']; ?></td>
                                            <td style="text-align: center;"><?php echo $vtopic['topic_cat_name']; ?></td>
                                            <td style="text-align: center;"><a href="javascript:popup('<?php echo base_url("setting/topic_edit/"); ?><?php echo $vtopic['topic_id']; ?>','',500,500)"><button class="btn btn-warning btn-xs">edit</button></a>&nbsp;<a href="<?php echo base_url("setting/del_topic/"); ?><?php echo $vtopic['topic_id']; ?>"><button name="btn_topic_del" id="btn_topic_del" class="btn btn-danger btn-xs" onclick="javascript:return confirm('Are you sure?');">Del</button></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>

                            <script type="text/javascript" >
                                $(document).ready(function () {
                                    $('#topic').DataTable({
                                        "order": [[0, "desc"]]
                                    });
                                });
                            </script>

                            <!-- Start code popup -->
                            <script type="text/javascript">
                                function popup(url, name, windowWidth, windowHeight) {
                                    myleft = (screen.width) ? (screen.width - windowWidth) / 2 : 100;
                                    mytop = (screen.height) ? (screen.height - windowHeight) / 2 : 100;
                                    properties = "width=" + windowWidth + ",height=" + windowHeight;
                                    properties += ",scrollbars=yes, top=" + mytop + ",left=" + myleft;
                                    window.open(url, name, properties);
                                }
                            </script>
                            <hr>
                            <div class="col-md-12 form-inline">
                                <form action="<?php echo base_url("setting/add_topic/"); ?>" method="post" name="frm_addtopic">
                                    <div class=" form-inline">
                                        <input type="text" name="add_topicname" id="add_topicname" placeholder="Add Topic" class="form-control"/>
                                        <select name="topic_category" id="topic_category" class="form-control">
                                            <option>Please Choose Category</option>
                                            
                                            <?php foreach ($get_topiccat as $get_top): ?>
                                                <option value="<?php echo $get_top['topic_cat_id']; ?>"><?php echo $get_top['topic_cat_name']; ?></option>
                                            <?php endforeach; ?>
                                            
                                        </select>
                                        <input type="submit" name="btn_addtopic" id="btn_addtopic" class="btn btn-primary btn-xs" value="ADD"/>
                                    </div>
                                </form>  
                            </div>

                        </div>
                    </div>

                    <!-- endpanel -->


                </div>
                <div class="col-md-6">

                    <!-- panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading">Category Setting</div>
                        <div class="panel-body">


                            <table id="topic_cat" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:20%;text-align: center;">Category ID</th>
                                        <th style="width:100px;text-align: center;">Category Name</th>
                                        <th style="width:20%;text-align: center;">Modify</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($get_topiccat as $vcate): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $vcate['topic_cat_id']; ?></td>
                                            <td style="text-align: center;"><?php echo $vcate['topic_cat_name']; ?></td>
                                            <td style="text-align: center;"><a href="javascript:popup2('<?php echo base_url("setting/category_edit/"); ?><?php echo $vcate['topic_cat_id']; ?>','',500,500)"><button class="btn btn-warning btn-xs">edit</button></a>&nbsp;<a href="<?php echo base_url("setting/del_category/"); ?><?php echo $vcate['topic_cat_id']; ?>"><button name="btn_cat_del" id="btn_cat_del" class="btn btn-danger btn-xs" onclick="javascript:return confirm('Are you sure?');">Del</button></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                
                                <!-- Start code popup -->
                            <script type="text/javascript">
                                function popup2(url, name, windowWidth, windowHeight) {
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
                                <form action="<?php echo base_url("setting/add_category/"); ?>" method="post" name="frm_addcate">
                                    <div class=" form-inline">
                                        <input type="text" name="add_catename" id="add_catename" placeholder="Add Category Name" class="form-control"/>
                                        <input type="submit" name="btn_addcate" id="btn_addcate" class="btn btn-primary btn-xs" value="ADD"/>
                                    </div>
                                </form>  
                            </div>

                        </div>
                    </div>

                    <!-- endpanel -->

                </div>

            </div>
            <!--End View Topic name and category-->




        </div>


    </body>

</html> 