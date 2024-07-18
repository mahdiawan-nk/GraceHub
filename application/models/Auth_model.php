<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	// Define the names of the authentication table and users table
	protected $auth = 'auth';
	protected $table = 'users';

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
		// Load the database library
		$this->load->database();
	}

	/**
	 * Method to handle user login
	 *
	 * @param string $username The username of the user
	 * @param string $password The password of the user
	 * @return bool Returns TRUE if login is successful, otherwise FALSE
	 */
	public function login($username, $password)
	{
		// Fetch the user record by username
		$this->db->where('username', $username);
		$query = $this->db->get($this->table);

		// Check if the user exists
		if ($query->num_rows() == 1) {
			// Get the user record
			$user = $query->row();

			// Verify the password hash
			if (password_verify($password, $user->password)) {
				// Set session data if the password is correct
				$this->session->set_userdata(array(
					'token' => encrypt_data($user->id),
					'logged_in' => TRUE
				));
				return TRUE;
			}
		}
		// Return FALSE if the user does not exist or password is incorrect
		return FALSE;
	}

	/**
	 * Method to fetch the current user's details
	 *
	 * @return object Returns the user record as an object
	 */
	public function show()
	{
		// Fetch the user record by email stored in session data
		$this->db->where('id', decrypt_data($this->session->userdata('token')));
		$query = $this->db->get($this->table);
		return $query->row();
	}
}

/* End of file Auth_model.php and path \application\models\Auth_model.php */
