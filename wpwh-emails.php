<?php
/**
 * Plugin Name: WP Webhooks - Email integration
 * Plugin URI: https://ironikus.com/downloads/wp-webhooks-emails/
 * Description: A WP Webhooks & Pro extension for integrating emails
 * Version: 1.0.0
 * Author: Ironikus
 * Author URI: https://ironikus.com/
 * License: GPL3
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) exit;

// Plugin Name.
define( 'WPWH_EMAILS_PLUGIN_NAME',    'WP Webhooks - Email integration' );

// Plugin Root File.
define( 'WPWH_EMAILS_PLUGIN_FILE',    __FILE__ );

// Plugin base.
define( 'WPWH_EMAILS_PLUGIN_BASE',    plugin_basename( WPWH_EMAILS_PLUGIN_FILE ) );

// Plugin Folder Path.
define( 'WPWH_EMAILS_PLUGIN_DIR',     plugin_dir_path( WPWH_EMAILS_PLUGIN_FILE ) );

// Plugin Folder URL.
define( 'WPWH_EMAILS_PLUGIN_URL',     plugin_dir_url( WPWH_EMAILS_PLUGIN_FILE ) );
 
function wpwh_emails_load(){

	require_once WPWH_EMAILS_PLUGIN_DIR . 'features/class-webhook-actions.php';

	require_once WPWH_EMAILS_PLUGIN_DIR . 'features/class-webhook-triggers.php';

}

// Make sure we load the extension after main plugin is loaded
if( defined( 'WPWHPRO_SETUP' ) || defined( 'WPWH_SETUP' ) ){
	wpwh_emails_load();
} else {
	add_action( 'wpwhpro_plugin_loaded', 'wpwh_emails_load' );
}

//Throw message in case WP Webhook is not active
add_action( 'admin_notices', 'wpwhpro_emails_throw_custom_notice', 100 );
function wpwhpro_emails_throw_custom_notice(){

	if( ! defined( 'WPWHPRO_SETUP' ) && ! defined( 'WPWH_SETUP' ) ){

			ob_start();
			?>
			<div class="notice notice-warning">
				<p><?php echo sprintf( '<strong>' . WPWH_EMAILS_PLUGIN_NAME . '</strong> is active, but <strong>WP Webhooks</strong> or <strong>WP Webhooks Pro</strong> isn\'t. Please activate it to use the functionality for <strong>emails</strong>. <a href="%s" target="_blank" rel="noopener">More Info</a>', 'https://ironikus.com/downloads/wp-webhooks/' ); ?></p>
			</div>
			<?php
			echo ob_get_clean();

	}

}