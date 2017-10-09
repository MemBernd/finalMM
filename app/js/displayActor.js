function actor(){
	if (!sessionStorage.actor) {
		window.location = "main.html";
	} else {
		if (window.location.pathname == "/app/cso.html" && sessionStorage.actor != "sarah") {
			window.location = "main.html";
		} else if (window.location.pathname == "/app/fm.html" && sessionStorage.actor != "alice") {
			window.location = "main.html";
		} else if (window.location.pathname == "/app/pm.html" && sessionStorage.actor != "jack") {
			window.location = "main.html";
		} else if (window.location.pathname == "/app/scso.html" && sessionStorage.actor != "janet") {
			window.location = "main.html";
		} else if (window.location.pathname == "/app/subteam.html" && sessionStorage.actor != "magy") {
			window.location = "main.html";
		} else if (window.location.pathname == "/app/am.html" && sessionStorage.actor != "mike") {
			window.location = "main.html";
		} else if (window.location.pathname == "/app/sm.html" && sessionStorage.actor != "natalie") {
			window.location = "main.html";
		} else if (window.location.pathname == "/app/hr.html" && sessionStorage.actor != "simon") {
			window.location = "main.html";
		} else {
			document.getElementById("makevisible").style.visibility = "visible" ;
			document.getElementById("displayactor").innerHTML = "<h1>Welcome " + jsUcfirst(sessionStorage.actor) + " </h1>";

		}
	}
   
}

//function to capitalize first letter of a string
function jsUcfirst(string) 
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

window.onload = actor;