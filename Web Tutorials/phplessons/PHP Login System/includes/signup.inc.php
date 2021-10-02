<?php
    if (isset($_POST['signup-submit'])) {

        require "dbh.inc.php";

        $userName = $_POST['uid'];
        $email = $_POST['mail'];
        $pwd = $_POST['pwd'];
        $pwdRepeat = $_POST['pwd-repeat'];

        if(empty($userName) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
            header("Location: ../signup.php?error=emptyfields&uid=".$userName."&mail=".$email);
            exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
            header("Location: ../signup.php?error=invalidmailuid");
            exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidmail&uid=".$userName);
            exit();
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
            header("Location: ../signup.php?error=invaliduid&mail=".$email);
            exit();
        } else if ($pwd !== $pwdRepeat) {
            header("Location: ../signup.php?error=passwordcheck&uid=".$userName."&mail=".$email);
            exit();
        }
        else {

            $sql = "SELECT uidUsers FROM users WHERE uidUsers=?;";
            $stmt = mysqli_stmt_init($conn);
            
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $userName);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);

                if ($resultCheck > 0) {
                    header("Location: ../signup.php?error=usertaken&mail=".$email);
                } else {
                    $sql = "SELECT uidUsers FROM users WHERE emailUsers=?;";
                    $stmt = mysqli_stmt_init($conn);
                    
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $resultCheck = mysqli_stmt_num_rows($stmt);

                        if ($resultCheck > 0) {
                            header("Location: ../signup.php?error=emailtaken&uid=".$userName);
                        } else {
                            $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../signup.php?error=sqlerror");
                                exit();
                            } else {
                                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($stmt, "sss", $userName, $email, $hashedPwd);
                                mysqli_stmt_execute($stmt);

                                header("Location: ../signup.php?signup=success");
                                exit();
                            }
                        }
                    }
                }
            }

        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        header("Location: ../signup.php");
        exit();
    }