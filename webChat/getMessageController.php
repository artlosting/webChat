<?php
	require_once "MessageModel.php";
	//这里两句话很重要,第一讲话告诉浏览器返回的数据是xml格式
	header("Content-Type: text/xml;charset=utf-8");	 
	//告诉浏览器不要缓存数据
	header("Cache-Control: no-cache");
	session_start();
	//发送人为接收人了，而接收人为发送人了
	$getter=$_SESSION['sender'];
	$sender=$_SESSION['getter'];
	//echo $message;
	//调用message的方法，来插入到数据库里
	$messageModel=new MessageModel();
	$res=$messageModel->getMessage($sender,$getter);
	file_put_contents("i://getMessage.log",$res."\r\n",FILE_APPEND);
	echo $res;
	
?>