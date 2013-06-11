<?php
/*-----------------------------------------------------------------------------------*/
/* CGC Follower Images
/*-----------------------------------------------------------------------------------*/

add_action('widgets_init','load_cgc_follower_images_widget');

function load_cgc_follower_images_widget() {
	register_widget('cgc_follower_images_widget');
}

class cgc_follower_images_widget extends WP_Widget {
	function cgc_follower_images_widget() {
	  $widget_ops = array( 'classname' => 'icons', 'description' => __('Show recent images from people you follow.', 'cgc') );
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'cgc-follower-images-widget' );
		$this->WP_Widget('cgc-follower-images-widget', __('CGC: Follower Images Widget', 'cgc'), $widget_ops, $control_ops);
	}
	function widget( $args, $instance ) {
 		extract($args);

		$follower_images_title = apply_filters('widget_title', $instance['follower_images_title']);
		$follow_image_count = $instance['follow_image_count'];

		echo $before_widget; 
		
		if ( $follower_images_title ) echo $before_title . $follower_images_title . $after_title; 

		if ( $follow_image_count == '' ) $follow_image_count = 8;
		if( function_exists( 'pig_show_images_from_following' ) ) {
			pig_show_images_from_following($follow_image_count);	
		}		
			
		echo $after_widget;	
  }
	// Updating the widget
	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['follower_images_title'] = strip_tags( $new_instance['follower_images_title']);
		$instance['follow_image_count'] = strip_tags( $new_instance['follow_image_count']);

		return $instance;
	}  
	function form( $instance ) {
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','cgc'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('follower_images_title'); ?>" name="<?php echo $this->get_field_name('follower_images_title'); ?>" value="<?php if(isset($instance['follower_images_title'])) echo $instance['follower_images_title']; ?>" />
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('How Many?:','cgc'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('follow_image_count'); ?>" name="<?php echo $this->get_field_name('follow_image_count'); ?>" value="<?php if(isset($instance['follow_image_count'])) echo $instance['follow_image_count']; ?>" />
		</p>					
		<?php
	}  	
}
