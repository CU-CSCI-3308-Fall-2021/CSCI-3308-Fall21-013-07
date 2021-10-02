<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error Handler</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h2>Signup</h2>
        <form action="includes/signup.inc.php" method="POST">
              <?php 
                    if ((isset($_GET['first']))) {
                        $first = $_GET['first'];
                        echo '<input type="text" name="first" placeholder="Firstname" value="'.$first.'">';
                    } else {
                        echo '<input type="text" name="first" placeholder="Firstname">';
                    }

                    if ((isset($_GET['last']))) {
                        $last = $_GET['last'];
                        echo '<input type="text" name="last" placeholder="Lastname" value="'.$last.'">';
                    } else {
                        echo '<input type="text" name="last" placeholder="Lastname">';
                    }
            ?>
            <!-- Using required attribute is not secure -->
            <br>
            <br>
            <input type="text" name="email" placeholder="E-mail">
            <br>
            <?php
                if ((isset($_GET['uid']))) {
                    $uid = $_GET['uid'];
                    echo '<input type="text" name="uid" placeholder="Username" value="'.$uid.'">';
                } else {
                    echo '<input type="text" name="uid" placeholder="Username">';
                }
            ?>
            <br>
            <input type="password" name="pwd" placeholder="Password">
            <br>
            <button type="submit" name="submit">Sign Up!</button>
        </form>

        <?php
             /*
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if (strpos($fullUrl, "signup=empty") == true) {
                echo "<p class='error'>You did not fill in all the fields!</p>";
                exit();
            } elseif (strpos($fullUrl, "signup=char") == true) {
                echo "<p class='error'>You used invalid characters!</p>";
                exit();
            } elseif (strpos($fullUrl, "signup=invalidemail") == true) {
                echo "<p class='error'>You used an invalid email!</p>";
                exit();
            } elseif (strpos($fullUrl, "signup=success") == true) {
                echo "<p class='success'>Welcome, you are now registered!</p>";
                exit();
            }
            */

            // This way is easier!
            if (!isset($_GET['signup'])) {

                exit();

            } else {

                $signupCheck = $_GET['signup'];

                if ($signupCheck == "empty") {
                    echo "<p class='error'>You did not fill in all the fields!</p>";
                    exit();
                } elseif ($signupCheck == "char") {
                    echo "<p class='error'>You used invalid characters!</p>";
                    exit();
                } elseif ($signupCheck == "invalidemail") {
                    echo "<p class='error'>You used an invalid email!</p>";
                    exit();
                } elseif ($signupCheck == "success") {
                    echo "<p class='success'>Welcome, you are now registered!</p>";
                    exit();
                }
            }
        ?>
    </body>
</html>
