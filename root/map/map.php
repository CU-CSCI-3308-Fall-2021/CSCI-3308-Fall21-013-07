<?php
    require "../header.php";
    require "../includes/dbh.inc.php";
?>

<main>

<div class="map-container">
    <div class="img-container">
        <?php
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
                    $dateModified = $row['dateModified'];

                    echo '<img class="map-img" src="drawings/'.$fileNamePrint.'.png" alt="Map drawing by user '.$row['username'].'">';
                } else {
                    echo '<p>No map found!</p>';
                }
            }
        ?>
    </div>
    <div class="map-info">

    </div>
</div>

</main>

<?php
    require "../footer.php";