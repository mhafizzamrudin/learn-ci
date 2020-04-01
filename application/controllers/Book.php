<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('BookModel');
    }

    public function add() {
        $config['upload_path'] = './assets/uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10000;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            echo $this->upload->display_errors();
            // redirect('page/home');
        } else {
            $data = [
                'user_id' => $this->session->userdata('user')['id'],
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'image' => $this->upload->data('file_name'),
            ];
            $this->BookModel->addBook($data);

            $this->session->set_flashdata('message', 'Add book success');
            redirect('page/home');
        }
    }

    public function edit($id) {
        $config['upload_path'] = './assets/uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10000;
        $this->load->library('upload', $config);

        $where = [
            'id' => $id,
        ];
        $data = [
            'user_id' => $this->session->userdata('user')['id'],
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
        ];

        if (!empty($_FILES['image'])) {
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                echo $this->upload->display_errors();
                // redirect('page/home');
            } else {
                $data['image'] = $this->upload->data('file_name');
            }
        }
        
        $this->BookModel->editBook($where, $data);
    
        $this->session->set_flashdata('message', 'Edit book success');
        redirect('page/home');
    }

    public function delete($id) {
        $where = [
            'id' => $id,
        ];

        $this->BookModel->deleteBook($where);

        $this->session->set_flashdata('message', 'Delete book success');
        redirect('page/home');
    }
}