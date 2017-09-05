<?php
require_once 'sql.php';
header("Content-Type: text/html;charset=utf-8");
$mysql=new mysql();
if(isset($_GET['openid'])){
    $openid=$_GET['openid'];
     $jg="SELECT * FROM activity  WHERE openid='$openid'";
      $re=$mysql->toresult($jg);
if(empty($re)){
	echo 0;
	return false;
}elseif ($re[0]['jfnum']==1) {
	echo 3;
	return false;
}{
	 $sql="UPDATE  activity SET jfnum ='1' WHERE openid='$openid'";
    $a=$mysql->insert($sql);
    if($a){
        echo 1;
        return false;
    }else{
    	echo 2;
    	return false;
    }
}


   
}{
echo '403';
}

