<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Users Controller
 *
 * This controller handles CRUD operations for 'Users' including listing, showing,
 * storing, updating, and deleting data.
 */
class Users extends CI_Controller
{
    /**
     * Constructor for the class.
     *
     * This function is called when an object of the class is created.
     * It initializes the parent constructor and loads the 'users_model' and 'datagereja_model' models.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model', 'pengguna');  // Loading the 'users_model' model as 'pengguna'
        $this->load->model('datagereja_model', 'datagereja');  // Loading the 'datagereja_model' model as 'datagereja'
    }

    /**
     * Default function for the Users controller.
     *
     * This function sets the title, subtitle, and pages for the view,
     * and loads the view with this data.
     *
     * @return void
     */
    public function index()
    {
        $data['title'] = "Data Pengguna";  // Setting the page title
        $data['subtitle'] = "All Dashboard";  // Setting the page subtitle
        $data['pages'] = '/backend/pengguna/list';  // Setting the view page
        view_output('layouts/backend/app', $data);  // Loading the base layout view with the $data array
    }

    /**
     * List all data.
     *
     * This function retrieves all data from the model, adds 'gereja' names to the data,
     * and returns it in a success response.
     *
     * @return void
     */
    public function list()
    {
        $data = $this->pengguna->getAll();  // Retrieving all data
        foreach ($data as $item) {
            // Adding 'gereja' names to the data
            $item->gereja = $this->datagereja->getSingle($item->id_gereja) ? $this->datagereja->getSingle($item->id_gereja)->nama : '-';
        }

        $response = array(
            'status' => 'success',
            'message' => 'Data Found',
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
        $data = $this->pengguna->getSingle($id);  // Retrieving data for a specific ID
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
        $this->form_validation->set_message('is_unique', '{field} Sudah Terdaftar.');  // Setting custom validation message for 'is_unique'
        $this->form_validation->set_message('required', '{field} Field Tidak Boleh Kosong.');  // Setting custom validation message for 'required'

        // Setting validation rules
        $this->form_validation->set_rules('id_gereja', 'Admin Gereja', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

        if ($this->form_validation->run() == FALSE) {  // Checking if validation failed
            $response = array(
                'status' => 'error',
                'message' => validation_errors()
            );
        } else {
            $dataPost = (object)$this->input->post();  // Retrieving the input data
            $dataPost->password = password_hash('12345678', PASSWORD_BCRYPT);  // Hashing the default password
            $this->pengguna->insert($dataPost);  // Inserting the data into the database
            $response = array(
                'status' => 'success',
                'message' => 'User created successfully, please login with your username and 12345678 as password default',
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

        $updateResult = $this->pengguna->update($id, $dataPost);  // Updating the data in the database

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

    public function updatePassword($id)
    {

        $dataPost['password']= password_hash($this->input->post('password'), PASSWORD_BCRYPT);  // Retrieving the input data
        $dataPost['updated_at'] = date('Y-m-d H:i:s');  // Setting the updated_at timestamp

        $updateResult = $this->pengguna->update($id, $dataPost);  // Updating the data in the database

        if ($updateResult) {  // Checking if the update was successful
            $response = array(
                'status' => 'success',
                'message' => 'Password updated successfully',
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
     * This function deletes the data for a specific ID from the database if there are no related records.
     *
     * @param int $id The ID of the data to delete
     * @return void
     */
    public function destroy($id)
    {
        try {
            // Check if there are related records before deleting the data
            if ($this->datagereja->hasRelations($id)) {
                $response = array(
                    'status' => 'error',
                    'message' => 'Data cannot be deleted because it has related records in Data Gereja'
                );
                view_output('', $response, true);
                return;
            }

            // Delete the data
            $this->pengguna->delete($id);

            $response = array(
                'status' => 'success',
                'message' => 'Data deleted successfully'
            );
        } catch (Exception $e) {
            $response = array(
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            );
        }

        view_output('', $response, true);  // Loading the view with the response data
    }
}

/* End of file Users.php and path \application\controllers\Users.php */
