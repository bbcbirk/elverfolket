<?php

/*

@package Elverfolket-Theme

    ==========================
    THEME CUSTOM POST TYPES
    ========================== 
*/
add_action( 'admin_init', 'add_admin_menu_separator' );
add_action( 'admin_menu', 'set_admin_menu_separator' );

add_action('init', 'elverfolk_custom_post_type');

function elverfolk_custom_post_type (){
    //Elverfolk Gallery
    $labels_gallery = array(
        'name'                  =>  'Gallery View',
        'singular_name'         =>  'Elverfolk Gallery',
        'add_new_item'          =>  'Add New Gallery',
        'edit_item'             =>  'Edit Gallery',
        'new_item'              =>  'New Gallery',
        'view_item'             =>  'View Gallery',
        'view_items'            =>  'View Galleries',
        'search_items'          =>  'Search Galleries',
        'not_found'             =>  'No galleries found',
        'not_found_in_trash'    =>  'No galleries found in Trash',
        'all_items'             =>  'All Galleries',
        'archives'              =>  'Gallery Archives',
        'attributes'            =>  'Gallery Attributes',
        'insert_into_item'      =>  'Insert into gallery',
        'uploaded_to_this_item' =>  'Uploaded to this gallery',
        'menu_name'             =>  'Elverfolk Galleries',
        'filter_items_list'     =>  'Filter galleries list',
        'items_list_navigation' =>  'Galleries list navigation',
        'items_list'            =>  'Galleries list'
        
        
        
    );
    $args_gallery = array(
        'labels'                =>  $labels_gallery,
        'public'                =>  true,
        'show_in_menu'          =>  true,
        'menu_position'         =>  56,
        'menu_icon'             =>  'dashicons-format-gallery',
        'capability_type'       =>  'post',
        'hierarchical'          =>  false,
        'supports'               =>  array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields'
        ),
        
    );
    register_post_type('elverfolk_gallery', $args_gallery);
    flush_rewrite_rules();
    //Elverfolk Event
    $labels_event = array(
        'name'                  =>  'Event View',
        'singular_name'         =>  'Elverfolk Event',
        'add_new_item'          =>  'Add New Event',
        'edit_item'             =>  'Edit Event',
        'new_item'              =>  'New Event',
        'view_item'             =>  'View Event',
        'view_items'            =>  'View Events',
        'search_items'          =>  'Search Events',
        'not_found'             =>  'No events found',
        'not_found_in_trash'    =>  'No events found in Trash',
        'all_items'             =>  'All Events',
        'archives'              =>  'Event Archives',
        'attributes'            =>  'Event Attributes',
        'insert_into_item'      =>  'Insert into event',
        'uploaded_to_this_item' =>  'Uploaded to this event',
        'menu_name'             =>  'Elverfolk Events',
        'filter_items_list'     =>  'Filter Events list',
        'items_list_navigation' =>  'Events list navigation',
        'items_list'            =>  'Events list'
        
        
        
    );
    $args_event = array(
        'labels'                =>  $labels_event,
        'public'                =>  true,
        'show_in_menu'          =>  true,
        'menu_position'         =>  57,
        'menu_icon'             =>  'dashicons-calendar-alt',
        'capability_type'       =>  'post',
        'hierarchical'          =>  false,
        'supports'               =>  array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields'
        ),
        
    );
    register_post_type('elverfolk_event', $args_event);
    flush_rewrite_rules();
    //Elverfolk News
    $labels_event = array(
        'name'                  =>  'News View',
        'singular_name'         =>  'Elverfolk News',
        'add_new_item'          =>  'Add New News',
        'edit_item'             =>  'Edit News',
        'new_item'              =>  'New News',
        'view_item'             =>  'View News',
        'view_items'            =>  'View News',
        'search_items'          =>  'Search News',
        'not_found'             =>  'No news found',
        'not_found_in_trash'    =>  'No news found in Trash',
        'all_items'             =>  'All News',
        'archives'              =>  'News Archives',
        'attributes'            =>  'News Attributes',
        'insert_into_item'      =>  'Insert into news',
        'uploaded_to_this_item' =>  'Uploaded to this news',
        'menu_name'             =>  'Elverfolk News',
        'filter_items_list'     =>  'Filter News list',
        'items_list_navigation' =>  'News list navigation',
        'items_list'            =>  'News list'
        
        
        
    );
    $args_event = array(
        'labels'                =>  $labels_event,
        'public'                =>  true,
        'show_in_menu'          =>  true,
        'menu_position'         =>  58,
        'menu_icon'             =>  'dashicons-sticky',
        'capability_type'       =>  'post',
        'hierarchical'          =>  false,
        'supports'               =>  array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields'
        ),
        
    );
    register_post_type('elverfolk_news', $args_event);
    flush_rewrite_rules();
}
function add_admin_menu_separator( $position ) {

	global $menu;

	$menu[ $position ] = array(
		0	=>	'',
		1	=>	'read',
		2	=>	'separator' . $position,
		3	=>	'',
		4	=>	'wp-menu-separator'
	);

}
function set_admin_menu_separator() {
	do_action( 'admin_init', 55 );
} // end set_admin_menu_separator

//////////////////////////////////////////
// Settings Menu
add_action( 'admin_menu', 'register_media_selector_settings_page' );

function register_media_selector_settings_page() {
	add_submenu_page( 'options-general.php', 'Elverfolk Settings', 'Elverfolk Settings', 'manage_options', 'media-selector', 'media_selector_settings_page_callback' );
}

function media_selector_settings_page_callback() {

	// Save attachment ID
	if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_attachment_id'] ) ) :
		update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
	endif;

	wp_enqueue_media();

	?>
	<h1>Elverfolk Settings</h1>
	<form method='post'>
		<h2>
			Logo
		</h2>
		<p>
			Bliver vist i hovedmenuen. Prefereret format er 100x100 px i .png format. 
		</p>
		<i>
			note. Baggrunden er Mørk (#262626) så lyse farver er prefereret
		</i>
		<div class='image-preview-wrapper'>
			<img id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' height='100' style='background: #262626;'>
		</div>
		<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
		<input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
		<input type="submit" name="submit_image_selector" value="Save" class="button-primary">
	</form><?php

}


add_action( 'admin_footer', 'media_selector_print_scripts' );

function media_selector_print_scripts() {

	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );

	?><script type='text/javascript'>

		jQuery( document ).ready( function( $ ) {

			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

			jQuery('#upload_image_button').on('click', function( event ){

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id' ).val( attachment.id );

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

					// Finally, open the modal
					file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});

	</script><?php

}