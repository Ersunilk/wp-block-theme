<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/src/class-theme-setup.php';
require_once __DIR__ . '/src/class-block-registrar.php';
require_once __DIR__ . '/src/class-portfolio-cpt.php';
require_once __DIR__ . '/src/class-skills-cpt.php';

// Boot everything
( new ThemeSetup()    )->boot();
( new BlockRegistrar())->boot();
( new PortfolioCPT()  )->boot();
( new SkillsCPT()     )->boot();