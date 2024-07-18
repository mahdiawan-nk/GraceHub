<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Check if the database exists, if not, redirect to installation page
		$db_exists = check_database();
		if (!$db_exists) {
			redirect(base_url('installs'));
			return;
		}
		// Load the database and models
		$this->load->database();
		$this->load->model('Datagereja_model', 'datagereja');
		$this->load->model('Informasigereja_model', 'informasigereja');
	}

	public function index()
	{
		// Fetch all kecamatan (districts) with their IDs and names
		$this->db->select('id, nama');
		$kecamatan = $this->db->get('kecamatan')->result();

		// Iterate through each kecamatan to get the count of gereja (churches) in each district
		foreach ($kecamatan as $item) {
			$item->total_gereja = $this->db->where('id_kecamatan', $item->id)->count_all_results('data_gereja');
		}

		// Fetch the total number of jemaat (congregation members) from all churches
		$this->db->select_sum('jumlah_jemaat', 'total_jemaat');
		$totalJemaat = $this->db->get('data_gereja')->row();

		// Prepare the data array to be passed to the view
		$data = [
			'kecamatan' => $kecamatan, // List of kecamatan with church counts
			'jemaat' => $totalJemaat->total_jemaat, // Total number of congregation members
			'pages' => 'welcome_message' // Page to be displayed
		];

		// Render the view with the data
		view_output('layouts/frontend/app', $data);
	}

	public function get_data()
	{
		// Fetch limit and offset parameters from the GET request
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');

		// Prepare the data array with paginated church data and total church count
		$data = [
			'data' => $this->datagereja->get_gereja($limit, $offset), // Paginated list of churches
			'total' => $this->datagereja->get_total_gereja() // Total count of churches
		];

		// Render the view with the data, setting the third parameter to true for JSON response
		view_output('welcome_message', $data, true);
	}

	public function get_data_info()
	{
		// Fetch limit and offset parameters from the GET request
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');

		// Prepare the data array with paginated church info data and total info count
		$data = [
			'data' => $this->informasigereja->get_gereja_info($limit, $offset), // Paginated list of church info
			'total' => $this->informasigereja->get_total_gereja_info() // Total count of church info
		];

		// Render the view with the data, setting the third parameter to true for JSON response
		view_output('welcome_message', $data, true);
	}

	public function kecamatan()
	{
		// Fetch all kecamatan (districts) from the database
		$data = $this->db->get('kecamatan')->result();

		// Prepare the response array
		$response = [
			'status' => 'success',
			'message' => 'Data updated successfully',
			'data' => $data // List of kecamatan
		];

		// Render the response as JSON
		view_output('', $response, true);
	}

	public function page_gereja($id)
	{
		// Check if the kecamatan with the given ID exists
		$isExistData = $this->db->get_where('kecamatan', ['id' => $id])->row();

		// Prepare the data array based on the existence of the kecamatan
		$data = [
			'pages' => $isExistData ? 'data_gereja' : 'errors/404_page', // Set the page to data_gereja or 404 error
			'idkec' => $id // Pass the kecamatan ID
		];

		// Render the view with the data
		view_output('layouts/frontend/app', $data);
	}

	public function info_gereja($id)
	{
		// Check if the kecamatan with the given ID exists
		$isExistData = $this->db->get_where('kecamatan', ['id' => $id])->row();

		// Prepare the data array based on the existence of the kecamatan
		$data = [
			'pages' => $isExistData ? 'info_gereja' : 'errors/404_page', // Set the page to info_gereja or 404 error
			'idkec' => $id // Pass the kecamatan ID
		];

		// Render the view with the data
		view_output('layouts/frontend/app', $data);
	}
}

/* End of file Welcome.php and path \application\controllers\Welcome.php */
