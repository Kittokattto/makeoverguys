<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUpController extends CI_Controller {


	public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		$this->load->view('signup');
	}

	public function register()
	{
		//Form Validation
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('emailid', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, load the form view again with errors
            $this->load->view('signup');
        } else {
            // Validation succeeded, process the form data
            // For example, save data to the database
            $data = array(
                'username' => $this->input->post('username'),
                'emailid' => $this->input->post('emailid'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            );

            // save data
            $this->User_model->insert_user($data);

            // Redirect or load success view
            redirect('some_success_page');
        }
	}


}
