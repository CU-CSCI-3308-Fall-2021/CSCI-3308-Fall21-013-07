<?php
    session_start();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Map Creator</title>
        <?php
            // Grab current URL
            $currPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
            if ($currPage == "map.php") {
                echo '<link rel="stylesheet" type="text/css" href="../style.css"/>';
            } else {
                echo '<link rel="stylesheet" type="text/css" href="style.css"/>';
                if ($currPage == "create.php") {
                    echo '<script type="text/javascript" src="js/create.js"></script>';
                    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
                }
            }
        ?>
        <link rel="shortcut icon" href="#">
    </head>
    <?php
        if ($currPage == "create.php") {
            echo '<body onload="init()">';
        } else {
            echo '<body>';
        }
    ?>
        <header>
            <nav>
                <ul>
                    <?php
                        if ($currPage == "map.php") {
                            echo '<li><a href="../index.php" class="active">Home</a></li>
                                <li><a href="../create.php">Create</a></li>
                                <li><a href="../search.php">Search Map</a></li>
                                <li><a href="../#">About</a></li>';
                            } else {
                            echo '<li><a href="index.php" class="active">Home</a></li>
                                <li><a href="create.php">Create</a></li>
                                <li><a href="search.php">Search Map</a></li>
                                <li><a href="#">About</a></li>';
                        }
                        if(isset($_SESSION['userId'])) {
                            $userName = $_SESSION['userUid'];
                            echo "<div class='user-logout-container'>";
                            echo "<li class='user-profile-link'><a href='#'>$userName</a></li>";
                            echo "<li class='login-btn'><a href='includes/logout.inc.php'>Logout</a></li>";
                            echo "</div>";
                        } else {
                            echo "<div class='user-logout-container'>";
                            echo "<li class='login-btn'><a href='signup.php'>Sign Up</a></li>";
                            echo "</div>";
                        }
                    ?>
                </ul>
            </nav>
        </header>