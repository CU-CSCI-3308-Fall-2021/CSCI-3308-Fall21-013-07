<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bröther, may I have the lööps</title>
    </head>
    <body>
        <?php
            // Lööps

            // While Lööp
            $x = 1;
            while ($x <= 5) {
                echo "Bröther, may I have the lööps?<br>";
                $x++;
            }
            // Do While Lööp
            echo "<br>";
            $x = 1;
            do {
                echo "Bröther, may I have the lööps?<br>";
                $x++;
            }while($x <= 5);
            // For Lööp
            echo "<br>";
            for($i = 1; $i <= 5; $i++) {
                echo "Bröther, may I have the lööps?<br>";
            }
            // Foreach Lööp
            echo "<br>";
            $array = array("Bröther, may I have the lööps?<br>", "Bröther, may I have the lööps?<br>", "Bröther, may I have the lööps?<br>", "Bröther, may I have the lööps?<br>", "Bröther, may I have the lööps?<br>");
            foreach($array as $loopData) {
                echo $loopData;
            }
        ?>
    </body>
</html>