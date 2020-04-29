<?php
//  多态
//  一种事物的多种表现方式
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

$conn = new psql_conn;
$conn->conn();