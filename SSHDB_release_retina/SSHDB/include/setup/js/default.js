
$(document).ready(function(){var sshdbs_action='include/setup/action/';var content_wrap_now=1;if('devicePixelRatio'in window&&window.devicePixelRatio==2){$('.presol').each(function(){$(this).attr('src',$(this).attr('src').replace('.','@2x.'));});$('.presol_bg').each(function(){$(this).css({'background-image':$(this).css('background-image').replace('.','@2x.')});});}
if(sshdb_client_phpversion>=5.1){$('#check_php').css({'background-position':'-46px'});$('#check_php').addClass('check_on');}
if(sshdb_client_rewrite==1){$('#check_rewrite').css({'background-position':'-46px'});$('#check_rewrite').addClass('check_on');}
if(sshdb_client_permission==1){$('#check_permission').css({'background-position':'-46px'});$('#check_permission').addClass('check_on');}
$('#input_id').keypress(function(e){if(e.keyCode==13){$('#btn_next_0').click();}})
$('#input_password').keypress(function(e){if(e.keyCode==13){$('#btn_next_0').click();}})
$('.btn_next').hover(function(){$('#btn_next_0').hide();$('#btn_next_1').show();},function(){$('#btn_next_1').hide();$('#btn_next_0').show();}).click(function(){if(!$('#check_php').hasClass('check_on')||!$('#check_rewrite').hasClass('check_on')||!$('#check_permission').hasClass('check_on')){alert('현재 서버 상태를 다시 확인하세요.');return false;}
if(content_wrap_now==3){if(!$('#input_id').val()||!$('#input_password').val()){alert('사용자 아이디와 비밀번호를 입력하세요.');return false;}}
if(content_wrap_now==4){$.ajax({type:'POST',url:sshdbs_action+'submit.php',data:{id:$('#input_id').val(),password:$('#input_password').val()},success:function(result){alert(result);location.reload();},error:function(result){alert("오류가 발생했습니다. 새로고침 합니다.");location.reload();}});return false;}
$('.content_wrap').hide();content_wrap_now++;$('#cw_'+content_wrap_now).show('normal',function(){if(content_wrap_now==3){$('#input_id').focus();}
$('#btn_next_1').hide();$('#btn_next_0').show();});});});