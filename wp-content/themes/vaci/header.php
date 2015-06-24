<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package dazzling
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<script src="<?php echo esc_url( home_url( '/custom/jquery-slider.js' ) ); ?>"></script>
		<script>
			$(function() {		
				$("#pan_area").smoothslider("install", {
					"playlist_url":"<?php echo esc_url( home_url( '/custom/playlist.json' ) ); ?>", 
					"throbber":$("#throbber"),
				});

					$(window).scroll(function(){
						window.scroll = $(this).scrollTop();
						console.log(scroll)
					  	$('.fullBanner').css('background-position-x', scroll);	
					});

			});



		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo esc_url( home_url( '/custom/smooth_slider.css' ) ); ?>">

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<nav class="navbar navbar-default" role="navigation">
		<div id="important" style="background: #23282D; color: #fff; height: 40px; line-height: 35px; font-size: 11px; position: relative; display: block;">
			<div class="container">
			<b>1056 Budapest, Váci utca 43.</b> | OM Azonosító: <b>034889</b> | Telefonszám: <b>(872)7981</b> | Email: <a href="mailto:vaci@belvaros-lipotvaros.hu">vaci@belvaros-lipotvaros.hu</a>
			<div class="rightbox">
				<a href="oldalterkep"><i class="fa fa-sitemap"></i></a> <a href="oldalterkep"><i class="fa fa-facebook-official"></i></a> <!-- <a href="#"><i class="fa fa-search"></i> Keresés</a> -->
			</div>
			</div>
		</div>
		<div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			    <span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			  </button>
				<div id="logo"><a href="<?php echo esc_url( home_url( '/kezdolap' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img style="float: left; height: 80px; top: -6px; position: absolute;" src="<?php echo esc_url( home_url( '/custom/logo_s.png' ) ); ?>"></a>
					<span class="site-name"><a class="navbar-brand" href="<?php echo esc_url( home_url( '/kezdolap' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				</div>
			</div>
				<?php dazzling_header_menu(); ?>
		</div>
	</nav><!-- .site-navigation -->

<!-- 
	<div class="slideshowwrapper">
					<div id="overlay"></div>
					<div id="throbber"><img src="custom/throbber.gif"></div>
					<div id="pan_area"></div>
				</div> -->