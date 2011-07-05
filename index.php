<?php
/**
 * Infinity Theme: main template
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

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 infinity_get_template_part( 'loop', 'index' );
			?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php infinity_get_sidebar(); ?>
<?php infinity_get_footer(); ?>
