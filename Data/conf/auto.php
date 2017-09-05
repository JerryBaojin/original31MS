<?php

$weburl='http://' . $_SERVER['HTTP_HOST'];

session_start();
if(isset($_SESSION["uid"])){
}else{
	 Header("Location: $weburl"); 
exit;
}


header("Content-type: text/html; charset=gbk"); 

echo '<script type="text/javascript">setTimeout("window.location.reload()",Math.ceil(Math.random()*120000));</script>';

$info= require("db.php");
$hostname =$info['DB_HOST'];
$userid =$info['DB_USER'];
$password =$info['DB_PWD'];
$dbname = $info['DB_NAME'];
$conn = @mysql_connect($hostname,$userid,$password);
if (!$conn){
    die("连接数据库失败：" . mysql_error());
}

mysql_select_db($dbname, $conn);
mysql_query("set names 'utf8'"); 

$zid =$_GET['zid'];

$sql = "update tp_vote_item set vcount=vcount+1 where id=".$zid;

if(!mysql_query($sql,$conn)){
    echo "添加失败：".mysql_error();
} else {
    echo "正在为".$zid."号选手自动加票中...！请不要关闭该页面;否则停止加票！";
}
?>