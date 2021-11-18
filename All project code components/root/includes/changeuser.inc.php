<?php


    if (isset($_POST['change-user-submit'])) {
        require "dbh.inc.php";
        session_start();

        $username = $_SESSION['userUid'];
        $_SESSION['change-user-submit'] = 1;

        $user = $_POST['user'];
        $pwd = $_POST['pwd'];

        $_SESSION['error'] = false;
        $_SESSION['empty'] = false;
        $_SESSION['invalidPwd'] = false;
        $_SESSION['sameUser'] = false;
        $_SESSION['takenUser'] = false;

        if ($username == $user) {
            // Same username --> error message
            $_SESSION['sameUser'] = true;
            $_SESSION['error'] = true;
            header("Location: ../changeuser.php");
            exit();
        }

        $_SESSION['error'] = false;
        $_SESSION['empty'] = false;
        $_SESSION['invalidPwd'] = false;
        $_SESSION['takenUser'] = false;

        $test = false;

        $count = 0;

        if (empty($user) && $user !== "0" || empty($pwd) && $pwd !== "0") {
            // Error where either field is empty
            $_SESSION['empty'] = true;
            $_SESSION['error'] = true;
            $count++;
        }

        if (!ctype_alnum($user)) {
            $_SESSION['invalidUser'] = true;
            $_SESSION['error'] = true;
            $count++;
        }

        if ($count != 0) {
            $_SESSION['error'] = true;
            header("Location: ../changeuser.php");
            exit();
        } else {
            // Neither field empty --> proceed with sql query and check if new username already in DB
            
            $sql = "SELECT username FROM userinfo WHERE username=?;";
            $stmt = mysqli_stmt_init($conn);
            
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $user);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);

                if ($resultCheck > 0) {
                    $_SESSION['takenUser'] = true;
                    $_SESSION['error'] = true;
                    header("Location: ../changeuser.php");
                    exit();
                } else {
                    // Check if password matches
                    $sql = "SELECT * FROM userinfo WHERE username=?;";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../changeuser.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result)) {
                            $pwdCheck = password_verify($pwd, $row['pwd']);
                            if ($pwdCheck == false) {
                                $_SESSION['invalidPwd'] = true;
                                $_SESSION['error'] = true;
                                header("Location: ../changeuser.php");
                                exit();

                            } else if ($pwdCheck == true) {
                                session_start();
                                $_SESSION['userId'] = $row['userID'];
                                $_SESSION['userUid'] = $row['username'];

                                // Now we can update username

                                $_SESSION['new-user'] = $user;
                                $sql = "UPDATE userinfo SET username=? WHERE username=?;";
                                $stmt = mysqli_stmt_init($conn);

                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    header("Location: ../changeuser.php?error=sqlerror");
                                    exit();
                                } else {
                                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                                        header("Location: ../changeuser.php?error=sqlerror");
                                        mysqli_close($conn);
                                        exit();
                                    } else {
                                        mysqli_stmt_bind_param($stmt, "ss", $user, $username);
                                        mysqli_stmt_execute($stmt);

                                        // Now change username in drawings

                                        $sql = "UPDATE drawings SET username=? WHERE username=?;";
                                        $stmt = mysqli_stmt_init($conn);

                                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                                            header("Location: ../changeuser.php?error=sqlerror");
                                            exit();
                                        } else {
                                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                                header("Location: ../changeuser.php?error=sqlerror");
                                                mysqli_close($conn);
                                                exit();
                                            } else {
                                                mysqli_stmt_bind_param($stmt, "ss", $user, $username);
                                                mysqli_stmt_execute($stmt);

                                                $_SESSION['error'] = 0;
                                                $_SESSION['empty'] = 0;
                                                $_SESSION['invalidUser'] = 0;
                                                $_SESSION['invalidPwd'] = 0;
                                                $_SESSION['sameUser'] = 0;
                                                $_SESSION['change-user-submit'] = 0;
                                                $_SESSION['takenUser'] = 0;
                                                $_SESSION['new-user'] = 0;
                                                $_SESSION['userUid'] = $user;
                                                
                                                mysqli_close($conn);
                                                header("Location: ../profile.php?user=$user");
                                                exit();
                                            }
                                        }
                                    }
                                }
                            }

                        } else {
                            $_SESSION['invalidPwd'] = true;
                            $_SESSION['error'] = true;
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
        header("Location: ../changeuser.php");
        exit();
    }