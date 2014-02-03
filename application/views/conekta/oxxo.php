<?php
//Regenerate the token value to avoid repeat the report
$_SESSION['token'] = MyConekta::tokengenerator();
?>

<!DOCTYPE html>
<html>
    <head>
	    <title>Deposito en efectivo en <?=ucfirst($response->type)?></title>
    </head>
    <body>     
    	<h1>Resumen del Deposito</h1>
    	<div id="resumen">
    		<table>
    			<tr>
    				<td>Descripcion</td>
    				<td><?=$response->description?></td>
    			</tr>
    			<tr>
    				<td>Fecha <?=($response->payment_method->type=='oxxo')?'de expiracion':''?></td>
    				<td>
    					<?php    						 
    						 if ($response->payment_method->type == 'oxxo')
    							echo substr($response->payment_method->expiry_date, 0, 2).'/'.substr($response->payment_method->expiry_date, 2, 2).'/20'.substr($response->payment_method->expiry_date, 4, 2);
    						else
    							echo $response->payment_method->expiry_date;
    					?>
    				</td>
    			</tr>
    			<tr>
    				<td>Metodo de pago</td>
    				<td>Deposito en <?=ucfirst($response->payment_method->type)?></td>
    			</tr>
    			<tr>
    				<td>Monto</td>
    				<td>$<?=substr($response->amount, 0, -2)?>.00 <?=strtoupper($response->currency)?></td>
    			</tr>
    		</table>
    	</div>

    	<h1>Informacion de la Ficha</h1>
    	<div id="informacion">
    		<?php if ($response->payment_method->type != 'oxxo') : ?>
    		<table>
    			<tr>
    				<td>Banco</td>
    				<td><?=ucfirst($response->payment_method->type)?></td>
    			</tr>
    			<tr>
    				<td>Nombre de Servicio</td>
    				<td><?=$response->payment_method->type?></td>
    			</tr>
    			<tr>
    				<td>Numero de Referencia</td>
    				<td><?=$response->reference_id?></td>
    				<td><img src="<?=base_url()?>assets/conekta/logos/<?=$response->payment_method->type?>.png"></td>
    			</tr>
    			
    		</table>
    		<?php else :?>
			<table>
    			<tr>
    				<td><img src="<?=$response->payment_method->barcode_url?>&height=50&width=1"></td>
    				<td><img src="<?=base_url()?>assets/conekta/logos/<?=$response->payment_method->type?>.png"></td>
    			</tr>
    			<tr>
    				<td><?='<span class="txt-left">'.$response->payment_method->barcode.'</span> &nbsp;&nbsp;&nbsp;<span class="txt-right">EXP.'.$response->payment_method->expiry_date.'</span>'?></td>
    				<td></td>
    			</tr>    			
    		</table>

    		<?php endif; ?>
    	</div>

    </body>    
</html>

