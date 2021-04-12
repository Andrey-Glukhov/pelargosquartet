<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php boldthemes_theme_data(); ?>>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/52d51e5636.js" crossorigin="anonymous"></script>
<head>

<?php

	boldthemes_set_override();
	boldthemes_header_init();
	boldthemes_header_meta();

	$body_style = '';

	$page_background = boldthemes_get_option( 'page_background' );
	if ( $page_background ) {
		if ( is_numeric( $page_background ) ) {
			$page_background = wp_get_attachment_image_src( $page_background, 'full' );
			$page_background = $page_background[0];
		}
		$body_style = ' style="background-image:url(' . $page_background . ')"';
	}

	$header_extra_class = '';

	if ( boldthemes_get_option( 'boxed_menu' ) ) {
		$header_extra_class .= 'gutter ';
	}

	if (is_home()) {
		$header_extra_class .= 'child_home_menu';
	}		

	wp_head(); ?>

</head>

<body <?php body_class(); ?> <?php echo wp_kses_post( $body_style ); ?>>
<?php

echo boldthemes_preloader_html(); ?>

<div class="btPageWrap" id="top">

    <div class="btVerticalHeaderTop">
		<?php if ( has_nav_menu( 'primary' ) ) { ?>
		<div class="btVerticalMenuTrigger childTrigger">&nbsp;<?php echo boldthemes_get_icon_html( array( "icon" => "fa_f0c9", "url" => "#" ) ); ?></div>
		<?php } ?>
		<div class="childLogoArea">
			<div class="logo">
				<span>
					<?php echo  child_theme_menu_logo(); ?>
				</span>
			</div><!-- /logo -->
		</div><!-- /btLogoArea -->
	</div>
	<header class="mainHeader btClear <?php echo esc_attr( $header_extra_class ); ?>">	
		<div class="mainHeaderInner">
				<div class="btLogoArea menuHolder btClear">
					<div class="port">
						<div class="menuPort">							
							<nav class="navbar navbar-expand-md navbar-dark background_nav fixed-top flex-column">
			    				<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			            		 <a class="navigation-button">
			             			<div class="animated-icon1"><span></span><span></span><span></span></div>
			            		 </a>
								</button> -->
									<div class="collapse navbar-collapse justify-content-center py-0 w-100" id="navbarNav">
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
							
							</nav>
						</div><!-- .menuPort -->
					</div><!-- /port -->
				</div><!-- / inner header for scrolling -->
		</div><!-- / inner header for scrolling -->
    </header><!-- /.mainHeader -->
	<div class="lang_icon"><ul id="lang_choise"><?php pll_the_languages( array( 'show_names' => 2 ) ); ?></ul></div>
	<div class="btContentWrap btClear">
		<?php
		$hide_headline = boldthemes_get_option( 'hide_headline' );
		if ( ( ( !$hide_headline && !is_404() ) || is_search() ) ) {
			boldthemes_header_headline( array( 'breadcrumbs' => true ) );
		}
		?>
		<?php if ( BoldThemesFramework::$page_for_header_id != '' && ! is_search() ) { ?>
			<?php
				$content = get_post( BoldThemesFramework::$page_for_header_id );
				$top_content = $content->post_content;
				if ( $top_content != '' ) {
					$top_content = apply_filters( 'the_content', $top_content );
					$top_content = preg_replace( '/data-edit_url="(.*?)"/s', 'data-edit_url="' . get_edit_post_link( BoldThemesFramework::$page_for_header_id, '' ) . '"', $top_content );
					echo '<div class = "btBlogHeaderContent">' . str_replace( ']]>', ']]&gt;', $top_content ) . '</div>';
				}

			?>
		<?php } ?>
		<div class="btContentHolder">

			<div class="btContent">
