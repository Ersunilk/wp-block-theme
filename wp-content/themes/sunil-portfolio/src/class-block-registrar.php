<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class BlockRegistrar {

    public function boot(): void {
        add_action( 'init', [ $this, 'register_blocks'   ] );
        add_action( 'init', [ $this, 'register_patterns' ] );
    }

    public function register_blocks(): void {

        $theme_dir = get_template_directory();

       $blocks = [
            'portfolio-header',
            'portfolio-hero',
            'project-grid',
            'skills-grid',
            'portfolio-footer',
            'contact-form',
            'cv-download',
        ];

        foreach ( $blocks as $block ) {
            $path = $theme_dir . '/blocks/' . $block;
            $block_json_path = $path . '/block.json';

            if ( file_exists( $block_json_path ) ) {
                $block_json = json_decode( file_get_contents( $block_json_path ), true );
                $has_render = isset( $block_json['render'] ) ? 'YES' : 'NO';
                error_log( "[BlockRegistrar] $block: render.php in block.json: $has_render" );

                $result = register_block_type( $path );
                if ( is_wp_error( $result ) ) {
                    error_log( '[BlockRegistrar] Block registration failed: ' . $block . ' | ' . $result->get_error_message() );
                } else {
                    $is_dynamic = is_array( $result ) && isset( $result['render_callback'] ) ? 'YES' : ( is_object( $result ) && property_exists( $result, 'render_callback' ) && $result->render_callback ? 'YES' : 'NO' );
                    error_log( "[BlockRegistrar] Block registered: $block | Dynamic: $is_dynamic" );
                }
            } else {
                error_log( '[BlockRegistrar] block.json NOT FOUND: ' . $path );
            }
        }

    }

    public function register_patterns(): void {
        register_block_pattern_category(
            'sunil-portfolio',
            [ 'label' => 'Sunil Portfolio' ]
        );
    }

}