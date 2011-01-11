<?php
/**
 * PIE API options uploader class file
 *
 * @author Marshall Sorenson <marshall.sorenson@gmail.com>
 * @link http://marshallsorenson.com/
 * @copyright Copyright (C) 2010 Marshall Sorenson
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package pie
 * @subpackage options
 * @since 1.0
 */

Pie_Easy_Loader::load('ajax');

/**
 * Make an uploaded file option easy
 */
class Pie_Easy_Options_Uploader
{
	/**
	 * The action on which to localize the script
	 *
	 * @var string
	 */
	private $script_action;

	/**
	 * Constructor
	 *
	 * @param string $script_action The action on which to localize the script
	 */
	public function __construct( $script_action = null )
	{
		if ( $script_action ) {
			$this->script_action = $script_action;
		}
	}
	
	/**
	 * Setup necessary scripts and actions
	 */
	public function init()
	{
		// enqueue flash uploader scripts
		wp_enqueue_script('swfupload-all');

		// enqueue uploader plugin and wrapper
		Pie_Easy_Loader::enqueue_script( 'jquery.swfupload', array( 'jquery' ) );
		Pie_Easy_Loader::enqueue_script( 'uploader', array( 'jquery' ) );

		// enqueue image editor scripts and style
		wp_enqueue_script( 'wp-ajax-response' );
		wp_enqueue_script('image-edit');
		wp_enqueue_style('imgareaselect');

		// enque thickbox
		add_thickbox();

		// localize the upload wrapper
		$this->localize_script();
	}

	/**
	 * Initialize ajax actions
	 */
	public function init_ajax()
	{
		add_action( 'wp_ajax_pie_easy_options_uploader_media_url', array( $this, 'ajax_media_url' ) );
		add_action( 'wp_ajax_pie_easy_options_uploader_image_edit', array( $this, 'ajax_image_edit' ) );
	}

	/**
	 * Localize the flash uploader class wrapper
	 */
	private function localize_script()
	{
		Pie_Easy_Loader::localize_script(
			'uploader',
			'pieEasyFlashUploaderL10n',
			array(
				'ajax_url' => get_site_url( 1, 'wp-admin/admin-ajax.php'),
				'flash_url' => includes_url('js/swfupload/swfupload.swf'),
				'upload_url' => esc_attr( site_url( 'wp-admin/async-upload.php' ) ),
					'pp_auth_cookie' => (is_ssl() ? $_COOKIE[SECURE_AUTH_COOKIE] : $_COOKIE[AUTH_COOKIE]),
					'pp_logged_in_cookie' => $_COOKIE[LOGGED_IN_COOKIE],
					'pp_wpnonce' => wp_create_nonce( 'media-form' ),
				'file_size_limit' => 1024 * 1024,
				'button_image_url' => includes_url('images/upload.png?ver=20100531')
			)
		);
	}

	/**
	 * Render a flash uploader for the given option
	 *
	 * @param Pie_Easy_Options_Option $option
	 * @param Pie_Easy_Options_Option_Renderer $renderer
	 */
	public function render( Pie_Easy_Options_Option $option, Pie_Easy_Options_Option_Renderer $renderer )
	{
		$edit_url = sprintf( 'media.php?attachment_id=%d&action=edit', $option->get() );
		$attach_url = $option->get_image_url('full'); ?>
		<div class="pie-easy-options-fu">
			<fieldset class="pie-easy-options-fu-img">
				<legend><?php _e( 'Current Image' ) ?></legend>
				<p><img src="<?php print esc_attr( $attach_url ) ?>" alt="" /></p>
				<div>
					<a class="thickbox" href="<?php print esc_attr( $attach_url ) ?>">Zoom</a>
					<a>Edit</a>
					<a>Trash</a>
				</div>
			</fieldset>
			<fieldset class="pie-easy-options-fu-stat">
				<legend><?php _e( 'Upload Status' ) ?></legend>
				<textarea></textarea><div><p></p></div>
			</fieldset>
			<div class="pie-easy-options-fu-btn">
				<input type="button" /><?php
				$renderer->render_input( 'hidden' ); ?>
			</div>	
		</div><?php
	}

	/**
	 * Get the url for a media attachment
	 */
	public function ajax_media_url()
	{
		if ( isset( $_POST['attachment_id'] ) && is_numeric( $_POST['attachment_id'] ) ) {
			// determine size to retrieve
			$size = ( isset( $_POST['attachment_size'] ) ) ? $_POST['attachment_size'] : 'full';
			// try to get the attachment info
			$src = wp_get_attachment_image_src( $_POST['attachment_id'], $size );
			// check it out
			if ( is_array($src) ) {
				Pie_Easy_Ajax::response( 1, $src[0], $src[1], $src[2] );
			} else {
				Pie_Easy_Ajax::response( 0, 'Failed to lookup attachment URL.' );
			}
		} else {
			Pie_Easy_Ajax::response( 0, 'No attachment ID received.' );
		}
	}

	/**
	 * Print the WP image edit form via ajax
	 */
	public function ajax_image_edit()
	{
		if ( isset( $_POST['attachment_id'] ) && is_numeric( $_POST['attachment_id'] ) ) {
			// load api file
			require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'image-edit.php'; ?>
			<div class="image-editor" id="image-editor-<?php echo $_POST['attachment_id'] ?>"><?php
			wp_image_editor( $_POST['attachment_id'] ); ?>
			</div> <?php
			die();
		}
	}
}

?>
