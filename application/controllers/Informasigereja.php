<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Informasigereja Controller
 *
 * This controller handles CRUD operations for 'Informasi Gereja' including listing, showing,
 * storing, updating, and deleting data.
 */
class Informasigereja extends CI_Controller
{
    /**
     * Constructor for the class.
     *
     * This function is called when an object of the class is created.
     * It initializes the parent constructor and loads the 'informasigereja_model' model.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('informasigereja_model', 'informasigereja');  // Loading the 'informasigereja_model' model as 'informasigereja'
    }

    /**
     * Default function for the Informasigereja controller.
     *
     * This function sets the title, subtitle, and pages for the view,
     * and loads the view with this data.
     *
     * @return void
     */
    public function index()
    {
        $data['title'] = "Informasi Gereja";  // Setting the page title
        $data['subtitle'] = "All Dashboard";  // Setting the page subtitle
        $data['pages'] = '/backend/informasi-gereja/list';  // Setting the view page
        view_output('layouts/backend/app', $data);  // Loading the base layout view with the $data array
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
        $data = $this->informasigereja->getAll();  // Retrieving all data
        $response = array(
            'status' => 'success',
            'message' => 'User found',
            'data' => $data
        );
        view_output('layouts/backend/app', $response, true);  // Loading the base layout view with the response data
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
        $data = $this->informasigereja->getSingle($id);  // Retrieving data for a specific ID
        $response = array(
            'status' => 'success',
            'message' => 'User found',
            'data' => $data
        );
        view_output('layouts/backend/app', $response, true);  // Loading the base layout view with the response data
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

        // Setting validation rules
        $this->form_validation->set_rules('id_gereja', 'Gereja', 'required');
        $this->form_validation->set_rules('jadwal', 'Jadwal', 'required');
        $this->form_validation->set_rules('jenis_ibadah', 'Jenis Ibadah', 'required');
        $this->form_validation->set_rules('tata_laksana', 'Tata Laksana', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required');

        if ($this->form_validation->run() == FALSE) {  // Checking if validation failed
            $response = array(
                'status' => 'error',
                'message' => validation_errors()
            );
        } else {
            $dataPost = (object)$this->input->post();  // Retrieving the input data
            $this->informasigereja->insert($dataPost);  // Inserting the data into the database
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

        $updateResult = $this->informasigereja->update($id, $dataPost);  // Updating the data in the database

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
        $this->informasigereja->delete($id);  // Deleting the data from the database
        $response = array(
            'status' => 'success',
            'message' => 'Data deleted successfully'
        );
        view_output('', $response, true);  // Loading the view with the response data
    }
}

/* End of file Informasigereja.php and path \application\controllers\Informasigereja.php */
