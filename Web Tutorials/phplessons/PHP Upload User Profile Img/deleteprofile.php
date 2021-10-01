<?php
    session_start();
    include_once 'dbh.php';
    // This gets the user id
    $sessionId = $_SESSION['id'];

    $filename = "uploads/profile".$sessionId."*";
    $fileinfo = glob($filename); // This searches for the file
    $fileExt = explode(".", $fileinfo[0]);

    $fileactualExt = $fileExt[1];

    $file = "uploads/profil".sessionId.".".$fileactualExt;

    if (!unlink($file)) {
        echo "File was not deleted!";
    } else {
        echo "File was deleted";
    }

    $sql = "UPDATE profileimg SET status=1 WHERE userid='$sessionId';";
    mysqli_query($conn, $sql);

    header("Location: index.php?deletesuccess");
