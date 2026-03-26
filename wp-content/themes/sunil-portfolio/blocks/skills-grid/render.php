<?php
$heading     = $attributes['heading']     ?? 'Technical Ecosystem';
$description = $attributes['description'] ?? 'Beyond themes and plugins. I build robust, decoupled, and secure WordPress environments designed for modern web performance standards.';

// Get all skill categories from taxonomy
$categories = get_terms( [
    'taxonomy'   => 'skill_category',
    'hide_empty' => true,   // only categories that have published skills
    'orderby'    => 'name',
    'order'      => 'ASC',
] );

if ( is_wp_error( $categories ) || empty( $categories ) ) {
    echo '
    <section class="py-32 px-8 md:px-16 bg-white" id="expertise">
        <p style="color:#999;padding:2rem;">
            No skills found.
            Go to WordPress Admin → Skills → Add New
        </p>
    </section>';
    return;
}

// ── Pre-fetch skills per category so we know which ones are non-empty ─────────
// This lets us correctly identify the LAST rendered category for border removal.
$rendered_categories = [];

foreach ( $categories as $cat ) {
    $skills = get_posts( [
        'post_type'      => 'skill',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'tax_query'      => [ [
            'taxonomy' => 'skill_category',
            'field'    => 'term_id',
            'terms'    => $cat->term_id,
        ] ],
    ] );

    if ( ! empty( $skills ) ) {
        $rendered_categories[] = [
            'cat'    => $cat,
            'skills' => $skills,
        ];
    }
}

if ( empty( $rendered_categories ) ) {
    echo '
    <section class="py-32 px-8 md:px-16 bg-white" id="expertise">
        <p style="color:#999;padding:2rem;">
            No skills found.
            Go to WordPress Admin → Skills → Add New
        </p>
    </section>';
    return;
}

$total = count( $rendered_categories );
?>

<section class="py-32 px-8 md:px-16 bg-white" id="expertise">
    <div class="flex flex-col lg:flex-row gap-20 items-start">

        <!-- LEFT SIDE — sticky heading -->
        <div class="lg:w-1/3" style="position:sticky;top:8rem">
            <h2 class="text-5xl font-black uppercase mb-8"
                style="letter-spacing:-0.05em;line-height:1.1">
                <?php echo wp_kses_post( nl2br( esc_html( $heading ) ) ); ?>
            </h2>
            <p class="text-lg text-zinc-500 leading-relaxed mb-12">
                <?php echo esc_html( $description ); ?>
            </p>
        </div>

        <!-- RIGHT SIDE — skills grid -->
        <div class="lg:w-2/3 grid grid-cols-1 gap-12">

            <?php foreach ( $rendered_categories as $i => $entry ) :
                $cat     = $entry['cat'];
                $skills  = $entry['skills'];
                $index   = $i + 1;                     // 1-based display number
                $is_last = ( $index === $total );       // now always correct
            ?>

                <div class="<?php echo $is_last ? '' : 'border-b border-zinc-100'; ?> pb-12">

                    <!-- Category heading -->
                    <div class="flex items-center mb-8 gap-4">
                        <h3 class="text-sm font-black uppercase text-zinc-400 whitespace-nowrap"
                            style="letter-spacing:0.4em">
                            0<?php echo esc_html( $index ); ?> / <?php echo esc_html( $cat->name ); ?>
                        </h3>
                        <div style="height:1px;flex:1;background:#f4f4f5"></div>
                    </div>

                    <!-- Skills cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <?php foreach ( $skills as $skill ) :
                            $skill_desc = get_post_meta( $skill->ID, 'description', true );
                            $icon       = get_post_meta( $skill->ID, 'icon',        true );
                        ?>
                            <div class="p-8 border border-zinc-100 hover:border-orange-300 transition-colors group relative overflow-hidden">

                                <!-- Hover gradient effect -->
                                <div style="
                                    position:absolute;
                                    top:0;right:0;
                                    width:6rem;height:6rem;
                                    background:linear-gradient(90deg,#F6A86E,#F86CA7);
                                    opacity:0;
                                    border-radius:50%;
                                    transform:translate(3rem,-3rem);
                                    transition:opacity 0.3s;
                                " class="group-hover:opacity-5"></div>

                                <?php if ( $icon ) : ?>
                                    <span class="material-symbols-outlined mb-4 block"
                                          style="color:#F86CA7">
                                        <?php echo esc_html( $icon ); ?>
                                    </span>
                                <?php endif; ?>

                                <h4 class="text-xl font-bold mb-3">
                                    <?php echo esc_html( $skill->post_title ); ?>
                                </h4>

                                <?php if ( $skill_desc ) : ?>
                                    <p class="text-sm text-zinc-500 leading-relaxed font-light">
                                        <?php echo esc_html( $skill_desc ); ?>
                                    </p>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>