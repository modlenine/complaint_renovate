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
        
        <div class="container" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">
            <h1 class="head_text">LIST OF NC</h1><hr>
            
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
                        <th style="text-align: center;">TOPIC</th>
                        <th style="text-align: center;">FROM</th>
                        <th style="text-align: center;">STATUS</th>
                        <th style="width:80px;text-align: center;">PRIORITY</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($viewncby_status as $l_nc): ?>
                    <tr>
                        <?php  
                            if($l_nc['nc_status_code']=="nc01"){
                                $newgif = '&nbsp;<img src="http://192.190.10.27/complaint/asset/new.gif" alt=""/>';
                            }else{$newgif="";}
                        ?>
                        
                        <td style="text-align: center;"><a href="<?php echo base_url("nc/main/");?><?php echo $l_nc['cp_no']; ?>"><?php echo $l_nc['cp_no']; ?></a><?php echo $newgif; ?></td>
                        <td style="text-align: center;">
                            <?php
                            $date = date_create($l_nc['cp_date']);
                            echo date_format($date, "d/m/Y");
                            
                            ?>
                        </td>
                        <td style="text-align: center;"><?php echo $l_nc['cp_user_name']; ?></td>
                        <td style="text-align: center;"><?php echo $l_nc['cp_topic']; ?></td>
                        <td style="text-align: center;"><?php echo $l_nc['cp_cus_name']; ?></td>
                        
                        <?php
                        
                            if($l_nc['cp_status_name'] == "Transform Complaint"){
                                $color = ' #87CEEB; ';
                            }
                            if($l_nc['cp_status_name'] == "Waiting Action"){
                                $color = ' #40E0D0; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_1st"){
                                $color = ' #DAA520; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_2nd"){
                                $color = ' #DAA520; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_3rd"){
                                $color = ' #DAA520; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_1st NC Close"){
                                $color = ' #F4A460; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_2nd NC Close"){
                                $color = ' #F4A460; ';
                            }
                            if($l_nc['cp_status_name'] == "Followup_3rd NC Close"){
                                $color = ' #F4A460; ';
                            }
                            if($l_nc['cp_status_name'] == "NC Failed"){
                                $color = ' #FF8C00; ';
                            }
                            if($l_nc['cp_status_name'] == "Conclusion of NC Failed"){
                                $color = ' #FF8C00; ';
                            }
                            if($l_nc['cp_status_name'] == "Conclusion of NC"){
                                $color = ' #32CD32; ';
                            }
                            
                            
                        ?>
                        
                        <td style="text-align: center;color:<?php echo $color; ?>"><?php echo $l_nc['cp_status_name']; ?></td>
                        <td style="text-align: center;"><?php echo $this->complaint_model->conpriority($l_nc['cp_priority']); ?></td>
                    </tr>
<?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align: center;">ID</th>
                        <th style="text-align: center;">DATE</th>
                        <th style="text-align: center;">COMPLAINT BY</th>
                        <th style="text-align: center;">TOPIC</th>
                        <th style="text-align: center;">FROM</th>
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
