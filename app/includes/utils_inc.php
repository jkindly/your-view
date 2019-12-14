<?php

function dump($toDump) {
    echo '<pre>';
    print_r($toDump);
    echo '</pre><br>';
}

function includeView($file, $variables) {
    extract($variables);
    include($file);
}