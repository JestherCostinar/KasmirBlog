<?php

class Auth extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $this->login();
    }

    // User Register Controller
    public function register()
    {
        $data = [
            'title' => 'Register',
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            // Validate Username. Accept only a-z, A-Z and 0-9
            $nameValidation = "/^[a-zA-Z0-9]*$/";

            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
                $data['username'] = '';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters.';
                $data['username'] = '';
            }

            // Validate email. Accept only jru email
            $emailValidation = '|^[A-Z0-9._%+-]+@my\.jru\.edu$|i';

            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
                $data['email'] = '';
            } elseif (!preg_match($emailValidation, $data['email'])) {
                $data['emailError'] = 'Only accepting .my.jru.edu email.';
                $data['email'] = '';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email already taken.';
                    $data['email'] = '';
                }
            }

            // Password Validation
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password address.';
            } elseif (strlen($data['password']) < 6) {
                $data['passwordError'] = 'Password atleast 8 characters.';
            } elseif (preg_match($passwordValidation, $data['password'])) {
                $data['passwordError'] = 'Password must have atleast one numeric value.';
            }

            // Confirm Password Validation
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password address.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Please do not match, please try again.';
                }
            }

            // Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user from model function
                if ($this->userModel->register($data)) {
                    header('Location: ' . URLROOT . '/auth/login');
                } else {
                    die("Something went wrong");
                }
            }
        }

        $this->view('pages/register', $data);
    }

    // User login Controller
    public function login()
    {
        $data = [
            'title' => 'Login',
            'errorMessage' => '',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'usernameError' => '',
                'passwordError' => ''
            ];

            // Validate Username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username';
            }

            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password';
            }

            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);

                    header("location: " . URLROOT);
                } else {
                    $data['errorMessage'] = 'Invalid Username or Password. Please Try again.';
                }
            }
        } else {
            $data = [
                'title' => 'Login',
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('pages/login', $data);
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/auth/login');
    }
}
