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

    	/**
	 * Message to be displayed when there are no items
	 *
	 * @since 3.1.0
	 */
	public function no_items() {
		_e( 'No items found.', 'custom-popup-notification');
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

        /**
     * Get sortable columns
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = [
            'product_name'       => [ 'product_name', true ],
            'created_at' => [ 'created_at', true ],
        ];

        return $sortable_columns;
    }

    /**
     * Set the bulk actions
     *
     * @return array
     */
    function get_bulk_actions() {
        $actions = array(
            'edit'  => __( 'Edit', 'custom-popup-notification' ),
            'trash'  => __( 'Move to Trash', 'custom-popup-notification' ),
        );

        return $actions;
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
        $actions = [];

        $actions['edit'] = sprintf(' <a href="%s" title="%s">%s</a>', admin_url( 'admin.php?page=custom-popup-notification&action=edit&id=' . $item->id ), $item->id, __('Edit', 'custom-popup-notification'), __('Edit', 'custom-popup-notification') );
        $actions['delete'] = sprintf('<a href="%s" class="submitdelete" onclick="return confirm(\'Are you Sure?\')" title="%s">%s</a>', wp_nonce_url( admin_url( 'admin-post.php?action=cp-delete-notification&id=' .$item->id), 'cp-delete-notification'), $item->id, __('Delete', 'custom-popup-notification'), __('Delete', 'custom-popup-notification'));
        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=custom-popup-notification&action=view$id'. $item->id), $item->product_name,$this->row_actions( $actions )
        );
    }
    public function column_cb( $item){
        return sprintf(
            '<input type="checkbox" name="notification_id[]" value="%d" />', $item->id
        );
    }

    public function prepare_items()
    {
        $column = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [ $column, $hidden, $sortable];

        $per_page = 10;
        $current_page = $this->get_pagenum();
        $offset = ( $current_page - 1 ) * $per_page;

        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];
        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'] ;
        }

        $this->items = cp_get_notifications($args);
        $this->set_pagination_args([
            'total_items' => cp_get_notification_count(),
            'per_page' => $per_page
        ]);
    }
}