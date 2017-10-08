function actor(){
   document.getElementById("displayactor").innerHTML = "<h1>Welcome " + jsUcfirst(sessionStorage.actor) + " </h1>"; 
}

//function to capitalize first letter of a string
function jsUcfirst(string) 
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

window.onload = actor;