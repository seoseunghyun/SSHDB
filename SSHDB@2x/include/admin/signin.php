<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SSHDB Admin</title>
<script type="text/javascript" src="include/common/js/jquery-1.10.1.min.js"></script>
<style>
body{margin: 0 auto; text-align: center;font-family: "맑은 고딕", Tahoma, "돋움"; color: #575757;}
#header_bin{margin: 0 auto; position: relative; width: 914px; height: 127px;}
#header_wrap{margin: 0 auto; position: relative; width: 914px; }
#logo{margin: 0 auto; position: relative; width: 249px; height: 87px;}
#content{margin: 0 auto; position: relative; width: 249px; height: 85px; background: #7d7d7d;}
#container{margin: 0 auto; position:absolute; width: 209px; height: 60px; left: 20px; top:20px; color: #f2f2f2; text-align: left}
#bottom{margin: 0 auto; position: relative; width: 249px; height: 25px; background: #3c3c3c; color: #b2b2b2}
#copyright{margin: 0 auto; position: relative; width: 249px; height: 27px; color: #b3b3b3; font-size: 12px;}
.content_corner{margin: 0 auto; position: absolute; width: 10px; height: 27px; font-size: 0;}

#content_tl{top:0;left:0;}
#content_tr{top:0;left: 239px}
#content_bl{top:0;left: 0}
#content_br{top:0;left: 239px}

input {border: 0px none; background :none; outline: none; font-size: 13px; width: 95px; color: #d3d3d3;}

#info{margin: 0 auto; float: left; width: 189px; height: 87px;}
#btn_submit {cursor: pointer;}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('#input_id').focus();
	if( 'devicePixelRatio' in window && window.devicePixelRatio == 2 ){
		$('.presol').each(function(){$(this).attr('src',$(this).attr('src').replace('.', '@2x.'));});
	}
	$('#btn_submit').click(function(){
		$.ajax({
			type: 'POST',
			url: '<?=SSHDBS_URL?>action/signin.php',
			data: { id:$('#input_id').val(), password:$('#input_password').val() },
			success: function(result) {
			if(result!=1){alert(result);}else{location.reload();}},
			error: function(result) {
			alert("에러가 발생했습니다.");
			}
		});
	});
	$('.signin_input').keypress(function(e) {if (e.keyCode == 13) {
		$('#btn_submit').click();}
	});
	

});
</script>
</head>

<body>
<div id="header_bin"></div>


<div id="header_wrap">
	<div id="logo">
		<img src="<?=SSHDBS_URL?>img/logo.gif" width="189" height="87" alt="SSHDB" class="presol" />
	</div>
	<div id="content">
	<div id="content_tl" class="content_corner">
	<img src="<?=SSHDBS_URL?>img/table_tdtop_left.gif" width="10" height="27" alt="SSHDB" class="presol" />
	</div>
	<div id="content_tr" class="content_corner">
	<img src="<?=SSHDBS_URL?>img/table_tdtop_right.gif" width="10" height="27" alt="SSHDB" class="presol" />
	</div>
		<div id="container">
		ID :&nbsp;<input id="input_id" class="signin_input" type="text"><br />
		PASSWORD :&nbsp;<input id="input_password" class="signin_input" type="password">
		</div>
	</div>
<div id="bottom">
<span id="btn_submit">GO</span>
</div>

<div id="copyright"><br /><br /><br /><br /><br />
copyright by seoseunghyun.com
</div>

</div>

</body>
</html>