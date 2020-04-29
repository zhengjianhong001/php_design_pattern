<?php
// 策略接口
interface IStrategy{
    public function algorithMethod();
}

// 具体策略实现
class ConcreteStrategy implements IStrategy{
    public function algorithMethod(){
        echo "this is ConcreteStrategy method...<br>";
    }
}

class ConcreteStrategy2 implements IStrategy{
    public function algorithMethod(){
        echo "this is ConcreteStrategy2 method...<br>";
    }
}

class ConcreteStrategy3 implements IStrategy{
    public function algorithMethod(){
        echo "this is ConcreteStrategy3 method...<br>";
    }
}

// 策略上下文
class StrategyContext{
    public $strategy = null;
    // 使用构造器注入具体的策略类
    public function __construct(IStrategy $strategy){
        $this->strategy = $strategy;
    }

    public function contextMethod(){
        // 调用策略实现的方法
        $this->strategy->algorithMethod();
    }
}

// 客户端调用
// 1. 创建具体策略实现
$strategy = new ConcreteStrategy2();
// 2. 创建策略上下文的同时，将具体的策略实现对象注入到策略上下文中
$ctx = new StrategyContext($strategy);
// 3. 调用上下文对象的方法来完成对具体策略实现的回调
$ctx->contextMethod();