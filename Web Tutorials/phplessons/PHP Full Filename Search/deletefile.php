<?php
    $path = "uploads/cat*";
    $fileInfo = glob($path);

    $fileactualname = $fileInfo[0];

    if (!unlink($fileactualname)) {
        echo "You have an error!";
    } else {
        header("Location: index.php?deletesuccess");
    }