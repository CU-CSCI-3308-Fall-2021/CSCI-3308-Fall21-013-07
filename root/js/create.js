// setup canvas, context, and some helper variables for sketching
var canvas, ctx, flag = false,
// x cooridnates
prevX = 0,
currX = 0,
// y cooridnates
prevY = 0,
currY = 0,
dot_flag = false;

// init pen color
var x = "black",
y = 2;

///////////////////
// FUNCTION ZONE //
///////////////////

// source help
// canvas api: https://developer.mozilla.org/en-US/docs/Web/API/Element/mousemove_event
// w3schools super helpful here for canvas methods: https://www.w3schools.com/tags/ref_canvas.asp


// initialze canvas //
function init() {
    canvas = document.getElementById('can');
    ctx = canvas.getContext("2d");

    // width and heights of canvas
    w = canvas.width;  
    h = canvas.height;

    // set all evetns to false for start
    // all these events are documented in the mozilla canvas api link above
    canvas.addEventListener("mousemove", function (e) {
        findxy('move', e)
    }, false);
    canvas.addEventListener("mousedown", function (e) {
        findxy('down', e)
    }, false);
    canvas.addEventListener("mouseup", function (e) {
        findxy('up', e)
    }, false);
    canvas.addEventListener("mouseout", function (e) {
        findxy('out', e)
    }, false);
}

// change current color //
function color(obj) {
    // function passes obj.id which is association with the <div> for each color seltion form the pallet
    // x is our pen color
    x = obj.id;
    // note y is our line width we make it wider while erasing to make it easier!
    if (x == "white") y = 14;
    else y = 2;

}

// drawing stuff //
function draw() {
    // begin
    ctx.beginPath();
    // line info
    ctx.moveTo(prevX, prevY);
    ctx.lineTo(currX, currY);
    // style
    ctx.strokeStyle = x;
    ctx.lineWidth = y;
    // stroke
    ctx.stroke();
    // fin
    ctx.closePath();
}

// clear whole canvas //
function erase() {
    var m = confirm("Are you sure you want to clear?");
    if (m) {
        ctx.clearRect(0, 0, w, h);
        document.getElementById("canvasimg").style.display = "none";
    }
}

// copy canvas //
function save() {
    // just kinda copies the current status of canvas and sets that as the canvas in the copy also
    // document.getElementById("canvasimg").style.border = "#111 2px solid";
    var dataURL = canvas.toDataURL();
    document.getElementById("canvasimg").src = dataURL;
    document.getElementById("canvasimg").style.display = "none";
    // document.getElementById("undercanimg").style.display = "block";

    var photo = canvas.toDataURL("image/png");
    var id = document.getElementById("randNum").value;
    var drawingName = document.getElementById("drawingTitle").value;
    $.ajax({
        method: 'POST',
        url: "includes/upload.inc.php",
        data: {
            photo: photo,
            id: id,
            drawingName: drawingName
        },
        success: function(response) {
            console.log(response);
            document.location = 'map/editdrawing.php?map=' + id;
            return false;
        }
    });
}

function save2() {
    // just kinda copies the current status of canvas and sets that as the canvas in the copy also
    // document.getElementById("canvasimg").style.border = "#111 2px solid";
    var dataURL = canvas.toDataURL();
    document.getElementById("canvasimg").src = dataURL;
    document.getElementById("canvasimg").style.display = "none";
    // document.getElementById("undercanimg").style.display = "block";

    var photo = canvas.toDataURL("image/png");
    var fileName = document.getElementById("fileName").value;
    var oldName = document.getElementById("oldTitle").value;
    var newId = document.getElementById("newId").value;
    var newName = document.getElementById("drawingTitle").value == "" ? oldName : document.getElementById("drawingTitle").value;
    $.ajax({
        method: 'POST',
        url: "../includes/update.inc.php",
        data: {
            photo: photo,
            fileName : fileName,
            oldName : oldName,
            newName : newName,
            newId: newId
        },
        success: function(response) {
            console.log(response);
            document.location = '../map/editdrawing.php?map=' + newId;
            return false;
        }
    });
}

function exportMap(){
    const a = document.createElement("a");
    document.body.appendChild(a);
    a.href = canvas.toDataURL();
    a.download = document.getElementById("drawingTitle").value != "" ? document.getElementById("drawingTitle").value : "canvas-img";
    a.click();
    document.body.removeChild(a);
}

function exportMap2(){
    const a = document.createElement("a");
    document.body.appendChild(a);
    a.href = canvas.toDataURL();
    a.download = document.getElementById("drawingTitle").value != "" ? document.getElementById("drawingTitle").value : document.getElementById("oldTitle").value;
    a.click();
    document.body.removeChild(a);
}

////////////////////////////////////////////////////////////
function loadImage() {
    var input, file, fr, img;

    if (typeof window.FileReader !== 'function') {
        write("The file API isn't supported on this browser yet.");
        return;
    }

    input = document.getElementById('imgfile');
    if (!input) {
        write("Um, couldn't find the imgfile element.");
    }
    else if (!input.files) {
        write("This browser doesn't seem to support the `files` property of file inputs.");
    }
    else if (!input.files[0]) {
        write("Please select a file before clicking 'Load'");
    }
    else {
        file = input.files[0];
        fr = new FileReader();
        fr.onload = createImage;
        fr.readAsDataURL(file);
    }

    function createImage() {
        img = document.createElement('img');
        img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
        document.body.appendChild(img);
    }

    function imageLoaded() {
        write(img.width + "x" + img.height);
        // This next bit removes the image, which is obviously optional -- perhaps you want
        // to do something with it!
        img.parentNode.removeChild(img);
        img = undefined;
    }

    function write(msg) {
        var p = document.createElement('p');
        p.innerHTML = msg;
        document.body.appendChild(p);
    }
}

function writeImage() {

    var callback = function(image) {
        if(!image) image = this;
        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(image, 0, 0);
    }
        
    if(img.complete) { //check if image was already loaded by the browser
        callback(img);
    }else {
        img.onload = callback;
    }

}

////////////////////////////////////////////////////////////

// find our coordinates of the mouse on screen //
function findxy(res, e) {
    if (res == 'down') {
        prevX = currX;
        prevY = currY;
        currX = e.clientX - 275;
        currY = e.clientY - 175;

        flag = true;
        dot_flag = true;
        if (dot_flag) {
            ctx.beginPath();
            ctx.fillStyle = x;
            ctx.fillRect(currX, currY, 2, 2);
            ctx.closePath();
            dot_flag = false;
        }
    }
    if (res == 'up' || res == "out") {
        flag = false;
    }
    if (res == 'move') {
        if (flag) {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - 275;
            currY = e.clientY - 175;
            draw();
        }
    }
}