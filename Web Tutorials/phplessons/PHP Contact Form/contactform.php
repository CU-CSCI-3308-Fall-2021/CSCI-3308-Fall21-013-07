<?php

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $mailFrom = $_POST['mail'];
        $message = $_POST['message'];

        $mailTo = "tylerhand135@gmail.com"; // Sending to gmail won't work without another part
        $headers = "From: ".$mailFrom;
        $txt = "You have received an email from ".$name.".\n\n".$message;

        mail($mailTo, $subject, $txt, $headers);

        header("Location: index.php?mail=sent");
    }