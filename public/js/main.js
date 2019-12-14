$(document).ready(function() {
    $('.user-avatar-logged-in').click(function () {
        if ($('#user-avatar-menu').hasClass('show'))
            $(this).children('.user-avatar-menu').removeClass('show');
        else
            $(this).children('.user-avatar-menu').addClass('show');
    });
});