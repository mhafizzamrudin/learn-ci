<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookModel extends CI_Model {
	public function getAllBooks() {
        $this->db->select('books.id, user_id, title, description, image, name');
        $this->db->join('users', 'users.id = books.user_id');
		return $this->db->get('books');
    }
    
    public function addBook($data) {
        $this->db->insert('books', $data);
    }

    public function editBook($where, $data) {
        $this->db->where($where);
        $this->db->update('books', $data);
    }

    public function deleteBook($where) {
        $this->db->where($where);
        $this->db->delete('books');
    }
}
