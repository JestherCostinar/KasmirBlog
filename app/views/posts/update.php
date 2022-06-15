<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';
?>

<section class="profile">
    <div class="profile-container">
        <div class="box">
            <div class="alert errorMessage link">
                <a href="<?php echo URLROOT ?>/posts/">Go back to Post</a>
            </div>
            <h3 class="title">Edit post</h3>
            <div class="about">
                <form action="<?php echo URLROOT ?>/posts/update/<?php echo $data['post']->id ?>" method="POST" class="form" enctype="multipart/form-data">
                    <img src="<?php echo URLROOT . "/public/assets/img/" . $data['post']->image ?>" alt="" width="100px" height="100px">

                    <div class="form-group">
                        <input type="file" name="image" class="form-control" placeholder="Image for your blog...">
                    </div>

                    <div class="form-group">
                        <input type="text" name="postTitle" placeholder="title..." class="form-control" value="<?php echo $data['post']->title ?>">
                        <span class="invalidFeedback">
                            <?php echo $data['titleError']; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <textarea name="body" placeholder="Enter your post" rows="8" cols="50" class="form-control"><?php echo $data['post']->body ?></textarea>
                        <span class="invalidFeedback">
                            <?php echo $data['bodyError']; ?>
                        </span>
                    </div>

                    <button name="submit" type="submit" class="btn green">Submit</button>
                </form>
            </div>


        </div>

    </div>
</section>

