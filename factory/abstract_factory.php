<?php
interface database_option {
    public function custom_query($sql);
    public function get_table_data($table_name);
}

class mysql_conn implements database_option {
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

class psql_conn implements database_option {
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

abstract class Factory {
    abstract public static function create_mysql_conn();
    abstract public static function create_psql_conn();
}

class db_Factory extends Factory {
    public static function create_mysql_conn() {
        return new mysql_conn();
    }

    public static function create_psql_conn() {
        return new psql_conn();
    }
}

// mysql
// $mysql_dbh = db_Factory::create_mysql_conn();
// $mysql_dbh->get_table_data('order');

// psql
// $psql_dbh = db_Factory::create_psql_conn();
// $psql_dbh->custom_query('select * from student');
