package ckplayeraction {
	import flash.net.FileReference;
	import org.bytearray.gif.player.GIFPlayer;
	import org.bytearray.gif.events.GIFPlayerEvent;
	import org.bytearray.gif.events.FrameEvent;
	import flash.events.IOErrorEvent;
	import flash.net.URLRequest;
	public class loadGif {
		private var loadComplete: Function = null;
		private var gif: GIFPlayer = null;
		private var loadNumber: Boolean = true;
		public function loadGif(path: String,loadCom: Function = null) {
			// constructor code
			loadComplete = loadCom;
			// we create the GIFPlayer, GIF is played automatically
			gif = new GIFPlayer();
			gif.addEventListener(IOErrorEvent.IO_ERROR, gifIOError);
			// listen for the GIFPlayerEvent.COMPLETE event, dispatched when GIF is loaded
			gif.addEventListener(GIFPlayerEvent.COMPLETE, gifLoadComplete);
			gif.addEventListener(FrameEvent.FRAME_RENDERED, gifFrameRendered);
			gif.load(new URLRequest(path));
		}
		public function gifIOError(event: IOErrorEvent): void {
			loadComplete(null);
		}
		public function gifLoadComplete(event: GIFPlayerEvent): void {}
		public function gifFrameRendered(event: FrameEvent): void {
			var w: Number = event.frame.bitmapData.width;
			var h: Number = event.frame.bitmapData.height;
			if (loadNumber) {
				loadNumber = false;
				loadComplete(gif,w,h)
			}

		}
	}

}