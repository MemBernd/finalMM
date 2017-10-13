function name(){
    if (!sessionStorage.actor) {
        window.location = "main.html";
    } else {
        if (window.location.pathname == "/app/cso.html" && sessionStorage.actor != "sarah") {
            window.location = "main.html";
        } else {
            document.getElementById("makevisible").style.visibility = "visible" ;
            document.getElementById("displayactor").innerHTML = "<h1>Welcome " + jsUcfirst(sessionStorage.actor) + " </h1>";
            if (sessionStorage.actor != "sarah" && sessionStorage.actor != "magy" ) {
                makeTaskRequest('php/getTaskList.php', sessionStorage.actor); //to be added
            }
        }
    }

}

//function to capitalize first letter of a string
function jsUcfirst(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}


function makeTaskRequest(url, actor) {
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        alert('Giving up :( Cannot create an XMLHTTP instance');
        return false;
    }

    httpRequest.onreadystatechange = showTasks;
    httpRequest.open('POST', url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('username=' + encodeURIComponent(actor));
}

function showTasks() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
            var response = JSON.parse(httpRequest.responseText);
            
            var table="<thead><tr><th>Task ID</th><th>Subject</th><th>Description</th><th>Priority</th><th>Status</th><th>Event Record</th><th>Creator</th><th>Assignee</th></tr></thead>";
            table += "<tbody>";
            
            for ( var i = 0; i < response.length; i ++) {
                table += "<tr><td>" + response[i].idTask + "</td><td>" + response[i].subject + "</td><td>" + response[i].description + "</td><td>" + response[i].priority + "</td><td>" + response[i].status + "</td><td>" + response[i].eventRecord + "</td><td>" + response[i].creator + "</td><td>" + response[i].assignee + "</td></tr>";
            }

            table += "</tbody>";

            document.getElementById("listTitle").innerHTML = "<h3>List with tasks</h3>";
            document.getElementById("displaytasks").innerHTML = table;
        }
    } 
}

function addTaskHandler(){
    var tasklist = document.getElementById("displaytasks");
    var rows = tasklist.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) {
        var currentRow = tasklist.rows[i];
        var createClickHandler = 
            function(row)
            {
                return function() {
                    var cell = row.getElementsByTagName("td")[0];
                    var id = cell.innerHTML;
                    alert("id:" + id); 
                };
            };

        currentRow.onclick = createClickHandler(currentRow);    
    }
}


window.onload = name;