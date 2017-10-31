<?php
/**
 * 
 */


add_action( 'init', 'remove_actions_parent_theme');
function remove_actions_parent_theme() {
	// woocommerce
	// Cart
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
	add_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 20 );

	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
	add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 30 );
	// end Cart
	// Shop
	remove_action( 'woocommerce_before_shop_loop',       'woocommerce_result_count',                 20 );
	//remove_action( 'woocommerce_after_shop_loop',        'woocommerce_catalog_ordering',             10 );
	remove_action( 'woocommerce_after_shop_loop',        'woocommerce_result_count',                 20 );
	// end Shop

	// storefront
	remove_action( 'homepage', 'storefront_best_selling_products', 70 );

	add_action( 'storefront_header', 'mp_secondary_navigation_wrapper',       2 );

	remove_action( 'storefront_header', 'storefront_header_cart',    60 );
	add_action( 'storefront_header', 'storefront_header_cart',    10 );

	remove_action( 'storefront_header', 'storefront_secondary_navigation',             30 );
	add_action( 'storefront_header', 'storefront_secondary_navigation',             10 );

	add_action( 'storefront_header', 'mp_secondary_navigation_wrapper_close',       18 );

	remove_action( 'storefront_header', 'storefront_product_search', 40 );
	add_action( 'storefront_header', 'storefront_product_search', 60 );


	// customize
	add_action( 'storefront_homepage_after_product_categories_title',  'mp_homepage_after_product_categories_title');
	add_action( 'storefront_homepage_after_on_sale_products_title',  'mp_homepage_after_on_sale_products_title');
}

function mp_product_categories_args( $args ) {
	$product_cat_collections = 'collections';

	$t = get_term_by('slug', $product_cat_collections, 'product_cat');
	
	if ( !empty($t) ) {
		$args['child_categories'] = $t->term_id;
		$args['title'] = __( $t->name, 'ntkdesign' );
	}
	return $args;
	
}
add_filter( 'storefront_product_categories_args', 'mp_product_categories_args' );

function mp_catalog_orderby( $options ) {
	$options['menu_order'] = __( 'Default', 'ntkdesign' );
	$options['popularity'] = __( 'Popularity', 'ntkdesign' );
	$options['rating'] = __( 'Average rating', 'ntkdesign' );
	$options['date'] = __( 'Newness', 'ntkdesign' );
	$options['price'] = __( 'Price: low to high', 'ntkdesign' );
	$options['price-desc'] = __( 'Price: high to low', 'ntkdesign' );

	return $options;
}
add_filter( 'woocommerce_catalog_orderby', 'mp_catalog_orderby' );

if ( ! function_exists( 'mp_homepage_after_product_categories_title' ) ) {
	function mp_homepage_after_product_categories_title() {
		$product_cat_collections = 'collections';

		$t = get_term_by('slug', $product_cat_collections, 'product_cat');
	
		$html = '<a class="section-viewall" href=' . get_term_link($t->term_id, $t->taxonomy) . '>View All</a>';
		echo $html;
	}
}

if ( ! function_exists( 'mp_homepage_after_on_sale_products_title' ) ) {
	function mp_homepage_after_on_sale_products_title() {
		$page_title = 'On Sale';

		$page = get_page_by_title( $page_title );
		if ( !empty($page) ) {
			$html = '<a class="section-viewall" href=' . get_permalink( $page ) . '>View All</a>';
			echo $html;
		}
	}
}

// override footer copyright
if ( ! function_exists( 'storefront_credit' ) ) {
	/**
	 * Display the theme credit
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_credit() {
		?>
		<div class="site-info">
			&copy Mt. Paul PTY LTD
		</div><!-- .site-info -->
		<?php
	}
}

if ( ! function_exists( 'storefront_site_title_or_logo' ) ) {
	function storefront_site_title_or_logo( $echo = true ) {
		
		$html = format_site_title();

		if ( '' !== get_bloginfo( 'description' ) ) {
			$html .= '<p class="site-description">' . esc_html( get_bloginfo( 'description', 'display' ) ) . '</p>';
		}
		
		if ( ! $echo ) {
			return $html;
		}

		echo $html;
	}
}

function format_site_title() {
	$tag = is_home() ? 'h1' : 'div';
	$html = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home"><span class="site-title-1st">NTK</span><span class="site-title-2nd">DESIGNS</span></a></' . esc_attr( $tag ) .'>';

	return $html;
}

if ( ! function_exists( 'mp_secondary_navigation_wrapper' ) ) {
	function mp_secondary_navigation_wrapper() {
		echo '<div class="mp-secondary-navigation">';
	}
}

if ( ! function_exists( 'mp_secondary_navigation_wrapper_close' ) ) {
	function mp_secondary_navigation_wrapper_close() {
		echo '</div>';
	}
}

// widgets
include_once( dirname( __FILE__ ) . '/inc/class-mp-widget-product-category.php' );
function mp_register_widgets() {
	register_widget( 'MP_Widget_Product_Category' );
}
add_action( 'widgets_init', 'mp_register_widgets' );

// scripts
function mp_add_scripts() {
	wp_register_script( 'footer_script', get_stylesheet_directory_uri() . '/assets/js/footer.js', array('jquery'), true );
	wp_enqueue_script( 'footer_script' );

	wp_register_script( 'header_script', get_stylesheet_directory_uri() . '/assets/js/header.js', array('jquery'), true );
	wp_enqueue_script( 'header_script' );  
}
add_action( 'wp_enqueue_scripts', 'mp_add_scripts' ); 


?>
