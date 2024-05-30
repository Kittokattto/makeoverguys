<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignInController extends CI_Controller {


	public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
		$this->load->model('UserActivity_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('signin');
	}


public function login()
{
    if ($this->input->is_ajax_request()) {
        // Validation for login form
        $this->form_validation->set_rules('emailid', 'Email id', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, return validation errors
            $errors = array(
                'emailid' => form_error('emailid'),
                'password' => form_error('password')
            );
            echo json_encode(array('status' => 'error', 'errors' => $errors));
        } else {
            // Validation succeeded, process the form data
            $email = $this->input->post('emailid');
            $password = $this->input->post('password');

            $validate = $this->User_model->loginUser($email, $password);
            if ($validate) {
                $this->session->set_userdata('uid', $validate->id);
                $this->session->set_userdata('username', $validate->username);

				//Tracking Login User activity
				$this->UserActivity_model->insert_activity($validate->id, 'Login', $validate->username . " has logged in to the website");
				
                $this->session->set_flashdata('error', null);
				$this->session->set_flashdata('success', 'Login successful');
                echo json_encode(array('status' => 'success', 'message' => 'Login successful'));
            } else {
                $this->session->set_flashdata('success', null);
				$this->session->set_flashdata('error', 'Invalid login details. Please try again.');
                
                echo json_encode(array('status' => 'error', 'message' => 'Invalid login details. Please try again.'));
            }
        }
    } else {
        $this->load->view('signin');
    }
}



}
