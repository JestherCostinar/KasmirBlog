<?php

class Posts extends Controller
{
    public function __construct()
    {
        $this->postsModel = $this->model('Post');
    }

    public function index()
    {
        if (isLoggedIn()) {
            $posts = $this->postsModel->findUserPost($_SESSION['user_id']);
        } else {
            $posts = $this->postsModel->findAllPosts();
        }

        $data = [
            'title' => "Blog",
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    public function create()
    {
        if (!isLoggedIn()) {
            header("location: " . URLROOT . "/posts");
        }

        $data = [
            'title' => "CreateBlog",
            'postTitle' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'postTitle' => trim($_POST['postTitle']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => '',
                'path' => ''
            ];

            if (empty($data['postTitle'])) {
                $data['titleError'] = 'Please enter a title';
            }

            if (empty($data['body'])) {
                $data['bodyError'] = 'Please enter a body';
            }

            if (!is_dir(APPROOT . '/../public/assets/img/')) {
                mkdir(APPROOT . '/../public/assets/img/');
            }

            if (empty($data['titleError']) && empty($data['bodyError'])) {
                $image = $_FILES['image'] ?? null;
                $imagePath = '';
                if ($image && $image['tmp_name']) {
                    $imagePath = randomString(8) . '/' . $image['name'];
                    mkdir(dirname(APPROOT . '/../public/assets/img/' . $imagePath));
                    move_uploaded_file($image['tmp_name'], APPROOT . '/../public/assets/img/' . $imagePath);
                }

                $data['path'] = $imagePath;

                if ($this->postsModel->insertPost($data)) {
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

    public function update($id)
    {
        $post = $this->postsModel->findPostById($id);

        if (!isLoggedIn()) {
            header("location: " . URLROOT . "/posts");
        } elseif ($post->user_id != $_SESSION['user_id']) {
            header("location: " . URLROOT . "/posts");
        }

        $data = [
            'post' => $post,
            'title' => "Update Blog",
            'postTitle' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => '',
            'path' => ''
        ];



        echo $post->image;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'post' => $post,
                'user_id' => $_SESSION['user_id'],
                'postTitle' => trim($_POST['postTitle']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => '',
                'path' => ''
            ];

            if (empty($data['postTitle'])) {
                $data['titleError'] = 'Please enter a title';
            }

            if (empty($data['body'])) {
                $data['bodyError'] = 'Please enter a body';
            }

            if (empty($data['title']) === $this->postsModel->findPostById($id)->title) {
                $data['titleError'] = 'Atleast change the title!';
            }

            if (empty($data['body']) === $this->postsModel->findPostById($id)->body) {
                $data['bodyError'] = 'Atleast change the body!';
            }

            if (empty($data['titleError']) && empty($data['bodyError'])) {
                $image = $_FILES['image'] ?? null;
                $imagePath = $post->image;

                if ($image && $image['tmp_name']) {
                    if ($post->image) {
                        unlink(APPROOT . '/../public/assets/img/' . $post->image);
                    }

                    $imagePath = randomString(8) . '/' . $image['name'];
                    mkdir(dirname(APPROOT . '/../public/assets/img/' . $imagePath));
                    move_uploaded_file($image['tmp_name'], APPROOT . '/../public/assets/img/' . $imagePath);
                } 
                
                $data['path'] = $imagePath;

                if ($this->postsModel->updatePost($data)) {
                    header("location: " . URLROOT . "/posts");
                } else {
                    die("Something went wrong. please try again");
                }
            } else {
                $this->view('posts/update', $data);
            }
        }

        $this->view('posts/update', $data);
    }

    public function delete($id)
    {
        $post = $this->postsModel->findPostById($id);

        if (!isLoggedIn()) {
            header("location: " . URLROOT . "/posts");
        } elseif ($post->user_id != $_SESSION['user_id']) {
            header("location: " . URLROOT . "/posts");
        }

        $data = [
            'post' => $post,
            'title' => "Update Blog",
            'postTitle' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($this->postsModel->deletePost($id)) {
                header("location: " . URLROOT . "/posts");
            } else {
                die('Something went wrong');
            }
        }

        $this->view('posts/delete', $data);
    }
}
