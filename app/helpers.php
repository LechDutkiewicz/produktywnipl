<?php

namespace App;

use Roots\Sage\Container;
use Illuminate\Contracts\Container\Container as ContainerContract;
use GetResponse;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param ContainerContract $container
 * @return ContainerContract|mixed
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
function sage($abstract = null, $parameters = [], ContainerContract $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', false);
    return $display;
}

/**
 * Page titles
 * @return string
 */
function title()
{
    if (is_home()) {
        if ($home = get_option('page_for_posts', true)) {
            return get_the_title($home);
        }
        return __('Latest Posts', 'sage');
    }
    if (is_archive()) {
        return get_the_archive_title();
    }
    if (is_search()) {
        return sprintf(__('Szukana fraza: %s', 'sage'), get_search_query());
    }
    if (is_404()) {
        return __('Not Found', 'sage');
    }
    return get_the_title();
}

function post_categories() {
    global $post;

    $categories = get_the_category($post->ID);
    
    if ( ! empty( $categories ) ) {
        // print_r($categories);
        echo '<a href="' . get_category_link( $categories[0]->cat_ID ) . '">' . esc_html( $categories[0]->name ) . '</a>';   
    }
}

function comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php
							/* translators: %s: comment author link */
              if ( $comment->user_id ) {
                $user = get_userdata($comment->user_id);
                $author = $user->first_name . ' ' . $user->last_name;
              } else {
                $author = get_comment_author_link( $comment );
              }
							printf( __( '%s <span class="says">says:</span>' ),
								sprintf( '<b class="fn">%s</b>', $author )
							);
						?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php
									/* translators: 1: comment date, 2: comment time */
									printf( __( '<strong>%1$s</strong>, %2$s' ), get_comment_date( 'j F Y', $comment ), get_comment_time() );
								?>
                <i class="zmdi zmdi-calendar-alt"></i>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
        $post_id = get_the_ID();
        $comment_id = get_comment_ID();

        //get the setting configured in the admin panel under settings discussions "Enable threaded (nested) comments  levels deep"
        $max_depth = get_option('thread_comments_depth');
        //add max_depth to the array and give it the value from above and set the depth to 1
        $default = array(
            'add_below'  => 'comment',
            'respond_id' => 'respond',
            'reply_text' => '<i class="zmdi zmdi-long-arrow-return"></i>' . __( 'Odpowiedz', 'pkpk' ),
            'login_text' => __('Log in to Reply'),
            'depth'      => 1,
            'before'     => '<div class="reply">',
            'after'      => '</div>',
            'max_depth'  => $max_depth
            );
        comment_reply_link($default, $comment_id, $post_id);

        //print_r($test);
				?>
			</article><!-- .comment-body -->
<?php
}

add_action( 'wp_print_styles', function() {
    wp_dequeue_style('yarppWidgetCss');
    // Next line is required if the related.css is loaded in header when disabled in footer.
    wp_deregister_style('yarppRelatedCss'); 
} );

add_action( 'wp_footer', function() {
    wp_dequeue_style('yarppRelatedCss');
} );