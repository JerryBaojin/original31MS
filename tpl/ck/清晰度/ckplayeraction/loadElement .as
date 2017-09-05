package ckplayeraction {
	import flash.display.Loader;
	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.net.URLRequest;
	import flash.display.LoaderInfo;

	public class loadElement {
		private var _l: Loader = null;
		private var com: Function = null;
		public function loadElement(s: String, k: Function = null) {
			// constructor code
			 com = k;
			_l = new Loader();
			_l.contentLoaderInfo.addEventListener(Event.COMPLETE, comLoad);
			_l.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR, errorLoad); //监听加载失败
			_l.load(new URLRequest(s));
		}
		private function comLoad(event: Event): void {
			var o: LoaderInfo = _l.contentLoaderInfo;
			if (com!=null) {
				com(_l, o.width, o.height);
			}
			remove();
		}
		private function errorLoad(event: IOErrorEvent): void {
			remove();
			if (com!=null) {
				com(null);
			}
		}
		private function remove(): void {
			_l.removeEventListener(Event.COMPLETE, comLoad);
			_l.removeEventListener(IOErrorEvent.IO_ERROR, errorLoad);
			_l = null;
		}
	}

}