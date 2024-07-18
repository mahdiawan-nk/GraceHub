<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Auth Controller
 *
 * This controller handles authentication-related actions such as login, logout,
 * and retrieving the current user's information.
 */
class Auth extends CI_Controller
{
    /**
     * Constructor for the class.
     *
     * This function is called when an object of the class is created.
     * It initializes the parent constructor and loads the 'auth_model' model
     * using the alias 'auths'.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auths');
    }

    /**
     * Index function for the Auth controller.
     *
     * This function loads the initial view for the authentication page.
     *
     * @return void
     */
    public function index()
    {
        $data['pages'] = 'helo';  // Assigning 'helo' to the 'pages' variable in the $data array.
        view_output('backend/Auth', $data);  // Loading the 'backend/Auth' view with the $data array.
    }

    /**
     * A function to check authentication.
     *
     * This function validates the input fields (username and password),
     * checks the login credentials against the database, and returns an appropriate response.
     *
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    function authCheck()
    {
        // Setting validation rules for 'username' and 'password' fields.
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Checking if form validation passes.
        if ($this->form_validation->run() == FALSE) {
            $response = array(
                'status' => 'error',
                'message' => validation_errors()  // Returning validation errors.
            );
        } else {
            $username = $this->input->post('username');  // Getting the 'username' from POST data.
            $password = $this->input->post('password');  // Getting the 'password' from POST data.

            // Checking login credentials with the auth model.
            if ($this->auths->login($username, $password)) {
                $response = array(
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Login successful'  // Login successful message.
                );
            } else {
                $response = array(
                    'code' => 401,
                    'status' => 'error',
                    'message' => 'Invalid username or password'  // Invalid login credentials message.
                );
            }
        }
        view_output('backend/Auth', $response, true);  // Loading the 'backend/Auth' view with the $response array.
    }

    /**
     * Logout the user and destroy the session.
     *
     * This function destroys the user's session and returns a logout success message.
     *
     * @return void
     */
    public function logout()
    {
        $this->session->sess_destroy();  // Destroying the user session.
        $response = array(
            'status' => 'success',
            'message' => 'Logout successful'  // Logout successful message.
        );
        view_output('backend/Auth', $response, true);  // Loading the 'backend/Auth' view with the $response array.
    }

    /**
     * Retrieves the data of the currently logged-in user.
     *
     * This function calls the `show()` method of the `auths` object to retrieve the user data.
     * If the user data is found, it returns a success response with the user data.
     * If the user data is not found, it returns an error response with a null data field.
     *
     * @return void
     */
    public function me()
    {
        $dataUser = $this->auths->show();  // Retrieving the current user's data from the auth model.
        if ($dataUser) {
            $response = array(
                'status' => 'success',
                'message' => 'User found',  // User found message.
                'data' => $dataUser  // User data.
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'User Not found',  // User not found message.
                'data' => null  // No user data.
            );
        }

        view_output('backend/Auth', $response, true);  // Loading the 'backend/Auth' view with the $response array.
    }
}

/* End of file Auth.php and path \application\controllers\Auth.php */
