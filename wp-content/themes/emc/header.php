<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package EMC
 * @since 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
<html id="unsupported" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9)  ]>
<html <?php language_attributes(); ?>>
<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script>
var recaptcha_options = {"lang":"en"};
</script>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="container">

			<?php if ( get_theme_mod( 'emc_logo' ) ) : ?>
				<div class="identity">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="emc-logo" src="<?php echo get_theme_mod( 'emc_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
					<h2 class="emc-site-description"><?php bloginfo( 'description' ); ?></h2>
					
				</div>
			<?php else : ?>
				<hgroup class="identity">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="emc-site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
			<?php endif; ?>
			
			<div class="emc-utilities">
				<a class="emc-menu-button emc-button">Menu</a>
				<a class="emc-search-button emc-button">Search</a>

				<div class="emc-social">
					<a href="http://www.facebook.com/earlymath" target="_blank" title="<?php esc_attr_e( 'Find us on Facebook', 'emc' ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/facebook.png" alt="Facebook icon" /></a>
					<a href="https://www.youtube.com/user/eriksonmath/videos" target="_blank" title="<?php esc_attr_e( 'Find us on Youtube', 'emc' ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/youtube.png" alt="Youtube icon" /></a>
					<a href="<?php bloginfo('rss_url'); ?>" title="<?php esc_attr_e( 'RSS feed', 'emc' ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/rss.png" alt="RSS feed icon" /></a>
					<a href="<?php echo emc_obfuscate_mailto_url( 'cmeirick@erikson.edu' ); ?>" title="<?php esc_attr_e( 'Send us an email', 'emc' ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/email.png" alt="Email icon" /></a>
				</div>

				<div class="emc-search">
					<?php get_search_form(); ?>
				</div>
			</div>

			<ul class="mobile-alt-nav-links">
			  <?php if (!is_user_logged_in()) {
				  echo '<li><a href="' . get_home_url() . '/login">Project Login</a></li> /';
			  }; ?>
				<li><a href="<?php get_home_url(); ?>subscribe">Subscribe to Our Newsletter</a></li>
			</ul>

		</div><!-- .container -->

		<div class="emc-search emc-small-search">
			<?php get_search_form(); ?>
		</div>

		<?php
		/**
		 * Small width navigation - only on screens 480px wide or smaller
		 */
		?>
		<nav role="navigation" class="site-navigation small-navigation">
			<h1 class="assistive-text"><?php _e( 'Menu', 'emc' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'emc' ); ?>"><?php _e( 'Skip to content', 'emc' ); ?></a></div>
			<?php wp_nav_menu(); ?>
		</nav>
	</header><!-- #masthead .site-header -->
	
	<nav role="navigation" class="site-navigation main-navigation">
		<h1 class="assistive-text"><?php _e( 'Menu', 'emc' ); ?></h1>
		<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'emc' ); ?>"><?php _e( 'Skip to content', 'emc' ); ?></a></div>

		<?php wp_nav_menu(); ?>		
	</nav>

	<?php emc_wooslider(); ?>

	<?php if ( function_exists( 'emc_logged_in_info' ) ) emc_logged_in_info(); ?>

	<div id="main" class="container">


