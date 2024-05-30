<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignInController extends CI_Controller {


	public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('signin');
	}


    public function login()
    {
        //Validation for login form
        $this->form_validation->set_rules('emailid', 'Email id', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            $email = $this->input->post('emailid');
            $password = $this->input->post('password');
            
            $validate = $this->User_model->loginUser($email, $password);
            if ($validate) {
                $this->session->set_userdata('uid', $validate->id);
                $this->session->set_userdata('username', $validate->username);
                redirect('welcome');
            } else {
                $this->session->set_flashdata('error', 'Invalid login details.Please try again.');
                redirect('signin');
            }
        } else {
            $this->load->view('signin');
        }
    }


}
