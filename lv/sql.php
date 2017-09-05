<?php

date_default_timezone_set('PRC');
class mysql{
    private $mysql;
      function __construct()
    {
        $sql = new mysqli('localhost','root','102098hchab','weixin');
        $sql->query("SET NAMES UTF8");
        $sql->query("set character set 'utf8'");//读库
        $sql->query("set names 'utf8'");//写库
        $sql->query("set names 'utf8'");
        $this-> mysql=$sql;
    }
    public function toresult($sql){
      $mysql= $this->mysql;
      $arrs=array();
     if (  $re=$mysql->query($sql))
     {
        while($arr=$re->fetch_array(MYSQLI_ASSOC))
        {
            $arrs[]=$arr;
        }
     }
        return $arrs;

    }

    public function insert($insert){
        $mysql= $this->mysql;
       $q=$mysql->query($insert);
        return $q;
    }

}


