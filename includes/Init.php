<?php

namespace B8\WPCF7Telegram;

class Init
{
    private static $instance;

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        // Подключение классов
        $this->load_dependencies();

        // Регистрация хуков
        $this->register_hooks();
    }

    private function load_dependencies()
    {
        require_once plugin_dir_path(__FILE__) . 'Admin.php';
        require_once plugin_dir_path(__FILE__) . 'Frontend.php';
    }

    private function register_hooks()
    {
        // Админская часть
        if (is_admin()) {
            $admin = new Admin();
            $admin->register_hooks();
        }

        // Фронтенд
        $frontend = new Frontend();
        $frontend->register_hooks();
    }

    public static function activate()
    {
        if (!current_user_can('activate_plugins')) {
            return;
        }

        add_option('b8-wp-cf7-telegram-version', B8_WPCF7TELEGRAM_VERSION);
    }

    // Метод деактивации
    public static function deactivate()
    {
        if (!current_user_can('activate_plugins')) {
            return;
        }

        delete_option('b8-wp-cf7-telegram-version');
    }
}
