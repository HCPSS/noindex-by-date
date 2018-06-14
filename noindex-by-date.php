<?php
/**
 * Noindex by Date plugin.
 *
 * @copyright Copyright (C) 2018 Howard County Public School System
 * @license MIT
 * 
 * Plugin Name: Noindex by Date
 * Plugin URI: https://github.com/HCPSS/noindex-by-date
 * description: Add noindex meta to old posts
 * Version: 1.0.0
 * Author: Brendan Anderson
 * Author URI: https://github.com/hcpss-banderson
 * License: MIT
 */
   
defined('ABSPATH') or die('No direct access.');

/**
 * Callback for wp_head. Adds a noindex meta tag to the head if the post is 
 * older than 1 year.
 */
function noindex_by_date_add_meta() {
    if (!$post = get_post()) {
        return;
    }
    
    if (!$post instanceof WP_Post) {
        return;
    }
    
    if ($post->post_type != 'post') {
        return;
    }
    
    $posted = strtotime($post->post_date_gmt);
    
    if ($posted < strtotime('-1 year')) {
        // @see https://support.google.com/webmasters/answer/93710?hl=en
        echo "<meta name=\"robots\" content=\"noindex\">\n";
    }
}

add_action('wp_head', 'noindex_by_date_add_meta');
