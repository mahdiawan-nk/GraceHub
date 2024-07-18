<?php

defined('BASEPATH') or exit('No direct script access allowed'); // Prevents direct access to the file

class Users_model extends CI_Model
{
    // Define properties for the table name and primary key
    protected $table = 'users';
    protected $primaryKey = 'id';

    // Constructor to initialize the model
    public function __construct()
    {
        parent::__construct(); // Call the parent constructor
        $this->load->database(); // Load the database library
    }

    // Private method to set up the select query
    private function select()
    {
        $this->db->select('a.*'); // Select all columns from the table with alias 'a'
        $this->db->from($this->table . ' a'); // From 'users' table with alias 'a'
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
}

/* End of file Users_model.php and path \application\models\Users_model.php */
