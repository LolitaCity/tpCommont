--
--新增企业表
--@author Lee<a605333742@gamil.com>
--@time 2018-10-31
--
create table  mh_company(
`id` int(11) unsigned not null  primary key auto_increment COMMENT '企业id',
`name` varchar(80) not null default '' COMMENT '企业名称',
`yyzz` varchar(200) not null default '' COMMENT '营业执照',
)