<?php

function getColumns(...$columns) {
    $columnsToFetch = "";

    if (empty($columns)) $columnsToFetch = "*";
    else {
        foreach ($columns as $column) {
            $columnsToFetch .= $column . ', ';
        }
        $columnsToFetch = substr($columnsToFetch, 0, -2);
    }
    return $columnsToFetch;
}

function fetch($table, ...$columns) {
    $columnsToFetch = getColumns(...$columns);

    echo 'SELECT ' . $columnsToFetch . ' FROM '. $table;
}

function fetchWithWhere($table, $where, $value, ...$columns) {
    $columnsToFetch = getColumns(...$columns);

    echo 'SELECT ' . $columnsToFetch . ' FROM '. $table . ' WHERE ' . $where . $value;
}

function fetchWithAndWhere($table, array $where, ...$columns) {
    $columnsToFetch = getColumns(...$columns);
    $whereAnd = "";

    foreach($where as $item => $value) {
        $whereAnd .= $item . ' = ' . "'" . $value . "'" . ' AND ';
    }
    $whereAnd = substr($whereAnd, 0, -4);
    echo 'SELECT ' . $columnsToFetch . ' FROM ' . $table . ' WHERE ' . $whereAnd;
}

fetch('user', 'kolumna');
echo '<br>';
fetchWithWhere('user', 'id = ', 1, 'first_name', 'last_name');
echo '<br>';
fetchWithAndWhere('user', ['id'=>1, 'first_name'=>'jakub', 'last_name'=>'kozupa']);
