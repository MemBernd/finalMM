window.onload = getout;

function getout() {
    var i = sessionStorage.length;
    while (i--) {
        var key = sessionStorage.key(i);
        sessionStorage.removeItem(key);
    }
    window.location = "main.html";
}