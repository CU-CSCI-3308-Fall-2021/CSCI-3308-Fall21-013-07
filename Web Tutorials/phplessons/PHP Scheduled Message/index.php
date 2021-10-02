<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Scheduled Message</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $dayOfWeek = date("w");
            switch($dayOfWeek) {
                case 0:
                    echo "<p>It is Sunday</p>";
                    break;
                case 1:
                    echo "<p>It is Monday</p>";
                    break;
                case 2:
                    echo "<p>It is Tuesday</p>";
                    break;
                case 3:
                    echo "<p>It is Wednesday</p>";
                    break;
                case 4:
                    echo "<p>It is Thursday</p>";
                    break;
                case 5:
                    echo "<p>It is Friday</p>";
                    break;
                case 6:
                    echo "<p>It is Saturday</p>";
                    break;
                default:
                    echo "<p>WHO ARE YOU PEOPLE?!?</p>";
            }
        ?>
    </body>
</html>