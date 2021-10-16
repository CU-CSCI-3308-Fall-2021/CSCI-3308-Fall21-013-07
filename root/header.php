<?php
    session_start();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Map Creator</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="#">Create</a></li>
                    <li><a href="#">Search Map</a></li>
                    <li><a href="#">About</a></li>
                    <?php
                        if(isset($_SESSION['userId'])) {
                            echo "<li class='login-btn'><a href='includes/logout.inc.php'>Logout</a></li>";
                        } else {
                            echo "<li class='login-btn'><a href='signup.php'>Sign Up</a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </header>