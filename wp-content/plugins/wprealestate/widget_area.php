<?php
 

add_action( 'widgets_init', 'register_area_widget' );


function register_area_widget() {
	register_widget( 'Area_Widget' );
}

class Area_Widget extends WP_Widget {

	function Area_Widget() {
		$widget_ops = array( 'classname' => 'area', 'description' => __('A widget that displays the Area ', 'et_at_area') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'area-widget' );
		
		$this->WP_Widget( 'area-widget', __('Area Widget', 'area'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
 
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		 

//list terms in a given taxonomy
		$taxonomy = 'neighbourhood';
		$tax_terms = get_terms($taxonomy);
		echo "<ul>";
		foreach ($tax_terms as $tax_term) {
		echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
		}
		echo "</ul>";
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
		$defaults = array( 'title' => __('Area', 'area'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'area'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>


	<?php
	}
}

?>