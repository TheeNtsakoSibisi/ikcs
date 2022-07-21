<?php

include("wp-disable.php");

function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src; 
}

add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );


/* Disable Autofill */
function disable_autofill_password($safe_text, $text) {
    if($safe_text === 'user_pass') {
        $safe_text .= '" autocomplete="new-password';
    }
    return $safe_text;
}
add_filter('attribute_escape', 'disable_autofill_password', 10, 2);


/* Body Parameters Accepted in Query */
function wwp_custom_query_vars_filter($vars) {
    $vars[] .= 'noheadfoot';
    return $vars;
}
add_filter( 'query_vars', 'wwp_custom_query_vars_filter' );

/**
 * Use this to upgrade WordPress core and plugins locally
 */
if ( $_SERVER['HTTP_HOST'] == 'dev.amphub.local' ) {
    add_filter( 'https_ssl_verify', '__return_false' );
    set_time_limit(600); // 10 min
}