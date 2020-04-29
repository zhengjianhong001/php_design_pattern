<?php
interface Writer {
    public function write(Base_Article $obj);
}

class JSONWriter implements Writer {
    public function write(Base_Article $obj) {
       $array = array('article' => $obj);
       return json_encode($array);
   }
}

class XML1Writer implements  Writer {
    public function write(Base_Article $obj) {
        $ret = '';
        $ret .= '';
        $ret .= '' . $obj->author . '';
        $ret .= '' . $obj->date . '';
        $ret .= '';
        $ret .= '';
        return $ret;
    }
}

class Base_Article {
    public $title;
    public $author;
    public $date;
    public $category;

    public function  __construct($title, $author, $date, $category = 0) {
        $this->title = $title;
        $this->author = $author;
        $this->date = $date;
        $this->category = $category;
    }

    public function write(Writer $writer) {
        return $writer->write($this);
    }
}

class Base_Factory {
    public static function getWriter() {
        // 获取请求中的参数
        $format = $_REQUEST['format'];
        // 找到对应的格式化类
        $class =   $format . 'Writer';
        if (class_exists($class)) {
            // 返回一个 Writer 实例
            return new $class();
        }
        // 抛出异常
        throw new Exception('Unsupported format');
    }
}

$article = new Base_Article('shanhuhai', 'Steve', time(), 0);
try {
    $writer = Base_Factory::getWriter();
}
catch (Exception $e) {
    $writer = new XML1Writer();
}
echo $article->write($writer);
