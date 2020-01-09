<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/your-view/app/config/defines.php';

class Model {
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
            $this->pdo -> query ('SET NAMES utf8');
            $this->pdo -> query ('SET CHARACTER_SET utf8_unicode_ci');
        } catch (PDOException $e) {
            echo 'Wystąpił błąd połączenia z bazą. ' . $e->getMessage();
        }
    }

    private function sendQuery($queryString) {
        try {
            $query = $this->pdo->prepare($queryString);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    private function getColumns(...$columns) {
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

    public function fetchWithWhere($table, $where, $value, ...$columns) {
        $columnsToFetch = $this->getColumns(...$columns);

        $queryString = 'SELECT ' . $columnsToFetch . ' FROM '. $table . ' WHERE ' . $where . ' = ' . '"'.$value.'"';

        return $this->sendQuery($queryString);
    }

    function fetchWithAndWhere($table, array $where, ...$columns) {
        $columnsToFetch = $this->getColumns(...$columns);
        $whereAnd = "";

        foreach($where as $item => $value) {
            $whereAnd .= $item . ' = ' . "'" . $value . "'" . ' AND ';
        }
        $whereAnd = substr($whereAnd, 0, -4);
        $queryString = 'SELECT ' . $columnsToFetch . ' FROM ' . $table . ' WHERE ' . $whereAnd;
        return $this->sendQuery($queryString);
    }

    public function update($table, $where = [], $arguments = []) {
        $queryString = "UPDATE " . $table . ' SET ';

        foreach ($arguments as $key => $value) {
            if ($key !== array_key_last($arguments))
                $queryString .= $key . ' = ' . '"'.$value. '", ';
            else
                $queryString .= $key . ' = ' . '"'.$value. '"';
        }

        if (!empty($where)) {
            foreach ($where as $key => $item) {
                $queryString .= ' WHERE ' . $key . ' = ' . '"'.$item. '"';
            }
        }

        $this->sendQuery($queryString);
    }

    public function insert($table, $values=[]) {
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

        $this->sendQuery($queryString);
    }

    public function fetch($table, ...$columns) {
        $columnsToFetch = $this->getColumns(...$columns);

        $queryString = 'SELECT ' . $columnsToFetch . ' FROM '. $table;
        return $this->sendQuery($queryString);
    }

    public function fetchMenuSortable($table, ...$columns) {
        $columnsToFetch = $this->getColumns(...$columns);

        $queryString = 'SELECT ' . $columnsToFetch . ' FROM '. $table . ' ORDER BY display_order';
        return $this->sendQuery($queryString);
    }

    public function fetchJoin() {
        $query = 'SELECT menu_level1.name AS menu_level1_name, menu_level2.name AS menu_level2_name, menu_level3.name AS menu_level3_name
FROM menu_level1
LEFT JOIN menu_level2
ON menu_level1.id = menu_level2.id_menu_level1
LEFT JOIN menu_level3
ON menu_level2.id = menu_level3.id_menu_level2
ORDER BY menu_level1.display_order';

        return $this->sendQuery($query);
    }

    public function delete($table, $what, $value) {
        $query = 'DELETE FROM ' . $table . ' WHERE ' . $what . ' = ' . '"'.$value.'"';
        return $this->sendQuery($query);
    }
}