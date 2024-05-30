<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserActivity_model extends CI_Model {
    
        // Declare the table name as a class property
        private $table = 'user_activity';

        public function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function insert_activity($user_id, $activity_type, $detail){
            $data = array(
                'user_id' => $user_id,
                'activity_type' => $activity_type,
                'details' => $detail
            );
            try {
                $this->db->insert($this->table, $data);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
        
}