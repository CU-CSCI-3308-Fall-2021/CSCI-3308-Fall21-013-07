<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            $data = array(
                array(1, 2, 3),
                "John", 
                "Jane");
            // print_r($data);

            echo $data[0][2];
        ?>
    </body>
</html>