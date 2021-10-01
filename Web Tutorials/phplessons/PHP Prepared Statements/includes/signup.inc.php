<?php
    
    include_once 'dbh.inc.php';

    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
    VALUES (?, ?, ?, ?, ?);"; //Replace parameters with ? to do prepared statement
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL Error";
    } else {
        mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $uid, $pwd);
        mysqli_stmt_execute($stmt);
    }

    header("Location: ../index.php?signup=success"); // Go back to home page when signed up