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
            showMarker: true,
            show: true,     // wether to render the series.
            xaxis: 'xaxis', // either 'xaxis' or 'x2axis'.
            yaxis: 'yaxis', // either 'yaxis' or 'y2axis'.
            label: '',      // label to use in the legend for this line.
            color: '',      // CSS color spec to use for the line.  Determined automatically.
            lineWidth: 2.5, // Width of the line in pixels.
            shadow: true,   // show shadow or not.
            shadowAngle: 45,    // angle (degrees) of the shadow, clockwise from x axis.
            shadowOffset: 1.25, // offset from the line of the shadow.
            shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each
                                // stroke offset by shadowOffset from the last.
            shadowAlpha: 0.1,   // Opacity of the shadow.
            showLine: true,     // whether to render the line segments or not.
            showMarker: true,   // render the data point markers or not.
            fill: true,        // fill under the line,
            fillAndStroke: true,       // *stroke a line at top of fill area.
            fillColor: undefined,       // *custom fill color for filled lines (default is line color).
            fillAlpha: undefined,       // *custom alpha to apply to fillColor.
            renderer: $.jqplot.LineRenderer,    // renderer used to draw the series.
            rendererOptions: {}, // options passed to the renderer.  LineRenderer has no options.
            markerRenderer: $.jqplot.MarkerRenderer,    // renderer to use to draw the data
                                                        // point markers.
            markerOptions: {
                show: true,             // wether to show data point markers.
                style: 'filledCircle',  // circle, diamond, square, filledCircle.
                                        // filledDiamond or filledSquare.
                lineWidth: 2,       // width of the stroke drawing the marker.
                size: 9,            // size (diameter, edge length, etc.) of the marker.
                shadow: true,       // wether to draw shadow on marker or not.
                shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
                shadowOffset: 1,    // offset from the line of the shadow,
                shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
                                    // offset by shadowOffset from the last.
                shadowAlpha: 0.07   // Opacity of the shadow
            }
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
                    showMark: true
                }
            }
        }
    });
 
      $('.jqplot-highlighter-tooltip').addClass('ui-corner-all')
}