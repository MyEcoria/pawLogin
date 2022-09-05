<?php
include 'modules/config.php';

$pendingWallet = 0;

while ($pendingWallet < 1) {
    $newWallet = file_get_contents('adresse.txt');
    echo $newWallet;
    $postParameter = array(
        'action' => 'account_balance',
        'account' => $newWallet
    );
    $postParameter = json_encode($postParameter);
    $curlHandle = curl_init($rpcNode);
    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postParameter);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
    $balanceWallet = curl_exec($curlHandle);
    curl_close($curlHandle);
    $balanceWallet = json_decode($balanceWallet);
    $pendingWallet = $balanceWallet->pending;
    $balanceWallet = $balanceWallet->balance;
    sleep(3);
}


$url = 'https://tribes.paw.digital/api/accounts/'.$newWallet.'/pending';


// Initialize a CURL session.
$ch = curl_init();

// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);

$result = curl_exec($ch);
$result = substr($result,129);
$result = str_replace('"}}}', '', $result);

// Chiffrement
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '9173586421478632';
$result = openssl_encrypt($result, $ciphering,
            $encryption_key, $options, $encryption_iv);


if ($balanceWallet == 1000000000000000000000000000) {
    //echo "ça fonctionne à la perfection (verifier)";
} elseif ($pendingWallet == 1000000000000000000000000000) {
    //echo "ça fonctionne à la perfection (pending)";
    setcookie('user_adresse', $result);
    echo '

    <script type="text/javascript">
        $(document).ready(function () {
        $(location).attr("href", "'.$urlRedirect.'");
        });
    </script>

    ';

} else {
    //echo "Rien reçu 😤";
}




//------------------------------------------------------------------------------------------------------------
// Suppression du wallet

$postParameter = array(
    'action' => 'account_remove',
    'wallet' => $nodeWallet,
    'account' => $newWallet
);
$postParameter = json_encode($postParameter);
$curlHandle = curl_init($rpcNode);
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postParameter);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
$removeWallet = curl_exec($curlHandle);
curl_close($curlHandle);
$removeWallet = json_decode($removeWallet);
$removeWallet = $removeWallet->removed;
//------------------------------------------------------------------------------------------------------------


?>