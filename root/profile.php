<?php
    require "header.php";
    require "includes/dbh.inc.php";
    $user = $_GET['user'];
?>

<main>
    <div class="profile-container">
        <div class="user-container" style="color: white;">
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
        <?php
        if (isset($_SESSION['userUid']) && $_SESSION['userUid'] == $user) {
            echo '<div class="edit-profile-container">';

            echo '<h1 id="edit-user-h1">Edit User Profile</h1>';

            echo '<form class="edit-profile" action="changeuser.php" method="POST"><input type="submit" name="change-username-btn" value="Change username"></form>';
            echo '<form class="edit-profile" action="changepass.php" method="POST"><input type="submit" name="change-password-btn" value="Change password"></form>';
            echo '<form class="edit-profile" action="includes/deletedrawings.inc.php" method="POST"><input class="warning" type="submit" name="delete-drawings-submit" value="Delete all drawings"></form>';
            echo '<form class="edit-profile" action="includes/deleteprofile.inc.php" method="POST"><input class="warning" type="submit" name="delete-profile-submit" value="Delete profile"></form>';

            echo '</div>';
        }
        ?>
    </div>
    
</main>

<?php
    require "footer.php";