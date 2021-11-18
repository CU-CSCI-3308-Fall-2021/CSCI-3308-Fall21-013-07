<?php
    session_start();
    require "dbh.inc.php";
    
    $userName = $_SESSION['userUid'];
    $fileName = $_POST['fileName'];
    $oldName = $_POST['oldName'];
    $newName = $_POST['newName'];
    $newId = $_POST['newId'];

    $sql = "SELECT fileName FROM drawings WHERE drawingName=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../map/editdrawing.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $oldName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $oldId = $row['fileName'];
            $date = date('Y-m-d H:i:s');

            // Insert new fileName into data table
            $sql = "UPDATE drawings SET fileName=?, dateModified=?, drawingName=? WHERE fileName=?;";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../map/editdrawing.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ssss", $newId, $date, $newName, $oldId);
                mysqli_stmt_execute($stmt);

                // Now delete old drawing
                if (unlink($_SERVER['DOCUMENT_ROOT']."/CSCI-3308-Fall21-013-07/root/map/drawings/".$oldId.'.png')) {
                    // File successfuly deleted, now insert new drawing
                    $data = $_POST['photo'];
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    
                    mysqli_close($conn);

                    file_put_contents($_SERVER['DOCUMENT_ROOT']."/CSCI-3308-Fall21-013-07/root/map/drawings/".$newId.'.png', $data);
                    header("Location: ../map/map.php?map=$newId");
                    exit();
                } else {
                    header("Location: ../map/editdrawing.php?error=error");
                    exit();
                }
            }
        } else {
            header("Location: ../map/editdrawing.php?error=error");
            exit();
        }
    }
?>