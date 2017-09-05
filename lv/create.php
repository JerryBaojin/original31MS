<?php
require_once 'sql.php';
$mysql=new mysql();
$sql="CREATE TABLE `lv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(1000) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `city` varchar(1000) DEFAULT NULL,
  `country` varchar(1000) DEFAULT NULL,
  `province` varchar(1000) DEFAULT NULL,
  `headimgurl` varchar(1000) DEFAULT NULL,
  `is_gz` tinyint(1) NOT NULL DEFAULT '1',
  `openid` varchar(1000) NOT NULL,
  `telphone` varchar(100) DEFAULT NULL,
  `gztime` int(11) NOT NULL,
  `jfnum` int(8) DEFAULT '0',
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=utf8;
";

$wo=$mysql->insert($sql);
var_dump($wo);