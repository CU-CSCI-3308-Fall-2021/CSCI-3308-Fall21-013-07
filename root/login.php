<?php
    require "header.php";

    if(isset($_SESSION['userId'])) {
        // If user already logged in, go back to index.php
        header("Location: index.php");
        exit();
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

    $mUInvalid = false;
    $pInvalid = false;

    if(isset($_SESSION['login-submit']) && !empty($_SESSION['login-submit'])) {
        if(isset($_SESSION['error'])) {
            if($_SESSION['empty']) {
                // At least one field empty
                $pInvalid = true;
                if(empty($mailuser) && $mailuser !== "0") {
                    $muEmpty = true;
                    $mUInvalid = true;
                    $pInvalid = true;
                    $count++;
                }
                if($pwdLength == 0) {
                    $pEmpty = true;
                    $count++;
                }
            }
            if(isset($_SESSION['invalidMailUID']) && $_SESSION['invalidMailUID']) {
                $count++;
                $mUInvalid = true;
                $pInvalid = true;
            }
            
            if(isset($_SESSION['invalidPwd']) && $_SESSION['invalidPwd']) {
                $count++;
                $pInvalid = true;
                $mUInvalid = true;
            }
        }
    }
?>

<main>
    <div class="signup-container">
        <form class="form-signup" action="includes/login.inc.php" method="POST">
            <h1>Login</h1>
            <input type="text" name="mailuser" placeholder="Username or Email" value="<?php if(!$muEmpty && isset($_SESSION['login-submit']) && $_SESSION['login-submit']) {
                echo $mailuser;
            } ?>" class="<?php 
                if ($pInvalid || $mUInvalid) {
                    echo 'signup-error';
                } else if (isset($_SESSION['login-submit']) && $_SESSION['login-submit'] && !$pInvalid) {
                    echo 'signup-success';
                } 
            ?>">
            <input type="password" name="pwd" placeholder="Password" class="<?php 
                if (($pInvalid || $mUInvalid) && isset($_SESSION['login-submit']) && $_SESSION['login-submit']) {
                    echo 'signup-error';
                }
            ?>">
            <input type="submit" name="login-submit" value="Login">
            <?php 
                if (isset($_SESSION['login-submit']) && $_SESSION['login-submit'] && $count > 0) {
                    // 1 or more errors in logging in
                    if ($muEmpty || $pEmpty) {
                        echo "<p class='signup-error'><strong>All fields are required!</strong></p>";
                    } else if ($pInvalid || $mUInvalid) {
                        echo "<p class='signup-error'><strong>Username or password not found</strong></p>";
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
    $_SESSION['login-submit'] = 0;
    $_SESSION['mailuser'] = 0;
    $_SESSION['pwdLength'] = 0;
    $_SESSION['empty'] = 0;
    $_SESSION['invalidMailUID'] = 0;
    