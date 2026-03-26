<?php
$copyright     = $attributes['copyrightText'] ?? '© 2025 Sunil Kumar. All Rights Reserved.';
$linkedin_url  = $attributes['linkedinUrl']   ?? '#';
$github_url    = $attributes['githubUrl']     ?? '#';
$dribbble_url  = $attributes['dribbbleUrl']   ?? '#';
$show_linkedin = $attributes['showLinkedin']  ?? true;
$show_github   = $attributes['showGithub']    ?? true;
$show_dribbble = $attributes['showDribbble']  ?? false;
$bg_color      = $attributes['bgColor']       ?? '#000000';
$text_color    = $attributes['textColor']     ?? '#ffffff';
$link_color    = $attributes['linkColor']     ?? '#F6A86E';
$font_size     = $attributes['fontSize']      ?? '0.75rem';
?>

<footer style="
    background: <?php echo esc_attr( $bg_color ); ?>;
    color: <?php echo esc_attr( $text_color ); ?>;
    padding: 3rem 4rem;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    font-size: <?php echo esc_attr( $font_size ); ?>;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    font-family: 'Inter', sans-serif;
    flex-wrap: wrap;
    gap: 1rem;
">

    <!-- Copyright -->
    <div>
        <?php echo esc_html( $copyright ); ?>
    </div>

    <!-- Social Links -->
    <div style="display:flex;gap:2rem;align-items:center">

        <?php if ( $show_linkedin && $linkedin_url ) : ?>
            
                <a href="<?php echo esc_url( $linkedin_url ); ?>"
                target="_blank"
                rel="noopener noreferrer"
                style="
                    color: <?php echo esc_attr( $text_color ); ?>;
                    text-decoration: none;
                    transition: color 0.2s;
                "
                onmouseover="this.style.color='<?php echo esc_attr( $link_color ); ?>'"
                onmouseout="this.style.color='<?php echo esc_attr( $text_color ); ?>'"
            >
                LinkedIn
            </a>
        <?php endif; ?>

        <?php if ( $show_github && $github_url ) : ?>
            
                <a href="<?php echo esc_url( $github_url ); ?>"
                target="_blank"
                rel="noopener noreferrer"
                style="
                    color: <?php echo esc_attr( $text_color ); ?>;
                    text-decoration: none;
                    transition: color 0.2s;
                "
                onmouseover="this.style.color='<?php echo esc_attr( $link_color ); ?>'"
                onmouseout="this.style.color='<?php echo esc_attr( $text_color ); ?>'"
            >
                GitHub
            </a>
        <?php endif; ?>

        <?php if ( $show_dribbble && $dribbble_url ) : ?>
            
                <a href="<?php echo esc_url( $dribbble_url ); ?>"
                target="_blank"
                rel="noopener noreferrer"
                style="
                    color: <?php echo esc_attr( $text_color ); ?>;
                    text-decoration: none;
                    transition: color 0.2s;
                "
                onmouseover="this.style.color='<?php echo esc_attr( $link_color ); ?>'"
                onmouseout="this.style.color='<?php echo esc_attr( $text_color ); ?>'"
            >
                Dribbble
            </a>
        <?php endif; ?>

    </div>

</footer>