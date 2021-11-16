<?php
    if (isset($_POST['signup-submit'])) {
        session_start();
        require "dbh.inc.php";

        // Grab the inputs from form

        $firstName = $_POST['fN'];
        $lastName = $_POST['lN'];
        $userName = $_POST['user'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $pwdRepeat = $_POST['pwd-repeat'];

        // Flash messages of form variables
        // htmlspecialchars used to interpret content outputted to HTML as content, not HTML --> important for security
        $_SESSION['fN'] = htmlspecialchars($firstName, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $_SESSION['lN'] = htmlspecialchars($lastName, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $_SESSION['user'] = htmlspecialchars($userName, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $_SESSION['email'] = htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $_SESSION['pwd1Length'] = strlen($pwd);
        $_SESSION['pwd2Length'] = strlen($pwdRepeat);
        
        // Flash messages of errors
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

        // Error count
        $count = 0;

        if(empty($firstName) && $firstName !== "0" || empty($lastName) && $lastName !== "0" || empty($userName) && $userName !== "0" || empty($email) && $email !== "0" || empty($pwd) && $pwd !== "0" || empty($pwdRepeat) && $pwdRepeat !== "0") {
            $_SESSION['empty'] = true;
            $_SESSION['error'] = true;
            $count++;
        } if (!ctype_alpha($firstName)) {
            $_SESSION['invalidFN'] = true;
            $_SESSION['error'] = true;
            $count++;
        } if (!ctype_alpha($lastName)) {
            $_SESSION['invalidLN'] = true;
            $_SESSION['error'] = true;
            $count++;
        } if (!ctype_alnum($userName)) {
            $_SESSION['invalidUser'] = true;
            $_SESSION['error'] = true;
            $count++;
        } if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['invalidEmail'] = true;
            $_SESSION['error'] = true;
            $count++;
        }  if ($pwd !== $pwdRepeat) {
            $_SESSION['invalidPwd'] = true;
            $_SESSION['error'] = true;
            $count++;
        } if (strlen($pwd) < 8) {
            // Check if password length less than 8
            $_SESSION['invalidPwdLength'] = true;
            $_SESSION['error'] = true;
            $count++;
        }
        if ($count != 0) {
            header("Location: ../signup.php");
            exit();
        } else {
            // No errors in form
            $sql = "SELECT username FROM userinfo WHERE username=?;";
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
                    $_SESSION['takenUser'] = true;
                    // Check if email also taken
                    $sql = "SELECT email FROM userinfo WHERE email=?;";
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
                            // Email also taken
                            $_SESSION['takenEmail'] = true;
                        }
                        // Go back to signup.php regardless
                        header("Location: ../signup.php");
                        exit();
                    }
                } else {
                    $sql = "SELECT email FROM userinfo WHERE email=?;";
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
                            $_SESSION['takenEmail'] = true;
                            header("Location: ../signup.php");
                            exit();
                        } else {
                            $sql = "INSERT INTO userinfo (firstName, lastName, username, email, pwd, drawingCount, registrationDate, lastLoginTime, dailyStreak) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../signup.php?error=sqlerror");
                                exit();
                            } else {
                                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                                $drawingCount = 0;
                                $date = date('Y-m-d H:i:s');
                                $streak = 0;
                                mysqli_stmt_bind_param($stmt, "sssssissi", $firstName, $lastName, $userName, $email, $hashedPwd, $drawingCount, $date, $date, $streak);
                                mysqli_stmt_execute($stmt);

                                $sql = "SELECT * FROM userinfo WHERE username=?;";
                                $stmt = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    header("Location: ../signup.php?error=sqlerror");
                                    exit();
                                } else {
                                    mysqli_stmt_bind_param($stmt, "s", $userName,);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    if ($row = mysqli_fetch_assoc($result)) {
                                        session_start();
                                        session_unset();
                                        session_destroy();

                                        session_start();
                                        $_SESSION['userId'] = $row['userID'];
                                        $_SESSION['userUid'] = $row['username'];
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
    
                                        header("Location: ../index.php?");
                                        exit();
                                    }
                                }
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