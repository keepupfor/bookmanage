<?php
namespace Home\Controller;

use Think\Controller;

class LibraryadminController extends AdminbaseController
{
    public function index()
    {

        $this->assign("foot", 2);
        $swiper_img = M('news')->where("type=0 and status=1 and img is not null")->order("is_top desc ,addtime desc")->limit(4)->getField("img", true);
        $this->swiper_img = $swiper_img;
        $this->display();
    }

    public function library_information()
    {
        $type = $_GET['type'];//信息类型
        $this->type = $type;
        $title = get_type($type);
        $this->assign("title", $title);
        $info = M('news')->where("type=$type and status=1")->order("is_top desc ,addtime desc")->select();
        $this->assign("info", $info);
        $this->display();
    }

    public function library_information_detail()
    {//管内信息(身份不同，功能不同，管理员可以修改内容，会员只能查看)
        $id = $_GET['id'];//信息类型
        $this->assign("id", $id);
        $info = M('news')->where("id=$id")->find();
        $type = $info['type'];
        $this->type = $type;
        $title = get_type($type);
        $this->title = $title;
        if ($info['is_top'] == 1) {
            $handle['title'] = '取消置顶';
            $handle['result'] = 0;
        } elseif ($info['is_top'] == 0) {
            $handle['title'] = '置顶';
            $handle['result'] = 1;
        }
        $this->handle = $handle;
        $this->assign("info", $info);
        $this->display();
    }

    public function book_manage()
    {
        $status = $_GET['status'] ? $_GET['status'] : 1;
        $where['status'] = $status;
        $this->status = $status;
        $book_list = M('details')->where($where)->select();
        $this->book_list = $book_list;
        $this->display();
    }

    public function reader_manage()
    {
        $this->title = "借阅管理";
        $where['status'] = 0;
        $where['order_type'] = 1;
        $orders = M('order')->where($where)->select();
        foreach ($orders as $k => &$v) {
            $book_id = $v['book_id'];
            $user_id = $v['user_id'];
            $v['username'] = M('users')->where("id=$user_id")->getField("user_name");
            $v['book_detail'] = M('details')->where("id=$book_id")->find();
        }
        $this->orders = $orders;
        if (IS_POST) {
            $id = $_POST['id'];
            $save['limit_time'] = date('Y-m-d H:i:s', strtotime(" +2 hours "));
            $save['status'] = 1;
            $ret = M('order')->where("id=$id")->save($save);
            if ($ret != false) {
                $this->ajaxReturn(array('status' => 1));
            } else {
                $this->ajaxReturn(array('status' => 0));
            }
        }

        $this->display();
    }

    public function appointment_manage()
    {
        $this->title = "预约管理";
        $where['status'] = 0;
        $where['order_type'] = 2;
        $orders = M('order')->where($where)->select();
        foreach ($orders as $k => &$v) {
            $book_id = $v['book_id'];
            $user_id = $v['user_id'];
            $v['username'] = M('users')->where("id=$user_id")->getField("user_name");
            $v['book_detail'] = M('details')->where("id=$book_id")->find();
        }
        $this->orders = $orders;
        if (IS_POST) {
            $id = $_POST['id'];
            $num = $_POST['num'];
            if ($num < 1) {
                $this->ajaxReturn(array('status' => -1));
                exit();
            }else{
                $save['limit_time'] = date('Y-m-d H:i:s', strtotime(" +2 hours "));
                $save['status'] = 1;
                $save['order_type'] = 1;
                $ret = M('order')->where("id=$id")->save($save);
                if ($ret != false) {
                    reduce_sum($_POST['book_id']);
                    $this->ajaxReturn(array('status' => 1));
                } else {
                    $this->ajaxReturn(array('status' => 0));
                }
            }

        }

        $this->display();
    }
   public function book_comment()
   {
       $this->title = "书评管理";
       $where['status'] = 1;
       $comments = M('comments')->where($where)->select();
       foreach ($comments as $k => &$v) {
           $book_id = $v['post_id'];
           $user_id = $v['uid'];
           $v['username'] = M('users')->where("id=$user_id")->getField("user_name");
           $v['book_detail'] = M('details')->where("id=$book_id")->find();
       }
       $this->comments = $comments;

       $this->display();
   }
    public function book_message()
    {
        $this->title = "留言管理";
        $where['status'] = 1;
        $guestbook = M('guestbook')->where($where)->select();
        foreach ($guestbook as $k => &$v) {
            $v['addtime'] = word_time(strtotime($v['addtime']));
        }
        $this->guestbook = $guestbook;

        $this->display();
    }
    public function book_terms()
    {
        $this->title = "分类管理";
        $where['status'] = 1;
        $terms = M('terms')->where($where)->select();
        foreach ($terms as $k => &$v) {
            $v['addtime'] = word_time(strtotime($v['addtime']));
        }
        $this->terms = $terms;

        $this->display();
    }
    public function user_manage(){
        if (IS_POST){
            $id=$_POST['id'];
            $user=M('users')->where("id=$id")->find();
            $this->ajaxReturn(array('status'=>1,'user'=>$user));
        }
        $this->title = "会员管理";
        $users=M('users')->order("user_status desc")->select();
        foreach ($users as $k=>&$v){
            if ($v['user_status']==1)
            {
                $v['title']='禁用';
                $v['result']=0;
            }
            if ($v['user_status']==0)
            {
                $v['title']='启用';
                $v['result']=1;
            }

        }
        $this->users=$users;
        $this->display();
    }
    public function set_qrcode()
    {
        $isbn = trim($_POST['isbn']);
        $url = "http://" . $_SERVER['HTTP_HOST'] . __ROOT__ . "/home/libraryadmin/get_book?isbn=" . $isbn;
        $img = qrcode($url, 4);
        $this->ajaxReturn(array('base' => $img));
    }

    public function get_book()
    {
        $isbn = I('isbn');
        $model = M('details');
        $find = $model->where("isbn=$isbn")->find();
        if (empty($find)) {
            $book = get_book_data($isbn);
            if ($book) {
                $data = array(
                    'book_name' => $book->getTitle(),
                    'book_pic' => $book->getCover(),
                    'book_price' => $book->get_Price(),
                    'book_content' => $book->getBookInfo(),
                    'book_author' => $book->getAuthor(),
                    'isbn' => $book->getISBN(),
                    'book_publisher' => $book->get_Publisher(),
                    'book_pubdate' => $book->get_Pubdate(),
                    'addtime' => date('Y-m-d H:i:s', time()),
                );
                $result = $model->add($data);
                if ($result) {
                    $this->redirect('bookadmin/index', array('isbn' => $isbn));
                } else {
                    echo "<script>alert('系统错误，请稍后重试！');window.history.go(-1)</script>";
                    exit;
                }
            } else {
                echo "<script>alert('未查询到图书，请输入有效的ISBN码！');window.history.go(-1)</script>";
                exit;
            }
        } else {
            $this->redirect('bookadmin/index', array('isbn' => $isbn));
        }

    }
}


