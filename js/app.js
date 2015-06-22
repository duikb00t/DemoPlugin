$(document).ready(function() {

  /* Front-end suggestions for the City search */
  var typingTimer;                //timer identifier
  var doneTypingInterval = 5000;  //time in ms, 5 second for example


  //on keyup, start the countdown
  $('#loc').keyup(function(){
    clearTimeout(typingTimer);
    $('#suggestions').fadeOut();
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
  });

  //on keydown, clear the countdown
  $('#loc').keydown(function(){
    clearTimeout(typingTimer);
  });

  //user is "finished typing," do something
  function doneTyping () { //...
  }

  $('#loc').blur(function() {
    if( !$(this).val() ) {
      $(this).css('border','3px solid orange');
      $('#suggestions').fadeIn();
    } else {
      $('#suggestions').fadeOut();
    }
  });
});
