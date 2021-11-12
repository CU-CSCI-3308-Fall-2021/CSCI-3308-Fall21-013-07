<?php
    session_start();
    require "dbh.inc.php";

    // TODO: PREPARE $name VARIABLE TO PREVENT SQL INJECTION

    $userName = $_SESSION['userUid'];
    $name = $_POST['drawingName'];

    $sql = "INSERT INTO drawings (username, drawingName, dateModified, fileName) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
    } else {
        $date = date('Y-m-d H:i:s');
        $id = uniqid('', true);
        mysqli_stmt_bind_param($stmt, "ssss", $_SESSION['userUid'], $name, $date, $id);
        mysqli_stmt_execute($stmt); 

        $data = $_POST['photo'];
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);

        mkdir($_SERVER['DOCUMENT_ROOT']."/CSCI-3308-Fall21-013-07/root/map/drawings");

        file_put_contents($_SERVER['DOCUMENT_ROOT']."/CSCI-3308-Fall21-013-07/root/map/drawings/".$id.'.png', $data);

        mysqli_close($conn);
    }

    
?>