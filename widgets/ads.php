<?php
/*-----------------------------------------------------------------------------------*/
/* CGC Follower Images
/*-----------------------------------------------------------------------------------*/

add_action('widgets_init','load_cgc_ads_widget');

function load_cgc_ads_widget() {
    register_widget('cgc_ads_widget');
}

class cgc_ads_widget extends WP_Widget {
    function cgc_ads_widget() {
      $widget_ops = array( 'classname' => 'icons', 'description' => __('Insert the embed code for an ad.', 'cgc') );
        $control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'cgc-ads-widget' );
        $this->WP_Widget('cgc-ads-widget', __('CGC: Ad', 'cgc'), $widget_ops, $control_ops);
    }
    function widget( $args, $instance ) {
        extract($args);

        $cgc_ad_title = apply_filters('widget_title', $instance['cgc_ad_title']);
        $cgc_ad_code = apply_filters( 'widget_text', empty( $instance['cgc_ad_code'] ) ? '' : $instance['cgc_ad_code'], $instance );

        echo $before_widget; 

        echo '<div class="cgc-ad">';
            if ( $cgc_ad_title ) {
                echo $before_title . $cgc_ad_title . $after_title; 
            }
            echo $cgc_ad_code; 
        echo '</div>';

        echo $after_widget; 
  }
    // Updating the widget
    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['cgc_ad_title'] = strip_tags( $new_instance['cgc_ad_title']);
        $instance['cgc_ad_code'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['cgc_ad_code']) ) );

        return $instance;
    }  
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'cgc_ad_title' => '', 'cgc_ad_code' => '' ) );
        $cgc_ad_code = esc_textarea($instance['cgc_ad_code']);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','cgc'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('cgc_ad_title'); ?>" name="<?php echo $this->get_field_name('cgc_ad_title'); ?>" value="<?php if(isset($instance['cgc_ad_title'])) echo $instance['cgc_ad_title']; ?>" />
        </p>    
        <p>
            <label for="<?php echo $this->get_field_id('cgc_ad_code'); ?>"><?php _e('Embed Code:','cgc'); ?></label> <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('cgc_ad_code'); ?>" name="<?php echo $this->get_field_name('cgc_ad_code'); ?>"><?php echo $cgc_ad_code; ?></textarea>
        </p>                    
        <?php
    }   
}
