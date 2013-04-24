<?php
/**
 * Implement JSON command
 *
 * @package wp-cli
 * @subpackage commands/community
 * @maintainer Tolga Paksoy (https://github.com/tolgap)
 */

class WPJSONCommand extends WP_CLI_Command {

  protected $upgrade_refresh = 'wp_update_plugins';
  protected $upgrade_transient = 'update_plugins';
  private $map = array(
    'short' => array(
      'active'         => 'A',
      'inactive'       => 'I',
      'must-use'       => 'M',
      'active-network' => 'N',
    ),
    'long' => array(
      'active'         => 'Active',
      'inactive'       => 'Inactive',
      'must-use'       => 'Must Use',
      'active-network' => 'Network Active',
    )
  );
  
  public function plugins() {
    // Force Wordpress to check for updates
    call_user_func( $this->upgrade_refresh );

    $all_plugins = $this->status_all();
  }

  public function core() {
    global $wp_version, $wp_db_version, $tinymce_version, $manifest_version;

    $version_info = array(
      'wp_version'       => $wp_version,
      'wp_db_version'    => $wp_db_version,
      'tinymce_version'  => $tinymce_version,
      'manifest_version' => $manifest_version,
    );

    \WP_CLI::line( json_encode( $version_info) );
  }

  protected function status_all() {
    $items = $this->get_all_items();

    \WP_CLI::line( json_encode( $items ) );
  }

  protected function get_all_items() {
    $items = $this->get_item_list();

    foreach ( get_mu_plugins() as $file => $mu_plugin ) {
      $items[ $file ] = array(
        'name' => $this->get_name( $file ),
        'status' => 'must-use',
        'update' => false
      );
    }

    return $items;
  }

  protected function get_item_list() {
    $items = array();

    foreach ( get_plugins() as $file => $details ) {
      $items[ $file ] = array(
        'name'      => $this->get_name( $file ),
        'status'    => $this->get_status( $file ),
        'update'    => $this->has_update( $file ),
        'update_id' => $file,
      );
    }

    return $items;
  }

  protected function has_update( $slug ) {
    $update_list = get_site_transient( $this->upgrade_transient );

    return isset( $update_list->response[ $slug ] );
  }

  private function get_name( $file ) {
    if ( false === strpos( $file, '/' ) )
      $name = basename( $file, '.php' );
    else
      $name = dirname( $file );

    return $name;
  }

  protected function get_status( $file ) {
    if ( is_plugin_active_for_network( $file ) )
      return 'active-network';

    if ( is_plugin_active( $file ) )
      return 'active';

    return 'inactive';
  }
  
  static function help(){
    WP_CLI::line( 'Welcome to wp-cli-json' );
    WP_CLI::line( 'This tool and plugin presents you a JSON representation of your plugin statuses and core version' );
    WP_CLI::line( 'possible subcommands: core, plugin' );
  }

}