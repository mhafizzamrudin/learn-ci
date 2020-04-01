<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function login() {
        $where = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
        ];
        $user = $this->UserModel->getUser($where);

        if ($user->num_rows() > 0) {
            $this->session->set_userdata('user', $user->row_array());
            $this->session->set_flashdata('message', 'Login success');
            redirect('page/home');
        } else {
            $this->session->set_flashdata('message', 'Login fail');
            redirect('page/login');
        }
    }

    public function register() {
        $data = [
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
        ];
        $this->UserModel->addUser($data);

        $this->session->set_flashdata('message', 'Register success');
        redirect('page/home');
    }

    public function logout() {
        $this->session->unset_userdata('user');
        $this->session->set_flashdata('message', 'Logout success');
        redirect('page/home');
    }
}
