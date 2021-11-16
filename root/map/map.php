<?php
    require "../header.php";
    require "../includes/dbh.inc.php";

    $mapFound = false;

    if(!isset($_GET['map'])) {
        header("Location: ../index.php");
        exit();
    }
    $fileName = $_GET['map'];
    $sql = "SELECT * FROM drawings WHERE fileName=?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo '<p>No map found!</p>';
        exit();

    } else {
        mysqli_stmt_bind_param($stmt, "s", $fileName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $fileNamePrint = $row['fileName'];
            $userName = $row['username'];
            $drawingName = $row['drawingName'];
            $dateModified = strtotime($row['dateModified']);
            $mapFound = true;
        }
    }
?>

<main>
    <div class="map-page-container">
        <?php 
            if ($mapFound) {
                echo '<h1 class="drawing-title">'.$drawingName.'</h1>';
                echo '<div class="map-container">';
                echo '<div class="img-container">';
                echo '<img class="map-img" src="drawings/'.$fileNamePrint.'.png" alt="Map drawing by user '.$row['username'].'">';
                echo '</div>';
            } else {
                echo '<h1 class="drawing-title">No map found!</h1>';
                echo '<p class="drawing-title">Try searching <a href="../search.php">here</a>!</p>';
            }
        ?>
        <div class="map-info">
            <?php
                if(isset($dateModified)) {
                    echo '<p>Created by: '.$userName.'</p>';
                    echo '<p>Last Modified: '.date('F j, Y', $dateModified).'</p>';
                    if (isset($_SESSION['userUid']) && $userName == $_SESSION['userUid']) {
                        echo '<form class="edit-profile" action="editdrawing.php?map='.$fileName.'" method="POST"><input type="submit" name="edit-drawing-submit" value="Edit Drawing"></form>';
                        echo '<form class="edit-profile" action="../includes/deletedrawing.inc.php?map='.$fileName.'" method="POST"><input class="warning" type="submit" name="delete-drawing-submit" value="Delete drawing"></form>';
                    }
                }
            ?>
        </div>
    </div>
</div>

</main>

<?php
    require "../footer.php";