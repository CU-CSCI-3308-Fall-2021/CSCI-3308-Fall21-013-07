<?php
    require "header.php";
    require "includes/dbh.inc.php";
    
?>

<main>
    <div class="home-container">
        <?php
            if(!isset($_SESSION['userId'])) {
                // User not logged in
                echo "
                        <div class='home-info-container'>
                        <h1 class='home-welcome'>Welcome to Doodle Designer!</h1><br>
                            <h2>What is Doodle Designer?</h2>
                            <p class='home-info'>
                            Doodle Designer was created to provide a way to create simple, fun doodles and share them with others, or just save them for later.
                            With the increase in popularity of online drawing games, there's a particular uniqueness that comes with these drawings. Whether you
                            want to just practice drawing with a mouse, create simple and unique sketches, or even use it for more serious purposes, doodle designer
                            provides a way to do so.</p>
                            <h2>How did we make this?</h2>
                            <p class='home-info'>
                            Doodle Designer was created by a group of 4 CU Boulder students, during our CSCI3308 course. This project allowed us to get accustomed with
                            frontend and backend development, various different languages, and the whole workflow of a group in general. While the project still lacks a few features,
                            our vision for Doodle Designer is more social, and will involve sharing doodles with others at its core.
                            </p>
                        </div>";
            } else {
                // Logged in
                $username = $_SESSION['userUid'];
                echo '<h1 class="home-user-welcome">Welcome back, '.$username.'!</h1>';
                echo '<div class="projects-container">
                        <h2 class="project-info-title">My projects</h2>
                        <hr>';

                $sql = "SELECT * FROM drawings WHERE username='$username';";
                $result = mysqli_query($conn, $sql);
                $queryResult = mysqli_num_rows($result);
                
                if ($queryResult > 0) {
                    $counter = 1;
                    $resultString = "";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $date = strtotime($row['dateModified']);
                        if ($counter == 1) {
                            $resultString = $resultString . "<div class='project-row'><a href='map/map?map=".$row['fileName']."' class='project-link'><div class='project-container'>
                                                    <p>".$row['username']."</p>
                                                    <p>".$row['drawingName']."</p>
                                                    <p>".date('F j, Y', $date)."</p>
                                                    </div></a>";
                            $counter++;
                        } else if ($counter == 4) {
                            $resultString = $resultString . "<a href='map/map?map=".$row['fileName']."' class='project-link'><div class='project-container'>
                                                    <p>".$row['username']."</p>
                                                    <p>".$row['drawingName']."</p>
                                                    <p>".date('F j, Y', $date)."</p>
                                                    </div></a></div>";
                            $counter = 1;
                        } else {
                            $resultString = $resultString . "<a href='map/map?map=".$row['fileName']."' class='project-link'><div class='project-container'>
                                                    <p>".$row['username']."</p>
                                                    <p>".$row['drawingName']."</p>
                                                    <p>".date('F j, Y', $date)."</p>
                                                    </div></a>";
                            $counter++;
                        }
                    }
                    $counter--;
                    if ($counter < 4 && $counter != 0) {
                        while ($counter < 4) {
                            $resultString = $resultString . "<a class='project-link'><div class='project-container' style='border: none;'></div></a>";
                            $counter++;
                        }
                        $resultString = $resultString . "</div>";
                    }
                    echo $resultString;
                } else {
                    // No results
                    echo "<p class='create-first-drawing'>You have no drawings... <a href='create.php'>Create your first today!</a></p>";
                }

                echo '</div>';
            }
        ?>
    </div>
</main>

<?php
    require "footer.php";