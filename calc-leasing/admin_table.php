<?php
if (!class_exists('WP_List_Table')) {
  require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

$table_name = $wpdb->prefix . "tinkoff_requests";

// Extending class
class Tinkoff_Requests_List_Table extends WP_List_Table
{
  public function get_columns()
  {
    return [
      'id' => "ID",
      "email" => "Почта",
      "first_name" => "Имя",
      "middle_name" => "Отчество",
      "last_name" => "Фамилия",
      "inn" => "ИНН",
      "phone" => "Телефон",
      "comment" => "Комментарий",
      // "to_api" => "To API",
      // "from_api" => "From API"
    ];
  }
  public function prepare_items() {
    global $wpdb, $table_name;

    $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    $columns = $this->get_columns();
    $hidden = array();
    $sortable = $this->get_sortable_columns();
    $this->_column_headers = array($columns, $hidden, $sortable);

    $this->items = $results;
    return true;
  }
  public function column_default($item, $column_name) {
    // if ($column_name == "to_api" && $item[$column_name]) {
    //   return "<textarea style=\"width:100%;\">$item[$column_name]</textarea>";
    // }elseif ($column_name == "from_api" && $item[$column_name]) {
    //   return "<textarea style=\"width:100%;\">$item[$column_name]</textarea>";
    // } else {
      return $item[$column_name];
    //}
  }

  // public function column_default($item, $column_name){
  //   $item = (array) ($item);
  // }
}



// Adding menu
add_action('admin_menu', function () {
  add_menu_page('Заявки', 'Заявки на лизинг', 'activate_plugins', 'supporthost_list_table', function () {
    // Creating an instance
    $table = new Tinkoff_Requests_List_Table();

    echo '<div class="wrap"><h2>Заявки на лизинг</h2>';
    // Prepare table
    $table->prepare_items();
    // Display table
    $table->display();
    echo '</div>';
  }, 'dashicons-feedback');
});