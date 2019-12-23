$(document).ready(function() {

    //USER MENU SHOWING
    $('.user-avatar-logged-in').click(function () {
        if ($('#user-avatar-menu').hasClass('show'))
            $(this).children('.user-avatar-menu').removeClass('show');
        else
            $(this).children('.user-avatar-menu').addClass('show');
    });
    // END USER MENU SHOWING

    //EDITING USER AVATAR
    $('.user-avatar-edit').click(function() {
        $('#imgupload').trigger('click');
    });

    function newAvatarPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#user-avatar').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);

            $('.user-change-avatar-buttons').html("");
            $('.user-avatar-settings').append(
                '<div class="user-change-avatar-buttons">' +
                    '<button class="avatar-change-btn accept-btn">Ustaw</button>' +
                    '<button class="avatar-change-btn cancel-btn">Anuluj</button>' +
                '</div>'
            );
        }
    }

    $('#imgupload').change(function() {
        newAvatarPreview(this);
    });
    //END EDITING USER AVATAR
});