<?php
/**
 * Template Name: Front Page Template
 *
 * Description: Displays a full-width front page. The front page template provides an optional
 * banner section that allows for highlighting a key message. It can contain up to 2 widget areas,
 * in one or two columns. These widget areas are dynamic so if only one widget is used, it will be
 * displayed in one column. If two are used, then they will be displayed over 2 columns.
 * There are also four front page only widgets displayed just beneath the main content. Like the
 * banner widgets, they will be displayed in anywhere from one to four columns, depending on
 * how many widgets are active.
 *
 * @package Storyline
 * @since Storyline 1.0
 */

get_header(); ?>

	<div class="banner-container">
		<div class="banner">
			<?php dynamic_sidebar('frontpage-banner');
			?>
		</div>
	</div>
	<div class="home-container">
		<div class="home-widget1">
			<?php dynamic_sidebar('home-widget1');
			?>
		</div>
		<div class="home-widget2">
			<?php dynamic_sidebar('home-widget2');
			?>
		</div>
		<div class="home-widget3">
			<?php dynamic_sidebar('home-widget3');
			?>
		</div>
	</div>
	<?php

            // Display featured posts on front page
            get_template_part('content', 'frontposts');
            ?>
	
<?php get_footer(); ?>
