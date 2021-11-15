<?php
    session_start();

    if (!isset($_SESSION['userUid']) || !isset($_POST['delete-drawings-submit'])) {
        header("Location: ../index.php");
        exit();
    }

    require "dbh.inc.php";

    $username = $_SESSION['userUid'];
    // Now have to find their drawings

    $sql = "SELECT fileName FROM drawings WHERE username=?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../profile.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $queryResult = mysqli_num_rows($result);

        if ($queryResult > 0) {
            // Drawing count > 0
            $filenames = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $fileNames[] = $row['fileName'];
            }

            // File names added to $fileNames[] --> Now delete from directory
            $arraySize = count($fileNames);
            for ($i = 0; $i < $arraySize; $i++) {
                unlink("../map/drawings/".$fileNames[$i].".png");
            }

            // Files deletede in directory -> delete in DB
            $sql = "DELETE FROM drawings WHERE username=?;";

            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../profile.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);

                // Now set drawingCount to 0

                $sql = "UPDATE userinfo SET drawingCount = 0 WHERE username = ?;";

                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../profile.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['userUid']);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../profile.php?user=$username");
                    exit();
                }
            }
        } else {
            header("Location: ../profile.php?user=$username");
            exit();
        }
    }