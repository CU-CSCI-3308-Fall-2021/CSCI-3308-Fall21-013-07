<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

        <form method="GET">
            <input type="text" name="person">
            <button type="submit">SUBMIT</button>
        </form>

        <?php
            $name = $_GET['person'];
            echo $name." is a handsome fellow!";
        ?>
    </body>
</html>