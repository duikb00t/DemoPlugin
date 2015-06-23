$(document).ready(function() {
  jQuery.getJSON(
      AjaxExample.ajaxurl,
      {
          action: 'ajax-example',
          nonce: AjaxExample.nonce
      },
      function( response ) {
      	alert( response.success );
      }
  );
});
