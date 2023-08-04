<?php

$url = 'http://localhost:8888/adaca_backend/fake_api.php';

$data = array(
    'conversation_id'   => '20231123', 
    'message'           => ''
);

$dataJSON = json_encode($data);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJSON);
$response = curl_exec($ch);
curl_close($ch);

print_r($response);

opcache_reset();