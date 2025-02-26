<?php
header('Content-Type: application/json; charset=utf-8');

include 'secrets.php';

// Get token
function get_token() {
  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://identity-stage.alfaleasing.ru/connect/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>
      "client_id=" . ALPHA_ID .
      "&client_secret=" . ALPHA_SECRET .
      "&partner-id=" . ALPHA_PARTNER .
      "&grant_type=client_credentials"
      ,

    CURLOPT_HTTPHEADER => [
      "content-type: application/x-www-form-urlencoded"
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return false;
  } else {
    return json_decode($response);
  }
}

// v1/partner/calcs
function api_request($endpoint, $data, $method = 'POST') {
  ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
  $token = get_token();
  $curl = curl_init();
  $data = file_get_contents("php://input");
  curl_setopt_array($curl, [
    CURLOPT_URL => $endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST =>$method,
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => [
      "accept: application/json",
      "authorization: Bearer " . $token->access_token,
      "content-type: application/json",
      "partner-id: ". ALPHA_PARTNER,
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);

  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}