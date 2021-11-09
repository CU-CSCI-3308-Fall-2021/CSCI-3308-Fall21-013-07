<?php
    require "header.php";
    require "includes/dbh.inc.php";
?>

<main>
    <div class="signup-container">
        <form class="form-signup" method="POST">
            <h1>Search for a Drawing</h1>
            <input type="text" name="search" placeholder="Search for a drawing...">
            <input type="submit" name="submit-search" value="Search">
        </form>
    </div>

    <div class="search-results">
        <?php
            if (isset($_POST['submit-search'])) {
                // Submit button clicked
                $search = mysqli_real_escape_string($conn, $_POST['search']); // Helps to prevent SQL injection via search bar
                if (strlen($search) > 0) {
                    $sql = "SELECT * FROM drawings WHERE username LIKE '%$search%' OR drawingName LIKE '%$search%' OR dateModified LIKE '%$search%';";
                    $result = mysqli_query($conn, $sql);
                    $queryResult = mysqli_num_rows($result);

                    if ($queryResult > 0) {
                        // There are 1 or more search results
                        echo "<p class='search-query-result'>There are ".$queryResult." results!</p>";
                        $counter = 1;
                        $resultString = "";
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($counter == 1) {
                                $resultString = $resultString . "<div class='result-row'><a href='index.php' class='search-result-link'><div class='result'>
                                                    <p>".$row['username']."</p>
                                                    <p>".$row['drawingName']."</p>
                                                    <p>".$row['dateModified']."</p>
                                                    </div></a>";
                                $counter++;
                            } else if ($counter == 4) {
                                $resultString = $resultString . "<a href='index.php' class='search-result-link'><div class='result'>
                                                                    <p>".$row['username']."</p>
                                                                    <p>".$row['drawingName']."</p>
                                                                    <p>".$row['dateModified']."</p>
                                                                    </div></a></div>";
                                $counter = 1;
                            } else {
                                $resultString = $resultString . "<a href='index.php' class='search-result-link'><div class='result'>
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
                                $resultString = $resultString . "<div class='result' style='border: none;'></div>";
                                $counter++;
                            }
                            $resultString = $resultString . "</div>";
                        }
                        echo $resultString;
                    } else {
                        // No results
                        echo "<p class='search-query-result-fail'>There are no results matching your search!</p>";
                    }
                } else {
                    // User inputed empty field
                    $sql = "SELECT * FROM drawings;";
                    $result = mysqli_query($conn, $sql);
                    $queryResult = mysqli_num_rows($result);

                    if ($queryResult > 0) {
                        echo "<p class='search-query-result'>There are ".$queryResult." drawings!</p>";
                        $counter = 1;
                        $resultString = "";
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($counter == 1) {
                                $resultString = $resultString . "<div class='result-row'><a href='index.php' class='search-result-link'><div class='result'>
                                                    <p>".$row['username']."</p>
                                                    <p>".$row['drawingName']."</p>
                                                    <p>".$row['dateModified']."</p>
                                                    </div></a>";
                                $counter++;
                            } else if ($counter == 4) {
                                $resultString = $resultString . "<a href='index.php' class='search-result-link'><div class='result'>
                                                                    <p>".$row['username']."</p>
                                                                    <p>".$row['drawingName']."</p>
                                                                    <p>".$row['dateModified']."</p>
                                                                    </div></a></div>";
                                $counter = 1;
                            } else {
                                $resultString = $resultString . "<a href='index.php' class='search-result-link'><div class='result'>
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
                                $resultString = $resultString . "<div class='result' style='border: none;'></div>";
                                $counter++;
                            }
                            $resultString = $resultString . "</div>";
                        }
                        echo $resultString;
                    } else {
                        echo "<p class='search-query-result-fail'>There are no drawings to show!</p>";
                    }
                }
                
            } else {
                // Submit button not clicked
                $sql = "SELECT * FROM drawings;";
                $result = mysqli_query($conn, $sql);
                $queryResult = mysqli_num_rows($result);

                if ($queryResult > 0) {
                    $counter = 1;
                    $resultString = "";
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($counter == 1) {
                            $resultString = $resultString . "<div class='result-row'><a href='index.php' class='search-result-link'><div class='result'>
                                                <p>".$row['username']."</p>
                                                <p>".$row['drawingName']."</p>
                                                <p>".$row['dateModified']."</p>
                                                </div></a>";
                            $counter++;
                        } else if ($counter == 4) {
                            $resultString = $resultString . "<a href='index.php' class='search-result-link'><div class='result'>
                                                                <p>".$row['username']."</p>
                                                                <p>".$row['drawingName']."</p>
                                                                <p>".$row['dateModified']."</p>
                                                                </div></a></div>";
                            $counter = 1;
                        } else {
                            $resultString = $resultString . "<a href='index.php' class='search-result-link'><div class='result'>
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
                            $resultString = $resultString . "<div class='result' style='border: none;'></div>";
                            $counter++;
                        }
                        $resultString = $resultString . "</div>";
                    }
                    echo $resultString;
                } else {
                    echo "<p class='search-query-result-fail'>There are no drawings to show!</p>";
                }
            }
        ?>
    </div>
</main>

<?php
    require "footer.php";