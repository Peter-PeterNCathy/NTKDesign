<?php
/**
 * Product Category Widget
 *
 * @author   Peter
 * @category Widgets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MP_Widget_Product_Category extends WC_Widget {

	/**
	 * Category ancestors.
	 *
	 * @var array
	 */
	public $cat_ancestors;

	/**
	 * Current Category.
	 *
	 * @var bool
	 */
	public $current_cat;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_product_category';
		$this->widget_description = __( 'A list of specific product categories.', 'ntkdesign' );
		$this->widget_id          = 'mp_product_category';
		$this->widget_name        = __( 'Product Category', 'ntkdesign' );
		parent::__construct();
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * @see WP_Widget->update
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$this->init_settings();
		return parent::update( $new_instance, $old_instance );
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @see WP_Widget->form
	 *
	 * @param array $instance
	 */
	public function form( $instance ) {
		$this->init_settings();
		parent::form( $instance );
	}

	/**
	 * Init settings after post types are registered.
	 */
	public function init_settings() {
		$term_ids = get_terms( 'product_cat', array( 'hide_empty' => false, 'fields' => 'ids', 'parent' => 0 ) );
		
		$term_names      = array();
		foreach ( $term_ids as $term_id ) {
			$term = get_term_by('id', $term_id, 'product_cat');
			$term_names[ $term->name ] = $term->name;
		}
		
		$this->settings = array(
			'product_category' => array(
				'type'    => 'select',
				'std'     => '',
				'label'   => __( 'Product Category', 'ntkdesign' ),
				'options' => $term_names,
			),
		);
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 * @param array $args     Widget arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		$product_category = isset( $instance['product_category'] ) ? $instance['product_category'] : $this->settings['attribute']['std'];

		if ( ! empty( $product_category )) {
			$instance['title'] = $product_category;

			$term = get_term_by( 'name', $product_category, 'product_cat' );

			$list_args          = array(
				'show_count'   => true,
				'taxonomy'     => 'product_cat',
				'hide_empty'   => false,
				'orderby'      => 'title',
				'parent'       => $term->term_id,
			);

			$this->widget_start( $args, $instance );

			$list_args['title_li']                   = '';
			$list_args['pad_counts']                 = 1;
			$list_args['show_option_none']           = __( 'No ' . $term->slug .  ' exist.', 'ntkdesign' );

			echo '<ul class="product-categories">';

			wp_list_categories( $list_args );

			echo '</ul>';

			$this->widget_end( $args );
		}

	}
}
