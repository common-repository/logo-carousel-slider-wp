<?php
/*
 Plugin Name: Logo Carousel Slider WP
 Plugin URI:  https://github.com/logoslider/Logo-Carousel-Slider-WP
 Description: A simple plugin which can display Carousel Logo Slider by insert logoslider shortcode
 Version: 1.0.1
 Author: logoslider
 Author URI: https://github.com/logoslider/
 Text Domain: lcsw-logo-slider
 License: GPLv3 or later
 */

function lcsw_show_logos_slider($sliderstring)
{
	if (empty($sliderstring))
	{
		return;
	}

	$outputlogs = '';

	$saved_logos_images_url = explode ( ",", trim ( $sliderstring ) );

	if ((is_array ( $saved_logos_images_url )) && (count ( $saved_logos_images_url ) > 0))
	{
		foreach ( $saved_logos_images_url as $saved_logos_images_url_single )
		{
				
			$saved_logos_images_url_single = trim ( $saved_logos_images_url_single );
			if (empty($saved_logos_images_url_single))
			{
				continue;
			}
			$outputlogs .= '<div class="owl-item">';
			$outputlogs .= $saved_logos_images_url_single;
			$outputlogs .= '</div>';
				
		}
	}

	$outline = '';

	$outline .= '
    <script type="text/javascript">
    jQuery(document).ready(function() {
		jQuery(".owl-carousel").owlCarousel({
	        margin: 8,
			items: 24,
			lazyLoad: true,
		    responsive:{
		        0:{
		            items: 1,
		        },
		        410:{
		            items: 2,
		        },
		        600:{
		            items: 3,
		        },
		        900:{
		            items: 4,
		        }
		    },
			nav: true,
			navText: ["<",">"],
			autoplay: false,
			smartSpeed: 900,
			dots: false,
			autoplayHoverPause: true,

		});

    });
    </script>';

	$outline .= '<div class="owl-div-box-wrap">';
	$outline .= '<div class="owl-carousel owl-theme">';

	$outline .= $outputlogs;
	$outline .= '</div>';


	$outline .= '</div>';
	$outline .= '</div>';


	return $outline;

}


function lcsw_logosider_shortcode($atts)
{
	if ((isset($atts)) && (is_array($atts)) && (count($atts) >0))
	{
		if (isset($atts['logourl']))
		{
			$sliderstring = $atts['logourl'];
			echo lcsw_show_logos_slider($sliderstring);
		}
		
	}
}

add_shortcode( 'logoslider', 'lcsw_logosider_shortcode' );

function lcsw_logo_enqueue_styles() {
	wp_enqueue_style( 'logo-owl-carousel-css', plugin_dir_url( __FILE__ ) . 'assets/owlcarousel/assets/owl.carousel.css', array(), null );
	wp_enqueue_style( 'logo-owl-carousel-default-css', plugin_dir_url( __FILE__ ) . 'assets/owlcarousel/assets/owl.theme.default.css' );

	wp_enqueue_style( 'logo-owl-carousel-customized-css', plugin_dir_url( __FILE__ ) . 'assets/owl.theme.customized.css' );
	wp_enqueue_script( 'logo-owl-carousel-js', plugin_dir_url( __FILE__ ) . 'assets/owlcarousel/owl.carousel.min.js', array( 'jquery' ), null, true );

}
add_action( 'wp_enqueue_scripts', 'lcsw_logo_enqueue_styles' );

