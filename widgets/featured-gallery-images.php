<?php
/*-----------------------------------------------------------------------------------*/
/* CGC Featured Gallery Images.php
/*-----------------------------------------------------------------------------------*/

add_action('widgets_init','load_cgc_featured_gallery_images_widget');

function load_cgc_featured_gallery_images_widget() {
	register_widget('cgc_featured_gallery_images_widget');
}

class cgc_featured_gallery_images_widget extends WP_Widget {
	function cgc_featured_gallery_images_widget() {
	  $widget_ops = array( 'classname' => 'icons', 'description' => __('Show recently featured gallery images', 'cgc') );
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'cgc-featured-gallery-images-widget' );
		$this->WP_Widget('cgc-featured-gallery-images-widget', __('CGC: Featured Gallery Images Widget', 'cgc'), $widget_ops, $control_ops);
	}
	function widget( $args, $instance ) {
 		extract($args);

		$featured_images_title = apply_filters('widget_title', $instance['featured_images_title']);
		$featured_image_count = $instance['featured_image_count'];

		echo $before_widget;

		if ( $featured_images_title ) echo $before_title . $featured_images_title . $after_title; 

		if ( $featured_image_count == '' ) $featured_image_count = 10;
		if( function_exists( 'pig_sidebar_featured_images_widget' ) ) {
			pig_sidebar_featured_images_widget($featured_image_count);	
		}		
			
		echo $after_widget;	
  }
	// Updating the widget
	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['featured_images_title'] = strip_tags( $new_instance['featured_images_title']);
		$instance['featured_image_count'] = strip_tags( $new_instance['featured_image_count']);

		return $instance;
	}  
	function form( $instance ) {
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','cgc'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('featured_images_title'); ?>" name="<?php echo $this->get_field_name('featured_images_title'); ?>" value="<?php if(isset($instance['featured_images_title'])) echo $instance['featured_images_title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('How Many?:','cgc'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('featured_image_count'); ?>" name="<?php echo $this->get_field_name('featured_image_count'); ?>" value="<?php if(isset($instance['featured_image_count'])) echo $instance['featured_image_count']; ?>" />
		</p>						
		<?php
	}  	
}
