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

        <div id="container" class="container-fulid" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding: 30px;">

            <?php $this->load->view("dashboard/dashboard_sec1"); ?>
            <?php $this->load->view("dashboard/graph_cp_year"); ?>

        </div>

    </body>
    <?php
//         $result_graph = $this->dashboard_model->graph1CP();
//         foreach ($result_graph as $getgraph){
//            echo $getgraph['total'].",";
//         }
?>
</html>
