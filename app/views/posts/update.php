<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';
?>

<div class="container center">
    <h1>
        Update Post
    </h1>

    <form action="<?php echo URLROOT ?>/posts/update/<?php echo $data['post']->id ?>" method="POST" enctype="multipart/form-data">
        <img src="<?php echo URLROOT . "/public/assets/img/" . $data['post']->image ?>" alt="" width="100px" height="100px">

        <div class="form-item">
            <input type="file" name="image" placeholder="Image for your blog...">
        </div>

        <div class="form-item">
            <input type="text" name="postTitle" placeholder="title..." value="<?php echo $data['post']->title ?>">
            <span class="invalidFeedback">
                <?php echo $data['titleError']; ?>
            </span>
        </div>

        <div class="form-item">
            <textarea name="body" placeholder="Enter your post"><?php echo $data['post']->body ?></textarea>
            <span class="invalidFeedback">
                <?php echo $data['bodyError']; ?>
            </span>
        </div>

        <button name="submit" type="submit" class="btn green">Submit</button>
    </form>
</div>