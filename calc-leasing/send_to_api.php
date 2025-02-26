<?php
require_once('api.php');
$data = file_get_contents("php://input");
$json = json_decode($data, true);

// Save in database
include '../../../wp-load.php';
require_once( '../../../wp-admin/includes/upgrade.php' );

// Sending to AlphaBank API
$from_api = api_request('https://claims-sale-stage.alfaleasing.ru/alfa-leasing-claims-sale-api/v1/requests', $data);


$table_name = $wpdb->prefix . "tinkoff_requests";
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  first_name tinytext NOT NULL,
  middle_name tinytext NOT NULL,
  last_name tinytext NOT NULL,
  inn tinytext NOT NULL,
  phone tinytext NOT NULL,
  email tinytext NOT NULL,
  comment text,
  to_api mediumtext,
  from_api mediumtext,
  PRIMARY KEY  (id)
) $charset_collate;";

dbDelta( $sql );

if ($json['data']['contact_person']['email']) {
  // $wpdb->show_errors();
  $sql_data = [
    'first_name' => $json['data']['contact_person']['first_name'],
    'middle_name' => $json['data']['contact_person']['middle_name'],
    'last_name' => $json['data']['contact_person']['last_name'],
    'inn' => $json['data']['header']['inn'],
    'phone' => $json['data']['contact_person']['phone'],
    'email' => $json['data']['contact_person']['email'],
    'comment' => $json['comment'],
    'to_api' => json_encode($json, JSON_PRETTY_PRINT),
    'from_api' => $from_api,
  ];

  $wpdb->insert( $table_name, $sql_data);
  // $wpdb->print_error();
}


// Email
$subject = "Новая заявка на лизинг";
//$message = "Пришла новая заявка на лизинг от ".$json['data']['contact_person']['first_name'];
$message = 'Имя: '.$json['data']['contact_person']['first_name']."\n";
$message .= 'Отчество: '.$json['data']['contact_person']['middle_name']."\n";
$message .= 'Фамилия: '.$json['data']['contact_person']['last_name']."\n";
$message .= 'ИНН: '.$json['data']['header']['inn']."\n";
$message .= 'Телефон: '.$json['data']['contact_person']['phone']."\n";
$message .= 'Е-майл: '.$json['data']['contact_person']['email']."\n";
$message .= 'Комментарий: '.$json['comment']."\n";
$message .= $json['data']['non_calculations'][0]['comment']."\n";
$message .= $json['data']['non_calculations'][1]['comment']."\n";
$message .= $json['data']['non_calculations'][2]['comment']."\n";
$message .= $json['data']['non_calculations'][3]['comment']."\n";
$admin_email = get_option( 'admin_email' );

try {
  	if(!empty($json['data']['contact_person']['first_name']) 
	   && !empty($json['data']['contact_person']['middle_name']) 
	   && !empty($json['data']['contact_person']['last_name']) 
	   && !empty($json['data']['header']['inn'])
	   && !empty($json['data']['contact_person']['phone'])){
		wp_mail('sale@ahvtrucks.ru', $subject, $message);
	}
}catch(Exception $e) {
  echo $e->getMessage();
}

print($from_api);