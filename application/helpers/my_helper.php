<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('view_output')) {
    function view_output($view, $data = array(), $debug = false)
    {
        $CI = &get_instance();

        if ($debug) {
            // Output JSON
            $CI->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
        } else {
            // Load view
            $CI->load->view($view, $data);
        }
    }
}

if (!function_exists('detailUser')) {
    function detailUser()
    {
        $CI = &get_instance();
        $CI->load->model('Auth_model', 'auth');
        $dataUser = $CI->auth->show();

        return $dataUser;
    }
}


if (!function_exists('dataKecamatan')) {
    function dataKecamatan()
    {
        $CI = &get_instance();
        $CI->load->database();
        $data = $CI->db->get('kecamatan')->result();

        return $data;
    }
}
if (!function_exists('encrypt_data')) {
    function encrypt_data($data)
    {
        $CI = &get_instance();
        $key = $CI->config->item('encryption_key');
        $cipher_method = 'aes-256-cbc';
        $iv_length = openssl_cipher_iv_length($cipher_method);
        $iv = openssl_random_pseudo_bytes($iv_length);
        $encrypted = openssl_encrypt($data, $cipher_method, $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }
}

if (!function_exists('decrypt_data')) {
    function decrypt_data($data)
    {
        $CI = &get_instance();
        $key = $CI->config->item('encryption_key');
        $cipher_method = 'aes-256-cbc';
        $iv_length = openssl_cipher_iv_length($cipher_method);
        $data = base64_decode($data);
        $iv = substr($data, 0, $iv_length);
        $encrypted_data = substr($data, $iv_length);
        return openssl_decrypt($encrypted_data, $cipher_method, $key, 0, $iv);
    }
}

function check_database()
{
    $CI = &get_instance();
    // Ambil konfigurasi database dari config/database.php
    $db_config = $CI->load->database('default', true, true);

    // Menggunakan helper untuk memeriksa apakah database ada
    return database_exists(
        $db_config->hostname,
        $db_config->username,
        $db_config->password,
        $db_config->database
    );
}

if (!function_exists('database_exists')) {
    function database_exists($hostname, $username, $password, $database)
    {
        $mysqli = new mysqli($hostname, $username, $password);

        if ($mysqli->connect_error) {
            return false;
        }

        $result = $mysqli->select_db($database);
        $mysqli->close();

        return $result;
    }
}

function appConfig() {
    $CI = &get_instance();

    return $CI->config->item('app_config');
}
