$(document).ready(function() {

    //MAIN LEFT MENU

    $('.cms-menu').children('li').click(function(e) {
        if (e.target !== this) return;
        var item = $(this);
        if (item.children('.cms-submenu').hasClass('show'))
            item.children('.cms-submenu').removeClass('show');
        else
            item.children('.cms-submenu').addClass('show');
    });

    //END MAIN LEFT MENU


    //MENU ITEMS
    $('body').on('click', '.menu-list-item', function(e) {
        if (e.target !== this) return;
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


    //ADDING NEW MENU CATEGORY

        $( "#primary-menu, #sub-menu-level1, #sub-menu-level2" ).sortable({
            connectWith: ".draggable-list"
        }).disableSelection();

    //END ADDING NEW MENU CATEGORY


    //PAGES
    tinymce.init({
        selector: 'textarea#cms-page-content',
        height: 500,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste imagetools wordcount"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tiny.cloud/css/codepen.min.css'
        ]
    });
    //END PAGES
});