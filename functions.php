<?php
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
	//wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array('jquery'), null, true );

	wp_enqueue_script(
        'show-hide-js',
        get_stylesheet_directory_uri() . '/framework/js/showhide.js',
        array( 'jquery' ),
		'',
		true
    );
	

}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );



add_filter( 'wp_nav_menu_items', 'child_theme_menu_items', 10, 2);

function child_theme_menu_items($items, $args) {
    // get array of '<li> ... </li>' strings
    preg_match_all('/<\s*?li\b[^>]*>(.*?)<\/li\b[^>]*>/s', $items, $items_array );
    //error_log('--->1' . print_r($items,true));
    //error_log('--->3' . print_r($items_array,true));
    $position = floor(count($items_array[0])/2);
    $homestring = array('<li class="menu-item menu-item-type-post_type menu-item-object-page menu_homelink">' . child_theme_menu_logo() . '</li>');
    $result = array_merge(array_slice($items_array[0], 0, $position), $homestring, array_slice($items_array[0], $position));
    //error_log('--->3' . print_r($result,true));
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

add_shortcode( 'showhide', 'showhide_shortcode' );
function showhide_shortcode( $atts, $content = null ) {
	// Variables
	$post_id = get_the_id();
	$word_count = number_format_i18n( sizeof( explode( ' ', strip_tags( $content ) ) ) );

	// Extract ShortCode Attributes
	$attributes = shortcode_atts( array(
		'type' => 'pressrelease',
		'more_text' => __( 'Show Press Release (%s More Words)', 'wp-showhide' ),
		'less_text' => __( 'Hide Press Release (%s Less Words)', 'wp-showhide' ),
		'hidden' => 'yes'
	), $atts );

	// More/Less Text
	$more_text = sprintf( $attributes['more_text'], $word_count );
	$less_text = sprintf( $attributes['less_text'], $word_count );
  //$more_text = '>>>';
  //$less_text = '<<<';
	// Determine Whether To Show Or Hide Press Release
	$hidden_class = 'sh-hide';
	$hidden_css = 'display: none;';
	$hidden_aria_expanded = 'false';
	if( $attributes['hidden'] === 'no' ) {
		$hidden_class = 'sh-show';
		$hidden_css = 'display: block;';
		$hidden_aria_expanded = 'true';
		$tmp_text = $more_text;
		$more_text = $less_text;
		$less_text = $tmp_text;
	}

	// Format HTML Output
	$output  = '<div id="' . $attributes['type'] . '-link-show' . $post_id . '" class="sh-link ' . $attributes['type'] . '-link ' . $hidden_class .'"><a href="#" onclick="showhide_show(\'' . esc_js( $attributes['type'] ) . '\', ' . $post_id . '); return false;" aria-expanded="' . $hidden_aria_expanded .'"><span id="' . $attributes['type'] . '-toggle-show' . $post_id . '">' . $more_text . '</span></a></div>';
	$output .= '<div id="' . $attributes['type'] . '-content-' . $post_id . '" class="sh-content ' . $attributes['type'] . '-content ' . $hidden_class . '" style="' . $hidden_css . '">' . do_shortcode( $content ) ;
	$output .= '<div id="' . $attributes['type'] . '-link-hide' . $post_id . '" class="sh-link ' . $attributes['type'] . '-link ' . $hidden_class .'"><a href="#" onclick="showhide_hide(\'' . esc_js( $attributes['type'] ) . '\', ' . $post_id . '); return false;" aria-expanded="' . $hidden_aria_expanded .'"><span id="' . $attributes['type'] . '-toggle-hide' . $post_id . '">' . $less_text . '</span></a></div></div>';
	return $output;
}


add_action( 'wp_enqueue_scripts', 'child_dequeue_and_then_enqueue', 100 );

function child_dequeue_and_then_enqueue() {
    // Dequeue (remove) parent theme script
    wp_dequeue_script( 'squadrone-header' );
	wp_deregister_script( 'squadrone-header' );
    // Enqueue replacement child theme script
    wp_enqueue_script(
        'squadrone-header',
        get_stylesheet_directory_uri() . '/framework/js/header.misc.js',
        array( 'jquery' ),
		'',
		true
    );
	
}
?>
