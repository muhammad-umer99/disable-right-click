<?php
/**
  * Plugin Name: Disable Right Click & Copy
 * Plugin URI: https://github.com/muhammad-umer99/disable-right-click
 * Description: A simple plugin to disable right-click and text selection to prevent content copying.
 * Version: 1.0
 * Author: Muhammad Umer
 * Author URI: https://www.linkedin.com/in/muhammad-umer-abbas/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue JavaScript file
function drc_enqueue_scripts() {
    wp_enqueue_script('drc-script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'), '1.3', true);
    
    // Pass PHP options to JavaScript
    wp_localize_script('drc-script', 'drc_vars', array(
        'disable_right_click' => get_option('drc_disable_right_click', '1'),
        'disable_text_selection' => get_option('drc_disable_text_selection', '1')
    ));
}
add_action('wp_enqueue_scripts', 'drc_enqueue_scripts');

// Add settings menu
function drc_add_admin_menu() {
    add_options_page('Disable Right Click', 'Disable Right Click', 'manage_options', 'disable-right-click', 'drc_settings_page');
}
add_action('admin_menu', 'drc_add_admin_menu');

// Register plugin settings with sanitization
function drc_register_settings() {
    register_setting('drc_settings_group', 'drc_disable_right_click', 'sanitize_text_field');
    register_setting('drc_settings_group', 'drc_disable_text_selection', 'sanitize_text_field');
}
add_action('admin_init', 'drc_register_settings');

// Settings Page
function drc_settings_page() {
    ?>
    <div class="wrap">
        <h1>Disable Right Click & Copy Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('drc_settings_group'); ?>
            <?php do_settings_sections('drc_settings_group'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Disable Right Click</th>
                    <td><input type="checkbox" name="drc_disable_right_click" value="1" <?php checked(1, get_option('drc_disable_right_click', '1')); ?>></td>
                </tr>
                <tr>
                    <th scope="row">Disable Text Selection</th>
                    <td><input type="checkbox" name="drc_disable_text_selection" value="1" <?php checked(1, get_option('drc_disable_text_selection', '1')); ?>></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
?>
