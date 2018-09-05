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

class Common extends Controller{
    protected $auth;
    /*
     * 构造函数，继承父类构造函，数权限验证
     * 
     * @return #
     */
    public function __construct(\think\App $app = null) {
        parent::__construct($app);
        if(session(config('USER_AUTH_KEY'))==NULL || empty(session(config('USER_AUTH_KEY')))){
            $this->redirect('Auth/index');
        }       
        if(in_array(request()->module(),config('deny_module_list'))){
            $this->error('无访问权限');
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
                $this->error('无访问权限');
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
    public function _search($name=''){
        //生成查询条件
        $model      =$name?db($name):db(request()->controller());        
        $map        =array ();
        $fieldArray =array();
        if ($model->gettablefields()){
            $fieldArray =$model->getTableFields();
        }
        foreach ( $fieldArray as $key => $val ) {				
            if (input($val)&& input($val) != ''){
                //特别指定一些字段进行模糊查询
                $likeArray = array(
                    'name',
                    'title',
                    'username',
                    'nickname',
                    'remark',
                    'content',
                    'desc_',
                    'controller',
                    'action',
                    'result',
                    'add_time',
                    'email',
                    'reseller_company_name',
                    'reseller_amazon_name',
                    'reseller_contact_name',
                    'reseller_contact_email',
                    'reseller_name',
                    'product_name',
                    'product_url'
                );
                if (in_array($val, $likeArray)){
                    $map[]  =[$val,"LIKE",'%'.trim(input($val)).'%'];
                } else {
                    //精确查询
                    $map[] =[$val,'=',input($val)];
                }
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
    public function _list($model, $map, $sortBy='',$asc =TRUE, $countPk="id", $field="*") {        
        //验证传参的有效性
        $asc = $asc?true:false;
        $countPk = $model->getPk()?$model->getPk():"id";
        //排序字段 默认为主键名
        $orderSign  =TRUE;
        $order  =input('_order');
        if(empty($order)){
            $order  =$sortBy?$sortBy:$countPk;     
            if(!empty($sortBy)){
                $orderSign=(is_array($sortBy))?FALSE:TRUE;                
            }
        }
        //排序方式默认按照倒序排列
        //接受 sort参数 0 表示倒序 非0都 表示正序        
        if($orderSign){
            $sort = $asc? 'asc' : 'desc';
            if (input('_sort')) {
                $sort = input('_sort') == 'asc' ? 'asc' : 'desc'; //zhanghuihua@msn.com
            }
        }        
        //取得满足条件的记录数
        $param=array_filter(array_merge(input(),$map));
        $param['page']=1;
        if(isset($param['pageNum'])&&!empty($param['pageNum'])){
            $param['page']=$param['pageNum'];
            unset($param['pageNum']);
        }
        $listRows=input('numPerPage',20);
        if($listRows==0||empty($listRows)||$listRows==null){
            $listRows=20;
        }  
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
        $map = $this->_search($db);        
        $map[]  =['status','=',1];
        $model=$db?db($db):db(request()->controller());        
        $this->_list($model, $map,$sort,$sortBy);       
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
            $model  =input('db')?db(input('db','','code')):db(request()->controller());            
            $id = input($model->getPk());
            if(!is_numeric($id)){
                $id=code($id);
            }
            $vo = $model->find($id);
            $this->assign('vo', $vo);
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
            if(self::update()){
                $this->success("修改成功");
            }
            if(!empty(self::update()['name'])){
                $this->error(self::update()['name']);
            }
            $this->error("修改失败");
        }
        if(self::insert()=="true"){
            $this->success("新增成功");
        }
        if(!empty(self::insert()['name'])){
            $this->error(self::insert()['name']);
        }
        $this->error("新增失败");
    }    
    
    /*
     * 新增数据
     * 
     * @return #
     */
    public function insert(){
        $dbName =input("db")? input("db"): request()->controller();
        $model  =db($dbName);        
        $field=$model->getTableFields();        
        //$field  =$model->getDbFields();
        //节点表如果没有指定排序，默认在当前二级排序下+1
        if(in_array('ord',$field) && (empty(input('ord'))||input('ord')==0)){
            $top=$model->where(array('status'=>1))->max('ord');
            input('ord',$top+1);
        }
        $list=$model->allowField(true)->insert(input());
        //保存当前数据对象
        if ($list == false) {            
            return FALSE;
        } 
        $content= session('user.name').'在数据库 '.$dbName.' 新增了一条数据';
        if($this->auth->addLog(1,$dbName,$content)){
            return TRUE;
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
        $model  =db($dbName);
        $model->startTrans();
        //判断是否有图片存在，标签图片是否更改
        //$imageIcon  =$model->find(input('id'));
        $condition  =array($model->getPk()=>input("id"));        
        if(!self::invaImages($model, $condition, $dbName)){
            $model->rollback();
            return FALSE;
        }       
        // 更新数据
        //var_dump($model->create());exit;
        $list   =$model->where($condition)->allowField(TRUE)->update(input());        
        if (false == $list) {       
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
        //删除指定记录
        $dbName =input("db")?input("db",'','code'):request()->controller();
        $model  =db($dbName);        
        $model->startTrans();
        if(!$model){
            $model->rollback();
            $this->error('非法操作');
        }
        $pk = $model->getPk();
        $id = input($pk);
        if(!is_array($id)){                
            $id = explode(",",code($id));
        }           
        if (!isset ($id)) {
            $model->rollback();
            $this->error('非法操作');
        }
        $condition  =array($pk => array('in', implode(',', $id)));
        $list       =$model->where($condition)->setField('status',0);
        if($list==FALSE){
            $model->rollback();
        }
        if($this->invaImages($model,$condition,$dbName)==FALSE){
            $model->rollback();
            $this->error("参数错误，删除失败");
        }              
        $contents=session('user.name')."删除了数据表 ".$dbName. "中主键为".implode(',', $id)."d的数据";
        if ($list !== false && $this->auth->addLog(1,$dbName,$contents)) {
            $model->commit();
            $this->success('删除成功！');
        } else {
            $model->rollback();
            $this->error('删除失败！');
        }        
    }
    
    /*
     * 彻底删除记录（一般情况下不要使用）
     * 
     * @return bool
     */
    public function delete($imagePath=''){
        //删除指定记录
        $dbName =input("db","","code")?input("db","","code"): request()->controller();
        $model  =db($dbName);
        $pk     =$model->getPk();
        $id     = input($pk);
        if(!is_array($id)){                
            $id = explode(",",code($id));
        }
        if(!isset($id)){
            $this->error('非法操作');
        }
        $condition  =array($pk => array('in', implode(',', $id)));
        if (false == $model->where($condition)->delete()) {
            $this->error('删除失败！');
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
        $this->success('删除成功！'); 
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
        if($info){
            $imgName=$info->getSaveName();
        }
        if(in_array($info->getExtension(),array("jpg,jpeg,png,gif"))){
            $image = \think\Image::open($rootPath.$savePath.$info->getSaveName());
            // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
            $image->thumb(150,150,\think\Image::THUMB_CENTER)->save($rootPath.'small/'.$savePath);
        }
        return $imgName;
    }
    
    /*
     * 更改状态
     * 
     * @return #
     */
    public function changeStatus(){ 
        $dbName =input("db","","code")?input("db","","code"):request()->controller();
        $model  =db($dbName);
        if(empty($model)||$model->isEmpty()){
            $this->error('非法操作');
        }
        $pk = $model->getPk();
        $id = input($pk);
        if(!is_array($id)){                
            $id = explode(",",code($id));
        }
        if(!$id){
            $this->error('非法操作');
        }
        $condition  =array($pk => array('in', implode(',', $id)));
        $list       =$model->where($condition)->setField('status',(int)input("status","","code"));
        $contents=session("user.name")."修改了数据表".$dbName.'中主键为'.$pk.'的数据状态';
        if ($list !== false && $this->auth->addLog(1,$dbName,$contents)) {
            $this->success('状态修改成功！');
        } else {
            $this->error('状态修改失败！');
        }
    }
    
    /*
     * 将模糊的字段名转换为id字符串列
     * 
     * @return str  $ids
     */
    public function getIds($field='',$name='name',$db='',$val='id'){        
        $map[$name]     =array('like',"%".trim($field)."%");
        $map['status']  =array('neq',0);
        $model          =db($db);
        $arr            =$model->where($map)->column($val);
        $arrIds         =array();
        foreach($arr as $vo){
            $arrIds[]   =$vo;             
        }            
        $ids=array("in",implode(',', $arrIds));
        return $ids;
    } 
    
    /*
     * 修改和删除数据时，如果有图片，则把图片存在过期图片表中
     * 
     * @return #
     */
    public function invaImages($model,$condition,$dbName){
        $imaPath    =array();
        $smallImg   =array();
        //查询被删除的数据中省份存在图片，如果存在图片，则把图片路径提出来，以便将来清理
        $delList=$model->where($condition)->select();
        foreach($delList as $vo){
            if($vo['image']!=''){
                $imaPath[]  =$vo['image'];
            }else if($vo['img']!=''){
                $imaPath[]  =$vo['img'];
            }else if($vo['icon']!=''){
                $imaPath[]  =$vo['icon'];
            }else if($vo['photo']!=''){
                $imaPath[]  =$vo['photo'];
            }else if($vo['logo']!=''){
                $imaPath[]  =$vo['logo'];
            }
            if($vo['small_image']!=''){
                $smallImg[] =$vo['small_image'];
            }else if($vo['small_img']!=''){
                $smallImg[] =$vo['small_img'];
            }else if($vo['small_photo']!=''){
                $smallImg[] =$vo['small_photo'];
            }
        }                
        $imaPath    =array_merge($imaPath,$smallImg);
        if($imaPath[0]){
            $invaImg    =db("Invaimg");
            for($i=0;$i<count($imaPath);$i++){
                $map["db_name"]     =$dbName;
                $map['imagepath']   =$imaPath[$i];
                if(!$invaImg->insert($map)){
                    return FALSE;
                }
            }
            return TRUE;
        }
        return TRUE;
    }
}

