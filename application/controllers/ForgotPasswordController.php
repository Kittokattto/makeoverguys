<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPasswordController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->config('email'); 
        $this->load->helpers('custom'); 
    }

	public function index()
	{
		$this->load->view('forgot');
	}
    
    public function verifyEmail()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, load the form view again with errors
            $this->load->view('forgot');
        } else {
            // Validation succeeded, process the form data
            // For example, save data to the database
            
                $email =$this->input->post('email');
            // save data
            $query = $this->User_model->get_user_email($email);

            if($query)
            {
                // Access the email property from the object
                $id = $query->id;
                $email = $query->email;
                $username = $query->username;
                $new_password = generate_random_password();

                //Save new password for the user
                $success = $this->User_model->update_password_by_id($id, $new_password);

                if($success)
                {
                    // Call the send_email function from the library
                    $response = $this->send_email($email, $username, $new_password);
                    if ($response == 0) {
                        $this->session->set_flashdata('success', 'Please check your email for instructions to reset your password.');
                        redirect('Signin');
                    } else {
                        $this->session->set_flashdata('error', 'Failed to send email. Please try again.');
                        redirect('ForgotPassword');
                    }
                }
                else{
                    $this->session->set_flashdata('error', 'Failed to send email. Please try again.');
                    redirect('ForgotPassword');
                }

                
            
                
            }
            else{
                $this->session->set_flashdata('error','Email not found. Please use a registered email.');
                redirect('ForgotPassword');			
            }

            
        }
    }


    public function send_email($email, $username, $new_password) {
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
        
        
        // Load the email template view and pass data to it
        $data['username'] = $username;
        $data['new_password'] = $new_password;
        $message = $this->load->view('emailpassword', $data, TRUE);

        // Set Email Parameters
        $this->email->from('your_email@example.com', 'Your Name');
        $this->email->to($email);
        $this->email->subject('Password Reset');
        $this->email->message($message);

        // Send Email
        if ($this->email->send()) {
            return 0;
        } else {
            echo 'Email failed to send';
            show_error($this->email->print_debugger());
        }
    }
}
