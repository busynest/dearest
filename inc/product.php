<?php

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/*
 * Tab
 */
add_filter('woocommerce_product_data_tabs', 'product_settings_tabs' );
function product_settings_tabs( $tabs ){
 
	//unset( $tabs['inventory'] );
 
	$tabs['specs'] = array(
		'label'    => 'Specs',
		'target'   => 'product_specs_data',
		'priority' => 21,
	);
	return $tabs;
 
}

/*
 * Tab content
 */
add_action( 'woocommerce_product_data_panels', 'product_panels' );
function product_panels(){
 
	echo '<div id="product_specs_data" class="panel woocommerce_options_panel hidden">';
 
	woocommerce_wp_text_input( array(
		'id'                => 'product_specs_seating',
		'value'             => get_post_meta( get_the_ID(), 'product_specs_seating', true ),
		'label'             => 'Seating',
		'description'       => 'Seating'
	) );
	woocommerce_wp_text_input( array(
		'id'                => 'product_specs_body',
		'value'             => get_post_meta( get_the_ID(), 'product_specs_body', true ),
		'label'             => 'Body',
		'description'       => 'Body'
	) );
	woocommerce_wp_text_input( array(
		'id'                => 'product_specs_doors',
		'value'             => get_post_meta( get_the_ID(), 'product_specs_doors', true ),
		'label'             => 'Doors',
		'description'       => 'Doors'
	) );
	woocommerce_wp_text_input( array(
		'id'                => 'product_specs_charge_time',
		'value'             => get_post_meta( get_the_ID(), 'product_specs_charge_time', true ),
		'label'             => 'Charge Time',
		'description'       => 'Charge Time'
	) );
	woocommerce_wp_text_input( array(
		'id'                => 'product_specs_battery_type',
		'value'             => get_post_meta( get_the_ID(), 'product_specs_battery_type', true ),
		'label'             => 'Battery Type',
		'description'       => 'Battery Type'
	) );
	woocommerce_wp_text_input( array(
		'id'                => 'product_specs_max_speed',
		'value'             => get_post_meta( get_the_ID(), 'product_specs_max_speed', true ),
		'label'             => 'Max Speed',
		'description'       => 'Max Speed'
	) );
	woocommerce_wp_text_input( array(
		'id'                => 'product_specs_range',
		'value'             => get_post_meta( get_the_ID(), 'product_specs_range', true ),
		'label'             => 'Range',
		'description'       => 'Range'
	) );
 
	echo '</div>';
 
}

/**
 * Save the custom field
 */

add_action( 'woocommerce_process_product_meta', 'save_product_specs_data' );

function save_product_specs_data( $post_id ) {
 	$product = wc_get_product( $post_id );

 	$custom_product_specs_seating = isset( $_POST['product_specs_seating'] ) ? $_POST['product_specs_seating'] : '';
 	$product->update_meta_data( 'product_specs_seating', sanitize_text_field( $custom_product_specs_seating ) );
 
 	$custom_product_specs_body = isset( $_POST['product_specs_body'] ) ? $_POST['product_specs_body'] : '';
 	$product->update_meta_data( 'product_specs_body', sanitize_text_field( $custom_product_specs_body ) );
 	
 	$custom_product_specs_doors = isset( $_POST['product_specs_doors'] ) ? $_POST['product_specs_doors'] : '';
 	$product->update_meta_data( 'product_specs_doors', sanitize_text_field( $custom_product_specs_doors ) );
 	
 	$custom_product_specs_charge_time = isset( $_POST['product_specs_charge_time'] ) ? $_POST['product_specs_charge_time'] : '';
 	$product->update_meta_data( 'product_specs_charge_time', sanitize_text_field( $custom_product_specs_charge_time ) );
 	
 	$custom_product_specs_battery_type = isset( $_POST['product_specs_battery_type'] ) ? $_POST['product_specs_battery_type'] : '';
 	$product->update_meta_data( 'product_specs_battery_type', sanitize_text_field( $custom_product_specs_battery_type ) );
 	
 	$custom_product_specs_max_speed = isset( $_POST['product_specs_max_speed'] ) ? $_POST['product_specs_max_speed'] : '';
 	$product->update_meta_data( 'product_specs_max_speed', sanitize_text_field( $custom_product_specs_max_speed ) );
 	
 	$custom_product_specs_range = isset( $_POST['product_specs_range'] ) ? $_POST['product_specs_range'] : '';
 	$product->update_meta_data( 'product_specs_range', sanitize_text_field( $custom_product_specs_range ) );
 	
 	$product->save();

}

add_action( 'woocommerce_process_product_meta', 'save_product_specs_data_body' );

function save_product_specs_data_body( $post_id ) {
 	$product = wc_get_product( $post_id );
 	$custom_product_specs_body = isset( $_POST['product_specs_body'] ) ? $_POST['product_specs_body'] : '';
 	$product->update_meta_data( 'product_specs_body', sanitize_text_field( $custom_product_specs_body ) );
 	$product->save();

}


add_action( 'woocommerce_before_add_to_cart_button', 'display_product_specs' );

/**
 * Display ev spec fields on the product post
 * @since 1.0.0
 */

function display_product_specs() {
	global $post;

	$product = wc_get_product( $post->ID );

	print(
        '<div class="specs">
        	<h2>Specs</h2>
          	<table class="table--specs">
            	<tbody><tr>
              		<th colspan="2" class="table__head"></th>
            	</tr>'
	);

    $specs = [
		'Seating' => 'product_specs_seating',
		'Body' => 'product_specs_body',
		'Doors' => 'product_specs_doors',
		'Charge Time' => 'product_specs_charge_time',
		'Battery Type' => 'product_specs_battery_type',
		'Max Speed' => 'product_specs_max_speed',
		'Range' => 'product_specs_range'
     ];

    foreach ( $specs as $key => $value ) {
    	$spec_value = $product->get_meta( $value );
		if( $spec_value ) {
			printf(
				'<tr class="table__row"><td>%s</td><td>%s</td></tr>', esc_html( $key ), esc_html( $spec_value )
			);
		}
	}

	print(
	'</tbody></table>
        </div>'
    );
}

add_action( 'woocommerce_before_add_to_cart_button', 'display_product_vendor_info' );

/**
 * Display vendor info on the product post
 * @since 1.0.0
 */

function display_product_vendor_info() {
	global $post;

	$product = wc_get_product( $post->ID );

	$vendor_id = get_post_field( 'post_author', $product->get_id() );
	$vendor = get_userdata( $vendor_id );

	var_dump($vendor);
}


