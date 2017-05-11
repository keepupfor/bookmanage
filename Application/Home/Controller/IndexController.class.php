<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    private  $release_obj;
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
    /**
     * 发布模块
     *
     * 获取信息单个详细信息
     *
     */
    public function getMyReleaseInfo(){
        //检查是否通过post方法得到数据
//        checkDataGet('id');
        $where['id'] = $_GET['id'];
        $field[] = '*';
        $releaseInfo = $this->findRelease($where,$field);
        $releaseInfo['book_content'] = mb_substr($releaseInfo['remark'],0,49,'utf-8').'...';
        //多张图地址按逗号截取字符串，截取后如果存在空数组则需要过滤掉
        $releaseInfo['book_pic'] = array_filter(explode(',', $releaseInfo['book_pic']));
        if($releaseInfo!=null){
            returnApiSuccess('',$releaseInfo);
        }else{
            returnApiError( '什么也没查到(+_+)！');
        }
    }

    /**
     * 查询一条数据
     */
    public function findRelease($where,$field){
        $this->release_obj = M('details');
        if($where['status'] == '' || empty($where['status'])){
            $where['status'] = array('neq','9');
        }
        $result = $this->release_obj->where($where)->field($field)->find();
        return $result;
    }


}