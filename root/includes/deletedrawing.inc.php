<?php
    session_start();

    if (!isset($_SESSION['userUid']) || !isset($_GET['map']) || !isset($_POST['delete-drawing-submit'])) {
        header("Location: ../index.php");
        exit();
    }

    require "dbh.inc.php";

    $username = $_SESSION['userUid'];
    $fileName = $_GET['map'];
    // Now have to find their drawings

    $sql = "SELECT * FROM drawings WHERE username=? AND fileName=?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../map.php?map=$fileName?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $username, $fileName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $queryResult = mysqli_num_rows($result);

        if ($queryResult > 0) {
            // Drawing found
            unlink("../map/drawings/".$fileName.".png");

            // Files deletede in directory -> delete in DB
            $sql = "DELETE FROM drawings WHERE username=? AND fileName=?;";

            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../map.php?map=$fileName?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $username, $fileName);
                mysqli_stmt_execute($stmt);

                // Now set drawingCount to 0

                $sql = "UPDATE userinfo SET drawingCount = drawingCount - 1 WHERE username = ? AND drawingCount > 0;";

                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../map.php?map=$fileName?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['userUid']);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.php");
                    exit();
                }
            }
        } else {
            header("Location: ../index.php");
            exit();
        }
    }