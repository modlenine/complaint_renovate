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
        
        <div class="container">
            <h1 class="head_list_cp">List of Complaint</h1>
            <div class="btn_back"><a href="javascript: history.back()"><button class="btn btn-second btn-sm btn_back"><i class="fas fa-caret-left"></i>&nbsp;Back</button></a></div><hr>
            <table id="view_cp" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
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
<?php foreach ($list_cp as $l_cp): ?>
                    <tr>
                        <?php  
                            if($l_cp['cp_status']=="New Complaint"){
                                $url_page = "complaint/view/";
                            }else{
                                $url_page = "complaint/investigate/";
                            }
                        ?>
                        <td style="text-align: center;"><a href="<?php echo base_url().$url_page; ?><?php echo $l_cp['cp_no']; ?>"><?php echo $l_cp['cp_no']; ?></a></td>
                        <td style="text-align: center;">
                            <?php
                            $date = date_create($l_cp['cp_date']);
                            echo date_format($date, "d-m-Y");
                            
                            ?>
                        </td>
                        <td style="text-align: center;"><?php echo $l_cp['cp_user_name']; ?></td>
                        <td style="text-align: center;"><?php echo $l_cp['cp_topic']; ?></td>
                        <td style="text-align: center;"><?php echo $l_cp['cp_cus_name']; ?></td>
                        <td style="text-align: center;"><?php echo $l_cp['cp_status']; ?></td>
                        <td style="text-align: center;"><?php echo $l_cp['cp_priority']; ?></td>
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