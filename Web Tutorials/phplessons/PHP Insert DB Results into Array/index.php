<?php
    include_once "dbh.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            $sql = "SELECT * FROM data;";
            $result = mysqli_query($conn, $sql);
            $datas = array();

            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row; // Creates multidimensional array
                }
            }

            // print_r($datas);

            foreach ($datas as $data) {
                echo $data['text'] . " "; // The 'text' allows us to choose the element
            }
        ?>
    </body>
</html>