--
--新增is_company，是否为企业用户，默认为0
--新增add_a_id，用户添加人，用于判断所属企业
--新增edit_a_id，修改人
--新增edit_time，修改时间
--@author Lee<a605333742@gamil.com>
--@time 2018-10-31
--
alter table mh_admin add `company_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '企业ID' after last_ip;
alter table mh_admin add `add_a_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户添加人id(上级用户id)' after add_time;
alter table mh_admin add `edit_a_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户修改人id(上级用户id)' after add_a_id;
alter table mh_admin add `edit_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户修改时间' after edit_a_id;
