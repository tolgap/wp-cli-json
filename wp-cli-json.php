<?php
/*
Plugin Name: WP-JSON wp-cli Extension
Plugin URI: https://github.com/tolgap/wp-cli-json
Description: This command for WP-CLI makes it possible to encode plugin info in JSON through the console of wp-cli. 
Version: 0.1
Author: Tolga Paksoy
Author URI: http://www.hoppinger.com/
License: GPL
Copyright: Tolga Paksoy
*/

if ( defined('WP_CLI') && WP_CLI ) {
  
  // Include and register the class as the 'example' command handler
  include('WPJSONCommand.php');
  WP_CLI::addCommand( 'json', 'WPJSONCommand' );
}