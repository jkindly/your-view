<?php

//$menu = $_POST['menu'];

//$menu_array = unserialize(base64_decode($menu));

dump($_POST);






//foreach ($menu_array as $key => $primaryCategory) {
//    echo $key . '<br>'; // Primary name
//
//    echo $primaryCategory['uri'] . '<br><br>'; // Primary URI
//
//    foreach ($primaryCategory as $key2 => $category) {
//        if (is_array($category)) {
//            echo $key2 . '<br>'; // Subcategory name
//
//            foreach ($category as $key3 => $subCategory) {
//                if (!is_array($subCategory)) {
//                    echo $subCategory . '<br><br>'; // Subcategory URI
//                } else {
//                    foreach ($subCategory as $key4 => $lastSubCat) {
//                        echo $key3 . '<br><br>'; // Subcategory of subcategory name
//                        echo $lastSubCat . '<br><br>'; // Subcategory of subcategory URI
//                    }
//                }
//            }
//        }
//    }
//
//}