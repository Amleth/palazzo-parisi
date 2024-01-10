<?php

if ( class_exists( 'MuseaCoreClassWidget' ) ) {
	class MuseaElatedClassSearchPostType extends MuseaCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'eltdf_search_post_type',
				esc_html__( 'Musea Search Post Type', 'musea' ),
				array( 'description' => esc_html__( 'Select post type that you want to be searched for', 'musea' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$post_types = apply_filters( 'musea_elated_filter_search_post_type_widget_params_post_type', array( 'post' => esc_html__( 'Post', 'musea' ) ) );
			
			$this->params = array(
				array(
					'type'        => 'dropdown',
					'name'        => 'post_type',
					'title'       => esc_html__( 'Post Type', 'musea' ),
					'description' => esc_html__( 'Choose post type that you want to be searched for', 'musea' ),
					'options'     => $post_types
				)
			);
		}
		
		public function widget( $args, $instance ) {
			$search_type_class = 'eltdf-search-post-type';
			$post_type         = $instance['post_type'];
			?>
			<div class="widget eltdf-search-post-type-widget">
				<div data-post-type="<?php echo esc_attr( $post_type ); ?>" <?php musea_elated_class_attribute( $search_type_class ); ?>>
					<input class="eltdf-post-type-search-field" value="" placeholder="<?php esc_attr_e( 'Search here', 'musea' ) ?>">
					<i class="eltdf-search-icon eltdf-icon-font-elegant icon_search" aria-hidden="true"></i>
					<i class="eltdf-search-loading fa fa-spinner fa-spin eltdf-hidden" aria-hidden="true"></i>
					<?php wp_nonce_field( 'eltdf_search_post_types_nonce', 'eltdf_search_post_types_nonce' ); ?>
				</div>
				<div class="eltdf-post-type-search-results"></div>
			</div>
		<?php }
	}
}