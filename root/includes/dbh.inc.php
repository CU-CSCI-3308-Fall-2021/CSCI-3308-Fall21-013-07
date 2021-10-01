<?php

    $servername = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "drawing";

    $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

    // If cannot connect
    if (!$conn) {
        die("Connection Failed!: ".mysqli_connect_error());
    }