<?php
require APPROOT . '/views/includes/headER.php';
?>

<div class="navbar">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>

        <form action="<?php echo URLROOT; ?>/auth/register" method="POST">
            <input type="text" placeholder="Username *" name="username" value="<?php echo $data['username'];?>">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>

            <input type="email" placeholder="Email *" name="email" value="<?php echo $data['email'];?>">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>


            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <input type="password" placeholder="Confirm Password *" name="confirmPassword">
            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError']; ?>
            </span>

            <button id="submit" type="submit" value="submit">Submit</button>
            <p class="options">Already have an account? <a href="<?php echo URLROOT; ?>
            /auth/login">Login</a></p>
        </form>
    </div>
</div>