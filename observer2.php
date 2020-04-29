<?php
// PHP 内置
// // 主题 被观察者
// interface SplSubject {
//     public function attach(SplObserver $observer); //注册观察者到当前主题
//     public function detach(SplObserver $observer); //从当前主题删除观察者
//     public function notify(); //主题状态更新时通知所有的观察者做相应的处理
// }

// // 观察者
// interface SplObserver {
//     public function update(SplSubject $subject); //注册观察者到当前主题
// }

/**
 * 主题类（被观察者相当于一个主题，观察者订阅这个主题）
 * 当我们注册用户成功的时候想发送 email 和 sms 通知用户注册成功
 * 则 可以将 SendEmail 和 SendSms 作为观察者
 * 注册到 User 的观察者中
 * 当 User register 成功时 notify 给 observers
 * 各 observe 通过约定的 update 接口进行相应的处理 发邮件或发短信
 */
class User implements SplSubject
{
    public $name;
    public $email;
    public $mobile;

    /**
     * 当前主题下的观察者集合
     * @var array
     */
    private $observers = [];

    /**
     * 模拟注册
     * @param  [type] $name   [description]
     * @param  [type] $email  [description]
     * @param  [type] $mobile [description]
     * @return [type]         [description]
     */
    public function register($name, $email, $mobile)
    {
        $this->name   = $name;
        $this->email  = $email;
        $this->mobile = $mobile;

        //business handle and register success
        $reg_result = true;
        if ($reg_result) {
            $this->notify(); // 注册成功 所有的观察者将会收到此主题的通知
            return true;
        }

        return false;
    }

    /**
     * 当前主题注册新的观察者
     * @param  SplObserver $observer [description]
     * @return [type]                [description]
     */
    public function attach(SplObserver $observer)
    {
        return array_push($this->observers, $observer);
    }

    /**
     * 当前主题删除已注册的观察者
     * @param  SplObserver $observer [description]
     * @return [type]                [description]
     */
    public function detach(SplObserver $observer)
    {
        $key = array_search($observer, $this->observers, true);

        if (false !== $key) {
            unset($this->observers[$key]);
            return true;
        }

        return false;
    }

    /**
     * 状态更新 通知所有的观察者
     * @return [type] [description]
     */
    public function notify()
    {
        if (! empty($this->observers)) {
            foreach ($this->observers as $key => $observer) {
                $observer->update($this);
            }
        }

        return true;
    }

}

/**
 * 观察者通过 update 来接受主题的更新通知
 */
class EmailObserver implements SplObserver
{
    /**
     * 观察者接收主题通知的接口
     * @param  SplSubject $user [description]
     * @return [type]           [description]
     */
    public function update(SplSubject $user)
    {
        echo "send email to " . $user->email . "<br>";
    }
}

class SmsObserver implements SplObserver
{
    public function update(SplSubject $user)
    {
        echo "send sms to " . $user->mobile . "<br>";
    }
}

// User 主题
$user = new User();

// 为 user 注册 Email 观察者 (Email 观察者订阅 User 主题)
$emailObserver = new EmailObserver();
$user->attach($emailObserver);

// 为 user 注册 Sms 观察者 (Sms 观察者订阅 User 主题)
$smsObserver = new SmsObserver();
$user->attach($smsObserver);

// 从 user 上删除 Sms 观察者 (Sms 观察者取消订阅 User 主题)
//$user->detach($smsObserver);

// register 中会根据注册结果通知观察者 观察者做相应的处理
$user->register("big cat", "32448732@qq.com", "1888888888");