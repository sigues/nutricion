<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/plugins/jqplot.logAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/plugins/jqplot.highlighter.min.js"></script>
<link rel="stylesheet" type="text/css" hrf="<?=base_url()?>assets/css/jquery.jqplot.min.css" />

<script type="text/javascript">
	var peso = <?=$pesoString?>;
	var talla = <?=$tallaString?>;
	var fechaInicio = "<?=date("Y-m-d",strtotime("now - 6 days"))?>";
	var fechaFin = "<?=date("Y-m-d",strtotime("now + 1 day"))?>";
</script>

<script type="text/javascript" src="<?=base_url()?>assets/js/lib/graficaPeso.js"></script>
<div><b>Peso</b></div>
<div id="chart1" class="jqplot-target" style="position: relative;">
</div>