window.onload = isActorInside;

function isActorInside(){
	if (sessionStorage.actor){
		document.getElementById("isActorOn").innerHTML = sessionStorage.actor;
		document.getElementById("isActorOn").style.display = 'block';
		document.getElementById("islogin").innerHTML = "Logout";
		document.getElementById("islogin").href = "logout.html"
		if (sessionStorage.actor != "sarah"){
			document.getElementById("isTaskOn").style.display = 'block';
		}
	} else {
		document.getElementById("islogin").innerHTML = "Login";
	}
}