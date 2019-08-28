<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"><link rel="icon" href="https://jscdn.com.cn/highcharts/images/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            /* css 代码  */
        </style>
        <script src="https://code.highcharts.com.cn/highcharts/highcharts.js"></script>
        <script src="https://code.highcharts.com.cn/highcharts/modules/exporting.js"></script>
        <script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
    </head>
    <body>
        <div id="container" style="min-width:400px;height:400px"></div>
        <script>
            var chart = Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: "<?php echo $address ?>未来七天温度变化温度"
    },
    subtitle: {
        text: '数据来源: WorldClimate.com'
    },
    xAxis: {
        categories: ["<?php echo $data[0]['week'] ?>", "<?php echo $data[1]['week'] ?>", "<?php echo $data[2]['week'] ?>", "<?php echo $data[3]['week'] ?>", "<?php echo $data[4]['week'] ?>", "<?php echo $data[5]['week'] ?>",
                     "<?php echo $data[6]['week'] ?>"]
    },
    yAxis: {
        title: {
            text: '温度'
        },
        labels: {
            formatter: function () {
                return this.value + '°';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: '最高气温',
        marker: {
            symbol: 'square'
        },
        data: [<?php echo $data[0]['temp_high'] ?>, <?php echo $data[1]['temp_high'] ?>, <?php echo $data[2]['temp_high'] ?>, <?php echo $data[3]['temp_high'] ?>, <?php echo $data[4]['temp_high'] ?>, <?php echo $data[5]['temp_high'] ?>, <?php echo $data[6]['temp_high'] ?>]
    }, {
        name: '最低气温',
        marker: {
            symbol: 'diamond'
        },
        data: [<?php echo $data[0]['temp_low'] ?>, <?php echo $data[1]['temp_low'] ?>, <?php echo $data[2]['temp_low'] ?>, <?php echo $data[3]['temp_low'] ?>, <?php echo $data[4]['temp_low'] ?>, <?php echo $data[5]['temp_low'] ?>, <?php echo $data[6]['temp_low'] ?>]
    }]
});

        </script>
    </body>
</html>