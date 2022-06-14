<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';
?>

<section class="profile">
    <div class=" profile-container">
        <div class="box content form">
            <h3 class="title">Account Verification</h3>

            <?php if (!empty($data['verificationCodeError'])) : ?>
                <div class="alert errorMessage">
                    <?php echo $data['verificationCodeError']; ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo URLROOT; ?>/auth/verifyAccount" method="POST" class="form">
                <div class="form-group">
                    <input type="number" name="verificationCode" class="form-control" placeholder="Enter Verification Code">
                    <button type="submit" value="submit" class="btn">Submit</button>
                </div>

            </form>


        </div>

    </div>
</section>