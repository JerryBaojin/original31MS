<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (isset($_GET['id']) && isset($_GET['token'])) {
    $_SESSION['acId']=$_GET['id'];
    $_SESSION['acToken']=$_GET['token'];
}
require_once 'sql.php';
$mysql=new mysql();


$sql="SELECT * FROM tp_websiteurl WHERE id='1'";
$result=$mysql->toresult($sql);
$url=$result[0]['url'];
//写s辨别用户

if ($_SESSION['act'] ) {
	$i=$_COOKIE['wxd_openid'];
    $aid=$_SESSION['acId'];
	header("Location:$url/index.php?g=Wap&m=Vote&a=index&token=Eioa5C5oj3S32qhH&id=$aid&wecha_id=$openid");
	return false;
}




//获取APPID
$token=$_SESSION['acToken'];

$app="SELECT * FROM tp_diymen_set WHERE token='$token'";
$appinfo=$mysql->toresult($app);

$appid=$appinfo[0]['appid'];
$appsecret=$appinfo[0]['appsecret'];
function https_request($url,$data="")//,
{
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);//请求地址
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//文件流
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//关闭ssl验证

    if ($data) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_HEADER,0);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//
    }

    $request=curl_exec($ch);//执行

    $tempArr=json_decode($request,TRUE);
//cl6g8P2Wh26XdA_-wbTYUc-64rVQyf5_RZwy56QYItu7bcaa92K_yEPLXHkp-QefV2FwyKDpEu5QXbVnV8K6jLrU86K1_r3m6vk5kLCOVpu2og4Mz7KBzSDVOsVhw2l4EPCdABAQBO
    if (is_array($tempArr)) {
        return $tempArr;
    }
    else
    {
        return $request;
        echo 2;
    }

    curl_close($ch);

}

//获取 token
/*
$tokenurl="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$token=https_request($tokenurl);
$access_token=$token['access_token'];
*/

$uri="$url/userinfo/newindex.php";
$scope='snsapi_userinfo';
$urlb="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$uri&response_type=code&scope=$scope&state=STATE#wechat_redirect";
if(!$_GET['code']){
    header("Location:$urlb");
    exit;
}
$code=$_GET['code'];

/*
$op="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
$oppp=https_request($op);
var_dump($oppp);
$acess="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$acess_token=https_request($acess);
var_dump($acess_token);
$openid=$oppp['openid'];

$UnionID="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$acess_token&openid=$openid&lang=zh_CN";
$userinfo=https_request($UnionID);

*/


$ass="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";//全局
$c=https_request($ass);
$access=$c['access_token'];//获取全局acess_token

//未关注
$op="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
$oppp=https_request($op);
$access_token=$oppp["access_token"];
$openid=$oppp['openid'];

$sc="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access&openid=$openid";
$userinfo=https_request($sc);
$subscribe=$userinfo['subscribe'];//根据全局acess_token获取信息，如果用户未关注则获取不来详细情况；
if ($subscribe==0) {
        $test="https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN ";
        $userinfo=https_request($test);
      
}
$nickname=$userinfo['nickname'];
$sex=$userinfo['sex'];
$city=$userinfo['city'];
$country=$userinfo['country'];
$province=$userinfo['province'];
$headimgurl=$userinfo['headimgurl'];

$openid=$userinfo['openid'];


$id=$_SESSION['acId'];

$threeOption="SELECT * FROM tp_vote WHERE id='$id'";
$options=$mysql->toresult($threeOption);
$isonlyweb=$options[0]['isonlyweb'];
$isreduce=$options[0]['isreduce'];
$ismustsub=$options[0]['ismustsub'];

$isgz=0;//默认为1
if($ismustsub==1){
    $isgz=$subscribe;
}else{
    $isgz=1;
}

$openid=$userinfo['openid'];
$gztime=time();
//$num=9;

//首先确定用户是否存在，存在则覆盖
$wonder="SELECT * FROM tp_fusers WHERE openid='$openid'";
$re=$mysql->toresult($wonder);
$insert;
if (empty($re)) {
$insert="INSERT INTO `tp_fusers` (`nickname`, `sex`, `city`, `country`, `province`, `headimgurl`, `is_gz`,`openid`, `gztime`) VALUES ('$nickname', '$sex', '$city', '$country', '$province', '$headimgurl', '$isgz', '$openid','$gztime')";
}else{
$insert="UPDATE `tp_fusers` SET `nickname`='$nickname',`sex`='$sex',`city`='$city',`country`='$country',`province`='$province',`headimgurl`='$headimgurl',`is_gz`='$isgz',`openid`='$openid',`gztime`='$gztime'  WHERE openid='$openid'";
}

//$insert="INSERT INTO `tp_fusers` (`nickname`, `sex`, `city`, `country`, `province`, `headimgurl`, `is_gz`,`openid`, `gztime`) VALUES ('$nickname', '$sex', '$city', '$country', '$province', '$headimgurl', '$isgz', '$openid','$gztime')";
$c=$mysql->insert($insert);
setcookie('wxd_openid', $openid, time() + 31536000);
$_COOKIE['wxd_openid']=$openid;
setcookie("act", "act", time() + 31536000);

//跳转地址需要修改

$newurl="$url/index.php?g=Wap&m=Vote&a=index&token=Eioa5C5oj3S32qhH&id=$id&wecha_id=$openid";

if ($c) {
 
  header("Location:$newurl");
}else{
    echo '错误';
    return false;
}

//$_GET['wecha_id']
?>