<?php
    require "header.php";

    if(!isset($_SESSION['userId'])) {
        // No user logged in, go back to index.php
        header("Location: index.php");
        exit();
    } else {
        $username = $_SESSION['userUid'];
    }

    // Count errors
    $count = 0;

    $pEmpty = false;
    $samePwd = false;

    $pInvalid = false;
    $pInvalidLength = false;
    $pwdMisMatch = false;

    if(isset($_SESSION['change-pass-submit']) && !empty($_SESSION['change-pass-submit'])) {
        if(isset($_SESSION['error'])) {
            $pInvalid = true;
            if($_SESSION['empty']) {
                // At least one field empty
                $pEmpty = true;
                $count++;
            }
            if(isset($_SESSION['pwdMismatch']) && $_SESSION['pwdMismatch']) {
                $count++;
                $pwdMisMatch = true;
            }
            if(isset($_SESSION['sameAsOldPwd']) && $_SESSION['sameAsOldPwd']) {
                $count++;
                $samePwd = true;
            }
            if(isset($_SESSION['invalidPwdLength']) && $_SESSION['invalidPwdLength']) {
                $pInvalidLength = true;
                $count++;
            }
        }
    }
?>

<main>
    <div class="signup-container">
        <form class="form-signup" action="includes/changepass.inc.php" method="POST">
            <h1>Change Password</h1>
            <input type="password" name="pwd-old" placeholder="Old Password" class="<?php 
                if ($pInvalid) {
                    echo 'signup-error';
                }
            ?>">
            <input type="password" name="pwd" placeholder="New Password" class="<?php 
                if ($pInvalid) {
                    echo 'signup-error';
                }
            ?>">
            <input type="password" name="pwd-repeat" placeholder="Repeat New Password" class="<?php 
                if ($pInvalid) {
                    echo 'signup-error';
                }
            ?>">
            <input type="submit" name="change-pass-submit" value="Submit">
            <?php 
                if (!empty($_SESSION['change-pass-submit']) && $_SESSION['error'] && $count > 0) {
                    // 1 or more errors in logging in
                    if ($pEmpty) {
                        echo "<p class='signup-error'><strong>All fields are required!</strong></p>";
                    } else if ($samePwd) {
                        echo "<p class='signup-error'><strong>New password cannot be old password!</strong></p>";
                    } else if ($pwdMisMatch) {
                        echo "<p class='signup-error'><strong>Passwords do not match!</strong></p>";
                    } else if ($pInvalidLength) {
                        echo "<p class='signup-error'><strong>New password too short!</strong></p>";
                    } else if ($pInvalid) {
                        echo "<p class='signup-error'><strong>Invalid password!</strong></p>";
                    }
                }
            ?>
            <p><a href="profile.php?user=<?php echo $username ?>">Back to profile</a></p>
        </form>
    </div>
</main>

<?php
    require "footer.php";
    
    $_SESSION['error'] = 0;
    $_SESSION['empty'] = 0;
    $_SESSION['invalidPwd'] = 0;
    $_SESSION['sameAsOldPwd'] = 0;
    $_SESSION['pwdMismatch'] = 0;
    $_SESSION['invalidPwdLength'] = 0;
    $_SESSION['change-pass-submit'] = 0;