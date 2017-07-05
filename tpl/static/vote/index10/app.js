$(function($){
	$('.bottom_khdxz_close').click(function(){
		$(this).parents('.bottom_khdxz').hide();
	});

	$(".toupiao").on('click',function(e){
		if(false){//宸插叧娉�
			$(".toupiao_pop").show();
		} else {
			$(".guanzhu_pop").show();
		}
		e.preventDefault();
	});
	
	$(".fenxiang").on('click', function(e){
		$(".share_overmask").show().on('click', function(){
			$(this).hide();
		});
		e.preventDefault();
	});
	
	$(".close_pop_up").on('click',function(){
		$(this).parents(".pop").hide();
	});
	
	$("#do_apply").on('click', function(){
		var name = $("#name").val();
		var pname = $("#parent_name").val();
		var tel = $("#phone").val();
		var age = $("#age").val();
		var gender = $("input[name='gender']:checked").val();
		var talent = $("input[name='talent']:checked").val();
		var content = $("#message").val();
		var cnamereg = /^[\u0391-\uFFE5]+$/;

		if(name.length == 0){alert('璇疯緭鍏ヨ悓瀹濆鍚�');return false;}
		//if(!cnamereg.test(name)){alert('钀屽▋濮撳悕蹇呴』鏄腑鏂�');return false;}
		if(gender == ''|| gender == null || gender == undefined || gender == 'undefined'){alert('璇烽€夋嫨钀屽疂鎬у埆锛�');return false;}

		var agereg = /^\d{1,2}$/;
		if (age.length == 0) {alert("璇疯緭鍏ヨ悓瀹濆勾榫勶紒"); return false;}
		if(talent == ''|| talent == null || talent == undefined || talent == 'undefined'){alert('璇烽€夋嫨钀屽疂鏄惁鏈夋墠鑹猴紒');return false;}
		if(pname.length == 0){alert('璇疯緭鍏ュ闀垮鍚�');return false;}
		if(!cnamereg.test(pname)){alert('瀹堕暱濮撳悕蹇呴』鏄腑鏂�');return false;}

		var telreg = /^1[3|4|5|7|8][0-9]\d{8}$|^\d{8}$/;
		if (tel.length == 0) {alert("璇疯緭鍏ュ闀胯仈绯诲彿鐮侊紒"); return false;}
		if (!telreg.test(tel)){alert("璇疯緭鍏ユ纭殑鑱旂郴鍙风爜锛�(8浣嶅骇鏈哄彿鎴栬€�11浣嶆墜鏈哄彿)");return false;}


		var length = $("#imglist").find("li").length;
		if(length == ''|| length == null  || length == undefined || length == 'undefined' || length < 2 ){alert('璇蜂笂浼�2寮犱互涓婂浘鐗�');return false;}
		if(content== '' || content == null || content == undefined || content == 'undefined' ){alert('璇疯緭鍏ユ柊骞村瘎璇�!');return false;}
        $("#do_apply").attr('disabled', '');
        $("form").submit();

	});
});
