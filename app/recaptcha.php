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

    if ( get_field("wlaczyc_recaptcha", "options") && get_field("klucz_witryny", "options" ) ) {

        $recaptcha_api_key = get_field("klucz_witryny", "options" );

        wp_register_script("recaptcha", "https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit", array('jquery'), false);
        wp_enqueue_script("recaptcha");

        // wp_localize_script( 'recaptcha', 'recaptcha', array('key' => $recaptcha_api_key) );

        wp_add_inline_script("recaptcha", "function onloadCallback() {

            jQuery('.g-recaptcha').each(function() {

                var object = $(this);
                grecaptcha.render(object.attr('id'), {

                    'sitekey': '{$recaptcha_api_key}',
                    'callback': function(token) {

                        object.parents('form').find('.g-recaptcha-response').val(token);
                        object.parents('form').submit();
                    }

                });
            });
        };", "before");
    }
}
add_action("wp_enqueue_scripts", "frontend_recaptcha_script");

/*=====  End of Add script to wp head  ======*/

?>