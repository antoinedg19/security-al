<?php 
/*
Plugin Name: Security Al
Plugin URI: https://github.com/antoinedg19/security-al
Description: Security Snippets (initialy in the function.php)
Author: Al Di Girolamo
Version: 1.7
Author URI: https://aldigirolamo.fr
*/

//Remove Element From Head
  function remove_header_info() {
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
  }
  add_action('init', 'remove_header_info');

// Deleting author name in the comment section
  function remove_comment_author_class( $classes ) {
    foreach( $classes as $key => $class )
     if(strstr($class, 'comment-author-' ))
      unset( $classes[$key] );
    return $classes;
   }
   add_filter( 'comment_class' , 'remove_comment_author_class' );

// Deleting the error infos from the login page
   function remove_login_error_msg() {
    return 'Erreur';
   }
  add_filter( 'login_errors', 'remove_login_error_msg' );

// Desactivate the XMLRPC.php
  add_filter( 'wp_xmlrpc_server_class', '__return_false' );
  add_filter('xmlrpc_enabled', '__return_false');

//Deleting rss flux
   add_filter('get_the_generator_rss2', '__return_false');
   add_filter('get_the_generator_atom', '__return_false');

// Suppression version dans flux RSS
   function remove_version_wp() {
    return '';
   }
   add_filter('the_generator', 'remove_version_wp');

// Deleting wp version in enqueud script
   function remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
     $src = remove_query_arg( 'ver', $src );
    return $src;
   }
   add_filter( 'style_loader_src', 'remove_ver_css_js', 9999 );
   add_filter( 'script_loader_src', 'remove_ver_css_js', 9999 );