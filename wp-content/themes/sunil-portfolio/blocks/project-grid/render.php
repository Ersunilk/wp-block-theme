<?php
$heading   = $attributes['heading']    ?? 'Selected Work';
$subheading = $attributes['subheading'] ?? 'Engineered for Scale';
$count     = intval( $attributes['postsCount'] ?? 6 );
$bg_color  = $attributes['bgColor']    ?? '#fafafa';

$projects = new WP_Query( [
    'post_type'      => 'portfolio_project',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );
?>

<style>
.project-card {
    min-width: 350px;
    flex-shrink: 0;
    background: #ffffff;
    border: 1px solid #e4e4e7;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.5s ease;
    cursor: pointer;
}
.project-card:hover {
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}
.project-card:hover .project-img {
    transform: scale(1.05);
}
.project-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease;
}
.project-img-wrap {
    overflow: hidden;
    aspect-ratio: 16/9;
    background: #f4f4f5;
    margin-bottom: 1.5rem;
}
.slider-btn {
    padding: 1rem;
    border: 1px solid #d4d4d8;
    background: none;
    cursor: pointer;
    font-size: 0.75rem;
    font-weight: 700;
    font-family: 'Inter', sans-serif;
    letter-spacing: 0.05em;
    transition: border-color 0.2s;
}
.slider-btn:hover {
    border-color: #000000;
}
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

@media (min-width: 768px) {
    .project-card { min-width: 600px; }
}
</style>

<section
    id="work"
    style="
        padding: 6rem 0;
        background: <?php echo esc_attr( $bg_color ); ?>;
    "
>
    <!-- Section Header -->
    <div style="
        padding: 0 4rem;
        margin-bottom: 4rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    ">
        <div>
            <h2 style="
                font-size: 2.5rem;
                font-weight: 900;
                letter-spacing: -0.05em;
                text-transform: uppercase;
                margin: 0 0 0.5rem;
                font-family: 'Inter', sans-serif;
                color: #000000;
            ">
                <?php echo esc_html( $heading ); ?>
            </h2>
            <p style="
                color: #71717a;
                margin: 0;
                font-family: 'Inter', sans-serif;
            ">
                <?php echo esc_html( $subheading ); ?>
            </p>
        </div>

        <!-- Prev/Next buttons -->
        <div style="display:flex;gap:1rem">
            <button
                class="slider-btn"
                onclick="document.getElementById('projectSlider').scrollBy({left:-650,behavior:'smooth'})"
            >
                PREV
            </button>
            <button
                class="slider-btn"
                onclick="document.getElementById('projectSlider').scrollBy({left:650,behavior:'smooth'})"
            >
                NEXT
            </button>
        </div>
    </div>

    <!-- Slider -->
    <div
        id="projectSlider"
        class="no-scrollbar"
        style="
            display: flex;
            overflow-x: auto;
            gap: 2rem;
            padding: 0 4rem;
            scroll-behavior: smooth;
        "
    >

        <?php if ( $projects->have_posts() ) : ?>

            <?php while ( $projects->have_posts() ) : $projects->the_post(); ?>

                <?php
                $tech_stack     = get_post_meta( get_the_ID(), 'tech_stack',     true );
                $live_url       = get_post_meta( get_the_ID(), 'live_url',       true );
                $lcp_speed      = get_post_meta( get_the_ID(), 'lcp_speed',      true );
                $seo_score      = get_post_meta( get_the_ID(), 'seo_score',      true );
                $security_grade = get_post_meta( get_the_ID(), 'security_grade', true );
                ?>

                <div class="project-card">

                    <!-- Project Image -->
                    <div class="project-img-wrap">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', [
                                'class' => 'project-img',
                            ] ); ?>
                        <?php else : ?>
                            <div style="
                                width: 100%;
                                height: 100%;
                                background: linear-gradient(135deg, #f4f4f5, #e4e4e7);
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                color: #a1a1aa;
                                font-size: 0.8rem;
                                font-family: 'Inter', sans-serif;
                            ">
                                No image
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Project Info -->
                    <div style="
                        display: flex;
                        justify-content: space-between;
                        align-items: flex-start;
                        margin-bottom: 2rem;
                        flex: 1;
                    ">
                        <div>
                            <h3 style="
                                font-size: 1.5rem;
                                font-weight: 700;
                                margin: 0 0 0.25rem;
                                font-family: 'Inter', sans-serif;
                                color: #000000;
                            ">
                                <?php the_title(); ?>
                            </h3>
                            <p style="
                                color: #a1a1aa;
                                font-size: 0.85rem;
                                margin: 0;
                                font-family: 'Inter', sans-serif;
                            ">
                                <?php echo esc_html( $tech_stack ); ?>
                            </p>
                        </div>

                        <?php if ( $live_url ) : ?>
                            
                               <a href="<?php echo esc_url( $live_url ); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                style="
                                    font-size: 0.65rem;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.15em;
                                    color: #F86CA7;
                                    text-decoration: none;
                                    white-space: nowrap;
                                "
                            >
                                Live Case ↗
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Metrics -->
                    <div style="
                        display: grid;
                        grid-template-columns: 1fr 1fr 1fr;
                        border-top: 1px solid #f4f4f5;
                        padding-top: 1.5rem;
                        gap: 1rem;
                    ">
                        <div>
                            <span style="
                                display: block;
                                font-size: 0.6rem;
                                text-transform: uppercase;
                                font-weight: 700;
                                color: #a1a1aa;
                                letter-spacing: 0.1em;
                                margin-bottom: 0.25rem;
                                font-family: 'Inter', sans-serif;
                            ">LCP Speed</span>
                            <span style="
                                font-size: 1.25rem;
                                font-weight: 900;
                                font-family: 'Inter', sans-serif;
                                color: #000000;
                            ">
                                <?php echo esc_html( $lcp_speed ?: '—' ); ?>
                            </span>
                        </div>
                        <div>
                            <span style="
                                display: block;
                                font-size: 0.6rem;
                                text-transform: uppercase;
                                font-weight: 700;
                                color: #a1a1aa;
                                letter-spacing: 0.1em;
                                margin-bottom: 0.25rem;
                                font-family: 'Inter', sans-serif;
                            ">SEO Score</span>
                            <span style="
                                font-size: 1.25rem;
                                font-weight: 900;
                                font-family: 'Inter', sans-serif;
                                color: #000000;
                            ">
                                <?php echo esc_html( $seo_score ?: '—' ); ?>
                            </span>
                        </div>
                        <div>
                            <span style="
                                display: block;
                                font-size: 0.6rem;
                                text-transform: uppercase;
                                font-weight: 700;
                                color: #a1a1aa;
                                letter-spacing: 0.1em;
                                margin-bottom: 0.25rem;
                                font-family: 'Inter', sans-serif;
                            ">Security</span>
                            <span style="
                                font-size: 1.25rem;
                                font-weight: 900;
                                color: #22c55e;
                                font-family: 'Inter', sans-serif;
                            ">
                                <?php echo esc_html( $security_grade ?: '—' ); ?>
                            </span>
                        </div>
                    </div>

                </div>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

        <?php else : ?>

            <!-- Empty state -->
            <div style="
                padding: 4rem;
                text-align: center;
                color: #a1a1aa;
                font-family: 'Inter', sans-serif;
                width: 100%;
            ">
                <p style="font-size:1.25rem;margin:0 0 0.5rem">No projects yet.</p>
                <p style="font-size:0.85rem;margin:0">
                    Go to WordPress Admin → Projects → Add New
                </p>
            </div>

        <?php endif; ?>

    </div>
</section>