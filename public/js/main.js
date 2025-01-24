(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();

    document.querySelector('.sidebar-toggler').addEventListener('click', function (e) {
        e.preventDefault();
        const sidebar = document.querySelector('.sidebar'); // Adjust the selector to match your sidebar element
        sidebar.classList.toggle('collapsed'); // Ensure this class handles the collapsed state in your CSS
    });
})
(jQuery);