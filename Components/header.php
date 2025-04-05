<?php
// includes/header.php
?>
<header>
    <nav class="navbar">
        <div class="navbar-left">
            <?php if ($_SERVER['PHP_SELF'] !== '/index.php') : ?>
                <a href="/index.php" class="nav-button">Home</a>
            <?php endif; ?>
        </div>
        <div class="navbar-right">
            <a href="/Users/login.php" class="nav-button">Login</a>
            <a href="/about.html" class="nav-button">About</a>
            <a href="/help.html" class="nav-button">Help</a>
        </div>
    </nav>
</header>
<hr>
