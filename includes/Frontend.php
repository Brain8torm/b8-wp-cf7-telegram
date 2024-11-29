<?php

namespace B8\WPCF7Telegram;

class Frontend
{
    public function register_hooks()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wpcf7_mail_sent', [$this, 'send_to_telegram']);


    }

    public function enqueue_scripts()
    {
        wp_enqueue_style('my-plugin-styles', plugin_dir_url(__FILE__) . '../assets/css/style.css');
        wp_enqueue_script('my-plugin-scripts', plugin_dir_url(__FILE__) . '../assets/js/script.js', [], false, true);
    }

    function send_to_telegram($contact_form) {
        // Ваш токен бота
        $telegram_bot_token = '7616178264:AAHc556HxdVZYStoONs67CBfHk9r2LsL8To';
        // Ваш ID чата
        $chat_id = '-1002358627395';
    
        // Получение данных формы
        $submission = \WPCF7_Submission::get_instance();
        if ($submission) {
            $data = $submission->get_posted_data();
    
            // Формирование сообщения
            $message = "Новая отправка формы:\n";
            $message .= "Форма: " . $contact_form->title() . "\n";
            foreach ($data as $key => $value) {
                if (strpos($key, '_') !== 0) { // Пропустить служебные поля
                    $message .= ucfirst($key) . ": " . $value . "\n";
                }
            }
    
            // URL для отправки сообщения в Telegram
            $telegram_api_url = "https://api.telegram.org/bot$telegram_bot_token/sendMessage";
    
            // Отправка сообщения через cURL
            $response = wp_remote_post($telegram_api_url, [
                'method' => 'GET',
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => [
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                ],
            ]);
    
            // Логирование ошибок, если есть
            if (is_wp_error($response)) {
                error_log('Ошибка отправки в Telegram: ' . $response->get_error_message());
            }
        }
    }
}
