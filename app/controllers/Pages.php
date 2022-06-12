<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if (isLoggedIn()) {
            $userProfile = $this->userModel->findUserById($_SESSION['user_id']);
        } 

        $data = [
            'title' => 'Home',
            'userProfile' => $userProfile
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
        ];
        $this->view('pages/about', $data);
    }

    public function project()
    {
        $data = [
            'title' => 'Project',
        ];
        $this->view('pages/project', $data);
    }

    public function blog()
    {
        $data = [
            'title' => 'Blog',
        ];

        $this->view('pages/blog', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact',
        ];

        $this->view('pages/contact', $data);
    }
}
