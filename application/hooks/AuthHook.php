<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthHook
{
    public function check_login()
    {
        $CI = &get_instance();

        // List of controllers that do not require authentication
        $excluded_controllers = array('auth','welcome','installs');

        // Current controller
        $current_controller = $CI->router->fetch_class();

        if (!in_array(strtolower($current_controller), $excluded_controllers)) {
            if (!$CI->session->userdata('logged_in')) {
                redirect(base_url('admins'));
            }
        }
    }
}
