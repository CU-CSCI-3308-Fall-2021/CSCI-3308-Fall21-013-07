<?php
  $_SESSION['username'] = "Admin";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:300i,400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <a href="index.html" class="header-brand">MysticalSpoon</a>
      <nav>
        <ul>
          <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="about.html">About Me</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <a href="cases.html" class="header-cases">Cases</a>
      </nav>
    </header>
    <main>

      <section class="gallery-links">
        <div class="wrapper">
          <h2>Gallery</h2>

          <div class="gallery-container">
            <?php

            include_once "includes/dbh.inc.php";

            $sql = "SELECT * FROM gallery ORDER BY orderGalleryColumn DESC;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed!";
            } else {
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);

              while ($row = mysqli_fetch_assoc($result)) {
                echo '<a href="#">
                    <div style="background-image: url(img/gallery/'.$row['imgFullNameGallery'].');"></div>
                    <h3>'.$row['titleGallery'].'</h3>
                    <p>'.$row['descGallery'].'</p>
                  </a>';
              }
            }
            ?>
          </div>
          <?php
            if (isset($_SESSION['username'])) {
              echo '<div class="gallery-upload">
                  <form action="includes/gallery-upload.inc.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="filename" placeholder="File name...">
                    <input type="text" name="filetitle" placeholder="Image title...">
                    <input type="text" name="filedesc" placeholder="Image description...">
                    <input type="file" name="file">
                    <button type="submit" name="submit">Upload</button>
                  </form>
                </div>';
            }
            
          ?>

        </div>
      </section>

    </main>
    <div class="wrapper">
      <footer>
        <ul class="footer-links-main">
          <li><a href="#">Home</a></li>
          <li><a href="#">Cases</a></li>
          <li><a href="#">Portfolio</a></li>
          <li><a href="#">About Me</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <ul class="footer-links-cases">
          <li><p>Latest Cases</p></li>
          <li><a href="#">German</a></li>
          <li><a href="#">Japanese</a></li>
          <li><a href="#">Danish</a></li>
          <li><a href="#">Dutch</a></li>
          <li><a href="#">French</a></li>
        </ul>
        <div class="footer-sm">
          <a href="https://www.duolingo.com" target="_blank">
            <img src="img/duolingo.png" alt="duolingo logo">
          </a>
          <a href="https://www.youtube.com" target="_blank">
            <img src="img/youtube.png" alt="youtube icon">
          </a>
          <a href="https://www.twitter.com" target="_blank">
            <img src="img/twitter.png" alt="twitter logo">
          </a>
        </div>
      </footer>
    </div>
  </body>
</html>
