<?php require APPROOT . '/views/includes/header.php';
?>

<div class="navbar dark">
    <?php require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container center">
    <h1>
        Update Post
    </h1>

    <form action="<?php echo URLROOT ?>/posts/update/<?php echo $data['post']->id ?>" method="POST">
        <div class="form-item">
            <input type="text" name="postTitle" placeholder="title..." value="<?php echo $data['post']->title ?>">
            <span class="invalidFeedback">
                <?php echo $data['titleError']; ?>
            </span>
        </div>

        <div class="form-item">
            <textarea name="body" placeholder="Enter your post"><?php echo $data['post']->body?></textarea>
            <span class="invalidFeedback">
                <?php echo $data['bodyError']; ?>
            </span>
        </div>

        <button name="submit" type="submit" class="btn green">Submit</button>
    </form>
</div>