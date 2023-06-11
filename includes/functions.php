<?php

/**
 * Insert a new address
 *
 * @param  array  $args
 *
 * @return int|WP_Error
 */
function cpn_insert_notification( $args = [] ) {
    global $wpdb;

    if ( empty( $args['product-name'] ) ) {
        return new \WP_Error( 'no-name', __( 'You must provide a name.', 'custom-popup-notification' ) );
    }

    $defaults = [
        'product-name'       => '',
        'ps-description'    => '',
        'product-url'      => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time( 'mysql' ),
    ];

    $data = wp_parse_args( $args, $defaults );

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
        return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'custom-popup-notification' ) );
    }

    return $wpdb->insert_id;
}