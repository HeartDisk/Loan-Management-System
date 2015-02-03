<?php $this->load->view('common/meta'); ?>
<style>
.left_box {
	float: left;
	width: 400px;
	margin: 10px 5px;
	border-right: 1px dashed #ddd;
}
.mhead {
	background-color: #3E798C;
	color: #FFF;
	text-align: right;
	padding: 6px;
	font-size: 16px;
}
.mcontent {
	background-color: #FFF;
	border-bottom: 1px solid #3E798C;
	color: #000;
	text-align: right;
	padding: 6px;
	font-size: 16px;

}
.pcontent {
	background-color: #EFEFEF;
	border-bottom: 1px solid #DDD;
	color: #000;
	text-align: right;
	padding: 6px 2px;
	font-size: 13px;
}
.right_box {
	float: left;
	border-left: 1px dashed #ddd;
	width: 555px;
	margin: 10px 5px;
}
.buttonpanel {
	padding: 5px 0px;
	text-align: left;
}
.cleft {
	float: left;
	font-size: 11px;
}
.error_ping {
	color: #F00;
}
#ux_count {
	margin-right: 10px;
	font-size: 19px;
	font-family: 'Droid Arabic Kufi', serif !important;
	text-shadow: 1px 1px 1px #000, 1px 1px 5px blue;
	color: #FFF !important;
}
.editperm {
	float: left;
	width: 20px;
	cursor: pointer;
    margin-left:20px;
}
.hcss {
	background-color: #FC3 !important;
}
#all_box {
	float: left;
	font-size: 12px !important;
}
</style>
<div class="body">
<?php $this->load->view('common/banner');?>
<div id="tasjeel"></div>
<div class="body_contant">
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <div class="main_box" style="margin-top:10px;">
      <form name="frm_user_permission" id="frm_user_permission" method="post" autocomplete="off">
        <div class="left_box">
          <div class="form_raw">
            <div class="form_field_selected">
              <?php role_dropbox('user_parent_role','parent');?>
            </div>
            <div class="form_field_selected">
              <?php role_dropbox('user_role_id','child');?>
            </div>
            <input type="button" id="all_users" style="font-size:13px !important; padding: 3px 22px !important;" class="btnx" value="الموظفين">
          </div>
          <div class="mhead mmxx">الموظفين<span id="ux_count"></span></div>
          <div id="user_role" class="mmxx" style="overflow-y: scroll; overflow-x: hidden; height: 288px;"> </div>
        </div>
        <div class="right_box">
          <div class="mhead">اسم وحدة <span id="all_box">
            <input type="checkbox" id="selectall" />
            تحديد كافة</span></div>
          <?PHP foreach($m_list as $m) { $mxid = $m->moduleid; ?>
              <input type="hidden" name="module[]" value="<?PHP echo $mxid; ?>" />
              <div class="mcontent">
                  <div style="background-color:#FFF !important; border-bottom: 0px !important;" class="pcontent p_count" id="p_<?PHP echo $mxid; ?>"><strong style="font-size: 20px;"><?PHP echo $m->module_name; ?></strong>
            <span class="cleft"><?PHP if($mxid!=8) { ?>مشاهده<?PHP } ?><input type="checkbox" data-id="<?PHP echo $mxid; ?>" checked="checked" <?PHP if($mxid==8) { ?> style="display: none;" <?PHP } ?> class="pcount justmodule" id="vx<?PHP echo $mxid; ?>" name="v_<?PHP echo $mxid; ?>" value="1" /></span>
</div>

             </div>
          <?PHP foreach($this->inq->childe_module($m->moduleid) as $mc) { 
			$mid = $mc->moduleid;
			
		?>
          <input type="hidden" name="module[]" value="<?PHP echo $mid; ?>" />
          <div class="pcontent p_count" id="p_<?PHP echo $mid; ?>"><input type="checkbox" class="allm allundermodule<?PHP echo $mxid; ?>" id="<?PHP echo $mid; ?>"/> <?PHP echo $mc->module_name; ?> <span class="cleft">مشاهده
            <input type="checkbox" class="pcount mushahida allundermodule<?PHP echo $mxid; ?>" data-id="<?PHP echo $mid; ?>" id="vx<?PHP echo $mid; ?>" name="v_<?PHP echo $mid; ?>" value="1" />
            إضافة
            <input type="checkbox" onclick="checkback('<?PHP echo $mid; ?>');" class="vcheck pcount mongo<?PHP echo $mid; ?> allundermodule<?PHP echo $mxid; ?>" id="ax<?PHP echo $mid; ?>" name="a_<?PHP echo $mid; ?>" value="1" />
            تحديث
            <input type="checkbox" onclick="checkback('<?PHP echo $mid; ?>');" class="vcheck pcount mongo<?PHP echo $mid; ?> allundermodule<?PHP echo $mxid; ?>" id="ux<?PHP echo $mid; ?>" name="u_<?PHP echo $mid; ?>" value="1" />
            حذف
            <input type="checkbox" onclick="checkback('<?PHP echo $mid; ?>');" class="vcheck pcount mongo<?PHP echo $mid; ?> allundermodule<?PHP echo $mxid; ?>" id="dx<?PHP echo $mid; ?>" name="d_<?PHP echo $mid; ?>" value="1" />
            </span> </div>
          <?PHP } ?>
          <?PHP } ?>
            <?PHP if(check_permission($module,'u')==1 || check_permission($module,'a')==1) { ?><div class="buttonpanel"> <span class="error_ping"></span>
            <button type="button" id="save_user_perm" class="btnx ">حفظ</button>
          </div>
            <?PHP } ?>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');?>
<script>
function checkback(mid)
{
	var mlen = $(".mongo"+mid+":checked").length;
	
	if(mlen>0)
	{
		$("#vx"+mid).prop('checked', true);
	}
	else
	{
		$("#vx"+mid).prop('checked',false);
	}
}

function editpermission(uid)
{
    $('#vx8').prop('checked',true);
	var perm_json = $.ajax({
	  url: config.BASE_URL+'ajax/getpermission',
	  type: "POST",
	  data:{uid:uid},			  
	  dataType: "json",			  
	  success: function(msg){
		  $('.ucount, .pcount').prop('checked',false);
		  $('.u_count').removeClass('hcss');
		  $('#chk_'+uid).prop('checked',true);
		  $('#win_'+uid).addClass('hcss');
		  $.each(msg, function(moduleid,mvalue) {
			  $.each(mvalue,function(mchild,mcvalue){
				  if(mcvalue==1)
				  {	$('#'+mchild+'x'+moduleid).prop('checked',true);	}
				  else
				  { $('#'+mchild+'x'+moduleid).prop('checked',false);    }
			  });
			});
          $('#vx8').prop('checked',true);
		  }
	});
}

$(function(){
	$('.mmxx').hide();
	$('#selectall').click(function(){
		var xyz = $(this).is(':checked');
		if(xyz==true)
		{	$('.pcount').prop('checked',true);	}
		else
		{	$('.pcount').prop('checked',false);	}
	});

    $('.mushahida').click(function(){
       var moduleid = $(this).attr('data-id');
        if($(this).is(':checked'))
        {

            $('#ax'+moduleid).prop('checked',true);
            $('#dx'+moduleid).prop('checked',true);
            $('#ux'+moduleid).prop('checked',true);
        }
        else
        {

            $('#ax'+moduleid).prop('checked',false);
            $('#dx'+moduleid).prop('checked',false);
            $('#ux'+moduleid).prop('checked',false);
        }
    });

    $('.justmodule').click(function(){
        var moduleid = $(this).attr('data-id');
        if($(this).is(':checked'))
        {
            $('.allundermodule'+moduleid).prop('checked',true);
        }
        else
        {
            $('.allundermodule'+moduleid).prop('checked',false);
        }
    });

	$('#save_user_perm').click(function(){
		var users_count = $('.ucount:checked').length;
		var permission_count = $('.pcount:checked').length;
		if(users_count <= 0)
		{
			$('.error_ping').html('حدد مستخدم واحد على الأقل');
			nimbus('u_count');			
		}
		else if(permission_count <=0)
		{
			$('.error_ping').html('حدد وحدة واحدة على الأقل');
			nimbus('p_count');
		}
		else
		{
			document.frm_user_permission.submit();
		}
	});

    $('.allm').click(function(){
        var idx = $(this).attr('id');
        if($(this).is(':checked'))
        {
            $('#vx'+idx).prop('checked',true);
            $('#ax'+idx).prop('checked',true);
            $('#dx'+idx).prop('checked',true);
            $('#ux'+idx).prop('checked',true);
        }
        else
        {
            $('#vx'+idx).prop('checked',false);
            $('#ax'+idx).prop('checked',false);
            $('#dx'+idx).prop('checked',false);
            $('#ux'+idx).prop('checked',false);
        }
    });

	$('.rolex').change(function(){
        getUserRoles('roleandusers');
	});

    $('#all_users').click(function(){

        getUserRoles('justuser');
    });

    function getUserRoles(ajaxurl)
    {
        var user_parent_role = $('#user_parent_role').val();
        var user_role_id = $('#user_role_id').val();
        var big_bash = $.ajax({
            url: config.BASE_URL+'ajax/'+ajaxurl,
            type: "POST",
            data:{user_parent_role:user_parent_role,user_role_id:user_role_id},
            dataType: "json",
            success: function(msg){
                $('#user_role_id').html(msg.role);
                if(user_parent_role!='' && user_role_id!='')
                {
                    $('.mmxx').slideDown('slow');
                    $('#user_role').html(msg.user);
                    $('#ux_count').html(msg.uc);
                }
                else if(ajaxurl=='justuser')
                {
                    $('.mmxx').slideDown('slow');
                    $('#user_role').html(msg.user);
                    $('#ux_count').html(msg.uc);
                }
                else
                {
                    $('.mmxx').slideUp('slow');
                    $('#user_role').html('');
                    $('#ux_count').html('');
                    $('#user_role_id').val('');
                }
            }
        });
    }
	
	function nimbus(div)
	{
		var sec = 1000;		
		$('.'+div).each(function(index, element) {	
		sec_p = sec*index;	
            $('#'+$(this).attr('id')).effect("highlight",{},sec_p);				
        });
	}
	
});
</script> 
