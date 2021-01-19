<?php
/**
 * Register our widgetized areas
 */
function elverfolk_widget_init() {
    register_sidebar(array(
        'name'          =>  'Social Link Footer Area',
        'id'            =>  'socialarea',
        'before_widget' =>  '<div class="social-media">',
        'after_widget'  =>  '</div>',
    ));
    register_sidebar(array(
        'name'          =>  'Contact Footer Area',
        'id'            =>  'contactarea',
        'before_widget' =>  '<div class="contact-area">',
        'after_widget'  =>  '</div>',
    ));
    register_sidebar(array(
        'name'          =>  'Frontpage Area',
        'id'            =>  'frontpagearea',
        'before_widget' =>  '<div class="frontpage-area">',
        'after_widget'  =>  '</div>',
    ));
}
add_action('widgets_init', 'elverfolk_widget_init');

/**
 * Create our custom widget
 */

// The widget class
class My_Custom_Widget extends WP_Widget {

	// Main constructor
	public function __construct() {
        /* ... */
        parent::__construct(
            'my_custom_widget',
            __( 'Elverfolk Social Media Widget', 'text_domain' ),
            array(
                'customize_selective_refresh' => true,
                'description'                 => "Her kan du tilføje sociale medier til dit site."
            )
        );
	}

	// The widget form (for the backend )
	public function form( $instance ) {	
        /* ... */
        // Set widget defaults
        $defaults = array(
            'title'    => '',
            'checkbox_fa'     => '',
            'text_fa' => '',
            'checkbox_inst'     => '',
            'text_inst' => '',
            'checkbox_twit'     => '',
            'text_twit' => '',
        );
        
        // Parse current settings with defaults
        extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

        <?php // Widget Title ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <?php // Text Field Facebook ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text_fa' ) ); ?>"><?php _e( 'Facebook Link:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_fa' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_fa' ) ); ?>" type="text" value="<?php echo esc_attr( $text_fa ); ?>" />
        </p>

        <?php // Checkbox Facebook ?>
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'checkbox_fa' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox_fa' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox_fa ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'checkbox_fa' ) ); ?>"><?php _e( 'Vis Facebook link', 'text_domain' ); ?></label>
        </p>

        <?php // Text Field Instagram ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text_inst' ) ); ?>"><?php _e( 'Instagram Link:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_inst' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_inst' ) ); ?>" type="text" value="<?php echo esc_attr( $text_inst ); ?>" />
        </p>

        <?php // Checkbox Instagram ?>
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'checkbox_inst' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox_inst' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox_inst ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'checkbox_inst' ) ); ?>"><?php _e( 'Vis Instagram link', 'text_domain' ); ?></label>
        </p>

        <?php // Text Field Twitter ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text_twit' ) ); ?>"><?php _e( 'Twitter Link:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_twit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_twit' ) ); ?>" type="text" value="<?php echo esc_attr( $text_twit ); ?>" />
        </p>

        <?php // Checkbox Twitter ?>
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'checkbox_twit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox_twit' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox_twit ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'checkbox_twit' ) ); ?>"><?php _e( 'Vis Twitter link', 'text_domain' ); ?></label>
        </p>

    <?php 
	}

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
        /* ... */
        $instance = $old_instance;
        $instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
        $instance['text_fa']     = isset( $new_instance['text_fa'] ) ? wp_strip_all_tags( $new_instance['text_fa'] ) : '';
        $instance['checkbox_fa'] = isset( $new_instance['checkbox_fa'] ) ? 1 : false;
        $instance['text_inst']     = isset( $new_instance['text_inst'] ) ? wp_strip_all_tags( $new_instance['text_inst'] ) : '';
        $instance['checkbox_inst'] = isset( $new_instance['checkbox_inst'] ) ? 1 : false;
        $instance['text_twit']     = isset( $new_instance['text_twit'] ) ? wp_strip_all_tags( $new_instance['text_twit'] ) : '';
        $instance['checkbox_twit'] = isset( $new_instance['checkbox_twit'] ) ? 1 : false;
        return $instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {
        /* ... */
        extract( $args );

        // Check the widget options
        $title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
        $checkbox_fa = ! empty( $instance['checkbox_fa'] ) ? $instance['checkbox_fa'] : false;
        $text_fa     = isset( $instance['text_fa'] ) ? $instance['text_fa'] : '';
        $checkbox_inst = ! empty( $instance['checkbox_inst'] ) ? $instance['checkbox_inst'] : false;
        $text_inst     = isset( $instance['text_inst'] ) ? $instance['text_inst'] : '';
        $checkbox_twit = ! empty( $instance['checkbox_twit'] ) ? $instance['checkbox_twit'] : false;
        $text_twit     = isset( $instance['text_twit'] ) ? $instance['text_twit'] : '';

        // WordPress core before_widget hook (always include )
        echo $before_widget;

        // Display the widget
        echo '<div class="site-social">';

        // Display widget title if defined
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        // Display something if checkbox is true
        if ( $checkbox_fa ) {
            echo '<a href="' . $text_fa . '" class="fa fa-facebook" target="_blank"></a>';
        }
        if ( $checkbox_inst ) {
            echo '<a href="' . $text_inst . '" class="fa fa-instagram" target="_blank"></a>';
        }
        if ( $checkbox_twit ) {
            echo '<a href="' . $text_twit . '" class="fa fa-twitter" target="_blank"></a>';
        }

        echo '</div>';

        // WordPress core after_widget hook (always include )
        echo $after_widget;
	}

}

// Register the widget
function my_register_custom_widget() {
	register_widget( 'My_Custom_Widget' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );