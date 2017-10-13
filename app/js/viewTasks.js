var level = [];

function name() {
    if (!sessionStorage.actor) {
        window.location = "main.html";
    } else {
        if (window.location.pathname == "/app/cso.html" && sessionStorage.actor != "sarah") {
            window.location = "main.html";
        } else {
            document.getElementById("makevisible").style.visibility = "visible";
            document.getElementById("displayactor").innerHTML = "<h1>Welcome " + jsUcfirst(sessionStorage.actor) + " </h1>";
            if (sessionStorage.actor != "sarah" && sessionStorage.actor != "magy") {
                makeTaskRequest('php/getTaskList.php', sessionStorage.actor); //to be added
            }
        }
    }

}

//function to capitalize first letter of a string
function jsUcfirst(string) {
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

            var table = "<thead><tr><th>Task ID</th><th>Subject</th><th>Description</th><th>Priority</th><th>Status</th><th>Event Record</th><th>Creator</th><th>Assignee</th></tr></thead>";
            table += "<tbody>";

            for (var i = 0; i < response.length; i++) {
                table += "<tr><td>" + response[i].idTask + "</td><td>" + response[i].subject + "</td><td>" + response[i].description + "</td><td>" + response[i].priority + "</td><td>" + response[i].status + "</td><td>" + response[i].eventRecord + "</td><td>" + response[i].creator + "</td><td>" + response[i].assignee + "</td></tr>";
                level.push(Number(response[i].status));
            }


            table += "</tbody>";

            document.getElementById("listTitle").innerHTML = "<h3>List with tasks</h3>";
            document.getElementById("displaytasks").innerHTML = table;

            addTaskHandler();

        }
    }
}

function addTaskHandler() {
    //var tasklist = document.getElementsByTagName('tr')[2].getElementsByTagName('td')[0].innerHTML;
    //var cells = tasklist.getElementsByTagName("td");

    var length = 1;

    while (document.getElementsByTagName('tr')[length]) {
        length++;
    }

    for (var i = 1; i < length; i++) {
        var currentRow = document.getElementsByTagName('tr')[i];
        var pos = i - 1;

        var createClickHandler =
            function(row, pos) {
                return function() {

                    if (sessionStorage.actor == "janet" && level[pos] == 1) {
                        document.getElementById('ModalLabel').innerHTML = "Task #" + row.getElementsByTagName('td')[0].innerHTML + ": New Event Request";
                        document.getElementById('ModalBody').innerHTML = "&nbsp&nbsp&nbsp&nbspWould you like to approve or reject the new event request?";
                        document.getElementById('FooterDefault').innerHTML = "Reject";
                        document.getElementById('FooterSecond').innerHTML = "Approve";
                        row.setAttribute("data-toggle", "modal");
                        row.setAttribute("data-target", "#myModal");
                    }
                    if (sessionStorage.actor == "janet" && level[pos] == 4) {
                        document.getElementById('ModalLabel').innerHTML = "Task #" + row.getElementsByTagName('td')[0].innerHTML + ": Create Summary";
                        document.getElementById('ModalBody').innerHTML = "&nbsp&nbsp&nbsp&nbsp<textarea></textarea>";
                        document.getElementById('ModalBody').setAttribute("rows", "6");
                        document.getElementById('ModalBody').setAttribute("cols", "100"); 
                        document.getElementById('ModalBody').setAttribute("name", "summary"); 
                        document.getElementById('FooterDefault').innerHTML = "Cancel";
                        document.getElementById('FooterSecond').innerHTML = "Send";
                        row.setAttribute("data-toggle", "modal");
                        row.setAttribute("data-target", "#myModal");
                    }

                    //var cell = row.getElementsByTagName("td")[0].innerHTML;
                    //alert("cell:" + cell);
                };
            };

        currentRow.onclick = createClickHandler(currentRow, pos);
    }
    //alert(tasklist);

}


window.onload = name;