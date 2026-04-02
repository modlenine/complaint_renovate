
<div class="row">
    <div id="pine_total"></div>
  </div>

  <hr>



<script>
// Create the chart
Highcharts.chart('pine_total', {
  chart: {
    type: 'pie'
  },
  title: {
    text: 'Total Complaint'
  },
  plotOptions: {
    series: {
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b><br><b>{point.y:,.0f} รายการ</b>'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.percentage:,.1f}%</b> of total<br/>'
  },

  series: [
    {
      name: "Complaint Category",
      colorByPoint: true,
      data: [
        <?php
          $result_graph = $this->dashboard_model->graph_pine_total();
          foreach ($result_graph as $getgraph) {
            $result = "['" . $getgraph['topic_cat_name'] . "'," . $getgraph['sum'] . "],";
            echo $result;
          }
          ?>
      ]
    }
  ]
});
</script>

