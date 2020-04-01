<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookModel extends CI_Model {
	public function getAllBooks() {
        $this->db->join('users', 'users.id = books.user_id');
		return $this->db->get('books');
    }
    
    public function addBook($data) {
        $this->db->insert('books', $data);
    }
}
