$(document).ready(function() {
  $("#cardPayment").slideUp(10);
// Listen for changes on payment method radio buttons
  $(".peer").on("change", function() {
    if ($("#Card").is(':checked')) {
    $("#cardPayment").slideToggle();
  }else{
    $("#cardPayment").slideup();
    
    }
});
});	

const but = document.querySelector('#button').addEventListener('click', ()=>{
  alert('Form submitted successfully!');
 });