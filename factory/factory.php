<?php
//  工厂模式
interface IConn {
    public function conn();
}

class mysql_conn implements IConn {
    public function conn() {
        echo "conn to mysql";
    }
}

class psql_conn implements IConn {
    public function conn() {
        echo "conn to psql";
    }
}

class redis_conn implements IConn {
    public function conn() {
        echo "conn to redis";
    }
}

class redis_conn_factory {
    public static function get_conn() {
        return new redis_conn;
    }
}

class psql_conn_factory {
    public static function get_conn() {
        return new psql_conn;
    }
}

class mysql_conn_factory {
    public static function get_conn() {
        return new mysql_conn;
    }
}

// $conn = new psql_conn;
// $conn->conn();
$conn = redis_conn_factory::get_conn();
$conn->conn();
echo "<br>";
$conn = mysql_conn_factory::get_conn();
$conn->conn();
echo "<br>";
$conn = psql_conn_factory::get_conn();
$conn->conn();
echo "<br>";