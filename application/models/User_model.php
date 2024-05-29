<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    // Declare the table name as a class property
    private $table = 'users';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_user($data) {
        return $this->db->insert($this->table, $data);
    }

    // Example of another method using the table name
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
}
