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



add_filter( 'wp_nav_menu_items', 'child_theme_menu_items', 10, 2);

function child_theme_menu_items($items, $args) {
    // get array of '<li> ... </li>' strings
    preg_match_all('/<\s*?li\b[^>]*>(.*?)<\/li\b[^>]*>/s', $items, $items_array );
    error_log('--->1' . print_r($items,true));
    error_log('--->3' . print_r($items_array,true));
    $position = floor(count($items_array[0])/2);
    $homestring = array('<li class="menu-item menu-item-type-post_type menu-item-object-page menu_homelink">' . child_theme_menu_logo() . '</li>');
    $result = array_merge(array_slice($items_array[0], 0, $position), $homestring, array_slice($items_array[0], $position));
    error_log('--->3' . print_r($result,true));
    $items = implode('', $result);
    return $items;
}

function child_theme_menu_logo() {
    $logo = boldthemes_get_option( 'logo' );
    $logo_string = '';
    $home_link =  home_url( '/' ) ;
	if ( $logo != '' && $logo != ' ' ) {
		
			$logo_string .= '<a href="' . esc_url( $home_link ) . '"><img class="btMainLogo" src="' . esc_attr( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"></a>';
	} else {
		$logo_string .= '<a href="' .  esc_url(home_url( '/' )) . '">' .  esc_attr( get_bloginfo( 'name' ) ) . '</a>';
	}
    return $logo_string;
}

?>
