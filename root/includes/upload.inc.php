<?php
    session_start();
    require "dbh.inc.php";

    $userName = $_SESSION['userUid'];
    $name = $_POST['drawingName'];

    $sql = "SELECT username FROM drawings WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../create.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        if ($resultCheck > 0) {
            // User found --> now check if there is existing map already
            $sql = "SELECT drawingName FROM drawings WHERE drawingName = ?;";
            $stmt = mysqli_stmt_init($conn);
                    
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../create.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);

                if ($resultCheck > 0) {
                    // Replace drawing in map/drawings/ dir
                    $sql = "SELECT fileName FROM drawings WHERE drawingName=?";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../create.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $name);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['fileName'];

                            $data = $_POST['photo'];
                            list($type, $data) = explode(';', $data);
                            list(, $data) = explode(',', $data);
                            $data = base64_decode($data);

                            mkdir($_SERVER['DOCUMENT_ROOT']."/CSCI-3308-Fall21-013-07/root/map/drawings");

                            file_put_contents($_SERVER['DOCUMENT_ROOT']."/CSCI-3308-Fall21-013-07/root/map/drawings/".$id.'.png', $data);

                            mysqli_close($conn);
                        } else {
                            header("Location: ../create.php?error=sqlerror");
                            exit();
                        }
                    }
                } else {
                    // Insert drawing and increment drawing count
                    $sql = "INSERT INTO drawings (username, drawingName, dateModified, fileName) VALUES (?, ?, ?, ?);";

                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../create.php?error=sqlerror");
                        exit();
                    } else {
                        $date = date('Y-m-d H:i:s');
                        $id = uniqid();
                        mysqli_stmt_bind_param($stmt, "ssss", $_SESSION['userUid'], $name, $date, $id);
                        mysqli_stmt_execute($stmt); 

                        $data = $_POST['photo'];
                        list($type, $data) = explode(';', $data);
                        list(, $data) = explode(',', $data);
                        $data = base64_decode($data);

                        mkdir($_SERVER['DOCUMENT_ROOT']."/CSCI-3308-Fall21-013-07/root/map/drawings");

                        file_put_contents($_SERVER['DOCUMENT_ROOT']."/CSCI-3308-Fall21-013-07/root/map/drawings/".$id.'.png', $data);

                        $sql = "UPDATE userinfo SET drawingCount = drawingCount + 1 WHERE username = ?;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../create.php?error=sqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "s", $_SESSION['userUid']);
                            mysqli_stmt_execute($stmt);
                        }

                        mysqli_close($conn);
                    }
                }
            }
        } else {
            // User has no drawings yet
            $sql = "INSERT INTO drawings (username, drawingName, dateModified, fileName) VALUES (?, ?, ?, ?);";

            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../create.php?error=sqlerror");
                exit();
            } else {
                $date = date('Y-m-d H:i:s');
                $id = uniqid();
                mysqli_stmt_bind_param($stmt, "ssss", $_SESSION['userUid'], $name, $date, $id);
                mysqli_stmt_execute($stmt); 

                $data = $_POST['photo'];
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);

                mkdir($_SERVER['DOCUMENT_ROOT']."/CSCI-3308-Fall21-013-07/root/map/drawings");

                file_put_contents($_SERVER['DOCUMENT_ROOT']."/CSCI-3308-Fall21-013-07/root/map/drawings/".$id.'.png', $data);

                $sql = "UPDATE userinfo SET drawingCount = drawingCount + 1 WHERE username = ?;";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../create.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['userUid']);
                    mysqli_stmt_execute($stmt);
                }

                mysqli_close($conn);
            }
        }
    }
?>