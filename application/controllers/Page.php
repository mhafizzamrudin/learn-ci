<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('BookModel');
    }

    private function checkLogin() {
        if (!$this->session->userdata('user')) {
            redirect('page/login');
        }
    }

	public function index() {
        redirect('page/home');
    }
    
    public function login() {
        $this->load->view('LoginView');
    }

    public function register() {
        $this->load->view('RegisterView');
    }

    public function home() {
        $this->checkLogin();
        $data = [
            'books' => $this->BookModel->getAllBooks()->result_array(),
        ];
        $this->load->view('HomeView', $data);
    }
}
