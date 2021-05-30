var modal = document.getElementById("myModal");
$(document).ready(function() {
  modal.style.display = "none";

});


// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get save button

var savePNGButton = wrapper.querySelector("[data-action=save-png]");

// Get form to submit

var form = document.getElementById("sigform"),
    input = document.getElementById("siginput");

// When the user clicks on the button, open the modal
btn.onclick = function() {
  $('#myModal').addClass("blur");
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  signaturePad.clear();
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    signaturePad.clear();
    modal.style.display = "none";
  }
}



savePNGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    alert("Veuillez d'abord fournir une signature.");

  } else {
        input.value = signaturePad.toDataURL();
        $.ajax({
          url: '../custom/signature/class/actions_signatureload.inc.php',
          type: 'post',
          dataType: 'html',
          data: $("#sigform").serialize(),
          success:function(response){
            if(response == 1){
              console.log('Save successfully'); 
              modal.style.display = "none";
               window.location.reload();
            }else{
              console.log("Not saved.");
            }
          }
        });
    }
});
