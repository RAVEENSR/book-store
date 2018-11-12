<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login Class
 *
 * This class controls the login operation related to an Administrator.
 *
 * @author Raveen Savinda Rathnayake
 */
class Login extends CI_Controller
{

    public function __construct()
    {
        // Parent constructor call
        parent::__construct();
        $this->load->library('form_validation');
    }

    /**
     * Loads the view for searching a book.
     */
    public function loadAdminLogin()
    {
        if ($this->session->userdata('adminUsername') != '') {
            redirect(site_url() . '/administrator/loadAdminPortal');
        } else {
            $this->load->view('visitor/Header');
            $this->load->view('admin/Login');
            $this->load->view('visitor/Footer');
        }
    }

    /**
     * Controls authenticating the admin login credentials.
     */
    public function authenticate()
    {
        // load the form validation library
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $this->load->model('LoginModel');
            $result = $this->LoginModel->login($username, $password);
            if ($result) {
                $session_data = array('adminUsername' => $username);
                $this->session->set_userdata($session_data);
                redirect(site_url() . '/administrator/loadAdminPortal');
            } else {
                $this->session->set_flashdata('error', 'Invalid Username and Password!');
                redirect(site_url() . '/login/loadAdminLogin');
            }
        } else {
            $this->loadAdminLogin();
        }
    }

    /**
     * Controls admin user logging out process.
     */
    public function logout()
    {
        $this->session->unset_userdata('adminUsername');
        redirect(site_url() . '/login/loadAdminLogin');
    }

    /**
     * Controls admin registering process.
     */
    private function _register()
    {
        $this->load->model('LoginModel');
        $this->LoginModel->register('admin', 'password', 'John', 'Doe');
    }
}

?>