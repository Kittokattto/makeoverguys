<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogoutController extends CI_Controller{


	public function __construct() {
        parent::__construct();
        $this->load->model('UserActivity_model');
    }
    public function index(){

        $id = $this->session->userdata('uid'); // Retrieve the value of 'uid' from session
        $username = $this->session->userdata('username'); // Retrieve the value of 'username' from session
        //Tracking logout activity
        $this->UserActivity_model->insert_activity($id, 'Logout', $username . " has logged out from the website");

        $this->session->unset_userdata('uid');
        $this->session->sess_destroy();
        return redirect('signin');
    }
}