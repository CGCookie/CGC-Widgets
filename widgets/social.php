<?php

/*-----------------------------------------------------------------------------------*/
/* CGC Social Icons Widget
/*-----------------------------------------------------------------------------------*/

add_action('widgets_init','load_cgc_social_widget');

function load_cgc_social_widget() {
	register_widget('cgc_social_widget');
}

class cgc_social_widget extends WP_Widget {
	function cgc_social_widget() {
	    $widget_ops = array( 'classname' => 'icons', 'description' => __('Show social icon links', 'cgc') );
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'cgc-social-widget' );
		$this->WP_Widget('cgc-social-widget', __('CGC: Social Icons Widget', 'cgc'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
 		extract($args);

		$icons_title = apply_filters('widget_title', $instance['icons_title']);
		$twitter_icon = $instance['twitter_icon'];
		$facebook_icon = $instance['facebook_icon'];
		$youtube_icon = $instance['youtube_icon'];
		$pinterest_icon = $instance['pinterest_icon'];
		$feed_icon = $instance['feed_icon'];

		echo $before_widget; ?>
		
		
		<div class="icons-widget">
			<?php if ( $icons_title ) echo $before_title . $icons_title . $after_title; ?>
					
			<div id="icons">
				<?php if ( $twitter_icon ) { ?>								
					<a href="<?php echo $instance['twitter_icon']; ?>" class="twitter-icon" title="Twitter">
						<i class="icon-twitter"></i>
					</a>
				<?php } ?>
				
				<?php if ( $facebook_icon ) { ?>								
					<a href="<?php echo $instance['facebook_icon']; ?>" class="facebook-icon" title="Facebook">
						<i class="icon-facebook-sign"></i>
					</a>
				<?php } ?>
				
				<?php if ( $youtube_icon ) { ?>								
					<a href="<?php echo $instance['youtube_icon']; ?>" class="youtube-icon" title="YouTube">
						<span class="icon-stack">
							<i class="icon-sign-blank icon-stack-base"></i>
							<i class="icon-play icon-dark"></i>
						</span>
					</a>
				<?php } ?>

				<?php if ( $feed_icon ) { ?>								
					<a href="<?php echo $instance['feed_icon']; ?>" class="feed-icon" title="RSS Feed">
						<i class="icon-rss"></i>
					</a>
				<?php } ?>
				
				<?php if ( $pinterest_icon ) { ?>								
					<a href="<?php echo $instance['pinterest_icon']; ?>" class="pinterest-icon" title="Pinterest">
						<i class="icon-pinterest"></i>
					</a>
				<?php } ?>		
			</div>		
		</div>			
			
			<?php
		echo $after_widget;	
  }

	// Updating the widget
	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['icons_title'] = strip_tags( $new_instance['icons_title']);
		$instance['twitter_icon'] = strip_tags( $new_instance['twitter_icon']);
		$instance['facebook_icon'] = strip_tags( $new_instance['facebook_icon']);
		$instance['feed_icon'] = strip_tags( $new_instance['feed_icon']);
		$instance['youtube_icon'] = strip_tags( $new_instance['youtube_icon']);
		$instance['pinterest_icon'] = strip_tags( $new_instance['pinterest_icon']);

		return $instance;
	}

	function form( $instance ) {
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','cgc'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('icons_title'); ?>" name="<?php echo $this->get_field_name('icons_title'); ?>" value="<?php if(isset($instance['icons_title'])) echo $instance['icons_title']; ?>" />
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id('twitter_icon'); ?>"><?php _e('Twitter Link','cgc'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_icon'); ?>" name="<?php echo $this->get_field_name('twitter_icon'); ?>" value="<?php if(isset($instance['twitter_icon'])) echo $instance['twitter_icon']; ?>" />
	 	</p>
	 	
	 	<p>
			<label for="<?php echo $this->get_field_id('facebook_icon'); ?>"><?php _e('Facebook Link','cgc'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook_icon'); ?>" name="<?php echo $this->get_field_name('facebook_icon'); ?>" value="<?php if(isset($instance['facebook_icon'])) echo $instance['facebook_icon']; ?>" />
	 	</p>
	
	 	<p>
			<label for="<?php echo $this->get_field_id('feed_icon'); ?>"><?php _e('RSS Feed Link','cgc'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('feed_icon'); ?>" name="<?php echo $this->get_field_name('feed_icon'); ?>" value="<?php if(isset($instance['feed_icon'])) echo $instance['feed_icon']; ?>" />
	 	</p>
	 	
	 	<p>
			<label for="<?php echo $this->get_field_id('youtube_icon'); ?>"><?php _e('YouTube Link','cgc'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('youtube_icon'); ?>" name="<?php echo $this->get_field_name('youtube_icon'); ?>" value="<?php if(isset($instance['youtube_icon'])) echo $instance['youtube_icon']; ?>" />
	 	</p>
	 	
	 	<p>
			<label for="<?php echo $this->get_field_id('pinterest_icon'); ?>"><?php _e('Pinterest Link','cgc'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('pinterest_icon'); ?>" name="<?php echo $this->get_field_name('pinterest_icon'); ?>" value="<?php if(isset($instance['pinterest_icon'])) echo $instance['pinterest_icon']; ?>" />
	 	</p>
		
		<?php
	}
}

?>
