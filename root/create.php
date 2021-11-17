<?php
    require "header.php";
?>

<main>
    <?php
        if (isset($_SESSION['userId'])) {
            echo '<form class="drawing-name-form" method="POST">
                    <h1>Choose a name for your drawing</h1>
                    <input type="text" id="drawingTitle" name="drawingName" placeholder="Enter a name...">
                </form>
            
                <div class="main-create-container">
                    <h2>Create Drawing</h2>
                    <hr class="create-hr">
                    <div class="create-container">
                        <div class="canvas-wrap">
                            <canvas id="undercan" width="500" height="400"></canvas>
                            <canvas id="can" width="500" height="400"></canvas>
                        </div>
                        <div class="create-btn-container">
                            <div class="btn-container">
                                <p>Choose Color</p>
                                <div class="color-row">
                                    <div class="color-btn" style="background:green;" id="green" onclick="color(this)"></div>
                                    <div class="color-btn" style="background:blue;" id="blue" onclick="color(this)"></div>
                                    <div class="color-btn" style="background:red;" id="red" onclick="color(this)"></div>
                                </div>
                                <div class="color-row">
                                    <div class="color-btn" style="background:yellow;" id="yellow" onclick="color(this)"></div>
                                    <div class="color-btn" style="background:orange;" id="orange" onclick="color(this)"></div>
                                    <div class="color-btn" style="background:black;" id="black" onclick="color(this)"></div>
                                </div>
                                <hr class="create-hr btn-hr">
                                <p>Eraser</p>
                                <div class="color-btn eraser" style="background:white;" id="white" onclick="color(this)"></div>
                                <hr class="create-hr btn-hr">
                                <div class="other-btn-container">
                                    <input class="create-btn first-btn" type="button" value="Save" id="btn" size="30" onclick="save()">
                                    <input class="create-btn" type="button" value="Exp" id="exp" size="30" onclick="exportMap()">
                                    <input class="create-btn" type="button" value="Clear" id="clr" size="23" onclick="erase()">
                                </div>
                            </div>
                        </div>
                        <canvas id="undercanimg" width="500" height="400" style="display: none;"></canvas>
                        <img id="canvasimg" style="display:none;">
                    </div>
                </div>';
        } else {
            header("Location: login.php");
            exit();
        }
    ?>
    
</main>

<?php
    require "footer.php";