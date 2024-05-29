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
}
