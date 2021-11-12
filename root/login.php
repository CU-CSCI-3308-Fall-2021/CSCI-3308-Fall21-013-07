<?php
    require "header.php";

    if(isset($_SESSION['userId'])) {
        // If user already logged in, go back to index.php
        header("Location: index.php");
        exit();
    }

    if (isset($_SESSION['IN_SESSION'])) {
        $session = true;
    }
    if(isset($_SESSION['mailuser'])) {
        $mailuser = $_SESSION['mailuser'];
    }
    if(isset($_SESSION['pwdLength'])) {
        $pwdLength = $_SESSION['pwdLength'];
    }

    // Count errors
    $count = 0;

    $muEmpty = false;
    $pEmpty = false;

    $pInvalid = false;

    if(isset($_SESSION['error'])) {
        if($_SESSION['empty']) {
            // At least one field empty
            if(empty($mailuser) && $mailuser !== "0") {
                $muEmpty = true;
                $pInvalid = true;
                $count++;
            }
            if($pwdLength == 0) {
                $pInvalid = true;
                $count++;
            }
        }
    }

    session_unset();
    session_destroy();
?>

<main>
    <div class="signup-container">
        <form class="form-signup" action="includes/login.inc.php" method="POST">
            <h1>Login</h1>
            <input type="text" name="mailuser" placeholder="Username or Email" value="<?php if(!empty($mailuser)) {
                echo $mailuser;
            } ?>" class="<?php 
                if ($pInvalid) {
                    echo 'signup-error';
                } else if ($session) {
                    echo 'signup-success';
                } 
            ?>">
            <input type="password" name="pwd" placeholder="Password" class="<?php 
                if ($pInvalid) {
                    echo 'signup-error';
                } else if ($session) {
                    echo 'signup-success';
                } 
            ?>">
            <input type="submit" name="login-submit" value="Login">
            <?php 
                if ($count == 1) {
                    // 1 error in logging in
                    if ($muEmpty || $pEmpty) {
                        echo "<p class='signup-error'><strong>All fields are required!</strong></p>";
                    } else if ($pInvalid) {
                        echo "<p class='signup-error'><strong>Username or password not found</strong></p>";
                    }
                } else if ($count > 1) {
                    // More than 1 error in logging in
                    if ($pInvalid) {
                        echo "<p class='signup-error'><strong>Username or password not found</strong></p>";
                    } else {
                        echo '<p class="signup-error"><strong>Multiple errors!</strong></p>';
                    }
                }
            ?>
            <p>Don't have an account? <a href="signup.php">Sign up today</a></p>
            <!--<p><a href="includes/reset-password.inc.php">Forgot password?</a></p>-->
        </form>
    </div>
</main>

<?php
    require "footer.php";