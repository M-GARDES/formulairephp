function changeFormColor() {
  let form = document.getElementById("myForm");
   
   if (form.classList.contains("form-color-change")) {
     form.classList.remove("form-color-change");
     document.getElementById("colorChangeButton").textContent = "Change la couleur du formulaire";
   } else {
     form.classList.add("form-color-change");
     document.getElementById("colorChangeButton").textContent = "Revenir à la couleur originale";
   }
}

document.addEventListener("DOMContentLoaded", function() {
   var myNavbar = document.getElementById("navbarNav");
   var myNavbarToggler = document.getElementById("navbarToggler");

   myNavbarToggler.addEventListener("click", function() {
       myNavbar.classList.toggle("show");
   });
});
