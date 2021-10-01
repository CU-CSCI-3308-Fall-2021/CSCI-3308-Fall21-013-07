<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            // New logical operator
            $x = 10;
            $y = 20;
            // 'xor' is used so that only one statement can be true in order for it to pass through the if statement
            if ($x == $y xor 1 == 1) {
                echo "True!";
            }
        ?>
    </body>
</html>