<?php
    if (isset($_POST['login-submit'])) {
        session_start();
        require "dbh.inc.php";

        $mailuser = $_POST['mailuser'];
        $pwd = $_POST['pwd'];

        // Flash messages for variables
        $_SESSION['login-submit'] = 1;
        $_SESSION['mailuser'] = htmlspecialchars($mailuser, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $_SESSION['pwdLength'] = strlen($pwd);

        // Flash messages for errors
        $_SESSION['error'] = false;
        $_SESSION['empty'] = false;
        $_SESSION['invalidPwd'] = false;

        // Error count
        $count = 0;

        if (empty($mailuser) && $mailuser !== "0" || empty($pwd) && $pwd !== "0") {
            // Error where either field is empty
            $_SESSION['empty'] = true;
            $_SESSION['error'] = true;
            $count++;
        }

        // Check if error count = 0 or not
        if ($count != 0) {
            header("Location: ../login.php");
            exit();
        } else {
            // No errors --> proceed to start login process
            $sql = "SELECT * FROM userinfo WHERE username=? OR email=?;";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror");
                exit();
            } else {

                mysqli_stmt_bind_param($stmt, "ss", $mailuser, $mailuser);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {

                    $pwdCheck = password_verify($pwd, $row['pwd']);
                    if ($pwdCheck == false) {
                        $_SESSION['invalidPwd'] = true;
                        $_SESSION['error'] = true;
                        header("Location: ../login.php");
                        exit();

                    } else if ($pwdCheck == true) {

                        session_start();
                        $_SESSION['userId'] = $row['userID'];
                        $_SESSION['userUid'] = $row['username'];

                        $_SESSION['login-submit'] = false;
                        $_SESSION['mailuser'] = false;
                        $_SESSION['pwdLength'] = false;
                        $_SESSION['empty'] = false;
                        $_SESSION['invalidMailUID'] = false;
                        $_SESSION['invalidPwd'] = false;

                        header("Location: ../index.php");
                        exit();

                    } else {
                        $_SESSION['invalidPwd'] = true;
                        $_SESSION['error'] = true;
                        header("Location: ../login.php");
                        exit();

                    }

                } else {
                    $_SESSION['invalidMailUID'] = true;
                    $_SESSION['invalidPwd'] = true;
                    $_SESSION['error'] = true;
                    header("Location: ../login.php");
                    exit();

                }
            }
        }

    } else {
        header("Location: ../index.php");
        exit();
    }