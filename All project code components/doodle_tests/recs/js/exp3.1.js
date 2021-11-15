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
    switch (obj.id) {
        case "green":
            x = "green";
            break;
        case "blue":
            x = "blue";
            break;
        case "red":
            x = "red";
            break;
        case "yellow":
            x = "yellow";
            break;
        case "orange":
            x = "orange";
            break;
        case "black":
            x = "black";
            break;
        case "white":
            x = "white";
            break;
    }
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
    var m = confirm("Want to clear");
    if (m) {
        ctx.clearRect(0, 0, w, h);
        document.getElementById("canvasimg").style.display = "none";
    }
}

// copy canvas //
function save() {
    // just kinda copies the current status of canvas and sets that as the canvas in the copy also
    document.getElementById("canvasimg").style.border = "#111 2px solid";
    var dataURL = canvas.toDataURL();
    document.getElementById("canvasimg").src = dataURL;
    document.getElementById("canvasimg").style.display = "inline";
    document.getElementById("undercanimg").style.display = "block";
}

function exportMap(){
    const a = document.createElement("a");
    document.body.appendChild(a);
    a.href = canvas.toDataURL();
    a.download = "canvas-image.png";
    a.click();
    document.body.removeChild(a);
}

// find our coordinates of the mouse on screen //
function findxy(res, e) {
    if (res == 'down') {
        prevX = currX;
        prevY = currY;
        currX = e.clientX - canvas.offsetLeft;
        currY = e.clientY - canvas.offsetTop;

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
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;
            draw();
        }
    }
}

const inpFile = document.getElementById("inpFile");
const previewContainter = document.getElementById("imagePreview");
const previewImage = previewContainter.querySelector(".image-preview-image");
const previewDefaulttext = previewContainter.querySelector(".image-preview-default-text")

inpFile.addEventListener("change", function() {
    const file = this.files[0];

    console.log(file);

    if (file) {
        const reader = new FileReader();

        previewDefaulttext.style.display = "none";
        previewImage.style.display = "block";

        reader.addEventListener("load", function () {
            console.log(this);
            previewImage.setAttribute("src", this.result);
        });

        reader.readAsDataURL(file);
    }
});