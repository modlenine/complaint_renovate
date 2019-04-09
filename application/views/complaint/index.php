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
        
        <div class="container" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">
            <h1 class="head_list_cp">List of Complaint</h1>
            <div class="btn_back">
                <a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a>
                <a href="<?php echo base_url(); ?>complaint/add/<?php echo $getuser['DeptCode']; ?>"><button class="btn btn-primary btn-sm btn_back">New Complaint</button></a>
            </div><hr>
            <table id="view_cp" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:80px;text-align: center;">ID</th>
                        <th style="width:60px;text-align: center;">DATE</th>
                        <th style="width:100px;text-align: center;">COMPLAINT BY</th>
                        <th style="text-align: center;">TOPIC</th>
                        <th style="text-align: center;">FROM</th>
                        <th style="width:100px;text-align: center;">STATUS</th>
                        <th style="width:80px;text-align: center;">PRIORITY</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($list_cp as $l_cp): ?>
                    <tr>
                        <?php  
                            if($l_cp['cp_status_code']=="cp01"){
                                $url_page = "complaint/view/";
                            }else{
                                $url_page = "complaint/investigate/";
                            }
                            
                            if($l_cp['cp_status_code']=="cp01"){
                                $newgif = '&nbsp;<img src="http://192.190.10.27/complaint/asset/new.gif" alt=""/>';
                            }else{$newgif="";}
                        ?>
                        <td style="text-align: left;font-weight: 600;"><a href="<?php echo base_url().$url_page; ?><?php echo $l_cp['cp_no']; ?>"><?php echo $l_cp['cp_no']; ?></a><?php echo $newgif; ?></td>
                        <td style="text-align: left;">
                            <?php
                            $date = date_create($l_cp['cp_date']);
                            echo date_format($date, "d/m/Y");
                            
                            ?>
                        </td>
                        <td style="text-align: left;"><?php echo $l_cp['cp_user_name']; ?></td>
                        <td style="text-align: left;"><?php echo $l_cp['cp_topic']; ?></td>
                        <td style="text-align: left;"><?php echo $l_cp['cp_cus_name']; ?></td>
                        
                        <?php  
                            if($l_cp['cp_status_id']== "cp01"){
                                $color = "#0066FF";
                            }
                            if($l_cp['cp_status_id']== "cp02"){
                                $color = "#00BFFF";
                            }
                            if($l_cp['cp_status_id']== "cp03"){
                                $color = "#33CC33";
                            }
                            if($l_cp['cp_status_id']== "cp04"){
                                $color = "#BEBEBE";
                            }
                            if($l_cp['cp_status_id']== "cp05"){
                                $color = "#FF4500";
                            }
                            if($l_cp['cp_status_id']== "cp06"){
                                $color = "#228B22";
                            }
                            
                        ?>
                        <td style="font-weight:500;text-align: left;color:<?php echo $color; ?>;"><?php echo $l_cp['cp_status_name']; ?></td>
                        
                        <?php  
                                
                                   $number =  $l_cp['cp_priority'];
                                   if($number >= 1 && $number <= 1.5){
                                       $level = "<span style='color:#696969;'>Very Low</span>";
                                   }else if ($number >= 1.6 && $number <= 2.5){
                                       $level = "Low";
                                   }else if ($number >= 2.6 && $number <= 3.5){
                                       $level = "<span style='color:#87CEEB;'>Normal</span>";
                                   }else if ($number >= 3.6 && $number <= 4.5){
                                       $level = "<span style='color:#FF4500;'>Hight</span>";
                                   }else{
                                       $level = "<span style='color:#FF0000;'>Very Hight</span>";
                                   }
                            ?>
                        
                        <td style="text-align: center;"><?php echo $level; ?></td>
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
                $('#view_cp').DataTable({
                    "order": [[0, "desc"]]
                });
            });
    </script>
        </div>
    </body>
</html>
