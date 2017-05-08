<?php
namespace Home\Controller;
use Think\Controller;
class BookadminController extends AdminbaseController  {
    public function index(){
        $url=$_SERVER['HTTP_REFERER'];
        $this->assign("url",$url);
         $isbn=I('isbn');
         $detail=M('details')->where("isbn=$isbn")->find();
        $book_id=$detail['id'];
        $userid=get_uid();
        $is_order=M('order')->where("user_id=$userid and book_id=$book_id and status in(0,1,2)")->find();
        $is_favorite=M('favorites')->where("uid=$userid and object_id=$book_id and status=1")->find();
        $this->is_favorite=0;
        if ($is_favorite){
            $this->favorite=$is_favorite;
            $this->is_favorite=1;
        }

        if (!empty($is_order)){
            $is_order['back_time2']=str_replace('-','/',$is_order['back_time']);
            $this->order_one=$is_order;
            $this->is_order=1;
        } else{
            $this->is_order=0;
        }
        if ($detail['status']==1){
            $handle['title']='下架';
            $handle['result']=2;
        }
        if ($detail['status']==2){
            $handle['title']='上架';
            $handle['result']=1;
        }
        $this->handle=$handle;
        $this->info=$detail;
        $terms=get_terms();
        $this->terms=$terms;
        $this->display();
    }
    public function order_book(){
        $_POST['addtime']=date('Y-m-d H:i:s');
        $result=M("order")->add($_POST);
        if ($result!=false){
            if ($_POST['order_type']==1){
            $re=reduce_sum($_POST['book_id']);
                if ($re!=false){
                    $this->ajaxReturn(array('status' => 1));
                }else{
                    $this->ajaxReturn(array('status' => 0));
                }
        }else{
                $this->ajaxReturn(array('status' => 1));
            }
        }else{
            $this->ajaxReturn(array('status' => 0));
        }


    }
    public function get_book(){//取书
        $id=$_POST['id'];
        $now=date('Y-m-d H:i:s');
        $order_one=M("order")->find($id);
        if ($now>$order_one['limit_time']){
            $data['status']=4;
            M("order")->where("id=$id")->save($data);
            add_sum($order_one['book_id']);
            $this->ajaxReturn(array('status' => -1,'info'=>'已过取书时间，本次借阅已取消'));
            exit();
        }else{
            $_POST['start_time']=$now;
            $_POST['back_time']=date('Y-m-d H:i:s',strtotime("+7 days"));
            unset($_POST['id']);
            $result=M("order")->where("id=$id")->save($_POST);
        }

        if ($result!=false){
                $this->ajaxReturn(array('status' => 1));
        }else{
            $this->ajaxReturn(array('status' => 0));
        }

    }
    public function check_time(){
        $now=strtotime(date('Y-m-d',time()));
        $back_time=strtotime(date('Y-m-d',strtotime($_POST['back_time'])));
        $over_time= round(($now-$back_time)/3600/24);
        if ($over_time>0){

            $this->ajaxReturn(array('status' => 0,'over_time'=>$over_time,'price'=>$over_time));
        }else{
            $this->ajaxReturn(array('status' => 1));
        }
    }
    public function back_book(){//还书
        $id=$_POST['id'];
        $book_id=$_POST['book_id'];
        $userid=get_uid();
        $save['back_real_time']=date('Y-m-d H:i:s');
        $save['status']=$_POST['status'];
        $result=M("order")->where("id=$id")->save($save);
        if ($result!=false){
            add_sum($book_id);
            add_score($userid,100);
             $this->ajaxReturn(array('status' => 1));
            }
        else{
            $this->ajaxReturn(array('status' => 0));
        }


    }
}