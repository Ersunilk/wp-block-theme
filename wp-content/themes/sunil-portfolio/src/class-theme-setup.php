<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ThemeSetup {

    public function boot(): void {
        add_action( 'after_setup_theme',  [ $this, 'setup'           ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets'  ] );
        add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_editor_assets' ] );
        add_action( 'enqueue_block_assets',        [ $this, 'enqueue_block_assets'  ] );
    }

    public function setup(): void {
        add_theme_support( 'wp-block-styles'      );
        add_theme_support( 'editor-styles'        );
        add_theme_support( 'responsive-embeds'    );
        add_theme_support( 'block-template-parts' );

        // Tell WordPress to load our CSS in the editor too
        add_editor_style( 'assets/css/main.css' );

        register_block_pattern_category(
            'sunil-portfolio',
            [ 'label' => 'Sunil Portfolio' ]
        );
    }

    // Frontend styles
    public function enqueue_assets(): void {
        $this->load_fonts();

        wp_enqueue_style(
            'sunil-portfolio-style',
            get_stylesheet_uri(),
            [],
            wp_get_theme()->get( 'Version' )
        );

        wp_enqueue_style(
            'sunil-portfolio-main',
            get_theme_file_uri( 'assets/css/main.css' ),
            [ 'sunil-portfolio-style' ],
            filemtime( get_theme_file_path( 'assets/css/main.css' ) )
        );

        wp_enqueue_script(
            'sunil-portfolio-main',
            get_theme_file_uri( 'assets/js/main.js' ),
            [],
            wp_get_theme()->get( 'Version' ),
            true
        );
    }

    // Editor styles — loads Tailwind inside Gutenberg editor
    public function enqueue_editor_assets(): void {
        $this->load_fonts();

        wp_enqueue_style(
            'sunil-portfolio-editor',
            get_theme_file_uri( 'assets/css/main.css' ),
            [],
            filemtime( get_theme_file_path( 'assets/css/main.css' ) )
        );
    }

    // Block styles — loads for all blocks frontend + backend
    public function enqueue_block_assets(): void {
        wp_enqueue_style(
            'sunil-portfolio-blocks',
            get_theme_file_uri( 'assets/css/main.css' ),
            [],
            filemtime( get_theme_file_path( 'assets/css/main.css' ) )
        );
    }

    // Shared font loader
    private function load_fonts(): void {
        wp_enqueue_style(
            'sunil-google-fonts',
            'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700;900&family=Playfair+Display:ital,wght@0,700;1,700&display=swap',
            [],
            null
        );

        wp_enqueue_style(
            'sunil-material-icons',
            'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
            [],
            null
        );
    }

    

}