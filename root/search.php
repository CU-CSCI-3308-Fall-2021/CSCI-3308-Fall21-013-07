<?php
    require "header.php";
?>

<main>
    <div class="signup-container">
        <form class="form-signup" action="search.php" method="POST">
            <h1>Search for a Drawing</h1>
            <input type="text" name="search" placeholder="Search by tag or name">
            <input type="submit" name="submit-search" value="Search">
        </form>
    </div>

    <div class="search-results">
        <?php
            require "includes/dbh.inc.php";
            if (isset($_POST['submit-search'])) {
                $search = mysqli_real_escape_string($conn, $_POST['search']); // Helps to prevent SQL injection via search bar
                $sql = "SELECT * FROM article WHERE a_title LIKE '%$search%' OR a_text LIKE '%$search%' OR a_author LIKE '%$search%' OR a_date LIKE '%$search%';";
                $result = mysqli_query($conn, $sql);
                $queryResult = mysqli_num_rows($result);

                echo "There are ".$queryResult." results!";

                if ($queryResult > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<a href='search.php?title=".$row['a_title']."&date=".$row['a_date']."'><div class='article-box'>
                                <h3>".$row['a_title']."</h3>
                                <p>".$row['a_text']."</p>
                                <p>".$row['a_date']."</p>
                                <p>".$row['a_author']."</p3>
                            </div></a>";
                    }
                } else {
                    echo "There are no results matching your search!";
                }
            }
        ?>
        <div class="result-row">
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
        </div>
        <div class="result-row">
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
        </div>
        <div class="result-row">
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
            <div class="result">
                <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p>
            </div>
            <div class="result" style="border: none;">
                <!-- <p>Username</p>
                <p>Drawing Name</p>
                <p>Last Modified</p> -->
            </div>
        </div>
    </div>
</main>

<?php
    require "footer.php";