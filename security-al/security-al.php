<?php 
/*
Plugin Name: Security Al
Plugin URI: https://aldigirolamo.fr
Description: This is a plugin for security info initialy in the function.php
Author: Al Di Girolamo
Version: 1.2
Author URI: https://aldigirolamo.fr
*/

// Suppression du login de l'auteur dans les commentaires
function remove_comment_author_class( $classes ) {
    foreach( $classes as $key => $class )
     if(strstr($class, 'comment-author-' ))
      unset( $classes[$key] );
    return $classes;
   }
   add_filter( 'comment_class' , 'remove_comment_author_class' );
   // Désactivation des infos d'erreur de login
   function remove_login_error_msg() {
    return 'Et alors...?';
   }
   add_filter( 'login_errors', 'remove_login_error_msg' );
   // Désactivation XMLRPC
   add_filter('xmlrpc_enabled', '__return_false');
   remove_action('wp_head', 'rsd_link');
   // Suppression de la version de WordPress
   remove_action('wp_head', 'wp_generator');
   remove_action('wp_head', 'wlwmanifest_link');
   //Supression generateur flux RSS 
   add_filter('get_the_generator_rss2', '__return_false');
   add_filter('get_the_generator_atom', '__return_false');
   // Suppression version dans flux RSS
   function remove_version_wp() {
    return '';
   }
   add_filter('the_generator', 'remove_version_wp');
   // Suppression des versions des fichiers css/js inclus
   function remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
     $src = remove_query_arg( 'ver', $src );
    return $src;
   }
   add_filter( 'style_loader_src', 'remove_ver_css_js', 9999 );
   add_filter( 'script_loader_src', 'remove_ver_css_js', 9999 );
