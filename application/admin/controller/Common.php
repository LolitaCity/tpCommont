<?php
/**
 * 权限认证
 * 
 * @author Lee<a605333742@gmail.com>
 * @date 2018-08-31
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Common extends Controller{
    protected $auth;
    /*
     * 构造函数，继承父类构造函，数权限验证
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
        if(session('isOut')!=NULL && session('isOut')==1){
            $this->redirect('auth/timeOut');
        }
        if(session(config('USER_AUTH_KEY'))==NULL || empty(session(config('USER_AUTH_KEY')))){
            $this->redirect('/admin/Auth/index');
        }       
        if(in_array(request()->module(),config('deny_module_list'))){
            return json(jsonData('无访问权限',300));
        }
        //权限验证
        $this->auth=new Auth();
        if(strtolower(request()->controller())!='index'){            
            $nodeList= $this->auth->ckeckAuth();
            $nodes=array();
            foreach ($nodeList as $vo){
                $nodes[]=$vo['controller'];
            }
            if(!in_array(request()->controller(),$nodes)){
                return json(jsonData('无访问权限',300));
            }
        }
    }
    
    /*
     * 根据表单生成查询条件-进行列表过滤
     *
     * @param string $name 数据对象名称
     *
     * @return array
     */
    public function _search($model=''){
        $map        =array ();
        $fieldArray =$model->gettablefields()?$model->gettablefields():array();
        //进行精确查询的字段
        $notLikeArray = array(
            'p_id',
        );
        foreach ( $fieldArray as $key => $val ) {				
            if (!input($val)|| input($val) == ''){
                continue ;
            }
            if(date('Y-m-d',strtotime(input($val)))==input($val,'','trim')){
                //时间处理
                $map[]  =[$val,'between',timeTotimestamp(input($val))];
            }elseif(in_array($val, array_diff($fieldArray,$notLikeArray))){
                //特别指定一些字段进行模糊查询
                $map[]  =[$val,"LIKE",'%'.trim(input($val)).'%'];
            } else {
                //精确查询
                $map[] =[$val,'=',input($val)];
            }
        }
        return $map;
    }
    
    /*
     * 根据表单生成查询条件-进行列表过滤
     *
     * @param object 	$model 		数据对象
     * @param array 	$map 		过滤条
     * @param string 	$sortBy 	排序
     * @param boolean 	$asc 		是否正序
     * @param string 	$countPk 	主键
     * @param string 	$field 		提取字段
     *
     * @return array    #
     */
    public function _list($model, $map, $sortBy='id',$asc =TRUE, $countPk="id", $field="*") {        
        //验证传参的有效性
        $asc = $asc?true:false;
        $countPk = $model->getPk()?$model->getPk():$countPk;
        //排序字段 默认为主键名
        $orderSign  =TRUE;
        $order  =input('_order');
        if(empty($order)){
            $order  =$sortBy?$sortBy:$countPk;  
            $orderSign=$sortBy?(is_array($sortBy)?FALSE:TRUE):$orderSign;
        }
        //排序方式默认按照倒序排列
        //接受 sort参数 0 表示倒序 非0都 表示正序        
        if($orderSign){
            $sort   =$asc? 'asc' : 'desc';
            $sort   =input('_sort')?(input('_sort') == 'asc' ? 'asc' : 'desc'):$sort;
        }        
        //取得满足条件的记录数
        //过滤空字段
        $param=array_filter(array_merge(input(),$map));
        $param['page']=1;        
        if(isset($param['pageNum'])&&!empty($param['pageNum'])){
            $param['page']=$param['pageNum'];
            unset($param['pageNum']);
        }
        $listRows=input('numPerPage')?input('numPerPage'):20;
        $voList = $model->where($map)->group($countPk)->field($field)->order($order.' '.$sort)->paginate($listRows,false,$param);         
        $sortImg =$sort; //排序图标
        $sortAlt =$sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
        $sort = $sort == 'desc' ? 1 : 0; //排序方式
        //模板赋值显示
        $this->assign ( 'list', $voList );
        $this->assign ( 'sort', $sort );
        $this->assign ( 'order', $order );
        $this->assign ( 'sortImg', $sortImg );
        $this->assign ( 'sortType', $sortAlt );
        $this->assign ( 'totalCount', $voList->total());
        $this->assign ( 'numPerPage', $listRows );
        $this->assign ( 'currentPage', !empty(input(config('VAR_PAGE')))?input(config('VAR_PAGE')):1);        
    }  
    
    /*
     * 显示首页也
     * 
     * @return #
     */
    public function index($db='',$sort='id',$sortBy=TRUE){
        $model  =$db?Db::name($db):Db::name(request()->controller());        
        $map    =self::_search($model);        
        $map[]  =['status','=',1];
        $sort   =strtolower(request()->controller())=='node'?'path':$sort;
        self::_list($model,$map,$sort,$sortBy);
        return $this->fetch(request()->action());
    }
    
    /*
     * 显示新增编辑页面
     * 
     * @return #
     */
    public function show(){        
        if(input("sign")){
            $this->assign("_sign",input("sign",'','code'));
        }
        if(input("id")){
            $model  =input('db')?Db::name(input('db','','code')):(Db::name(request()->controller())); 
            $id =is_numeric(input($model->getPk()))?input($model->getPk()):input($model->getPk(),'','code');
            $this->assign('vo', $model->find($id));
        }
        return $this->fetch();
    }    
    
    /*
     * 编辑数据
     * 
     * @return # 
     */
    public function edit(){
        if(input('id')){
            return self::update()?json(jsonData('修改成功',201)):json(jsonData('修改失败',301));
        }
        return self::insert()?json(jsonData('新增成功',201)):json(jsonData('新增失败',301));
    }    
    
    /*
     * 新增数据
     * 
     * @return #
     */
    public function insert(){
        $dbName =input("db")? input("db"): request()->controller();
        $model  =Db::name($dbName);        
        $field=$model->getTableFields(); 
        //字段过滤
        $insData=array();
        foreach (array_filter(input()) as $k=>$v){
            if(in_array($k,$field)){
                $insData[$k]=$v;
            }
        }
        if (!$newId=$model->insertGetId($insData)) {            
            return FALSE;
        }
        $content= session('user.name').'在数据库 '.$dbName.' 新增了一条数据';
        if($this->auth->addLog(1,$dbName,$content)){
            return $newId;
        }
        return FALSE;
    }
    
    /*
     * 更新数据
     * 
     * $return #
     */
    public function update(){
        $dbName =input("db")?input("db"):request()->controller();  
        $model  =Db::name($dbName);
        $model->startTrans();
        //判断是否有图片存在，标签图片是否更改
        //$imageIcon  =$model->find(input('id'));
        $condition  =[$model->getPk()=>input("id")];
        if(self::invaImages($dbName,$condition)==FALSE){
            $model->rollback();
            return FALSE;
        }       
        // 更新数据
        $upData=array();
        foreach(array_filter(input()) as $k=>$v){
            if(in_array($k,$model->getTableFields())){
                $upData[$k]=$v;
            }
        }
        $result =$model->where($condition)->update($upData);
        if (false == $result) {       
            $model->rollback();
            return FALSE;
        }
        $contents=session('user.name').'编辑的数据表'.$dbName.'中主键为'.$model->getPk().' 的数据';            
        if(!$this->auth->addLog(1,$dbName,$contents)){
            $model->rollback();
            return FALSE;  
        }
        $imgPath     ='/static/public/upload/';
        if(session("oldImg")!=null && file_exists($imgPath.session("oldImg"))){
            unlink($imgPath.session("oldImg"));
        }            
        if(session('oldSmallImg')!=null && file_exists($imgPath.session('oldSmallImg'))){
            unlink($imgPath.session("oldSmallImg"));
        }
        $model->commit();
        return TRUE;
    }
    
    /*
     * 删除数据
     * 
     * @return #
     */
    public function del(){
        if(method_exists($this,'beforeDel')){
            if($this->beforeDel()!==TRUE){
                return json(jsonData($this->beforeDel(),300));
            }
        }
        //删除指定记录
        $dbName =input("db")?input("db",'','code'):request()->controller();
        $model  =Db::name($dbName);        
        $model->startTrans();
        $pk = $model->getPk();
        $id =is_array(input($pk))?input($pk):input($pk,'','code');
        if (!$id) {
            $model->rollback();
            return json(jsonData('非法操作',300));
        }       
        $condition  =[$pk=>$id];
        $setField   =$model->where($condition)->update(['status'=>0]);
        if($setField==FALSE){
            $model->rollback();
            return json(jsonData('删除失败！',300));
        }
        //查询是否存在图片，存在图片则将图片移到过期图片
        if($this->invaImages($dbName,$condition)==FALSE){
            $model->rollback();
            return json(jsonData("参数错误，删除失败",300));
        } 
        $ids=is_array($id)?implode(',',$id):$id;
        $contents=session('user.name')."删除了数据表 ".$dbName. " 中主键为 ".$ids ." 的数据";
        if($this->auth->addLog(1,$dbName,$contents)){
            $model->commit();
            return json(jsonData("删除成功"));
        }
        $model->rollback();
        return json(jsonData("删除失败！"));
                
    }
    
    /*
     * 彻底删除记录（一般情况下不要使用）
     * 
     * @return bool
     */
    public function delete($imagePath=''){
        //删除指定记录
        $dbName =input("db","","code")?input("db","","code"): request()->controller();
        $model  =Db::name($dbName);
        $pk     =$model->getPk();
        $id =is_array(input($pk))?input($pk):input($pk,'','code');
        if(!$id){
            return json(jsonData('非法操作',300));
        }
        $condition  =[$pk=>$id];
        if (false == $model->where($condition)->delete()) {
            return json(jsonData('删除失败!',300));
        }
        if($dbName=="Invaimg"){
            //如果操作的是清理图片表，那么就要执行清理
            $imgList=$model->where($condition)->column('imagepath');
            $imgPath=array();
            $imagePath=$imagePath?$imagePath:'/static/admin/img/';
            foreach($imgList as $vo){
                $imgPath[]  =$vo;
            }
            if($imgPath!=''){
                for($i=0;$i<=count($imgPath);$i++){
                    unlink($imagePath.$imgPath[$i]);
                }
            }
        }
        return json(jsonData('删除成功!'));
    }
    
    /*
     * 图片上传
     * 
     * @return #
     */
    public function upImg($rootPath=''){
        $ext=array('ico','jpg','png','gif','jpeg','doc','docx','xls','xlsx','pdf','txt','ppt','pptx'); //允许上传的文件后缀
        $file = request()->validate(['ext'=> implode(',',$ext)])->file('image');
        if(!$file){
            $file->getError();
        }
        if(input("ajax")==1){
            $savePath   ='title/';
        }else if(input("ajax")==2){
            $savePath   ='top/';
        }else if(input("ajax")==3){
            $savePath   ='section/';
        }else if(input("ajax")==4){
            $savePath   ='user/';
        }else if(input("ajax")==5){
            $savePath   ='club/';
        }else if(input("ajax")==6){
            $savePath   ='data/';
        }else if(input("ajax")==7){
            $savePath   ='mod/';
        }else if(input("ajax")==8){
            $savePath   ="club_img/";
        }else if(input("ajax")==9){
            $savePath   ="answer/";
        }else{
            $savePath   ='common/';
        }
        $rootPath=$rootPath?$rootPath:'/static/admin/file/';
        $info=$file->move($rootPath.$savePath);
        if(!$info){
           return FALSE;
        }
        if(in_array($info->getExtension(),array("jpg,jpeg,png,gif"))){
            $image = \think\Image::open($rootPath.$savePath.$info->getSaveName());
            // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
            $image->thumb(150,150,\think\Image::THUMB_CENTER)->save($rootPath.'small/'.$savePath);
        }
        return $info?$info:FALSE;
    }
    
    /*
     * 更改状态
     * 
     * @return #
     */
    public function changeStatus(){ 
        $dbName =input("db")?input("db","","code"):request()->controller();
        $model  =Db::name($dbName);
        $pk = $model->getPk();
        $id =is_array(input($pk))?input($pk):input($pk,'','code');
        if(!$id){
            return json(jsonData('非法操作!',300));
        }
        $condition  =[$pk=>$id];
        $result     =$model->where($condition)->setField('status',input("status","","code"));
        $contents=session("user.name")."修改了数据表".$dbName.'中主键为'.$pk.'的数据状态';
        if ($result !== false && $this->auth->addLog(1,$dbName,$contents)) {
            return json(jsonData('状态修改成功!'));
        }
        return json(jsonData('状态修改失败!',300));
    }
    
    /*
     * 修改和删除数据时，如果有图片，则把图片存在过期图片表中
     * 
     * @return #
     */
    public function invaImages($dbName,$condition){
        $imaPath    =array();
        $smallImg   =array();
        //查询被删除的数据中省份存在图片，如果存在图片，则把图片路径提出来，以便将来清理
        $delList=Db::name($dbName)->where($condition)->select();
        if(!$delList){
            return TRUE;
        }
        foreach($delList as $vo){
            if(isset($vo['image']) && !empty($vo['image'])){
                $imaPath[]  =$vo['image'];
            }
            if(isset ($vo['img']) && !empty ($vo['img'])){
                $imaPath[]  =$vo['img'];
            }
            if(isset ($vo['icon'])&& !empty ($vo['icon'])){
                $imaPath[]  =$vo['icon'];
            }
            if(isset ($vo['photo'])&& !empty ($vo['photo'])){
                $imaPath[]  =$vo['photo'];
            }
            if(isset ($vo['logo'])&&!empty ($vo['logo'])){
                $imaPath[]  =$vo['logo'];
            }
            if(isset($vo['small_image'])&& !empty($vo['small_image'])){
                $smallImg[] =$vo['small_image'];
            }
            if(isset($vo['small_img'])&&!empty($vo['small_img'])){
                $smallImg[] =$vo['small_img'];
            }
            if(isset($vo['small_photo'])&&!empty($vo['small_photo'])){
                $smallImg[] =$vo['small_photo'];
            }
        }                
        $imaPaths   =array_merge($imaPath,$smallImg);
        if($imaPaths){
            $invaImg=Db::name("Invaimg");
            for($i=0;$i<count($imaPaths);$i++){
                $map["db_name"]     =$dbName;
                $map['imagepath']   =$imaPaths[$i];
                if(!$invaImg->insert($map)){
                    continue;
                }
            }
            return TRUE;
        }
        return TRUE;
    }    
}

