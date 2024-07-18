<?php

defined('BASEPATH') or exit('No direct script access allowed'); // Prevent direct access to the file

class Datagereja_model extends CI_Model
{
    protected $table = 'data_gereja'; // Define the table name as a property

    public function __construct()
    {
        parent::__construct(); // Call the parent constructor
        $this->load->database(); // Load the database library
    }

    // Private method to set up the select query with joins and optional filters
    private function select($role = null, $id_user = null)
    {
        $this->db->select('a.*, b.nama as kecamatan'); // Select all columns from 'data_gereja' and 'nama' from 'kecamatan'
        $this->db->from($this->table . ' a'); // From 'data_gereja' table with alias 'a'
        $this->db->join('kecamatan b', 'a.id_kecamatan = b.id', 'inner'); // Join 'kecamatan' table with alias 'b'
        $this->db->order_by('a.id', 'desc'); // Order the results by 'id' in descending order
        if ($this->input->get('kecamatan') != null) { // If 'kecamatan' is provided in the request
            $this->db->where('a.id_kecamatan', $this->input->get('kecamatan')); // Add where clause for 'id_kecamatan'
        }
    }

    // Method to get all records
    public function getAll()
    {
        $user = detailUser(); // Get the details of the current user
        $role = $user->role; // Get the role of the user
        $id_user = $user->id; // Get the ID of the user

        $this->select($role, $id_user); // Call the select method with user role and ID
        return $this->db->get()->result(); // Execute the query and return the result
    }

    // Method to get a single record by ID
    public function getSingle($id)
    {
        $this->select(); // Call the select method without parameters
        $this->db->where('a.id', $id); // Add where clause for the specific ID
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
        $this->db->where('id', $id); // Add where clause for the specific ID
        return $this->db->update($this->table, $data); // Update the record with the new data and return the result
    }

    // Method to delete a record by ID
    public function delete($id)
    {
        $this->db->where('id', $id); // Add where clause for the specific ID
        return $this->db->delete($this->table); // Delete the record and return the result
    }

    // Method to check if a record has relations
    public function hasRelations($id)
    {
        $this->db->where('id', $id); // Add where clause for the specific ID
        $query = $this->db->get($this->table); // Execute the query
        return $query->num_rows() > 0; // Return true if the record has relations, otherwise false
    }

    // Method to get records with pagination and optional search
    public function get_gereja($limit = 4, $offset)
    {
        if ($this->input->get('search')) { // If 'search' is provided in the request
            $this->db->like('nama', $this->input->get('search')); // Add like clause for 'nama'
            $this->db->or_like('pimpinan', $this->input->get('search')); // Add like clause for 'pimpinan'
            $this->db->or_like('lokasi', $this->input->get('search')); // Add like clause for 'lokasi'
        }

        if ($this->input->get('kecamatan')) { // If 'kecamatan' is provided in the request
            $this->db->where('id_kecamatan', $this->input->get('kecamatan')); // Add where clause for 'id_kecamatan'
        }
        $this->db->limit($limit, $offset); // Set limit and offset for pagination
        $query = $this->db->get($this->table); // Execute the query
        return $query->result(); // Return the result
    }

    // Method to get the total number of records with optional search
    public function get_total_gereja()
    {
        if ($this->input->get('search')) { // If 'search' is provided in the request
            $this->db->like('nama', $this->input->get('search')); // Add like clause for 'nama'
            $this->db->or_like('pimpinan', $this->input->get('search')); // Add like clause for 'pimpinan'
            $this->db->or_like('lokasi', $this->input->get('search')); // Add like clause for 'lokasi'
        }

        if ($this->input->get('kecamatan')) { // If 'kecamatan' is provided in the request
            $this->db->where('id_kecamatan', $this->input->get('kecamatan')); // Add where clause for 'id_kecamatan'
        }

        return $this->db->get($this->table)->num_rows(); // Execute the query and return the total number of rows
    }
}
