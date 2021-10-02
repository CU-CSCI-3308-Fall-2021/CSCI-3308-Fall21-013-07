var comingDate = new Date("2019-10-18T08:00:00");

var d = document.getElementById('d');
var h = document.getElementById('h');
var m = document.getElementById('m');
var s = document.getElementById('s');

var x = setInterval(function(){
    var now = new Date();
    var des = comingDate.getTime() - now.getTime();
    var days = Math.floor(des/(1000 * 60 * 60 * 24));
    var hours = Math.floor(des%(1000 * 60 * 60 * 24) / (1000 * 60 * 60));
    var mins = Math.floor(des%(1000 * 60 * 60) / (1000 * 60));
    var secs = Math.floor(des%(1000 * 60) / (1000));

    d.innerHTML = days;
    h.innerHTML = hours;
    m.innerHTML = mins;
    s.innerHTML = secs;

    if (des <= 0) {
        clearInterval(x);
        d.innerHTML = 0;
        h.innerHTML = 0;
        m.innerHTML = 0;
        s.innerHTML = 0;
    }

},1000);

function getTrueNumer(x) {
    // This function returns a number of two symbols
    if (x < 10) return '0' + x;
    else return x;
 }