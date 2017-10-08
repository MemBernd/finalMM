var myPassword,
    myUsername,
    myRole;
var username, password;
var httpRequest;
var attempt = 3; // Variable to count number of attempts.
// Below function Executes on click of login button.
function validate() {
    username = document.getElementById("username").value;
    password = document.getElementById("password").value;
    makeRequest('getCredentials.php');

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
    httpRequest.send('username=' + encodeURIComponent(username));
}

function alertContents() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
            var response = JSON.parse(httpRequest.responseText);
            myUsername = response.username;
            myPassword = response.password;
            myRole = response.role;

            if (myUsername == username && myPassword == password) {
            	sessionStorage.actor = myUsername;
                if (myUsername == "sarah") {
                    window.location = "cso.html"; // Redirecting to other page.
                } else if (myUsername == "alice") {
                	window.location = "fm.html";
                } else if (myUsername == "jack") {
                	window.location = "pm.html";
                } else if (myUsername == "janet") {
                	window.location = "scso.html";
                } else if (myUsername == "magy") {
                	window.location = "subteam.html";
                } else if (myUsername == "mike") {
                	window.location = "am.html";
                } else if (myUsername == "natalie") {
                	window.location = "sm.html";
                } else { //simon 
                	window.location = "hr.html";
                }

                return false;
            } else {
                attempt--; // Decrementing by one.
                alert("Attempts left: " + attempt);
                // Disabling fields after 3 attempts.
                if (attempt === 0) {
                    document.getElementById("username").disabled = true;
                    document.getElementById("password").disabled = true;
                    document.getElementById("submitLogin").disabled = true;
                    return false;
                }
                //alert(response.password + " " + response.role);
            }

        } else {
            alert('There was a problem with the request.');
        }
    }
}

function pressenter() {
    document.getElementById("password").onkeydown = function(event) {
        if (event.keyCode == 13) {
            validate();
        }
    }
}