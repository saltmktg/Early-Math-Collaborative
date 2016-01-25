<?php
/**
 * EMC functions and definitions
 *
 * @package EMC
 * @since 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since 1.0
 */
if ( ! isset( $content_width ) ) $content_width = 640; // pixels, at 989px wide


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since 1.0
 */
function emc_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'emc', get_template_directory() . '/languages' );
	$locale = get_locale();
    $locale_file = get_template_directory() . '/languages/$locale.php';
    if ( is_readable( $locale_file ) ) require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Add image sizes
	 */
	add_image_size( 'emc-featured', 646, 363, true ); // 16:9

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'emc' ),
	) );
}
add_action( 'after_setup_theme', 'emc_setup' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since 1.0
 */
function emc_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'emc' ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Header', 'emc' ),
		'id' => 'header',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Single View', 'emc' ),
		'id' => 'single',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer – Left', 'emc' ),
		'id' => 'footer-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer – Center', 'emc' ),
		'id' => 'footer-center',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer – Right', 'emc' ),
		'id' => 'footer-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Ideas Page Sidebar', 'emc' ),
		'id' => 'ideas-page-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'emc_widgets_init' );


/**
 * Enqueue scripts and styles
 */
function emc_scripts() {
	global $post;

	wp_enqueue_style( 'emc-style', get_stylesheet_uri() );

	wp_enqueue_script( 'emc-scripts', get_template_directory_uri() . '/js/emc.js', array( 'jquery' ) );
	wp_enqueue_script( 'modal-script', get_template_directory_uri() . '/js/jsmodal.min.js', array() );

	wp_enqueue_style( 'sharing', WP_SHARING_PLUGIN_URL.'sharing.css', false, JETPACK__VERSION );
	wp_enqueue_style( 'fontawsome', get_template_directory_uri() .'/css/font-awesome.min.css');
	wp_enqueue_script( 'sharing-js-fe', WP_SHARING_PLUGIN_URL . 'sharing.js', array( ), 3 );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'emc_scripts' );


/**
 * Add html5.js script to <head> conditionally for IE8 and under
 *
 * @since 1.0.4
 */
function emc_ie_html5_js() { ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
<?php }
add_action('wp_head', 'emc_ie_html5_js');


/**
 * Theme customizer with real-time update
 * Very helpful: http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
 *
 * @since 1.5
 */
function emc_theme_customizer( $wp_customize ) {

    // Logo upload
    $wp_customize->add_section( 'emc_logo_section' , array(
	    'title'       => __( 'Logo', 'emc' ),
	    'priority'    => 30,
	    'description' => 'Upload a logo to replace the default site name and description in the header',
	) );
	$wp_customize->add_setting( 'emc_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'emc_logo', array(
		'label'        => __( 'Logo', 'emc' ),
		'section'    => 'emc_logo_section',
		'settings'   => 'emc_logo',
	) ) );


}
add_action('customize_register', 'emc_theme_customizer');


/**
 * Display navigation to next/previous pages when applicable
 *
 * @since 1.0
 */
if ( ! function_exists( 'emc_content_nav' ) ):
function emc_content_nav( $nav_id ) {
	global $wp_query;

	if ( is_singular() && ! is_front_page() ) {
		emc_the_series_posts();
		return;
	}
	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="site-navigation paging-navigation">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'emc' ); ?></h1>

	<?php if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'emc' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'emc' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif;


/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.0
 */
if ( ! function_exists( 'emc_posted_on' ) ) :
function emc_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'emc' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'emc' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;


/**
 * Returns true if a blog has more than one category
 *
 * @since 1.0
 */
if ( ! function_exists( 'emc_categorized_blog' ) ) :
function emc_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so emc_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so emc_categorized_blog should return false
		return false;
	}
}
endif;


/**
 * Flush out the transients used in emc_categorized_blog
 *
 * @since 1.0
 */
function emc_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'emc_category_transient_flusher' );
add_action( 'save_post', 'emc_category_transient_flusher' );


/**
 * Generate comment HTML
 * Based on the P2 theme by Automattic
 * http://wordpress.org/extend/themes/p2
 *
 * @since 1.0
 */
if ( ! function_exists( 'emc_comment' ) ) :
function emc_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if ( !is_single() && get_comment_type() != 'comment' )
		return;
	$can_edit_post  = current_user_can( 'edit_post', $comment->comment_post_ID );
	$content_class  = 'comment-content';
	if ( $can_edit_post )
		$content_class .= ' comment-edit';
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">

		<?php emc_discussion_icon( $comment, $depth ); ?>
		<div class="comment-meta">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			<h4 class="emc-commenter"><?php echo get_comment_author_link(); ?></h4>
			<?php echo comment_time( 'F j, Y \a\t g:ia' ); ?>
		</div><!-- .comment-meta -->
		<div id="comment-content-<?php comment_ID(); ?>" class="<?php echo esc_attr( $content_class ); ?>">
			<?php if ( $comment->comment_approved == '0' ): ?>
					<p class="comment-awaiting"><?php esc_html_e( 'Your comment is awaiting moderation.', 'emc' ); ?></p>
			<?php endif; ?>
			<?php echo apply_filters( 'comment_text', $comment->comment_content ); ?>
		</div>
		</article>
	</li>
<?php }
endif;


/**
 * Display our discussion icon for a comment
 *
 * @since 1.0
 */
function emc_discussion_icon( $comment, $depth ) {

	global $post;

	$color = ( $comment->user_id == $post->post_author ) ? 'blue' : 'brown';
	$direction = ( 1 == $depth ) ? '-left.png' : '-right.png';

	$html = '<div class="emc-discussion-icon">';
	$html .= '<img class="avatar" src="' . get_template_directory_uri() . '/img/bubble-' . $color . $direction . '" alt="' . esc_attr__( 'Comment icon', 'emc' ) . '"/>';
	if ( 'blue' == $color ) $html .= '<span class="emc-comment-by-author">' . esc_html__( 'Author', 'emc' ) . '</span>';
	$html .= '</div><!-- .emc-discussion-icon -->';

	echo $html;

}


/**
 * Change HTML for comment form fields
 *
 * @since 1.0
 */
function emc_comment_form_args( $args ) {
	$args[ 'fields' ] = array(
		'author' => '<div class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'emc' ) . '</label><input type="text" class="field" name="author" id="author" aria-required="true" placeholder="' . esc_attr__( 'Name', 'emc' ) . '" /></div><!-- .comment-form-author -->',
		'email' => '<div class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'emc' ) . '</label><input type="text" class="field" name="email" id="email" aria-required="true" placeholder="' . esc_attr__( 'Email', 'emc' ) . '" /></div><!-- .comment-form-email -->',
		'url' => '<div class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'emc' ) . '</label><input type="text" class="field" name="url" id="url" placeholder="' . esc_attr__( 'Website', 'emc' ) . '" /></div><!-- .comment-form-url -->'
	);
	$args[ 'comment_field' ] = '<div class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'emc' ) . '</label><textarea id="comment" class="field" name="comment" rows="8" aria-required="true" placeholder="' . esc_attr__( 'Comment', 'emc' ) . '"></textarea></div><!-- .comment-form-comment -->';
	$args[ 'comment_notes_before' ] = '<p class="comment-notes">' . esc_html__( 'Your email will not be published. Name and Email fields are required.', 'emc' ) . '</p>';
	return $args;
}
add_filter( 'comment_form_defaults', 'emc_comment_form_args' );


/**
 * Remove ridiculous inline width style from captions
 * Source: http://wordpress.stackexchange.com/questions/4281/how-to-customize-the-default-html-for-wordpress-attachments
 *
 * @since 1.0
 */
function emc_remove_caption_width( $current_html, $attr, $content ) {
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    ), $attr));
    if ( 1 > (int) $width || empty($caption) )
        return $content;

    if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

    return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (int) $width . 'px">'
. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_filter( 'img_caption_shortcode', 'emc_remove_caption_width', 10, 3 );


/**
 * Add CSS class to menus for submenu indicator
 *
 * @since 1.0
 */
class EMC_Page_Navigation_Walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    	$id_field = $this->db_fields['id'];
        if ( !empty( $children_elements[ $element->$id_field ] ) ) {
            $element->classes[] = 'menu-item-parent';
        }
        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}


/**
 * Filter wp_nav_menu() arguments to specify the above walker
 *
 * @since 1.0
 */
function emc_nav_menu_args( $args ) {

	$args[ 'theme_location' ] = 'primary';
	$args[ 'container_class' ] = 'container';
	/**
	 * Set our new walker only if a menu is assigned,
	 * and a child theme hasn't modified it to one level
	 * (naughty child theme...)
	 */
	if ( 1 !== $args[ 'depth' ] && has_nav_menu( 'primary' ) ) {
		$args[ 'walker' ] = new EMC_Page_Navigation_Walker;
	}
	return $args;
}
add_filter( 'wp_nav_menu_args', 'emc_nav_menu_args' );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since 1.0
 */
function emc_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'emc_page_menu_args' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0
 */
function emc_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	return $classes;
}
add_filter( 'body_class', 'emc_body_classes' );


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since 1.0
 */
function emc_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'emc_enhanced_image_navigation', 10, 2 );


/**
 * Get the subcategory object by parent slug for a post
 *
 * @since 1.0
 */
function emc_get_subcategory_object( $post_id = null, $parent = null ) {

	// Missing arguments? Let's bail
	if ( ! isset( $post_id, $parent ) ) return false;

	// get ID of the parent category
	$term = get_category_by_slug( $parent );
	$parent_id = $term->term_id;

	// get all categories for the current post
	$cats = get_the_category( $post_id );
	foreach ($cats as $cat) {
		if ( $parent_id == $cat->category_parent ) {
			return $cat;
		}
	}

	return false;

}


/**
 * Return the current post's format link
 *
 * @since 1.0
 */
function emc_get_the_format() {

	$format = get_the_terms( get_the_ID(), 'emc_content_format' );

	if ( $format && ! is_wp_error( $format ) ) {

		$format = array_shift( $format );
		$html = sprintf( __( '<a href="%1$s" title="%2$s">%3$s</a>', 'emc' ),
			esc_url( get_term_link( $format ) ),
			sprintf( __( 'View all %s posts', 'emc' ), esc_attr( $format->name ) ),
			esc_html( $format->name )
		);
		return $html;

	}

	return false;

}


/**
 * Return the current post's series link
 *
 * @since 1.0
 */
function emc_get_the_series() {

	$series = get_the_terms( get_the_ID(), 'emc_series' );

	if ( $series && ! is_wp_error( $series ) ) {

		$series = array_shift( $series );
		$html = sprintf( __( '<a href="%1$s" title="%2$s">%3$s</a>', 'emc' ),
			esc_url( get_term_link( $series ) ),
			sprintf( __( 'View all posts in %s', 'emc' ), esc_attr( $series->name ) ),
			esc_html( $series->name )
		);
		return $html;

	}

	return false;

}


/**
 * Return the current post's "byline" field, if any
 *
 * @since 1.0
 */
function emc_get_the_author( $post_id ) {

	if ( ! class_exists( 'Acf', false ) ) return false;

	$author = get_post_meta( $post_id, 'byline', true );

	if ( isset( $author ) && ! empty( $author ) ) {

		$html = sprintf( __( ' by %s', 'emc' ),
			esc_html( $author )
		);
		return $html;

	}

	return false;

}


/**
 * Return the post content type icon
 *
 * @since 1.0
 */
function emc_get_content_icon() {

	$format = get_the_terms( get_the_ID(), 'emc_content_format' );

	if ( $format && ! is_wp_error( $format ) ) {

		$format = array_shift( $format );
		$url = get_template_directory_uri() . '/img/' . $format->slug . '.png';
		$title = sprintf( __( 'View all %s posts', 'emc' ), $format->name );
		$alt = sprintf( __( '%s icon', 'emc' ), $format->name );
		$html = sprintf( __( '<a href="%1$s" title="%2$s"><img class="emc-format-icon" src="%3$s" alt="%4$s"/></a>', 'emc' ),
			esc_url( get_term_link( $format ) ),
			esc_attr( $title ),
			esc_url( $url ),
			esc_attr( $alt )
		);
		return $html;

	}

	return false;

}


/**
 * Return the custom post type icon (FMC, CCA or Big Idea)
 *
 * @since 1.0
 */
function emc_get_tax_icon( $taxonomy ) {

	if ( isset( $taxonomy ) ){
		$tax_slug = $taxonomy;
	} else {
		global $wp_query;
		$tax        = $wp_query->get_queried_object();
		$tax_slug   = $tax->taxonomy;
	}

	switch ( $tax_slug ) {
		case 'emc_big_idea':
			$icon = 'key';
			$alt = __( 'Key icon for Big Ideas', 'emc' );
			break;
		case 'emc_tax_found':
			$icon = 'key';
			$alt = __( 'Key icon for Foundational Math Concepts', 'emc' );
			break;
		case 'emc_tax_common_core':
			$icon = 'star';
			$alt = __( 'Star icon for Common Core Alignment', 'emc' );
			break;
		default:
			return false;
	}

	$url = get_template_directory_uri() . '/img/' . $icon . '.png';
	$html = sprintf( '<div class="emc-format"><img class="emc-format-icon" src="%1$s" alt="%2$s"/></div><!-- .emc-format -->',
		esc_url( $url ),
		esc_attr( $alt )
	);

	return $html;

}

/**
 * Return the custom post type icon (FMC, CCA or Big Idea)
 *
 * @since 1.0
 */
function emc_get_cpt_icon() {

	$cpt = get_post_type();

	switch ( $cpt ) {
		case 'emc_big_idea':
			$icon = 'key';
			$alt = __( 'Key icon for Big Ideas', 'emc' );
			break;
		case 'emc_content_focus':
			$icon = 'key';
			$alt = __( 'Key icon for Foundational Math Concepts', 'emc' );
			break;
		case 'emc_common_core':
			$icon = 'star';
			$alt = __( 'Star icon for Common Core Alignment', 'emc' );
			break;
		default:
			return false;
	}

	$url = get_template_directory_uri() . '/img/' . $icon . '.png';
	$html = sprintf( '<div class="emc-format"><img class="emc-format-icon" src="%1$s" alt="%2$s"/></div><!-- .emc-format -->',
		esc_url( $url ),
		esc_attr( $alt )
	);

	return $html;

}




/**
 * Return a comma-separated list of subcategories by parent slug
 *
 * @since 1.0
 */
function emc_get_the_subcategory_list( $slug ) {

	// Determine parent category ID
	$parent = get_category_by_slug( $slug );
	$parent_id = $parent->term_id;

	// Check all post categories to see if any have the specified parent
	$cats = get_the_category( get_the_ID() );

	$html = '';
	foreach ($cats as $cat) {
		if ( $parent_id == $cat->category_parent ) {
			$html .= sprintf( '<a href="%1$s" title="%2$s">%3$s</a> ',
				get_category_link( $cat->term_id ),
				sprintf( __( 'View all posts in %s', 'emc' ), esc_attr( $parent->name ) ),
				esc_attr( $cat->name )
			);
		}
	}

	return $html;

}


/**
 * Display post meta
 *
 * @since 1.0
 */
function emc_display_post_meta( $post_id ) {

	$post_type = get_post_type( $post_id );

	$type = get_post_type_object( $post_type );
	if ( $type ) {
		switch ( $type->name ) {
			case 'emc_content_focus':
			case 'emc_common_core':
			case 'emc_big_idea':
				$title_attr = sprintf( __( 'View all %s', 'emc' ), esc_attr( $type->label ) );
				printf( __( 'Part of the <a href="%1$s" title="%2$s">%3$s</a> &bull; View all <a href="%4$s">related content</a>', 'emc' ),
					esc_url( get_post_type_archive_link( $type->name ) ),
					esc_attr( $title_attr ),
					esc_html( $type->label ),
					esc_url( get_permalink( get_the_ID() ) )
				);
				return;
			case 'page':
				return;
			default:
				break;
		}
	} else {
		switch ( get_post_type() ) {
			case 'emc_content_format':
				esc_html_e( 'Early Math Collaborative content type', 'emc' );
				return;
			case 'emc_grade_level':
				esc_html_e( 'Early Math Collaborative grade level', 'emc' );
				return;
			case 'emc_series':
				esc_html_e( 'Early Math Collaborative content series', 'emc' );
				return;
		}
	}

	$html = sprintf( __( 'This is %1$s %2$s', 'emc' ),
		( strpos( emc_get_the_format(), 'article' ) ) ? 'an' : 'a',
		emc_get_the_format()
	);


	if ( ! is_singular() )
		$html .= sprintf( __( ' in the series %s', 'emc' ),
			emc_get_the_series()
		);

	if ( emc_get_the_author( $post_id ) )
		$html .= emc_get_the_author( $post_id );


	$html .= sprintf( ' <time class="entry-date" datetime="%1$s" pubdate>%2$s</time></a>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);


	$grades = get_the_terms( $post_id, 'emc_grade_level' );


	if ( ! is_wp_error( $grades ) && ! empty( $grades ) ) {
		$grade_list = '';
		foreach ( $grades as $grade ) {
			$grade_list .= sprintf( '<a href="%1$s" title="%2$s">%3$s</a> ',
				get_term_link( $grade->slug, 'emc_grade_level' ),
				sprintf( __( 'View all posts in %s', 'emc' ), esc_attr( $grade->name ) ),
				esc_html( $grade->name )
			);
		}

		$html .= sprintf( __( ' &bull; For grade levels %s', 'emc' ),
			$grade_list
		);
	}

	if ( has_tag() ) $html .= ' &bull; ' . get_the_tag_list( __( 'Tagged ', 'emc' ), ', ' );

	echo $html;

}


/**
 * Display the Foundational Math Concept buttons
 *
 * @since 1.0
 */
function emc_the_fmcs() {

	$type = get_post_type();
	switch ( $type ) {
		case 'emc_content_focus':
		case 'emc_common_core':
		case 'emc_big_idea':
		case 'page':
			return false;
		default:
			break;
	}

	$grades = get_the_terms( get_the_ID(), 'emc_tax_found' );

	if ( is_wp_error( $grades) || ! $grades ) return false;

	$html = '';
	foreach ( $grades as $grade ) {

		$html .= sprintf( '<a class="emc-meta-cat" href="%1$s" title="%2$s">%3$s&nbsp;</a>',
			esc_url( get_term_link( $grade ) ),
			esc_attr( $grade->name ),
			esc_html( $grade->name )
		);

	}

	if ( ! empty( $html ) ) : ?>

	<div class="tag-row">
	  <div class="meta-bullet emc-fms-bullet"></div>
		<!--<h2 class="emc-cluster-title"><?php esc_html_e( 'Foundational Math Concepts', 'emc' ); ?></h2>-->
		<!--<ul>-->
			<?php echo $html; ?>
		<!--</ul>-->
	</div><!-- .emc-fmc -->

<?php endif;

} // emc_the_fmcs


/**
 * Display the Common Core Alignment buttons
 *
 * @since 1.0
 */
function emc_the_ccas() {

	$type = get_post_type();
	switch ( $type ) {
		case 'emc_content_focus':
		case 'emc_common_core':
		case 'emc_big_idea':
		case 'page':
			return false;
		default:
			break;
	}

	$grades = get_the_terms( get_the_ID(), 'emc_tax_common_core' );

	if ( is_wp_error( $grades) || ! $grades ) return false;

	$html = '';
	foreach ( $grades as $grade ) {

		$html .= sprintf( '<a class="emc-meta-cat" href="%1$s" title="%2$s">%3$s&nbsp;</a>',
			esc_url( get_term_link( $grade ) ),
			esc_attr( $grade->name ),
			esc_html( $grade->name )
		);

	}

	if ( ! empty( $html ) ) : ?>

	<div class="tag-row">
	  <div class="meta-bullet emc-cca-bullet"></div>
		<!--<h2 class="emc-cluster-title"><?php esc_html_e( 'Common Core Alignment', 'emc' ); ?></h2>-->
		<!--<ul>-->
			<?php echo $html; ?>
		<!--</ul>-->
	</div><!-- .emc-cca -->

	<?php endif;

}


/**
 * Display the Grade Level buttons
 *
 * @since 1.0
 */
function emc_the_grade_levels() {

	$type = get_post_type();
	switch ( $type ) {
		case 'emc_content_focus':
		case 'emc_common_core':
		case 'emc_big_idea':
		case 'page':
			return false;
		default:
			break;
	}

	$grades = get_the_terms( get_the_ID(), 'emc_grade_level' );

	if ( is_wp_error( $grades) || ! $grades ) return false;

	$html = '';
	foreach ( $grades as $grade ) {

		$html .= sprintf( '<a class="emc-meta-cat" href="%1$s" title="%2$s">%3$s&nbsp;</a>',
			esc_url( get_term_link( $grade ) ),
			esc_attr( $grade->name ),
			esc_html( $grade->name )
		);

	} ?>

	<div class="tag-row">
	  <div class="meta-bullet emc-gl-bullet"></div>
		<!--<h2 class="emc-cluster-title"><?php esc_html_e( 'Grade Levels', 'emc' ); ?></h2>-->
		<!--<ul>-->
			<?php echo $html; ?>
		<!--</ul>-->
	</div><!-- .emc-grades -->

<?php }


/**
 * Get term ID by slug
 *
 * @since 1.0
 */
function kwight_term_id_by_slug( $slug, $tax = 'category' ) {

	$term = get_term_by( 'slug', $slug, $tax );
	$id = ( $term ) ? $term->term_id : false;

	return intval( $id );

}


/**
 * Display our video with its duration
 *
 * @since 1.0
 */
function emc_video() {

	// get the URL field
	$url = get_field( 'url' );
	if ( empty( $url ) ) {
		_e( '<em>URL field is empty.</em>', 'emc' );
		return false;
	}

	if ( strpos( $url, 'rackcdn.com' ) ) {

		// get the URL for the medium featured image, to serve as video poster
		$thumb_id = get_post_thumbnail_id( get_the_ID() );
		$thumb_src = wp_get_attachment_image_src( $thumb_id, 'large' );

		// assemble our EMC RackSpace HTML5 video embed with Flash fallback
		$shortcode = sprintf( '[video mp4="%1$s" poster="%2$s" width="%3$s" height="%4$s"]',
			esc_url( $url ),
			esc_attr( $thumb_src[0] ),
			'100%',
			'auto'
		);

		$video = do_shortcode( $shortcode );

	} else {

		// we have something other than RackSpace for a video link
		$video = wp_oembed_get( esc_url( get_field( 'url' ) ) );

	}

	// Determine the duration
	$duration = ( get_field( 'duration' ) ) ? get_field( 'duration' ) : __( 'Not specified', 'emc' );
	$duration = sprintf( __( 'Duration: %s', 'emc' ), esc_html( $duration ) );

	// Get help text
	$help = get_page_by_path( 'video-problems-text', OBJECT, 'post' );

	// Assemble our final HTML
	$html = '<div class="emc-video">';
	$html .= $video;
	$html .= '<div class="emc-toggle-section emc-video-meta">';
	$html .= '<span class="emc-video-duration">' . esc_html( $duration ) . '</span>';
	$html .= '<a class="emc-toggle-link">' . esc_html__( 'Having video problems?', 'emc' ) . '</a>';
	$html .= '<div class="emc-toggle-content">';
	$html .= apply_filters( 'the_content', $help->post_content );
	$html .= '</div><!-- .emc-toggle-content -->';
	$html .= '</div><!-- .emc-video-meta -->';
	$html .= '</div><!-- .emc-video -->';

	echo $html;

}


/**
 * Display our "Why Is This Important?" section
 *
 * @since 1.0
 */
function emc_why_is_this_important() {

	if ( ! class_exists( 'Acf', false ) ) return false;

	$why = get_field( 'why_is_this_important' );
	if ( ! $why ) return;
	$html = '<h2 class="emc-section-heading">' . __( 'Why is this important?', 'emc' ) . '</h2>';
	$html .= $why;
	echo $html;

}


/**
 * Display related Big Ideas on single views
 *
 * @since 1.0
 */
function emc_single_big_ideas() {

	// custom loop for connected content foci
	$big_ideas = new WP_Query( array(
	  	'connected_type' => 'big_ideas_to_posts',
	  	'connected_items' => get_queried_object(),
	  	'nopaging' => true,
	) );

	// Display Big Ideas
	if ( $big_ideas->have_posts() ) :

		while ( $big_ideas->have_posts() ) : $big_ideas->the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-related-post' ); ?>>
				<div class="emc-format">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/key.png" alt="<?php esc_attr_e( 'Key icon for Big Ideas', 'emc' ); ?>"/>
				</div>
				<h3 class="entry-title"><?php esc_html_e( 'Big Idea', 'emc' ); ?></h3>

				<div class="entry-content">
					<p><?php the_title(); ?> <a class="emc-learn-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'More', 'emc' ); ?></a>
				</div><!-- .entry-content -->
			</article>

		<?php
		endwhile;
		wp_reset_postdata();

	endif;

}


/**
 * Display related Common Core Alignments on single views
 *
 * @since 1.0
 *
 * @param int   $post_id        required        The ID of the post we're dealing with
 */
function emc_single_ccas( $post_id ) {

	$terms = get_the_terms( (int) $post_id, 'emc_tax_common_core' );

	// Display CCAs
	if ( isset( $terms ) && ! empty( $terms ) ) {

		foreach( $terms as $t ){

			$term_id        = (int) $t->term_id;
			$term_title     = (string) $t->name;
			$term_link      = get_term_link( $t, 'emc_tax_common_core' );
	?>

		<article id="post-<?php echo $term_id; ?>" <?php post_class( 'emc-related-post' ); ?>>
			<div class="emc-format">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/star.png" alt="<?php esc_attr_e( 'Star icon for Common Core Alignment', 'emc' ); ?>"/>
			</div>
			<h3 class="entry-title"><?php esc_html_e( 'Common Core Alignment', 'emc' ); ?></h3>

			<div class="entry-content">
				<p><?php echo $term_title; ?> <a class="emc-learn-more" href="<?php echo $term_link; ?>"><?php esc_html_e( 'More', 'emc' ); ?></a>
			</div><!-- .entry-content -->
		</article>

	<?php
		} // foreach
	} // if

} // emc_single_ccas


/**
 * Display the Foundational Math Concept buttons on single views
 *
 * @since 1.0
 *
 * @param   int     $post_id        required        The id of the post we are dealing with
 */
function emc_single_fmcs( $post_id ) {

	$terms = get_the_terms( (int) $post_id, 'emc_tax_found' );

	// Display CCAs
	if ( isset( $terms ) && ! empty( $terms ) ) { ?>

		<div class="emc-button-cluster emc-fmc">
			<h2 class="emc-cluster-title"><?php esc_html_e( 'Foundational Math Concepts', 'emc' ); ?></h2>
			<ul>
			<?php foreach( $terms as $t ){
				$term_title     = (string) $t->name;
				$term_link      = get_term_link( $t, 'emc_tax_common_core' );
			?>
				<li><a class="emc-button" href="<?php echo $term_link; ?>" title="<?php echo $term_title; ?>"><?php echo $term_title; ?></a></li>
			<?php } // foreach ?>

			</ul>
		</div><!-- .emc-fmc -->
	<?php
	} // if

} // emc_single_fmcs


/**
 * Display the Foundational Math Concept section title with "What is this?" link
 *
 * @since 1.0
 */
function emc_fmc_section_title() {

	$url = get_post_type_archive_link( 'emc_content_focus' );
	$html = sprintf( '<h2 class="emc-section-heading">%1$s <a class="emc-what-is-this" href="%2$s">%3$s</a></h2>',
		esc_html__( 'Foundational Math Concepts', 'emc' ),
		esc_url( $url ),
		esc_html__( 'What is this?', 'emc' )
	);

	echo $html;

}


/**
 * Add a Learn More link to the end of excerpts
 *
 * @since 1.0
 */
function emc_learn_more_link() {

	$more = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
		get_permalink(),
		esc_attr__( 'View full post', 'emc' ),
		esc_html__( '&nbsp;&nbsp;More&nbsp;&rarr;', 'emc' )
	);
	return $more;

}
add_filter( 'excerpt_more', 'emc_learn_more_link' );

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * Display the footer meta for single views
 *
 * @since 1.0
 */
function emc_single_footer_meta() {

	if ( ! class_exists( 'Acf', false ) ) return false;

	$source = ( get_field( 'source' ) ) ? get_field( 'source' ) : __( 'Not specified', 'emc' );
	$copyright = ( get_field( 'copyright' ) ) ? get_field( 'copyright' ) : __( '&copy; Erikson Insitute', 'emc' );
	$content_id = ( get_field( 'id' ) ) ? get_field( 'id' ) : __( 'Not specified', 'emc' );

	$html = sprintf( __( 'Source: %1$s &bull; Copyright: %2$s &bull; Content ID: %3$s', 'emc' ),
		esc_html( $source ),
		esc_html( $copyright ),
		esc_html( $content_id )
	);

	echo $html;

}


/**
 * Display the post thumbnail on indices, according to format
 *
 * @since 1.0
 */
function emc_the_post_thumbnail( $size = NULL ) {

	if ( ! $size ) {
		$size = ( has_term( 'video', 'emc_content_format' ) ) ? 'full' : 'thumbnail';
	}

	$html = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
		get_permalink(),
		esc_attr__( 'View the full post', 'emc' ),
		get_the_post_thumbnail( get_the_ID(), $size )
	);

	echo $html;

}

/**
 * Display a post type page link
 *
 * @since 1.0
 */
function emc_the_post_type_link( $type ) {

	$post_type = get_post_type_object( $type );
	$url = site_url( '/' ) . $post_type->rewrite[ 'slug' ] . '/';

	$html = sprintf( __( 'Part of the <a href="%1$s" title="%2$s">%3$s</a>', 'emc' ),
		esc_url( $url ),
		sprintf( __( 'View all %s', 'emc' ), esc_attr( $post_type->labels->name ) ),
		esc_html( $post_type->labels->name )
	);

	echo $html;

}


/**
 * Display related posts in an unordered list (by Posts To Posts connections)
 *
 * @since 1.0
 */
function emc_related_posts_list( $connection, $heading = false ) {

	$related = new WP_Query( array(
	  	'connected_type' => $connection,
	  	'connected_items' => get_queried_object(),
	  	'nopaging' => true,
	) );

	if ( ! $related || ! $heading ) return false;

	p2p_list_posts( $related, array(
		'before_list' => '<h2 class="emc-section-heading">' . esc_html( $heading ) . '</h2><ul>',
		'after_list' => '</ul>',
	) );


}


/**
 * Display the page title for taxonomy archives
 *
 * @since 1.0
 */
function emc_the_term_title() {

	$term = get_queried_object();

	if ( is_tax( 'emc_content_format' ) ) {
		$html = sprintf( __( '%ss', 'emc' ),
			$term->name
		);
	} elseif ( is_tax( 'emc_series' ) ) {
		$html = sprintf( __( 'Series: %s', 'emc' ),
			$term->name
		);
	} elseif ( is_tax( 'emc_grade_level' ) ) {
		$html = sprintf( __( 'Grade Level: %s', 'emc' ),
			$term->name
		);
	} else {
		$html = $term->name;
	}

	echo esc_html( $html );

}

/**
 * Displays the page title for our CPT
 *
 * @since 1.0
 */
function emc_the_cpt_title(){

	$cpt    = get_queried_object();
	$title  = $cpt->labels->name;
	echo esc_html( $title );

} // emc_the_cpt_title

/**
 * Gets the CPT desicrption/content for our CPT
 *
 * @since 1.0
 */
function emc_the_cpt_description(){

	$desc = get_page_by_path( 'description', OBJECT, 'emc_content_focus' );
	$html = apply_filters( 'the_content', $desc->post_content );
	echo $html;

} // emc_the_cpt_description


/**
 * Display the page title for custom post type archives
 *
 * @since 1.0
 */
function emc_taxonomy_title() {

	global $wp_query;
	$term = $wp_query->get_queried_object();
	$title = $term->name;

	echo esc_html( $title );

}


/**
 * Display the custom post type description
 * (pulled from a draft post called "description" in that custom post type)
 *
 * @since 1.0
 */
function emc_taxonomy_description( $description = null ) {

	if ( isset( $description ) ){
		$desc = $description;
	} else {
		global $wp_query;
		$term = $wp_query->get_queried_object();
		$desc = $term->description;
	}

	$html = apply_filters( 'the_content', $desc );
	return $html;

}


/**
 * Determine the current post content format (Article, Download, Link, Video, or Discussion)
 *
 * @since 1.0
 */
function emc_get_post_format() {

	$format = get_the_terms( get_the_ID(), 'emc_content_format' );

	if ( is_wp_error( $format ) || ! $format ) return false;

	$format = array_shift( $format );
	return $format->slug;

}


/**
 * Display the Link post excerpt
 *
 * @since 1.0
 */
function emc_the_link_excerpt() {

	$title = ( get_field( 'link_title' ) ) ? get_field( 'link_title' ) : get_the_title();
	$url = ( is_single() ) ? get_field( 'link_url' ) : get_permalink();
	$source = get_field( 'source' );
	$excerpt = get_field( 'excerpt' );

	if ( ! $url ) return false; ?>

	<div class="emc-link">
		<a href="<?php echo esc_url( $url ); ?>">
			<!--<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>-->
			<div class="emc-link-content">
				<h2 class="emc-link-title"><?php echo esc_html( $title ); ?></h2>
				<?php if(is_single()) {
		  	echo '<div class="link-post-icon"><img src="http://earlymath.erikson.edu/wp-content/themes/emc/img/icon-link.png"></div>';
		  	}?>
				<div class="emc-link-source"><?php echo esc_html( $source ); ?></div>
				<?php echo esc_html( $excerpt ); ?>
			</div>
		</a>
	</div><!-- .emc-link -->

<?php }


/**
 * Display the contact information for a Project's header
 *
 * @since 1.0
 */
function emc_project_header() {

	$term = get_queried_object();
	$term_id = $term->taxonomy . '_' . $term->term_id;
	$content = get_field( 'project_contacts', $term_id );
	$html = apply_filters( 'the_content', $content );

	echo $html;

}


/**
 * Project information for logged-in users
 *
 * @since 1.0
 */
function emc_logged_in_info() {

	if ( ! is_user_logged_in() || ! class_exists( 'Groups_Utility', false ) ) return false;

	global $current_user;

	$groups_user = new Groups_User( get_current_user_id() );
    $groups = $groups_user->__get( 'groups' );
    array_shift( $groups );

    $welcome = sprintf( __( 'Welcome, %s', 'emc' ), esc_html( $current_user->display_name ) );

    $edit = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
        self_admin_url( 'profile.php' ),
        esc_attr__( 'Edit your profile', 'emc' ),
        esc_html__( 'Edit Profile', 'emc' )
    );
    $logout = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
        wp_logout_url( home_url() ),
        esc_attr__( 'Log out of your account', 'emc' ),
        esc_html__( 'Log Out', 'emc' )
    );
    $toggle = sprintf( '<a class="emc-toggle-link" title="%1$s">%2$s</a>',
        esc_attr__( 'View your projects', 'emc' ),
        esc_html__( 'View your projects', 'emc' )
    );
    ?>
    <div class="container">
		<div class="emc-logged-in-info">
			<h2 class="emc-welcome-title">
				<span class="emc-welcome-link"><?php echo $logout; ?></span>
				<span class="emc-welcome-link"><?php echo $edit; ?></span>
				<?php echo $welcome; ?>
				<?php echo $toggle; ?>
			</h2>
			<div class="emc-projects">
			    <?php foreach ( $groups as $group ) {
			    	$term = get_term_by( 'name', $group->name, 'emc_project' );

			    	if ( $term ) : ?>

				    	<div class="emc-project">
				    		<h3 class="emc-project-title"><?php echo esc_html( $term->name ); ?></h3>
				    		<?php emc_the_term_thumbnail( $term ); ?>
				    		<?php emc_the_project_content( $term ); ?>
				    	</div>

			    	<?php endif;
				} ?>
			</div><!-- .emc-projects -->

		</div><!-- .emc-logged-in-info -->
	</div>

<?php }

/**
 * Display the thumbnail for a certain term
 *
 * @since 1.0
 */
function emc_the_term_thumbnail( $term = false ) {

	if ( ! $term ) return false;

	$term_id = $term->taxonomy . '_' . $term->term_id;
	$image_id = get_field( 'project_image', $term_id );
	$html = wp_get_attachment_image( $image_id, 'thumbnail' );

	echo $html;

}


/**
 * Display the WYSIWYG description for a term
 *
 * @since 1.0
 */
function emc_the_term_description() {

	$term = get_queried_object();
	if ( ! isset( $term->taxonomy ) || ! class_exists( 'Acf', false ) ) return false;

	$term_id = $term->taxonomy . '_' . $term->term_id;
	$description = get_field( 'project_description', $term_id, true );

	echo $description;

}


/**
 * Display the project content for logged-in users
 *
 * @since 1.0
 */
function emc_the_project_content( $term = false ) {

	if ( ! $term || ! class_exists( 'Acf', false ) ) return false;

	$term_id = $term->taxonomy . '_' . $term->term_id;
	$description = get_field( 'project_description', $term_id, true );
	$contacts = get_field( 'project_contacts', $term_id, true );
	$url = site_url() . '/project/' . $term->slug;

	$html = '<p>' . $description . '</p>';

	$html .= sprintf( '<a class="emc-contact-link emc-toggle-link" title="%1$s">%2$s</a>',
		esc_attr__( 'See all contact information for this project', 'emc' ),
		esc_html__( 'View contact information', 'emc' )
	);

	$html .= sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
		esc_url( $url ),
		esc_attr__( 'View only this project\'s posts', 'emc' ),
		esc_html__( 'View project posts', 'emc' )
	);

	if ( $contacts ) {
		$html .= '<div class="emc-contacts">';
		$html .= $contacts;
		$html .= '</div><!-- .emc-contacts -->';
	}
	echo $html;

}


/**
 * Return obfuscated mailto: URL
 *
 * @since 1.0
 */
function emc_obfuscate_mailto_url( $email ) {

	if ( ! is_email( $email ) ) return false;

	$email = 'mailto:' . antispambot( $email );

	return esc_url( $email );

}


/**
 * Output our WooSlider
 *
 * @since 1.0
 */
function emc_wooslider() {

	if ( class_exists( 'WooSlider', false ) && is_front_page() ) {
		$general_args = array(
			'slider_type' => 'posts',
			'control_nav' => true,
			'direction_nav' => false,
			'animation' => 'slide',
 		);
		$home_page_args = array(
			'tag' => 'slider',
			'size' => 'full',
			'overlay' => 'full',
		); ?>
		<div class="container">
			<?php wooslider( $general_args, $home_page_args ); ?>
		</div>

	<?php }

}


/**
 * Remove "slider" posts for slider from queries
 *
 * @since 1.0
 *
 * @updated October 8, 2013 to limit the paging query to archive/search pages only
 */
/*function emc_pre_get_posts( $query ) {

	if ( ! is_admin() && $query->is_main_query() ) {

		if ( is_search() || is_archive() ){
			$query->query_vars[ 'nopaging' ] = true;
		} // is_search || is_archive

		// Remove slider posts from queries
		$query->query_vars[ 'tag__not_in' ] = array( kwight_term_id_by_slug( 'slider', 'post_tag' ) );

		// Remove video help text from results
		$help = get_page_by_path( 'video-problems-text', OBJECT, 'post' );
		if ( is_object( $help ) )
			$query->query_vars[ 'post__not_in' ][] = $help->ID;

		// Remove filter text from results
		$text = get_page_by_path( 'filter-text', OBJECT, 'post' );
		if ( is_object( $text ) )
			$query->query_vars[ 'post__not_in' ][] = $text->ID;

	}

}
add_action( 'pre_get_posts', 'emc_pre_get_posts' );*/


/**
 * Filter the post classes
 *
 * @since 1.0
 */
function emc_post_classes( $classes ) {

	if ( ( ! is_post_type_archive( array( 'emc_content_focus', 'emc_big_idea', 'emc_common_core' ) ) && ! emc_get_content_icon() ) && ( is_search() || is_archive() ) ) {
		$classes[] = 'emc-no-format';
	}

	return $classes;

}
add_filter( 'post_class', 'emc_post_classes' );


/**
 * Display downloads for the Download format on single view
 *
 * @since 1.0
 */
function emc_download() {

	if ( ! class_exists( 'Acf', false ) ) return false;

	$html = '';
	if ( get_field( 'download_files' ) ) {

		while ( has_sub_field( 'download_files' ) ) {

			$download = get_sub_field( 'download_file' );

			// Determine icon
			$mime = get_post_mime_type( $download[ 'id' ] );
			switch ( $mime ) {
				case 'application/pdf':
					$icon = get_stylesheet_directory_uri() . '/img/' . 'pdf.png';
					break;
				case 'application/msword':
					$icon = get_stylesheet_directory_uri() . '/img/' . 'word.png';
					break;
				case 'application/vnd.ms-excel':
					$icon = get_stylesheet_directory_uri() . '/img/' . 'excel.png';
					break;
				case 'application/vnd.ms-powerpoint':
					$icon = get_stylesheet_directory_uri() . '/img/' . 'powerpoint.png';
					break;
				default:
					$icon = get_stylesheet_directory_uri() . '/img/' . 'download.png';
					break;
			}

			$html .= sprintf( '<a href="%1$s" title="%2$s">',
				esc_url( $download[ 'url' ] ),
				__( 'Download this file', 'emc' )
			);
			$html .= '<div class="emc-download emc-button">';
			$html .= '<img class="emc-download-icon" src="' . $icon . '"/>';
			$html .= esc_html( $download[ 'title' ] );
			$html .= '</div></a>';


			}

	}

	echo $html;

}


/**
 * Filter in different HTML and a "More" link for featured (slider) posts
 *
 * @since 1.0
 */
function emc_slider_html( $content, $args, $post ) {

	$image = get_the_post_thumbnail( get_the_ID(), $args['size'] );

	// Determine our More link
	$link = get_field( 'slider_link' );
	$text = ( get_field( 'slider_link_text' ) ) ? get_field( 'slider_link_text' ) : __( 'More&nbsp;&rarr;', 'emc' );
	$external = ( get_field( 'slider_external' ) ) ? ' target="_blank"' : false;
	$more = ( $link ) ? sprintf( '&nbsp;&nbsp;<a class="emc-slider-more" href="%1$s"%2$s>%3$s</a>',
			esc_url( $link ),
			$external,
			esc_html( $text )
		) : false;

	$excerpt = '';
	if ( ( $args['display_excerpt'] == 'true' || $args['display_excerpt'] == 1 ) && has_excerpt( get_the_ID() ) ) {
		$excerpt = get_the_excerpt();
		if ( $more ) $excerpt .= $more;
		$excerpt = wpautop( $excerpt );
	}

	$title = get_the_title( get_the_ID() );
	if ( $args['link_title'] == 'true' || $args['link_title'] == 1 ) {
		$title = '<a href="' . get_permalink( $post ) . '">' . $title . '</a>';
		$image = '<a href="' . get_permalink( $post ) . '">' . $image . '</a>';
	}

	$content = $image . '<div class="slide-excerpt"><h2 class="slide-title">' . $title . '</h2>' . $excerpt . '</div>';
	if ( $args['layout'] == 'text-top' ) {
		$content = '<div class="slide-excerpt"><h2 class="slide-title">' . $title . '</h2>' . $excerpt . '</div>' . $image;
	}

	return $content;

}
add_filter( 'wooslider_posts_layout_html', 'emc_slider_html', 10, 3 );


/**
 * Add recommended posts from the same series for single views
 *
 * @since 1.0
 */
function emc_the_series_posts() {

	$series = get_the_terms( get_the_ID(), 'emc_series' );

	if ( ! $series || is_wp_error( $series ) ) return false;

	$series = array_shift( $series );

	// Generate three random posts from our series
	$args = array(
		'showposts' => 3,
		'tax_query' => array(
			array(
				'taxonomy' => 'emc_series',
				'field' => 'id',
				'terms' => $series->term_id,
			),
		),
		'orderby' => 'rand',
		'post__not_in' => array( get_the_ID() ),
	);

	$related = new WP_Query( $args );
	if ( $related->have_posts() ) :

		printf( __( '<h2 class="emc-section-heading">More in the %s series</h2>', 'emc' ),
			emc_get_the_series()
		);

		while ( $related->have_posts() ) : $related->the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-related-series-post' ); ?>>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<p class="entry-content"><?php echo get_the_excerpt(); ?></p>
		</article>

	<?php
	endwhile;
	endif;
	wp_reset_postdata();
}


/**
 * Remove WordPress default /admin redirect (interferes with OpenAdmin redirect)
 *
 * @since 1.0
 */
remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );


/**
 * Display two random comments for the EMC Discussion format.
 *
 * @since 1.0
 */
function emc_discussion_comments() {

	// Get two random comments from the current post
	$args = array(
		'post_id' => get_the_ID(),
		'status' => 'approve',
	);
	$comment_query = new WP_Comment_Query;
	$comments = $comment_query->query( $args );

	if ( ! empty( $comments ) ) {
		shuffle( $comments );
		$comments = array_slice( $comments, 0, 2 );
		dbgx_trace_var( $comments );

		$html = '';
		// Loop through each comment
		foreach ( $comments as $comment ) {
			$excerpt = wp_trim_words( $comment->comment_content, 35 );
			$commenter = sprintf( __( '&mdash; <a href="%1$s" title="%2$s">%3$s</a>', 'emc' ),
				get_comment_link( $comment ),
				sprintf( __( 'View the full comment by %s', 'emc' ), esc_attr( $comment->comment_author ) ),
				esc_html( $comment->comment_author )
			);
			$html .= '<div class="emc-comment">';
			$html .= '<blockquote>' . esc_html( $excerpt ) . '</blockquote>';
			$html .= '<p class="emc-commenter-link">' . $commenter . '</p>';
			$html .= '</div><!-- .emc-comment -->';

		}
	} else {
		$html = sprintf( __( '<p class="emc-no-comments">No comments yet. Be the first and <a href="%s" title="Start the discussion">let us know what you think!</a></p>', 'emc' ),
			get_permalink()
		);
	}

	echo $html;

}


/**
 * Display Jetpack Sharing buttons
 *
 * @since 1.0
 */
function emc_sharing_display() {

	if ( class_exists( 'Jetpack', false ) ) {
		$jetpack_active_modules = get_option('jetpack_active_modules');
		if ( $jetpack_active_modules && in_array( 'sharedaddy', $jetpack_active_modules ) ) {
			echo sharing_display();
			?>
			<!--<div class="sharedaddy sd-sharing-enabled"><div class="robots-nocontent sd-block sd-social sd-social-icon-text sd-sharing"><h3 class="sd-title">Share this:</h3><div class="sd-content"><ul><li class="share-facebook"><a rel="nofollow" class="share-facebook sd-button share-icon" href="http://local.earlymath.erikson.edu/new-study-differentiating-works/?share=facebook" title="Share on Facebook" id="sharing-facebook-6199"><span>Facebook</span></a></li><li class="share-twitter"><a rel="nofollow" class="share-twitter sd-button share-icon" href="http://local.earlymath.erikson.edu/new-study-differentiating-works/?share=twitter" title="Click to share on Twitter" id="sharing-twitter-6199"><span>Twitter</span></a></li><li class="share-pinterest"><a rel="nofollow" class="share-pinterest sd-button share-icon" href="http://local.earlymath.erikson.edu/new-study-differentiating-works/?share=pinterest" title="Click to share on Pinterest"><span>Pinterest</span></a></li><li class="share-google-plus-1"><a rel="nofollow" class="share-google-plus-1 sd-button share-icon" href="http://local.earlymath.erikson.edu/new-study-differentiating-works/?share=google-plus-1" title="Click to share on Google+" id="sharing-google-6199"><span>Google +1</span></a></li><li class="share-email"><a rel="nofollow" class="share-email sd-button share-icon" href="http://local.earlymath.erikson.edu/new-study-differentiating-works/?share=email" title="Click to email this to a friend"><span>Email</span></a></li><li class="share-print"><a rel="nofollow" class="share-print sd-button share-icon" href="http://local.earlymath.erikson.edu/new-study-differentiating-works/#print" title="Click to print"><span>Print</span></a></li><li class="share-end"></li></ul></div></div></div>-->
			<?php
		}
	}

}

/**
 * Remove Jetpack Sharing buttons from after content
 *
 * @since 1.0
 */
function emc_remove_sharing_buttons() {

	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );

}
add_action( 'init', 'emc_remove_sharing_buttons' );


/**
 * Remove WordPress SEO analysis feature (removes the dropdown on edit.php)
 *
 * @since 1.0
 */
add_filter( 'wpseo_use_page_analysis', '__return_false' );

/**
 * Just a helper to force a reindex of the content.
 *
 * Uncomment the action and then hit up the WordPress admin to force a reindex
 *
 * @since October 3, 2013
 * @author SFNdesign, Curtis McHale
 */
function redex(){
	$searchWP = SearchWP::instance();
	$searchWP->triggerIndex();
}
//add_action( 'admin_init', 'redex' );
//add_filter( 'searchwp_debug', '__return_true' );


/**
 * Just converts some P2P relations to taxonomies
 *
 * @return string
 */
function convert_this(){
// keeping this around for history but we never want it to run by accident.
return;
	$html = '<h3>Converting Yo!</h3>';

	$found_args = array(
		'posts_per_page'    => 10,
		'post_type'         => 'emc_content_focus', // emc_content_focus emc_common_core
	);
	$found = get_posts( $found_args );

	foreach( $found as $f ){
		$html .= get_the_title( $f->ID ) . '<br />';

		$related = get_post( $f->ID );

		$connected = get_posts( array(
			'connected_type'    => 'content_foci_to_posts', // content_foci_to_posts common_core_to_posts
			'connected_items'   => $related,
			'nopaging'          => true,
			'suppress_filters'  => false,
			'posts_per_page'    => -1,
		));

		$term_title = get_the_title( $f->ID );

		$term_id = wp_insert_term( $term_title, 'emc_tax_found' ); // emc_tax_found, emc_tax_common_core

		foreach( $connected as $c ){
			$html .= '&nbsp; &nbsp;' . get_the_title( $c->ID ) .'<br />';

			wp_set_post_terms( $c->ID, $term_id, 'emc_tax_found' ); // emc_tax_found, emc_tax_common_core

		} // foreach


	} // foreach

//////////////////////

	$found_args = array(
		'posts_per_page'    => 10,
		'post_type'         => 'emc_common_core', // emc_content_focus emc_common_core
	);
	$found = get_posts( $found_args );

	foreach( $found as $f ){
		$html .= get_the_title( $f->ID ) . '<br />';

		$related = get_post( $f->ID );

		$connected = get_posts( array(
			'connected_type'    => 'common_cores_to_posts', // content_foci_to_posts common_core_to_posts
			'connected_items'   => $related,
			'nopaging'          => true,
			'suppress_filters'  => false,
			'posts_per_page'    => -1,
		));
		$term_title = get_the_title( $f->ID );

		$term_id = wp_insert_term( $term_title, 'emc_tax_common_core' ); // emc_tax_found, emc_tax_common_core

		foreach( $connected as $c ){
			$html .= '&nbsp; &nbsp;' . get_the_title( $c->ID ) .'<br />';

			wp_set_post_terms( $c->ID, $term_id, 'emc_tax_common_core' ); // emc_tax_found, emc_tax_common_core
		} // foreach
	} // foreach
	return $html;
}
add_shortcode( 'converts', 'convert_this' );
function emc_browse(){
	// Additional content
	$text = get_page_by_path( 'filter-text', OBJECT, 'post' );
	if ( $text ) {
		$content = apply_filters( 'the_content', $text->post_content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		$html = '<div class="emc-fs-additional-content">';
		$html .= $content;
		$html .= '</div><!-- .emc-fs-additional-content -->';
		return $html;
	}
} // emc_browse
add_shortcode( 'browse_by_series', 'emc_browse' );

/**
 * Gets the related big ideas for the taxonomy term
 *
 * @since 1.1
 * @author SFNdesign, Curtis McHale
 */
function emc_related_big_ideas(){

	global $wp_query;
	$term = $wp_query->get_queried_object();

	$args = array(
		'post_type'         => 'emc_big_idea',
		'posts_per_page'    => -1,
		'tax_query'         => array(
			array(
				'taxonomy'      => $term->taxonomy,
				'field'         => 'slug',
				'terms'         => $term->slug,
			)
		)
	);
	$posts = get_posts( $args );

	if ( empty( $posts ) ) return;

	echo '<h2 class="emc-section-heading-posts">'. esc_html( 'Related Big Ideas', 'emc' ) .'</h2>';

	foreach( $posts as $p ){ ?>

		<article id="post-<?php echo $p->ID; ?>" <?php post_class( 'emc-related-post' ); ?>>
			<div class="emc-format">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/key.png" alt="<?php esc_attr_e( 'Key icon for Big Ideas', 'emc' ); ?>"/>
			</div>
			<h3 class="entry-title"><?php esc_html_e( 'Big Idea', 'emc' ); ?></h3>

			<div class="entry-content">
				<p><?php echo get_the_title( $p->ID ); ?> <a class="emc-learn-more" href="<?php echo get_permalink( $p->ID ); ?>"><?php esc_html_e( 'More', 'emc' ); ?></a>
			</div><!-- .entry-content -->
		</article>
	<?php
	}
}

/**
 * MODULES custom posts
 */
function custom_post_Module() {
	register_post_type( 'module',
		array('labels' => array(
			'name' => __('Modules', 'emc'),
			'singular_name' => __('Module', 'emc'),
			'all_items' => __('All Modules', 'emc'),
			'add_new' => __('Add New', 'emc'),
			'add_new_item' => __('Add New Module', 'emc'),
			'edit' => __( 'Edit', 'emc' ),
			'edit_item' => __('Edit Module', 'emc'),
			'new_item' => __('New Module', 'emc'),
			'view_item' => __('View Module', 'emc'),
			'search_items' => __('Search Modules', 'emc'),
			'not_found' =>  __('Nothing found in the Database.', 'emc'),
			'not_found_in_trash' => __('Nothing found in Trash', 'emc'),
			'parent_item_colon' => ''
			),
			'description' => __( 'This is the example Module', 'emc' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 4,
			'menu_icon' => get_stylesheet_directory_uri() . '/img/emc.png',
			'rewrite'	=> array( 'slug' => 'modules', 'with_front' => false ),
			'has_archive' => 'modules',
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array( 'title', 'category', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	)
	);
	//register_taxonomy_for_object_type('category', 'research');
	//register_taxonomy_for_object_type('post_tag', 'research');
}
	add_action( 'init', 'custom_post_Module');

/**
 * MEASURES custom posts
 *
 * @since 1.6
 * @author Bogdan Dragomir, bogdandragomir.com
 */
function custom_post_Measure() {
	register_post_type( 'measures',
		array('labels' => array(
			'name' => __('Measures', 'emc'),
			'singular_name' => __('Measure', 'emc'),
			'all_items' => __('All Measures', 'emc'),
			'add_new' => __('Add New', 'emc'),
			'add_new_item' => __('Add New Measure', 'emc'),
			'edit' => __( 'Edit', 'emc' ),
			'edit_item' => __('Edit Measure', 'emc'),
			'new_item' => __('New Measure', 'emc'),
			'view_item' => __('View Measure', 'emc'),
			'search_items' => __('Search Measure', 'emc'),
			'not_found' =>  __('Nothing found in the Database.', 'emc'),
			'not_found_in_trash' => __('Nothing found in Trash', 'emc'),
			'parent_item_colon' => ''
			),
			'description' => __( 'This is the example Measure', 'emc' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5,
			'menu_icon' => get_stylesheet_directory_uri() . '/img/emc.png',
			'rewrite'	=> array( 'slug' => 'measures', 'with_front' => false ),
			'has_archive' => 'measures',
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'category', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	)
	);
}
	add_action( 'init', 'custom_post_Measure');
	/**
 * PUBLICATIONS custom posts
 *
 * @since 1.6
 * @author Bogdan Dragomir, bogdandragomir.com
 */
function custom_post_Publications() {
	register_post_type( 'publication',
		array('labels' => array(
			'name' => __('Publications', 'emc'),
			'singular_name' => __('Publication', 'emc'),
			'all_items' => __('All Researches', 'emc'),
			'add_new' => __('Add New', 'emc'),
			'add_new_item' => __('Add New Publication', 'emc'),
			'edit' => __( 'Edit', 'emc' ),
			'edit_item' => __('Edit Publication', 'emc'),
			'new_item' => __('New Publication', 'emc'),
			'view_item' => __('View Publication', 'emc'),
			'search_items' => __('Search Publication', 'emc'),
			'not_found' =>  __('Nothing found in the Database.', 'emc'),
			'not_found_in_trash' => __('Nothing found in Trash', 'emc'),
			'parent_item_colon' => ''
			),
			'description' => __( 'This is the example Publication', 'emc' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5,
			'menu_icon' => get_stylesheet_directory_uri() . '/img/emc.png',
			'rewrite'	=> array( 'slug' => 'publications', 'with_front' => false ),
			'has_archive' => 'publications',
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array( 'title', 'category', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	)
	);
	//register_taxonomy_for_object_type('category', 'reasearch');
	//register_taxonomy_for_object_type('post_tag', 'reasearch');
}
	add_action( 'init', 'custom_post_Publications');
/**
 * WORKING PAPERS custom posts
 *
 * @since 1.6
 * @author Bogdan Dragomir, bogdandragomir.com
 */
function custom_post_Workingpapers() {
	register_post_type( 'workingpapers',
		array('labels' => array(
			'name' => __('Working Papers', 'emc'),
			'singular_name' => __('Working Paper', 'emc'),
			'all_items' => __('All Working Papers', 'emc'),
			'add_new' => __('Add New', 'emc'),
			'add_new_item' => __('Add New Working Paper', 'emc'),
			'edit' => __( 'Edit', 'emc' ),
			'edit_item' => __('Edit Working Paper', 'emc'),
			'new_item' => __('New Working Paper', 'emc'),
			'view_item' => __('View Working Paper', 'emc'),
			'search_items' => __('Search Working Papers', 'emc'),
			'not_found' =>  __('Nothing found in the Database.', 'emc'),
			'not_found_in_trash' => __('Nothing found in Trash', 'emc'),
			'parent_item_colon' => ''
			),
			'description' => __( 'This is the example Working Paper', 'emc' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5,
			'menu_icon' => get_stylesheet_directory_uri() . '/img/emc.png',
			'rewrite'	=> array( 'slug' => 'working-papers', 'with_front' => false ),
			'has_archive' => 'working-papers',
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array( 'title', 'category', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	)
	);
	//register_taxonomy_for_object_type('category', 'reasearch');
	//register_taxonomy_for_object_type('post_tag', 'reasearch');
}
	add_action( 'init', 'custom_post_Workingpapers');
/**
 * RESEARCH PRESENTATIONS custom posts
 *
 * @since 1.6
 * @author Bogdan Dragomir, bogdandragomir.com
 */
function custom_post_Researchp() {
	register_post_type( 'researchp',
		array('labels' => array(
			'name' => __('Research Presentations', 'emc'),
			'singular_name' => __('Research Presentation', 'emc'),
			'all_items' => __('All Research Presentations', 'emc'),
			'add_new' => __('Add New', 'emc'),
			'add_new_item' => __('Add New Research Presentation', 'emc'),
			'edit' => __( 'Edit', 'emc' ),
			'edit_item' => __('Edit Research Presentation', 'emc'),
			'new_item' => __('New Research Presentation', 'emc'),
			'view_item' => __('View Research Presentation', 'emc'),
			'search_items' => __('Search Research Presentations', 'emc'),
			'not_found' =>  __('Nothing found in the Database.', 'emc'),
			'not_found_in_trash' => __('Nothing found in Trash', 'emc'),
			'parent_item_colon' => ''
			),
			'description' => __( 'This is the example Research Presentation', 'emc' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5,
			'menu_icon' => get_stylesheet_directory_uri() . '/img/emc.png',
			'rewrite'	=> array( 'slug' => 'research-presentations', 'with_front' => false ),
			'has_archive' => 'research-presentations',
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array( 'title', 'category', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	)
	);
	//register_taxonomy_for_object_type('category', 'reasearch');
	//register_taxonomy_for_object_type('post_tag', 'reasearch');
}
	add_action( 'init', 'custom_post_Researchp');
/**
 * CONTENT PRESENTATIONS custom posts
 *
 * @since 1.6
 * @author Bogdan Dragomir, bogdandragomir.com
 */
function custom_post_Contentp() {
	register_post_type( 'contentp',
		array('labels' => array(
			'name' => __('Teacher Education Presentations', 'emc'),
			'singular_name' => __('Teacher Education Presentation', 'emc'),
			'all_items' => __('All Teacher Education Presentations', 'emc'),
			'add_new' => __('Add New', 'emc'),
			'add_new_item' => __('Add New Teacher Education Presentation', 'emc'),
			'edit' => __( 'Edit', 'emc' ),
			'edit_item' => __('Edit Teacher Education Presentation', 'emc'),
			'new_item' => __('New Teacher Education Presentation', 'emc'),
			'view_item' => __('View Teacher Education Presentation', 'emc'),
			'search_items' => __('Search Teacher Education Presentations', 'emc'),
			'not_found' =>  __('Nothing found in the Database.', 'emc'),
			'not_found_in_trash' => __('Nothing found in Trash', 'emc'),
			'parent_item_colon' => ''
			),
			'description' => __( 'This is the example Teacher Education Presentation', 'emc' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5,
			'menu_icon' => get_stylesheet_directory_uri() . '/img/emc.png',
			'rewrite'	=> array( 'slug' => 'teacher-education-presentations', 'with_front' => false ),
			'has_archive' => 'teacher-education-presentations',
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array( 'title', 'category', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	)
	);
	//register_taxonomy_for_object_type('category', 'reasearch');
	//register_taxonomy_for_object_type('post_tag', 'reasearch');
}
	add_action( 'init', 'custom_post_Contentp');
/**
 * CONTENT PRESENTATIONS custom posts
 *
 * @since 1.6
 * @author Bogdan Dragomir, bogdandragomir.com
 */
function custom_post_Conference() {
	register_post_type( 'conference',
		array('labels' => array(
			'name' => __('Conferences', 'emc'),
			'singular_name' => __('Conference', 'emc'),
			'all_items' => __('All Conferences', 'emc'),
			'add_new' => __('Add New', 'emc'),
			'add_new_item' => __('Add New Conference', 'emc'),
			'edit' => __( 'Edit', 'emc' ),
			'edit_item' => __('Edit Conference', 'emc'),
			'new_item' => __('New Conference', 'emc'),
			'view_item' => __('View Conference', 'emc'),
			'search_items' => __('Search Conferences', 'emc'),
			'not_found' =>  __('Nothing found in the Database.', 'emc'),
			'not_found_in_trash' => __('Nothing found in Trash', 'emc'),
			'parent_item_colon' => ''
			),
			'description' => __( 'This is the example Conference', 'emc' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5,
			'menu_icon' => get_stylesheet_directory_uri() . '/img/emc.png',
			'rewrite'	=> array( 'slug' => 'conferences', 'with_front' => false ),
			'has_archive' => 'conferences',
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array( 'title', 'category', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	)
	);
	//register_taxonomy_for_object_type('category', 'reasearch');
	//register_taxonomy_for_object_type('post_tag', 'reasearch');
}
	add_action( 'init', 'custom_post_Conference');

/**
 * ADD CUSTOM CSS TO ADMIN AREA
 *
 * @since 1.6
 * @author Bogdan Dragomir, bogdandragomir.com
 */
add_action('admin_head', 'my_custom_css');
function my_custom_css() {
  echo '<style>
    body, td, textarea, input, select {
      font-family: "Lucida Grande";
      font-size: 12px;
    }
    #wpcontent #acf-field-citation_authors {
    height:277px;
  }
  </style>';
}
/**
 * CHANGE AUTHORS SLUG NAME
 *
 * @since 1.6
 * @author Bogdan Dragomir, bogdandragomir.com
 */

add_action('init', 'cng_author_base');
function cng_author_base() {
    global $wp_rewrite;
    $author_slug = 'collaborators'; // change slug name
    $wp_rewrite->author_base = $author_slug;
}
add_filter( 'request', 'wpse5742_request' );
function wpse5742_request( $query_vars )
{
    if ( array_key_exists( 'author_name', $query_vars ) ) {
        global $wpdb;
        $author_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='nickname' AND meta_value = %s", $query_vars['author_name'] ) );
        if ( $author_id ) {
            $query_vars['author'] = $author_id;
            unset( $query_vars['author_name'] );
        }
    }
    return $query_vars;
}
add_filter( 'author_link', 'wpse5742_author_link', 10, 3 );
function wpse5742_author_link( $link, $author_id, $author_nicename )
{
    $author_nickname = get_user_meta( $author_id, 'nickname', true );
    if ( $author_nickname ) {
        $link = str_replace( $author_nicename, $author_nickname, $link );
    }
    return $link;
}
add_action( 'user_profile_update_errors', 'wpse5742_set_user_nicename_to_nickname', 10, 3 );
function wpse5742_set_user_nicename_to_nickname( &$errors, $update, &$user )
{
    if ( ! empty( $user->nickname ) ) {
        $user->user_nicename = sanitize_title( $user->nickname, $user->display_name );
    }
}
/**
 * ADMIN LOAD CHOSEN
 *
 * @since 1.6
 * @author Bogdan Dragomir, bogdandragomir.com
 */

function pw_load_scripts($hook) {

	// if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' )
		// return;

	wp_enqueue_script( 'chosenlib-js', get_bloginfo('template_url').'/js/chosen/chosen.jquery.min.js', array('jquery'));
	wp_enqueue_script( 'chosen-js', get_bloginfo('template_url').'/js/chosen/chosen.js', array('jquery'));
	wp_enqueue_script( 'admin-js', get_bloginfo('template_url').'/js/admin.js', array('jquery'));
	wp_enqueue_style( 'chosencss', get_template_directory_uri() .'/js/chosen/chosen.min.css');
}
add_action('admin_enqueue_scripts', 'pw_load_scripts');
/**
 * ADDS CUSTOM REDIRECT TO NEW USER ROLES
 *
 * @since 1.6
 * @author Bogdan Dragomir, bogdandragomir.com
 */

function redirect_user_on_role()
{
	global $current_user;
     	get_currentuserinfo();

     	if (current_user_can( '_Instructor' ))
     	{
        	wp_redirect( home_url() ); exit;
     	}
 	//If login user role is Contributor
 	else if (current_user_can( '_Instructor' ))
     	{
        	wp_redirect( home_url() ); exit;
     	}
	else
     	{
      		$redirect_to = 'http://google.com/';
        	return $redirect_to;
 	}
}
//add_action('admin_init','redirect_user_on_role');
//Filter select post types and tags out of main query
function filterPostQuery( $post_ids, $class ) {
	//Remove posts by type
	$exclude_types = array('emc_big_idea');
	foreach ($post_ids as $key => $id) {
		$post_obj = get_post($post_ids[$key]);
		if (in_array($post_obj->post_type, $exclude_types)) {
			unset($post_ids[$key]);
			continue;
		}
	//Remove posts by tags
	$exclude_tags = array('slider');
		$post_tags = get_the_tags($post_ids[$key]);
		if ($post_tags) {
			foreach($post_tags as $tag) {
				if (in_array($tag->slug, $exclude_tags)) {
					unset($post_ids[$key]);
				}
			}
		}
	}
	return $post_ids;
}
add_filter('facetwp_filtered_post_ids', 'filterPostQuery', 10, 2);

/**
 * Add FacetWP functionality to pages
 */
function my_facetwp_is_main_query( $is_main_query, $query ) {
    if ( isset( $query->query_vars['facetwp'] ) ) {
        $is_main_query = true;
    }
    return $is_main_query;
}
add_filter( 'facetwp_is_main_query', 'my_facetwp_is_main_query', 10, 2 );


//https://searchwp.com/docs/hooks/searchwp_minimum_word_length/
function my_searchwp_minimum_word_length() {
  return 1;
}
add_filter( 'searchwp_minimum_word_length', 'my_searchwp_minimum_word_length' );


/**
 * Add taxonomy to Swiftype faceted search
 */
function update_swiftype_document_url( $document, $post ) {
    $document['fields'][] = array( 'name' => 'emc_content_format',
                                   'type' => 'enum',
                                   'value' => wp_get_post_terms( $post->ID , 'emc_content_format', array('fields' => 'names')));
    $document['fields'][] = array( 'name' => 'emc_grade_level',
                                   'type' => 'enum',
                                   'value' => wp_get_post_terms( $post->ID , 'emc_grade_level', array('fields' => 'names')));
    $document['fields'][] = array( 'name' => 'emc_tax_found',
                                   'type' => 'enum',
                                   'value' => wp_get_post_terms( $post->ID , 'emc_tax_found', array('fields' => 'names')));
    $document['fields'][] = array( 'name' => 'emc_tax_common_core',
                                   'type' => 'enum',
                                   'value' => wp_get_post_terms( $post->ID , 'emc_tax_common_core', array('fields' => 'names')));
    return $document;
}

add_filter( 'swiftype_document_builder', 'update_swiftype_document_url', 10, 2 );

/**
 * Faceted search functionality for Swiftype
 */
function swiftype_search_params_filter( $params ) {
    $params['facets[posts]'] = array( 'category', 'emc_content_format', 'emc_grade_level', 'emc_tax_found', 'emc_tax_common_core' );
    return $params;
}

add_filter( 'swiftype_search_params', 'swiftype_search_params_filter', 8, 1 );

/**
 * Shortcode to place search form on the page
 */
function embed_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </div>
    </form>';

    return $form;
}
add_shortcode('embedded_search_form', 'embed_search_form');


/**
 * Add body class based on user role
 */
add_filter('body_class','add_role_to_body');
function add_role_to_body($classes) {
    $current_user = new WP_User(get_current_user_id());
    $user_role = array_shift($current_user->roles);
    $classes[] = 'role-'. $user_role;
    return $classes;
}

//==================================================

// Add Formats Dropdown Menu To MCE
if ( ! function_exists( 'wpex_style_select' ) ) {
  function wpex_style_select( $buttons ) {
    array_push( $buttons, 'styleselect' );
    return $buttons;
  }
}
add_filter( 'mce_buttons_3', 'wpex_style_select' );

//==================================================

// Add new styles to the TinyMCE options
function my_mce_before_init_insert_formats( $init_array ) {
  // Define the style_formats array
  $style_formats = array(
    array(
      'title'     => 'Download PDF Button',
      'inline'    => 'strong',
      'classes'   => 'mod-i-block-btn'
    ),
    array(
      'title'     => 'Intro Block',
      'block'			=> 'div',
      'classes'   => 'mod-details-block',
      'wrapper'   => true
    ),
  );
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );

  return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

//==================================================

// Module callout box shortcode
function module_callout_box_function($atts, $content, $tag){
	return '<div class="mod-section-block-callout">' .  do_shortcode($content) . '</div>';
}
add_shortcode('callout_box','module_callout_box_function');

//==================================================

// init process for registering our button
 add_action('init', 'wpse72394_shortcode_button_init');
 function wpse72394_shortcode_button_init() {

      //Abort early if the user will never see TinyMCE
      if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
           return;

      //Add a callback to regiser our tinymce plugin
      add_filter("mce_external_plugins", "wpse72394_register_tinymce_plugin");

      // Add a callback to add our button to the TinyMCE toolbar
      add_filter('mce_buttons', 'wpse72394_add_tinymce_button');
}


//This callback registers our plug-in
function wpse72394_register_tinymce_plugin($plugin_array) {
    $plugin_array['wpse72394_button'] = get_template_directory_uri() . '/js/callout_box.js';
    return $plugin_array;
}

//This callback adds our button to the toolbar
function wpse72394_add_tinymce_button($buttons) {
            //Add the button ID to the $button array
    $buttons[] = "wpse72394_button";
    return $buttons;
}


