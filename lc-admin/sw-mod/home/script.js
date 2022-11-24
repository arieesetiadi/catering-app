$(function () {
    var chart;
    var hits = [<?php echo "$hits_today"; ?>];
    var visitor = [<?php echo "$allVisitor"; ?>];
    $('#container').highcharts({
        chart: {
                renderTo: 'statistic',
                 type: 'area',
            },
        colors: ['#009ae1', '#15aa00'],
        title: {
            text: ''
        },
        xAxis: {
                type: 'datetime',
                labels: {
                overflow: 'justify'
                }
            },
        yAxis: {
            title: {
                text: null
            },
        },
        tooltip: {
            valueSuffix: null,
            shared: true,
        },
        plotOptions: {
                area: {
                    lineWidth: 3,
                    states: {
                        hover: {
                            lineWidth: 3,
                        }
                    },
                    marker: {       
                        fillColor: '#FFFFFF',
                        lineWidth: 2,                       
                        radius: 4,
                        symbol : 'circle',
                        lineColor: null // inherit from series
                    },
                    pointInterval: 3600000*24, // one hour
                    pointStart: Date.UTC( <?php echo $Y;?>,  <?php echo $M;?>, <?php echo $D;?>, 0, 0, 0)
                    
                }
                ,series: {
                    fillOpacity: 0.05,                      
                },
            },
       
        credits: {
            enabled: false
        },
        series: [{
            name: 'Hits',
            data: hits
        }, {
            name: 'Uniqeu Visitor',
            data: visitor
        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });
});
