<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            # Old URL is http://localhost/phplessons/PHP%20URL%20Rewrite/article.php?id=1&name=Hello
            # New URL would look like http://localhost/phplessons/PHP%20URL%20Rewrite/article/4/My-Name-Is-Daniel
            $articleId = $_GET['id'];
            $articleName = $_GET['name'];

            echo "Article id is " . $articleId . "<br>";
            echo "Article name is " . $articleName;
        ?>
    </body>
</html>