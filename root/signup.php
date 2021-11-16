<?php
    require "header.php";
?>

<main>
    <?php
        if(isset($_SESSION['userId'])) {
            // If user already logged in, go back to index.php
            header("Location: index.php");
            exit();
        }

        // Error handling
        
        // Grab form values
        if(isset($_SESSION['fN'])) {
            $fN = $_SESSION['fN'];
        }
        if(isset($_SESSION['lN'])) {
            $lN = $_SESSION['lN'];
        }
        if(isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }
        if(isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
        }
        if(isset($_SESSION['pwd1Length'])) {
            $pwd1Length = $_SESSION['pwd1Length'];
        }
        if(isset($_SESSION['pwd2Length'])) {
            $pwd2Length = $_SESSION['pwd2Length'];
        }

        // Count errors
        $count = 0;

        // Check if certain field is empty
        $fEmpty = false;
        $lEmpty = false;
        $uEmpty = false;
        $eEmpty = false;
        $p1Empty = false;
        $p2Empty = false;

        // Check if field invalid
        $fInvalid = false;
        $lInvalid = false;
        $uInvalid = false;
        $eInvalid = false;
        $pInvalid = false;
        $pInvalidLength = false;

        // Check if user/email taken
        $takenUser = false;
        $takenEmail = false;

        if(isset($_SESSION['error'])) {
            if($_SESSION['empty']) {
                // At least one field empty
                if (empty($fN) && $fN !== "0") {
                    $fEmpty = true;
                    $fInvalid = true;
                    $count++;
                }
                if (empty($lN) && $lN !== "0") {
                    $lEmpty = true;
                    $lInvalid = true;
                    $count++;
                }
                if (empty($user) && $user !== "0") {
                    $uEmpty = true;
                    $uInvalid = true;
                    $count++;
                }
                if (empty($email) && $email !== "0") {
                    $eEmpty = true;
                    $uInvalid = true;
                    $count++;
                }
                if ($pwd1Length == 0) {
                    $p1Empty = true;
                    $pInvalid = true;
                    $count++;
                }
                if ($pwd2Length == 0) {
                    $p2Empty = true;
                    $pInvalid = true;
                    $count++;
                }
            }

            if($_SESSION['invalidFN']) {
                $fInvalid = true;
                $count++;
            }
            if($_SESSION['invalidLN']) {
                $lInvalid = true;
                $count++;
            }
            if($_SESSION['invalidUser']) {
                $uInvalid = true;
                $count++;
            }
            if($_SESSION['invalidEmail']) {
                $eInvalid = true;
                $count++;
            }
            if($_SESSION['invalidPwd']) {
                $pInvalid = true;
                $count++;
            }
            if($_SESSION['invalidPwdLength']) {
                $pInvalidLength = true;
                $pInvalid = true;
                $count++;
            }
            if($_SESSION['takenUser']) {
                $takenUser = true;
                $count++;
            }
            if($_SESSION['takenEmail']) {
                $takenEmail = true;
                $count++;
            }
            session_unset();
            session_destroy();
        }

    ?>
    <div class="signup-container">
        <form class="form-signup" action="includes/signup.inc.php" method="POST">
            <h1>Sign Up</h1>
            <input type="text" name="fN" placeholder="First Name" value="<?php if(!empty($fN)) {
                echo $fN;
            } ?>" class="<?php 
                if ($fInvalid) {
                    echo 'signup-error';
                } else if (isset($_SESSION['signup-submit']) && $_SESSION['signup-submit'] && !$pInvalid) {
                    echo 'signup-success';
                }
            ?>">
            <input type="text" name="lN" placeholder="Last Name" value="<?php if(!empty($lN)) {
                echo $lN;
            } ?>" class="<?php 
                if ($lInvalid) {
                    echo 'signup-error';
                } else if (isset($_SESSION['signup-submit']) && $_SESSION['signup-submit'] && !$pInvalid) {
                    echo 'signup-success';
                }
            ?>">
            <input type="text" name="user" placeholder="Username" value="<?php if(!empty($user)) {
                echo $user;
            } ?>" class="<?php 
                if ($uInvalid || $takenUser) {
                    echo 'signup-error';
                } else if (isset($_SESSION['signup-submit']) && $_SESSION['signup-submit'] && !$pInvalid) {
                    echo 'signup-success';
                }
            ?>">
            <input type="text" name="email" placeholder="Email" value="<?php if(!empty($email)) {
                echo $email;
            } ?>" class="<?php 
                if ($eInvalid || $takenEmail) {
                    echo 'signup-error';
                } else if (isset($_SESSION['signup-submit']) && $_SESSION['signup-submit'] && !$pInvalid) {
                    echo 'signup-success';
                }
            ?>">
            <input type="password" name="pwd" placeholder="Password" class="<?php 
                if ($pInvalid) {
                    echo 'signup-error';
                }
            ?>">
            <input type="password" name="pwd-repeat" placeholder="Repeat Password" class="<?php 
                if ($pInvalid) {
                    echo 'signup-error';
                }
            ?>">
            <input type="submit" name="signup-submit" value="Sign Up"></button>
            <?php
                if($count == 1) {
                    if ($fEmpty || $lEmpty || $uEmpty || $eEmpty || $p1Empty || $p2Empty) {
                        echo '<p class="signup-error"><strong>Fill in all the fields!</strong></p>';
                    } else if ($fInvalid) {
                        echo '<p class="signup-error"><strong>Invalid first name!</strong></p>';
                    } else if ($lInvalid) {
                        echo '<p class="signup-error"><strong>Invalid last name!</strong></p>';
                    } else if ($uInvalid) {
                        echo '<p class="signup-error"><strong>Invalid username!</strong></p>';
                    } else if ($eInvalid) {
                        echo '<p class="signup-error"><strong>Invalid e-mail!</strong></p>';
                    }  else if ($takenUser) {
                        echo '<p class="signup-error"><strong>Username already taken!</strong></p>';
                    } else if ($takenEmail) {
                        echo '<p class="signup-error"><strong>E-mail already taken!</strong></p>';
                    } else if ($pInvalidLength) {
                        echo '<p class="signup-error"><strong>Passwords too short!</strong></p>';
                    } else {
                        echo '<p class="signup-error"><strong>Passwords do not match!</strong></p>';
                    }
                } else if ($count > 1) {
                    if (($p1Empty || $p2Empty) && (!$fEmpty && !$lEmpty && !$uEmpty && !$eEmpty)) {
                        echo '<p class="signup-error"><strong>Password fields required!</strong></p>';
                    } else {
                        echo '<p class="signup-error"><strong>Multiple errors!</strong></p>';
                    }
                }
            ?>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</main>

<?php
    require "footer.php";
    $_SESSION['error'] = false;
    $_SESSION['empty'] = false;
    $_SESSION['invalidFN'] = false;
    $_SESSION['invalidLN'] = false;
    $_SESSION['invalidUser'] = false;
    $_SESSION['invalidEmail'] = false;
    $_SESSION['invalidPwd'] = false;
    $_SESSION['invalidPwdLength'] = false;
    $_SESSION['takenUser'] = false;
    $_SESSION['takenEmail'] = false;