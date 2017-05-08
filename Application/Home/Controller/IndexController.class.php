<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->assign("foot",1);
        if (isset($_REQUEST['book_name'])){
            $name=$_REQUEST['book_name'];
            $where['book_name|book_publisher|book_author']=array('like',"%{$name}%");
        }
        if (isset($_REQUEST['book_type'])){
            $where['book_type']=$_REQUEST['book_type'];
        }
        $this->name=$name;
        $where['status'] = 1;
        $book_list = M('details')->where($where)->select();
        $this->book_list = $book_list;
        $terms = M('terms')->where("status=1")->select();
        $this->terms = $terms;
        $this->display();
    }
}