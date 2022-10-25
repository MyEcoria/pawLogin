<?php 

include 'modules/config.php';

if(isset($_COOKIE['user_adresse'])){

	include 'modules/decrypt.php';
    	include 'modules/home.php';

} else {
	include 'modules/login.php';
}



?>
