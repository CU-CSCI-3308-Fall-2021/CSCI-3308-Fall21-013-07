<?php
    session_start();
    require "dbh.inc.php";

    if (!isset($_SESSION['userUid'])) {
        header("Location: ../profile.php");
        exit();
    }

    $username = $_SESSION['userUid'];

    $sql = "DELETE FROM userinfo WHERE username=?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo $sql;
    } else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result > 0) {
            // User now deleted
            // Now have to find their drawings

            $sql = "SELECT fileName FROM drawings WHERE username=?;";

            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../profile.php?user=$username");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $queryResult = mysqli_num_rows($result);

                if ($queryResult > 0) {
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
                        header("Location: ../profile.php?user=$username");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../index.php?");
                        session_unset();
                        session_destroy();
                        exit();
                    }
                }
            }
        }
    }