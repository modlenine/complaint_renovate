<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nc Main Page</title>
    </head>
    <body>
        <?php $this->load->view("head/nav"); ?>

        <div class="container-fulid" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">
            <h1 class="head_text">LIST OF Complaint / NC By User</h1><hr>

<!--            <div class="form-inline">
                <a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a>
                <label>ค้นหาเอกสาร โดย :</label>
                <select class="form-control">
                    <option>วันที่</option>
                    <option>เลขเอกสาร</option>
                    <option>ผู้แจ้ง</option>
                </select>
                <input type="date" class="form-control"/>&nbsp;<label>TO</label>&nbsp;<input type="date" class="form-control"/>&nbsp;<button class="btn btn-warning btn-sm">Search</button>
            </div><hr>-->


             <table id="view_nc" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:80px;text-align: center;">ID</th>
                        <th style="width:100px;text-align: center;">DATE</th>
                        <th style="width:100px;text-align: center;">COMPLAINT BY</th>
                        <th style="text-align: center;">CATEGORY</th>
                        <th style="text-align: center;">TOPIC</th>
                        <th style="text-align: center;">FROM</th>
                        <th style="width:200px;text-align: center;">RELATED DEPARTMENT.</th>
                        <th style="text-align: center;">STATUS</th>
                        <th style="width:80px;text-align: center;">PRIORITY</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($viewby_user as $l_nc): ?>
                    <tr>
                        <?php
                            if($l_nc['cp_status_code']=="cp01"){
                                $url_page = "complaint/view/";
                            }else{
                                $url_page = "complaint/investigate/";
                            }

                            if($l_nc['cp_status_code']=="cp01"){
                                $newgif = '&nbsp;<img src="http://192.190.10.27/complaint/asset/new.gif" alt=""/>';
                            }else{$newgif="";}
                        ?>

                        <?php
                        /**************Check status for redirect page*******************************/
                        $redirect ="";
                        if($l_nc['cp_status_code']=="cp05"){
                            $redirect = base_url("nc/main/").$l_nc['cp_no'];
                        }else{
                            $redirect = base_url("complaint/view/").$l_nc['cp_no'];
                        }


                        ?>
                        <td style="text-align: left;"><a href="<?php echo $redirect;?>"><?php echo $l_nc['cp_no']; ?></a><?php echo $newgif; ?></td>
                        <td style="text-align: left;">
                            <?php
                            $date = date_create($l_nc['cp_date']);
                            echo date_format($date, "d/m/Y");

                            ?>
                        </td>
                        <td style="text-align: left;"><?php echo $l_nc['cp_user_name']; ?></td>
                        <td style="text-align: left;"><?php echo $l_nc['topic_cat_name']; ?></td>
                        <td style="text-align: left;"><?php echo $l_nc['topic_name']; ?></td>
                        <td style="text-align: left;"><?php echo $l_nc['cp_cus_name']; ?></td>

                        <?php
                            if($l_nc['cp_status_id']== "cp01"){
                                $color = "#0066FF";
                            }
                            if($l_nc['cp_status_id']== "cp02"){
                                $color = "#00BFFF";
                            }
                            if($l_nc['cp_status_id']== "cp03"){
                                $color = "#33CC33";
                            }
                            if($l_nc['cp_status_id']== "cp04"){
                                $color = "#BEBEBE";
                            }
                            if($l_nc['cp_status_id']== "cp05"){
                                $color = "#FF4500";
                            }
                            if($l_nc['cp_status_id']== "cp06"){
                                $color = "#228B22";
                            }
                            if($l_nc['cp_status_id']== "cp07"){
                                $color = "#FF0000";
                            }

                        ?>

                        <td style="text-align: left;">
                          <?php
                          $cp_no = $l_nc['cp_no'];
                            $getdept = $this->db->query("SELECT complaint_department.cp_dept_id, complaint_department.cp_dept_code, complaint_department.cp_dept_cp_no, member.Dept FROM complaint_department INNER JOIN member ON member.DeptCode = complaint_department.cp_dept_code WHERE complaint_department.cp_dept_cp_no = '$cp_no' GROUP BY complaint_department.cp_dept_code DESC");
                          ?>

                          <?php foreach ($getdept->result_array() as $gdn): ?>
                              <?php echo $gdn['Dept'] . "&nbsp;,"; ?>
                          <?php endforeach; ?>
                        </td>

                        <td style="text-align: left;color:<?php echo $color; ?>;"><?php echo $l_nc['cp_status_name']; ?></td>
                        <td style="text-align: left;"><?php echo $this->complaint_model->conpriority($l_nc['cp_priority']); ?></td>
                    </tr>
<?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align: center;">ID</th>
                        <th style="text-align: center;">DATE</th>
                        <th style="text-align: center;">COMPLAINT BY</th>
                        <th style="text-align: center;">CATEGORY</th>
                        <th style="text-align: center;">TOPIC</th>
                        <th style="text-align: center;">FROM</th>
                        <th style="width:200px;text-align: center;">RELATED DEPARTMENT.</th>
                        <th style="text-align: center;">STATUS</th>
                        <th style="text-align: center;">PRIORITY</th>
                    </tr>
                </tfoot>
            </table>
            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div>
            <script type="text/javascript" >
    $(document).ready(function () {
                $('#view_nc').DataTable({
                    "order": [[0, "desc"]]
                });
            });
    </script>



        </div>


    </body>
</html>
