<?php
error_reporting(E_ALL ^ E_DEPRECATED);
    //这是一个工具类，完成对数据的操作
    class SqlHelper{
        public $conn;
        public $dbname="webchat";
        public $username="root";
        public $password="root";
        public $host="localhost";
        
        //构造函数
        public function __construct(){
            $this->conn=mysql_connect($this->host,$this->username,$this->password);
            if(!$this->conn){
                die("连接不成功".mysql_error());
            }
            mysql_select_db($this->dbname,$this->conn);
            mysql_query("set names utf8");
        }
        //执行dql语句
        public function execute_dql($sql){
            $res=mysql_query($sql,$this->conn) or die(mysql_error());
            return $res;
        }
        //执行dql2语句
        public function execute_dql2($sql){
            $arr=array();
            $res=mysql_query($sql,$this->conn) or die(mysql_error());
            //把结果集的内容转移到数组中去
            while($row=mysql_fetch_assoc($res)){
                    $arr[]=$row;
            }
            //这样就可以马上把￥res关闭
            mysql_free_result($res);
            return $arr;
        }
        //考虑分页情况的查询，这是一个比较通用的并体现oop编程思想的代码
        public function execute_dql_fenye($sql1,$sql2){
            //这里我们查询要分页显示的数据
            $res=mysql_query($sql1,$this->conn) or die(mysql_error());
            $arr=array();
            while($row=mysql_fetch_assoc($res)){
                $arr[]=$row;    
            }
            mysql_free_result($res);
            $res2=mysql_query($sql2,$this->conn) or die(mysql_error());
            if($row=mysql_fetch_row($res2)){
                $fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
                $fenyePage->rowCount=$row[0];
            }
            mysql_free_result($res2);
            //把导航信息也封装到fenyePae对象中
            $navigate="";
            if($fenyePage->pageNow>1){
                
            }
        }
        
        //执行dml语句
        public function execute_dml($sql){
              $b=mysql_query($sql,$this->conn);
              if(!$b){
                  return 0;//不成功
              }else{
                  if(mysql_affected_rows($this->conn)>0){
                      return 1;//成功
                  }else{
                      return 2;//失败
                  }
              }
        }
        //第一一个关闭连接的方法
        public function close_connect(){
            if(!empty($this->conn)){
                mysql_close($this->conn);
            }
        }
        
    }
?>











