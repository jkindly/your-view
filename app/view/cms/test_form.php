<?php

$menu = $_POST['menu'];

$menu_array = unserialize(base64_decode($menu));

dump($menu_array);


foreach ($menu_array as $key => $primaryCategory) {
    echo 'Name primary: ' . $key . '<br>';

    echo '...URI primary: ' . $primaryCategory['uri'] . '<br><br>';

    foreach ($primaryCategory as $key2 => $category) {
        if (is_array($category)) {
            echo '......Podkategoria: ' . $key2 . '<br>';

            foreach ($category as $key3 => $subCategory) {
                if (!is_array($subCategory)) {
                    echo '.........Uri podkategorii: ' . $subCategory . '<br><br>';
                } else {
                    foreach ($subCategory as $key4 => $lastSubCat) {
                        echo '............Podkategoria: ' . $key3 . '<br><br>';
                        echo '...............Uri Podkategorii: ' . $lastSubCat . '<br><br>';
                    }
                }
            }
        }
    }

}