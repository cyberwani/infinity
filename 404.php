<?php
/**
 * Infinity Theme: 404 template
 *
 * This template is a fork of the same template from
 * the Twenty Ten theme which ships with WordPress.
 *
 * @package infinity
 * @subpackage templates
 * @since 1.0
 */

infinity_get_header(); ?>

	<div id="container">
		<div id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Not Found', infinity_text_domain ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', infinity_text_domain ); ?></p>
					<?php infinity_get_search_form(); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #container -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php infinity_get_footer(); ?>