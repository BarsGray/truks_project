<?php
include '../../../wp-load.php';
include 'send_to_api.php';
$table_name = $wpdb->prefix . "tinkoff_requests";
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  first_name tinytext,
  middle_name tinytext,
  last_name tinytext,
  inn tinytext NOT NULL,
  phone tinytext NOT NULL,
  email tinytext NOT NULL,
  comment text,
  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

if ($_POST['email']) {
  // $wpdb->show_errors();
  $wpdb->insert( $table_name, array(
    'first_name' => $_POST['first-name'],
    'middle_name' => $_POST['middle-name'],
    'last_name' => $_POST['last-name'],
    'inn' => $_POST['inn'],
    'phone' => $_POST['phone'],
    'email' => $_POST['email'],
    'comment' => $_POST['comment']
  ));
  // $wpdb->print_error();
}

?>


<?php
 /*Агенту необходимо передать в сторону Альфа-Лизинг следующие параметры:
  Обязательно:
  ● ИНН компании (10 знаков - ЮЛ, 12 знаков - ИП) – в параметре data.header.inn
  ● ФИО контактного лица. – в параметре data.contact_person.***
  o или раскладываете отдельно по полям last_name / first_name / middle_name (в данном случае обязательно передать хотя бы имя в first_name)
  o Или вы передаете ФИО в одно общее поле unrestricted_name, мы уже дальше сами раскладываем у себя в CRM (первый вариант работы приоритетнее).
  ● Телефон контактного лица – в параметр data.contact_person.phone
  ● Почту контактного лица (желательно, не обязательно) – в параметр data.contact_person.email
  ● Комментарий по заявке (ТИП предмета лизинга, срок, аванс, стоимость предмета лизинга, ежемесячный платеж, сумма договора лизинга, и какие то комментарии клиента – возможно о самом предмете лизинга и все что еще может быть полезно) – в параметре data.non_calculations.comment
  Из технических параметров также обязательно передать:
  ● Время создания заявки (в параметр timestamp)
  ● Действие для заявки (в параметр action) - [create]
  ● Метод создания заявки (в параметр data.creation_method) - [MANUAL]
  ● Кто отправляет заявку (в параметр data.creator_type) – что проставлять:
  o  [AGENT] - если отправляет заявку сам агент/менеджер агента (из CRM или личного кабинета),
  o [CONTRACTOR] - если сам лизингополучатель (с сайта агента)
  ● Источник заявки (в параметр data.source) - [OAPI]
  ● Модель (в параметр model) – [OAPI_CLAIMS_MODEL]
*/
?>
