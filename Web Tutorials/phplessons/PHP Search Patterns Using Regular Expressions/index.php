<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            $string = "My name is Daniel, Daniel is my name";

            // echo preg_match("/./", $string); Checks for if there is a character
            echo preg_match("/(a|o)/", $string)."<br>"; // Check if either a or o

            echo preg_match("/[abc]/", $string)."<br>"; // Check if it as a, b, or c
            echo preg_match("/[^abc]/", $string)."<br>"; // If we only have these characters it will return as false, otherwise as true

            echo preg_match("/[a-zA-Z]/", $string)."<br>"; // Range from A to z
            echo preg_match("/[0-9]/", $string)."<br>";

            // Quantifiers
            echo preg_match("/D*/", $string)."<br>"; // Checks if there is at least 0 D's
            preg_match_all("/D.*m/", $string, $array); // Starts as first D and ends at letter m
            print_r($array);

            echo "<br>";

            preg_match_all("/D+/", $string, $array); // + Checks for at least one D, and does not have empty indices like with *
            print_r($array);

            echo "<br>";

            // Lazy quantifier

            $string = "My 1name2 is Daniel, 1Daniel2 is my name";
            preg_match_all("/1.*?2/", $string, $array); // ? makes it 'lazy' where it will stop then it will continue checking the rest of the string
            print_r($array);

            echo "<br>";

            $string = "My name is Daniel, Daniel is my name";
            echo preg_match("/D{1,2}/", $string); // The {#} checks how many in a row of a letter there are // {1,2} will check for 1 OR 2 D's in a row (DON'T LEAVE A SPACE)

            echo "<br>";

            preg_match_all("/\S{2,3}/", $string, $array);
            print_r($array);
            // \s is for whitespace character, \S is for non-whitespace character
            // \d is for digits, \D is for non-digits(letters)
            // \w is for words, \W is for non-words

            echo "<br>";

            echo preg_match("/^M/", $string); // Checks if it starts with 'M'

            echo "<br>";

            echo preg_match("/e$/", $string); // Checks if it ends with 'e'

            echo "<br>";

            echo preg_match("/^M.*e$/", $string); // . is for character after 'M', * is for all after

            echo "<br>";

            $string = "^My name is Daniel, Daniel is my name";
            echo preg_match("/\^.*e$/", $string);
        ?>
    </body>
</html>