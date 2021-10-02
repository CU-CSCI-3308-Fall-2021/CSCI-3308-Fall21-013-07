<?php
    $fileNames = $_POST['filename'];
    $removeSpaces = str_replace(" ", "", $fileNames);
    $allFileNames = explode(",", $removeSpaces);

    $countAllNames = count($allFileNames);

    for ($i = 0; $i < $countAllNames; $i++) {
        if (file_exists("uploads/".$allFileNames[$i]) == false) {
            header("Location: index.php?delete=error");
            exit();
        }
    }

    for ($i = 0; $i < $countAllNames; $i++) {
        $path = "uploads/".$allFileNames[$i];
        if (!unlink($path)) {
            header("Location: index.php?delete=error");
            exit();
        } 
    }

    header("Location: index.php?deletion=SUCCESS");