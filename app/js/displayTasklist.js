var tasklist; //a list of tasks

function actor(){
	if (!sessionStorage.actor) {
		window.location = "main.html";
	} else {
		if (window.location.pathname == "/app/cso.html" && sessionStorage.actor != "sarah") {
			window.location = "main.html";
		} else {
			document.getElementById("makevisible").style.visibility = "visible" ;
			document.getElementById("displayactor").innerHTML = "<h1>Welcome " + jsUcfirst(sessionStorage.actor) + " </h1>";
			if (sessionStorage.actor != "sarah" && sessionStorage.actor != "magy" ) {
				makeRequest('');
			}
		}
	}
   
}

//function to capitalize first letter of a string
function jsUcfirst(string) 
{
    return string.charAt(0).toUpperCase() + string.slice(1);
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
    httpRequest.send();
}

function alertContents() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
            var response = JSON.parse(httpRequest.responseText);
            tasklist = response.tasklist;
            var table="<thead><tr><th>idTask</th><th>Subject</th><th>Description</th><th>Priority</th><th>Status</th><th>EventRecord</th><th>Creator</th><th>Assignee</th></tr></thead>";
            table += "<tbody>";
            for (var i = 0; i<tasklist.length; i++){
                if (tasklist.status[i] == "created" || tasklist.status[i] == "acceptedByAM" && sessionStorage.actor == "janet") {
                    table += "<tr><td>" + tasklist.idTask[i] + "</td><td>" + tasklist.subject[i] + "</td><td>" + tasklist.description[i] + "</td><td>" + tasklist.priority[i] + "</td><td>" + tasklist.status[i] + "</td><td>" + tasklist.eventRecord[i] + "</td><td>" + tasklist.creator[i] + "</td><td>" + tasklist.assignee[i] + "</td></tr>";
                }
                if ((tasklist.status[i] == "acceptedBySCSO" || tasklist.status[i] == "pendingRequest") && sessionStorage.actor == "alice") {
                    table += "<tr><td>" + tasklist.idTask[i] + "</td><td>" + tasklist.subject[i] + "</td><td>" + tasklist.description[i] + "</td><td>" + tasklist.priority[i] + "</td><td>" + tasklist.status[i] + "</td><td>" + tasklist.eventRecord[i] + "</td><td>" + tasklist.creator[i] + "</td><td>" + tasklist.assignee[i] + "</td></tr>";
                }
                if (tasklist.status[i] == "processedByFM" && sessionStorage.actor == "mike") {
                    table +="<tr><td>" + tasklist.idTask[i] + "</td><td>" + tasklist.subject[i] + "</td><td>" + tasklist.description[i] + "</td><td>" + tasklist.priority[i] + "</td><td>" + tasklist.status[i] + "</td><td>" + tasklist.eventRecord[i] + "</td><td>" + tasklist.creator[i] + "</td><td>" + tasklist.assignee[i] + "</td></tr>";
                }
                if ((tasklist.status[i] == "summaryCreated" || tasklist.status[i] == "open" || tasklist.status[i] == "pendingReviewSTM") && (sessionStorage.actor == "jack" || sessionStorage.actor == "natalie")) {
                    table +="<tr><td>" + tasklist.idTask[i] + "</td><td>" + tasklist.subject[i] + "</td><td>" + tasklist.description[i] + "</td><td>" + tasklist.priority[i] + "</td><td>" + tasklist.status[i] + "</td><td>" + tasklist.eventRecord[i] + "</td><td>" + tasklist.creator[i] + "</td><td>" + tasklist.assignee[i] + "</td></tr>";
                }
                if (tasklist.status[i] == "staffRequest" && sessionStorage.actor == "simon") {
                    table +="<tr><td>" + tasklist.idTask[i] + "</td><td>" + tasklist.subject[i] + "</td><td>" + tasklist.description[i] + "</td><td>" + tasklist.priority[i] + "</td><td>" + tasklist.status[i] + "</td><td>" + tasklist.eventRecord[i] + "</td><td>" + tasklist.creator[i] + "</td><td>" + tasklist.assignee[i] + "</td></tr>";
                }
                    
            }

            table += "</tbody>";
            document.getElementById("listTitle").innerHTML = "<h3>List with tasks</h3>";
            document.getElementById("displaytasks").innerHTML = table;
        }
    } else {
            alert('There was a problem with the request.');
            }
}


window.onload = actor;