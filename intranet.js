function validacion(){

name = document.getElementById("name").value;
    if (name.length==0){
        inicio.username.focus()
        alert("[ERROR] Tiene que escribir su nombre de usuario.");
        return false;
   }
pass = document.getElementById("pass").value;
   if (pass.length==0){
       inicio.password.focus()
       alert("[ERROR] Favor de escribir una contraseña.");
       return false;
   }

inicio.submit();
}
/*
function colorear(item) {
  const head = document.querySelector('{$item}');
    head.classList.add('current');
    console.log(head);
  
}
/*
function listen() {
    const current = document.querySelectorAll('.one')[0];
    if (current.classList.contains('current')) {
        current.classList.remove('current');
    }else current.classList.add('current');
    
}


var btnContainer = document.getElementById("menu");

// Get all buttons with class="btn" inside the container
var btns = btnContainer.getElementsByClassName("one");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("current");
    current[0].className = current[0].className.replace(" current", "");
    this.className += " current";
  });
}
*/