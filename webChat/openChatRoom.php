<!DOCTYPE html>
<html>
<head>
	<?php
		$sender=$_GET['sender'];	
		$getter=$_GET['getter'];
		session_start();
		$_SESSION['sender']=$sender;
		$_SESSION['getter']=$getter;
	?>
<meta charset="UTF-8">
<title>网页版QQ聊天</title>
<script type="text/javascript">
	//创建ajax对象
	function createAjaxRequest(){
		var httpRequest="";
		if(window.ActiveXObject){
			httpRequest=new ActiveXObject("Microsoft.XMLHTTP");
		}else{
			httpRequest=new XMLHttpRequest();
		}
		return httpRequest;
	}
	
	//发送消息，并保存到数据库里
	function sendMessage(){
		myXmlHttpRequest="";
		myXmlHttpRequest=createAjaxRequest();
		
		if(myXmlHttpRequest){
			var url="sendMessageController.php";
			var date="message="+$('sentence').value;
			//alert(date);
			myXmlHttpRequest.onreadystatechange=function(){
				//alert("成功");
				if(myXmlHttpRequest.readyState==4){
					//alert("状态成功");
					if(myXmlHttpRequest.status==200){
					//	alert("进入了");
					}
				}
			}

			myXmlHttpRequest.open("POST",url,"true");
				myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			myXmlHttpRequest.send(date);
			var time=new Date().toLocaleString();
			$('allContent').value+="你对<?php echo $getter;?>说："+$('sentence').value+time+"\r\n";
		}
	}
	
	//接收信息
	function getMessage(){
		myXmlHttpRequest="";
		myXmlHttpRequest=createAjaxRequest();
		
		if(myXmlHttpRequest){
			var url="getMessageController.php";
			var date="Math.random()*100";
			//alert(date);
			myXmlHttpRequest.open("POST",url,"true");
			
			myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			myXmlHttpRequest.onreadystatechange=function (){
				//alert("成功");
				if(myXmlHttpRequest.readyState==4){
					//alert("状态成功");
					if(myXmlHttpRequest.status==200){
						//alert("进入了");
						//得到xml
						var res=myXmlHttpRequest.responseXML;
						var message=res.getElementsByTagName("content");
						var sendtime=res.getElementsByTagName("sendtime");

						if(message.length!=0){
							for(var i=0; i<message.length; i++){
								//xx对xx说：
								var str="<?php echo $getter;?> 对 <?php echo $sender;?> 说：" +message[i].childNodes[0].nodeValue+"  "+sendtime[i].childNodes[0].nodeValue;
								$('allContent').value+=str+"\r\n";
							}
						}else{
							//window.alert("暂时没有回话");	
							}
					}
				}
			};
			myXmlHttpRequest.send(date);
		}
	}
	setInterval("getMessage()",3000);
	
	//定义一个通用的函数			
	function $(id){
		return document.getElementById(id);
	}
</script>
<style type="text/css">
	.cons{
		width:100%;
		height:100%;
		
	}
	.cons .chatContent{
		width: 100%;
		height: 100%;
	}
	textarea{
		width:100%;
		height: 260px;
	}
	input[type='text']{
		width:60%;
	}
</style>
</head>

<body>
	<div class="cons">
		<div class="chatContent">
			<h1><span style="color:red;"><?php echo $sender;?></span>正在和<span style="color:red;"><?php echo $getter;?></span>聊天</h1>
			<textarea id="allContent"></textarea><br/>
			消息：<input type="text" name="sentence" id="sentence"/>
			<input type="button" value="发送" onclick="sendMessage()">
		</div>
	</div>
</body>
</html>
