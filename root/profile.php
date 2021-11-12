<?php
    require "header.php";
    require "includes/dbh.inc.php";
    $user = $_GET['user'];
?>

<main>
    <div class="profile-container" style="color: white;">
        <?php
            $sql = "SELECT * FROM userinfo WHERE username=?;";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo '<p>No user found!</p>';
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $user);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    $userName = $row['username'];
                    $dateJoined = $row['registrationDate'];
                    $email = $row['email'];
                    $drawingCount = $row['drawingCount'];

                    echo "User: ".$userName."<br>";
                    echo "Email: ".$email."<br>";
                    echo "Number of drawings: ".$drawingCount."<br>";
                    echo "Date Joined: ".$dateJoined."<br>";
                } else {
                    echo '<p>No user found!</p>';
                }
            }
        ?>
    </div>
</main>

<?php
    require "footer.php";