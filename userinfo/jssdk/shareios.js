wx.ready(function () {
   wx.onMenuShareTimeline({  //分享到朋友圈  
	   title: '我是'+nickname+'，邀你一起重温入党誓词！',//描述
	   link: sharelink, // 分享链接
	   imgUrl: 'http://wx.scnjnews.com/dangyuan/images/sdk2.jpg', // 分享图标
	   success: function () {
		  //alert("ok！");  // 用户确认分享后执行的回调函数
	   },
	   cancel: function () {
		 // alert("取消了分享！"); // 用户取消分享后执行的回调函数
	   }
   });
  wx.onMenuShareAppMessage({  //分享给好友  
	   title: '不忘初心“最内江”邀你一起重温入党誓词！', // 分享标题
	   desc: '我是'+nickname+',我已入党'+year+'年'+moth+'个月'+day+'天！',//描述
	   link: sharelink,// 分享链接
	   imgUrl: 'http://wx.scnjnews.com/dangyuan/images/sdk2.jpg', // 分享图标
	   success: function () {
		  //alert("ok！");  // 用户确认分享后执行的回调函数
	   },
	   cancel: function () {
		  //alert("取消了分享！"); // 用户取消分享后执行的回调函数
	   }
   });

  wx.onMenuShareQQ({  //分享到QQ 
	   title: '不忘初心“最内江”邀你一起重温入党誓词！', // 分享标题
	   desc: '我是'+nickname+',我已入党'+year+'年'+moth+'个月'+day+'天！',//描述
	   link: sharelink, // 分享链接
	   imgUrl: 'http://wx.scnjnews.com/dangyuan/images/sdk2.jpg', // 分享图标
	   success: function () {
		  //alert("ok！");  // 用户确认分享后执行的回调函数
	   },
	   cancel: function () {
		 // alert("取消了分享！"); // 用户取消分享后执行的回调函数
	   }
   });

  wx.onMenuShareWeibo({  //分享到微博  
	   title: '不忘初心“最内江”邀你一起重温入党誓词！', // 分享标题
	   desc: '我是'+nickname+',我已入党'+year+'年'+moth+'个月'+day+'天！',//描述
	   link: sharelink, // 分享链接
	   imgUrl: 'http://wx.scnjnews.com/dangyuan/images/sdk2.jpg', // 分享图标
	   success: function () {
		  //alert("ok！");  // 用户确认分享后执行的回调函数
	   },
	   cancel: function () {
		 // alert("取消了分享！"); // 用户取消分享后执行的回调函数
	   }
   });

  wx.onMenuShareQZone({  //分享到QQ空间 
	   title: '不忘初心“最内江”邀你一起重温入党誓词！', // 分享标题
	   desc:'我是'+nickname+',我已入党'+year+'年'+moth+'个月'+day+'天！',//描述
	   link: sharelink, // 分享链接
	   imgUrl: 'http://wx.scnjnews.com/dangyuan/images/sdk2.jpg', // 分享图标
	   success: function () {
		  //alert("ok！");  // 用户确认分享后执行的回调函数
	   },
	   cancel: function () {
		  //alert("取消了分享！"); // 用户取消分享后执行的回调函数
	   }
   });

});
