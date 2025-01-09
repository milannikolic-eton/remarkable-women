<?php
/*
 *  Author: EtonDigital
 *  Url: https://www.etondigital.com/
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/
require_once(get_template_directory() . '/includes/cpt.php');
require_once(get_template_directory() . '/includes/optimize.php');

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

/*function mytheme_gutenberg_colors() {
    // Fetch CSS variables via PHP
    echo '<style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --accent-color: #e74c3c;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
        }
    </style>';

    // Add theme support for custom colors in Gutenberg
    add_theme_support( 'editor-color-palette', [
        [
            'name'  => __( 'Primary', 'mytheme' ),
            'slug'  => 'primary',
            'color' => 'var(--primary-color)',
        ],
        [
            'name'  => __( 'Secondary', 'mytheme' ),
            'slug'  => 'secondary',
            'color' => 'var(--secondary-color)',
        ],
        [
            'name'  => __( 'Accent', 'mytheme' ),
            'slug'  => 'accent',
            'color' => 'var(--accent-color)',
        ],
        [
            'name'  => __( 'Dark', 'mytheme' ),
            'slug'  => 'dark',
            'color' => 'var(--dark-color)',
        ],
        [
            'name'  => __( 'Light', 'mytheme' ),
            'slug'  => 'light',
            'color' => 'var(--light-color)',
        ],
    ] );
}
add_action( 'after_setup_theme', 'mytheme_gutenberg_colors' );*/
function enqueue_typekit_fonts()
{
    wp_enqueue_style(
        'typekit-fonts', // Handle for the style
        'https://use.typekit.net/lmp0uwh.css', // URL to the Typekit stylesheet
        array(), // Dependencies
        null // Version (null to prevent appending version)
    );
}
add_action('wp_enqueue_scripts', 'enqueue_typekit_fonts');


if (function_exists('add_theme_support')) {
    // Add support for editor color palette.
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Primary', 'mytheme'),
            'slug' => 'primary',
            'color' => '#0073aa',
        ),
        array(
            'name' => __('Secondary', 'mytheme'),
            'slug' => 'secondary',
            'color' => '#005177',
        ),
        array(
            'name' => __('Accent', 'mytheme'),
            'slug' => 'accent',
            'color' => '#f78da7',
        ),
        array(
            'name' => __('Light Gray', 'mytheme'),
            'slug' => 'light-gray',
            'color' => '#f0f0f0',
        ),
        array(
            'name' => __('Dark Gray', 'mytheme'),
            'slug' => 'dark-gray',
            'color' => '#333333',
        ),
    ));
    // Add Menu Support
    add_theme_support('menus');

    add_theme_support('align-wide');

    add_theme_support('title-tag');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('grid-item', 355, 580, true);
    // add_image_size('medium-thumb', 350, '', true);
    //  add_image_size('hero', 1920, 700, true);
    // add_image_size('half-column', 540, 540, true);

    // Enables post and comment RSS feed links to head
    // add_theme_support('automatic-feed-links');

    add_theme_support(
        'custom-logo',
        array(
            'height' => 36,
            'width' => 220,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
}






add_filter('image_size_names_choose', 'my_custom_sizes');

function my_custom_sizes($sizes)
{
    return array_merge($sizes, array(
        'grid-item' => __('Grid item'),
        //'medium-thumb' => __('Medium Thumb')
    ));
}



/*
function change_cover_block_featured_image( $block_content, $block ) {
    // Check if the block is a Cover block and has a featured image
    if ( isset( $block['blockName'] ) && $block['blockName'] === 'core/cover' ) {
        // Find the featured image URL in the block content
        if ( has_post_thumbnail() ) {
            // Get the URL of a specific thumbnail size (e.g., 'medium')
            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'hero' );

            // Replace the full image URL with the thumbnail URL
            $block_content = str_replace( wp_get_attachment_url( get_post_thumbnail_id() ), $thumbnail_url, $block_content );
        }
    }

    return $block_content;
}
add_filter( 'render_block', 'change_cover_block_featured_image', 10, 2 );*/

function change_cover_block_thumbnail($block_content, $block)
{
    // Only apply to the Cover block
    if (isset($block['blockName']) && $block['blockName'] === 'core/cover') {
        // Get the post's featured image ID
        $featured_image_id = get_post_thumbnail_id(get_the_ID());

        if ($featured_image_id) {
            // Check if the "hero" thumbnail size exists
            $hero_thumbnail = wp_get_attachment_image_src($featured_image_id, 'hero');

            if ($hero_thumbnail) {
                // Replace the original image with the "hero" thumbnail in the block content
                $full_image_url = wp_get_attachment_url($featured_image_id);
                $block_content = str_replace($full_image_url, $hero_thumbnail[0], $block_content);
            }
        }
    }

    return $block_content;
}
add_filter('render_block', 'change_cover_block_thumbnail', 10, 2);


/*------------------------------------*\
    Enqueue scripts
\*------------------------------------*/

function theme_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        global $post;

        wp_register_script('themescripts', get_template_directory_uri() . '/assets/js/general.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('themescripts'); // Enqueue it!


        wp_register_style('main-theme-css', get_template_directory_uri() . '/style.min.css', array(), '1.0', 'all');
        wp_enqueue_style('main-theme-css'); // Enqueue it!

      //  if (isset($post->post_content) && has_shortcode($post->post_content, 'stories_slider')) {
            wp_register_script('swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', '', '1.0.0');
            wp_enqueue_script('swiper');

            wp_register_style('swiper-css', get_template_directory_uri() . '/assets/css/swiper.min.css', array(), '1.0', 'all');
            wp_enqueue_style('swiper-css'); // Enqueue it!

      //  }

        // Custom JS for initializing Swiper
        wp_enqueue_script('custom-swiper', get_template_directory_uri() . '/assets/js/custom-swiper.js', ['swiper'], '1.0', true);

        if (isset($post->post_content) && has_shortcode($post->post_content, 'stories_filter')) {
            wp_enqueue_script('stories-filter', get_template_directory_uri() . '/assets/js/stories-filter.js', ['jquery'], null, true);

            wp_localize_script('stories-filter', 'ajax_stories', [
                'ajax_url' => admin_url('admin-ajax.php'),
            ]);

        }


        if (isset($post->post_content) && has_shortcode($post->post_content, 'voice_posts')) {

            wp_enqueue_script('load-more-voice', get_template_directory_uri() . '/assets/js/load-more-voice.js', ['jquery'], null, true);

            wp_localize_script('load-more-voice', 'load_more_params', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'security' => wp_create_nonce('load_more_nonce'),
            ]);

        }


        // Enqueue Lenis script from CDN with defer attribute.
        wp_enqueue_script(
            'lenis', // Handle for the script.
            'https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.10/bundled/lenis.min.js', // Script URL.
            array(), // Dependencies (none in this case).
            null, // Version (null will use the current version).
            true // Load in the footer.
        );

        // Add the defer attribute.
        add_filter('script_loader_tag', function ($tag, $handle) {
            if ('lenis' === $handle) {
                return str_replace(' src', ' defer="defer" src', $tag);
            }
            return $tag;
        }, 10, 2);


    }
}
add_action('wp_enqueue_scripts', 'theme_scripts');


/*------------------------------------*\
    CONVERT THUMBNAILS TO WEBP
\*------------------------------------*/
add_filter('image_editor_output_format', function ($formats) {
    $formats['image/jpeg'] = 'image/webp';
    $formats['image/png'] = 'image/webp';

    return $formats;
});



add_filter('upload_mimes', 'rudr_svg_upload_mimes');

function rudr_svg_upload_mimes($mimes)
{

    // it is recommended to uncomment these lines for security reasons
    // if( ! current_user_can( 'administrator' ) ) {
    // 	return $mimes;
    // }

    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';

    return $mimes;

}

add_filter('wp_check_filetype_and_ext', 'rudr_svg_filetype_ext', 10, 5);

function rudr_svg_filetype_ext($data, $file, $filename, $mimes, $real_mime)
{

    if (!$data['type']) {

        $filetype = wp_check_filetype($filename, $mimes);
        $type = $filetype['type'];
        $ext = $filetype['ext'];

        if ($type && 0 === strpos($type, 'image/') && 'svg' !== $ext) {
            $ext = false;
            $type = false;
        }

        $data = array(
            'ext' => $ext,
            'type' => $type,
            'proper_filename' => $data['proper_filename'],
        );

    }

    return $data;

}
/*------------------------------------*\
    NAVIGATION
\*------------------------------------*/
function header_nav()
{
    wp_nav_menu(
        array(
            'theme_location' => 'header-menu',
            'menu' => '',
            'container' => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id' => '',
            'menu_class' => 'menu',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul>%3$s</ul>',
            'depth' => 0,
            'walker' => ''
        )
    );
}


// Register Navigation
function register_theme_menus()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'greentheme'), // Main Navigation
        'secondary-menu' => __('Secondary Menu', 'greentheme'), // Secondary menu
        'footer-menu' => __('Footer Menu', 'greentheme'), // Footer menu
        'footer-menu2' => __('Footer Bottom Menu', 'greentheme'), // Footer bottom Navigation

    ));
}
add_action('init', 'register_theme_menus');

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation


/* * * Walker for the main menu * */
add_filter('walker_nav_menu_start_el', 'add_arrow', 10, 4);
function add_arrow($output, $item, $depth, $args)
{
    //Only add class to 'top level' items on the 'primary' menu. 
    if ('header-menu' == $args->theme_location && ($depth === 0 || $depth === 1) || 'secondary-menu' == $args->theme_location && $depth === 0) {
        if (in_array("menu-item-has-children", $item->classes)) {
            $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
  <path d="M16.2766 9.45312H8.38324C7.74324 9.45312 7.42324 10.2265 7.87658 10.6798L11.3299 14.1331C11.8833 14.6865 12.7833 14.6865 13.3366 14.1331L16.7899 10.6798C17.2366 10.2265 16.9166 9.45312 16.2766 9.45312Z" fill="white"/>
</svg>
';
        }
    }
    return $output;
}


/**
 * Add svg icons to facebook, linkedin and instagram in navigation menu
 */
function add_svg_to_menu_item($items, $args)
{
    // Loop through menu items
    foreach ($items as &$item) {
        // Check if the menu item has the 'facebook' class
        if (in_array('facebook', $item->classes)) {
            // Add the SVG before the menu item title
            $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
  <g clip-path="url(#clip0_1266_638)">
    <path d="M15.8906 0.5H2.10938C0.946198 0.5 0 1.4462 0 2.60938V16.3906C0 17.5538 0.946198 18.5 2.10938 18.5H15.8906C17.0538 18.5 18 17.5538 18 16.3906V2.60938C18 1.4462 17.0538 0.5 15.8906 0.5ZM16.5938 16.3906C16.5938 16.7783 16.2783 17.0938 15.8906 17.0938H11.7422V11.9609H13.9931L14.2554 9.78125H11.7422V7.42578C11.7422 6.82455 12.1956 6.37109 12.7969 6.37109H14.3789V4.33203C13.9625 4.27325 13.1593 4.19141 12.7969 4.19141C11.9769 4.19141 11.155 4.53734 10.5419 5.14035C9.91035 5.76163 9.5625 6.57544 9.5625 7.43196V9.78125H7.27734V11.9609H9.5625V17.0938H2.10938C1.72169 17.0938 1.40625 16.7783 1.40625 16.3906V2.60938C1.40625 2.22169 1.72169 1.90625 2.10938 1.90625H15.8906C16.2783 1.90625 16.5938 2.22169 16.5938 2.60938V16.3906Z" fill="#101223"/>
  </g>
  <defs>
    <clipPath id="clip0_1266_638">
      <rect width="18" height="18" fill="white" transform="translate(0 0.5)"/>
    </clipPath>
  </defs>
</svg>';
            $item->title = $svg_icon . ' ' . $item->title;
        } elseif (in_array('instagram', $item->classes)) {
            // Add the SVG before the menu item title
            $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
  <g clip-path="url(#clip0_1266_646)">
    <path d="M13.5 0.5H4.5C1.98 0.5 0 2.48 0 5V14C0 16.52 1.98 18.5 4.5 18.5H13.5C16.02 18.5 18 16.52 18 14V5C18 2.48 16.02 0.5 13.5 0.5ZM16.2 14C16.2 15.53 15.03 16.7 13.5 16.7H4.5C2.97 16.7 1.8 15.53 1.8 14V5C1.8 3.47 2.97 2.3 4.5 2.3H13.5C15.03 2.3 16.2 3.47 16.2 5V14Z" fill="#101223"/>
    <path d="M9 5C6.48 5 4.5 6.98 4.5 9.5C4.5 12.02 6.48 14 9 14C11.52 14 13.5 12.02 13.5 9.5C13.5 6.98 11.52 5 9 5ZM9 12.2C7.47 12.2 6.3 11.03 6.3 9.5C6.3 7.97 7.47 6.8 9 6.8C10.53 6.8 11.7 7.97 11.7 9.5C11.7 11.03 10.53 12.2 9 12.2Z" fill="#101223"/>
    <path d="M13.4996 5.89961C13.9967 5.89961 14.3996 5.49667 14.3996 4.99961C14.3996 4.50255 13.9967 4.09961 13.4996 4.09961C13.0026 4.09961 12.5996 4.50255 12.5996 4.99961C12.5996 5.49667 13.0026 5.89961 13.4996 5.89961Z" fill="#101223"/>
  </g>
  <defs>
    <clipPath id="clip0_1266_646">
      <rect width="18" height="18" fill="white" transform="translate(0 0.5)"/>
    </clipPath>
  </defs>
</svg>';
            $item->title = $svg_icon . ' ' . $item->title;
        } elseif (in_array('linkedin', $item->classes)) {
            // Add the SVG before the menu item title
            $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
  <g clip-path="url(#clip0_1266_642)">
    <path d="M5.62527 15.3711H3.16434V7.42578H5.62527V15.3711ZM5.87082 4.89439C5.87082 4.09885 5.22537 3.45312 4.43024 3.45312C3.63208 3.45312 2.98828 4.09885 2.98828 4.89439C2.98828 5.69022 3.63208 6.33594 4.43024 6.33594C5.22537 6.33594 5.87082 5.69022 5.87082 4.89439ZM14.8359 10.9999C14.8359 8.86705 14.3854 7.28516 11.8938 7.28516C10.6966 7.28516 9.89291 7.88391 9.56483 8.50656H9.5625V7.42578H7.17188V15.3711H9.5625V11.4262C9.5625 10.3931 9.82549 9.3922 11.1061 9.3922C12.3692 9.3922 12.4102 10.5736 12.4102 11.4918V15.3711H14.8359V10.9999ZM18 16.3906V2.60938C18 1.4462 17.0538 0.5 15.8906 0.5H2.10938C0.946198 0.5 0 1.4462 0 2.60938V16.3906C0 17.5538 0.946198 18.5 2.10938 18.5H15.8906C17.0538 18.5 18 17.5538 18 16.3906ZM15.8906 1.90625C16.2783 1.90625 16.5938 2.22169 16.5938 2.60938V16.3906C16.5938 16.7783 16.2783 17.0938 15.8906 17.0938H2.10938C1.72169 17.0938 1.40625 16.7783 1.40625 16.3906V2.60938C1.40625 2.22169 1.72169 1.90625 2.10938 1.90625H15.8906Z" fill="#101223"/>
  </g>
  <defs>
    <clipPath id="clip0_1266_642">
      <rect width="18" height="18" fill="white" transform="translate(0 0.5)"/>
    </clipPath>
  </defs>
</svg>';
            $item->title = $svg_icon . ' ' . $item->title;
        }
    }

    return $items;
}
add_filter('wp_nav_menu_objects', 'add_svg_to_menu_item', 10, 2);

/*------------------------------------*\
    EXTEND NAV WAKLER FOR MOBILE MEGA MENU
\*------------------------------------*/
class dynamicSubMenu extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu-wrap'><ul class='sub-menu'>\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }


} //class


/*------------------------------------*\
    WIDGETS
\*------------------------------------*/
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Footer top', 'greentheme'),
        'description' => __('Description for this widget-area...', 'greentheme'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}


// Add page slug to body class
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}
add_filter('body_class', 'add_slug_to_body_class');





/*------------------------------------*\
    COMMENTS
\*------------------------------------*/
// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function greenthemecomments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?>     <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?>
        id="comment-<?php comment_ID() ?>">
        <?php if ('div' != $args['style']): ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
            <?php endif; ?>
            <div class="comment-author vcard">
                <?php if ($args['avatar_size'] != 0)
                    echo get_avatar($comment, $args['180']); ?>
                <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
            </div>
            <?php if ($comment->comment_approved == '0'): ?>
                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
                <br />
            <?php endif; ?>

            <div class="comment-meta commentmetadata"><a
                    href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
                    <?php
                    printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'), '  ', '');
                       ?>
            </div>

            <?php comment_text() ?>

            <div class="reply">
                <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <?php if ('div' != $args['style']): ?>
            </div>
        <?php endif; ?>
    <?php }



// hide admin header for everyone except the admins
if (!current_user_can('manage_options')) {
    add_filter('show_admin_bar', '__return_false');
}


/*------------------------------------*\
    Add acf options page
\*------------------------------------*/
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme options',
        'menu_title' => 'Theme options',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'update_core',
        'redirect' => false
    ));

}

//custom gutenberg blocks
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // register logos slider block.
        acf_register_block_type(array(
            'name' => 'stories',
            'title' => __('Stories block'),
            'description' => __('Stories block'),
            'render_template' => 'template-parts/blocks/stories-block.php',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array('Stories block with filter', 'rwwt'),
        ));
    }



    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // register logos slider block.
        acf_register_block_type(array(
            'name' => 'latest_posts',
            'title' => __('Latest posts block'),
            'description' => __('Latest posts block'),
            'render_template' => 'template-parts/latest-posts.php',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array('Latest posts block', 'ecoverde'),
        ));
    }


    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // register logos slider block.
        acf_register_block_type(array(
            'name' => 'accordions',
            'title' => __('Accordions'),
            'description' => __('Accordions section'),
            'render_template' => 'template-parts/blocks/accordions.php',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array('Accordions', 'ecoverde'),
        ));
    }



}


/*------------------------------------*\
    CF7
\*------------------------------------*/
//remove p from cf7
add_filter('wpcf7_autop_or_not', '__return_false');


// turn off cf7 scripts where you don't need them
add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');
add_action('wp_head', function () {
    global $post;
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'contact-form-7')) {
        wpcf7_enqueue_scripts();
        wpcf7_enqueue_styles();
    } else {
        wp_dequeue_script('google-recaptcha');
        wp_deregister_script('google-recaptcha');
    }
});

/*------------------------------------*\
    PAGINATION
\*------------------------------------*/
function greentheme_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'mid_size' => 2,
        'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M14.8334 10.2333L11.0084 6.40834C10.8523 6.25313 10.6411 6.16602 10.4209 6.16602C10.2008 6.16602 9.98955 6.25313 9.83341 6.40834C9.75531 6.48581 9.69331 6.57798 9.651 6.67953C9.6087 6.78108 9.58691 6.89 9.58691 7.00001C9.58691 7.11002 9.6087 7.21894 9.651 7.32049C9.69331 7.42204 9.75531 7.51421 9.83341 7.59168L13.6667 11.4083C13.7449 11.4858 13.8068 11.578 13.8492 11.6795C13.8915 11.7811 13.9132 11.89 13.9132 12C13.9132 12.11 13.8915 12.2189 13.8492 12.3205C13.8068 12.422 13.7449 12.5142 13.6667 12.5917L9.83341 16.4083C9.67649 16.5642 9.5879 16.7759 9.58712 16.9971C9.58633 17.2182 9.67343 17.4306 9.82925 17.5875C9.98506 17.7444 10.1968 17.833 10.418 17.8338C10.6391 17.8346 10.8515 17.7475 11.0084 17.5917L14.8334 13.7667C15.3016 13.2979 15.5645 12.6625 15.5645 12C15.5645 11.3375 15.3016 10.7021 14.8334 10.2333Z" fill="#262626"/>
</svg>',
        'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M14.8334 10.2333L11.0084 6.40834C10.8523 6.25313 10.6411 6.16602 10.4209 6.16602C10.2008 6.16602 9.98955 6.25313 9.83341 6.40834C9.75531 6.48581 9.69331 6.57798 9.651 6.67953C9.6087 6.78108 9.58691 6.89 9.58691 7.00001C9.58691 7.11002 9.6087 7.21894 9.651 7.32049C9.69331 7.42204 9.75531 7.51421 9.83341 7.59168L13.6667 11.4083C13.7449 11.4858 13.8068 11.578 13.8492 11.6795C13.8915 11.7811 13.9132 11.89 13.9132 12C13.9132 12.11 13.8915 12.2189 13.8492 12.3205C13.8068 12.422 13.7449 12.5142 13.6667 12.5917L9.83341 16.4083C9.67649 16.5642 9.5879 16.7759 9.58712 16.9971C9.58633 17.2182 9.67343 17.4306 9.82925 17.5875C9.98506 17.7444 10.1968 17.833 10.418 17.8338C10.6391 17.8346 10.8515 17.7475 11.0084 17.5917L14.8334 13.7667C15.3016 13.2979 15.5645 12.6625 15.5645 12C15.5645 11.3375 15.3016 10.7021 14.8334 10.2333Z" fill="#262626"/>
</svg>',
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}
add_action('init', 'greentheme_pagination');







//estimated reading time
function reading_time()
{
    $content = get_post_field('post_content', $post->ID);
    $word_count = str_word_count(strip_tags($content));
    $readingtime = ceil($word_count / 200);

    if ($readingtime == 1) {
        $timer = " minute";
    } else {
        $timer = " minutes";
    }
    $totalreadingtime = $readingtime . $timer;

    return $totalreadingtime;
}





/*** mobile picture for wp block cover ****/
add_action('enqueue_block_editor_assets', 'enqueue_responsive_cover', 100);

function enqueue_responsive_cover()
{
    $dir = get_template_directory_uri() . '/assets/js';
    wp_enqueue_script('my-cover', $dir . '/my-cover.js', ['wp-blocks', 'wp-dom'], null, true);
}

/*
add_filter('render_block_core/cover', 'my_responsive_cover_render', 10, 2);

function my_responsive_cover_render($content, $block) {
  // If the block has mobile and hero thumbnail images
  $mobile_image = isset($block['attrs']['mobileImageID']) ? $block['attrs']['mobileImageID'] : null; // Assuming 'mobileImageID' is the ID of the mobile image
  $hero_image = isset($block['attrs']['heroThumbnailURL']) ? $block['attrs']['heroThumbnailURL'] : null;

  if ($mobile_image || $hero_image) {
    // Build the <picture> tag
    $picture_tag = '<picture>';

    if ($hero_image) {
      // Hero image for screens wider than 782px
      $picture_tag .= "<source srcset='{$hero_image}' media='(min-width: 782px)'>";
    }

    if ($mobile_image) {
      // Get the large version of the mobile image
      $mobile_image_large = wp_get_attachment_image_src($mobile_image, 'large'); // Get large thumbnail version

      if (!empty($mobile_image_large)) {
        // Large version of mobile image for screens up to 781px
        $picture_tag .= "<source srcset='{$mobile_image_large[0]}' media='(max-width: 781px)'>";
      }
    }

    $picture_tag .= '$0</picture>'; // `$0` will be replaced with the original `<img>` tag

    // Replace the <img> tag in the cover block with the <picture> tag
    $content = preg_replace(
      '/<img class="wp-block-cover__image.+\/>/Ui',
      $picture_tag,
      $content
    );
  }

  return $content;
}

*/
add_filter('render_block_core/cover', 'my_responsive_cover_render', 10, 2);

function my_responsive_cover_render($content, $block)
{
    // If the block has a mobile image set
    if (isset($block['attrs']['mobileImageURL'])) {
        $mobileImage = $block['attrs']['mobileImageURL'];

        // Modify the content to insert the <picture> tag with mobile <source>
        $content = preg_replace(
            '/<img([^>]+)\/>/Ui',
            "<picture><source srcset='{$mobileImage}' media='(max-width:781px)' sizes='100vw'><img$1></picture>",
            $content
        );
    }

    return $content;
}


/*
add_filter('render_block_core/cover', 'my_responsive_cover_render', 10, 2);

function my_responsive_cover_render($content, $block) {
  // If has mobile image
  if (isset($block['attrs']['mobileImageURL'])) {
    $image = $block['attrs']['mobileImageURL'];
    $content = preg_replace(
      '/<img class="wp-block-cover__image.+\/>/Ui',
      "<picture><source srcset='{$image}' media='(max-width:781px)'>$0</picture>",
      $content
    );
  }

return $content;
}*/

//customize gutenberg blocks
add_action('init', 'my_register_cover_styles');
function my_register_cover_styles()
{
    register_block_style('core/button', [
        'name' => 'btn-outline-white',
        'label' => 'White outline button',
    ]);
    register_block_style('core/button', [
        'name' => 'btn-arrow',
        'label' => 'Button with arrow',
    ]);

}



// Disable users rest routes
/*add_filter('rest_endpoints', function( $endpoints ) {
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
});

*/




/// Customize social icons from gutenberg block
add_filter(
    'render_block',
    function ($block_content, $block) {
        if ('core/social-link' === $block['blockName'] && 'youtube' === $block['attrs']['service']) {
            $icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M23.0645 5.00484C22.1982 3.97501 20.5987 3.55493 17.5441 3.55493H6.45569C3.33112 3.55493 1.70454 4.00211 0.841471 5.09852C0 6.16753 0 7.74262 0 9.9226V14.0776C0 18.3009 0.9984 20.4452 6.45569 20.4452H17.5442C20.1931 20.4452 21.661 20.0745 22.6106 19.1657C23.5845 18.2337 24 16.712 24 14.0776V9.9226C24 7.62363 23.9349 6.03924 23.0645 5.00484ZM15.4081 12.5737L10.3729 15.2053C10.2603 15.2641 10.1372 15.2933 10.0143 15.2933C9.87507 15.2933 9.73618 15.2559 9.61316 15.1814C9.38152 15.041 9.24008 14.79 9.24008 14.5191V9.27289C9.24008 9.00255 9.38113 8.75171 9.61231 8.61127C9.84356 8.47083 10.1312 8.46123 10.3711 8.58587L15.4063 11.2005C15.6625 11.3335 15.8234 11.598 15.8237 11.8865C15.8241 12.1753 15.6639 12.4401 15.4081 12.5737Z" fill="white"/>
            </svg>';
            $before = explode('<svg', $block_content);
            $after = explode('</svg>', $before[1]);
            $block_content = $before[0] . $icon . $after[1];
        } elseif ('core/social-link' === $block['blockName'] && 'linkedin' === $block['attrs']['service']) {
            $icon = '<svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.875 0.5625H2.12012C1.26074 0.5625 0.5625 1.27051 0.5625 2.13965V20.8604C0.5625 21.7295 1.26074 22.4375 2.12012 22.4375H20.875C21.7344 22.4375 22.4375 21.7295 22.4375 20.8604V2.13965C22.4375 1.27051 21.7344 0.5625 20.875 0.5625ZM7.17383 19.3125H3.93164V8.87305H7.17871V19.3125H7.17383ZM5.55273 7.44727C4.5127 7.44727 3.67285 6.60254 3.67285 5.56738C3.67285 4.53223 4.5127 3.6875 5.55273 3.6875C6.58789 3.6875 7.43262 4.53223 7.43262 5.56738C7.43262 6.60742 6.59277 7.44727 5.55273 7.44727ZM19.3271 19.3125H16.085V14.2344C16.085 13.0234 16.0605 11.4658 14.4004 11.4658C12.7109 11.4658 12.4521 12.7842 12.4521 14.1465V19.3125H9.20996V8.87305H12.3203V10.2988H12.3643C12.7988 9.47852 13.8584 8.61426 15.4355 8.61426C18.7168 8.61426 19.3271 10.7773 19.3271 13.5898V19.3125Z" fill="#CECEEA"/>
            </svg>
            ';
            $before = explode('<svg', $block_content);
            $after = explode('</svg>', $before[1]);
            $block_content = $before[0] . $icon . $after[1];
        } elseif ('core/social-link' === $block['blockName'] && 'instagram' === $block['attrs']['service']) {
            $icon = '<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.5049 6.88452C9.39941 6.88452 6.89453 9.3894 6.89453 12.4949C6.89453 15.6003 9.39941 18.1052 12.5049 18.1052C15.6104 18.1052 18.1152 15.6003 18.1152 12.4949C18.1152 9.3894 15.6104 6.88452 12.5049 6.88452ZM12.5049 16.1423C10.498 16.1423 8.85742 14.5066 8.85742 12.4949C8.85742 10.4832 10.4932 8.84741 12.5049 8.84741C14.5166 8.84741 16.1523 10.4832 16.1523 12.4949C16.1523 14.5066 14.5117 16.1423 12.5049 16.1423ZM19.6533 6.65503C19.6533 7.38257 19.0674 7.96362 18.3447 7.96362C17.6172 7.96362 17.0361 7.37769 17.0361 6.65503C17.0361 5.93237 17.6221 5.34644 18.3447 5.34644C19.0674 5.34644 19.6533 5.93237 19.6533 6.65503ZM23.3691 7.98315C23.2861 6.23022 22.8857 4.67749 21.6016 3.39819C20.3223 2.1189 18.7695 1.71851 17.0166 1.63062C15.21 1.52808 9.79492 1.52808 7.98828 1.63062C6.24023 1.71362 4.6875 2.11401 3.40332 3.39331C2.11914 4.67261 1.72363 6.22534 1.63574 7.97827C1.5332 9.78491 1.5332 15.2 1.63574 17.0066C1.71875 18.7595 2.11914 20.3123 3.40332 21.5916C4.6875 22.8708 6.23535 23.2712 7.98828 23.3591C9.79492 23.4617 15.21 23.4617 17.0166 23.3591C18.7695 23.2761 20.3223 22.8757 21.6016 21.5916C22.8809 20.3123 23.2812 18.7595 23.3691 17.0066C23.4717 15.2 23.4717 9.78979 23.3691 7.98315ZM21.0352 18.9451C20.6543 19.9021 19.917 20.6394 18.9551 21.0251C17.5146 21.5964 14.0967 21.4646 12.5049 21.4646C10.9131 21.4646 7.49023 21.5916 6.05469 21.0251C5.09766 20.6443 4.36035 19.907 3.97461 18.9451C3.40332 17.5046 3.53516 14.0867 3.53516 12.4949C3.53516 10.9031 3.4082 7.48022 3.97461 6.04468C4.35547 5.08765 5.09277 4.35034 6.05469 3.9646C7.49512 3.39331 10.9131 3.52515 12.5049 3.52515C14.0967 3.52515 17.5195 3.39819 18.9551 3.9646C19.9121 4.34546 20.6494 5.08276 21.0352 6.04468C21.6064 7.48511 21.4746 10.9031 21.4746 12.4949C21.4746 14.0867 21.6064 17.5095 21.0352 18.9451Z" fill="#CECEEA"/>
</svg>
            ';
            $before = explode('<svg', $block_content);
            $after = explode('</svg>', $before[1]);
            $block_content = $before[0] . $icon . $after[1];
        } elseif ('core/social-link' === $block['blockName'] && 'facebook' === $block['attrs']['service']) {
            $icon = '<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.0938 1.5625H3.90625C3.28465 1.5625 2.68851 1.80943 2.24897 2.24897C1.80943 2.68851 1.5625 3.28465 1.5625 3.90625L1.5625 21.0938C1.5625 21.7154 1.80943 22.3115 2.24897 22.751C2.68851 23.1906 3.28465 23.4375 3.90625 23.4375H10.6079V16.0005H7.53174V12.5H10.6079V9.83203C10.6079 6.79736 12.4146 5.12109 15.1816 5.12109C16.5068 5.12109 17.8926 5.35742 17.8926 5.35742V8.33594H16.3657C14.8613 8.33594 14.3921 9.26953 14.3921 10.2271V12.5H17.7505L17.2134 16.0005H14.3921V23.4375H21.0938C21.7154 23.4375 22.3115 23.1906 22.751 22.751C23.1906 22.3115 23.4375 21.7154 23.4375 21.0938V3.90625C23.4375 3.28465 23.1906 2.68851 22.751 2.24897C22.3115 1.80943 21.7154 1.5625 21.0938 1.5625Z" fill="#CECEEA"/>
            </svg>
            ';
            $before = explode('<svg', $block_content);
            $after = explode('</svg>', $before[1]);
            $block_content = $before[0] . $icon . $after[1];
        }
        return $block_content;
    },
    10,
    2
);



/**** SEO */
function noindex_paged()
{
    if (is_paged()) {
        echo '<meta name="robots" content="noindex, follow" />' . "\n";
    }
}
add_action('wp_head', 'noindex_paged');






// Add custom columns for 'Date' and 'Location' in the 'event' CPT admin list
add_filter('manage_event_posts_columns', 'add_event_custom_columns');
function add_event_custom_columns($columns)
{
    $columns['event_date'] = 'Date of the event';
    $columns['event_location'] = 'Location';
    return $columns;
}

// Populate the custom columns with data from 'date_and_time' and 'location' fields
add_action('manage_event_posts_custom_column', 'populate_event_custom_columns', 10, 2);
function populate_event_custom_columns($column, $post_id)
{
    if ($column == 'event_date') {
        // Display the 'date_and_time' custom field
        $date_and_time = get_post_meta($post_id, 'date_and_time', true);
        echo esc_html($date_and_time);
    } elseif ($column == 'event_location') {
        // Display the 'location' custom field
        $location = get_post_meta($post_id, 'location', true);
        echo esc_html($location);
    }
}

// Make the custom columns sortable
add_filter('manage_edit-event_sortable_columns', 'make_event_custom_columns_sortable');
function make_event_custom_columns_sortable($columns)
{
    $columns['event_date'] = 'event_date';
    $columns['event_location'] = 'event_location';
    return $columns;
}

// Set custom ordering for the sortable columns
add_action('pre_get_posts', 'sort_event_custom_columns');
function sort_event_custom_columns($query)
{
    if (!is_admin())
        return;

    $orderby = $query->get('orderby');
    if ($orderby == 'event_date') {
        $query->set('meta_key', 'date_and_time');
        $query->set('orderby', 'meta_value');
    } elseif ($orderby == 'event_location') {
        $query->set('meta_key', 'location');
        $query->set('orderby', 'meta_value');
    }
}




function load_video_swiper_ajax()
{
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : '';

    $args = [
        'post_type' => 'video',
        'posts_per_page' => 10,
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    // Filter by category if selected
    if ($category_id) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'video_category',
                'field' => 'term_id',
                'terms' => $category_id,
            ],
        ];
    }

    $video_query = new WP_Query($args);

    if ($video_query->have_posts()):
        while ($video_query->have_posts()):
            $video_query->the_post();
            $video_url = get_field('video_url');
            ?>
                <div class="swiper-slide">
                    <a data-autoplay="true" data-vbtype="video" class="video-slide" href="<?php echo esc_url($video_url); ?>">
                        <!-- Thumbnail -->
                        <div class="video-thumbnail">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php else:
                                $thumbnail_url = get_youtube_thumbnail($video_url);
                                if ($thumbnail_url) {
                                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="YouTube Thumbnail">';
                                }
                                ?>
                            <?php endif; ?>
                        </div>

                        <!-- Title -->
                        <div class="video-title"><?php the_title(); ?></div>

                        <!-- Video URL from ACF -->
                        <div class="video-play">
                            <?php if ($video_url): ?>
                                <svg width="28" height="32" viewBox="0 0 28 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M26.525 13.4187L4.525 0.41245C2.7375 -0.6438 0 0.3812 0 2.9937V29C0 31.3437 2.54375 32.7562 4.525 31.5812L26.525 18.5812C28.4875 17.4249 28.4937 14.5749 26.525 13.4187Z"
                                        fill="white" />
                                </svg>

                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endwhile;
        wp_reset_postdata();
    else:
        echo '<p>No videos found.</p>';
    endif;

    die();
}
add_action('wp_ajax_load_video_swiper', 'load_video_swiper_ajax');
add_action('wp_ajax_nopriv_load_video_swiper', 'load_video_swiper_ajax');


/**
 * /
 * Shortcode [stories_dropdown] 
 */
function cpt_stories_dropdown_shortcode() {
    // Query all published stories
    $stories = get_posts([
        'post_type' => 'stories',
        'post_status' => 'publish',
        'numberposts' => -1,
    ]);

    // Start the dropdown HTML
    $output = '<div class="all-stories"><b>SELECT COUNTRY</b><select id="stories-dropdown" onchange="redirectToStory(this)">';
    $output .= '<option value="">Select a Story</option>';

    // Populate the dropdown with story options
    foreach ($stories as $story) {
        $output .= sprintf(
            '<option value="%s">%s</option>',
            esc_url(get_permalink($story->ID)),
            esc_html($story->post_title)
        );
    }

    $output .= '</select></div>';

    // Add JavaScript for redirection
    $output .= '<script>
        function redirectToStory(select) {
            const url = select.value;
            if (url) {
                window.location.href = url;
            }
        }
    </script>';

    return $output;
}

// Register the shortcode
add_shortcode('stories_dropdown', 'cpt_stories_dropdown_shortcode');

/**
 * /
 * Shortcode [stories_filter] 
 */
function display_stories_filter()
{
    $terms = get_terms(['taxonomy' => 'stories_country', 'hide_empty' => false]);

    ob_start(); ?>
        <div id="stories-filter">
            <b>SELECT COUNTRY</b>
            <select id="stories-country-dropdown">
                <option value="">All Countries</option>
                <?php foreach ($terms as $term): ?>
                    <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                <?php endforeach; ?>
            </select>
            <br>
        </div>

        <div id="stories-list">
            <?php
            $query = new WP_Query(['post_type' => 'stories', 'posts_per_page' => -1]);
            if ($query->have_posts()):
                while ($query->have_posts()):
                    $query->the_post(); ?>
                    <a class="story-item" href="<?php echo get_the_permalink(); ?>">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="story-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="story-title">
                            <h3><?php echo wrapLastWord(get_the_title()); ?></h3>
                        </div>
                    </a>
                <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <p>No stories found.</p>
            <?php endif; ?>
        </div>
        <?php return ob_get_clean();
}
add_shortcode('stories_filter', 'display_stories_filter');


function filter_stories_by_country()
{
    // Sanitize input
    $country = isset($_POST['country']) ? sanitize_text_field($_POST['country']) : '';

    // Build the query arguments
    $args = [
        'post_type' => 'stories',
        'posts_per_page' => -1,
    ];

    if (!empty($country)) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'stories_country',
                'field' => 'slug',
                'terms' => $country,
            ],
        ];
    }

    // Debugging: Log query args
    error_log('Query Args: ' . print_r($args, true));

    // Execute the query
    $query = new WP_Query($args);

    // Check results and output
    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post(); ?>
                <a class="story-item" href="<?php echo get_the_permalink(); ?>">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="story-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="story-title">
                        <h3><?php echo wrapLastWord(get_the_title()); ?></h3>
                    </div>
                </a>
            <?php endwhile;
        wp_reset_postdata();
    else: ?>
            <p>No stories found.</p>
        <?php endif;

    // Always stop further processing
    wp_die();
}
add_action('wp_ajax_filter_stories', 'filter_stories_by_country');
add_action('wp_ajax_nopriv_filter_stories', 'filter_stories_by_country');


/**
 * Wrap last word in the string with <b></b>
 */
function wrapLastWord($string)
{
    // Trim any whitespace from the string
    $string = trim($string);

    // Find the position of the last space in the string
    $lastSpacePosition = strrpos($string, ' ');

    // If there's no space, return the string with <b> tags around the whole string
    if ($lastSpacePosition === false) {
        return "<b>{$string}</b>";
    }

    // Split the string into two parts: before and after the last space
    $beforeLastWord = substr($string, 0, $lastSpacePosition);
    $lastWord = substr($string, $lastSpacePosition + 1);

    // Return the string with the last word wrapped in <b> tags
    return $beforeLastWord . ' <b>' . $lastWord . '</b>';
}

/**
 * Use only last word from a string
 */
function getLastWord($string) {
    // Trim the string to remove extra spaces
    $string = trim($string);
    
    // Split the string into an array of words
    $words = explode(' ', $string);
    
    // Return the last word
    return end($words);
}


/**
 * /
** Stories shortcode for slider [stories_slider posts_per_page="4"]

 */
function stories_swiper_shortcode($atts)
{
    // Attributes and defaults
    $atts = shortcode_atts(
        [
            'posts_per_page' => 4, // Number of posts to display
        ],
        $atts,
        'stories_slider'
    );

    // Query "stories" posts
    $stories_query = new WP_Query([
        'post_type' => 'stories',
        'posts_per_page' => $atts['posts_per_page'],
    ]);

    // Start output buffering
    ob_start();

    if ($stories_query->have_posts()): ?>
            <div class="swiper-container stories-slider">
                <div class="swiper-wrapper">
                    <?php while ($stories_query->have_posts()):
                        $stories_query->the_post(); ?>
                        <div class="swiper-slide">
                            <a class="story-item" href="<?php echo get_the_permalink(); ?>">
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="story-thumbnail">
                                        <?php the_post_thumbnail('large'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="story-title">
                                    <h3><?php echo wrapLastWord(get_the_title()); ?></h3>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
                <!-- Navigation Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif;

    // Return the buffered content
    return ob_get_clean();
}
add_shortcode('stories_slider', 'stories_swiper_shortcode');


function init_stories_slider_conditionally()
{
    global $post;

    // Check if the shortcode is used on the page
    if (isset($post->post_content) && has_shortcode($post->post_content, 'stories_slider')) {
        ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    new Swiper('.stories-slider', {
                        slidesPerView: 1.2,
                        spaceBetween: 5,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        breakpoints: {

                        840: {
                            slidesPerView: 2.5,
                            spaceBetween: 5,
                        },
   
                        },
                        loop: false,
                    });
                });
            </script>
            <?php
    }
}
add_action('wp_footer', 'init_stories_slider_conditionally');



/**
 * Summary of render_world_map_with_pins
 * Shortcode [world_map_with_pins]
 */
function render_world_map_with_pins() {
    // Query the 'stories' custom post type
    $args = array(
        'post_type'      => 'stories',
        'posts_per_page' => -1,
        'post_status'    => array( 'publish' ),
        'no_found_rows'  => true
    );
    $stories = new WP_Query($args);

    // Prepare pin data from the CPT
    $pins = array();
    if ($stories->have_posts()) {
        while ($stories->have_posts()) {
            $stories->the_post();

            // Get location data from custom fields (adjust meta key names as needed)
            $location_name = getLastWord(get_the_title());
            $latitude = get_post_meta(get_the_ID(), 'latitude', true); // Latitude field
            $longitude = get_post_meta(get_the_ID(), 'longitude', true); // Longitude field
            if (has_excerpt()) {
                $excerpt = get_the_excerpt(); // Story excerpt
            } else {
                $excerpt ='';
            }
            $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'medium'); // Story featured image
            $story_url = get_permalink(); // Story link

            if ($latitude && $longitude) {
                $pins[] = array(
                    'name' => $location_name,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'excerpt' => $excerpt,
                    'image' => $featured_image,
                    'url' => $story_url,
                );
            }
        }
    }
    wp_reset_postdata();

    // Generate the map HTML
    ob_start();
    ?>
    <div class="map-container">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/map.svg'); ?>" alt="World Map" class="map">
        <?php foreach ($pins as $pin): ?>
            <?php
            // Convert latitude/longitude to approximate percentage positions
            $x = (($pin['longitude'] + 180) / 360) * 100 - 4; // Scale longitude (-180 to 180) to 0-100%
            $y = (1 - (($pin['latitude'] + 90) / 180)) * 100 + 14; // Scale latitude (-90 to 90) to 0-100%

            ?>
            <div class="pin" style="--x: <?php echo esc_attr($x); ?>%; --y: <?php echo esc_attr($y); ?>%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="57.064" height="68" viewBox="0 0 57.064 68">
                    <path id="pin" d="M17.373,11.31a28.531,28.531,0,0,0,0,40.351L36.038,70.328a2.136,2.136,0,0,0,3.02,0L57.725,51.661A28.532,28.532,0,0,0,17.374,11.31Zm7.695,19.432a12.8,12.8,0,1,1,12.8,12.8A12.8,12.8,0,0,1,25.068,30.742Z" transform="translate(-9.016 -2.953)" fill="#f9f" fill-rule="evenodd"/>
                </svg>

                <div class="pin-content">
                <?php if ($pin['image']): ?>
                    <img src="<?php echo esc_url($pin['image']); ?>" alt="<?php echo esc_attr($pin['name']); ?>" class="pin-image">
                    <?php endif; ?>

                    <div class="pin-title">
                        <?php echo esc_html($pin['name']); ?>
                    </div>

                    <div class="pin-excerpt">
                        <?php echo esc_html($pin['excerpt']); ?>
                    </div>
 
                    <a href="<?php echo esc_url($pin['url']); ?>" class="pin-url">VISIT PAGE</a>
                </div>
                
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('world_map_with_pins', 'render_world_map_with_pins');




/**
 * /
 * @param mixed $entry_id
 * @param mixed $form_id
 * @param mixed $fields
 * On EVEREST form submission insert draft cpt voice
 */
add_action('everest_forms_process_complete', 'ef_create_voice_post', 10, 4);

function ef_create_voice_post($form_fields, $entry, $form_data, $entry_id) {
    // Only run this for form ID 42.
    if (isset($form_data['id']) && $form_data['id'] == 191) {
        // Debug the form fields to find the correct ID for the Subject field.
      //  error_log('Form Fields: ' . print_r($form_fields, true));
        
        // Replace 'subject_field_id' with the actual field ID for Subject.
        $subject_field_id = 'subject'; // Replace with the actual field ID for the Subject field.
        $name_field_id = 'fullname'; // Replace with the actual ID of your name field.
        $message_field_id = 'message'; // Replace with the actual ID of your message field.

        // Get values from the form fields.
        $name = isset($form_fields[$name_field_id]['value']) ? $form_fields[$name_field_id]['value'] : '';
        $message = isset($form_fields[$message_field_id]['value']) ? $form_fields[$message_field_id]['value'] : '';
        $organisation = isset($form_fields[$subject_field_id]['value']) ? $form_fields[$subject_field_id]['value'] : '';

        // Proceed only if the Subject field has a value.
        if (!empty($organisation)) {
            // Create a new post in the 'voice' custom post type.
            $post_data = [
                'post_title'   => sanitize_text_field($name),
                'post_content' => wp_kses_post($message),
                'post_status'  => 'draft',         // Change to 'draft' or 'pending' if necessary.
                'post_type'    => 'voice',   
            ];

            $post_id = wp_insert_post($post_data);

            if (is_wp_error($post_id)) {
                error_log('Error creating post: ' . $post_id->get_error_message());
            } else {
                // Update the 'organisation' meta field with the Subject field value.
                update_post_meta($post_id, 'organisation', sanitize_text_field($organisation));
                error_log('Voice post created successfully with ID: ' . $post_id . ' and organisation: ' . $organisation);
            }
        } else {
            error_log('Subject field is empty, cannot populate organisation meta field.');
        }
    }
}



function load_more_voice_posts() {
    check_ajax_referer('load_more_nonce', 'security');

    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    $query = new WP_Query([
        'post_type' => 'voice',
        'posts_per_page' => 2,
        'post_status'    => array( 'publish' ),
        'paged' => $paged,
    ]);

    $response = [
        'html' => '',
        'has_more' => false,
    ];

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="voice-post">
                <div class="excerpt"><?php echo get_the_content(); ?></div>
                <div class="voice-author"><?php the_title(); ?> <?php if( get_field('organisation', get_the_id()) ){ echo ', ' . get_field('organisation', get_the_id()); } ?></div>
                </div>
            </div>
            <?php
        }
        $response['html'] = ob_get_clean();

        // Check if there are more posts
        $response['has_more'] = $paged < $query->max_num_pages;
    }

    wp_send_json($response); // Return JSON response
    wp_die();
}
add_action('wp_ajax_load_more_voice_posts', 'load_more_voice_posts');
add_action('wp_ajax_nopriv_load_more_voice_posts', 'load_more_voice_posts');



/**
 * Summary of voice_posts_shortcode
 * Voices shortcode [voice_posts posts_per_page="4"]
 */

function voice_posts_shortcode($atts) {
    $atts = shortcode_atts([
        'posts_per_page' => 8,
    ], $atts, 'voice_posts');

    ob_start();

    // Query the first set of posts
    $query = new WP_Query([
        'post_type' => 'voice',
        'posts_per_page' => intval($atts['posts_per_page']),
        'paged' => 1,
    ]);

    // Count the total number of published posts
    $total_posts = wp_count_posts('voice')->publish;

    ?>
    <div class="voice-posts">
        <?php
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="voice-post">
                    <div class="excerpt"><?php echo get_the_content(); ?></div>
                    <div class="voice-author"><?php the_title(); ?> <?php if( get_field('organisation', get_the_id()) ){ echo ', ' . get_field('organisation', get_the_id()); } ?></div>
                </div>
                <?php
            }
            wp_reset_postdata();
        } else {
            echo '<p>No posts found.</p>';
        }
        ?>
    </div>
    <?php if ($total_posts > intval($atts['posts_per_page'])) : ?>
        <div class="load-more-button-wrap">
            <button id="load-more-voice">Load More</button>
        </div>   
    <?php endif; ?>
    <?php

    return ob_get_clean();
}
add_shortcode('voice_posts', 'voice_posts_shortcode');


/**
 * Summary of customize_gallery_markup
 * Gutenberg gallery with 1 column turn into swiper slider
 */
function customize_gallery_markup($block_content, $block) {
    // Check if the block is a gallery block
    if ('core/gallery' === $block['blockName']) {
        // Get gallery attributes
        $attributes = isset($block['attrs']) ? $block['attrs'] : [];

        // Check if the 'columns' attribute exists and is set to 1
        if (isset($attributes['columns']) && (int) $attributes['columns'] === 1) {
            // Transform gallery output into Swiper-compatible structure

            // Wrap each image in a Swiper slide
            $block_content = preg_replace(
                '/<figure class="wp-block-image(.*?)">/',
                '<div class="swiper-slide"><figure class="wp-block-image$1">',
                $block_content
            );

            // Close the swiper-slide div after each figure
            $block_content = str_replace('</figure>', '</figure></div>', $block_content);

            // Remove the gallery wrapper <figure>
            $block_content = preg_replace(
                '/<figure class="wp-block-gallery(.*?)">|<\/figure>/',
                '',
                $block_content
            );

            // Wrap the resulting slides in Swiper structure and add navigation arrows
            $block_content = '
                <figure class="swiper-gallery">
                    <div class="swiper-wrapper">' . $block_content . '<div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    
                </figure>';
        }
    }

    return $block_content;
}
add_filter('render_block', 'customize_gallery_markup', 10, 2);



