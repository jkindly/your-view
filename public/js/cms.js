$(document).ready(function() {

    //MAIN LEFT MENU

    $('.cms-menu').children('li').click(function() {
        var item = $(this);
        if (item.next('.cms-submenu').hasClass('show'))
            item.next('.cms-submenu').removeClass('show');
        else
            item.next('.cms-submenu').addClass('show');
    });

    //END MAIN LEFT MENU


    //MENU ITEMS
    $('.cms-menu-items').children('li').click(function() {
        var item = $(this);
        if (item.next('.cms-menu-item-extended').hasClass('show')) {
            item.next('.cms-menu-item-extended').removeClass('show');
            item.removeClass('cms-item-border-top-radius');
        } else {
            item.next('.cms-menu-item-extended').addClass('show cms-item-border-bottom-radius');
            item.addClass('cms-item-border-top-radius');
        }


    });

    //END MENU ITEMS


});