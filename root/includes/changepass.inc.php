<?php
    if (isset($_POST['change-pass-submit'])) {
        require "dbh.inc.php";
        session_start();

        $username = $_SESSION['userUid'];
        $_SESSION['change-pass-submit'] = 1;

        $pwdOld = $_POST['pwd-old'];
        $pwdNew = $_POST['pwd'];
        $pwdRepeat = $_POST['pwd-repeat'];

        $_SESSION['error'] = false;
        $_SESSION['empty'] = false;
        $_SESSION['pwdMismatch'] = false;
        $_SESSION['invalidPwd'] = false;
        $_SESSION['invalidPwdLengh'] = false;
        $_SESSION['sameAsOldPwd'] = false;

        $count = 0;

        if (empty($pwdOld) && $pwdOld !== "0" || empty($pwdNew) && $pwdNew !== "0" || empty($pwdRepeat) && $pwdRepeat !== "0") {
            // Error where either field is empty
            $_SESSION['empty'] = true;
            $_SESSION['error'] = true;
            $count++;
        }

        if ($pwdNew !== $pwdRepeat) {
            $_SESSION['pwdMismatch'] = true;
            $_SESSION['error'] = true;
            $count++;
        } if (strlen($pwdNew) < 8) {
            // Check if password length less than 8
            $_SESSION['invalidPwdLength'] = true;
            $_SESSION['error'] = true;
            $count++;
        }

        if ($count != 0) {
            $_SESSION['error'] = true;
            header("Location: ../changepass.php");
            exit();
        } else {
            // No fields empty --> proceed with sql query and verify old password
            $sql = "SELECT * FROM userinfo WHERE username=?;";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../changepass.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    $pwdCheck = password_verify($pwdNew, $row['pwd']);
                    if ($pwdCheck == true) {
                        $_SESSION['sameAsOldPwd'] = true;
                        $_SESSION['error'] = true;
                        header("Location: ../changepass.php");
                        exit();

                    } else if ($pwdCheck == false) {
                        session_start();
                        $_SESSION['userId'] = $row['userID'];
                        $_SESSION['userUid'] = $row['username'];
                        
                        $sql = "UPDATE userinfo SET pwd=? WHERE username=?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../changepass.php?error=sqlerror");
                            exit();
                        } else {
                            $hashedPwd = password_hash($pwdNew, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $username);
                            mysqli_stmt_execute($stmt);

                            $_SESSION['error'] = 0;
                            $_SESSION['empty'] = 0;
                            $_SESSION['invalidPwd'] = 0;
                            $_SESSION['sameAsOldPwd'] = 0;
                            $_SESSION['pwdMismatch'] = 0;
                            $_SESSION['invalidPwdLength'] = 0;
                            $_SESSION['change-pass-submit'] = 0;

                            header("Location: ../profile.php?user=$username");
                            exit();
                        }
                    }
                }
            }
        }

        header("Location: ../profile.php?user=$username");
        exit();
    } else {
        header("Location: ../changepass.php");
        exit();
    }