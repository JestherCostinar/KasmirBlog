<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPROOT . '/PHPMailer-master/PHPMailer-master/src/Exception.php';
require APPROOT . '/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require APPROOT . '/PHPMailer-master/PHPMailer-master/src/SMTP.php';

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
                'title' => 'Register',
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

            // ============ Accept only my.jru.edu domain ================= //
            // $emailValidation = '|^[A-Z0-9._%+-]+@my\.jru\.edu$|i';       //
            // ============================================================ //

            $emailValidation = '|^[A-Z0-9._%+-]+@gmail\.com$|i';

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
                $user_id = $this->userModel->register($data);
                if ($this->userModel->oneTimePassword($user_id)) {
                    $_SESSION['account_to_verify'] = $user_id;
                    header('Location: ' . URLROOT . '/auth/verifyAccount');
                } else {
                    die("Something went wrong");
                }
            }
        }

        $this->view('pages/register', $data);
    }


    // Verify account controller 
    public function verifyAccount()
    {
        $verificationCode = $this->userModel->findUserVerificationCodeByID($_SESSION['account_to_verify'])->verification_code;
        $user_id = $this->userModel->findUserVerificationCodeByID($_SESSION['account_to_verify'])->user_id;
        $recipient = $this->userModel->findUserById($user_id)->email;
        
        $this->verifyByEmail($recipient, $verificationCode);

        $data = [
            'title' => 'Verify Account',
            'errorMessage' => '',
            'verificationCodeError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Verify Account',
                'verificationCodeError' => '',
                'verificationCode' => $_POST['verificationCode']
            ];

            if ($data['verificationCode'] === $verificationCode) {
                if ($this->userModel->updateAccountStatus($_SESSION['account_to_verify'])) {
                    unset($_SESSION['account_to_verify']);
                    header('Location: ' . URLROOT . '/auth/');
                }
            } else {
                $data['verificationCodeError'] = 'Invalid Code. Try again.';
            }
        }

        $this->view('pages/verify-account', $data);
    }

    public function verifyByEmail($recepient, $body)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'accura.find1@gmail.com';
            $mail->Password = 'emviozyeetqehyyb';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            //Recipients
            $mail->setFrom('jesther.jc15@gmail.com', 'Kasmir Blog');

            //Add a recipient
            $mail->addAddress($recepient, 'rasdasd');

            //Set email format to HTML
            $mail->isHTML(true);

            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>To Activate Account, enter verification code: <b style="font-size: 30px;">' . $body . '</b>' . '. NEVER share this code with others under any circumstances.' . '</p>';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
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
                'title' => 'Login',
                'errorMessage' => '',
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
                } else {
                    $data['errorMessage'] = 'Invalid Username or Password. Please Try again.';
                    $this->view('pages/login', $data);
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
        header('location:' . URLROOT . '/pages/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/auth/login');
    }
}
