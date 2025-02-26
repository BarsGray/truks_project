<?php
header('Content-Type: application/json; charset=utf-8');

include 'secrets.php';

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$token = get_token();
$curl = curl_init();
$data = file_get_contents("php://input");
curl_setopt_array($curl, [
  CURLOPT_URL => "https://oapi-calc-service-stage.alfaleasing.ru/alfa-leasing-oapi-calc-service/v1/partner/calcs",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer ".$token->access_token,
    "content-type: application/json",
    "partner-id: ".ALPHA_PARTNER,
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}


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
    CURLOPT_POSTFIELDS => "client_id=" . ALPHA_ID . "&client_secret=" . ALPHA_SECRET . "&grant_type=client_credentials&partner-id=" . ALPHA_PARTNER . "%0A%0A%40token%20%3D%20eyJhbGciOiJSUzI1NiIsImtpZCI6IjEwNTFGQkY3NDFDMDkyMTA2MzgzQzhEODRCNjk0RjVCIiwidHlwIjoiYXQrand0In0.eyJuYmYiOjE2ODk4NjEwNTMsImV4cCI6MTY4OTg2NDY1MywiaXNzIjoiaHR0cHM6Ly9pZGVudGl0eS1zdGFnZS5hbGZhbGVhc2luZy5ydSIsImF1ZCI6WyJsayIsImF6dXJlLXN0YWdlLXJlc291cmNlIiwiYWdlbnQtaW5mby1nZXQtYXBpIiwiYWdlbnQtbGstdWktYXBpIiwiY2xhaW1zLWFwaSIsImFnZW50LXJlZ2lzdHJhdGlvbi1hcGkiLCJub3RpZmljYXRpb24td29ya2VyIiwici1jbGFpbXMtc2FsZS1hcGkiLCJyLWNvcmUtbWFpbC1hcGkiLCJyLW9hcGktY2FsYy1zZXJ2aWNlIl0sImNsaWVudF9pZCI6ImMtYWh2dHJ1Y2tzIiwiaWF0IjoxNjg5ODYxMDUzLCJzY29wZSI6WyJvYXBpIl19.C5iFedW-PNr4XMP0f0oDc6NgxxHfNHM_bAQR-1ABSHJ80RzmdXTh0kMRDTJD7o-Mu6Tr9JQrFgCxi7QGfFS0xKD0bj7fTYYkR3PzQmHKzjwxiaZhqRG1eecc6rgmP6zhIdCAFxg4FHzXS_VqYfDPY6bdjz_JWHWe0yETEONr3H__8V7HzYwapX925i1bnzziM8LX17kYLPiqevgFuDu-7Bg_zWYfvBhCHwugPRDo9SFeRXiHbfrcWI7oE1pW048LYhRsYXEr5clu5MzVCkmi_i4aLy-iZxBIShByPv_7kJc8M2g3ZmGsU7FyXp9sNZ5ixP2oGors3lxa08wjeN_Vdg",
    CURLOPT_HTTPHEADER => [
      "content-type: application/x-www-form-urlencoded",
      "user-agent: vscode-restclient"
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