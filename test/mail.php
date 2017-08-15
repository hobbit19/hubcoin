<?php

die('Switched off');


error_reporting(E_ALL);
ini_set('display_errors', 'on');

function mg_send($to, $subject, $message) {

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, 'api:'.'key-9e45b4f77e6254e3d8de5c852541d542');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $plain = strip_tags(nl2br($message));

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandboxa3c9cd9daa924c39a31827f1e23423ba.mailgun.org/messages');
  curl_setopt($ch, CURLOPT_POSTFIELDS, array('from' => 'support@sandboxa3c9cd9daa924c39a31827f1e23423ba.mailgun.org',
        'to' => $to,
        'subject' => $subject,
        'html' => $message,
        'text' => $plain));

  $j = json_decode(curl_exec($ch));

  $info = curl_getinfo($ch);

  print_r($info);
  
  if($info['http_code'] != 200)
        die('Error!');

  curl_close($ch);

  return $j;
}






$data=file_get_contents('https://chainz.cryptoid.info/explorer/address.summary.dws?coin=nro&id=592&r=2380&fmt.js');


if (strpos($data, '"balance":3399999') == FALSE OR 1==1){
    $d=date('H:i:s');
    mg_send('zombocraft7@gmail.com', 'Alert!!!', "Alert!!! $d \n\n\n $data");
    die('Sending alert email');
}



die('Balance is ok');




