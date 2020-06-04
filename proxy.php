<?php
// 抽象主题
interface Subject{
    function request();
}
// 真实主题
class RealSubject implements Subject{
    public function request(){
        echo "访问真实主题方法....<br>";
    }
}
// 代理
class Proxy{

    private $real_subject = null;

    public function request(){
        if ($this->real_subject == null) {
            $this->real_subject = new RealSubject();
        }

        $this->pre_request();
        $this->real_subject->request();
        $this->final_request();
    }

    public function pre_request(){
        echo "访问真实主题之前的预处理<br>";
    }
    
    public function final_request(){
        echo "访问真实主题之前的后续处理<br>";
    }
}

// 客户端调用
$proxy = new Proxy();
$proxy->request();