<?php

    include "header.php";
?>

    <main>
        <div class="wrapper-main2">
            <section class="section-default2">
                <h1>Reset Password</h1>
                <p style="font-family: arial; font-size: 16px; font-color: #111; text-align: center">An e-mail will be sent to you with instructions on how to reset your password</p>
                <form action="includes/reset-request.inc.php" method="POST">
                    <input type="text" name="email" placeholder="Enter your email...">
                    <button type="submit" name="reset-request-submit">Reset</button>
                </form>
                <?php
                    if (isset($_GET['reset'])) {
                        if ($_GET['reset'] == "success") {
                            echo '<p class="signupsuccess">Check your e-mail</p>';
                        }
                    }
                ?>
            </section>
        </div>
    </main>

<?php
    require "footer.php";
?>