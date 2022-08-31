<?php

include 'modules/config.php';

$postParameter = array(
	    'action' => 'account_info',
	    'account' => $user,
	    'representative' => 'true'
	);
	$postParameter = json_encode($postParameter);
	$curlHandle = curl_init($rpcNode);
	curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postParameter);
	curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
	$representativeWallet = curl_exec($curlHandle);
	curl_close($curlHandle);
	$representativeWallet = json_decode($representativeWallet);
	$representativeWallet = $representativeWallet->representative;

$postParameter = array(
	    'action' => 'delegators_count',
	    'account' => $representativeWallet
	);
	$postParameter = json_encode($postParameter);
	$curlHandle = curl_init($rpcNode);
	curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postParameter);
	curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
	$representativeCount = curl_exec($curlHandle);
	curl_close($curlHandle);
	$representativeCount = json_decode($representativeCount);
	$representativeCount = $representativeCount->count;


$url = 'https://tribes.paw.digital/api/accounts/'.$representativeWallet.'/info';


// Initialize a CURL session.
$ch = curl_init();

// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);

$result = curl_exec($ch);
$voting = json_decode($result);
$voting = $voting->weight;
$voting = $voting / 1000000000000000000000000000;


?>