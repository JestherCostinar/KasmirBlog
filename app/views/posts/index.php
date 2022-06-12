<?php require APPROOT . '/views/includes/header.php';
?>

<div class="navbar dark">
    <?php require APPROOT . '/views/includes/navigation.php';
    ?>
</div>


<div class="container">
    <?php if (isLoggedIn()) : ?>
        <a href="<?php echo URLROOT?>/posts/create" class="btn green">Create</a>
    <?php endif; ?>
    <?php foreach ($data['posts'] as $post) : ?>
        <div class="container-item">
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