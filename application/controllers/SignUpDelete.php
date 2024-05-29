<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUp extends CI_Controller {


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
                'email' => $this->input->post('emailid'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            );

            // save data
            $query = $this->User_model->insert_user($data);

            if($query){
                $this->session->set_flashdata('success','Registration successfull, Now you can login.');	
                redirect('signup');
                } else {
                $this->session->set_flashdata('error','Something went wrong. Please try again.');	
                redirect('signup');	
                }
        }
	}


}
