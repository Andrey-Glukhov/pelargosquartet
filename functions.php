<?php
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

/**
 * The SEED Team
 * Override Header menu output
 */
if ( ! function_exists( 'boldthemes_nav_menu' ) ) {
	function boldthemes_nav_menu( $walker = false, $theme_location = 'primary' ) {
    ?>

    <nav class="navbar navbar-expand-md navbar-dark background_nav fixed-top flex-column">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <a class="navigation-button">
            <div class="animated-icon1"><span></span><span></span><span></span></div>
            </a>
        </button>

        <div class="collapse navbar-collapse justify-content-center w-100" id="navbarNav" style="padding: 20px 0;">
            <ul class="navbar-nav">
                <?php

                wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'navbar ml-auto',
                'items_wrap' => '<li id="%1$s" data-scroll class="navbar-item %2$s">%3$s</li>',
                'item_spacing' => 'preserve'
                )
                );
                ?>
            </ul>
        </div>
        <div class="menu_utilits">
            <div class="icon"><a href="https://www.instagram.com/ironladysteak/?igshid=14y4t2r7c766a" target="_blank"><i class="fab fa-instagram"></i></a></div>
            <div class="lang_icon"><ul id="lang_choise"><?php pll_the_languages( array( 'show_names' => 2 ) ); ?></ul></div>
        </div>
    </nav>
    <?php }
}

?>
