<?php
// 单例模式
final class singleton {
    private static $obj = null;

    private function __construct() {}

    private function __clone() {}

    public static function get_instance() {
        if (self::$obj == null) {
            self::$obj = new self();
        }   
        return self::$obj;
    }
}

$a = singleton::get_instance();
$b = $a;
var_dump($a, $b);