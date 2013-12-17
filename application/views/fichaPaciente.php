<link href="<?=base_url()?>assets/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="<?=base_url()?>assets/js/jquery-ui-1.10.3.custom.js"></script>
<script>
    $(document).ready(function() {

	$(function() {
            $("#accordion").accordion({ header: "h3" });
            $('#tabs').tabs(/*{
                add: function(event, ui) {
                    $('#tabs').tabs('select', '#' + ui.panel.id);
                    $("#accordion").accordion({ header: "h3" });
                }}*/);
	});
    });
	</script>



    <div id="tabs">
            <ul>
                    <li><a href="#tabs-1">Expediente</a></li>
<?php
    if(isset($idcita)){
        ?>
            <li><a href="#tabs-2">Cita</a></li>
        <?php
        $data["idcita"]=$idcita;
    }
    $data["idpaciente"]=$idpaciente;
    $data["paciente"]=$paciente;
    $data["citas"]=$citas;
    $data["observaciones"]=@$observaciones;
?>
            </ul>
            <div id="tabs-1"><?=$this->load->view('expediente',$data)?></div>
<?php
    if(isset($idcita)){
        ?>
            <div id="tabs-2"><?=$this->load->view('cita',$data)?></div>
        <?php
    }
    ?>
    </div>
<script>
    $("#accordion").accordion({ header: "h3" });
</script>