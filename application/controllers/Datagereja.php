<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Datagereja Controller
 *
 * This controller handles CRUD operations for 'Data Gereja' including listing, showing,
 * storing, updating, and deleting data.
 */
class Datagereja extends CI_Controller
{
    protected $baseLayout = 'layouts/backend/app';  // Base layout for the views
    protected $roleUser;  // User role
    protected $pagesUser;  // Pages based on user role

    /**
     * Constructor for the class.
     *
     * This function is called when an object of the class is created.
     * It initializes the parent constructor, loads the 'datagereja_model' model,
     * and sets the user role and pages based on the user role.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('datagereja_model', 'datagereja');  // Loading the 'datagereja_model' model as 'datagereja'
        $this->roleUser = detailUser()->role;  // Setting the user role
        $this->pagesUser = detailUser()->role == 1 ? 'list' : 'show';  // Setting the pages based on user role
    }

    /**
     * Default function for the Datagereja controller.
     *
     * This function sets the title, subtitle, and pages for the view,
     * and loads the view with this data.
     *
     * @return void
     */
    public function index()
    {
        $data['title'] = "Data Gereja";  // Setting the page title
        $data['subtitle'] = "All Dashboard";  // Setting the page subtitle
        $data['pages'] = '/backend/data-gereja/' . $this->pagesUser;  // Setting the view page based on user role
        view_output($this->baseLayout, $data);  // Loading the base layout view with the $data array
    }

    /**
     * List all data.
     *
     * This function retrieves all data from the model and returns it in a success response.
     *
     * @return void
     */
    public function list()
    {
        $data = $this->datagereja->getAll();  // Retrieving all data
        $response = array(
            'status' => 'success',
            'message' => 'User found',
            'data' => $data
        );
        view_output($this->baseLayout, $response, true);  // Loading the base layout view with the response data
    }

    /**
     * Show data for a specific ID.
     *
     * This function retrieves data for a specific ID from the model and returns it in a success response.
     *
     * @param int $id The ID of the data to show
     * @return void
     */
    public function show($id)
    {
        $data = $this->datagereja->getSingle($id);  // Retrieving data for a specific ID
        $response = array(
            'status' => 'success',
            'message' => 'User found',
            'data' => $data
        );
        view_output($this->baseLayout, $response, true);  // Loading the base layout view with the response data
    }

    /**
     * Store new data.
     *
     * This function validates the input data and inserts it into the database if validation is successful.
     *
     * @return void
     */
    public function store()
    {
        $this->form_validation->set_message('required', '{field} Field Tidak Boleh Kosong.');  // Setting custom validation message
        $this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'required');  // Setting validation rules
        $this->form_validation->set_rules('nama', 'Nama Gereja', 'required');
        $this->form_validation->set_rules('aliran', 'Aliran Gereja', 'required');
        $this->form_validation->set_rules('sejarah', 'Sejarah Gereja', 'required');
        $this->form_validation->set_rules('visi', 'Visi', 'required');
        $this->form_validation->set_rules('misi', 'Misi', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');

        if ($this->form_validation->run() == FALSE) {  // Checking if validation failed
            $response = array(
                'status' => 'error',
                'message' => validation_errors()
            );
        } else {
            $dataPost = (object)$this->input->post();  // Retrieving the input data
            $dataPost->id_user = detailUser()->id;  // Setting the user ID
            $this->datagereja->insert($dataPost);  // Inserting the data into the database
            $response = array(
                'status' => 'success',
                'message' => 'Data inserted successfully',
                'data' => $dataPost
            );
        }
        view_output('', $response, true);  // Loading the view with the response data
    }

    /**
     * Update data for a specific ID.
     *
     * This function updates the data for a specific ID in the database.
     *
     * @param int $id The ID of the data to update
     * @return void
     */
    public function update($id)
    {
        $dataPost = $this->input->post();  // Retrieving the input data
        $dataPost['updated_at'] = date('Y-m-d H:i:s');  // Setting the updated_at timestamp

        $updateResult = $this->datagereja->update($id, $dataPost);  // Updating the data in the database

        if ($updateResult) {  // Checking if the update was successful
            $response = array(
                'status' => 'success',
                'message' => 'Data updated successfully',
                'data' => $dataPost
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Failed to update data'
            );
        }
        view_output('', $response, true);  // Loading the view with the response data
    }

    /**
     * Delete data for a specific ID.
     *
     * This function deletes the data for a specific ID from the database.
     *
     * @param int $id The ID of the data to delete
     * @return void
     */
    public function destroy($id)
    {
        $this->datagereja->delete($id);  // Deleting the data from the database
        $response = array(
            'status' => 'success',
            'message' => 'Data deleted successfully'
        );
        view_output('', $response, true);  // Loading the view with the response data
    }
}

/* End of file Datagereja.php and path \application\controllers\Datagereja.php */