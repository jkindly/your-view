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

    echo 'SELECT ' . $columnsToFetch . ' FROM '. $table . ' WHERE ' . $where . ' = ' . '"'.$value.'"';
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

function update($table, $where = [], $arguments = [])
{
    $queryString = "UPDATE " . $table . ' SET ';

    foreach ($arguments as $key => $value) {
        if ($key !== array_key_last($arguments))
            $queryString .= $key . ' = ' . '"'.$value. '", ';
        else
            $queryString .= $key . ' = ' . '"'.$value. '"';
    }

    foreach ($where as $key => $item) {
        $queryString .= ' WHERE ' . $key . ' = ' . $item;
    }

    echo $queryString;
}

function insert($table, $values=[]) {
    $queryString = 'INSERT INTO ' . $table . ' (';

    foreach ($values as $key => $value) {
        if ($key !== array_key_last($values))
            $queryString .= $key . ', ';
        else
            $queryString .= $key;
    }

    $queryString .= ') VALUES (';

    foreach ($values as $key => $value) {
        if ($key !== array_key_last($values))
            $queryString .= '"'.$value.'"' . ', ';
        else
            $queryString .= '"'.$value.'"';
    }

    $queryString .= ')';

    echo $queryString;
}


    //update('user', ['id' => 1], ['avatar_src' => 'tutaj adres obrazka', 'inny_arg' => 'asd']);
update('page', [
    'in_use' => 1
], [
    'id' => 27
]);
//fetch('menu');
//echo '<br>';
//fetchWithWhere('page', 'uri', 'asd');
//echo '<br>';
//fetchWithAndWhere('page', [
//    'id' => 1,
//    'uri' => 'xD'
//]);
