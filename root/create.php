<?php
    require "header.php";
?>

<main>
    <!-- canvas -->
    <canvas id="undercan" width="500" height="400" style="position:absolute;top:10%;left:10%;border:2px solid;background: white;"></canvas>
    <canvas id="can" width="500" height="400" style="position:absolute;top:10%;left:10%;border:2px solid;"></canvas>
    
    <!-- color selction -->
    <div style="position:absolute;top:80%;left:43%;">Choose Color</div>
    <div style="position:absolute;top:83%;left:45%;width:10px;height:10px;background:green;" id="green" onclick="color(this)"></div>
    <div style="position:absolute;top:83%;left:46%;width:10px;height:10px;background:blue;" id="blue" onclick="color(this)"></div>
    <div style="position:absolute;top:83%;left:47%;width:10px;height:10px;background:red;" id="red" onclick="color(this)"></div>
    <div style="position:absolute;top:85%;left:45%;width:10px;height:10px;background:yellow;" id="yellow" onclick="color(this)"></div>
    <div style="position:absolute;top:85%;left:46%;width:10px;height:10px;background:orange;" id="orange" onclick="color(this)"></div>
    <div style="position:absolute;top:85%;left:47%;width:10px;height:10px;background:black;" id="black" onclick="color(this)"></div>
    
    <!-- eraser -->
    <div style="position:absolute;top:80%;left:35%;">Eraser</div>
    <div style="position:absolute;top:83%;left:36%;width:15px;height:15px;background:white;border:2px solid;" id="white" onclick="color(this)"></div>
    
    <!-- sketched image -->
    <canvas id="undercanimg" width="500" height="400" style="position:absolute;top:10%;left:52%;border:2px solid;background: white;display: none;"></canvas>
    <img id="canvasimg" style="position:absolute;top:10%;left:52%;" style="display:none;">
    
    <!-- load -->
    <form action='#' onsubmit="return false;">
    <input type='file' id='imgfile'>
    <input type='button' id='btnLoad' value='Load' onclick='loadImage()' style="position:absolute;top:80%;left:25%;">

    
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
    </form>
</main>

<?php
    require "footer.php";