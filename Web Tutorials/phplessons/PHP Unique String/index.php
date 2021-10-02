<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            // function generateKey() {
            //     $keyLength = 8;
            //     $string = "1234567890abcdefghijklmnopqrstuvwxyz()/$";
            //     $randStr = substr(str_shuffle($string), 0, $keyLength);
            //     return $randStr;
            // }

            // echo generateKey(); 1st Option

            // function generateKey() {
            //     $randStr = uniqid('daniel', true);
            //     return $randStr;
            // } 2nd Option - Not very secure(use for unique urls and files)

            // 3rd Option Below - More secure

            $conn = mysqli_connect("localhost", "root", "", "uniquestringlesson");

            function checkKeys($conn, $randStr) {
                $sql = "SELECT * FROM keystring;";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['keystringKey'] == $randStr) {
                        $keyExists = true;
                        break;
                    } else {
                        $keyExists = false;
                    }
                }

                return $keyExists;
            }

            function generateKey($conn) {
                $keyLength = 6;
                $string = "00112233445566778899";
                $randStr = substr(str_shuffle($string), 0, $keyLength);

                $checkKey = checkKeys($conn, $randStr);

                while ($checkKey == true) {
                    $randStr = substr(str_shuffle($string), 0, $keyLength);
                    $checkKey = checkKeys($conn, $randStr);
                }

                return $randStr;
            }

            echo generateKey($conn);
        ?>
    </body>
</html>