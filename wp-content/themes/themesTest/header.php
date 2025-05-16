<?php
$logo_url = get_field('logo'); // Logo từ ACF
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <nav class="nav__container">
            <div class="logo">
                <?php if ($logo_url): ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="TraviLog Logo">
                <?php else: ?>
                    <h1>TraviLog</h1>
                <?php endif; ?>
            </div>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'nav-menu',
                'fallback_cb' => ''
            ));
            ?>

            <div class="auth-buttons">
                <button class="login">Log In</button>
                <button class="signup">Sign Up</button>
            </div>

            <div class="mobile-menu-toggle">☰</div>
        </nav>
    </header>