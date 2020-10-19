<?php
/**
 * Single posts metabox
 * Handles individual post layout
 *
 * @package elfie
 */


function elfie_page_metabox_init() {
    new Elfie_Page_Metabox();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'elfie_page_metabox_init' );
    add_action( 'load-post-new.php', 'elfie_page_metabox_init' );
}

class Elfie_Page_Metabox {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
        $post_types = array( 'post' );
        if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'elfie_single_post_metabox'
				,__( 'Elfie options', 'elfie' )
				,array( $this, 'render_meta_box_content' )
				,'post'
				,'side'
				,'low'
			);
        }
	}

	public function save( $post_id ) {
	
		// Check if our nonce is set.
		if ( ! isset( $_POST['elfie_single_post_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['elfie_single_post_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'elfie_single_post_box' ) )
			return $post_id;


		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'post' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
	
		}

		// Sanitize the user input.
		$layout_choices = array( 'customizer', 'layout-default', 'layout-featuredbanner', 'layout-featuredbanner2' );

		$post_layout = elfie_sanitize_selects( $_POST['elfie_post_layout'], $layout_choices );

		// Update the meta field.
		update_post_meta( $post_id, '_elfie_post_layout', $post_layout );
	}

	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'elfie_single_post_box', 'elfie_single_post_box_nonce' );
		$post_layout = get_post_meta( $post->ID, '_elfie_post_layout', true );

	?>
	<p>
		<label for="elfie_post_layout"><?php _e( 'Post layout', 'elfie' ); ?></label>	
		<select style="max-width:200px;" name="elfie_post_layout">
			<option value="customizer" <?php selected( $post_layout, 'customizer' ); ?>><?php _e( 'Set from Customizer', 'elfie' ); ?></option>
			<option value="layout-default" <?php selected( $post_layout, 'layout-default' ); ?>><?php _e( 'Style 1 (default)', 'elfie' ); ?></option>
			<option value="layout-featuredbanner" <?php selected( $post_layout, 'layout-featuredbanner' ); ?>><?php _e( 'Style 2 (featured banner)', 'elfie' ); ?></option>
			<option value="layout-featuredbanner2" <?php selected( $post_layout, 'layout-featuredbanner2' ); ?>><?php _e( 'Style 3 (featured banner with post title)', 'elfie' ); ?></option>
		</select>
	</p>
	<?php
	}
}