<!DOCTYPE html>
<html>	
<head>
<meta charset="UTF-8">
<?php
		$myname=$_GET['username'];
	?>
<title>网页版QQ聊天</title>
<link href="css/common.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">

	function change(obj,value){
		if(value=='over'){
			obj.style.color="red";
			obj.style.cursor="pointer";
			obj.style.listStylePosition="inside";
			obj.style.listStyleType="disc";
		
		
		}else if(value=='out'){
			obj.style.color="black";
			obj.style.listStyleType="desc";
			obj.style.listStylePosition="inside";
		}
	}
	window.onload=function(){
		var liStyle=document.getElementsByTagName("li");
		//alert(liStyle.length);
		for(var i=0; i<liStyle.length; i++){
			liStyle[i].style.listStyleType="disc";
			liStyle[i].style.listStylePosition="inside";
		}
	}
		//打开一个新窗口
	function openChatRoom(obj){
		var getter=obj.innerHTML;
		window.open("openChatRoom.php?sender=<?php echo $myname;?>&getter="+getter,"_blank","height=400, width=800, top=100, left=288,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no,directories=no");
	}
	
	function $(id){
		return document.getElementById(id);
	}
</script>
</head>
<body>
	<div class="chatRoom">
		<h1>网页版QQ聊天</h1>
		<div class="left">
			<div class="goodFriends">
				<h3>好友在线</h3>
				<ul>
					<li onmouseover="change(this,'over')" onmouseout="change(this,'out')" onclick="openChatRoom(this)">聂小倩</li>
					<li onmouseover="change(this,'over')" onmouseout="change(this,'out')" onclick="openChatRoom(this)">傅清风</li>
					<li onmouseover="change(this,'over')" onmouseout="change(this,'out')" onclick="openChatRoom(this)">董小卓</li>
					<li onmouseover="change(this,'over')" onmouseout="change(this,'out')" onclick="openChatRoom(this)">宁采臣</li>
					<li onmouseover="change(this,'over')" onmouseout="change(this,'out')" onclick="openChatRoom(this)">燕赤霞</li>
					<li onmouseover="change(this,'over')" onmouseout="change(this,'out')" onclick="openChatRoom(this)">王新育</li>
					<li onmouseover="change(this,'over')" onmouseout="change(this,'out')" onclick="openChatRoom(this)">姥姥</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>
