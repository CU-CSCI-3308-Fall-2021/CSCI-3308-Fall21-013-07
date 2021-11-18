<?php

    $servername = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "drawing";

    $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

    date_default_timezone_set('America/Denver'); // Set default time zone

    // If cannot connect
    if (!$conn) {
        die("Connection Failed!: ".mysqli_connect_error());
    }