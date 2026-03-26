<?php
$site_title      = $attributes['siteTitle']      ?? 'W/A';
$bg_color        = $attributes['bgColor']        ?? '#000000';
$text_color      = $attributes['textColor']      ?? '#ffffff';
$hover_color     = $attributes['hoverColor']     ?? '#F6A86E';
$nav_items       = $attributes['navItems']       ?? [];
$profile_summary = $attributes['profileSummary'] ?? 'Architecting high-performance WordPress ecosystems.';
?>

<style>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
#navOverlay {
    transition: transform 0.7s cubic-bezier(0.85, 0, 0.15, 1);
}
#menuBtn span {
    transition: width 0.3s ease;
}
</style>

<!-- NAVIGATION BAR -->
<nav style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 50;
    mix-blend-mode: difference;
    padding: 1.5rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
">
    <!-- Site Title -->
    <a href="<?php echo esc_url( home_url() ); ?>" style="
        color: <?php echo esc_attr( $text_color ); ?>;
        font-size: 1.25rem;
        font-weight: 900;
        letter-spacing: -0.05em;
        text-decoration: none;
        font-family: 'Inter', sans-serif;
    ">
        <?php echo esc_html( $site_title ); ?>
    </a>

    <!-- Hamburger -->
    <button id="menuBtn" style="
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 6px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    ">
        <span style="width:2rem;height:2px;background:<?php echo esc_attr( $text_color ); ?>;display:block"></span>
        <span style="width:3rem;height:2px;background:<?php echo esc_attr( $text_color ); ?>;display:block"></span>
        <span style="width:1.5rem;height:2px;background:<?php echo esc_attr( $text_color ); ?>;display:block"></span>
    </button>
</nav>

<!-- FULLSCREEN OVERLAY -->
<div id="navOverlay" style="
    position: fixed;
    inset: 0;
    background: <?php echo esc_attr( $bg_color ); ?>;
    z-index: 60;
    transform: translateX(100%);
    display: flex;
    flex-direction: row;
    padding: 2rem 5rem;
    color: <?php echo esc_attr( $text_color ); ?>;
">
    <!-- Close Button -->
    <button id="closeBtn" style="
        position: absolute;
        top: 2rem;
        right: 2rem;
        background: none;
        border: none;
        color: <?php echo esc_attr( $text_color ); ?>;
        font-size: 2.5rem;
        font-weight: 300;
        cursor: pointer;
        line-height: 1;
    "
    onmouseover="this.style.color='<?php echo esc_attr( $hover_color ); ?>'"
    onmouseout="this.style.color='<?php echo esc_attr( $text_color ); ?>'"
    >×</button>

    <!-- Left — Nav Links -->
    <div style="
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    ">
        <p style="
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #71717a;
            margin-bottom: 1.5rem;
            font-family: 'Inter', sans-serif;
        ">Navigation</p>

        <ul style="
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        ">
            <?php foreach ( $nav_items as $item ) : ?>
                <li>
                    
                       <a href="<?php echo esc_url( $item['url'] ); ?>"
                        style="
                            color: <?php echo esc_attr( $text_color ); ?>;
                            text-decoration: none;
                            font-size: clamp(2.5rem, 7vw, 4.5rem);
                            font-weight: 700;
                            font-family: 'Inter', sans-serif;
                            transition: color 0.2s;
                            display: block;
                        "
                        onmouseover="this.style.color='<?php echo esc_attr( $hover_color ); ?>'"
                        onmouseout="this.style.color='<?php echo esc_attr( $text_color ); ?>'"
                    >
                        <?php echo esc_html( $item['label'] ); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Right — Profile Summary -->
    <div style="
        width: 33%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-left: 1px solid #27272a;
        padding-left: 3rem;
    ">
        <h3 style="
            color: #a1a1aa;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            margin-bottom: 1.5rem;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
        ">Profile Summary</h3>

        <p style="
            font-size: 1.1rem;
            font-weight: 300;
            line-height: 1.7;
            color: <?php echo esc_attr( $text_color ); ?>;
            margin-bottom: 2.5rem;
            font-family: 'Inter', sans-serif;
        ">
            <?php echo esc_html( $profile_summary ); ?>
        </p>

        <!-- Dark Mode Toggle -->
        <button id="darkModeToggle" style="
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: none;
            border: none;
            color: <?php echo esc_attr( $text_color ); ?>;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            padding: 0;
        ">
            <span id="toggleTrack" style="
                width: 2.5rem;
                height: 1.25rem;
                background: #3f3f46;
                border-radius: 9999px;
                position: relative;
                display: block;
            ">
                <span id="toggleThumb" style="
                    position: absolute;
                    left: 4px;
                    top: 4px;
                    width: 0.75rem;
                    height: 0.75rem;
                    background: #ffffff;
                    border-radius: 50%;
                    transition: left 0.2s;
                    display: block;
                "></span>
            </span>
            <span style="
                font-size: 0.625rem;
                text-transform: uppercase;
                letter-spacing: 0.2em;
                font-weight: 700;
            ">Theme</span>
        </button>
    </div>
</div>

<!-- SCRIPTS -->
<script>
(function() {

    var menuBtn    = document.getElementById('menuBtn');
    var closeBtn   = document.getElementById('closeBtn');
    var navOverlay = document.getElementById('navOverlay');

    if ( !menuBtn || !navOverlay ) return;

    var navLinks = navOverlay.querySelectorAll('a');
    var spans    = menuBtn.querySelectorAll('span');

    // Open nav
    function openNav() {
        navOverlay.style.transform = 'translateX(0%)';
        document.body.style.overflow = 'hidden';
    }

    // Close nav
    function closeNav() {
        navOverlay.style.transform = 'translateX(100%)';
        document.body.style.overflow = '';
    }

    menuBtn.addEventListener('click', openNav);
    closeBtn.addEventListener('click', closeNav);
    navLinks.forEach(function(link) {
        link.addEventListener('click', closeNav);
    });

    // Hamburger hover
    menuBtn.addEventListener('mouseenter', function() {
        spans[0].style.width = '3rem';
        spans[2].style.width = '3rem';
    });
    menuBtn.addEventListener('mouseleave', function() {
        spans[0].style.width = '2rem';
        spans[2].style.width = '1.5rem';
    });

    // Dark mode
    var darkBtn = document.getElementById('darkModeToggle');
    var thumb   = document.getElementById('toggleThumb');
    var isDark  = false;

    if ( darkBtn && thumb ) {
        darkBtn.addEventListener('click', function() {
            isDark = !isDark;
            if ( isDark ) {
                document.documentElement.style.setProperty('--bg', '#09090b');
                document.body.style.background = '#09090b';
                document.body.style.color = '#ffffff';
                thumb.style.left = '16px';
            } else {
                document.body.style.background = '#ffffff';
                document.body.style.color = '#000000';
                thumb.style.left = '4px';
            }
        });
    }

})();
</script>