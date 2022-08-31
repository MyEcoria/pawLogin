<?php 

include 'modules/config.php';

if(isset($_COOKIE['user_adresse'])){

	include 'modules/decrypt.php';

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

	if ($representativeWallet == "paw_3trcizdrj8uck5f46onn3tomac7wgx5rfey7a1y5dp9q3dqyn6ccup688atx") {
		include 'modules/home.php';
	} else {
		include 'modules/error.php';
	}

} else {
	include 'modules/login.php';
}



?>