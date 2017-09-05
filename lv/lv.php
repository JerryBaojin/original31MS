<?php
require_once 'sql.php';
header("Content-Type: text/html;charset=utf-8");
$mysql=new mysql();
if(isset($_GET['openid'])){
    $openid=$_GET['openid'];
     $jg="SELECT * FROM lv  WHERE openid='$openid'";
      $re=$mysql->toresult($jg);
if(empty($re)){
	echo 0;
	return false;
}elseif ($re[0]['jfnum']==1) {
	echo 3;
	return false;
}{
	 $sql="UPDATE  lv SET jfnum ='1' WHERE openid='$openid'";
    $a=$mysql->insert($sql);
    if($a){
        echo 1;
        return false;
    }else{
    	echo 2;
    	return false;
    }
}


   
}elseif(isset($_GET['act']) && $_GET['act']=='query'){
   //当前成功领取的人数
    $jg="SELECT count(id) FROM lv WHERE jfnum='1'";
    $re=$mysql->toresult($jg);
    $number =$re[0]['count(id)'];
    //当前参与活动人数
    $jga="SELECT count(id) FROM lv";
    $rea=$mysql->toresult($jga);
    $totala =$rea[0]['count(id)'];

    $arr=array(
        'status'=>1,
        "number"=>$number,
        "total"=>$totala
    );
    echo json_encode($arr);
    return false;
}elseif($_GET['act']=='wonder'){
$open=$_GET['id'];
    $jg="SELECT jfnum FROM lv WHERE openid='$open'";
    $re=$mysql->toresult($jg);
    $number =$re[0]['jfnum'];
    $arr=array(
        'status'=>1,
        "res"=>$number
    );
    echo json_encode($arr);
    return false;

}{
echo '403';
}

