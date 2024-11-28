<?php

namespace B8\WPCF7Telegram;

class Frontend
{
    public function register_hooks()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_scripts()
    {
        wp_enqueue_style('my-plugin-styles', plugin_dir_url(__FILE__) . '../assets/css/style.css');
        wp_enqueue_script('my-plugin-scripts', plugin_dir_url(__FILE__) . '../assets/js/script.js', [], false, true);
    }
}
