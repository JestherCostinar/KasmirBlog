<?php
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';
?>

<section class="banner banner-login" id="banner">
    <div class="content">
        <h2>Sign In</h2>

        <?php if (!empty($data['errorMessage'])) : ?>
            <div class="alert errorMessage">
                <?php echo $data['errorMessage']; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo URLROOT; ?>/auth/login" method="POST">


            <input type="text" placeholder="Username *" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>
            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <button id="submit" type="submit" value="submit">Submit</button>
            <p class="options">Not registered yet? <a href="<?php echo URLROOT; ?>/auth/register">Create an account</a></p>
        </form>
    </div>
</section>