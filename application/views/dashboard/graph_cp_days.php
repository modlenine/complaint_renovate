<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
    <div class="row">
      <?php
      $graph = $graph_cp_day->row();

      $condate = date_create($graph->cp_date);
      $result_date = date_format($condate, "m/Y");
      echo "<h2>".$result_date."</h2>";
      ?>
        <div id="mychart_day"></div>
    </div>






    <script type="text/javascript">

     /***************************กราฟแท่ง**************************************************/
     Highcharts.chart('mychart_day', {

        chart: {
            type: 'column'
        },

        title: {
            text: 'Graph CP'
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
                            location.href = 'http://203.107.156.180/intsys/complaint/dashboard/view_gpcat_detail/' +this.name;
                        }
                    }
                }
            }
        },

        series: [{
          name:"Topic Category of month",
            data: [

                <?php
             foreach ($graph_cp_day->result_array() as $graph_cp_days){
                 $sum = $graph_cp_days['sum'];
                 $graph_cp_days['cp_date'];

                 $con_date = date_create($graph_cp_days['cp_date']);
                 $date_format = date_format($con_date, "m-Y");

                 $graph_cp_days['cp_id'];
                 $graph_cp_days['topic_cat_name'];

                 $result = "['".$graph_cp_days['topic_cat_name']."/".$date_format."',".$sum.",".$graph_cp_days['cp_id'].",],";

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
