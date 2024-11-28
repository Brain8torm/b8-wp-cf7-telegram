<?php

namespace B8\WPCF7Telegram;

class Admin
{
    public function register_hooks()
    {
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    public function add_admin_menu()
    {
        add_menu_page(
            'My Class Plugin',
            'My Plugin',
            'manage_options',
            'my-class-plugin',
            [$this, 'render_admin_page'],
            'dashicons-admin-generic',
            6
        );
    }

    public function render_admin_page()
    {
        echo '<div class="wrap"><h1>My Class Plugin Settings</h1></div>';
    }
}
