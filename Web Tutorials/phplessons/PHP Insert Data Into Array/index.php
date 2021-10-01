<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            // Method 1
            $data = array();
            $data[] = "Daniel";
            $data[] = 15; 
            print_r($data);

            // Method 2
            $data = array();
            array_push($data, "Daniel");
            array_push($data, "15");
            print_r($data);

            // Method 3
            $data = array("First", "Second");
            array_push($data, "Daniel", 15, 23);
            print_r($data);
        ?>
    </body>
</html>