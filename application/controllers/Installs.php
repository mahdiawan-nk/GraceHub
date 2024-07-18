<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Installs extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $db_exists = $this->check_database();
        if (!$db_exists) {
            view_output('install/index', []);
            return;
        }

        redirect(base_url('/'));
    }


    private function check_database()
    {
        // Ambil konfigurasi database dari config/database.php
        $db_config = $this->load->database('default', true, true);

        // Menggunakan helper untuk memeriksa apakah database ada
        return database_exists(
            $db_config->hostname,
            $db_config->username,
            $db_config->password,
            $db_config->database
        );
    }

    public function process_installation($steps)
    {
        $this->load->database();
        $this->load->model('Install_model');
        $this->load->helper('file');

        switch ($steps) {
            case 1:
                $this->form_validation->set_rules('app_name', 'Nama Aplikasi', 'trim|required');
                $this->form_validation->set_rules('author', 'Author Aplikasi', 'trim|required');
                $this->form_validation->set_rules('deskripsi', 'Deskripsi Aplikasi', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    // Jika validasi gagal, kembali ke form instalasi
                    $response = array(
                        'status' => 'error',
                        'message' => validation_errors()
                    );
                    view_output('', $response, true);
                    return;
                }
                $app_name = $this->input->post('app_name');
                $app_author = $this->input->post('author');
                $app_description = $this->input->post('description');

                $config_content = "<?php
                defined('BASEPATH') OR exit('No direct script access allowed');

                /*
                |--------------------------------------------------------------------------
                | Application Configurations
                |--------------------------------------------------------------------------
                |
                | This file lets you define the basic information about your application
                | such as the name, version, and any other custom configuration you may need.
                |
                */

                \$config['app_name'] = '$app_name';
                \$config['app_version'] = '1.0.0';
                \$config['app_author'] = '$app_author';
                \$config['app_description'] = '$app_description';
                ";

                if (write_file(APPPATH . 'config/app_config.php', $config_content)) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Configuration updated successfully.'
                    );
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Failed to update configuration.'
                    );
                }
                view_output('', $response, true);
                break;
            case 2:
                $this->form_validation->set_rules('db_hostname', 'Database Hostname', 'trim|required');
                $this->form_validation->set_rules('db_username', 'Database Username', 'trim|required');
                $this->form_validation->set_rules('db_name', 'Database Name', 'trim|required');

                $dbHostname = $this->input->post('db_hostname');
                $dbUsername = $this->input->post('db_username');
                $dbPassword = $this->input->post('db_password');
                $dbName = $this->input->post('db_name');
                if ($this->form_validation->run() == FALSE) {
                    // Jika validasi gagal, kembali ke form instalasi
                    $response = array(
                        'status' => 'error',
                        'message' => validation_errors()
                    );
                    view_output('', $response, true);
                    return;
                }
                $result = $this->Install_model->setup_database($dbName);

                if ($result) {
                    $config['hostname'] = $dbHostname;
                    $config['username'] = $dbUsername;
                    $config['password'] = $dbPassword;
                    $config['database'] = $dbName;
                    $this->save_db_config($config);
                    $this->Install_model->create_tables();

                    $response = array(
                        'status' => 'success',
                        'message' => 'Database setup successfully.',
                        'data' => $result
                    );
                } else {
                    $error = $this->db->error();
                    $response = array(
                        'status' => 'error',
                        'message' => $error['message'],
                        'data' => $result
                    );
                }
                view_output('', $response, true);
                break;
            case 3:
                $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
                $this->form_validation->set_rules('username', 'Username', 'trim|required');
                $this->form_validation->set_rules('email', 'email', 'trim|required');
                $this->form_validation->set_rules('password', 'password', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    // Jika validasi gagal, kembali ke form instalasi
                    $response = array(
                        'status' => 'error',
                        'message' => validation_errors()
                    );
                    view_output('', $response, true);
                    return;
                }

                $namaLengkap = $this->input->post('nama_lengkap');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $email = $this->input->post('email');

                $this->Install_model->insertKecamatan();
                $this->Install_model->InsertUser($namaLengkap, $username, $email, $password);

                $error = $this->db->error();
                if ($error['code'] == 0) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Admin account created successfully.'
                    );
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => $error['message']
                    );
                }
                view_output('', $response, true);
                break;
            default:
                # code...
                break;
        }
    }

    private function save_db_config($config)
    {
        // Path ke file konfigurasi database.php
        $file_path = APPPATH . 'config/database.php';

        // Baca isi file database.php
        $content = file_get_contents($file_path);

        // Ubah bagian konfigurasi database
        $pattern = "/(\\\$db\['default'\]\s*=\s*array\()([\s\S]*?)(\);)/";
        preg_match($pattern, $content, $matches);

        if (!isset($matches[2])) {
            show_error('Konfigurasi database tidak ditemukan.');
        }

        $existing_config = $matches[2];

        // Array konfigurasi baru
        $new_config = "\n\t'dsn' => '',";
        foreach ($config as $key => $value) {
            $new_config .= "\n\t'$key' => '$value',";
        }
        $new_config .= "\n\t'dbdriver' => 'mysqli',";
        $new_config .= "\n\t'dbprefix' => '',";
        $new_config .= "\n\t'pconnect' => FALSE,";
        $new_config .= "\n\t'db_debug' => (ENVIRONMENT !== 'production'),";
        $new_config .= "\n\t'cache_on' => FALSE,";
        $new_config .= "\n\t'cachedir' => '',";
        $new_config .= "\n\t'char_set' => 'utf8',";
        $new_config .= "\n\t'dbcollat' => 'utf8_general_ci',";
        $new_config .= "\n\t'swap_pre' => '',";
        $new_config .= "\n\t'encrypt' => FALSE,";
        $new_config .= "\n\t'compress' => FALSE,";
        $new_config .= "\n\t'stricton' => FALSE,";
        $new_config .= "\n\t'failover' => array(),";
        $new_config .= "\n\t'save_queries' => TRUE";

        // Gantikan konfigurasi yang ada dengan konfigurasi baru
        $new_content = preg_replace($pattern, "\\1$new_config\\3", $content);

        // Tulis kembali ke file database.php
        if (file_put_contents($file_path, $new_content) === FALSE) {
            // Jika gagal menyimpan, handle error sesuai kebutuhan aplikasi
            show_error('Gagal menyimpan konfigurasi database.');
        }
    }
    // private function save_db_config($config)
    // {
    //     $this->load->helper('file');

    //     // Baca file konfigurasi database.php
    //     $file_path = APPPATH . 'config/database.php';
    //     $content = file_get_contents($file_path);

    //     // Ubah bagian konfigurasi database
    //     $pattern = '/\$db\[\'default\'\]\s+=\s+array\(([\s\S]*?)\);/';
    //     preg_match($pattern, $content, $matches);
    //     $existing_config = isset($matches[1]) ? $matches[1] : '';

    //     // Bangun konfigurasi baru
    //     $new_config = '';
    //     foreach ($config as $key => $value) {
    //         $new_config .= "\n\t'$key' => '$value',";
    //     }
    //     $new_config = rtrim($new_config, ',');

    //     // Gantikan konfigurasi yang ada dengan konfigurasi baru
    //     $new_content = preg_replace($pattern, "\$db['default'] = array($existing_config,$new_config\n);", $content);

    //     // Tulis kembali ke file database.php
    //     if (!write_file($file_path, $new_content)) {
    //         // Jika gagal menyimpan, handle error sesuai kebutuhan aplikasi
    //         show_error('Gagal menyimpan konfigurasi database.');
    //     }
    // }
}

/* End of file Installs.php and path \application\controllers\Installs.php */
