<?php

class Posts extends Controller
{
    public function __construct()
    {
        $this->postsModel = $this->model('Post');
    }

    public function index() {
        $posts = $this->postsModel->findAllPosts();

        $data = [
            'title' => "Blog",
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    public function create() {
        if(!isLoggedIn()) {
            header("location: " . URLROOT . "/posts");
        }

        $data = [
            'title' => "CreateBlog",
            'postTitle' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'postTitle' => trim($_POST['postTitle']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => ''            
            ];

            if(empty($data['postTitle'])) {
                $data['titleError'] = 'Please enter a title';
            }

            if(empty($data['body'])) {
                $data['bodyError'] = 'Please enter a body';
            }

            if(empty($data['titleError']) && empty($data['bodyError'])) {
                if($this->postsModel->insertPost($data)) {
                    header("location: " . URLROOT . "/posts");
                } else {
                    die("Something went wrong. please try again");
                }
            } else {
                $this->view('posts/create', $data);
            }
        }

        $this->view('posts/create', $data);
    }

    public function update() {
        $data = [
            'title' => "Blog"
        ];

        $this->view('posts/update', $data);
    }

    public function delete() {
        $data = [
            'title' => "Blog"
        ];

        $this->view('posts/delete', $data);
    }
}
