<?php
// includes/header.php
?>
<header>
    <link rel="stylesheet" href="../styles.css" />
    <nav class="header">
        
        <div class="navbar-right">
        <?php if ($_SERVER['PHP_SELF'] !== '/index.php') : ?>
                <a href="/index.php" class="button">Home</a>
            <?php endif; ?>
            <a href="/Users/login.php" class="button">Login</a>
            <a href="/about.html" class="button">About</a>
            <a href="/help.html" class="button">Help</a>
        </div>
    </nav>
</header>
<hr>