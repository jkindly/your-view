$(document).ready(function() {

    //USER MENU SHOWING
    $('.user-avatar-logged-in').click(function () {
        if ($('#user-avatar-menu').hasClass('show'))
            $(this).children('.user-avatar-menu').removeClass('show');
        else
            $(this).children('.user-avatar-menu').addClass('show');
    });
    // END USER MENU SHOWING
});