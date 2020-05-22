<?php
/**
 * Custom Gutenberg functions
 */

function sandbox__gutenberg_default_colors()
{
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name' => 'White',
                'slug' => 'white',
                'color' => '#ffffff'
            ),
            array(
                'name' => 'Black',
                'slug' => 'black',
                'color' => '#171D29'
            ),
            array(
                'name' => 'Primary',
                'slug' => 'primary',
                'color' => '#46BE08'
            ),
            array(
                'name' => 'Primary light',
                'slug' => 'primary-light',
                'color' => '#7DE348'
            )
        )
    );

    add_theme_support( 'align-wide' );
    add_theme_support( 'align-full' );

    add_theme_support(
        'editor-gradient-presets',
        array(
            array(
                'name' => 'Desert',
                'slug' => 'desert',
                'gradient' => 'linear-gradient(90deg, rgba(191,85,38,1) 0%, rgba(121,9,9,1) 50%, rgba(89,83,116,1) 100%)'
            )
        )
    );

    add_theme_support(
        'editor-font-sizes',
        array(
            array(
                'name' => 'Normal',
                'slug' => 'normal',
                'size' => 16
            ),
            array(
                'name' => 'Large',
                'slug' => 'large',
                'size' => 24
            )
        )
    );
}
add_action( 'init', 'sandbox__gutenberg_default_colors' );

function sandbox__gutenberg_blocks() {
    wp_register_script('custom-cta-js', get_stylesheet_directory_uri() . '/assets/js/custom-cta-block.js', array('wp-blocks'));

    register_block_type( 'sandbox/custom-cta', array(
        'editor_script' => 'custom-cta-js'
    ));
}

add_action( 'init', 'sandbox__gutenberg_blocks' );