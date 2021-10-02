<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login System</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav class="nav-header-main">
                <a href="#" class="header-logo">
                    <img src="img/logo.png" alt="Logo">
                </a>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Portfolio</a></li>
                    <li><a href="#">About Me</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <div class="header-login">
                    <?php
                        if(isset($_SESSION['userId'])) {
                            echo '<form action="includes/logout.inc.php" method="POST">
                            <button type="submit" name="logout-submit">Logout</button>
                            </form>';
                        } else {
                            echo '<form action="includes/login.inc.php" method="POST">
                            <input type="text" name="mailuid" placeholder="Username/Email...">
                            <input type="password" name="pwd" placeholder="Password...">
                            <button type="submit" name="login-submit">Login</button>
                            </form>
                            <a href="signup.php">Sign Up</a>';
                        }
                    ?>
                </div>
            </nav>
        </header>