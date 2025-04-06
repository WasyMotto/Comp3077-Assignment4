<?php
// includes/header.php
?>
<header>
    <link rel="stylesheet" href="../styles.css" />
    <nav class="header">
        
        <div class="navbar-right">
        <?php if ($_SERVER['PHP_SELF'] !== '/index.php') : ?>
                <a href="https://wasylykz.myweb.cs.uwindsor.ca/Comp3077/A41/" class="button">Home</a>
            <?php endif; ?>
            <a href="https://wasylykz.myweb.cs.uwindsor.ca/Comp3077/A41/Users/login.html" class="button">Login</a>
            <a href="https://wasylykz.myweb.cs.uwindsor.ca/Comp3077/A41/about.php" class="button">About</a>
            <a href="https://wasylykz.myweb.cs.uwindsor.ca/Comp3077/A41/Help/Help.html" class="button">Help</a>
        </div>
    </nav>
</header>
<hr>
