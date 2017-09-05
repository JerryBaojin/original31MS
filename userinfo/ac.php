<?php
session_start();

require_once 'sql.php';
$mysql=new mysql();
/*
$da="SELECT * FROM activity";
$b=$mysql->toresult($da);
var_dump($b);

$da="SELECT * FROM pijiu";
$b=$mysql->toresult($da);
var_dump($b);
/*
    /*$sql="UPDATE  activity SET jfnum ='1' WHERE openid='$openid'";
	$a=$mysql->insert($sql);
   echo $a;*/
/*
$de="DELETE FROM activity ";
$a=$mysql->insert($de);
var_dump($a);
*/
$de="DELETE FROM pijiu  WHERE nickname='Meiko'";
$a=$mysql->insert($de);
var_dump($a);

/*
var_dump($_SESSION['act']);
unset ($_SESSION['act']);

var_dump(isset($_SESSION['act']));*/

?>