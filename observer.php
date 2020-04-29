<?php
// 观察者模式
// 行为模型
// Observer观察者抽象接口
interface IObserver {
    public function update($data);
}

// 具体的观察者
class LogObserver implements IObserver {
    public function update($data) {
        echo 'write log to file.';
        echo "<br>";
    }
}

// 具体的观察者
class SmsObserver implements IObserver {
    public function update($data) {
        echo 'send sms';
        echo "<br>";
    }
}

// 抽象主题类
abstract class ISubject {
    private  $observers = [];//观察者集合

    public function attach(IObserver $observer){
        array_push($this->observers, $observer);
    }

    public function detach(IObserver $observer){
        return false;
    }

    public function nodifyObservers($data){
        // 判断是否触发观察者
        if (count($this->observers) == 0) return false;
        foreach ($this->observers as $observer) {
            $observer->update($data);
        }
    }

    public abstract function change($data);

}

// 实现了抽象主题的订单主题
class OrderSubject extends ISubject {
    public function change($data) {
        // 订单状态入库，如果成功则触发观察者
        $this->nodifyObservers($data);
    }
}

$order_subject = new OrderSubject();
$order_subject->attach(new LogObserver());//写日志
$order_subject->attach(new SmsObserver());//发短信
$order_subject->change(['oid' => '1', 'flag' => 3]);//订单状态变化，触发观察者