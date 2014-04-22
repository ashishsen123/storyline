<?php
/**
  * Template Name: place template page
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package ThemeGrill
 * @subpackage Radiate
 * @since Radiate 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
	<div class="place-container1">
		<div class="place-widget1">
			<?php dynamic_sidebar('place-widget1');
			?>
		</div>
		<div class="place-widget2">
			<?php dynamic_sidebar('place-widget2');
			?>
		</div>
		<div class="place-widget3">
			<?php dynamic_sidebar('place-widget3');
			?>
		</div>
	
	
		<div class="place-widget4">
			<?php dynamic_sidebar('place-widget4');
			?>
		</div>
		<div class="place-widget5">
			<?php dynamic_sidebar('place-widget5');
			?>
		</div>
		<div class="place-widget6">
			<?php dynamic_sidebar('place-widget6');
			?>
		</div>
	
	</div>



<?php get_footer(); ?>