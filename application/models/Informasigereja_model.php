<?php

defined('BASEPATH') or exit('No direct script access allowed'); // Prevents direct access to the file

class Informasigereja_model extends CI_Model
{
    // Define properties for the table name, primary key, user role, and user church ID
    protected $table = 'informasi_gereja';
    protected $primaryKey = 'id';
    protected $roleUser;
    protected $idGerejaUser;

    // Constructor to initialize the model
    public function __construct()
    {
        parent::__construct(); // Call the parent constructor
        $this->load->database(); // Load the database library
        // Set the user role and church ID using a hypothetical detailUser function
        $this->roleUser = detailUser() ? detailUser()->role : 0;
        $this->idGerejaUser = detailUser() ? detailUser()->id_gereja : 0;
    }

    // Private method to set up the select query with joins and optional filters
    private function select($role = null, $id_user = null)
    {
        $this->db->select('a.*,b.nama as gereja,c.id as id_kecamatan,c.nama as kecamatan'); // Select columns from multiple tables
        $this->db->from($this->table . ' a'); // From 'informasi_gereja' table with alias 'a'
        $this->db->join('data_gereja b', 'a.id_gereja = b.id', 'inner'); // Join 'data_gereja' table with alias 'b'
        $this->db->join('kecamatan c', 'b.id_kecamatan = c.id', 'inner'); // Join 'kecamatan' table with alias 'c'
        // Add a condition if the user's role is 2 (assuming 2 is a specific role)
        if ($this->roleUser == 2) {
            $this->db->where('a.id_gereja', $this->idGerejaUser); // Filter by the user's church ID
        }
        // Add a condition if 'kecamatan' is provided in the request
        if ($this->input->get('kecamatan') != null) {
            $this->db->where('b.id_kecamatan', $this->input->get('kecamatan')); // Filter by 'id_kecamatan'
        }
        // Add a condition if 'gereja' is provided in the request
        if ($this->input->get('gereja') != null) {
            $this->db->where('a.id_gereja', $this->input->get('gereja')); // Filter by 'id_gereja'
        }
        $this->db->order_by('a.id', 'desc'); // Order by 'id' in descending order
    }

    // Method to get all records
    public function getAll()
    {
        $this->select(); // Set up the select query
        return $this->db->get()->result(); // Execute the query and return the results
    }

    // Method to get a single record by ID
    public function getSingle($id)
    {
        $this->select(); // Set up the select query
        $this->db->where('a.id', $id); // Filter by the given ID
        return $this->db->get()->row(); // Execute the query and return a single row
    }

    // Method to insert a new record
    public function insert($data)
    {
        return $this->db->insert($this->table, $data); // Insert the data into the table and return the result
    }

    // Method to update a record by ID
    public function update($id, $data)
    {
        $this->db->where('id', $id); // Filter by the given ID
        return $this->db->update($this->table, $data); // Update the record with the new data and return the result
    }

    // Method to delete a record by ID
    public function delete($id)
    {
        $this->db->where('id', $id); // Filter by the given ID
        return $this->db->delete($this->table); // Delete the record and return the result
    }

    // Method to get church information with pagination
    public function get_gereja_info($limit = 4, $offset)
    {
        $this->select(); // Set up the select query
        $this->db->limit($limit, $offset); // Set the limit and offset for pagination
        $query = $this->db->get(); // Execute the query
        return $query->result(); // Return the results
    }

    // Method to get the total number of church information records
    public function get_total_gereja_info()
    {
        $this->select(); // Set up the select query
        return $this->db->get()->num_rows(); // Execute the query and return the total number of rows
    }
}

/* End of file Informasigereja_model.php and path \application\models\Informasigereja_model.php */
