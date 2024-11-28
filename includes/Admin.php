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
            'B8 WP CF7 Telegram',
            'B8 WP CF7 Telegram',
            'manage_options',
            'b8-wp-cf7-telegram-settings',
            [$this, 'render_admin_page'],
            'dashicons-admin-generic',
            6
        );
    }

    public function render_admin_page()
    {
        $output = '';
        $output .= '<div class="wrap">';
        $output .= '<h1>' . __('WP CF7 Telegram Settings', 'b8-wp-cf7-telegram') . '</h1>';

        if (class_exists('WPCF7_ContactForm')) {
            // Получаем все формы
            $forms = WPCF7_ContactForm::find();

            // Перебираем формы
            foreach ($forms as $form) {
                $output .= 'ID: ' . $form->id() . '<br>';
                $output .= 'Название: ' . $form->title() . '<br>';
                $output .= 'Краткий код: [contact-form-7 id="' . $form->id() . '" title="' . $form->title() . '"]<br><hr>';
            }
        } else {
            echo 'Contact Form 7 не активен.';
        }
        $output .= '</div>';
        echo $output;
    }
}
