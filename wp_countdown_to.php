<?php
/*
Plugin Name: WP Countdown To
Plugin URI: http://www.ketlai.co.uk
Description: Provide a way to set an end date and show a countdown to it
Author: James Stewart
Version: 0.1
Author URI: http://jystewart.net/process/
*/

if (function_exists('date_default_timezone_set')) {
  date_default_timezone_set(get_option('timezone_string'));
}

add_action('admin_menu', 'countdown_to_menu'); 
add_filter('comments_open', 'countdown_to_comments_open');

function countdown_days_remaining() {
  $end_date = get_option('countdown_date');
  $now = time();
  
  $count = round( ($end_date-$now) / (3600*24) );
  
  switch (TRUE) {
    case $count > 1:
    case $count == 0:
      echo "Consultation ends in " . $count . ' days';
      break;
    case $count == 1:
      echo "Consultation ends in " . $count . ' day';
      break;
    default:
      echo get_option('countdown_ended_message', 'Countdown complete');
  }
}

function countdown_to_menu() {
  global $user_level;
  get_currentuserinfo();
  if ($user_level < 10) {
    return;
  }

  if (function_exists('add_options_page')) {
    add_options_page(__('Countdown Settings'), __('Countdown Settings'), 1, __FILE__, 'countdown_to_settings_page');
  }
}

function countdown_to_settings_page() {
  $options = array(
    'countdown_date' => get_option('countdown_date'),
    'close_comments' => get_option('countdown_close_comments', 0),
    'countdown_message' => get_option('countdown_message', 'Ends in'),
    'countdown_ended_message' => get_option('countdown_ended_message', 'Countdown ended')
  );
  
  $changed = FALSE;

  if (isset($_POST['countdown_date'])) {
    $new_date = strtotime($_POST['countdown_date']);
    if ($new_date === FALSE) {
      echo '<div class="error"><p>' . __('Please enter a valid date') . '</p></div>';
    } else {
      $options = array('countdown_date' => $new_date);
      update_option('countdown_date', $options['countdown_date']);
      $changed = TRUE;
    }
  }

  foreach (array('countdown_message', 'countdown_ended_message') as $key) {
    if (! empty($_POST[$key])) {
      $options[$key] = attribute_escape(strip_tags($_POST[$key]));
      update_option($key, $options[$key]);
      $changed = TRUE;      
    }
  }
  
  if (isset($_POST['countdown_close_comments']) && $_POST['countdown_close_comments' == 1]) {
    update_option('countdown_close_comments', 1);
    $changed = TRUE;
  } else {
    update_option('countdown_close_comments', 0);
  }

  if ($changed) {
    echo '<div class="updated"><p>' . __('Options saved') . '</p></div>';
  }
  
  require dirname(__FILE__) . '/admin_page.tpl.php';
}

function countdown_to_comments_open($open = TRUE, $post_id = FALSE) {
  $end_date = get_option('countdown_date');

  $should_close = get_option('countdown_close_comments');
  if (empty($should_close)) {
    $should_close == 0;
  }
  
  return $end_date >= time() || $should_close == 0;
}

if (! defined('PHP_VERSION_ID')) {
  $version = explode('.', PHP_VERSION);
  define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

if (PHP_VERSION_ID < 50207) {
  define('PHP_MAJOR_VERSION', $version[0]);
  define('PHP_MINOR_VERSION',   $version[1]);
  define('PHP_RELEASE_VERSION', $version[2]);
}

if (PHP_MAJOR_VERSION < 5) {
  function countdown_to_version_warning() {
    echo "<div id='countdown-to-warning' class='updated fade'>";
    echo "<p><strong>" . 
      __('WP Countdown To is only tested on PHP5.2 and above. You are running PHP4 so the plugin may not work correctly') . 
      "</strong></p>";
    echo "</div>";
  }
  add_action('admin_notices', 'countdown_to_version_warning');
}
