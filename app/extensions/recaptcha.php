<?php
/**
 * Add recaptcha via ACF.
 *
 * @package Lech Dutkiewicz startprogress.pl
 */

if ( !defined('ABSPATH') )
    die('-1');

/*=============================================
=            Add script to wp head            =
=============================================*/

function frontend_recaptcha_script() {

    if ( get_field("ga_recaptcha_enabled", "options") && get_field("ga_recaptcha_key", "options" ) ) {

        $recaptcha_api_key = get_field("ga_recaptcha_key", "options" );

        wp_register_script("recaptcha", "https://www.google.com/recaptcha/api.js?render={$recaptcha_api_key}&onload=onloadCallback", false, false);
        wp_enqueue_script("recaptcha");

        wp_add_inline_script("recaptcha", "function onloadCallback() {
            grecaptcha.ready(function () {
                grecaptcha.execute(\"{$recaptcha_api_key}\", { action: \"contact\" }).then(function (token) {
                    var recaptchaResponse = document.getElementById('recaptcha_response');
                    recaptchaResponse.value = token;
                    });
                    });
                };", "before");

        wp_localize_script( "recaptcha", "recaptcha",
            array(
                'key'             => $recaptcha_api_key,
            )
        );

         // wp_add_inline_script(
         //     "recaptcha",
         //     "grecaptcha.ready(function() {
         //         grecaptcha.render('recaptcha_response', {
         //             'sitekey': '" . $recaptcha_api_key . "'
         //             });
         //         });",
         //         "after"
         //     );
    }
}
add_action("wp_enqueue_scripts", "frontend_recaptcha_script");

/*=====  End of Add script to wp head  ======*/

/*============================================
=            Add ACF custom field            =
============================================*/

if ( function_exists( "acf_add_local_field_group" ) ) {

    acf_add_local_field_group(
        array(
            'key'       => 'group_I85hetpR',
            'title'     => 'Klucz api do Google Recaptcha',
            'fields'    => array(
                array(
                    'key'   => 'field_Dabea225',
                    'label' => 'Włączyć Recaptcha?',
                    'name'  => 'ga_recaptcha_enabled',
                    'type'  => 'true_false'
                ),
                array(
                    'key'   => 'field_DD4bsT',
                    'label' => 'Klucz API',
                    'name'  => 'ga_recaptcha_key',
                    'type'  => 'text'
                ),
                array(
                    'key'   => 'field_cth5AOltVz7Sr4DsNn',
                    'label' => 'Klucz Secret',
                    'name'  => 'ga_recaptcha_secret',
                    'type'  => 'text'
                ),
            ),
            'location'  => array(
                array(
                    array(
                        'param'     => 'options_page',
                        'operator'  => '==',
                        'value'     => 'acf-options-recaptcha',
                        'order_no'  => 20,
                        'group_no'  => 10
                    ),
                ),
            ),
            'menu_order' => 30,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => 1,
            'description' => '',
        )
    );
}

/*=====  End of Add ACF custom field  ======*/





/*============================================
=            Add ACF options page            =
============================================*/

if ( !function_exists('setup_acf_tab_apis_bar') ) {

    function setup_acf_tab_apis_bar() {

        $current_user = wp_get_current_user();
        $roles = $current_user->roles;
        $role = array_shift( $roles );

        if( function_exists('acf_add_options_page') && $role === 'administrator' ) {

            acf_add_options_sub_page(array(
                'page_title'    => 'Ustawienia Recaptcha',
                'menu_title'    => 'Recaptcha',
                'parent_slug'   => 'theme-general-settings',

            ));
        }
    }

    setup_acf_tab_apis_bar();
}

/*=====  End of Add ACF options page  ======*/





?>