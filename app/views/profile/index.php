<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';

?>
<section class="profile">
    <div class="profile-container">
        <div class="box">
            <h3 class="title">about me</h3>
            <div class="about">
                <?php if(!$data['userInfo']->image): ?>
                    <img class="profile-img" src="<?php echo URLROOT ?>/public/assets/img/default.jpeg" alt="" />
                <?php else :?>
                    <img class="profile-img" src="<?php echo URLROOT . "/public/assets/img/" . $data['userInfo']->image ?>" alt="" />
                <?php endif; ?>
                <h3><?php echo $data['userInfo']->username; ?></h3>
                <p>
                    <?php echo $data['userInfo']->description; ?>
                </p>
                <div class="follow">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <button onclick="window.location.href='<?php echo URLROOT ?>/users/editProfile';" class="btn green">Edit Profile</button>
            </div>


        </div>

    </div>
</section>