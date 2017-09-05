<?php
 require_once 'sql.php';
$mysql=new mysql();
$sql="SELECT * from tp_vote";
$re=$mysql->toresult($sql);
var_dump($re);