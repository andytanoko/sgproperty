<?php
 

add_action( 'widgets_init', 'register_advancedsearch_widget' );


function register_advancedsearch_widget() {
	register_widget( 'AdvancedSearch_Widget' );
}

class AdvancedSearch_Widget extends WP_Widget {

	function AdvancedSearch_Widget() {
		$widget_ops = array( 'classname' => 'advancedsearch', 'description' => __('A widget that displays the Advanced Search ', 'advancedsearch') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'advancedsearch-widget' );
		
		$this->WP_Widget( 'advancedsearch-widget', __('Advanced Search Widget', 'advancedsearch'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
 
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		property_advanced_search_form("");  
 
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		 

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Advanced Search', 'advancedsearch'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'advancedsearch'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
 		

	<?php
	}
}

?>