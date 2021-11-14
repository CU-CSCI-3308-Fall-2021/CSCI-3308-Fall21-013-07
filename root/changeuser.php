<?php
    require "header.php";

    if(!isset($_SESSION['userId'])) {
        // No user logged in, go back to index.php
        header("Location: index.php");
        exit();
    } else {
        $username = $_SESSION['userUid'];
    }
    if(isset($_SESSION['new-user'])) {
        $newUser = $_SESSION['new-user'];
    }

    // Count errors
    $count = 0;

    $uEmpty = false;
    $pEmpty = false;

    $uInvalid = false;
    $pInvalid = false;

    $sameUser = false;

    $takenUser = false;

    if(isset($_SESSION['change-user-submit']) && !empty($_SESSION['change-user-submit'])) {
        if(isset($_SESSION['error'])) {
            if($_SESSION['empty']) {
                // At least one field empty
                $pInvalid = true;
                if(empty($newUser) && $newUser !== "0") {
                    $uEmpty = true;
                    $uInvalid = true;
                    $count++;
                }
            }
            if(isset($_SESSION['invalidUser']) && $_SESSION['invalidUser']) {
                $count++;
                $pInvalid = true;
            }
            if(isset($_SESSION['invalidPwd']) && $_SESSION['invalidPwd']) {
                $count++;
                $pInvalid = true;
            }
            if(isset($_SESSION['takenUser']) && $_SESSION['takenUser']) {
                $count++;
                $takenUser = true;
                $uInvalid = true;
                $pInvalid = true;
            }
            if(isset($_SESSION['sameUser']) && $_SESSION['sameUser']) {
                $count++;
                $sameUser = true;
                $uInvalid = true;
                $pInvalid = true;
            }
        }
    }
?>

<main>
    <div class="signup-container">
        <form class="form-signup" action="includes/changeuser.inc.php" method="POST">
            <h1>Change Username</h1>
            <input type="text" name="user" placeholder="Enter a new username" value="<?php if(false && !empty($username) && !empty($_SESSION['change-user-submit'])) {
                echo $username;
            } ?>" class="<?php 
                if ($pInvalid || $uInvalid) {
                    echo 'signup-error';
                } else if (isset($_SESSION['change-user-submit']) && $_SESSION['change-user-submit']) {
                    echo 'signup-success';
                } 
            ?>">
            <input type="password" name="pwd" placeholder="Password" class="<?php 
                if ($pInvalid || $uInvalid) {
                    echo 'signup-error';
                }
            ?>">
            <input type="submit" name="change-user-submit" value="Submit">
            <?php 
                if (isset($_SESSION['change-user-submit']) && $_SESSION['change-user-submit'] && $_SESSION['error'] && $count > 0) {
                    // 1 or more errors in logging in
                    if ($sameUser) {
                        echo "<p class='signup-error'><strong>That is currently your username!</strong></p>";
                    } else if ($takenUser) {
                        echo "<p class='signup-error'><strong>User already taken!</strong></p>";
                    } else if ($uEmpty || $pEmpty) {
                        echo "<p class='signup-error'><strong>All fields are required!</strong></p>";
                    } else if ($pInvalid || $uInvalid) {
                        echo "<p class='signup-error'><strong>An error occured!</strong></p>";
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
    $_SESSION['invalidUser'] = 0;
    $_SESSION['invalidPwd'] = 0;
    $_SESSION['sameUser'] = 0;
    $_SESSION['change-user-submit'] = 0;
    $_SESSION['takenUser'] = 0;
    $_SESSION['new-user'] = 0;