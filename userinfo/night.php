<?php
require_once "jssdk/jssdk.php";
$jssdk = new JSSDK("wx6f1fa092a4f5e263", "51eb6b33ee16bfa2e213c037f9d4c4f8");
$signPackage = $jssdk->GetSignPackage();
?>

<!doctype html>
<html>
<head>
<style>
*{font-family:"微软雅黑"}
</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<title>领啤酒</title>
<script type="text/javascript" src="jq.js"></script>
</head>

<body>
<div id="app">
	<label style="font-size:100px">领啤酒,描二维码:</label><br>
	<input type="text" id="openid" style="width:100%;height:100px;font-size:100px"//>
    <div>当前已经领取成功人数:<sapn id="count"></sapn></div>
    <div>当前参与活动人数:<sapn id="total"></sapn></div>
	<style>
*{font-family:"微软雅黑"}
</style>
</div>
<div class="model" style="display:none;  
    margin-top: 9%;
    text-align: center;
    font-size: 100px;color:red"><b>领取成功</b></div>

    <button id="btn" style="    display: block;
    margin: 200px auto;
    border: none;
    background: darkseagreen;
    font: 20px red bold;
    border-radius: 15px;">点击扫一扫</button>

<script>
    $(function(){
    function timedCount(){
        $.ajax({
            method:'get',
            url:'pijiu.php',
            data:{act:'query'},
            success:function(date){
                data=eval('('+date+')');
                switch(data['status'])
                {
                    case 1:
                        $('#count').html(data["number"]);
                        $('#total').html(data["total"]);
                        break;
                    default:
                        console.log('error');
                }
            }
        })

console.log(132);
    }
        setInterval(timedCount,2000);//间隔时间
    })
</script>
<script type="text/javascript">

   $(function(){

    $('input').focus();
    var original=false;
   $('input').bind('input propertychange keyup',function(){
    var value=$('#openid').val();
      if (event.keyCode == 13) {
          original=true;
          var openid=$('#openid').val();
          ajax(original,openid);
          return false;
    }
   })
   })
   function ajax(original,id){
     if(original)
   {
    //监听到输入事件完成
      $.ajax({
        method:'get',
        url:'pijiu.php',
        data:{openid:id},
        success:function(date){

          data=eval(date);
switch(data)
{
  case 0:
  alert('此二维码不在活动范围内');
  $('input').val('');
  break;
   case 3:
   //参与过
   alert('已经领取过了');
   $('input').val('');
  break;
   case 1:
   $(".model").fadeIn(1000).fadeOut(2000);
$('input').val('');
  break;
   case 2:
   //写入失败
alert('程序写入失败');
$('input').val('');
  break;
   case 403:
   $('input').val('');
   //post
  break;
  default:
  console.log('error');
}
        }
      })
   }
   }

</script>

<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            'scanQRCode'
        ]
    });


wx.ready(function () {
  document.querySelector("#btn").onclick=function(){
    wx.scanQRCode({  //分享到朋友圈  
     des: "二维码扫描",//描述
     needResult: 1, // 分享链接
    scanType:["qrCode"],
     success: function (res) { 
var openid=res.resultStr;
ajax(true,openid);
     }
   });
  }
   
});
   // var sharelink = "http://weixin.scnjnews.com/qixing/index.php" ;//分享跳转地址
</script>
</body>
</html>
