<?php
    
    if(isset($_POST['submit'])) {

        include_once 'dbh.inc.php';

        $first = $_POST['first'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];

        if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)){
            header("Location: ../index.php?signup=empty");
            exit();
        } else {
            if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                header("Location: ../index.php?signup=char");
                exit();
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Check if not valid email
                    header("Location: ../index.php?signup=invalidemail&first=$first&last=$last&uid=$uid");
                    exit();
                } else {

                    $first = $_POST['first'];
                    $last = $_POST['last'];
                    $email = $_POST['email'];
                    $uid = $_POST['uid'];
                    $pwd = $_POST['pwd'];
                
                    $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
                    VALUES (?, ?, ?, ?, ?);";

                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL Error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $uid, $pwd);
                        mysqli_stmt_execute($stmt);
                    }
                
                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }
            
        }
    } else {
        header("Location: ../index.php?signup=error");
        exit();
    }