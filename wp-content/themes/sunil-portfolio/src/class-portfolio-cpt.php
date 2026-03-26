<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PortfolioCPT {

    public function boot(): void {
        add_action( 'init',                        [ $this, 'register_post_type'  ] );
        add_action( 'init',                        [ $this, 'register_taxonomy'   ] );
        add_action( 'init',                        [ $this, 'register_meta'       ] );
        add_action( 'add_meta_boxes',              [ $this, 'add_meta_boxes'      ] );
        add_action( 'save_post_portfolio_project', [ $this, 'save_meta'           ] );
    }

    public function register_post_type(): void {
        register_post_type( 'portfolio_project', [
            'labels' => [
                'name'          => 'Projects',
                'singular_name' => 'Project',
                'add_new_item'  => 'Add New Project',
                'edit_item'     => 'Edit Project',
            ],
            'public'        => true,
            'show_in_rest'  => true,
            'supports'      => [ 'title', 'thumbnail', 'custom-fields', 'excerpt' ],
            'menu_icon'     => 'dashicons-portfolio',
            'menu_position' => 5,
            'taxonomies'    => [ 'project_category' ], // 👈 attach taxonomy
        ] );
    }

    // ─── NEW: Register Taxonomy ───────────────────────────────────────────────
    public function register_taxonomy(): void {
        register_taxonomy( 'project_category', 'portfolio_project', [
            'labels' => [
                'name'              => 'Project Categories',
                'singular_name'     => 'Project Category',
                'add_new_item'      => 'Add New Category',
                'edit_item'         => 'Edit Category',
                'search_items'      => 'Search Categories',
                'all_items'         => 'All Categories',
                'not_found'         => 'No categories found.',
            ],
            'hierarchical'      => true,       // true = like categories (checkboxes)
                                               // false = like tags (type & add)
            'public'            => true,
            'show_in_rest'      => true,       // enables Gutenberg sidebar support
            'show_admin_column' => true,       // shows category column in projects list
            'rewrite'           => [ 'slug' => 'project-category' ],
        ] );
    }
    // ─────────────────────────────────────────────────────────────────────────

    public function register_meta(): void {
        $fields = [
            'tech_stack'     => 'string',
            'live_url'       => 'string',
            'lcp_speed'      => 'string',
            'seo_score'      => 'string',
            'security_grade' => 'string',
        ];

        foreach ( $fields as $key => $type ) {
            register_post_meta( 'portfolio_project', $key, [
                'show_in_rest'  => true,
                'single'        => true,
                'type'          => $type,
                'auth_callback' => function() { return current_user_can( 'edit_posts' ); },
            ] );
        }
    }

    public function add_meta_boxes(): void {
        add_meta_box(
            'project_details',
            'Project Details',
            [ $this, 'render_meta_box' ],
            'portfolio_project',
            'normal',
            'high'
        );
    }

    public function render_meta_box( WP_Post $post ): void {
        $tech_stack     = get_post_meta( $post->ID, 'tech_stack',     true );
        $live_url       = get_post_meta( $post->ID, 'live_url',       true );
        $lcp_speed      = get_post_meta( $post->ID, 'lcp_speed',      true );
        $seo_score      = get_post_meta( $post->ID, 'seo_score',      true );
        $security_grade = get_post_meta( $post->ID, 'security_grade', true );

        wp_nonce_field( 'project_meta_nonce', 'project_nonce' );
        ?>
        <table class="form-table">
            <tr>
                <th><label for="tech_stack">Tech Stack</label></th>
                <td>
                    <input type="text" name="tech_stack" id="tech_stack"
                        value="<?php echo esc_attr( $tech_stack ); ?>"
                        class="regular-text"
                        placeholder="e.g. Headless WP / React / GraphQL" />
                </td>
            </tr>
            <tr>
                <th><label for="live_url">Live URL</label></th>
                <td>
                    <input type="url" name="live_url" id="live_url"
                        value="<?php echo esc_attr( $live_url ); ?>"
                        class="regular-text"
                        placeholder="https://example.com" />
                </td>
            </tr>
            <tr>
                <th><label for="lcp_speed">LCP Speed</label></th>
                <td>
                    <input type="text" name="lcp_speed" id="lcp_speed"
                        value="<?php echo esc_attr( $lcp_speed ); ?>"
                        class="regular-text"
                        placeholder="e.g. 0.8s" />
                </td>
            </tr>
            <tr>
                <th><label for="seo_score">SEO Score</label></th>
                <td>
                    <input type="text" name="seo_score" id="seo_score"
                        value="<?php echo esc_attr( $seo_score ); ?>"
                        class="regular-text"
                        placeholder="e.g. 100" />
                </td>
            </tr>
            <tr>
                <th><label for="security_grade">Security Grade</label></th>
                <td>
                    <input type="text" name="security_grade" id="security_grade"
                        value="<?php echo esc_attr( $security_grade ); ?>"
                        class="regular-text"
                        placeholder="e.g. A+" />
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_meta( int $post_id ): void {

        if ( wp_is_post_revision( $post_id ) ) return;
        if ( ! isset( $_POST['project_nonce'] ) ) return;
        if ( ! wp_verify_nonce( $_POST['project_nonce'], 'project_meta_nonce' ) ) return;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( ! current_user_can( 'edit_post', $post_id ) ) return;

        $fields = [
            'tech_stack'     => 'sanitize_text_field',
            'live_url'       => 'esc_url_raw',
            'lcp_speed'      => 'sanitize_text_field',
            'seo_score'      => 'sanitize_text_field',
            'security_grade' => 'sanitize_text_field',
        ];

        foreach ( $fields as $field => $sanitizer ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, $sanitizer( $_POST[ $field ] ) );
            }
        }
    }
}

( new PortfolioCPT() )->boot();