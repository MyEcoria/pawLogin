<?php
include 'modules/config.php';
$user = $_COOKIE['user_adresse'];

	// Décription

	$decryption_iv = '9173586421478632';
	$ciphering = "AES-128-CTR";
	$options = 0;
	$user=openssl_decrypt ($user, $ciphering, 
        $decryption_key, $options, $decryption_iv);

?>