<?php

$api_url = 'https://cleanuri.com/api/v1/shorten';

$long_url = (string)readline('Enter URL to shorten: ');

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'url=' . urlencode($long_url));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);

$response = curl_exec($ch);

if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    die('Error occurred: ' . $error);
}

curl_close($ch);

$data = json_decode($response);

echo "The shortened URL is $data->result_url\n";