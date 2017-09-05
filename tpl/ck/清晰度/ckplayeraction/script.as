package ckplayeraction {
	import flash.utils.ByteArray;
	public class script {

		public function script() {
			// constructor code
		}
		public static function mergeObject(obj: Object = null, old: Object = null): Object { //把旧数组合并到新数组里
			var nObj: Object = obj;
			for (var k: String in old) {
				nObj[k] = old[k];
			}
			return nObj;
		}
		public static function getLen(str: String = ""): Number { //获取字符的长度
			if (!str) {
				return 0;
			}
			var digital: int = 0; //数字  
			var character: int = 0; //字母  
			var space: int = 0; //空格  
			var other: int = 0; //其它字符 
			for (var i: int = 0; i < str.length; i++) {
				if (str.charAt(i) >= '0' && str.charAt(i) <= '9') {
					digital++;
				}
				else if ((str.charAt(i) >= 'a' && str.charAt(i) <= 'z') || (str.charAt(i) >= 'A' && str.charAt(i) <= 'Z')) {
					character++;
				}
				else if (str.charAt(i) == ' ') {
					space++;
				}
				else {
					other++;
				}
			}
			return (digital + character + space + other * 2) * 0.5
		}
		public static function copyObject(obj: Object): * {
			var newObj: ByteArray = new ByteArray();
			newObj.writeObject(obj);
			newObj.position = 0;
			return newObj.readObject();
		}
	}

}