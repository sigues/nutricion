$(document).ready(function () {
    inicializaGrafica(peso);
    
});

function inicializaGrafica(peso){
    $("#chart1").html("");
    $.jqplot._noToImageButton = true;
    var prevYear = peso;
 
    var currYear = talla;

    console.log(prevYear);
    console.log(currYear);
    console.log(fechaInicio);
    console.log(fechaFin);


 //[["2011-08-01",796.01], ["2011-08-05",510.5]]
    var plot1 = $.jqplot("chart1", [prevYear], {
        seriesColors: ["rgba(78, 135, 194, 0.7)"],
        title: 'Seguimiento de peso',
        dataRenderer: prevYear,
        highlighter: {
            show: true,
            sizeAdjust: 1,
            tooltipOffset: 9
        },
        grid: {
            background: 'rgba(57,57,57,0.0)',
            drawBorder: false,
            shadow: false,
            gridLineColor: '#666666',
            gridLineWidth: 2
        },
        legend: {
            show: true,
            placement: 'outside'
        },
        seriesDefaults: {
            rendererOptions: {
                smooth: true,
                animation: {
                    show: true
                }
            },
            showMarker: false
        },
        series: [
            {
                fill: true,
                label: 'peso'
            }
        ],
        axesDefaults: {
            rendererOptions: {
                baselineWidth: 1.5,
                baselineColor: '#444444',
                drawBaseline: false
            }
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    formatString: "%b %e",
                    angle: -30,
                    textColor: '#dddddd'
                },
                min: fechaInicio,
                max: fechaFin,
                tickInterval: "7 days",
                drawMajorGridlines: false
            },
            yaxis: {
                renderer: $.jqplot.LogAxisRenderer,
                pad: 0,
                rendererOptions: {
                    minorTicks: 1
                },
                tickOptions: {
                    formatString: "%'d kg",
                    showMark: false
                }
            }
        }
    });
 
      $('.jqplot-highlighter-tooltip').addClass('ui-corner-all')
}