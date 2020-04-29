<?php
// 如果后续需要支持更多的格式，需要修改 write 方法，添加更多的 case 选项
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

    public function write($type) {
        $ret = '';
        switch($type) {
            case 'XML':
                $ret = '';
                $ret .= '';
                $ret .= '' . $this->author . '';
                $ret .= '' . $this->date . '';
                $ret .= '';
                $ret .= '';
                break;
            case 'JSON':
                $array = array('article' => $this);
                $ret = json_encode($array);
                break;
        }
        return $ret;
    }
}

$article = new Base_Article("hello", "Ryan", date('Y-m-d H:i:s'));
echo $article->write('JSON');
