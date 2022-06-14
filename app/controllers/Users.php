<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $userInfo = $this->userModel->findUserById($_SESSION['user_id']);

        $data = [
            'title' => 'User Profile',
            'userInfo' => $userInfo
        ];

        $this->view("profile/index", $data);
    }

    public function editProfile()
    {
        $userInfo = $this->userModel->findUserById($_SESSION['user_id']);

        $data = [
            'title' => 'Edit Profile',
            'userInfo' => $userInfo,
            'name' => '',
            'description' => '',
            'path' => '',
            'nameError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $userInfo->id,
                'title' => 'Edit Profile',
                'userInfo' => $userInfo,
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'path' => '',
                'nameError' => ''
            ];

            // Validate Username. Accept only a-z, A-Z and 0-9
            $nameValidation = "/^[a-zA-Z0-9]*$/";

            if (empty($data['name'])) {
                $data['nameError'] = 'Please enter username.';
                $data['name'] = '';
            } elseif (!preg_match($nameValidation, $data['name'])) {
                $data['nameError'] = 'Name can only contain letters.';
                $data['name'] = '';
            }

            if(empty($data['nameError'])) {
                $image = $_FILES['image'] ?? null;
                $imagePath = $userInfo->image;

                if ($image && $image['tmp_name']) {
                    if ($userInfo->image) {
                        unlink(APPROOT . '/../public/assets/img/' . $userInfo->image);
                    }

                    $imagePath = randomString(8) . '/' . $image['name'];
                    mkdir(dirname(APPROOT . '/../public/assets/img/' . $imagePath));
                    move_uploaded_file($image['tmp_name'], APPROOT . '/../public/assets/img/' . $imagePath);
                } 
                
                $data['path'] = $imagePath;

                if ($this->userModel->updateUser($data)) {
                    header("location: " . URLROOT . "/users");
                } else {
                    die("Something went wrong. please try again");
                }
            }
        }

        $this->view('profile/edit_profile', $data);
    }
}
