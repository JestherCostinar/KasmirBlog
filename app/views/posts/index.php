<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';
?>

<section class="article" id="posts">
    <?php if (isLoggedIn()) : ?>
        <a href="<?php echo URLROOT ?>/posts/create" class="btn post-green">Create</a>
    <?php endif; ?>

    <div class="article-container">
        <?php foreach ($data['posts'] as $post) : ?>
            <div class="post">

                <img src="<?php echo URLROOT . "/public/assets/img/" . $post->image ?>" width="100%" height="500px">
                <div class=" date">
                    <i class="far fa-clock"></i>
                    <span><?php echo "Date Created: " . date('M d, Y', strtotime($post->created_at)); ?></span>
                </div>
                <h3 class="title"><?php echo $post->title; ?></h3>
                <p class="text">
                    <?php echo $post->body; ?>
                </p>

                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->user_id) : ?>


                    <div class="links">
                        <a href="#" class="user">
                            <i class="far fa-user"></i>
                            <span>Author: <?php echo $post->username; ?></span>
                        </a>
                        <div class="icon">
                            <a class="btn btn-edit" href="<?php echo URLROOT . "/posts/update/" . $post->id; ?>">Update</a>
                        </div>
                        <div class="icon">
                            <form action="<?php echo URLROOT . "/posts/delete/" . $post->id ?>" method="POST">
                                <input type="submit" name="delete" value="delete" class="btn btn-red">
                            </form>
                        </div>
                        <a href="#" class="icon">
                            <i class="far fa-share-square"></i>
                            <span>Share on twitter</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    </div>