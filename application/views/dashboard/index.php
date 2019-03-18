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
                <a href="#" class="list-group-item"><?php echo $gbuser['cp_user_name']; ?><span class="badge"><?php echo $gbuser['num_user']; ?></span></a>
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
                <a href="#" class="list-group-item"><?php echo $gbdept['cp_user_dept']; ?><span class="badge"><?php echo $gbdept['num_dept']; ?></span></a>
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
                <a href="#" class="list-group-item"><?php echo $gbt['cp_topic']; ?><span class="badge"><?php echo $gbt['num_topic']; ?></span></a>
                <?php endforeach; ?>

                    </div>
                </div>
                
                
                
            </div>
             
            
            <div class="row">
                <div id="mychart"></div>
            </div>
            <hr>
            <div class="row">
                <div id="mychart2"></div>
                
<pre id="csv_data" style="display:none">2018-01-07,61,9,61,15.85714286
2018-01-14,66,20,61,33.85714286
2018-01-21,56,41,60,31.85714286
2018-01-28,61,46,58,39.28571429
2018-02-04,63,35,65,32.14285714
2018-02-11,61,47,61,35.85714286
2018-02-18,61,37,62,40.42857143
2018-02-25,55,44,54,45
2018-03-04,57,41,56,43.42857143
2018-03-11,62,38,61,36.57142857
2018-03-18,57,36,60,36.57142857
2018-03-25,59,40,61,38.14285714
2018-04-01,60,48,60,43.28571429
2018-04-08,64,38,62,41.14285714
2018-04-15,68,43,66,45.85714286
2018-04-22,64,51,61,46
2018-04-29,62,54,62,53.28571429
2018-05-06,67,60,62,62.57142857
2018-05-13,63,53,62,58.42857143
2018-05-20,62,67,63,60.14285714
2018-05-27,63,65,63,67.71428571
2018-06-03,67,63,65,65.14285714
2018-06-10,68,68,66,64
2018-06-17,65,74,67,68.57142857
2018-06-24,65,69,66,71.42857143
2018-07-01,66,82,67,75.14285714
2018-07-08,78,69,72,76.57142857
2018-07-15,74,75,74,75.14285714
2018-07-22,76,73,73,74.85714286
2018-07-29,76,77,75,76.57142857
2018-08-05,76,81,77,77.42857143
2018-08-12,80,76,81,79
2018-08-19,76,71,76,77
2018-08-26,74,73,75,73
2018-09-02,71,72,74,78.28571429
2018-09-09,70,61,72,75
2018-09-16,74,72,72,69.71428571
2018-09-23,71,63,71,70.42857143
2018-09-30,71,63,69,65.71428571
2018-10-07,68,71,71,68.14285714
2018-10-14,68,53,68,64
</pre>
            </div>
            
            <script type="text/javascript">
                
 /***************************กราฟแท่ง**************************************************/
 Highcharts.chart('mychart', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Monthly Average Rainfall'
  },
  subtitle: {
    text: 'Source: WorldClimate.com'
  },
  xAxis: {
    categories: [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Nov',
      'Dec'
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Rainfall (mm)'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [{
    name: 'Tokyo',
    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

  }, {
    name: 'New York',
    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

  }, {
    name: 'Berlin',
    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

  }]
});

/*******************************กราฟแท่ง**************************************************/



/****************************กราฟเส้น****************************************/
// Sonification options
var sdInstruments = [{
    instrument: 'sineMajor',
    instrumentMapping: {
      duration: 200,
      frequency: 'y',
      volume: 0.7,
      pan: -1
    },
    instrumentOptions: {
      minFrequency: 220,
      maxFrequency: 1900
    }
  }],
  nyInstruments = [{
    instrument: 'triangleMajor',
    instrumentMapping: {
      duration: 200,
      frequency: 'y',
      volume: 0.6,
      pan: 1
    },
    instrumentOptions: {
      minFrequency: 220,
      maxFrequency: 1900
    }
  }];

// Point of interest options
var poiTime = Date.UTC(2018, 4, 6),
  poiEarcon = {
    // Define the earcon we want to play for the point of interest
    earcon: new Highcharts.sonification.Earcon({
      instruments: [{
        instrument: 'squareMajor',
        playOptions: {
          // Play a quick rising frequency
          frequency: function (time) {
            return time * 1760 + 440;
          },
          volume: 0.1,
          duration: 200
        }
      }]
    }),
    // Play this earcon if we hit the point of interest
    condition: function (point) {
      return point.x === poiTime;
    }
  };

// Create the chart
var chart = Highcharts.chart('mychart2', {
  chart: {
    type: 'spline'
  },
  title: {
    text: 'Play chart as sound'
  },
  subtitle: {
    text: 'Weekly temperature averages'
  },
  yAxis: {
    title: {
      text: 'Temperature (°F)'
    }
  },
  xAxis: {
    type: 'datetime',
    plotLines: [{
      value: poiTime,
      dashStyle: 'dash',
      width: 1,
      color: '#d33'
    }]
  },
  tooltip: {
    split: true,
    valueDecimals: 0,
    valueSuffix: '°F'
  },
  plotOptions: {
    series: {
      marker: {
        enabled: false
      },
      cursor: 'pointer',
      // Sonify points on click
      point: {
        events: {
          click: function () {
            // Sonify all points at this x value
            var targetX = this.x,
              chart = this.series.chart;
            chart.series.forEach(function (series) {
              // Map instruments to the options for this series
              var instruments = series.options.id === 'sd' ?
                  sdInstruments : nyInstruments;
              // See if we have a point with the targetX
              series.points.some(function (point) {
                if (point.x === targetX) {
                  point.sonify({
                    instruments: instruments
                  });
                  return true;
                }
                return false;
              });
            });
          }
        }
      }
    }
  },
  // Data source: https://www.ncdc.noaa.gov
  data: {
    csv: document.getElementById('csv_data').innerHTML,
    firstRowAsNames: false,
    parsed: function (columns) {
      columns.splice(1, 2); // Remove the non-average columns
    }
  },
  series: [{
    name: 'San Diego',
    id: 'sd',
    color: '#f4b042'
  }, {
    name: 'New York',
    id: 'ny',
    color: '#41aff4'
  }]
});


// Utility function that highlights a point
function highlightPoint(event, point) {
  var chart = point.series.chart,
    hasVisibleSeries = chart.series.some(function (series) {
      return series.visible;
    });
  if (!point.isNull && hasVisibleSeries) {
    point.onMouseOver(); // Show the hover marker and tooltip
  } else {
    if (chart.tooltip) {
      chart.tooltip.hide(0);
    }
  }
}


// On speed change we reset the sonification
document.getElementById('speed').onchange = function () {
  chart.cancelSonify();
};


// Add sonification button handlers
document.getElementById('play').onclick = function () {
  if (!chart.sonification.timeline || chart.sonification.timeline.atStart()) {
    chart.sonify({
      duration: 5000 / document.getElementById('speed').value,
      order: 'simultaneous',
      pointPlayTime: 'x',
      seriesOptions: [{
        id: 'sd',
        instruments: sdInstruments,
        onPointStart: highlightPoint,
        // Play earcon at point of interest
        earcons: [poiEarcon]
      }, {
        id: 'ny',
        instruments: nyInstruments,
        onPointStart: highlightPoint
      }],
      // Delete timeline on end
      onEnd: function () {
        if (chart.sonification.timeline) {
          delete chart.sonification.timeline;
        }
      }
    });
  } else {
    chart.resumeSonify();
  }
};
document.getElementById('pause').onclick = function () {
  chart.pauseSonify();
};
document.getElementById('rewind').onclick = function () {
  chart.rewindSonify();
};

/****************************กราฟเส้น****************************************/
        </script> 

        </div>

    </body>
</html>
