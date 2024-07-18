<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
	protected $dashboard = 'dashboard'; // Property to hold the name of the dashboard table

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
		// Load the database library
		$this->load->database();
	}

	/**
	 * Get the total number of kecamatan (districts) from the database
	 *
	 * @return int Total number of kecamatan
	 */
	function totalKecamatan()
	{
		$query = $this->db->get('kecamatan'); // Perform a query to get all rows from the 'kecamatan' table
		return $query->num_rows(); // Return the number of rows retrieved
	}

	/**
	 * Get the total number of gereja (churches) from the database
	 *
	 * @return int Total number of gereja
	 */
	function totalGereja()
	{
		$query = $this->db->get('data_gereja'); // Perform a query to get all rows from the 'data_gereja' table
		return $query->num_rows(); // Return the number of rows retrieved
	}

	/**
	 * Get the total number of jemaat (congregation members) across all gereja
	 *
	 * @return int Total number of jemaat
	 */
	function totalJemaat()
	{
		$this->db->select('SUM(jumlah_jemaat) as total_jemaat'); // Selects the sum of 'jumlah_jemaat' column as 'total_jemaat'
		$query = $this->db->get('data_gereja'); // Perform a query to get all rows from the 'data_gereja' table
		// Return total_jemaat if available, otherwise default to 0
		return $query->row()->total_jemaat ?: 0;
	}

	/**
	 * Get the total number of admin users with role 2 (admin gereja) from the database
	 *
	 * @return int Total number of admin gereja
	 */
	function totalAdminGereja()
	{
		$this->db->where('role', 2); // Adds a condition to select users with role 2
		$query = $this->db->get('users'); // Perform a query to get all rows from the 'users' table
		return $query->num_rows(); // Return the number of rows retrieved
	}
}

/* End of file Dashboard_model.php and path \application\models\Dashboard_model.php */
