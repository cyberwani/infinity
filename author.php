<?php
/**
 * Infinity Theme: author template
 *
 * @author Bowe Frankema <bowromir@gmail.com>
 * @link http://bp-tricks.com/
 * @copyright Copyright (C) 2010 Bowe Frankema
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package infinity
 * @subpackage templates
 * @since 1.0
 */

	infinity_get_header();
?>
	<div id="content">
		<?php
			do_action( 'open_content' );
			do_action( 'open_author' );
		?>
		<div class="page" id="blog-author">
			<?php
				infinity_get_template_part( 'introduction-boxes' );
				infinity_get_template_part( 'loop', 'author' );
			?>
		</div>
		<?php
			do_action( 'close_author' );
			do_action( 'close_content' );
		?>
	</div>
<?php
	infinity_get_sidebar();
	infinity_get_footer();
?>
