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

    public function register() {
        // Form Validation
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('emailid', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
    
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, return JSON response with validation errors
            $errors = array(
                'username' => form_error('username'),
                'emailid' => form_error('emailid'),
                'password' => form_error('password'),
                'confirmpassword' => form_error('confirmpassword')
            );
    
            $response = array(
                'status' => 'error',
                'message' => 'Validation failed. Please check the errors.',
                'errors' => $errors
            );
    
            echo json_encode($response);
        } else {
            // Validation succeeded, process the form data
            $username = $this->input->post('username');
            $email = $this->input->post('emailid');
    
            // Check if username or email already exists
            $username_exists = $this->User_model->is_username_exists($username);
            $email_exists = $this->User_model->is_email_exists($email);
    
            if ($username_exists || $email_exists) {
                if ($username_exists) {
                    $message = 'Username already exists. Please choose another.';
                } else {
                    $message = 'Email already exists. Please use another.';
                }
    
                $response = array(
                    'status' => 'error',
                    'message' => $message
                );
    
                $this->session->set_flashdata('error', $message);
                echo json_encode($response);
            } else {
                // Proceed with inserting the user
                $data = array(
                    'username' => $username,
                    'email' => $email,
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
                );
    
                // Save data
                $query = $this->User_model->insert_user($data);
    
                if ($query) {
                    $this->session->set_flashdata('success', 'Registration successful. Now you can login.');
                    $this->session->set_flashdata('error', null);
                    $response = array(
                        'status' => 'success',
                        'message' => 'Registration successful. Now you can login.'
                    );
                } else {
                    $this->session->set_flashdata('success', null);
                    $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
                    $response = array(
                        'status' => 'error',
                        'message' => 'Something went wrong. Please try again.'
                    );
                }
    
                echo json_encode($response);
            }
        }
    }
    


}
