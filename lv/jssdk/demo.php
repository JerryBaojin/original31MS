<?php
require_once "jssdk/jssdk.php";
$jssdk = new JSSDK("wx6f1fa092a4f5e263", "51eb6b33ee16bfa2e213c037f9d4c4f8");
$signPackage = $jssdk->GetSignPackage();
?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
	wx.config({
		debug: false,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: [
			'onMenuShareTimeline',
			'onMenuShareAppMessage',
			'onMenuShareQQ',
			'onMenuShareWeibo',
			'onMenuShareQZone'
		]
	});
	var sharelink = "http://wx.scnjnews.com/dangyuan/index.php" ;//分享跳转地址
</script>
<script src="share.js"></script>
