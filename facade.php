<?php
// 外观模式
// 下面以电脑开关机为例子，正常情况下，我们只需要按下开机键即可，其他操作，比如 BIOS、打开操作系统这些操作是不需要用户关心的。
class OperatingSystem {
    public function open() {
        echo '打开操作系统 ';
    }

    public function shutdown() {
        echo '关闭操作系统 ';
    }

    public function login() {
        echo '登录操作系统 ';
    }
}

class Bios {
    // 硬件自检
    public function hardware_check() {
        echo '硬件自检 ';
    }
    // 启动操作系统
    public function launch(OperatingSystem $os) {
        echo '启动操作系统 ';
    }
    // 电源关闭
    public function power_down() {
        echo '电源关闭 ';
    }
}

class Facade {
    private $os;
    private $bios;

    public function __construct() {
        $this->bios = new Bios;
        $this->os = new OperatingSystem;
    }

    public function turn_on() {
        $this->bios->hardware_check();
        $this->bios->launch($this->os);
        $this->os->open();
        $this->os->login();
    }

    public function turn_off() {
        $this->os->shutdown();
        $this->bios->power_down();
    }
}

// client 
$facade = new Facade();

// computer on
$facade->turn_on();
echo "<br>";
// computer off
$facade->turn_off();