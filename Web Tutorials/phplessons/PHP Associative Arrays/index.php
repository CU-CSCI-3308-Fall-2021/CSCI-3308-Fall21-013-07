<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            $data = array("first" => "Daniel", 
                            "last" => "Nielsen", 
                            "age" => 25);
            echo $data["age"];

            // Can also do this
            $data["first"] = "Daniel";
            $data["last"] = "Nielsen";
            $data["age"] = 25;
            print_r($data);
        ?>
    </body>
</html>