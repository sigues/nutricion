<link href="<?=base_url()?>assets/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="<?=base_url()?>assets/js/jquery-ui-1.10.3.custom.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/colorbox.css" />
<script src="<?=base_url()?>assets/js/jquery.colorbox-min.js"></script>


<link rel='stylesheet' type='text/css' href='<?=base_url()?>assets/css/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='<?=base_url()?>assets/css/fullcalendar.print.css' media='print' />
<script type='text/javascript' src='<?=base_url()?>assets/js/fullcalendar.js'></script>
<script>
    $(document).ready(function() {
        $("#personal").change(function(){
            $.ajax({
              type: "POST",
              url: 'agendaAjax',
              data: {
                  personal : $("#personal").val(),
                  estado : $("#estado").val()
              },
              success: function(data) {
                 //alert("balls"); 
                 $("#calendar").html("");
                 $("#scriptAjax").html(data);
              }
          });
        });
        
        $("#estado").change(function(){
            $.ajax({
              type: "POST",
              url: 'agendaAjax',
              data: {
                  personal : $("#personal").val(),
                  estado : $("#estado").val()
              },
              success: function(data) {
                 //alert("balls"); 
                 $("#calendar").html("");
                 $("#scriptAjax").html(data);
              }
          });
        });
    });
</script>
<div name="scriptAjax" id="scriptAjax">
    <?=$scriptAjax?>
</div>
<div class="container marketing" id="nosotros">

  <div class="row">
        <div class="span12">
          <br><br>
          <div id = "divcalendar">
              <div id = 'calendar'></div>
          </div>

      </div>
  </div>
</div>



