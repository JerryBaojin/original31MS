<?php
session_start();

require_once 'sql.php';
$mysql=new mysql();
/*
$de="DELETE FROM tp_fusers WHERE nickname='Meiko'";
$a=$mysql->insert($de);
var_dump($a);
*/

$sql="SELECT * FROM tp_fusers WHERE nickname='Meiko'";
$re=$mysql->toresult($sql);
var_dump($re);


var_dump($_SESSION['act']);
unset ($_SESSION['act']);

var_dump(isset($_SESSION['act']));

?>