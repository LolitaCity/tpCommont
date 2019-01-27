/**
 * 网站菜单表
 * 
 * @author  Lee<a605333742@gmail.com>
 * @date    2019-01-24
 */
DROP TABLE IF EXISTS `mh_menu`;
create table `mh_menu`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
`name` varchar(30)  NOT NULL DEFAULT '' COMMENT '菜单名称',
`level` tinyint(1) NOT NULL DEFAULT 0 COMMENT '层级',
`p_id` int(11) unsigned DEFAULT NULL COMMENT '父id',
`order` tinyint(3) NOT NULL DEFAULT 0 COMMENT '排序',
`path` varchar(15) DEFAULT NULL COMMENT '排序路径',
`add_time` int(11) unsigned DEFAULT NULL COMMENT '添加时间',
`edit_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
`add_a_id` varchar(60) NOT NULL DEFAULT '' COMMENT '添加人',
`edit_a_id` varchar(60) NOT NULL DEFAULT '' COMMENT '修改人',
`status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态0为删除，1为正常',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='网站菜单表';

 
