<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Install_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Load database untuk penggunaan database
        // $result =$this->dbforge->create_database($database);
    }

    public function setup_database($database)
    {
        $this->load->database();
        $this->load->dbforge();
        $query = $this->db->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'");
        if ($query->num_rows() > 0) {
            // Drop the existing database
            $this->dbforge->drop_database($database); // Drop the database
        }
        $result = $this->dbforge->create_database($database);
        return $result;
    }

    public function create_tables()
    {
        $this->tableDataGereja();
        $this->tableInformasiGereja();
        $this->tableKecamatan();
        $this->tableUser();
        return true;
    }

    public function insertKecamatan()
    {
        $this->load->database('default');
        $this->db->close();
        $this->db->reconnect();
        $this->load->database('default');
        $kecamatan = array(
            array(
                'nama' => 'Salo',
            ),
            array(
                'nama' => 'Bangkinang Kota',
            )
        );
        $this->db->insert_batch('kecamatan', $kecamatan);
    }

    public function insertUser($nama_lengkap, $username, $email, $password)
    {
        $this->load->database('default');
        $this->db->close();
        $this->db->reconnect();
        $this->load->database('default');
        $user = array(
            array(
                'nama_lengkap' => $nama_lengkap,
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'role' => 1,
            )
        );
        $this->db->insert_batch('users', $user);
    }

    private function tableDataGereja()
    {
        $this->load->database('default');
        $this->db->close();
        $this->db->reconnect();
        $this->load->database('default');
        $this->load->dbforge();
        $fields_data_gereja = array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'aliran' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'pimpinan' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'sejarah' => array(
                'type' => 'TEXT',
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'visi' => array(
                'type' => 'TEXT',
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'misi' => array(
                'type' => 'TEXT',
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'lokasi' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'id_kecamatan' => array(
                'type' => 'INT',
                'null' => FALSE,
            ),
            'id_user' => array(
                'type' => 'INT',
                'null' => FALSE,
            ),
            'jumlah_jemaat' => array(
                'type' => 'INT',
                'null' => FALSE,
                'default' => 0,
            ),
            'foto' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => FALSE,
                'collate' => 'utf8mb4_general_ci',
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_field($fields_data_gereja);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('data_gereja');

        $this->db->query('ALTER TABLE `data_gereja` MODIFY `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->db->query('ALTER TABLE `data_gereja` MODIFY `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    }

    private function tableInformasiGereja()
    {
        $this->load->database('default');
        $this->db->close();
        $this->db->reconnect();
        $this->load->database('default');
        $this->load->dbforge();
        $fields_informasi_gereja = array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_gereja' => array(
                'type' => 'INT',
                'null' => FALSE,
            ),
            'jadwal' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
            ),
            'jenis_ibadah' => array(
                'type' => 'VARCHAR',
                'constraint' => 75,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'tata_laksana' => array(
                'type' => 'TEXT',
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'no_telp' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,

            ),
            'keterangan' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
        );

        $this->dbforge->add_field($fields_informasi_gereja);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('informasi_gereja');

        $this->db->query('ALTER TABLE `informasi_gereja` MODIFY `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->db->query('ALTER TABLE `informasi_gereja` MODIFY `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    }

    private function tableKecamatan()
    {
        $this->load->database('default');
        $this->db->close();
        $this->db->reconnect();
        $this->load->database('default');
        $this->load->dbforge();

        $fields_kecamatan = array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => 75,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
        );

        $this->dbforge->add_field($fields_kecamatan);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('kecamatan');

        $this->db->query('ALTER TABLE `kecamatan` MODIFY `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->db->query('ALTER TABLE `kecamatan` MODIFY `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    }

    private function tableUser()
    {
        $this->load->database('default');
        $this->db->close();
        $this->db->reconnect();
        $this->load->database('default');
        $this->load->dbforge();


        $fields_users = array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_gereja' => array(
                'type' => 'INT',
                'null' => TRUE,
            ),
            'nama_lengkap' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
                'unique' => TRUE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
                'unique' => TRUE,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'collate' => 'utf8mb4_general_ci',
                'null' => FALSE,
            ),
            'role' => array(
                'type' => 'INT',
                'null' => FALSE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
        );

        $this->dbforge->add_field($fields_users);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');

        $this->db->query('ALTER TABLE `users` MODIFY `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->db->query('ALTER TABLE `users` MODIFY `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    }
}


/* End of file Install_model.php and path \application\models\Install_model.php */
