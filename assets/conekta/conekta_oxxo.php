<?php
session_start();
require_once '../config.php';

require_once '../classes/quote.php';
require_once '../classes/quote_charge.php';
require_once '../../assets/conekta/MyConekta.php';
//$quote = new quote();
$quote = quote::get_by_id((int) $_POST["quote_id"]);
$quote_name = $quote->quote_product_name;
$quote_id = $quote->quote_id;
$currency = ($_POST["currency"] == "usd" || $_POST["currency"] == "mxn") ? $_POST["currency"] : false;
if($currency == false){
	return false;
}


$amount = ($currency == "mxn") ? $quote->quote_total_cost * 14 * 100 : $quote->quote_total_cost * 100;
$quote_charges = quote_charge::get_list($quote_id,$currency);
$_SESSION['token'] = MyConekta::tokengenerator();
$email = "abc@abc123.com";//$_POST['email'];
$quote_total_cost = ($currency == "mxn")? (float) $quote->quote_total_cost*14*100 : (float) $quote->quote_total_cost*100;


if(sizeof($quote_charges["results"])>0){
	$conekta_id = $quote_charges["results"][0]->conekta_id;
	$response = Conekta_Charge::retrieve($conekta_id,MyConekta::$api_key);
	if($response['status'] != $quote_charges["results"][0]->conekta_status){
		$quote->status_id = 3;
		$quote->update();
		echo "pagado";
		die();
	}


} else {
	$response = MyConekta::oxxo($amount, $email, $quote_name, $quote_id, $currency);
	$new_quote_charge = array();
	$new_quote_charge['conekta_status'] = $response['status'];
	$new_quote_charge['conekta_id'] = $response['id'];
	$new_quote_charge['conekta_currency'] = $response['currency'];
	$new_quote_charge['conekta_amount'] = $response['amount'];
	$new_quote_charge['conekta_expiry_date'] = $response['payment_method']['expiry_date'];
	$new_quote_charge['conekta_barcode'] = $response['payment_method']['barcode'];
	$new_quote_charge['conekta_type'] = 'oxxo';
	$new_quote_charge['conekta_token'] = $_SESSION['token'];
	$new_quote_charge['quote_id'] = $quote_id;

	$insert_quote_charge = new quote_charge($new_quote_charge);
	$insert_quote_charge->insert();

}
echo 'status='.$response['status'].'&currency='.$response['currency'].
		    '&description='.$response['description'].
		    '&amount='.$response['amount'].
		    '&expiry_date='.$response['payment_method']['expiry_date'].
		    '&barcode='.$response['payment_method']['barcode'].
		    '&barcode_url='.$response['payment_method']['barcode_url'].
		    '&type='.$response['payment_method']['type'].
		    '&email='.$email.
		    '&token='.$_SESSION['token'];  	
