<?php

namespace CustomPopup\Notification\Admin;

if ( ! class_exists('WP_List_Table')){
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Notification_List extends \WP_List_Table{

    function __construct(){
        parent::__construct([
            'singular' => 'notification',
            'plural' => 'notifications',
            'ajax' => false
        ]);
    }

    public function get_columns()
    {
        return [
            'cb' => '<input type="checkbox" />',
            'product_name' => __('Products Name', 'custom-popup-notification'),
            'ps_description' => __('Products Description', 'custom-popup-notification'),
            'product_url' => __('Products Url', 'custom-popup-notification'),
            'created_at' => __('Date', 'custom-popup-notification'),
        ];
    }

    protected function column_default( $item, $column_name) {
        switch ($column_name) {
            case 'value':
                # code...
                break;

            default:
                return isset($item->$column_name) ? $item->$column_name : '';
        }
    }

    public function column_product_name( $item){
        return sprintf(
            '<a href="%1%s"><strong>%2%s</strong></a>', admin_url( 'admin.php?page=custom-popup-notification&action=view$id'. $item->id), $item->product_name
        );
    }

    public function prepare_items()
    {
        $column = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();

        $per_page = 20;

        $this->_column_headers = [ $column, $hidden, $sortable];

        $this->items = cp_get_notifications();
        $this->set_pagination_args([
            'total_items' => cp_get_notification_count(),
            'per_page' => $per_page
        ]);
    }
}