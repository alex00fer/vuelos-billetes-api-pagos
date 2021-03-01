<?php
function processPayment($card, $pin, $amount){
  $url = "http://localhost:3000/payments/withdraw";

  $data = [
    "card" => $card,
    "pin" => $pin,
    "amount" => $amount,
  ];

  $options = array(
    'http' => array(
      'method'  => 'POST',
      'content' => json_encode($data),
      'header' =>  "Content-Type: application/json\r\n" . "Accept: application/json\r\n"
    )
  );

  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  $response = json_decode($result);

  return $response;
}
