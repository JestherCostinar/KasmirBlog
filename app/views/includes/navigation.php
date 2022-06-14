<header class="header">
    <a href="#" class="logo"><span>KASMIR</span>BLOG</a>

    <nav class="navbar">
        <a href="<?php echo URLROOT; ?>/">Home</a>
        <a href="<?php echo URLROOT; ?>/posts/">my posts</a>
        <?php if ($data['title'] == "Home") : ?>
            <a href="#contact">contact me</a>
        <?php endif; ?>

        <?php if (isLoggedIn()): ?>
            <a href="<?php echo URLROOT; ?>/users/">Profile</a>
        <?php endif; ?>
    </nav>

    <div class="icons">
        <?php if (isLoggedIn()) : ?>
            <button class="btn login" onclick="window.location.href = '<?php echo URLROOT; ?>/auth/logout';">Logout </button>
        <?php else : ?>
            <button class="btn login" onclick="window.location.href = '<?php echo URLROOT; ?>/auth';">Login</button>
        <?php endif; ?>
    </div>

    <form action="" class="search-form">
        <input type="search" name="" placeholder="search here..." id="search-box" />
        <label for="search-box" class="fas fa-search"></label>
    </form>
</header>