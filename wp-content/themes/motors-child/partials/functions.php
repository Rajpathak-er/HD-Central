<?php

/** 
 Re-use some existing WordPress functions so you don't have to write a bunch of raw PHP to check for SSL, port numbers, etc
 
 Place in your functions.php (or re-use in a plugin)
 If you absolutely don't need or want any query string, use home_url(add_query_arg(array(),$wp->request));
 
 Hat tip to:
  + http://kovshenin.com/2012/current-url-in-wordpress/
  + http://stephenharris.info/how-to-get-the-current-url-in-wordpress/
 */

/**
 * Build the entire current page URL (incl query strings) and output it
 * Useful for social media plugins and other times you need the full page URL
 * Also can be used outside The Loop, unlike the_permalink
 * 
 * @returns the URL in PHP (so echo it if it must be output in the template)
 * Also see the_current_page_url() syntax that echoes it
 */
if (!function_exists('get_current_page_url')) {
  function get_current_page_url()
  {
    global $wp;
    return add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request));
  }
}

/*
* Shorthand for echo get_current_page_url(); 
* @returns echo'd string
*/
if (!function_exists('the_current_page_url')) {
  function the_current_page_url()
  {
    echo get_current_page_url();
  }
}
