<nav class="top-nav">
    <ul>

        <li>
            <a class="<?= ($data['title'] == "Home" ? 'active' : ''); ?>" href="<?php echo URLROOT; ?>/">Home</a>
        </li>
        <li>
            <a class="<?= ($data['title'] == "About" ? 'active' : ''); ?>" href="<?php echo URLROOT; ?>/pages/about">About</a>
        </li>
        <li>
            <a class="<?= ($data['title'] == "Project" ? 'active' : ''); ?>" href="<?php echo URLROOT; ?>/pages/project">Projects</a>
        </li>
        <li>
            <a class="<?= ($data['title'] == "Blog" ? 'active' : ''); ?>" href="<?php echo URLROOT; ?>/posts/index">Blog</a>
        </li>
        <li>
            <a class="<?= ($data['title'] == "Contact" ? 'active' : ''); ?>" href="<?php echo URLROOT; ?>/pages/contact">Contact</a>
        </li>
        <li class="btn-login">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="<?php echo URLROOT; ?>/auth/logout">Logout</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/auth/login">Login</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>