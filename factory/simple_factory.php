<?php
class mysql_conn {
    private $dbh = null;
    private $host = 'localhost';
    private $port = '3306';
    private $user = 'root';
    private $password = '201995';
    private $dbname = 'test';

    public function __construct() {
        $this->dbh = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname, $this->user, $this->password);
    }

    public function get_table_data($table_name) {
        foreach($this->dbh->query("SELECT * from `$table_name`") as $row) {
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
    }
}

class psql_conn {
    private $dbh = null;
    private $host = 'localhost';
    private $port = '5432';
    private $user = 'postgres';
    private $password = '201995';
    private $dbname = 'test';

    public function __construct() {
        $this->dbh = new PDO('pgsql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname, $this->user, $this->password);
    }

    public function get_table_data($table_name) {
        foreach($this->dbh->query("SELECT * from `$table_name`") as $row) {
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
    }

    public function custom_query($sql) {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        foreach ($stmt as $row) {
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
    }
}

class Factory {
    public static function pdo_conn($db = 'mysql') {
        if ($db == 'mysql') {
            return new mysql_conn();
        }
        else if ($db == 'psql') {
            return new psql_conn();
        }
    }
}

// mysql
// $mysql_dbh = Factory::pdo_conn('mysql');
// $mysql_dbh->get_table_data('user');
// $mysql_dbh->get_table_data('order');

// postgresql
// $psql_dbh = Factory::pdo_conn('psql');
// $psql_dbh->custom_query('select * from student');