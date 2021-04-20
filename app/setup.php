<?php

namespace App;

use Illuminate\Contracts\Container\Container as ContainerContract;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Config;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;
use GetResponse;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {

    // main styles
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);

    // main scripts
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    // main script localization
    wp_localize_script( 'sage/main.js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}, 100);

// Same handler function...
add_action( 'wp_ajax_handle_getresponse', 'App\handle_getresponse' );
add_action( 'wp_ajax_nopriv_handle_getresponse', 'App\handle_getresponse' );
function handle_getresponse() {
	// $data = json_encode($_POST);
    $getresponse = new GetResponse('28cd0931de80b078734ca09ba8527f27');
    $data = $_POST;
    $getresponse->addContact(array(
        'name'              => $data['name'],
        'email'             => $data['email'],
        'campaign'          => array('campaignId' => 'VX9bP'),
        'dayOfCycle'        => 0
    ));
    $result = [
        'httpStatus' => $getresponse->http_status
    ];

    echo json_encode($result);
    
    wp_die(); 
}

// add_action('init', function() {
//     $getresponse = new GetResponse('496a0ef6b2a7d42ab5228f0dd59bbbcf');
//     $result = $getresponse->getForms();

//     print_r($result);
// });

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
    add_image_size('post-large', 765, 480, true );
    add_image_size('post-small', 500, 315, true );
    add_image_size('post-wide', 960, 290, true );
    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Blog Sidebar', 'sage'),
        'id'            => 'sidebar-post'
    ] + $config);
    register_sidebar([
        'name'          => __('Trainings Sidebar', 'sage'),
        'id'            => 'sidebar-trainings'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Sage config
     */
    $paths = [
        'dir.stylesheet' => get_stylesheet_directory(),
        'dir.template'   => get_template_directory(),
        'dir.upload'     => wp_upload_dir()['basedir'],
        'uri.stylesheet' => get_stylesheet_directory_uri(),
        'uri.template'   => get_template_directory_uri(),
    ];
    $viewPaths = collect(preg_replace('%[\/]?(resources/views)?[\/.]*?$%', '', [STYLESHEETPATH, TEMPLATEPATH]))
    ->flatMap(function ($path) {
        return ["{$path}/resources/views", $path];
    })->unique()->toArray();

    config([
        'assets.manifest' => "{$paths['dir.stylesheet']}/../dist/assets.json",
        'assets.uri'      => "{$paths['uri.stylesheet']}/dist",
        'view.compiled'   => "{$paths['dir.upload']}/cache/compiled",
        'view.namespaces' => ['App' => WP_CONTENT_DIR],
        'view.paths'      => $viewPaths,
    ] + $paths);

    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (ContainerContract $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view'], $app);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= App\\asset_path({$asset}); ?>";
    });

    /**
     * Create @query() Blade directive
     */
    sage('blade')->compiler()->directive('query', function ($args) {
        $output = '<?php $bladeQuery = new WP_Query($args); ?>';
        $output .= '<?php if ($bladeQuery->have_posts()) : ?>';
        $output .= '<?php while ($bladeQuery->have_posts()) : ?>';
        $output .= '<?php $bladeQuery->the_post(); ?>';
        $putput .= '<?php setup_postdata(); ?>';

        return $output;
    });

    /**
     * Create @endquery Blade directive
     */
    sage('blade')->compiler()->directive('endquery', function () {
        $output = '<?php endwhile; ?>';
        $output .= '<?php endif; ?>';

        return $output;
    });

    /**
     * Create @haveposts() Blade directive
     */
    sage('blade')->compiler()->directive('haveposts', function ($args) {
        $output = '<?php $bladeQuery = new WP_Query($args); ?>';
        $output .= '<?php if ($bladeQuery->have_posts()) : ?>';

        return $output;
    });

    /**
     * Create @endhaveposts() Blade directive
     */
    sage('blade')->compiler()->directive('endhaveposts', function ($args) {
        return '<?php endif; ?>';
    });

    /**
     * Create @ifquery() Blade directive
     */
    sage('blade')->compiler()->directive('notposts', function ($args) {
        $output = '<?php $bladeQuery = new WP_Query($args); ?>';
        $output .= '<?php if ($bladeQuery->have_posts() == false) : ?>';

        return $output;
    });

    /**
     * Create @endifquery() Blade directive
     */
    sage('blade')->compiler()->directive('endnotposts', function () {
        $output .= '<?php endif; ?>';

        return $output;
    });
});

/**
 * Init config
 */
sage()->bindIf('config', Config::class, true);
