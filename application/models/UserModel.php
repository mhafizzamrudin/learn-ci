<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
	public function getUser($where) {
        $this->db->where($where);
        return $this->db->get('users');
    }
    
    public function addUser($data) {
        $this->db->insert('users', $data);
    }
}
