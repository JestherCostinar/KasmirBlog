<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPROOT . '/PHPMailer-master/PHPMailer-master/src/Exception.php';
require APPROOT . '/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require APPROOT . '/PHPMailer-master/PHPMailer-master/src/SMTP.php';

class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->postsModel = $this->model('Post');
    }

    public function index()
    {
        if (isLoggedIn()) {
            $userProfile = $this->userModel->findUserById($_SESSION['user_id']);
        } else {
            $userProfile = [];
        }
        $posts = $this->postsModel->findAllPosts();


        $data = [
            'title' => 'Home',
            'userProfile' => $userProfile,
            'posts' => $posts
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
        if (isLoggedIn()) {
            $userProfile = $this->userModel->findUserById($_SESSION['user_id']);
        } else {
            $userProfile = [];
        }
        $posts = $this->postsModel->findAllPosts();


        $data = [
            'title' => 'Home',
            'userProfile' => $userProfile,
            'posts' => $posts,
            'emailError' => '',
            'nameError' => '',
            'bodyError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Home',
                'userProfile' => $userProfile,
                'posts' => $posts,
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'number' => $_POST['number'],
                'subject' => $_POST['subject'],
                'body' => $_POST['body'],
                'emailError' => '',
                'nameError' => '',
                'bodyError' => ''
            ];

            if (empty($data['name'])) {
                $data['nameError'] = 'Please input a name.';
            }

            if (empty($data['email'])) {
                $data['emailError'] = 'Please input an email.';
            }

            if (empty($data['body'])) {
                $data['bodyError'] = 'Please input a message.';
            }

            if (empty($data['nameError']) && empty($data['emailError']) && empty($data['bodyError'])) {
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
                    $mail->setFrom($data['email'], $data['name']);

                    //Add a recipient
                    $mail->addAddress('jesther.jc15@gmail.com', 'Jesther Costinar');

                    //Set email format to HTML
                    $mail->isHTML(true);

                    $mail->Subject = $data['subject'];
                    $mail->Body    = '<p>' . $data['body'] .  '</p>';

                    $mail->send();
                    $this->view('pages/index', $data);
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }

        $this->view('pages/index', $data);
    }
}
