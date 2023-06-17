<?php

/**
 * Insert a new address
 *
 * @param  array  $args
 *
 * @return int|WP_Error
 */
function cp_insert_notification($args = [])
{
    global $wpdb;

    if (empty($args['product_name'])) {
        return new \WP_Error('no-name', __('You must provide a name.', 'custom-popup-notification'));
    }

    $defaults = [
        'product_name'       => '',
        'ps_description'    => '',
        'product_url'      => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time('mysql'),
    ];

    $data = wp_parse_args($args, $defaults);

    if ( isset( $data['id'] ) ) {

        $id = $data['id'];
        unset( $data['id'] );

        $updated = $wpdb->update(
            $wpdb->prefix . 'cp_notification',
            $data,
            [ 'id' => $id ],
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ],
            [ '%d' ]
        );

        return $updated;

    } else {

        $inserted = $wpdb->insert(
            $wpdb->prefix . 'cp_notification',
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ]
        );

        if ( ! $inserted ) {
            return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'wedevs-academy' ) );
        }

        return $wpdb->insert_id;
    }
}

function cp_get_notifications($args = [])
{
    global $wpdb;

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];

    $args = wp_parse_args($args, $defaults);

    $items = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}cp_notification ORDER BY {$args['orderby']} {$args['order']} LIMIT %d, %d",
            $args['offset'], $args['number'],
        )
    );
    return $items;
}

function cp_get_notification_count()
{
    global $wpdb;

    return (int) $wpdb->get_var("SELECT count(id) FROM {$wpdb->prefix}cp_notification");
}

/**
 * Fetch a single Notification from the DB
 *
 * @param  int $id
 *
 * @return object
 */
function cp_get_notification( $id ) {
    global $wpdb;

    return $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}cp_notification WHERE id = %d", $id )
    );
}

/**
 * Delete an Notification
 *
 * @param  int $id
 *
 * @return int|boolean
 */
function cp_delete_notification( $id ) {
    global $wpdb;

    return $wpdb->delete(
        $wpdb->prefix . 'cp_notification',
        [ 'id' => $id ],
        [ '%d' ]
    );
}