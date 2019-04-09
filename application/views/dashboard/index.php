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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>


<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/sonification.js"></script>
        
   
    </head>
    <body>
        <?php
        $this->load->view("head/nav");
        ?>
        
        <div id="container" class="container" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">
            <div class="row">
                <h3 style="text-align: center;">View by Status</h3>
                <div class="col-md-6">
                <div class="list-group">
                <a href="#" class="list-group-item active">
                    Complaint
                </a>
                    <?php foreach ($get_cpstatus->result_array() as $gcp): ?>
                    <a href="<?php echo base_url("dashboard/viewcpby_status/"); ?><?php echo $gcp['cp_status_code']; ?>" class="list-group-item"><?php echo $gcp['cp_status_name']; ?><span class="badge"><?php echo $gcp['sum']; ?></span></a>
                <?php endforeach; ?>
                
            </div>
            </div>
            
            <div class="col-md-6">
                <div class="list-group">
                <a href="#" class="list-group-item active">
                    NC
                </a>
                <?php foreach($get_ncstatus->result_array() as $gnc): ?>
                <a href="<?php echo base_url("dashboard/viewncby_status/"); ?><?php echo $gnc['nc_status_code']; ?>" class="list-group-item"><?php echo $gnc['cp_status_name']; ?><span class="badge"><?php echo $gnc['sumnc']; ?></span></a>
                <?php endforeach; ?>

            </div>
            </div>
            </div><hr>
            
            <div class="row">
                
                <div class="col-md-4">
                    <h3 style="text-align: center;">View by User</h3>
                    <div class="list-group">
                <a href="#" class="list-group-item active">
                    Complaint / NC
                </a>
                <?php foreach ($getby_username->result_array() as $gbuser): ?>
                <a href="<?php echo base_url("dashboard/viewby_user/"); ?><?php echo $gbuser['cp_user_name']; ?>" class="list-group-item"><?php echo $gbuser['cp_user_name']; ?><span class="badge"><?php echo $gbuser['num_user']; ?></span></a>
                <?php endforeach; ?>

                    </div>
                </div>
                
                <div class="col-md-4">
                    <h3 style="text-align: center;">View by Department</h3>
                    <div class="list-group">
                <a href="#" class="list-group-item active">
                    Complaint / NC
                </a>
                <?php foreach ($getby_dept->result_array() as $gbdept): ?>
                <a href="<?php echo base_url("dashboard/viewby_dept/"); ?><?php echo $gbdept['cp_user_dept']; ?>" class="list-group-item"><?php echo $gbdept['cp_user_dept']; ?><span class="badge"><?php echo $gbdept['num_dept']; ?></span></a>
                <?php endforeach; ?>

                    </div>
                </div>
                
                <div class="col-md-4">
                    <h3 style="text-align: center;">View by Topic</h3>
                    <div class="list-group">
                <a href="#" class="list-group-item active">
                    Complaint / NC
                </a>
                <?php foreach ($getby_topic->result_array() as $gbt): ?>
                <a href="<?php echo base_url("dashboard/viewby_topic/"); ?><?php echo $gbt['topic_id']; ?>" class="list-group-item"><?php echo $gbt['cp_topic']; ?><span class="badge"><?php echo $gbt['num_topic']; ?></span></a>
                <?php endforeach; ?>

                    </div>
                </div>
                
                
                
            </div>
             
            
            <div class="row">
                <div id="mychart"></div>
            </div>
            
            <hr>

            
         
<script type="text/javascript">
                
 /***************************กราฟแท่ง**************************************************/
 Highcharts.chart('mychart', {

    chart: {
        type: 'column'
    },

    title: {
        text: 'Graph CP / NC'
    },

    xAxis: {
        type: 'category'
    },

    plotOptions: {
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                        location.href = 'http://192.190.10.27/complaint/dashboard/' +
                            this.name;
                    }
                }
            }
        }
    },

    series: [{
    	name:"CP",
        data: [
            
            <?php
         $result_graph = $this->dashboard_model->graph1CP();
         foreach ($result_graph as $getgraph){
             $getgraph['total'];
             $getgraph['cp_date'];
             
             $con_date = date_create($getgraph['cp_date']);
             $date_format = date_format($con_date, "m-Y");
             
             $getgraph['cp_id'];
             
             $result = "['". $date_format."',".$getgraph['total'].",".$getgraph['cp_id'].",],";
             
             echo $result;
         }
?>
            
        ]
    }]
});

/*******************************กราฟแท่ง**************************************************/



</script>

        </div>

    </body>
    <?php
//         $result_graph = $this->dashboard_model->graph1CP();
//         foreach ($result_graph as $getgraph){
//            echo $getgraph['total'].",";
//         }
?>
</html>
