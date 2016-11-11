<?php
	require_once "MessageModel.php";

	//这里两句话很重要,第一讲话告诉浏览器返回的数据是xml格式
	header("Content-Type: text/xml;charset=utf-8");
	//告诉浏览器不要缓存数据
	header("Cache-Control: no-cache");
	session_start();
	$sender=$_SESSION['sender'];
	$getter=$_SESSION['getter'];
	$message=$_POST['message'];
	
	file_put_contents("i://sendMessage.log",$sender.$getter.$message."\r\n",FILE_APPEND);
	//echo $message;
	//调用message的方法，来插入到数据库里
	$messageModel=new MessageModel();
	$b=$messageModel->addMessage($sender, $getter, $message);
	if($b==1){
		echo "插入成功";
	}else{
		echo "插入失败";
	}
	
	
?>