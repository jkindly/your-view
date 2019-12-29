<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/your-view/app/config/defines.php';

class Model {
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
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

    public function update($table, $where = [], $arguments = []) {
        $queryString = "UPDATE " . $table . ' SET ';

        foreach ($arguments as $key => $value) {
            if ($key !== array_key_last($arguments))
                $queryString .= $key . ' = ' . "' $value ', ";
            else
                $queryString .= $key . ' = ' . "' $value '";
        }

        foreach ($where as $key => $item) {
            $queryString .= ' WHERE ' . $key . ' = ' . $item;
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
                $queryString .= "'$value'" . ', ';
            else
                $queryString .= $value;
        }

        $queryString .= ')';

        $this->sendQuery($queryString);

    }

    public function fetch($table, ...$columns) {
        $columnsToFetch = $this->getColumns(...$columns);

        $queryString = 'SELECT ' . $columnsToFetch . ' FROM '. $table;
        return $this->sendQuery($queryString);
    }

    public function fetchJoin() {
        $query = 'SELECT menu.name AS primary_name, 
                         menu.uri AS primary_uri, 
                         menu_sub1.name AS sub1_name, 
                         menu_sub2.uri AS sub1_uri, 
                         menu_sub2.name AS sub2_name, 
                         menu_sub2.uri AS sub2_uri
                  FROM menu 
                  LEFT JOIN menu_sub1 
                  ON menu.id = menu_sub1.id_menu 
                  LEFT JOIN menu_sub2 
                  ON menu_sub2.id_menu_sub1 = menu_sub1.id 
                  ORDER BY menu.display_order';

        return $this->sendQuery($query);
    }
}