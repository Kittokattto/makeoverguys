<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    // Declare the table name as a class property
    private $table = 'users';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Insert User detail
    public function insert_user($data) {
        try {
            $this->db->insert($this->table, $data);
            return true;
        } catch (Exception $e) {
            // Check if user exist
            if ($this->db->error()['code'] == 1062) {
                // Already exist entry error
                return -2;
            } else {
                // Other database error
                return -1;
            }
        }
    }
    
    public function get_user($id) {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    public function get_user_email($email) {
        return $this->db->get_where($this->table, array('email' => $email))->row();
    }

    public function update_password_by_id($id, $new_password) {
        // Update the password in the database based on the ID
        $data = array(
            'password' => $new_password
        );
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function loginUser($email, $password)
    {
        $data = array(
            'email' => $email,
            'password' => $password
        );
        $query = $this->db->where($data);
        $login = $this->db->get($this->table);
        if ($login != NULL) {
            return $login->row();
        }
    }

    public function is_username_exists($username) {
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    public function is_email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }
}
