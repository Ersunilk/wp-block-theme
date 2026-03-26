<?php
$tagline    = $attributes['tagline']    ?? 'Strategy • Engineering • Design';
$heading1   = $attributes['heading1']   ?? 'WordPress';
$heading2   = $attributes['heading2']   ?? 'Solutions';
$heading3   = $attributes['heading3']   ?? 'Architect';
$paragraph  = $attributes['paragraph']  ?? 'Deploying enterprise-grade technical infrastructures for brands that demand performance without aesthetic compromise.';
$buttonText = $attributes['buttonText'] ?? 'Explore Systems';
$buttonUrl  = $attributes['buttonUrl']  ?? '#work';
$image1     = $attributes['image1Url']  ?? 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=800';
$image2     = $attributes['image2Url']  ?? 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=400';
$image3     = $attributes['image3Url']  ?? 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400';
?>

<style>
.hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: grayscale(100%);
    transition: filter 0.7s ease;
}
.hero-img:hover {
    filter: grayscale(0%);
}
.hero-btn-circle {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    border: 2px solid #000000;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s;
    flex-shrink: 0;
}
.hero-btn-circle:hover {
    background: #000000;
}
.hero-btn-circle:hover svg {
    stroke: #ffffff;
    transform: rotate(45deg);
}
.hero-btn-circle svg {
    transition: stroke 0.3s, transform 0.3s;
}
@media (max-width: 768px) {
    .hero-section {
        flex-direction: column !important;
        padding: 6rem 1.5rem 3rem !important;
    }
    .hero-images {
        width: 100% !important;
        height: 300px !important;
        margin-bottom: 2rem;
    }
    .hero-text {
        width: 100% !important;
        padding-left: 0 !important;
    }
}
</style>

<section
    id="hero"
    class="hero-section"
    style="
        min-height: 100vh;
        display: flex;
        flex-direction: row;
        align-items: center;
        padding-top: 6rem;
        padding-bottom: 6rem;
        padding-left: 4rem;
        padding-right: 4rem;
        margin-bottom: 6rem;
        overflow: hidden;
        background: #ffffff;
    "
>
    <!-- LEFT — Image Gallery -->
    <div
        class="hero-images"
        style="
            width: 40%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 1rem;
            height: 600px;
            flex-shrink: 0;
        "
    >
        <!-- Image 1 — full height left -->
        <div style="
            grid-column: 1;
            grid-row: 1 / 3;
            background: #f4f4f5;
            overflow: hidden;
        ">
            <?php if ( $image1 ) : ?>
                <img
                    src="<?php echo esc_url( $image1 ); ?>"
                    alt="Abstract Architecture"
                    class="hero-img"
                />
            <?php endif; ?>
        </div>

        <!-- Image 2 — top right -->
        <div style="background: #f4f4f5; overflow: hidden;">
            <?php if ( $image2 ) : ?>
                <img
                    src="<?php echo esc_url( $image2 ); ?>"
                    alt="Technical Abstraction"
                    class="hero-img"
                />
            <?php endif; ?>
        </div>

        <!-- Image 3 — bottom right -->
        <div style="background: #f4f4f5; overflow: hidden;">
            <?php if ( $image3 ) : ?>
                <img
                    src="<?php echo esc_url( $image3 ); ?>"
                    alt="Clean Interior"
                    class="hero-img"
                />
            <?php endif; ?>
        </div>
    </div>

    <!-- RIGHT — Typography -->
    <div
        class="hero-text"
        style="
            width: 60%;
            padding-left: 5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        "
    >
        <!-- Tagline -->
        <span style="
            display: block;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #a1a1aa;
            font-family: 'Inter', sans-serif;
        ">
            <?php echo esc_html( $tagline ); ?>
        </span>

        <!-- Main Heading -->
        <h1 style="
            font-size: clamp(3.5rem, 8vw, 6.5rem);
            font-weight: 900;
            letter-spacing: -0.05em;
            line-height: 0.9;
            margin-bottom: 2rem;
            color: #000000;
            font-family: 'Inter', sans-serif;
        ">
            <?php echo esc_html( $heading1 ); ?><br/>
            <span style="
                font-family: 'Playfair Display', serif;
                font-style: italic;
                font-weight: 700;
            "><?php echo esc_html( $heading2 ); ?></span><br/>
            <span style="
                background: linear-gradient(90deg, #F6A86E 0%, #F86CA7 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            "><?php echo esc_html( $heading3 ); ?></span>
        </h1>

        <!-- Paragraph -->
        <p style="
            font-size: 1.25rem;
            color: #52525b;
            max-width: 36rem;
            line-height: 1.7;
            font-weight: 300;
            font-family: 'Inter', sans-serif;
            margin-bottom: 3rem;
        ">
            <?php echo esc_html( $paragraph ); ?>
        </p>

        <!-- CTA Button -->
        <div>
            
                <a href="<?php echo esc_url( $buttonUrl ); ?>"
                style="
                    display: inline-flex;
                    align-items: center;
                    gap: 1rem;
                    text-decoration: none;
                    color: #000000;
                    font-family: 'Inter', sans-serif;
                "
            >
                <span class="hero-btn-circle">
                    <svg
                        width="20"
                        height="20"
                        fill="none"
                        stroke="#000000"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M14 5l7 7m0 0l-7 7m7-7H3"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        />
                    </svg>
                </span>
                <span style="
                    font-size: 0.8rem;
                    font-weight: 900;
                    text-transform: uppercase;
                    letter-spacing: 0.2em;
                ">
                    <?php echo esc_html( $buttonText ); ?>
                </span>
            </a>
        </div>

    </div>
</section>