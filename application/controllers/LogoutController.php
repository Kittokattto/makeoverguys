<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogoutController extends CI_Controller{

    public function index(){
        $this->session->unset_userdata('uid');
        $this->session->sess_destroy();
        return redirect('signin');
    }
}