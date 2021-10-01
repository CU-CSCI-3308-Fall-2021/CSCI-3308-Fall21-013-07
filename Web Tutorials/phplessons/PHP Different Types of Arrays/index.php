<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
        <?php
            // Indexed Arrays
            $data = array("Daniel", "John", "Jane");
            echo $data[0]."<br>";

            // Associatve Arrays - Allows you to name the data
            $data = array("first" => "Daniel", "last" => "Nielsen", "age" => 25);
            echo $data['first'];

            // Multidimensional Array
            $data = array(array("Daniel", "Nielsen"), "John", "Jane");
        ?>

    </body>
</html>