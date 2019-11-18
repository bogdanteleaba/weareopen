<?php
/*
Plugin Name: We're Open
Plugin URI: http://www.bogdanteleaba.com
Description: This plugin adds a custom widget.
Author: Bogdan Teleaba
Author URI: http://www.bogdanteleaba.com
*/

// The widget class

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class My_Custom_Widget extends WP_Widget {
	// Main constructor
	public function __construct() {
		parent::__construct(
			'my_custom_widget',
			__( 'We are open!', 'text_domain' ),
			array(
				'customize_selective_refresh' => true,
			)
		);
	}


	

	// The widget form (for the backend )
	public function form( $instance ) {
		// Set widget defaults
		$defaults = array(
			'location'    => '',
			'adress'     => '',
			'phone'     => '',
		);
		
		// Parse current settings with defaults
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

		<h2> Contact Information </h2>
		<?php // Location ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>"><?php _e( 'Location', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'location' ) ); ?>" type="text" value="<?php echo esc_attr( $location ); ?>" />
		</p>

		<?php // Adress Field ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'adress' ) ); ?>"><?php _e( 'Adress:', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'adress' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'adress' ) ); ?>" type="text" value="<?php echo esc_attr( $adress ); ?>" />
		</p>

		<?php // Phone Field ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php _e( 'Phone', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="number" value="<?php echo esc_attr( $phone ); ?>" />
		</p>

		<h2> Opening Hours </h2>

		<?php // Weekends ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'weekdays' ) ); ?>"><?php _e( 'Weekdays', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'weekdays' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'weekdays' ) ); ?>" type="text" value="<?php echo esc_attr( $weekdays ); ?>" />
		</p>

		<?php // Weekends ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'weekends' ) ); ?>"><?php _e( 'Weekends', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'weekends' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'weekends' ) ); ?>" type="text" value="<?php echo esc_attr( $weekends ); ?>" />
		</p>


	<?php }





	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['location']    = isset( $new_instance['location'] ) ? wp_strip_all_tags( $new_instance['location'] ) : '';
		$instance['adress']     = isset( $new_instance['adress'] ) ? wp_strip_all_tags( $new_instance['adress'] ) : '';
		$instance['phone']     = isset( $new_instance['phone'] ) ? wp_strip_all_tags( $new_instance['phone'] ) : '';
		$instance['weekdays']     = isset( $new_instance['weekdays'] ) ? wp_strip_all_tags( $new_instance['weekdays'] ) : '';
		$instance['weekends']     = isset( $new_instance['weekends'] ) ? wp_strip_all_tags( $new_instance['weekends'] ) : '';
		return $instance;
	}




	// Display the widget
	public function widget( $args, $instance ) {
		extract( $args );
		// Check the widget options
		$location    = isset( $instance['location'] ) ? $instance['location'] : '';
		$adress     = isset( $instance['adress'] ) ? $instance['adress'] : '';
		$phone     = isset( $instance['phone'] ) ? $instance['phone'] : '';
		$weekdays     = isset( $instance['weekdays'] ) ? $instance['weekdays'] : '';
		$weekends     = isset( $instance['weekends'] ) ? $instance['weekends'] : '';

		// WordPress core before_widget hook (always include )
		echo $before_widget;
		// Display the widget
		echo '<div class="edit" style="line-height:0px;">';
		echo '<div class="widget-text wp_widget_plugin_box">';
			// Display location if defined
			if ( $location ) {

				echo '<h3>' . Location . '</h3>'; echo '<p>' . $location . '</p>';
			}
			// Display text field
			if ( $adress ) {
				
				echo '<h3>' . Adress . '</h3>'; echo '<p>' . $adress . '</p>';
				
			}

			// Display text field
			if ( $phone ) {
				echo '<h3>' . Phone . '</h3>'; echo '<p>' . $phone . '</p>';
			}

			// Weekdays
			if ( $weekdays ) {
				
				echo '<h3>' . Weekdays . '</h3>'; echo '<p>' . $weekdays . '</p>';
			}

			// Weekends
			if ( $weekends ) {
				
				echo '<h3>' . Weekends . '</h3>'; echo '<p>' . $weekends . '</p>';
			}
			
		echo '</div>';
		echo '</div>';
		// WordPress core after_widget hook (always include )
		echo $after_widget;
	}
	//enqueues scripts and styled on the front end
	public function enqueue_public_scripts_and_styles(){
		wp_enqueue_style('wp_location_public_styles', plugin_dir_url(__FILE__). '/css/wp_location_public_styles.css');
		
	}
}
// Register the widget
function my_register_custom_widget() {
	register_widget( 'My_Custom_Widget' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );

