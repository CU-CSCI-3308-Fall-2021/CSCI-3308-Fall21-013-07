<?php
    session_start();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="root">
        <title>Doodle Designer</title>
        <?php
            // Grab current URL
            $currPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
            // uniqid() used to force CSS to be updated
            echo '<link rel="stylesheet" type="text/css" href="/CSCI-3308-Fall21-013-07/root/includes/css/style.css?'.uniqid().'"/>';
            if($currPage == "create.php" || $currPage == "editdrawing.php" || $currPage == "map.php") {
                echo '<script type="text/javascript" src="/CSCI-3308-Fall21-013-07/root/js/create.js"></script>';
                echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
            }
        ?>
        <link rel="shortcut icon" href="#">
    </head>
    <?php
        if ($currPage == "create.php") {
            echo '<body onload="init()">';
        } else if ($currPage == "editdrawing.php" || $currPage == "map.php") {
            echo '<body onload="init(); writeImage();">';
        } else {
            echo '<body>';
        }
    ?>
        <header>
            <nav>
                <ul>
                    <?php
                        echo '<li><a href="/CSCI-3308-Fall21-013-07/root/" class="active">Home</a></li>
                            <li><a href="/CSCI-3308-Fall21-013-07/root/create.php">Create</a></li>
                            <li><a href="/CSCI-3308-Fall21-013-07/root/search.php">Search Drawing</a></li>';
                        if(isset($_SESSION['userId'])) {
                            $userName = $_SESSION['userUid'];
                            echo "<div class='user-logout-container'>";
                            if ($currPage == "map.php" || $currPage == "editdrawing.php") {
                                echo "<li class='user-profile-link'><a href='../profile.php?user=$userName'>$userName</a></li>";
                                echo "<li class='login-btn'><a href='../includes/logout.inc.php'>Logout</a></li>";
                            } else if ($currPage == "404.php") {
                                echo "<li class='user-profile-link'><a href='/CSCI-3308-Fall21-013-07/root/profile.php?user=$userName'>$userName</a></li>";
                                echo "<li class='login-btn'><a href='/CSCI-3308-Fall21-013-07/root/includes/logout.inc.php'>Logout</a></li>";
                            } else {
                                echo "<li class='user-profile-link'><a href='profile.php?user=$userName'>$userName</a></li>";
                                echo "<li class='login-btn'><a href='includes/logout.inc.php'>Logout</a></li>";
                            }
                            echo "</div>";
                        } else {
                            echo "<div class='user-logout-container'>";
                            echo "<li class='login-btn'><a href='/CSCI-3308-Fall21-013-07/root/signup.php'>Sign Up</a></li>";
                            echo "</div>";
                        }
                    ?>
                </ul>
            </nav>
        </header>