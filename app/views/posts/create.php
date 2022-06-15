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
            <h3 class="title">Create post</h3>
            <div class="about">
                <form action="<?php echo URLROOT ?>/posts/create" method="POST" class="form" enctype="multipart/form-data">
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <input type="file" name="image" class="form-control" placeholder="Image for your blog...">
                    </div>

                    <div class="form-group" style="margin-bottom: 1rem;">
                        <input type="text" name="postTitle" class="form-control" placeholder="title...">
                        <span class="invalidFeedback">
                            <?php echo $data['titleError']; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <textarea name="body" class="form-control" placeholder="Enter your post" rows="8" cols="50"></textarea>
                        <span class="invalidFeedback">
                            <?php echo $data['bodyError']; ?>
                        </span>
                    </div>

                    <button name="submit" type="submit" class="btn green">Submit</button>
                </form>
                </form>
            </div>


        </div>

    </div>
</section>