
$(document).ready(function(){var sshdbs_action='include/admin/action/';var ctb_var='off';var ssh_status='n';var now_db,now_tb,now_ele,now_tb_align,now_tb_page;menu_btn_home();$('#navi').load(sshdbs_action+'load_navi.php');$('#btn_signout').click(function(){$.ajax({type:'POST',url:sshdbs_action+'signout.php',success:function(result){location.reload();},error:function(result){alert("오류가 발생하였습니다.");}});});$('#navi').on('click','.navi_tb_a',function(){now_id=$(this).attr('id').split('_');now_id_len=now_id[3];now_id.splice(0,4);now_id_real=now_id.join('_');now_db=now_id_real.substr(0,now_id_len);now_tb=now_id_real.substr(now_id_len);load_tb(now_db,now_tb);}).on('mouseover','.navi_db',function(){$('#'+$(this).attr('id')+'_del').show();}).on('mouseout','.navi_db',function(){$('.navi_db_del').hide();}).on('click','.navi_db_del',function(){if(confirm("DB를 삭제하시겠습니까?")==true){$.ajax({type:'POST',url:sshdbs_action+'delete_db.php',data:{val:$(this).attr('id')},success:function(result){if(result==1){load_tb('','');}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});}else{return;}}).on('mouseover','.navi_tb',function(){$('#'+$(this).attr('id')+'_del').show();}).on('mouseout','.navi_tb',function(){$('.navi_tb_del').hide();}).on('click','.navi_tb_del',function(){dtb_id=$(this).attr('id');if(confirm("Table을 삭제하시겠습니까?")==true){$.ajax({type:'POST',url:sshdbs_action+'delete_table.php',data:{val:$(this).attr('id')},success:function(result){if(result.substr(0,2)=='#1'){if(now_tb==result.substr(2)){now_db='';now_tb='';now_ele='';$('#navi').load(sshdbs_action+'load_navi.php');}
load_tb(now_db,now_tb);}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});}else{return;}}).on('focusin','.input_ctb',function(){$('.navi_ctb_btn').hide();db_id=$(this).attr('id').substr(15);$('#navi_ctb_btn_'+db_id).show();}).on('click','.navi_ctb_btn',function(){db_id=$(this).attr('id').substr(13);$.ajax({type:'POST',url:sshdbs_action+'create_table.php',data:{db:db_id,table:$('#navi_ctb_input_'+db_id).val()},success:function(result){if(result==1){$('#navi').load(sshdbs_action+'load_navi.php');}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});}).on('keypress','.input_ctb',function(e){if(e.keyCode==13){$('#navi_ctb_btn_'+$(this).attr('id').substr(15)).click();}}).on('mouseover','.navi_ctb_btn',function(){ctb_var='on';}).on('mouseout','.navi_ctb_btn',function(){ctb_var='off';}).on('focusout','.input_ctb',function(){if(ctb_var!='on'){$('.navi_ctb_btn').hide();}});$('#navi_btn_reload').click(function(){$('#navi').load(sshdbs_action+'load_navi.php');});$('#backup_create_btn').click(function(){$.ajax({type:'POST',url:sshdbs_action+'create_backup.php',data:{db:now_db,tb:now_tb},success:function(result){if(result==1){$('#backup_list').load(sshdbs_action+'load_backup_list.php?db='+now_db+'&tb='+now_tb,function(){var backup_list_line=parseInt(($('#backup_list_count').html()/4)-0.1);$('#content_tb_backup').animate({height:((backup_list_line*30)+85)+'px'});});load_sot();}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});});$('#backup_list').on('mouseover','.backup_list_wrap',function(){backup_id=$(this).attr('id').substr(17);$(this).css({width:'205px'});$('#backup_list_tool_'+backup_id).show();}).on('mouseout','.backup_list_wrap',function(){backup_id=$(this).attr('id').substr(17);$(this).css({width:'155px'});$('#backup_list_tool_'+backup_id).hide();}).on('click','.backup_btn_del',function(){backup_id=$(this).attr('id').substr(15);if(confirm(backup_id+" 백업을 삭제하시겠습니까?")==true){$.ajax({type:'POST',url:sshdbs_action+'delete_backup.php',data:{db:now_db,tb:now_tb,bu:backup_id},success:function(result){if(result==1){$('#backup_list').load(sshdbs_action+'load_backup_list.php?db='+now_db+'&tb='+now_tb,function(){var backup_list_line=parseInt(($('#backup_list_count').html()/4)-0.1);$('#content_tb_backup').animate({height:((backup_list_line*30)+85)+'px'});});load_sot();}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});}}).on('click','.backup_btn_push',function(){backup_id=$(this).attr('id').substr(16);if(confirm(now_tb+" 테이블을 \r\n"+backup_id+" 백업으로 대체(푸시)합니다.\r\n(현재 테이블은 자동으로 백업됩니다.)\r\n\r\n대용량 백업 푸시는\r\n수동 푸시를 권장합니다.")==true){$.ajax({type:'POST',url:sshdbs_action+'push_backup.php',data:{db:now_db,tb:now_tb,bu:backup_id},success:function(result){if(result==1){load_tb(now_db,now_tb);}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});}}).on('click','.backup_btn_view',function(){backup_id=$(this).attr('id').substr(16);$.ajax({type:'POST',url:sshdbs_action+'load_backup_table.php',data:{db:now_db,tb:now_tb,bu:backup_id},success:function(result){if(result==1){alert(result);}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});});$('#navi_cdb_open').click(function(){$('#navi_cdb_content').slideDown('fast');$('#navi_cdb_open').hide('fast');$('#navi_cdb_input').focus();});$('#navi_cdb_submit').click(function(){$.ajax({type:'POST',url:sshdbs_action+'create_db.php',data:{db:$('#navi_cdb_input').val()},success:function(result){if(result==1){$('#navi').load(sshdbs_action+'load_navi.php');$('#navi_cdb_input').val('');}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});});$('#navi_cdb_input').keypress(function(e){if(e.keyCode==13){$('#navi_cdb_submit').click();}});$('#navi_cdb_cancle').click(function(){$('#navi_cdb_content').slideUp('fast');$('#navi_cdb_open').show('fast');});$('#navi_clink_open').click(function(){$('#navi_clink_content').slideDown('fast');$('#navi_clink_open').hide('fast');$('#navi_clink_input').focus();});$('#navi_clink_submit').click(function(){$.ajax({type:'POST',url:sshdbs_action+'create_link.php',data:{db:$('#navi_clink_input').val(),dir:$('#navi_clink_dir_input').val()},success:function(result){if(result==1){$('#navi').load(sshdbs_action+'load_navi.php');$('#navi_clink_input').val('');}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});});$('#navi_clink_input').keypress(function(e){if(e.keyCode==13){$('#navi_clink_submit').click();}});$('#navi_clink_dir_input').keypress(function(e){if(e.keyCode==13){$('#navi_clink_submit').click();}});$('#navi_clink_cancle').click(function(){$('#navi_clink_content').slideUp('fast');$('#navi_clink_open').show('fast');});$('#search_input').keyup(function(){$('#content_search').load(sshdbs_action+'search_all.php?val='+$(this).val());});$('#content_tb_header').on('click','.content_edit_toggle',function(){$('#content_edit_title_input').val(now_tb);$('#content_a_title').toggle();$('#content_edit_title').toggle();}).on('click','#content_a_title',function(){$('#content_edit_title_input').focus();}).on('keypress','#content_edit_title_input',function(e){if(e.keyCode==13){$('#content_edit_title_o').click();}}).on('keyup','#content_edit_title_input',function(e){if(e.keyCode==27){$('#content_edit_title_cancle').click();}}).on('click','#content_edit_title_o',function(){$.ajax({type:'POST',url:sshdbs_action+'modify_table.php',data:{act:'id',db:now_db,tb:now_tb,val:$('#content_edit_title_input').val()},success:function(result){if(result==1){now_db_b=$('#content_edit_title_input').val().split(',')
load_tb(now_db,now_db_b[0]);}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});}).on('click','.content_edit_tag_toggle',function(){$('#content_edit_tag_input').val($('#content_a_tag_content').html());$('#content_a_tag').toggle();$('#content_edit_tag').toggle();}).on('click','#content_a_tag',function(){$('#content_edit_tag_input').focus();}).on('keypress','#content_edit_tag_input',function(e){if(e.keyCode==13){$('#content_edit_tag_o').click();}}).on('keyup','#content_edit_tag_input',function(e){if(e.keyCode==27){$('#content_edit_tag_cancle').click();}}).on('click','#content_edit_tag_o',function(){$.ajax({type:'POST',url:sshdbs_action+'modify_table.php',data:{act:'tag',db:now_db,tb:now_tb,val:$('#content_edit_tag_input').val()},success:function(result){if(result==1){$('#content_tb_header').load(sshdbs_action+'load_content_header_tb.php?db='+now_db+'&tb='+now_tb);load_sot();}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});});$('#content_tb_table_wrap').on('click','.content_tb_table',function(){var now_get_b=$(this).attr('id').substr(17).split('_');var now_id_b=now_get_b[0];var now_attr_b=now_get_b[1];$.ajax({type:'POST',url:sshdbs_action+'load_content_textarea.php',data:{db:now_db,tb:now_tb,type:'ele',id:now_id_b,attr:now_attr_b},success:function(result){$('#ts_textarea').val(result);$('#ts_textarea_status').html('[ELE] '+now_id_b+' > '+now_attr_b);$('.content_tb_table').css('color','#7d7d7d');$('#content_tb_table_'+now_id_b+'_'+now_attr_b).css('color','#e4477e');},error:function(result){alert("오류가 발생했습니다.");}});});$('#content_tb_title_wrap').on('click','.content_tb_title',function(){var this_id_b=$(this).attr('id').substr(17);if(this_id_b=='id'||this_id_b=='date'||this_id_b=='tag'||this_id_b=='option'){}else{$.ajax({type:'POST',url:sshdbs_action+'load_content_textarea.php',data:{db:now_db,tb:now_tb,type:'var',id:$(this).attr('id').substr(17),attr:'id'},success:function(result){$('#ts_textarea').val(result);$('#ts_textarea_status').html('[VAR] '+now_id_b+' > '+'id');},error:function(result){alert("오류가 발생했습니다.");}});}});$('#ts_textarea_modify_submit').click(function(){alert('준비 중입니다.')});$('#dele_btn').click(function(){if(!now_ele){alert('선택한 Element가 없습니다.');return false;}
if(confirm(now_ele+" Element를 삭제하시겠습니까?")==true){$.ajax({type:'POST',url:sshdbs_action+'delete_ele.php',data:{db:now_db,tb:now_tb,ele:now_ele},success:function(result){if(result==1){loag_tb_table(now_db,now_tb,now_tb_align);load_sot();now_ele='';}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});}});$('#content_tb_table_wrap').on('click','.content_tb_selector',function(){table_select($(this).attr('id').substr(22));}).on('click','#table_cele_btn',function(){var attr_array,change_array;$('.table_td_cele_input').each(function(){if($(this).attr('id')!='table_cinput_id'&&$(this).attr('id')!='table_cinput_tag'&&$(this).attr('id')!='table_cinput_date'){attr_array+=','+$(this).attr('id').substr(13);if($(this).val()==''){$(this).val('null');}
change_array+=','+$(this).val();}});attr_array=attr_array.substr(10);change_array=change_array.substr(10);$.ajax({type:'POST',url:sshdbs_action+'create_ele.php',data:{db:now_db,tb:now_tb,ele:$('#table_cinput_id').val(),tag:$('#table_cinput_tag').val(),attr:attr_array,change:change_array},success:function(result){if(result==1){loag_tb_table(now_db,now_tb,now_tb_align);load_sot();}else{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});})
$('#content_tb_title_wrap').on('click','.content_tb_align_toggle',function(){$('.content_tb_align_'+$(this).attr('id').substr(19)).toggle();var table_align_val='';$('.content_tb_align_1').each(function(){if($(this).css('display')!='none'){table_align_val=table_align_val+','+$(this).attr('id').substr(19);}});table_align_val=table_align_val.substr(1);now_tb_align=table_align_val;loag_tb_table(now_db,now_tb,now_tb_align,'content');}).on('click','#content_tb_toggler',function(){$('.content_tb_selector_0').click();}).on('keyup','.content_tb_search_input',function(){this_id=$(this).attr('id').substr(24);loag_tb_table(now_db,now_tb,now_tb_align,'content',now_tb_page,$(this).val(),this_id);});function table_select(eleid){now_ele='';$('#content_tb_selector_0_'+eleid).toggle();$('#content_tb_selector_1_'+eleid).toggle();if($('#content_tb_selector_wrap_'+eleid).hasClass('content_tb_select_0')){$('.content_tb_table_'+eleid).css({'background-color':'#f7cfda'});$('#content_tb_selector_wrap_'+eleid).addClass('content_tb_select_1');$('#content_tb_selector_wrap_'+eleid).removeClass('content_tb_select_0');}else{if($('.content_tb_table_'+eleid).hasClass('content_tb_bgcolor_0')){$('.content_tb_table_'+eleid).css({'background-color':'#e8e8e8'});}else{$('.content_tb_table_'+eleid).css({'background-color':'#f6f6f6'});}
$('#content_tb_selector_wrap_'+eleid).addClass('content_tb_select_0');$('#content_tb_selector_wrap_'+eleid).removeClass('content_tb_select_1');}
$('.content_tb_select_1').each(function(){now_ele+=','+$(this).attr('id').substr(25);})
now_ele=now_ele.substr(1);}
$('#menu_log').click(function(){if($('#menu_log_btn').css('display')=='none'){$.ajax({type:'POST',url:sshdbs_action+'modify_set.php',data:{set:"log",change:"1"},success:function(result){if(result!=98)
{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});$('#menu_log_btn').css('display','inline');}else{$.ajax({type:'POST',url:sshdbs_action+'modify_set.php',data:{set:"log",change:"0"},success:function(result){if(result!=98)
{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});$('#menu_log_btn').css('display','none');}});$('#menu_foc_slider').click(function(){if($('#menu_foc_1').css('display')=='none'){$.ajax({type:'POST',url:sshdbs_action+'modify_set.php',data:{set:"cache_frequency",change:"1"},success:function(result){if(result!=98)
{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});$('#menu_foc_1').css('display','inline');}else{$.ajax({type:'POST',url:sshdbs_action+'modify_set.php',data:{set:"cache_frequency",change:"0"},success:function(result){if(result!=98)
{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});$('#menu_foc_1').css('display','none');}});$('#ts_cvar_btn').click(function(){var check='off';if($('#ts_check_cvar').hasClass('ssh_check_1')){check='on'}else{check='off'}
$.ajax({type:'POST',url:sshdbs_action+'ts_create.php',data:{db:now_db,tb:now_tb,id:$('#input_cvar_id').val(),tag:$('#input_cvar_tag').val(),type:'var',check:check},success:function(result){if(result==1){load_tb(now_db,now_tb);}else
{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});});$('#ts_cele_btn').click(function(){var check='off';if($('#ts_check_cele').hasClass('ssh_check_1')){check='on'}else{check='off'}
$.ajax({type:'POST',url:sshdbs_action+'ts_create.php',data:{db:now_db,tb:now_tb,id:$('#input_cele_id').val(),tag:$('#input_cele_tag').val(),type:'ele',check:check},success:function(result){if(result==1){load_tb(now_db,now_tb);}else
{alert(result);}},error:function(result){alert("오류가 발생했습니다.");}});});function load_tb(db,tb){now_db=db;now_tb=tb;now_tb_align='';$('#navi').load(sshdbs_action+'load_navi.php');if(!now_db&&!now_tb){menu_btn_home();}else{$('.content_tb').show();load_effect('tb');loag_tb_table(db,tb,'');$('#content_tb_header').load(sshdbs_action+'load_content_header_tb.php?db='+db+'&tb='+tb);$('#backup_list').load(sshdbs_action+'load_backup_list.php?db='+db+'&tb='+tb,function(){var backup_list_line=parseInt(($('#backup_list_count').html()/4)-0.1);$('#content_tb_backup').animate({height:((backup_list_line*30)+85)+'px'});});menu_btn_view();load_sot();}}
function load_ana(){$('#home_ana_gr').load(sshdbs_action+'load_ana.php',function(){$('.home_ana_rg_ele').each(function(){now_date_id=$(this).attr('id').substr(16);now_count=$('#home_ana_rg_subtitle_ele_'+now_date_id).html();count_max=$('#home_ana_rg_max').html();real_height=parseInt((120*now_count)/count_max);real_top=120-real_height;$(this).animate({height:real_height+'px',top:real_top+'px'});});});}
function loag_tb_table(db,tb,align,type,page,search_val,search_attr){if(!search_val){search_val='';}
switch(type){case'content':$('#content_tb_table_wrap').load(sshdbs_action+'load_table_content.php?db='+db+'&tb='+tb+'&page='+page+'&align='+align+'&search='+search_val+'&attr='+search_attr);break;default:$('#content_tb_title_wrap').html('');$('#content_tb_table_wrap').html('');$('#content_tb_under_wrap').html('');$('#content_tb_title_wrap').load(sshdbs_action+'load_table_title.php?db='+db+'&tb='+tb+'&page='+page+'&align='+align);$('#content_tb_table_wrap').load(sshdbs_action+'load_table_content.php?db='+db+'&tb='+tb+'&page='+page+'&align='+align+'&search='+search_val+'&attr='+search_attr);$('#content_tb_under_wrap').load(sshdbs_action+'load_table_under.php?db='+db+'&tb='+tb+'&page='+page+'&align='+align);break;}}
function load_sot(){$.ajax({type:'POST',url:sshdbs_action+'sot_size.php',data:{db:now_db,tb:now_tb},success:function(result){result_split=result.split(',')
result_backup=parseInt((result_split[0]*725)/100);result_stack=parseInt((result_split[1]*725)/100);$('#sot_backup').animate({width:result_backup+'px'});$('#sot_stack').animate({width:result_stack+'px'});$('#sot_sc_entire').html(result_split[2]);$('#sot_sc_backup').html(result_split[3]);$('#sot_sc_stack').html(result_split[4]);},error:function(result){alert("오류가 발생했습니다.");}});}
$('#menu_btn_home_wrap').click(function(){menu_btn_home();});$('#menu_btn_view_wrap').click(function(){menu_btn_view();});function menu_btn_home(){$('.menu_btn').hide();$('.content_wrap').hide();$('.content_home').show();$('#menu_btn_home').show();$('#home_info_load').load(sshdbs_action+'load_home_info.php');load_ana();}
function menu_btn_view(){if(!now_db&&!now_tb){alert('선택된 테이블이 없습니다.');}else{$('.menu_btn').hide();$('.content_wrap').hide();$('.content_tb').show();$('#menu_btn_view').show();}}
function load_effect(attr){switch(attr){case'backup':$('#backup_list').html('Loading.....');break;case'tb':$('#backup_list').html('Loading...');$('#sot_sc_entire').html('Loading...');$('#sot_sc_backup').html('Loading...');$('#sot_sc_stack').html('Loading...');$('#content_a_title').html('');break;}}
$('#content_tb_table').scroll(function(){if($(window).scrollTop()>700)
{$('.aa').each(function(){$(this).css({'left':800-$('#content_tb_table').scrollLeft()});});}});$('.ssh_check').each(function(){$(this).addClass('ssh_check_0');});$('.ssh_check_0').mousemove(function(){if(!$(this).hasClass('ssh_check_1')){$(this).css({'background-position':'-23px'})}}).mouseout(function(){if(!$(this).hasClass('ssh_check_1')){$(this).css({'background-position':'0px'})}}).click(function(){if(!$(this).hasClass('ssh_check_1')){$(this).removeClass('ssh_check_0').addClass('ssh_check_1').css({'background-position':'-46px'});}else{$(this).removeClass('ssh_check_1').addClass('ssh_check_0').css({'background-position':'0px'});}});});$(window).scroll(function(){if($(window).scrollTop()>700)
{$('.aa').css({'position':'fixed','top':'5px','color':'black'});}else{$('.aa').css({'position':'static','color':'white'});}});