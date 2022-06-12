<?php require APPROOT . '/views/includes/header.php';
?>

<div class="navbar dark">
    <?php require APPROOT . '/views/includes/navigation.php';
    ?>
</div>


<div class="container">
    <?php if (isLoggedIn()) : ?>
        <a href="<?php echo URLROOT ?>/posts/create" class="btn green">Create</a>
    <?php endif; ?>
    <?php foreach ($data['posts'] as $post) : ?>
        <div class="container-item">
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->user_id) : ?>
                <a class="btn orange" href="<?php echo URLROOT . "/posts/update/" . $post->id; ?>">Update</a>
                <form action="<?php echo URLROOT . "/posts/delete/" . $post->id ?>" method="POST">
                    <input type="submit" name="delete" value="delete" class="btn red">
                </form>
            <?php endif; ?>
            <h2>
                <?php echo $post->title; ?>
            </h2>
            <p>
                <?php echo $post->body; ?>
            </p>
            <small>
                <?php echo "Date Created: " . date('F j h:m', strtotime($post->created_at)); ?>
            </small>
        </div>
    <?php endforeach; ?>
</div>