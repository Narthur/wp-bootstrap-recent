<?php

/**
 * The plugin file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/Narthur/wp-bootstrap-recent
 * @since             1.0.0
 * @package           wp-bootstrap-recent
 *
 * @wordpress-plugin
 * Plugin Name:       Responsive Bootstrap Recent Posts Slider
 * Plugin URI:        https://github.com/Narthur/wp-bootstrap-recent
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Nathan Arthur
 * Author URI:        http://NathanArthur.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-bootstrap-recent
 */

// If this file is called directly, abort.
namespace {

	if ( ! defined( 'WPINC' ) ) {
		die;
	}

}

namespace bootstrap_slider_space {

	function activate() {
		// activate
	}

	function deactivate() {
		// deactivate
	}

	register_activation_hook( __FILE__, 'bootstrap_slider_space\\activate' );
	register_deactivation_hook( __FILE__, 'bootstrap_slider_space\\deactivate' );

	function enqueue_assets() {
		enqueue_bootstrap();
		enqueue_unslider();
		enqueue_bootstrap_slider();
	}

	function enqueue_bootstrap_slider() {
		wp_enqueue_script(
			'bootstrap-slider',
			plugins_url( 'main.js', __FILE__ ),
			array( 'jquery', 'unslider' )
		);

		wp_enqueue_style(
			'bootstrap-slider',
			plugins_url( 'style.css', __FILE__ )
		);
	}

	function enqueue_unslider() {
		wp_enqueue_style(
			'unslider',
			plugins_url( 'includes/unslider/dist/css/unslider.css', __FILE__ )
		);

		wp_enqueue_script(
			'unslider',
			plugins_url( 'includes/unslider/src/js/unslider.js', __FILE__ ),
			array( 'jquery' )
		);
	}

	function enqueue_bootstrap() {
		wp_enqueue_style(
			'bootstrap',
			plugins_url( 'includes/bootstrap-3.3.6-dist/css/bootstrap.min.css', __FILE__ )
		);

		wp_enqueue_script(
			'bootstrap',
			plugins_url( 'includes/bootstrap-3.3.6-dist/js/bootstrap.min.js', __FILE__ ),
			array( 'jquery' )
		);
	}

	add_action( 'wp_enqueue_scripts', 'bootstrap_slider_space\\enqueue_assets' );

	function slider( $atts ) {
		$a = shortcode_atts( array(
			'quantity' => 3
		), $atts );

		$args = array(
			'numberposts'      => $a['quantity'],
			'offset'           => 0,
			'category'         => 0,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_status'      => 'draft, publish, future, pending, private',
			'suppress_filters' => true
		);

		$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
		$slides       = '';

		foreach ( $recent_posts as $p ) {
			$url          = get_permalink( $p );
			$thumbnailDiv = make_thumbnail_div( $p, $url );
			$bodyDiv      = make_body_div( $p, $url );
			$slide        = '<li><div class="media">' . $thumbnailDiv . $bodyDiv . '</div></li>';

			$slides .= $slide;
		}

		return "<div class='bootstrap-slider'><ul>$slides</ul></div>";
	}

	function make_body_div( $p, $url ) {
		$title   = $p['post_title'];
		$excerpt = get_excerpt_by_id( $p['ID'] );
		$h4      = "<h4 class='media-heading'><a href='$url'>$title</a></h4>";
		$text    = "<p>$excerpt</p>";
		$icon    = '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
		$button  = "<a href='$url' class='btn btn-default btn-sm'>Read More $icon</a>";

		return "<div class='media-body'>{$h4}{$text}{$button}</div>";
	}

	function make_thumbnail_div( $p, $url ) {
		$image = get_the_post_thumbnail( get_post( $p['ID'] ), 'thumbnail', array(
			'class' => 'media-object'
		) );

		return ( $image ) ? "<div class='media-left'><a href='$url' class='thumbnail'>$image</a></div>" : '';
	}

	function get_excerpt_by_id( $post_id ) {
		$the_post       = get_post( $post_id ); //Gets post ID
		$the_excerpt    = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
		$excerpt_length = 35; //Sets excerpt length by word count
		$the_excerpt    = strip_tags( strip_shortcodes( $the_excerpt ) ); //Strips tags and images
		$words          = explode( ' ', $the_excerpt, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) :
			array_pop( $words );
			array_push( $words, '…' );
			$the_excerpt = implode( ' ', $words );
		endif;
		$the_excerpt = '<p>' . $the_excerpt . '</p>';

		return $the_excerpt;
	}

	add_shortcode( 'bootstrap_slider', 'bootstrap_slider_space\\slider' );

}
