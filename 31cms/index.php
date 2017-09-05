<?php
$appid='wx6f1fa092a4f5e263';
$appsecret='51eb6b33ee16bfa2e213c037f9d4c4f8';
$uri='http://v.scnjnews.com/index.php?g=Wap&m=Vote&a=signup';
$scope='snsapi_base';
$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$uri&response_type=code&scope=$scope&state=STATE#wechat_redirect";
if(!$_GET['code']){
    header("Location:$url");
    exit;
}
$code=$_GET['code'];

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

    $request=curl_exec($ch);//真行

    $tempArr=json_decode($request,TRUE);

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
$ass="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";//全局
$op="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
$ops=https_request($ass);
$oppp=https_request($op);
$openid=$oppp['openid'];
$acce=https_request($ass);
$access_token=$acce["access_token"];//获取到token
$sc="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid";
//$sc="https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN ";
$userinfo=https_request($sc);

var_dump($userinfo);
return false;
die;
?>