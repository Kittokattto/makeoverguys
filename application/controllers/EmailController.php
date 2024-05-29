<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->config('email'); // Load the email configuration
    }

    public function send_email($email) {
        // Set SMTP Configuration
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'sandbox.smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => '675f2b4544504a',
            'smtp_pass' => '97099766011bd8', // Replace with the actual password
            'mailtype'  => 'html', 
            'charset'   => 'utf-8',
            'crlf'      => "\r\n",
            'newline'   => "\r\n",
            'wordwrap'  => TRUE
        );

        $this->email->initialize($config);

        // Set Email Parameters
        $this->email->from('your_email@example.com', 'Your Name');
        $this->email->to($email); 
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        // Send Email
        if ($this->email->send()) {
            echo 'Email sent successfully';
        } else {
            echo 'Email failed to send';
            show_error($this->email->print_debugger());
        }
    }
}
?>
