<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<style>
*{ margin:0; padding:0}
body{ background:#71d8ff; font-family:"微软雅黑"}
.header_bg{ width:100%;min-height:120px}
.bottom{font-size:12px;color:#000; position:absolute;bottom:10px;width:100%;text-align:center;z-index:999}
</style>
    <title>最内江扫一扫免费领礼品</title>
</head>

<body>
<div class="header_bg"><img src="images/top.jpg" width="100%" alt="banner" /></div><br>
<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (isset($_GET['act'])) {
 $_SESSION['act']=$_GET['act'];
}
require_once 'sql.php';
$mysql=new mysql();
$token='Eioa5C5oj3S32qhH';
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
    $request=curl_exec($ch);//
    $tempArr=json_decode($request,TRUE);
    if (is_array($tempArr)) {
        return $tempArr;
    }
    else
    {
        return $request;
    }
    curl_close($ch);
}

$url="http://weixin.scnjnews.com";
$uri="$url/userinfo/deal.php";
$scope='snsapi_userinfo';
$urlb="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$uri&response_type=code&scope=$scope&state=STATE#wechat_redirect";
if(!$_GET['code']){
    header("Location:$urlb");
    exit;
}
$code=$_GET['code'];

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
    echo '<b style=\"text-align: center;display:block;font-size:30px;\">请按照活动流程进行扫码!</b><div class=\"bottom\">技术支持:内江日报融媒应用部</div></body></html>';
    return false;
}
    $nickname=$userinfo['nickname'];
    $sex=$userinfo['sex'];
    $city=$userinfo['city'];
    $country=$userinfo['country'];
    $province=$userinfo['province'];
    $headimgurl=$userinfo['headimgurl'];
    $openid=$userinfo['openid'];

 $newtime;
//$num=9;
//判断当前进行的是哪个活动
$isgz=$subscribe;
$gztime=date('dHi',time());
//$time=date('Hi',time());//判断是否是白天s
$insert;
$db;
$str;
if ($_SESSION['act']=='water') {
            $db="activity";
    $str='领水';
}else{
    $db="pijiu";
    $str='领啤酒';
}
//数据库操作
$wonder="SELECT * FROM $db WHERE openid='$openid'";
            $re=$mysql->toresult($wonder);
       if (empty($re)) {
            $insert="INSERT INTO $db (`nickname`, `sex`, `city`, `country`, `province`, `headimgurl`, `is_gz`,`openid`, `gztime`) VALUES ('$nickname', '$sex', '$city', '$country', '$province', '$headimgurl', '$isgz', '$openid','$gztime')";
            }elseif($re[0]['jfnum']==0){
                         $insert="UPDATE $db SET `nickname`='$nickname',`sex`='$sex',`city`='$city',`country`='$country',`province`='$province',`headimgurl`='$headimgurl',`is_gz`='$isgz',`openid`='$openid',`gztime`='$gztime',`jfnum`='0'  WHERE openid='$openid'";
                
            }else{
           if($db=="pijiu"){
               echo "<b style=\"display:block;text-align: center;font-size:20px;\">已经参与过".$str."活动!</b><div class=\"bottom\">技术支持:内江日报融媒应用部</div></body></html>";
               return false;
           }else{
                           $befortime=$re[0]['gztime'];
                  $lefttime=$gztime-$befortime;

                         if($lefttime>200){//过了俩个小时
                                   $insert="UPDATE $db SET `nickname`='$nickname',`sex`='$sex',`city`='$city',`country`='$country',`province`='$province',`headimgurl`='$headimgurl',`is_gz`='$isgz',`openid`='$openid',`gztime`='$gztime',`jfnum`='0'  WHERE openid='$openid'";
                            }else{
                                   $insert="UPDATE $db SET `nickname`='$nickname',`sex`='$sex',`city`='$city',`country`='$country',`province`='$province',`headimgurl`='$headimgurl',`is_gz`='$isgz',`openid`='$openid',`gztime`='$befortime',`jfnum`='1'  WHERE openid='$openid'";
                                   echo "<b style=\"display:block;text-align: center;font-size:20px;\">已经参与过".$str."活动!再等一会儿来领吧！</b><div class=\"bottom\">技术支持:内江日报融媒应用部</div></body></html>";
                                   return false;
                              } }
            }

$c=$mysql->insert($insert);

if ($c ) {
    require_once 'phpqrcode/phpqrcode.php';
      $ura=$openid;
    $errorCorrectionLevel = 'H';//容错级别
    $matrixPointSize = 8;//生成图片大小
     $picname="images/$openid.png";
   QRcode::png($ura, $picname,$errorCorrectionLevel,$matrixPointSize);

   echo "<b id='a' style=\"text-align: center;display:block;font-size:20px;\">".$str."<br>请将此二维码出示给现场工作人员!</b>";
    ?>
    <div id='b' style="text-align: center;
    font-size: 26px;
    font-weight: bold;" >您当前状态:<b id="su" style="text-align: center;display:block;font-size:20px;"></b></div>
    <script src="jq.js"></script>
    <script>
        $(function(){
            var done=0;
            function timedCount(){
                if (done==1){return false};
                $.ajax({
                    method:'get',
                    url:'pijiu.php',
                    data:{act:'wonder',id:"<?php echo $ura;?>"},
                    success:function(date){
                        data=eval('('+date+')');
                        switch(data['res'])
                        {
                            case '1':
                                $('#su').html('你已经成功领取啤酒!');
                                setTimeout(function(){
                                    $('#su').html('谢谢参与活动!');
                                    $('#main').hide();
                                    $('#a').hide();
                                    done=1;
                                    return false;
                                },60000)
                                break;
                            case '0'://以获取领取资格，但未领取
                                $('#su').html('已经获取领取资格，但未领取');
                                break;
                            default:
                              location.href='activity.php';
                        }
                    }
                })


            }
            setInterval(timedCount,2000);//间隔时间
        })
    </script>

    <?php
  echo  "<img id='main' style='width:50%;margin:20px auto; display: block;' src='$picname'><div class=\"bottom\">技术支持:内江日报融媒应用部</div></body></html> ";
return false;
//  header("Location:$picname");
}else{
    echo '错误!请重新扫码！';

    return false;
}

//$_GET['wecha_id']
?>


<div class="bottom">技术支持:内江日报融媒应用部</div>
</body>
</html>