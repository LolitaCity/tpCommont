--
-- 数据表结构: `mh_admin`
--

create table `mh_admin` (
`id` int(10) unsigned not null  primary key auto_increment ,
`name` varchar(30) not null    ,
`nick_name` varchar(30) null    ,
`password` varchar(32) not null    ,
`tel` varchar(11) not null    ,
`email` varchar(30) null    ,
`photo` varchar(255) null    ,
`inc` int(10) unsigned null default 0   ,
`last_logintime` varchar(10) null    ,
`last_ip` varchar(50) null    ,
`add_time` varchar(11) null    ,
`status` tinyint(1) unsigned not null default 1   
)engine=innodb charset=utf8;

--
-- 数据表结构: `mh_admin_role`
--

create table `mh_admin_role` (
`a_id` int(11) unsigned null    ,
`role_id` int(11) unsigned null    
)engine=innodb charset=utf8;

--
-- 数据表结构: `mh_log`
--

create table `mh_log` (
`id` int(10) unsigned not null  primary key auto_increment ,
`user_id` int(10) unsigned null    ,
`db` varchar(100) null    ,
`content` mediumtext null    ,
`add_time` int(11) unsigned null    ,
`ip` varchar(45) null    ,
`addr` varchar(100) null    ,
`type` tinyint(1) unsigned null default 0   ,
`status` tinyint(1) unsigned not null default 1   
)engine=innodb charset=utf8;

--
-- 数据表结构: `mh_node`
--

create table `mh_node` (
`id` int(10) unsigned not null  primary key auto_increment ,
`name` varchar(30) null    ,
`controller` varchar(50) null    ,
`action` varchar(50) null    ,
`level` tinyint(1) not null default 0   ,
`p_id` int(10) unsigned not null default 0   ,
`ord` int(10) unsigned null default 99   ,
`path` varchar(15) null    ,
`add_time` int(11) unsigned null    ,
`edit_time` int(11) unsigned null    ,
`add_a_id` varchar(60) not null    ,
`edit_a_id` varchar(60) not null    ,
`status` tinyint(1) unsigned not null default 1   
)engine=innodb charset=utf8;

--
-- 数据表结构: `mh_role`
--

create table `mh_role` (
`id` int(11) unsigned not null  primary key auto_increment ,
`name` varchar(45) null    ,
`add_time` int(11) unsigned null    ,
`edit_time` int(11) unsigned null    ,
`add_a_id` varchar(60) not null    ,
`edit_a_id` varchar(60) not null    ,
`status` tinyint(1) unsigned null default 1   
)engine=innodb charset=utf8;

--
-- 数据表结构: `mh_role_node`
--

create table `mh_role_node` (
`role_id` int(11) unsigned null    ,
`node_id` int(11) unsigned null    
)engine=innodb charset=utf8;

--
-- 数据表结构: `mh_user`
--

create table `mh_user` (
`id` int(10) unsigned not null  primary key auto_increment ,
`name` varchar(30) not null    ,
`nick_name` varchar(30) null    ,
`password` varchar(32) not null    ,
`tel` varchar(11) not null    ,
`email` varchar(30) null    ,
`photo` varchar(255) null    ,
`inc` int(10) unsigned null default 0   ,
`last_logintime` varchar(10) null    ,
`add_time` varchar(11) null    ,
`status` tinyint(1) unsigned not null default 1   
)engine=innodb charset=utf8;

--
-- 数据表结构: `mh_web`
--

create table `mh_web` (
`id` int(11) unsigned not null  primary key auto_increment ,
`name` varchar(100) null    ,
`icon` varchar(100) null    ,
`logo` varchar(100) null    ,
`image` varchar(100) null    ,
`img` varchar(100) null    ,
`company_profile` varchar(2500) null    ,
`keywords` varchar(1000) null    ,
`desc_` varchar(2500) null    ,
`tel` varchar(15) null    ,
`tel_1` varchar(15) null    ,
`weburl` varchar(45) null    ,
`email` varchar(60) null    ,
`address` varchar(255) null    ,
`copyright` varchar(300) null    ,
`add_time` timestamp null default CURRENT_TIMESTAMP   ,
`status` tinyint(1) unsigned null default 1   
)engine=innodb charset=utf8;

--
-- 数据表中的数据: `mh_admin`
--

INSERT INTO `mh_admin` VALUES ('1','admin','超级管理员','14e1b600b1fd579f47433b88e8d85291','17098905509','605333742@qq.com','null','135','1540953188','121.35.129.189','null','1');

INSERT INTO `mh_admin` VALUES ('2','Lee','普通管理员','null','13324110120','222','null','0','null','null','null','0');

INSERT INTO `mh_admin` VALUES ('3','king','king','14e1b600b1fd579f47433b88e8d85291','18789878890','admin@qq.com','null','1','1538030462','113.88.127.216','1538030424','1');

--
-- 数据表中的数据: `mh_admin_role`
--

INSERT INTO `mh_admin_role` VALUES ('1','1');

INSERT INTO `mh_admin_role` VALUES ('3','2');

--
-- 数据表中的数据: `mh_log`
--

INSERT INTO `mh_log` VALUES ('586','1','null','admin 登录成功','1540273500','113.90.39.135','CHINA','0','1');

INSERT INTO `mh_log` VALUES ('557','1','Node','admin删除了数据表 Node 中主键为 86 的数据','1537144552','null','null','1','1');

INSERT INTO `mh_log` VALUES ('558','1','Node','admin删除了数据表 Node 中主键为 71 的数据','1537144581','null','null','1','1');

INSERT INTO `mh_log` VALUES ('559','1','Node','admin删除了数据表 Node 中主键为 77 的数据','1537144589','null','null','1','1');

INSERT INTO `mh_log` VALUES ('561','1','Node','admin删除了数据表 Node 中主键为 55,56,57,58,59,67,60,66,68,69,72,73,74,75,76,78,79,80,81 的数据','1537149102','null','null','1','1');

INSERT INTO `mh_log` VALUES ('562','1','Node','admin删除了数据表 Node 中主键为 53,54 的数据','1537149134','null','null','1','1');

INSERT INTO `mh_log` VALUES ('563','1','Node','admin删除了数据表 Node 中主键为 49,50,51,61,62,63,64,65,82 的数据','1537149158','null','null','1','1');

INSERT INTO `mh_log` VALUES ('564','1','Node','admin删除了数据表 Node 中主键为 87,88,92,93,95 的数据','1537149172','null','null','1','1');

INSERT INTO `mh_log` VALUES ('565','1','Node','admin删除了数据表 Node 中主键为 48 的数据','1537149185','null','null','1','1');

INSERT INTO `mh_log` VALUES ('566','1','null','admin 登录成功','1537943862','113.88.127.227','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('567','1','null','admin 登录成功','1537943922','61.129.6.227','上海-上海','0','1');

INSERT INTO `mh_log` VALUES ('568','1','null','admin 登录成功','1537961376','113.88.127.227','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('569','1','null','admin 登录成功','1537963365','113.88.127.227','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('570','1','User','admin在数据库 User 新增了一条数据','1537963507','null','null','1','1');

INSERT INTO `mh_log` VALUES ('571','1','Node','admin删除了数据表 Node 中主键为 37 的数据','1537963686','null','null','1','1');

INSERT INTO `mh_log` VALUES ('572','1','null','admin 登录成功','1538030307','113.88.127.216','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('573','1','null','admin 登录成功','1538030308','113.88.127.216','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('574','1','Admin','admin删除了数据表 Admin 中主键为 2 的数据','1538030318','null','null','1','1');

INSERT INTO `mh_log` VALUES ('575','3','null','king 登录成功','1538030462','113.88.127.216','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('576','1','null','admin 登录成功','1539089584','27.38.242.151','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('577','1','null','admin 登录成功','1539257102','113.92.129.31','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('578','1','null','admin 登录成功','1539261513','27.38.242.174','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('579','1','null','admin 登录成功','1539306088','113.92.129.31','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('580','1','null','admin清除了缓存文件','1539306092','null','null','1','1');

INSERT INTO `mh_log` VALUES ('581','1','null','admin 登录成功','1539945350','113.90.37.40','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('582','1','null','admin 登录成功','1539948406','113.90.37.40','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('583','1','null','admin 登录成功','1540207993','113.90.39.135','CHINA','0','1');

INSERT INTO `mh_log` VALUES ('584','1','null','admin清除了缓存文件','1540208149','null','null','1','1');

INSERT INTO `mh_log` VALUES ('585','1','null','admin 登录成功','1540208194','113.90.39.135','CHINA','0','1');

INSERT INTO `mh_log` VALUES ('587','1','null','admin 登录成功','1540355569','113.90.36.240','CHINA','0','1');

INSERT INTO `mh_log` VALUES ('588','1','null','admin 登录成功','1540355774','113.90.36.240','CHINA','0','1');

INSERT INTO `mh_log` VALUES ('589','1','null','admin 登录成功','1540368604','113.90.36.240','CHINA','0','1');

INSERT INTO `mh_log` VALUES ('590','1','null','admin 登录成功','1540510173','27.38.250.229','CHINA','0','1');

INSERT INTO `mh_log` VALUES ('591','1','null','admin 登录成功','1540511139','27.38.250.229','CHINA','0','1');

INSERT INTO `mh_log` VALUES ('592','1','null','admin清除了缓存文件','1540511142','null','null','1','1');

INSERT INTO `mh_log` VALUES ('593','1','null','admin 登录成功','1540947350','121.35.129.189','广东-深圳','0','1');

INSERT INTO `mh_log` VALUES ('594','1','Role','admin在数据库 Role 新增了一条数据','1540949534','null','null','1','1');

INSERT INTO `mh_log` VALUES ('595','1','null','admin 登录成功','1540953188','121.35.129.189','广东-深圳','0','1');

--
-- 数据表中的数据: `mh_node`
--

INSERT INTO `mh_node` VALUES ('1','节点管理','Node','null','0','0','1','1_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('2','节点列表','Node','index','1','1','1','1_2_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('3','网站管理','Web','null','0','0','2','3_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('4','网站信息','Web','info','1','3','1','3_4_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('6','角色分配','Web','role','1','3','2','3_6_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('8','访问列表','Web','visit','1','8','3','3_8_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('9','系统管理','System','null','0','0','3','9_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('10','操作日志列表','System','optionLog','1','9','1','9_10_','1530758456','1537144826','1','1','1');

INSERT INTO `mh_node` VALUES ('26','用户管理','User','null','0','0','3','26_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('27','前台用户管理','User','index','1','26','1','26_27_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('28','后台用户管理','User','adminIndex','1','26','2','26_28_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('30','登录日志列表','System','loginLog','1','9','2','9_20_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('31','过期图片','System','invalidImg','1','31','3','9_31_','1530758456','1530758456','1','1','1');

INSERT INTO `mh_node` VALUES ('37','banner','Web','banner','1','3','4','3_37_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('48','ceshix','Sa','null','0','48','5','48_','1530856880','1530856881','1','1','0');

INSERT INTO `mh_node` VALUES ('49','Amazon evaluation','UrlCont','null','0','0','5','49_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('50','Need to grab the Amazon','UrlCont','index','1','50','6','49_50_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('51','Minimum price limit ','MinimumPrice','null','0','0','7','51_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('52','Ceshi_1','Ceshi1','null','0','52','8','52_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('53','测试2_index','Ceshi1','index','1','54','1','52_53_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('54','Ceshi_2','Ceshi2','null','0','54','10','54_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('55','Ceshi_1_demo','Ceshi1','demo','1','52','11','52_55_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('56','Ceshi_1_ord','Ceshi1','index_ord','1','52','12','52_56_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('57','Ceshi_1_sort','Ceshi1','ceshi_sort','1','52','13','52_57_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('58','Ceshi_1_sort_2','Ceshi1','sort_2','1','52','2','52_58_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('59','测试1_index2','Ceshi','null','0','0','13','59_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('60','Ceshi_1_sort_1','Ceshi','sss','1','60','4','60_','1531281541','1531281542','1','1','0');

INSERT INTO `mh_node` VALUES ('61','Reseller list','MinimumPrice','resellerList','1','51','1','51_61_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('62','Product listXXX','MinimumPrice','productListA','1','51','23','51_62_','1530758456','1536644935','1','1','0');

INSERT INTO `mh_node` VALUES ('63','Currency list','MinimumPrice','currencyList','1','63','3','51_63_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('64','Minimum price list','MinimumPrice','mPriceList','1','51','4','51_64_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('65','Send warning list','MinimumPrice','noticeList','1','51','6','51_65_','1530758456','1530758456','1','1','0');

INSERT INTO `mh_node` VALUES ('66','ceshi777','sss','444','1','66','789','66_','1531281571','1531281572','1','1','0');

INSERT INTO `mh_node` VALUES ('67','AAAA9992','Ceshi','44','1','67','444','59_67_','1531281628','1531281629','1','1','0');

INSERT INTO `mh_node` VALUES ('68','ssxx','dd','x','1','68','666','68_','1531281517','1531281518','1','1','0');

INSERT INTO `mh_node` VALUES ('69','777','88','null','0','0','55','69_','1530785490','1530785490','1','1','0');

INSERT INTO `mh_node` VALUES ('70','77u','uuu','null','0','0','888','70_','1530785519','1530785519','1','1','0');

INSERT INTO `mh_node` VALUES ('71','ddss','ddd','ss','1','70','33','70_71_','1530785574','1530785574','1','1','0');

INSERT INTO `mh_node` VALUES ('72','ceshi777ccc','ccccc','null','0','0','0','72_','1530855579','1530855579','1','1','0');

INSERT INTO `mh_node` VALUES ('73','999666','222','null','0','0','0','73_','1530855607','1530855607','1','1','0');

INSERT INTO `mh_node` VALUES ('74','ceshi7776','银行','null','0','0','0','74_','1530855750','1530855750','1','1','0');

INSERT INTO `mh_node` VALUES ('75','ceshi777x','44','null','0','75','0','75_','1530855768','1530855768','1','1','0');

INSERT INTO `mh_node` VALUES ('76','77ddd','dddc','null','0','0','0','76_','1530855795','1530855795','1','1','0');

INSERT INTO `mh_node` VALUES ('77','xx','x','null','0','0','0','77_','1530855851','1530855851','1','1','0');

INSERT INTO `mh_node` VALUES ('78','xxx','xxx','null','0','0','0','78_','1530855857','1530855857','1','1','0');

INSERT INTO `mh_node` VALUES ('79','77777sxxz','ddz','null','0','0','0','79_','1530855894','1530855894','1','1','0');

INSERT INTO `mh_node` VALUES ('80','77777yh','hhu','null','0','0','0','80_','1530855965','1530855965','1','1','0');

INSERT INTO `mh_node` VALUES ('81','ceshi7778','777','null','0','0','0','81_','1530855991','1530855991','1','1','0');

INSERT INTO `mh_node` VALUES ('82','ceshi77755','2211','null','0','0','0','82_','1530856021','1530856021','1','1','0');

INSERT INTO `mh_node` VALUES ('83','77cccxz','88','ccs','1','69','0','69_83_','1530856197','1530856197','1','1','0');

INSERT INTO `mh_node` VALUES ('84','ceshi777','Ceshi1','ff','1','52','0','52_84_','1530856226','1530856226','1','1','0');

INSERT INTO `mh_node` VALUES ('85','77','sss','jjXXXX','1','85','0','85_','1531194230','1531194231','1','1','0');

INSERT INTO `mh_node` VALUES ('86','77','MinimumPrice','77','1','51','0','51_86_','1530856340','1530856340','1','1','0');

INSERT INTO `mh_node` VALUES ('87','ceshi777xc','77sx','null','0','87','0','87_','1530856856','1530856856','1','1','0');

INSERT INTO `mh_node` VALUES ('88','ceshi777xzzss','sss','z','1','88','0','88_','1530856992','1530856992','1','1','0');

INSERT INTO `mh_node` VALUES ('89','测试删除1','del','null','0','0','99','89_','1536990906','1536990906','1','1','0');

INSERT INTO `mh_node` VALUES ('90','测试删除1_1','dels','null','0','0','1','90_','1536990969','1536990969','1','1','0');

INSERT INTO `mh_node` VALUES ('91','del','dels','ds','1','90','1','90_91_','1536991260','1536991260','1','1','0');

INSERT INTO `mh_node` VALUES ('92','del','del','dsx','1','89','5','89_92_','1536991321','1536991321','1','1','0');

INSERT INTO `mh_node` VALUES ('93','des','del','gfd','1','89','5','89_93_','1536991350','1536991350','1','1','0');

INSERT INTO `mh_node` VALUES ('94','fds','del','ytf','1','89','6','89_94_','1536991370','1536991370','1','1','0');

INSERT INTO `mh_node` VALUES ('95','yhg','del','desll','1','89','3','89_95_','1536991564','1536991564','1','1','0');

INSERT INTO `mh_node` VALUES ('96','测试删除1','hhu','ds','1','80','5','80_96_','1536991643','1536991643','1','1','0');

--
-- 数据表中的数据: `mh_role`
--

INSERT INTO `mh_role` VALUES ('1','超级管理员','null','null','null','null','1');

INSERT INTO `mh_role` VALUES ('2','普通管理员','null','null','null','null','1');

INSERT INTO `mh_role` VALUES ('3','经理','null','null','null','null','1');

--
-- 数据表中的数据: `mh_role_node`
--

INSERT INTO `mh_role_node` VALUES ('2','3');

INSERT INTO `mh_role_node` VALUES ('2','4');

INSERT INTO `mh_role_node` VALUES ('2','6');

INSERT INTO `mh_role_node` VALUES ('2','37');

--
-- 数据表中的数据: `mh_user`
--

INSERT INTO `mh_user` VALUES ('1','king','null','123456','null','null','null','0','null','null','1');

<div id="think_page_trace" style="position: fixed;bottom:0;right:0;font-size:14px;width:100%;z-index: 999999;color: #000;text-align:left;font-family:'微软雅黑';">
    <div id="think_page_trace_tab" style="display: none;background:white;margin:0;height: 250px;">
        <div id="think_page_trace_tab_tit" style="height:30px;padding: 6px 12px 0;border-bottom:1px solid #ececec;border-top:1px solid #ececec;font-size:16px">
                        <span style="color:#000;padding-right:12px;height:30px;line-height:30px;display:inline-block;margin-right:3px;cursor:pointer;font-weight:700">基本</span>
                        <span style="color:#000;padding-right:12px;height:30px;line-height:30px;display:inline-block;margin-right:3px;cursor:pointer;font-weight:700">文件</span>
                        <span style="color:#000;padding-right:12px;height:30px;line-height:30px;display:inline-block;margin-right:3px;cursor:pointer;font-weight:700">流程</span>
                        <span style="color:#000;padding-right:12px;height:30px;line-height:30px;display:inline-block;margin-right:3px;cursor:pointer;font-weight:700">错误</span>
                        <span style="color:#000;padding-right:12px;height:30px;line-height:30px;display:inline-block;margin-right:3px;cursor:pointer;font-weight:700">SQL</span>
                        <span style="color:#000;padding-right:12px;height:30px;line-height:30px;display:inline-block;margin-right:3px;cursor:pointer;font-weight:700">调试</span>
                    </div>
        <div id="think_page_trace_tab_cont" style="overflow:auto;height:212px;padding:0;line-height: 24px">
                        <div style="display:none;">
                <ol style="padding: 0; margin:0">
                    <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">请求信息 : 2018-11-01 18:11:11 HTTP/1.1 GET : http://www.plumsoft.club/admin/bak/backup.html</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">运行时间 : 0.044408s [ 吞吐率：22.52req/s ] 内存消耗：2,819.20kb 文件加载：74</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">查询信息 : 19 queries 0 writes </li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">缓存信息 : 0 reads,0 writes</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">会话信息 : SESSION_ID=98iv7ov5bv3akq6u5sijaj65a5</li>                </ol>
            </div>
                        <div style="display:none;">
                <ol style="padding: 0; margin:0">
                    <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/public/index.php ( 0.82 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/base.php ( 1.71 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Loader.php ( 12.70 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/vendor/composer/autoload_static.php ( 1.44 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Error.php ( 4.00 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Container.php ( 14.84 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/App.php ( 26.46 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Env.php ( 2.74 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Config.php ( 9.63 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/convention.php ( 11.64 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/application/tags.php ( 0.96 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Hook.php ( 5.94 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/application/common.php ( 7.13 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/helper.php ( 20.29 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/application/provider.php ( 0.62 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/config/app.php ( 5.48 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/facade/Env.php ( 1.17 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Facade.php ( 3.44 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/config/cache.php ( 0.95 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/config/console.php ( 0.84 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/config/cookie.php ( 1.11 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/config/database.php ( 2.17 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/config/log.php ( 1.16 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/config/middleware.php ( 0.85 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/config/session.php ( 1.06 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/config/template.php ( 1.39 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/config/trace.php ( 0.84 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/vendor/topthink/think-captcha/src/helper.php ( 1.54 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/facade/Route.php ( 3.83 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Route.php ( 25.04 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Request.php ( 55.72 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/route/Domain.php ( 6.95 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/route/RuleGroup.php ( 16.08 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/route/Rule.php ( 28.51 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/route/RuleItem.php ( 8.58 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/route/RuleName.php ( 3.63 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/facade/Validate.php ( 4.83 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Validate.php ( 41.99 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Db.php ( 7.86 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Lang.php ( 7.38 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Log.php ( 8.91 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/log/driver/File.php ( 8.81 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/lang/zh-cn.php ( 12.49 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/route/route.php ( 0.66 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/route/dispatch/Url.php ( 5.00 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/route/Dispatch.php ( 9.20 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/route/dispatch/Module.php ( 5.14 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/application/admin/config/app.php ( 0.63 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Middleware.php ( 5.46 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Cookie.php ( 7.35 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/View.php ( 5.71 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/view/driver/Think.php ( 6.12 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Template.php ( 47.30 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/template/driver/File.php ( 2.29 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Session.php ( 14.13 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Debug.php ( 7.57 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Cache.php ( 3.27 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/cache/driver/File.php ( 7.91 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/cache/Driver.php ( 8.38 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/application/admin/controller/Bak.php ( 3.17 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/application/admin/controller/Common.php ( 15.57 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Controller.php ( 6.84 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/traits/controller/Jump.php ( 4.76 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/facade/Session.php ( 2.05 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/facade/Config.php ( 1.29 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/application/admin/controller/Auth.php ( 7.37 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/db/Connection.php ( 57.89 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/db/connector/Mysql.php ( 5.58 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/db/builder/Mysql.php ( 5.30 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/db/Builder.php ( 38.54 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/db/Query.php ( 102.41 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/Response.php ( 9.68 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/response/Json.php ( 1.47 KB )</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">/home/www_php/tp5S/4/20181031-103055/thinkphp/library/think/debug/Html.php ( 4.02 KB )</li>                </ol>
            </div>
                        <div style="display:none;">
                <ol style="padding: 0; margin:0">
                    <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ LANG ] /home/www_php/tp5S/4/20181031-103055/thinkphp/lang/zh-cn.php</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ ROUTE ] array (
)</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ HEADER ] array (
  'upgrade-insecure-requests' =&gt; '1',
  'cookie' =&gt; 'thinkphp_show_page_trace=0|0; _identity=1b83b5f6dcb335cfec411046518422e941ef82aaaeed713cd2f297e24e4404c0a%3A2%3A%7Bi%3A0%3Bs%3A9%3A%22_identity%22%3Bi%3A1%3Bs%3A46%3A%22%5B1%2C%22cJIrTa_b2Hnjn6BZkrL8PJkYto2Ael3O%22%2C2592000%5D%22%3B%7D; Hm_lvt_5fc7354aff3dd67a6435818b8ef02b52=1539248986,1539948272,1540515554,1540953054; Hm_lvt_f8d0a8c400404989e195270b0bbf060a=1540367642; uid=1; token=652f89a5-e254-4ac9-9102-4844a49d6760; PHPSESSID=98iv7ov5bv3akq6u5sijaj65a5; _csrf=c28a2444ce1349bc1dc3be8ad9fc321e9e99f7ca3b95a97c3802c7dc005c5682a%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%227TWoaib2-M3C-lNDvbDcWD117dpvAc1S%22%3B%7D; Hm_lpvt_5fc7354aff3dd67a6435818b8ef02b52=1540953054',
  'connection' =&gt; 'keep-alive',
  'referer' =&gt; 'http://www.plumsoft.club/admin/',
  'accept-encoding' =&gt; 'gzip, deflate',
  'accept-language' =&gt; 'zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2',
  'accept' =&gt; 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
  'user-agent' =&gt; 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0',
  'host' =&gt; 'www.plumsoft.club',
  'content-type' =&gt; '',
  'content-length' =&gt; '',
)</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ PARAM ] array (
)</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ DB ] INIT mysql</li>                </ol>
            </div>
                        <div style="display:none;">
                <ol style="padding: 0; margin:0">
                                    </ol>
            </div>
                        <div style="display:none;">
                <ol style="padding: 0; margin:0">
                    <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ DB ] CONNECT:[ UseTime:0.000487s ] mysql:host=127.0.0.1;port=3306;dbname=works;charset=utf8</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] SHOW COLUMNS FROM `mh_node` [ RunTime:0.001015s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] SELECT * FROM `mh_node` WHERE  `status` = 1  AND `level` = 0 ORDER BY `ord` ASC [ RunTime:0.000479s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] show tables from works [ RunTime:0.000397s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] show columns from mh_admin [ RunTime:0.000778s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] show columns from mh_admin_role [ RunTime:0.000694s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] show columns from mh_log [ RunTime:0.000761s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] show columns from mh_node [ RunTime:0.000818s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] show columns from mh_role [ RunTime:0.000677s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] show columns from mh_role_node [ RunTime:0.000564s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] show columns from mh_user [ RunTime:0.000697s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] show columns from mh_web [ RunTime:0.000834s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] select * from mh_admin [ RunTime:0.000284s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] select * from mh_admin_role [ RunTime:0.000249s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] select * from mh_log [ RunTime:0.000283s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] select * from mh_node [ RunTime:0.000313s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] select * from mh_role [ RunTime:0.000233s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] select * from mh_role_node [ RunTime:0.000209s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] select * from mh_user [ RunTime:0.000222s ]</li><li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">[ SQL ] select * from mh_web [ RunTime:0.000239s ]</li>                </ol>
            </div>
                        <div style="display:none;">
                <ol style="padding: 0; margin:0">
                                    </ol>
            </div>
                    </div>
    </div>
    <div id="think_page_trace_close" style="display:none;text-align:right;height:15px;position:absolute;top:10px;right:12px;cursor:pointer;"><img style="vertical-align:top;" src="data:image/gif;base64,R0lGODlhDwAPAJEAAAAAAAMDA////wAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4wLWMwNjAgNjEuMTM0Nzc3LCAyMDEwLzAyLzEyLTE3OjMyOjAwICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MUQxMjc1MUJCQUJDMTFFMTk0OUVGRjc3QzU4RURFNkEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MUQxMjc1MUNCQUJDMTFFMTk0OUVGRjc3QzU4RURFNkEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoxRDEyNzUxOUJBQkMxMUUxOTQ5RUZGNzdDNThFREU2QSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoxRDEyNzUxQUJBQkMxMUUxOTQ5RUZGNzdDNThFREU2QSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgH//v38+/r5+Pf29fTz8vHw7+7t7Ovq6ejn5uXk4+Lh4N/e3dzb2tnY19bV1NPS0dDPzs3My8rJyMfGxcTDwsHAv769vLu6ubi3trW0s7KxsK+urayrqqmop6alpKOioaCfnp2cm5qZmJeWlZSTkpGQj46NjIuKiYiHhoWEg4KBgH9+fXx7enl4d3Z1dHNycXBvbm1sa2ppaGdmZWRjYmFgX15dXFtaWVhXVlVUU1JRUE9OTUxLSklIR0ZFRENCQUA/Pj08Ozo5ODc2NTQzMjEwLy4tLCsqKSgnJiUkIyIhIB8eHRwbGhkYFxYVFBMSERAPDg0MCwoJCAcGBQQDAgEAACH5BAAAAAAALAAAAAAPAA8AAAIdjI6JZqotoJPR1fnsgRR3C2jZl3Ai9aWZZooV+RQAOw==" /></div>
</div>
<div id="think_page_trace_open" style="height:30px;float:right;text-align:right;overflow:hidden;position:fixed;bottom:0;right:0;color:#000;line-height:30px;cursor:pointer;">
    <div style="background:#232323;color:#FFF;padding:0 6px;float:right;line-height:30px;font-size:14px">0.045053s </div>
    <img width="30" style="" title="ShowPageTrace" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjVERDVENkZGQjkyNDExRTE5REY3RDQ5RTQ2RTRDQUJCIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjVERDVENzAwQjkyNDExRTE5REY3RDQ5RTQ2RTRDQUJCIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NURENUQ2RkRCOTI0MTFFMTlERjdENDlFNDZFNENBQkIiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NURENUQ2RkVCOTI0MTFFMTlERjdENDlFNDZFNENBQkIiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5fx6IRAAAMCElEQVR42sxae3BU1Rk/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">
</div>

<script type="text/javascript">
    (function(){
        var tab_tit  = document.getElementById('think_page_trace_tab_tit').getElementsByTagName('span');
        var tab_cont = document.getElementById('think_page_trace_tab_cont').getElementsByTagName('div');
        var open     = document.getElementById('think_page_trace_open');
        var close    = document.getElementById('think_page_trace_close').children[0];
        var trace    = document.getElementById('think_page_trace_tab');
        var cookie   = document.cookie.match(/thinkphp_show_page_trace=(\d\|\d)/);
        var history  = (cookie && typeof cookie[1] != 'undefined' && cookie[1].split('|')) || [0,0];
        open.onclick = function(){
            trace.style.display = 'block';
            this.style.display = 'none';
            close.parentNode.style.display = 'block';
            history[0] = 1;
            document.cookie = 'thinkphp_show_page_trace='+history.join('|')
        }
        close.onclick = function(){
            trace.style.display = 'none';
            this.parentNode.style.display = 'none';
            open.style.display = 'block';
            history[0] = 0;
            document.cookie = 'thinkphp_show_page_trace='+history.join('|')
        }
        for(var i = 0; i < tab_tit.length; i++){
            tab_tit[i].onclick = (function(i){
                return function(){
                    for(var j = 0; j < tab_cont.length; j++){
                        tab_cont[j].style.display = 'none';
                        tab_tit[j].style.color = '#999';
                    }
                    tab_cont[i].style.display = 'block';
                    tab_tit[i].style.color = '#000';
                    history[1] = i;
                    document.cookie = 'thinkphp_show_page_trace='+history.join('|')
                }
            })(i)
        }
        parseInt(history[0]) && open.click();
        tab_tit[history[1]].click();
    })();
</script>
