<?php
    require "header.php";
?>

    <main>
        <div class="wrapper-main2">
            <section class="section-default2">
                <h1>Signup</h1>
                <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyfields") {
                            echo '<p class="signuperror">Fill in all the fields!</p>';
                        } else if ($_GET['error'] == "invalidmailuid") {
                            echo '<p class="signuperror">Invalid username and e-mail!</p>';
                        } else if ($_GET['error'] == "invalidmail") {
                            echo '<p class="signuperror">Invalid e-mail!</p>';
                        } else if ($_GET['error'] == "invaliduid") {
                            echo '<p class="signuperror">Invalid username!</p>';
                        } else if ($_GET['error'] == "passwordcheck") {
                            echo '<p class="signuperror">Passwords do not match!</p>';
                        } else if ($_GET['error'] == "usertaken") {
                            echo '<p class="signuperror">Username already taken!</p>';
                        } else if ($_GET['error'] == "emailtaken") {
                            echo '<p class="signuperror">E-mail already taken!</p>';
                        }
                    } else if (isset($_GET['signup']) && $_GET['signup'] == "success") {
                        echo '<p class="signupsucc">Signup successful!</p>';
                    }
                ?>
                <form class="form-signup" action="includes/signup.inc.php" method="POST">
                    <input type="text" name="uid" placeholder="Username">
                    <input type="text" name="mail" placeholder="Email">
                    <input type="password" name="pwd" placeholder="Password">
                    <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                    <button type="submit" name="signup-submit">Signup</button>
                </form>

                    <!-- FORM TO RESET PASSWORD -->
                    <?php
                        if (isset($_GET['newpwd'])) {
                            if ($_GET[newpwd] == "passwordupdated") {
                                echo '<p class="signupsuccess">Your password has been reset!</p>';
                            }
                        }
                    ?>
                    <a href="reset-password.php">Forgot your password?</a>
            </section>
        </div>
    </main>

<?php
    require "footer.php";
?>