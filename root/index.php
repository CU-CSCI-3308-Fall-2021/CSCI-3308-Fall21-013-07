<?php
    require "header.php";
?>

<main>
    <?php
        if(isset($_SESSION['userId'])) {
            $userName = $_SESSION['userUid'];
            echo "<p class='test-login'>Welcome $userName!</p>";
        } else {
            echo "<p class='test-login'>You are logged out!</p>"; 
        }
    ?>
</main>

<?php
    require "footer.php";