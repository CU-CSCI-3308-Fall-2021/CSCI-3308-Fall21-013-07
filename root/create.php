<?php
    require "header.php";
?>

<main>
    
    <form class="drawing-name-form" method="POST">
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
    </div>
    
    <?php
        if (false && isset($_SESSION['userId'])) {
            echo '<!-- eraser -->
            <div style="position:absolute;top:80%;left:35%;">Eraser</div>
            <div style="position:absolute;top:83%;left:36%;width:15px;height:15px;background:white;border:2px solid;" id="white" onclick="color(this)"></div>
            
            <!-- sketched image -->
            <canvas id="undercanimg" width="500" height="400" style="position:absolute;top:10%;left:52%;border:2px solid;background: white;display: none;"></canvas>
            <img id="canvasimg" style="position:absolute;top:10%;left:52%;" style="display:none;">
            
            <!-- load -->
            <form action="#" onsubmit="return false;">
            <input type="file" id="imgfile">
            <input type="button" id="btnLoad" value="Load" onclick="loadImage()" style="position:absolute;top:80%;left:25%;">
        
            
            <!-- save -->
            <input type="button" value="save" id="btn" size="30" onclick="save()" style="position:absolute;top:80%;left:10%;">
            <!-- export -->
            <input type="button" value="exp" id="exp" size="30" onclick="exportMap()" style="position:absolute;top:80%;left:15%;">
            <!-- clear -->
            <input type="button" value="clear" id="clr" size="23" onclick="erase()" style="position:absolute;top:80%;left:20%;">
        
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <!-- to database -->
            <form method="post" enctype="multipart/form-data" action="includes/upload.inc.php">
                <label>Title</label>
                <input type="text" name="title" id="drawingTitle">
                <label>File Upload</label>
                <input type="File" name="file">
                <input type="submit" name="submit">
            </form>';
        } else if (!isset($_SESSION['userId'])) {
            header("Location: login.php");
            exit();
        }
    ?>
    
</main>

<?php
    require "footer.php";