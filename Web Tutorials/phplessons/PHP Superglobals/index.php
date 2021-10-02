<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            /*
            $GLOBALS
            $_POST
            $_GET
            $_COOKIE - saves info on the user side
            $_SESSION - saves info on the server side
            */
            $x = 5;

            function something() {
                $y = 10;
                echo $GLOBALS['x'];
            }
            echo $_GET['name'];

            // How to make a cookie:
            //Parameters: name of cookie, value to name, when will it expire 
            setcookie("name", "Daniel", time() + 86400); //Set to time() - 1; to destroy cookies

            // How to create a session:

            $_SESSION['name'] = "12";
        ?>

        <form method="GET">
            <input type="hidden" name="name" value="Daniel">
            <button type=submit>PRESS ME!</button>
        </form>
    </body>
</html>