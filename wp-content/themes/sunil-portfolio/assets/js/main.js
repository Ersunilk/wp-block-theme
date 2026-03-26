// Navigation
document.addEventListener('DOMContentLoaded', function() {

    const menuBtn  = document.getElementById('menuBtn');
    const closeBtn = document.getElementById('closeBtn');
    const navOverlay = document.getElementById('navOverlay');

    if ( ! menuBtn || ! navOverlay ) return;

    const navLinks = navOverlay.querySelectorAll('a');

    const toggleNav = () => {
        navOverlay.classList.toggle('translate-x-full');
        document.body.classList.toggle('overflow-hidden');
    };

    menuBtn.addEventListener('click', toggleNav);
    closeBtn.addEventListener('click', toggleNav);
    navLinks.forEach(link => link.addEventListener('click', toggleNav));

    // Dark mode
    const themeBtn = document.getElementById('darkModeToggle');
    let isDark = false;

    if ( themeBtn ) {
        themeBtn.addEventListener('click', () => {
            isDark = !isDark;
            document.body.classList.toggle('dark-mode', isDark);
        });
    }

});