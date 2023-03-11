

/**
 * sharers buttons click
 */

document.addEventListener('DOMContentLoaded', function() {
    var sharers = document.getElementsByClassName('sharers');
    for (var i = 0; i < sharers.length; i++) {
        sharers[i].addEventListener('click', function(event) {

            var url = this.getAttribute('data-url');
            window.open(url, 'sharer', 'toolbar=0,status=0,width=626,height=436');

        });
    }
});




document.addEventListener('DOMContentLoaded', function() {
   var dropdown = document.getElementById('dropdown');
   dropdown.addEventListener('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        dropdown.classList.toggle('active');
   });
});



document.addEventListener('DOMContentLoaded', function() {
   var modal_close = document.getElementById('modal-close');
   modal_close.addEventListener('click', function(event) {
         var modal = document.getElementById('modal');


        modal.classList.toggle('active');
   });
});


/*
Open Modal Listener
*/

document.addEventListener('DOMContentLoaded', function() {
   var open_model_buttons = document.getElementsByClassName('open-modal');
   for (var i = 0; i < open_model_buttons.length; i++) {
         open_model_buttons[i].addEventListener('click', function(event) {
            var model_id = this.getAttribute('data-modal-id');
            var modal = document.getElementById(model_id);
               modal.classList.toggle('active');
         });
    }
});

