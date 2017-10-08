var name, type, start, end, att, dec, par, ph, br, dr, budget;
var myExecution;

function pressenter() {
    document.getElementById("budget").onkeydown = function(event) {
        if (event.keyCode == 13) {
            validate();
        }
    }
}

function validate() {
    name = document.getElementById("clientName").value;
    type = document.getElementById("eventType").value;
    start = document.getElementById("from").value;
    end = document.getElementById("to").value;
    att = document.getElementById("attendees").value;
    dec = document.getElementById("decorations").value;
    par = document.getElementById("parties").value;
    ph = document.getElementById("photos").value;
    br = document.getElementById("breakfast").value;
    dr = document.getElementById("drinks").value;
    budget = document.getElementById("budget").value;
    makeRequest(''); //to be changed for a php file

}

function makeRequest(url) {
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        alert('Giving up :( Cannot create an XMLHTTP instance');
        return false;
    }

    httpRequest.onreadystatechange = alertContents;
    httpRequest.open('POST', url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('clientName=' + encodeURIComponent(name) + '&eventType=' + encodeURIComponent(type) + '&eventStartDateTime=' + encodeURIComponent(start) + '&eventEndDateTime=' + encodeURIComponent(end) + '&attendees=' + encodeURIComponent(att) + '&decorations=' + encodeURIComponent(dec) + '&parties=' + encodeURIComponent(par) + '&photos=' + encodeURIComponent(ph) + '&breakfast=' + encodeURIComponent(br) + '&drinks=' + encodeURIComponent(dr) + '&budget=' + encodeURIComponent(budget));
}

function alertContents() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
            var response = JSON.parse(httpRequest.responseText);
            myExecution = response.execution;
            
            if (myExecution == "success"){
                alert('Success');
            } else if (myExecution == "failure") {
                alert('Failure');
            } 
            return false;

        } else {
            alert('There was a problem with the request.');
        }
    }
}

