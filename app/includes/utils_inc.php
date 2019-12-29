<?php

function dump($toDump) {
    echo '<pre>';
    print_r($toDump);
    echo '</pre><br>';
}

function includeView($file, $variables = null) {
    if ($variables !== null)
        extract($variables);

    include($file);
}