<?php

include 'modules/config.php';
//------------------------------------------------------------------------------------------------------------
// Creation du wallet
$postParameter = array(
    'action' => 'account_create',
    'wallet' => $nodeWallet
);
$postParameter = json_encode($postParameter);
$curlHandle = curl_init($rpcNode);
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postParameter);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
$newWallet = curl_exec($curlHandle);
curl_close($curlHandle);
$newWallet = json_decode($newWallet);
$newWallet = $newWallet->account;
//------------------------------------------------------------------------------------------------------------

file_put_contents('adresse.txt', $newWallet);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">  
    <title>MyEcoria | Login</title>
    <link rel="stylesheet" href="utils/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="wrapper">
      <header>
        <h1>Check in:</h1><div style="color: red;" id="timer"></div>
        <p>Send 1 paw to this address:</p>
      </header>
      <div class="form">
        <input type="text" spellcheck="false" minlength="64" maxlength="64" placeholder="Enter text or url" required value="<?php echo $newWallet; ?>">
        <button>Generate QR Code</button>
      </div>
      <div class="qr-code">
        <img src="" alt="qr-code">
      </div>
      <div id="some_id"></div>
    </div>

    <script src="utils/js/script.js"></script>
    <script src="utils/js/timer.js"></script>
    <script type="text/javascript" src="utils/js/jquery.js"></script>          
    <script type="text/javascript">

    //Check if the page has loaded completely                                         
    $(document).ready( function() { 
        setTimeout( function() { 
            $('#some_id').load('verify.php'); 
        }, 60000); 
    }); 


    </script> 

  </body>
</html>

