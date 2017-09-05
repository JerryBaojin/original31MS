package ckplayeraction {
	import flash.display.Sprite;
	import flash.text.TextField;
	import flash.display.Loader;
	import flash.net.URLRequest;
	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.display.LoaderInfo;
	import flash.text.TextFormat;
	import flash.display.SimpleButton;

	public class Element {

		public static function newSprite(p: Object = null): Sprite { //建立一个圆角矩形
			var o: Object = {
				bgColor: 0x000000, //背景颜色
				borderColor: null, //边框颜色
				radius: 0, //圆角弧度
				bgAlpha: 100, //背景透明度
				width: 0,
				height: 0
			};
			o = script.mergeObject(o, p);
			//trace(o["width"], o["height"], o["radius"], o["radius"]);
			var m: Sprite = new Sprite();
			if (o["borderColor"]) {
				m.graphics.lineStyle(1, o["borderColor"], o["bgAlpha"] * 0.01);
			}
			m.graphics.beginFill(o["bgColor"], o["bgAlpha"] * 0.01); //背景色，透明度
			m.graphics.drawRoundRect(0, 0, o["width"], o["height"], o["radius"], o["radius"]);
			return m;
		}
		public static function newTriangle(p: Object = null): Sprite { //建立一个倒三角
			var o: Object = {
				bgColor: 0x000000, //背景颜色
				bgAlpha: 100, //背景透明度
				tWidth: 0,
				tHeight: 0
			};
			o = script.mergeObject(o, p);
			var s: Sprite = new Sprite();
			s.graphics.beginFill(o["bgColor"], o["bgAlpha"] * 0.01);
			s.graphics.moveTo(0, 0);
			s.graphics.lineTo(o["tWidth"], 0);
			s.graphics.lineTo(o["tWidth"] * 0.5, o["tHeight"]);
			s.graphics.lineTo(0, 0);
			s.graphics.endFill();
			return s;
		}
		public static function newLine(p: Object = null): Sprite { //建立直线
			var o: Object = {
				color: 0x000000, //背景颜色
				alpha: 100, //透明度
				width: 1,
				height: 1
			};
			o = script.mergeObject(o, p);
			var s: Sprite = new Sprite();
			s.graphics.lineStyle(o["height"], o["color"]);
			s.graphics.moveTo(0, 0);
			s.graphics.lineTo(o["width"], 0);
			s.alpha = o["alpha"] * 0.01;
			return s;
		}
		public static function newTitle(p: Object = null): TextField { //建立一个简单的文本框
			var o: Object = {
				text: "",
				color: "#FFFFFF",
				size: 16,
				face: "Microsoft YaHei,微软雅黑",
				width: 0,
				height: 0,
				alpha: 100
			}
			o = script.mergeObject(o, p);
			var t: TextField = new TextField();

			t.htmlText = "<font face='" + o["face"] + "' size='" + o["size"] + "' color='" + o["color"] + "'>" + o["text"] + "</font>";
			t.width = o["width"] > 0 ? o["width"] : t.textWidth + 5;
			t.height = o["height"] > 0 ? o["height"] : t.textHeight + 3;
			t.alpha = o["alpha"] * 0.01;
			trace("文字", o["text"], t.htmlText, o["color"]);
			return t;
		}
		public static function newElement(p: Object = null): Sprite {
			var o: Object = {
				url: "",
				width: 0,
				height: 0,
				radius: 0,
				alpha: 100
			}
			var nw: int = 0,
				nh: int = 0;
			var sp: Sprite = null;
			o = script.mergeObject(o, p);
			if (!o["url"]) {
				return null;
			}
			var spObj: Object = {
				bgColor: 0x000000, //背景颜色
				borderColor: null, //边框颜色
				radius: o["radius"], //圆角弧度
				bgAlpha: 100, //背景透明度
				width: o["width"],
				height: o["height"]
			};
			sp = newSprite(spObj);
			var img: Loader = null;
			img = new Loader();
			img.contentLoaderInfo.addEventListener(Event.COMPLETE, imgComHandler);
			img.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR, imgErrorHandler); //监听加载失败
			img.load(new URLRequest(o["url"]));
			function imgComHandler(event: Event) {
				var info: LoaderInfo = img.contentLoaderInfo;
				if (info["width"] <= 0 || info["height"] <= 0) {
					return null;
				}
				nw = o["width"] > 0 ? o["width"] : info["width"];
				nh = o["height"] > 0 ? o["height"] : info["height"];
				img.width = nw;
				img.height = nh;
				//构建最终的sprite

				var spM: Sprite = newSprite(spObj);
				sp.addChild(img);
				sp.addChild(spM);
				img.mask = spM;
				remove();
			}
			function imgErrorHandler(event: IOErrorEvent): void {
				remove();
			}
			function remove(): void {
				img.removeEventListener(Event.COMPLETE, imgComHandler);
				img.removeEventListener(IOErrorEvent.IO_ERROR, imgErrorHandler);
				img = null;
			}
			return sp;
		}
		public static function newText(p: Object = null): Sprite {
			var text: TextField = newTitle(p);
			var format: TextFormat = new TextFormat();
			format.leading = 0;
			text.defaultTextFormat = format;
			var sp: Sprite = new Sprite();
			sp.addChild(text);
			return sp;
		}
		public static function newBox(list: Array = null, back: Object = null): Sprite { //建立一个有圆角背景的文本元件
			if (!list) {
				return null;
			}
			var sp: Sprite = new Sprite();
			var i: int = 0;
			var nx: int = 0,
				ny: int = 0;
			var speArr: Array = [],
				coorArr: Array = [];
			for (i = 0; i < list.length; i++) {
				var con: Object = list[i];
				var style: String = con["type"];
				var spE: Sprite = null;
				switch (style) {
					case "text":
						spE = newText(con);
						break;
					default:
						spE = newElement(con);
						break;
				}
				if (spE) {
					nx += con["left"];
					speArr.push(spE);
					coorArr.push([nx, con["top"]]);
					con["width"] = spE.width;
					nx += con["width"] + con["right"];
				}
			}
			var backObj: Object = {
				bgColor: back["backgroundColor"], //背景颜色
				borderColor: back["borderColor"], //边框颜色
				radius: back["radius"], //圆角弧度
				bgAlpha: back["alpha"], //背景透明度
				width: nx,
				height: back["height"]
			};
			sp = newSprite(backObj);
			for (i = 0; i < speArr.length; i++) {
				trace(coorArr[i]);
				speArr[i].x = coorArr[i][0];
				speArr[i].y = coorArr[i][1];
				sp.addChild(speArr[i]);
			}
			return sp;
		}
		public static function newButton(p: Object = null): SimpleButton {
			var o: Object = {
				text: "自动",
				size: 14,
				face: "Microsoft YaHei,微软雅黑",
				left: 8,
				right: 8,
				top: 1,
				bottom: 5,
				alpha: 100,
				radius: 5,
				downBg: 0x000000,
				downColor: "#FFFFFF",
				overBg: 0x656565,
				overColor: "#EEFF00",
				over: false
			}
			o = script.mergeObject(o, p);

			var bgTextObj: Object = script.copyObject(o);
			bgTextObj["color"] = o["downColor"];
			var bgText: TextField = newTitle(bgTextObj);
			var bgBg: Object = script.copyObject(o);
			bgBg["bgColor"] = o["downBg"];
			bgBg["bgAlpha"] = o["alpha"];
			bgBg["width"] = bgText.width + Math.round(o["left"]) + Math.round(o["right"]);
			//trace(bgText.height,o["top"],o["bottom"]);
			bgBg["height"] = bgText.height + Math.round(o["top"]) + Math.round(o["bottom"]);
			var bg: Sprite = newSprite(bgBg);
			bgText.x = o["left"];
			bgText.y = o["top"];
			bg.addChild(bgText);

			var overTextObj: Object = script.copyObject(o);
			overTextObj["color"] = o["overColor"];
			var overText: TextField = newTitle(overTextObj);
			var overBg: Object = script.copyObject(o);
			overBg["bgColor"] = o["overBg"];
			overBg["bgAlpha"] = o["alpha"];
			overBg["width"] = overText.width + Math.round(o["left"]) + Math.round(o["right"]);
			overBg["height"] = overText.height + Math.round(o["top"]) + Math.round(o["bottom"]);
			var over: Sprite = newSprite(overBg);
			overText.x = o["left"];
			overText.y = o["top"];
			over.addChild(overText);

			var button: SimpleButton = new SimpleButton();
			if (o["over"]) {
				button.upState = over;
			}
			else {
				button.upState = bg;
			}

			button.overState = over;
			button.hitTestState = over;
			button.downState = over;
			return button;
		}
	}

}