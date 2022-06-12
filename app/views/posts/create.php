<?php require APPROOT . '/views/includes/header.php';
?>

<div class="navbar dark">
    <?php require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container center">
    <h1>
        Create new post
    </h1>

    <form action="<?php echo URLROOT ?>/posts/create" method="POST">
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