<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SkillsCPT {

    public function boot(): void {
        add_action( 'init',            [ $this, 'register_post_type' ] );
        add_action( 'init',            [ $this, 'register_taxonomy'  ] );
        add_action( 'init',            [ $this, 'register_meta'      ] );
        add_action( 'add_meta_boxes',  [ $this, 'add_meta_boxes'     ] );
        add_action( 'save_post_skill', [ $this, 'save_meta'          ] );
    }

    public function register_post_type(): void {
        register_post_type( 'skill', [
            'labels' => [
                'name'          => 'Skills',
                'singular_name' => 'Skill',
                'add_new_item'  => 'Add New Skill',
                'edit_item'     => 'Edit Skill',
            ],
            'public'        => true,
            'show_in_rest'  => true,
            'supports'      => [ 'title', 'custom-fields', 'page-attributes' ], // page-attributes = menu_order for sorting
            'menu_icon'     => 'dashicons-awards',
            'menu_position' => 6,
            'taxonomies'    => [ 'skill_category' ], // 👈 attach taxonomy
        ] );
    }

    // ─── NEW: Register Taxonomy ───────────────────────────────────────────────
    public function register_taxonomy(): void {
        register_taxonomy( 'skill_category', 'skill', [
            'labels' => [
                'name'          => 'Skill Categories',
                'singular_name' => 'Skill Category',
                'add_new_item'  => 'Add New Category',
                'edit_item'     => 'Edit Category',
                'search_items'  => 'Search Categories',
                'all_items'     => 'All Categories',
                'not_found'     => 'No categories found.',
            ],
            'hierarchical'      => true,   // checkboxes, like categories
            'public'            => true,
            'show_in_rest'      => true,   // Gutenberg sidebar support
            'show_admin_column' => true,   // shows category in skills list table
            'rewrite'           => [ 'slug' => 'skill-category' ],
        ] );
    }
    // ─────────────────────────────────────────────────────────────────────────

    public function register_meta(): void {
        // 'category' meta field removed — now handled by taxonomy above
        register_post_meta( 'skill', 'description', [
            'show_in_rest'  => true,
            'single'        => true,
            'type'          => 'string',
            'auth_callback' => function() { return current_user_can( 'edit_posts' ); },
        ] );

        register_post_meta( 'skill', 'icon', [
            'show_in_rest'  => true,
            'single'        => true,
            'type'          => 'string',
            'auth_callback' => function() { return current_user_can( 'edit_posts' ); },
        ] );
    }

    public function add_meta_boxes(): void {
        add_meta_box(
            'skill_details',
            'Skill Details',
            [ $this, 'render_meta_box' ],
            'skill',
            'normal',
            'high'
        );
    }

    public function render_meta_box( WP_Post $post ): void {
        $description = get_post_meta( $post->ID, 'description', true );
        $icon        = get_post_meta( $post->ID, 'icon',        true );

        wp_nonce_field( 'skill_meta_nonce', 'skill_nonce' );
        ?>
        <table class="form-table">
            <tr>
                <th><label for="skill_icon">Icon</label></th>
                <td>
                    <input
                        type="text"
                        name="skill_icon"
                        id="skill_icon"
                        value="<?php echo esc_attr( $icon ); ?>"
                        class="regular-text"
                        placeholder="e.g. code, terminal, security" />
                    <p class="description">
                        Material Symbols icon name.
                        <a href="https://fonts.google.com/icons" target="_blank">Browse icons →</a>
                    </p>
                </td>
            </tr>
            <tr>
                <th><label for="skill_description">Description</label></th>
                <td>
                    <textarea
                        name="skill_description"
                        id="skill_description"
                        class="large-text"
                        rows="3"
                        placeholder="Short description of this skill..."
                    ><?php echo esc_textarea( $description ); ?></textarea>
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_meta( int $post_id ): void {

        if ( wp_is_post_revision( $post_id ) ) return;
        if ( ! isset( $_POST['skill_nonce'] ) ) return;
        if ( ! wp_verify_nonce( $_POST['skill_nonce'], 'skill_meta_nonce' ) ) return;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( ! current_user_can( 'edit_post', $post_id ) ) return;

        if ( isset( $_POST['skill_icon'] ) ) {
            update_post_meta( $post_id, 'icon', sanitize_text_field( $_POST['skill_icon'] ) );
        }

        if ( isset( $_POST['skill_description'] ) ) {
            update_post_meta( $post_id, 'description', sanitize_textarea_field( $_POST['skill_description'] ) );
        }
    }
}

( new SkillsCPT() )->boot();