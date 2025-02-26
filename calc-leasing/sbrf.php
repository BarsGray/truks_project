<?php

function get_valutes()
{

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://www.cbr.ru/scripts/XML_daily.asp",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return iconv("Windows-1251", "UTF-8", $response);
  }
}