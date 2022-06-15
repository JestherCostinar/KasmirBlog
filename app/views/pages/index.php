<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <section class="banner" id="banner">
        <div class="content">
            <h3>Lin Tech</h3>
            <p>
            All You Need To Know on How to get rid on lintech Coding.
            </p>
            <a href="<?php echo URLROOT ?>/posts/" class="btn">my blogs</a>
        </div>
    </section>

    <!-- banner section ends -->

    <!-- posts section starts  -->

    <section class="container" id="posts">
        <div class="posts-container">
            <?php foreach ($data['posts'] as $post) : ?>
                <div class="post">
                    <img src="<?php echo URLROOT . "/public/assets/img/" . $post->image ?>" alt="" class="image" />
                    <div class="date">
                        <i class="far fa-clock"></i>
                        <span><?php echo date('M d, Y', strtotime($post->created_at)); ?></span>
                    </div>
                    <h3 class="title"><?php echo $post->title; ?></h3>
                    <p class="text">
                        <?php echo $post->body; ?>
                    </p>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="sidebar">
            <?php if (isLoggedIn()) : ?>
                <div class="box">
                    <h3 class="title">about me</h3>
                    <div class="about">
                        <?php if (!$data['userProfile']->profile_picture) : ?>
                            <img class="profile-img" src="<?php echo URLROOT ?>/public/assets/img/default.jpeg" alt="" />
                        <?php else : ?>
                            <img class="profile-img" src="<?php echo URLROOT . "/public/assets/img/" . $data['userProfile']->profile_picture ?>" alt="" />
                        <?php endif; ?>
                        <h3><?php echo $data['userProfile']->username; ?></h3>
                        <p>
                            <?php echo $data['userProfile']->description; ?>
                        </p>
                        <div class="follow">
                            <a href="#" class="fab fa-facebook-f"></a>
                            <a href="#" class="fab fa-twitter"></a>
                            <a href="#" class="fab fa-instagram"></a>
                            <a href="#" class="fab fa-linkedin"></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="box">
                <h3 class="title">categories</h3>
                <div class="category">
                    <a href="#"> HTML </a>
                    <a href="#"> CSS </a>
                    <a href="#"> JAVASCRIPT </a>
                    <a href="#"> PHP </a>
                    <a href="#"> MYSQL </a>
                    <a href="#"> LARAVEL </a>
                    <a href="#"> WORDPRESS </a>
                    <a href="#"> JAVA </a>
                    <a href="#"> PYTHON </a>
                </div>
            </div>

            <div class="box">
                <h3 class="title">popular posts</h3>
                <div class="p-post">
                    <?php foreach ($data['posts'] as $i => $post) : ?>
                        <a href="#">
                            <h3><?php echo $i+1 . ' ' . $post->title; ?></h3>
                            <span><i class="far fa-clock"></i><?php echo date('M d, Y', strtotime($post->created_at)); ?></span>
                        </a>
                    <?php endforeach; ?>

                </div>
            </div>

            <div class="box">
                <h3 class="title">popular tags</h3>
                <div class="tags">
                    <a href="#">PHP</a>
                    <a href="#">LARAVEL</a>
                    <a href="#">PYTHON</a>
                    <a href="#">JAVASCRIPT</a>

                </div>
            </div>
        </div>
    </section>

    <!-- posts section ends -->

    <!-- contact section starts  -->

    <section class="contact" id="contact">
        <form action="">
            <h3>contact me</h3>
            <div class="inputBox">
                <input type="text" placeholder="name" />
                <input type="email" placeholder="email" />
            </div>
            <div class="inputBox">
                <input type="number" placeholder="number" />
                <input type="text" placeholder="subject" />
            </div>
            <textarea name="" placeholder="message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" class="btn" />
        </form>
    </section>

    <!-- contact section ends -->

    <!-- footer section starts  -->

    <section class="footer">
        <div class="follow">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
        </div>

        <div class="credit">
            &copy; Copyright 2022
            <span>Kasmir Blog</span> | all rights reserved
        </div>
    </section>

    <!-- footer section ends -->

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>