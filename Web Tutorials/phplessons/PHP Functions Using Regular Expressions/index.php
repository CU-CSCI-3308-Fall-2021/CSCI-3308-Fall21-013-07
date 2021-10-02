<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Functions Using Regular Expressions</title>
    </head>
    <body>
        <?php
            $string = "My name is Daniel, Daniel is my name";

            // "/Regular expression/"
            preg_match("/Daniel/", $string); // This checks to see if the string has a certain set of characters
            if (preg_match_all("/Da(ni)el/", $string, $array)) { // preg_match_all selects all elements with the regular expression
                echo $array[0][1]."<br>";
            }

            $newString = preg_replace("/Daniel/", "John", $string);

            echo $newString;
        ?>
    </body>
</html>