<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';
?>

<div class="container center">
    <h1>
        Create new post
    </h1>

    <form action="<?php echo URLROOT ?>/posts/create" method="POST" enctype="multipart/form-data">
        <div class="form-item">
            <input type="file" name="image" placeholder="Image for your blog...">
        </div>

        <div class="form-item">
            <input type="text" name="postTitle" placeholder="title...">
            <span class="invalidFeedback">
                <?php echo $data['titleError']; ?>
            </span>
        </div>

        <div class="form-item">
            <textarea name="body" placeholder="Enter your post"></textarea>
            <span class="invalidFeedback">
                <?php echo $data['bodyError']; ?>
            </span>
        </div>

        <button name="submit" type="submit" class="btn green">Submit</button>
    </form>
</div>