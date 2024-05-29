<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignInController extends CI_Controller {


	public function index()
	{
		$this->load->view('signin');
	}
}
