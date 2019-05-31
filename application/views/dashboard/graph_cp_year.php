<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
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
    text: 'Graph CP of Monht'
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
                location.href = 'http://203.107.156.180/intsys/complaint/dashboard/graph_cp_day/' +
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
    }
    ]
    });

    /*******************************กราฟแท่ง**************************************************/



    </script>
  </body>
</html>
