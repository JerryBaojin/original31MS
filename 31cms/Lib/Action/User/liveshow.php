
<?php

header("Content-Type: text/html;charset=utf-8");
//
//
//
//https://live.xinhuaapp.com/?companyId=149852618370414&id=15000078608086

//db
function https_request($url,$data="")
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
$url="http://www.baidu.com";
/*

$re=https_request($url);
echo $re;
*/

$doc = new DOMDocument();
$re=$doc->loadHTMLFile($url);
var_dump($re) ;
echo $doc;

/*
$re=$html->load_file($url);
echo $html;
var_dump($re);*/
//$re=$doc->getElementById('app');

?>
