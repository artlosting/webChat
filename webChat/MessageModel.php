<?php
	require_once 'SqlHelper.class.php';
    class MessageModel{
		//发送的消息到数据库里
        function addMessage($sender,$getter,$message){
			$sql="insert into message(sender,getter,content,sendTime) values('$sender','$getter','$message',now())";
			$sqlHelper=new SqlHelper();
			$b=$sqlHelper->execute_dml($sql);
			return $b;
		}
		//从数据库里取出消息
		function getMessage($sender,$getter){
		    $sql="select * from message where getter='$getter' and sender='$sender' and isGet=0";
		    $sqlHelper=new SqlHelper();
		    $res=$sqlHelper->execute_dql2($sql);
			//遍历数组
			//输出为xml格式，格式为：<mes><id></id><sender><sender><getter></getter><content></content><sendtime></sendtime></mes>
			$messageInfo="<mes>";
        	for($i=0; $i<count($res); $i++){
        	    $row=$res[$i];
        	    $messageInfo.="<id>{$row['id']}</id><sender>{$row['sender']}</sender><getter>{$row['getter']}</getter><content>{$row['content']}</content><sendtime>{$row['sendTime']}</sendtime>";
        	}
        	$messageInfo.="</mes>";
        	$sql1="update message set isGet=1 where getter='$getter' and sender='$sender'";
        	$sqlHelper->execute_dml($sql1);
        	return $messageInfo;
        	$sqlHelper->close_connect();
		} 
	}
	
		
