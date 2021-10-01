<?php
    $path = "uploads/Cat.jpg";
    if (!unlink($path)) {
        header("Location: index.php?deletion=FAILURE");
    } else {
        header("Location: index.php?deletion=SUCCESS");
    }