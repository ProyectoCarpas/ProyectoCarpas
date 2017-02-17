// IIFE - Immediately Invoked Function Expression  (CLOSURE)
(function(code) {

      // The global jQuery object is passed as a parameter
      code(window.jQuery, window, document);

}(function($, window, document) {

        var flashMessage = $(".flashMessage");

        // The $ is now locally scoped
        $(document).ready(function(){

            // Hide message after 8 seconds and delay 1.5 second to aplying fadeOut.
            setTimeout(function() {
                                $(".flashBox").fadeOut(1500);
                            }, 8000);

            flashMessage.addClass('animated fadeInDown');
        });

        // The rest of your code goes here! (like methods and all the code that doesn't need the DOM ready).

        $(".close").click(function() {
            flashMessage.removeClass('fadeInDown').addClass('fadeOutUp');
        });
    })
);