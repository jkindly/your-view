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

    var currentUri = window.location.pathname;
    currentUri = currentUri.split('/');
    currentUri = currentUri[currentUri.length-1]
    if (currentUri === 'cms-edit-page')
        currentUri = 'cms-manage-pages';
    console.log(currentUri);

    $('a[href*='+currentUri+']').each(function() {
        if (currentUri === 'admin') return;
        $(this).parent().parent().addClass('show');
        $(this).parent().addClass("cms-active-item");
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

        $( "#menu-level1, #menu-level2, #menu-level3" ).sortable({
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

        // auto generated uri
    $('input[name="page_uri"]').focus(function() {
        var pageName = $('input[name="page_name"]').val();
        var uri = pageName.split(' ').join('-');
        var str = uri.replace(/[&\/\\#,+()$~%.'";:*!?<>{}\[\]]/g, '');
        str = RemoveAccents(str);
        $(this).val(str.toLowerCase());
    });

    $('.remove-page-btn').click(function() {
        if (confirm("Na pewno usunąć stronę?")) {
            var id = window.location.search.substr(1);
            id = id.split('=');
            var host = window.location.hostname + '/your-view/';
            window.location.replace('http://'+host+'app/scripts/cms/delete_page.php?id='+id[1]);
        }
    });
    //END PAGES
});


function RemoveAccents(strAccents) {
    var strAccents = strAccents.split('');
    var strAccentsOut = new Array();
    var strAccentsLen = strAccents.length;
    var accents = 'ĄąĆćĘęŁłŃńÓóŚśŹźŻż';
    var accentsOut = 'aacceellnnoosszzzz';
    for (var y = 0; y < strAccentsLen; y++) {
        if (accents.indexOf(strAccents[y]) != -1) {
            strAccentsOut[y] = accentsOut.substr(accents.indexOf(strAccents[y]), 1);
        } else
            strAccentsOut[y] = strAccents[y];
    }
    strAccentsOut = strAccentsOut.join('');
    return strAccentsOut;
}