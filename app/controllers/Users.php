<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index() {
        $userInfo = $this->userModel->findUserById($_SESSION['user_id']);

        $data = [
            'title' => 'User Profile',
            'userInfo' => $userInfo
        ];

        $this->view("profile/index");
    }

    
}
