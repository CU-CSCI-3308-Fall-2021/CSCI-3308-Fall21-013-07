<?php
    require "header.php";
    require "includes/dbh.inc.php";
    
?>

<main>
    <div class="home-container">
        <?php
            if(!isset($_SESSION['userId'])) {
                // User not logged in
                echo '<h1 class="home-welcome">Welcome to Dungeon Designer!</h1>
                        <div class="home-info-container">
                            <p class="home-info">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus euismod efficitur. Fusce id nulla at purus cursus posuere. Nulla et feugiat ante. Proin rhoncus, est imperdiet consequat vulputate, erat erat dictum urna, et posuere urna velit ultricies felis. Mauris venenatis sapien et dolor commodo, at pellentesque eros vestibulum. Fusce eu velit fermentum, faucibus leo vitae, feugiat lacus. In tincidunt a quam non convallis. Maecenas tristique, magna sed molestie semper, est sem porttitor diam, id ultrices ipsum enim blandit diam. Sed ut laoreet odio. Mauris in pulvinar enim. Morbi placerat mattis aliquam. Vestibulum euismod et felis nec malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus id mollis magna.
                                <br><br>
                                Mauris mollis tempus quam. Nullam sollicitudin libero a libero pulvinar, ac convallis enim semper. Ut tempus mi vitae lectus rutrum, quis vulputate magna malesuada. Integer pharetra, quam et vulputate mattis, dolor velit eleifend nunc, vitae commodo metus neque tristique leo. Mauris eget ipsum malesuada diam laoreet cursus. Integer placerat lacus sit amet interdum tristique. Nunc lectus lorem, sagittis sit amet massa quis, luctus congue purus. Phasellus in orci congue, iaculis odio quis, fermentum lectus. Aliquam eget convallis massa, at dignissim dui. Phasellus tempor vestibulum consectetur. Vestibulum dapibus purus risus, nec laoreet mauris vestibulum vehicula. Nulla vitae vehicula tortor. 
                            </p>
                        </div>';
            } else {
                // Logged in
                $username = $_SESSION['userUid'];
                echo '<h1 class="home-user-welcome">Welcome, '.$username.'!</h1>';
                echo '<div class="projects-container">
                        <h3 class="project-info-title">My projects</h3>
                        <hr>';

                $sql = "SELECT * FROM drawings WHERE username='thand';";
                $result = mysqli_query($conn, $sql);
                $queryResult = mysqli_num_rows($result);
                
                if ($queryResult > 0) {
                    $counter = 1;
                    $resultString = "";
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($counter == 1) {
                            $resultString = $resultString . "<div class='project-row'><a href='map/map?map=".$row['fileName']."' class='project-link'><div class='project-container'>
                                                    <p>".$row['username']."</p>
                                                    <p>".$row['drawingName']."</p>
                                                    <p>".$row['dateModified']."</p>
                                                    </div></a>";
                            $counter++;
                        } else if ($counter == 4) {
                            $resultString = $resultString . "<a href='map/map?map=".$row['fileName']."' class='project-link'><div class='project-container'>
                                                    <p>".$row['username']."</p>
                                                    <p>".$row['drawingName']."</p>
                                                    <p>".$row['dateModified']."</p>
                                                    </div></a></div>";
                            $counter = 1;
                        } else {
                            $resultString = $resultString . "<a href='map/map?map=".$row['fileName']."' class='project-link'><div class='project-container'>
                                                    <p>".$row['username']."</p>
                                                    <p>".$row['drawingName']."</p>
                                                    <p>".$row['dateModified']."</p>
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