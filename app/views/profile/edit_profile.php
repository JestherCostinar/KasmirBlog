<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';
?>

<section class="profile">
    <div class="profile-container">
        <div class="box">
            <div class="alert errorMessage link">
                <a href="<?php echo URLROOT ?>/users/">Go back to profile</a>
            </div>
            <h3 class="title">about me</h3>
            <div class="about">
                <form action="<?php echo URLROOT; ?>/users/editProfile" method="POST" class="form" enctype="multipart/form-data">
                    <?php if (!$data['userInfo']->profile_picture) : ?>
                        <img class="profile-img" src="<?php echo URLROOT ?>/public/assets/img/default.jpeg" alt="" />
                    <?php else : ?>
                        <img class="profile-img" src="<?php echo URLROOT . "/public/assets/img/" . $data['userInfo']->profile_picture ?>" alt="" />
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="">Profile Picture</label>
                        <input type="file" placeholder="Enter your name *" name="image" class="form-control" ">
                    </div>

                    <div class=" form-group">
                        <label for="">Name</label>
                        <input type="text" placeholder="Enter your name *" name="name" class="form-control" value="<?php echo $data['userInfo']->username ?>">
                        <span class="invalidFeedback">
                            <?php echo $data['nameError']; ?>
                        </span>
                    </div>
                    <div class=" form-group">
                        <label for="">Description</label>
                        <input type="text" placeholder="Enter description *" name="description" class="form-control" value="<?php echo $data['userInfo']->description ?>">
                    </div>

                    <div class=" form-group">
                        <label for="">Instagram link</label>
                        <input type="text" placeholder="Enter Instagram link *" name="instagram" class="form-control" ">
                    </div>

                    <div class=" form-group">
                        <label for="">Facebook link</label>
                        <input type="text" placeholder="Enter Facebook link *" name="facebook" class="form-control" ">
                    </div>

                    <div class=" form-group">
                        <label for="">Twitter link</label>
                        <input type="text" placeholder="Enter Twitter link *" name="twitter" class="form-control" ">
                    </div>
                    <div class=" form-group">
                        <label for="">Linkedin Link</label>
                        <input type="text" placeholder="Enter LinkedIn link *" name="linkedin" class="form-control" ">
                    </div>                   
                    <button id=" submit" type="submit" value="submit" class="btn black">Submit</button>

                </form>
            </div>


        </div>

    </div>
</section>