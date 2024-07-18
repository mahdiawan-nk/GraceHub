<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Dashboard Controller
 *
 * This controller handles the display of the dashboard and retrieves various data
 * statistics such as total kecamatan, total gereja, total jemaat, and total admin gereja.
 */
class Dashboard extends CI_Controller
{
    /**
     * Constructor for the class.
     *
     * This function is called when an object of the class is created.
     * It initializes the parent constructor and loads the 'Dashboard_model' model
     * using the alias 'widgets'.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model', 'widgets');  // Loading the 'Dashboard_model' model as 'widgets'.
    }

    /**
     * Default function for the Dashboard controller.
     *
     * This function retrieves various statistics data and loads the dashboard view
     * with this data.
     *
     * @return void
     */
    public function index()
    {
        $data['kecamatan'] = $this->widgets->totalKecamatan();  // Retrieving total kecamatan.
        $data['gereja'] = $this->widgets->totalGereja();  // Retrieving total gereja.
        $data['jemaat'] = $this->widgets->totalJemaat();  // Retrieving total jemaat.
        $data['admin'] = $this->widgets->totalAdminGereja();  // Retrieving total admin gereja.
        $data['title'] = "Dashboard";  // Setting the page title.
        $data['subtitle'] = "All Dashboard";  // Setting the page subtitle.
        $data['pages'] = '/backend/dashboard';  // Setting the view page.
        view_output('layouts/backend/app', $data);  // Loading the 'layouts/backend/app' view with the $data array.
    }
}

/* End of file Dashboard.php and path \application\controllers\Dashboard.php */
