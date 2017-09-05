<?php
session_start();
header("Content-Type: text/html;charset=utf-8");

require_once 'sql.php';
$mysql=new mysql();

$sql="SELECT * FROM tp_websiteurl WHERE id='1'";
$result=$mysql->toresult($sql);
$url=$result[0]['url'];
//获取APPID

$appid='wx6f1fa092a4f5e263';
$appsecret='51eb6b33ee16bfa2e213c037f9d4c4f8';
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

    }

    curl_close($ch);

}

$uri="$url/userinfo/infotest.php";
$scope='snsapi_userinfo';
$urlb="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$uri&response_type=code&scope=$scope&state=STATE#wechat_redirect";
if(!$_GET['code']){
    header("Location:$urlb");
    exit;
}
$code=$_GET['code'];
echo $code;
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

var_dump($c);
//未关注
$op="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
$oppp=https_request($op);
$access_token=$oppp["access_token"];
$openid=$oppp['openid'];

var_dump($oppp);
$sc="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access&openid=$openid";
$userinfo=https_request($sc);

$subscribe=$userinfo['subscribe'];//根据全局acess_token获取信息，如果用户未关注则获取不来详细情况；
if ($subscribe==0) {
        $test="https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN ";
    $userinfo=https_request($test);

}
var_dump($userinfo);
$nickname=$userinfo['nickname'];
$sex=$userinfo['sex'];
$city=$userinfo['city'];
$country=$userinfo['country'];
$province=$userinfo['province'];
$headimgurl=$userinfo['headimgurl'];

$openid=$userinfo['openid'];
$openid=$userinfo['openid'];
$gztime=time();
//$num=9;

?>