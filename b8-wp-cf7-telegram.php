<?php
/*
Plugin Name: B8 WP CF7 Telegram
Description: B8 WP CF7 Telegram - plugin which allows you to send notifications from CF7 forms to Telegram.
Version: 1.0
Author: Brain8torm.ru
Author URI: https://brain8torm.ru/
*/

if (!defined('ABSPATH')) {
    exit;
}

define('B8_WPCF7TELEGRAM_VERSION', '1.0');

require_once plugin_dir_path(__FILE__) . 'includes/Init.php';

function run_my_class_plugin()
{
    \B8\WPCF7Telegram\Init::get_instance();
}
run_my_class_plugin();

register_activation_hook(__FILE__, ['\B8\WPCF7Telegram\Init', 'activate']);
register_deactivation_hook(__FILE__, ['\B8\WPCF7Telegram\Init', 'deactivate']);
