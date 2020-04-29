<?php
/*  需求：
*   商场根据不同的客户进行打折
*   新用户 9折
*   老用户 8折
*   VIP 会员 5折
*/ 

// 策略接口
interface IStrategy{
    public function get_price();
}

class NewUserStrategy implements IStrategy{
    public function get_price(){
        // 新用户处理逻辑
        return '新用户价格';
    }
}

class OldUserStrategy implements IStrategy{
    public function get_price(){
        // 老用户处理逻辑
        return '老用户价格';
    }
}

class VIPUserStrategy implements IStrategy{
    public function get_price(){
        // VIP用户处理逻辑
        return 'VIP用户价格';
    }
}
// 新增加 MVP 用户
class MVPUserStrategy implements IStrategy{
    public function get_price(){
        // VIP用户处理逻辑
        return 'MVP用户价格';
    }
}

// 策略上下文
class StrategyContext{

    private $user_strategy = null;

    public function __construct(IStrategy $user_strategy){
        $this->user_strategy = $user_strategy;
    }

    public function get_price(){
        echo $this->user_strategy->get_price();
    }

}

// 客户端调用
$user = 'MVP用户';
if ($user == '新用户'){
    $user_strategy = new NewUserStrategy();
}
else if ($user == '老用户'){
    $user_strategy = new OldUserStrategy();
}
else if ($user == 'VIP用户'){
    $user_strategy = new VIPUserStrategy();
}
else if ($user == 'MVP用户'){
    $user_strategy = new MVPUserStrategy();
}

$strategy = new StrategyContext($user_strategy);
$strategy->get_price();


// 优点：增加新的用户类型时，不需要修改原有的类，只需要增加一个 MVPUserStrategy 类，然后在客户端调用即可，符合设计模式的开闭原则