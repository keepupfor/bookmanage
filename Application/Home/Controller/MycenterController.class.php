<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;

class MycenterController extends AdminbaseController
{
//    function _initialize(){
//        $user_type=get_user_type();
//        if ($user_type==1){
//            $user_model=M('users');
//        }elseif ($user_type==2){
//            $user_model=M('admin_users');
//        }
//    }
    public function index()
    {
        $this->assign("foot", 3);
        $user = get_user();
        $this->assign($user);
        $this->display();
    }

//    个人设置
    public function setting()
    {
        $user = get_user();
        $this->assign($user);
        $userid = get_uid();
        $url = get_refer_url();
        $this->assign("url", $url);
        if (IS_POST) {
            if ($user['user_type'] == 1) {
                $result = save_data($userid, 'users', $_POST);
            }
            if ($user['user_type'] == 2) {
                $result = save_data($userid, 'admin_users', $_POST);
            }
            if ($result === false) {
                $this->ajaxReturn(array('status' => 0));
            } else {
                $this->ajaxReturn(array('status' => 1));
            }
        }
        $this->display();
    }

//    修改密码
    public function change_pwd()
    {
        $user = get_user();
        $this->assign($user);
        $userid = get_uid();
        $url = get_refer_url();
        $this->assign("url", $url);
        if (IS_POST) {
            $passwd = $_POST['user_pass'];
            $spasswd = sp_password($passwd);
            if ($spasswd != $user['user_pass']) {
                $this->ajaxReturn(array('status' => -1));
            } else {
                $data['user_pass'] = sp_password($_POST['user_new_pass']);
            }
            if ($user['user_type'] == 1) {

                $result = save_data($userid, 'users', $data);
            }
            if ($user['user_type'] == 2) {
                $result = save_data($userid, 'admin_users', $data);
            }
            if ($result === false) {
                $this->ajaxReturn(array('status' => 0));
            } else {
                $this->ajaxReturn(array('status' => 1));
            }
        }
        $this->display();
    }

//    我的收藏
    public function favorites()
    {
        $userid = get_uid();
        $fa_list = M('favorites')->where("uid=$userid and status=1")->select();
        foreach ($fa_list as $k => &$v) {
            $book_id = $v['object_id'];
            $v['book_detail'] = M('details')->where("id=$book_id")->find();
            $v['addtime'] = word_time(strtotime($v['addtime']));
        }
        $this->fa_list = $fa_list;
        $url = get_refer_url();
        $this->assign("url", $url);
        $this->display();
    }

//    我的预约
    public function appointment()
    {
        $userid = get_uid();
        $ap_list = M('order')->where("user_id=$userid  and order_type=2")->select();
        foreach ($ap_list as $k => &$v) {
            $book_id = $v['book_id'];
            $v['book_detail'] = M('details')->where("id=$book_id")->find();
            $v['addtime'] = word_time(strtotime($v['addtime']));
        }
        $this->ap_list = $ap_list;
        $url = get_refer_url();
        $this->assign("url", $url);
        $this->display();
    }

//    我的借阅
    public function order()
    {
        $userid = get_uid();
        $type = $_GET['type'] ? $_GET['type'] : 1;
        $this->type = $type;
        if ($type == 1) {
            $where['status'] = array('in', '0,1,2');
        }
        if ($type == 2) {
            $where['status'] = 3;
        }
        $where['user_id'] = $userid;
        $where['order_type'] = 1;
        $or_list = M('order')->where($where)->select();
        foreach ($or_list as $k => &$v) {
            $book_id = $v['book_id'];
            $v['book_detail'] = M('details')->where("id=$book_id")->find();
            $v['addtime'] = word_time(strtotime($v['addtime']));
        }
        $this->or_list = $or_list;
        $url = get_refer_url();
        $this->assign("url", $url);
        $this->display();
    }

//    我的评论
    public function comment()
    {
        $userid = get_uid();
        $cm_list = M('comments')->where("uid=$userid and status=1")->select();
        foreach ($cm_list as $k => &$v) {
            $book_id = $v['post_id'];
            $v['book_detail'] = M('details')->where("id=$book_id")->find();
            $v['addtime'] = word_time(strtotime($v['addtime']));
        }
        $this->cm_list = $cm_list;
        $url = get_refer_url();
        $this->assign("url", $url);
        $this->display();
    }

//    积分
    public function corn()
    {
        $userid = get_uid();
        $corn_list = M('order')->where("user_id=$userid  and status=3")->select();
        foreach ($corn_list as $k => &$v) {
            $book_id = $v['book_id'];
            $v['book_detail'] = M('details')->where("id=$book_id")->find();
            $v['addtime'] = word_time(strtotime($v['addtime']));
        }
        $this->corn_list = $corn_list;
        $url = get_refer_url();
        $this->assign("url", $url);
        $this->display();
    }

//      留言
    public function guestbook()
    {
        $user=get_user();
        $gb_list=M('guestbook')->where("status=1 and mobile=".$user['mobile'])->select();
        foreach ($gb_list as $k => &$v) {
            $v['addtime'] = word_time(strtotime($v['addtime']));
        }
        $this->gb_list=$gb_list;
        $url = get_refer_url();
        $this->assign("url", $url);
        $this->display();
    }
}