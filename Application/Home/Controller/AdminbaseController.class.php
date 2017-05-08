<?php
namespace Home\Controller;
use Think\Controller;
class AdminbaseController extends Controller {
    public function __construct()
    {
        parent::__construct();
        if (!check_login()){
            $this->error("请先登录",U('Public/login'));
        }
        $user=get_user();//取用户信息
        $this->assign($user);
    }
}