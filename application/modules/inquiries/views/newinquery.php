<style>
.web_dialog_overlay {
	position: fixed;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	height: 100%;
	width: 100%;
	margin: 0;
	padding: 0;
	background: #000000;
	opacity: .15;
	filter: alpha(opacity=15);
	-moz-opacity: .15;
	z-index: 101;
	display: none;
}
.web_dialog {
	position: fixed;
	width: 380px;
	height: 140px;
	top: 50%;
	left: 50%;
	margin-left: -190px;
	margin-top: -100px;
	background-color: #ffffff;
	border: 2px solid #0000;
	padding: 0px;
	z-index: 102;
	font-family: Verdana;
	font-size: 10pt;
	display: none;
}
.web_dialog_form {
	position: fixed;
	width: 405px;
	height: 300px;
	top: 50%;
	left: 50%;
	margin-left: -212px;
	margin-top: -100px;
	background-color: #ffffff;
	border: 2px solid #0000;
	padding: 13px;
	z-index: 102;
	font-family: Verdana;
	font-size: 10pt;
	display: none;
}
.web_dialog_title {
	border-bottom: solid 2px #0000;
	background-color: #CCC;
	padding: 4px;
	color: White;
	font-weight: bold;
	text-align: right;
}
.web_dialog_title a {
	color: White;
	text-decoration: none;
}
.align_right {
	text-align: Left;
}
.msg {
	text-align: center;
	padding-top: 16%;
}
.ui-dialog {
	top: 60px !important;
}

</style>
<script type="text/javascript">
function closePopup(){
		$("#overlay").hide();
		$("#dialog").hide();
		$("#dialog-form").hide();
}

function showPopup(id){
		$("#pk_id").val(id);	
		$("#dialog-form").show();
		$("#overlay").show();
		$("#dialog").show();
		$("#sms_msg").val('');
}

function check_sms(val){
	if(val == 1){
		$("#show_time").hide();
	}
	else{
		$("#show_time").show();
	}
}
/*
$(document).ready(function(){
	$('#date_time').datetimepicker({
		  
		});
});*/
</script>
<?php $this->load->view('common/meta');?>
<?PHP
	$main = $m['main'];
	//echo "<pre>";
	//print_r($main);	
?>
<div id="overlay" class="web_dialog_overlay"></div>
<div id="dialog-form" class="web_dialog_form">
  <div class="data">
    <form action="" method="POST" id="save_data_form1" name="save_data_form1">
      <table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
        <tr>
          <td class="web_dialog_title">ارسال الرسائل القصيرة</td>
          <td class="web_dialog_title align_right"><a href="javascript:void(0)" id="btnClose" onClick="closePopup()">X</a></td>
        </tr>
        <tr>
          <td><input type="hidden" name="parent_id" id="parent_id" /></td>
        </tr>
        <tr>
          <td><label class="radio-inline">
              <input type="radio" required=""  id="sms_time" class="sms_time" value="1" data-handler="128_204" checked="checked" name="sms_time" onchange="check_sms(this.value)">
              الآن </label>
            <label class="radio-inline">
              <input type="radio" id="sms_time2" class="sms_time" value="0" data-handler="128_204" name="sms_time" onchange="check_sms(this.value)">
              لاحقاً </label></td>
        </tr>
      </table>
      <div id="show_time" style="display:none;">
        <div class="form_txt" style="width: 99px;"> حدد التاريخ والوقت</div>
        <div class="form_field" style="padding-top: 5px; padding-bottom: 8px;">
          <input type="text"  class="txt_field" name="date_time" id="date_time" />
        </div>
      </div>
      <br   clear="all"/>
      <div class="form_txt" style="width: 99px;">رسالة </div>
      <div class="form_field">
        <input type="hidden" name="pk_id" id="pk_id" value="" />
        <textarea id="sms_msg" class="txt_field" name="expiry_msg" onKeyUp="CharacterCount(this.id,'expiry_count')"><?php echo (isset($inq_info_sms[0]->sms_value) ? $inq_info_sms[0]->sms_value : NULL);?></textarea>
      </div>
      <span style="float: right; padding-right: 29px;">عدد الأحرف المكتوبة</span> <span id="expiry_count" style="background-color:#f7f7f7; border:1px solid #bcc0c2;float:right;color:#030;"></span>
      <div class="main_withoutbg">
        <div class="add_question_btn">
          <input type="hidden" name="list_id" value="<?php echo $list_id;?>" />
          <input type="button" class="transperant_btn" name="submit"  onclick="submit_form()" value="إرسال" />
        </div>
      </div>
    </form>
  </div>
  <div class="user_field">
    <div class="add_team_btn">
      <input type="button" value="إضافة" class="transperant_btn" onclick="addnew()" />
    </div>
  </div>
</div>
<div class="body">
<?php $this->load->view('common/banner');?>
<div class="body_contant">
  <div id="dialog-confirm_dd" title="تحميل....." style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>من فضلك انتظر جاري تحميل البيانات .... <br />
      <img src="<?PHP echo base_url(); ?>images/ajaxloader.GIF" /></p>
  </div>
  <?php //$this->load->view('common/floatingmenu');?>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <form id="form2" name="form2" method="post" action="<?PHP echo md5(date('Ymdhisf')); ?>" autocomplete="off">
      <input type="hidden" name="tempid" id="tempid" value="<?PHP echo $main->tempid; ?>" />
      <?php if($t=='review') { ?>
      <input type="hidden" name="review" id="review" value="1" />
      <?PHP } ?>
      <script>
		$(function(){
		$('.inquirytypeid').click(function(){			
			var val = $(this).val();
			var chd = '.child_'+val;
			if($(this).is(':checked'))
			{
				$(chd).slideDown('slow');
			}	
			else
			{
				$(chd).slideUp('slow');
			}
		});	
		
		$('.childxxxxx').click(function(){			
			var val = $(this).val();
			var chd = '.smallchild_'+val;
			if($(this).is(':checked'))
			{
				$(chd).slideDown('slow');
			}	
			else
			{
				$(chd).slideUp('slow');
			}
		});	
			
	
		
		
		});
	</script>
      <?PHP if($t=='review') { ?>
      <script>
     $(function(){
     	var applicant_info = $.ajax({
					  url: config.AJAX_URL+'history/<?PHP echo $main->tempid; ?>',
					  type: "POST",
					  data:{value:1},
					  dataType: "html",
					  success: function(msg){ $('#feedback_content').html(msg);
					  	$('#feedback_content').show();
						$('#feedback_trigger').show();
						$('#feedback_trigger').click();
					  }
					});
     });
	
	CharacterCount = function(TextArea,FieldToCount){
	
	var myField = document.getElementById(TextArea);
	var myLabel = document.getElementById(FieldToCount); 
	//alert(myField);
	//alert(myLabel);
	//if(!myField || !myLabel){return false}; // catches errors
	//var MaxChars =  myField.maxLengh;
	//if(!MaxChars){MaxChars =  myField.getAttribute('maxlength') ; }; 	if(!MaxChars){return false};
	//var remainingChars =   MaxChars - myField.value.length
	if(myField.value.length>=70){
		
		$("#"+FieldToCount).css('color','red');
	}
	else{
		$("#"+FieldToCount).css('color','green');	
	}
	myLabel.innerHTML = myField.value.length;
}
/*function submit_form(){
		sms_text= $("#sms_msg").val();
		id= $("#pk_id").val();
		dateTime = $("#date_time").val();
		sms_time = $(".sms_time:checked").val();
		//sms_time
	var request = $.ajax({
					  url: config.BASE_URL+'inquiries/sendSms',
					  type: "POST",
					  data: { id : id , message : sms_text,dateTime,dateTime,sms_time:sms_time},
					  dataType: "html",
					  success: function(msg)
					  {
							 $("#sms_msg").val('');
							 CharacterCount('sms_msg','expiry_count');
							 show_notification('أرسلت الرسائل القصيرة بنجاح');
							 closePopup();	
					  }
					}); 
}
*/


</script>
      <?PHP } ?>
      <div class="main_box">
        <div class="data_box_title"> <a title="إضافة جديدة (Ctrl+F1)" class="addnewdata needtip" href="<?PHP echo base_url(); ?>inquiries/resetinq">إضافة جديدة</a>
          <?php if($main->tempid):?>
          <a class="addnewdata needtip" target="_blank" href="<?php echo base_url(); ?>inquiries/get_sms_history/1/<?php echo $main->tempid;?>">قائمة الرسائل النصية</a>
          <?php endif;?>
          <a class="addnewdata needtip" href="javascript:void(0)"  id="calc">حاسبة القروض</a>
          <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
          <?php if($t=='review') {
		  ?>
          <!--<div class="data_title" style="float: left; padding-left: 20px; cursor:pointer;" onclick="showPopup('<?PHP echo $main->tempid; ?>')"><img src="<?PHP echo base_url(); ?>/images/forward.png" height="26" width="26"></div>-->
          <?php
			 }
		  ?>
          <div class="data_title">تسجيل المراجعيين </div>
        </div>
        <div class="data_raw">
          <?PHP //noticeboard($main->tempid); ?>
          <div class="data">
            <div class="main_data">
              <div class="form_raw">
                <div class="user_txt">طبيعة المراجعين</div>
                <div class="user_field">
                  <label class="radio-inline">
                    <input type="radio" id="user_type" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>"  class="user_type tempmain" <?PHP if($main->user_type=='فردي') { ?>checked="checked"<?PHP } ?> name="user_type" value="فردي" data-title="personal"  required />
                    فردي </label>
                  <label class="radio-inline" >
                    <input type="radio" id="user_type" class="user_type tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" name="user_type" <?PHP if($main->user_type=='مشترك') { ?>checked="checked"<?PHP } ?> value="مشترك" data-title="partner" />
                    مشترك </label>
                  <?PHP if($t!='review') { ?>
                  <div id="addmore_partner"  <?PHP if($main->user_type=='مشترك') { ?>style="display:block !important; <?PHP } ?>cursor:pointer;">إضافة مشترك </div>
                  <?PHP } ?>
                </div>
              </div>
              <?PHP $nt = 0; 			 		
			  		if($main->applicant)
					{
						foreach($main->applicant as $in=>$appli) {  
				if($nt!=0)
				{
					$class = 'ppback';
				}
			?>
            <input type="hidden" name="applicantid[]" id="applicantid<?php echo $in ?>" value="<?php echo $appli->applicantid; ?>" />
              <div class="personal bigbangtheory <?PHP echo $class; ?>" id="personalbingo<?PHP echo $appli->applicantid; ?>">
                <div class="form_raw">
                  <div class="user_txt">الاسم الأول</div>
                  <div class="user_field">
                    <input name="first_name_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->first_name; ?>" placeholder="الاسم الأول" id="first_name" type="text" class="txt_field req tempapplicant">
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">الاسم الثاني</div>
                  <div class="user_field">
                    <input name="middle_name_<?PHP echo $appli->applicantid; ?>"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->middle_name; ?>" placeholder="الاسم الثاني" id="middle_name" type="text" class="txt_field req tempapplicant">
                    <?php if($nt != 0) { ?>
                    <!--<input class="hafaz" type="button" onclick="removeRow('<?PHP echo $appli->applicantid; ?>');" id="remove" value="حذف" />--> 
                    <a href="javascript:void(0)" id="remove"onclick="removeRow('<?PHP echo $appli->applicantid; ?>');"><img width="30" src="<?php echo base_url(); ?>/images/delete.png"></a>
                    <?php } $nt++; ?>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الاسم الثالث</div>
                  <div class="user_field">
                    <input name="last_name_<?PHP echo $appli->applicantid; ?>"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->last_name; ?>" placeholder="الاسم الثالث" id="last_name" type="text" class="txt_field req tempapplicant">
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">القبيلة / العائلة</div>
                  <div class="user_field">
                    <input name="sur_name_<?PHP echo $appli->applicantid; ?>"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->family_name; ?>" placeholder="القبيلة / العائلة" id="family_name" type="text" class="txt_field  req tempapplicant">
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">النوع</div>
                  <div class="user_field">
                    <label class="radio-inline">
                      <input type="radio" name="applicanttype_<?PHP echo $appli->applicantid; ?>" <?PHP if($appli->applicanttype=='ذكر') { ?>checked="checked"<?PHP } ?>   data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="ذكر" class=" tempapplicant" id="applicanttype" required  />
                      ذكر </label>
                    <label class="radio-inline">
                      <input type="radio" name="applicanttype_<?PHP echo $appli->applicantid; ?>" <?PHP if($appli->applicanttype=='أنثى') { ?>checked="checked"<?PHP } ?>   data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="أنثى" class=" tempapplicant" id="applicanttype"/>
                      أنثى </label>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">رقم البطاقة الشخصية</div>
                  <div class="user_field">
                    <input name="idcard_<?PHP echo $appli->applicantid; ?>"  value="<?PHP echo $appli->idcard; ?>" id="idcard" placeholder="رقم البطاقة الشخصية" type="text" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="txt_field NumberInput req autocomplete  tempapplicant">
                  </div>
                </div>
                <?PHP 
			  $p = 0;
			  foreach($main->phones[$appli->applicantid] as $phones) { ?>
                <div class="form_raw" <?PHP if($p==0) { ?>id="hatfi<?PHP echo $appli->applicantid; ?>"<?PHP } else { ?>id="hatfi<?PHP echo $phones->phoneid; ?>" <?PHP } ?>>
                  <div class="user_txt">رقم الهاتف</div>
                  <div class="user_field" id="phonexnumbers">
                    <input data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>_<?PHP echo $phones->phoneid; ?>" name="phone_numbers" value="<?PHP echo $phones->phonenumber; ?>"  type="text" onblur="checkPhoneLen(this);"   class="txt_field NumberInput req applicantphone" id="phonenumber" placeholder="رقم الهاتف" maxlength="8">
                    <?PHP if($p==0) { ?>
                    <!--<input data-on="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" type="button" class="addnewphone" id="addnew" value="إضافة" />--> 
                    <a  data-on="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>"  class="addnewphone" id="addnew" href="javascript:void(0)"><img src="<?php echo base_url(); ?>images/addnewphone.png"  width="30"/></a>
                    <?PHP } else {  ?>
                    <input type="button" onclick="removePhone('<?PHP echo $phones->phoneid; ?>')" id="remove" value="حذف" />
                    <?PHP } ?>
                  </div>
                </div>
                <?PHP $p++; } ?>
                <div class="form_raw">
                  <div class="user_txt">رقم سجل القوى العاملة</div>
                  <div class="user_field">
                    <input name="cr_number_<?PHP echo $appli->applicantid; ?>"  value="<?PHP echo $appli->cr_number; ?>" id="cr_number" placeholder="رقم سجل القوى العاملة" type="text" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="txt_field NumberInput req autocomplete  tempapplicant">
                  </div>
                </div>
				<?php
					if(isset($appli->datepicker) && $appli->datepicker!=""){
						$agenumber= calcualteAge($appli->datepicker);
					}
					else{
						$agenumber = '';
					}
										?>	
                <div class="form_raw">
                  <div class="user_txt">تاريخ الميلاد</div>
                  <div class="user_field">
                    <input name="datepicker_<?PHP echo $appli->applicantid; ?>" type="text"  value="<?PHP echo $appli->datepicker; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="txt_field tempapplicant age_datepicker" id="datepicker_<?PHP echo $appli->applicantid; ?>" placeholder="تاريخ الميلاد" size="15" maxlength="10">
                    <input name="age" type="text" class="txt_field smallfield" id="age_datepicker_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $agenumber ?>"  placeholder="العمر" size="5" maxlength="3" readonly="readonly">
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الحالة الاجتماعية</div>
                  <div class="user_field">
                    <?PHP multiporpose_dropbox('marital_status',$appli->applicantid,$main->tempid,$appli->marital_status,'اختر الحالة الاجتماعية','maritalstatus','req',$appli->marital_status_text,'كم عدد الأطفال لديك','marital_status_text'); ?>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الوضع الحالي</div>
                  <div class="user_field">
                    <?PHP multiporpose_dropbox('job_status',$appli->applicantid,$main->tempid,$appli->job_status,'اختر الوضع الحالي','current_situation','req',$appli->job_status_text,'الوضع الحالي','job_status_text'); ?>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">العنوان الشخصي</div>
                  <div class="user_field">
                    <div class="form_field_selected">
                      <?PHP reigons_partner_applicant($in,'province',$appli->province,$main->tempid,$appli->applicantid); ?>
                    </div>
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">الولاية</div>
                  <div class="user_field">
                    <div class="form_field_selected">
                      <?PHP election_wilayats_partner_applicant('walaya',$appli->walaya,$appli->province,$main->tempid,$appli->applicantid); ?>
                    </div>
                  </div>
                </div>
              </div>
              <?PHP } 
					}
					else
					{ ?>
              <div class="personal bigbangtheory"></div>
              <?PHP		}
			  
			  ?>
              <div class="personal" id="personal2">
                <div class="form_raw">
                  <div class="user_txt" style="width:176px;">رقم بطاقة سجل القوى العاملة</div>
                  <div class="user_field">
                    <input name="mr_number" id="mr_number" value="<?PHP echo $main->mr_number; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="رقم بطاقة سجل القوى العاملة" type="text" class="txt_field NumberInput tempmain">
                  </div>
                </div>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل مسجل في التأمينات الإجتماعية؟</span> <br />
                <input id="is_insurance" type="radio" <?PHP if($main->is_insurance=='Y') { ?>checked="checked"<?PHP } ?> name="is_insurance" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="ins tempmain" value="Y" />
                نعم
                <input id="is_insurance" <?PHP if($main->is_insurance=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="ins tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" name="is_insurance" value="N" />
                لا</div>
            </div>
            <div class="form_raw" id="insinfo" <?PHP if($main->is_insurance=='Y') { ?>style="display:block !Important;"<?PHP } else{?> style="display:none !Important;"<?php } ?>>
              <div class="user_txt">رقم التسجيل</div>
              <div class="user_field">
                <input name="insurance_number" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $main->insurance_number; ?>" id="insurance_number" placeholder="رقم التسجيل" type="text" class="txt_field tempmain">
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل لديك مشروع؟</span> <br />
                <input id="confirmation" type="radio" <?PHP if($main->confirmation=='Y') { ?>checked="checked"<?PHP } ?> name="confirm" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="conf tempmain" value="Y" />
                نعم
                <input id="confirmation" <?PHP if($main->confirmation=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="conf tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" name="confirm" value="N" />
                لا</div>
            </div>
            <?php
				if($main->confirmation == 'Y'){
				$display = 'block';
			}
			else{
				$display = 'none';
			}
		
			?>
            <div class="form_raw" id="extrainfo" style="display:<?php echo $display; ?>">
              <div class="user_txt">اسم المشروع</div>
              <div class="user_field">
                <input name="project_name" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $main->project_name; ?>" id="project_name" placeholder="اسم المشروع" type="text" class="txt_field tempmain">
              </div>
              <div class="user_txt"  style="margin-right: 11px;">موقع المشروع</div>
              <div class="user_field">
                <input name="project_location" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $main->project_location; ?>" id="project_location" placeholder="المكان" type="text" class="txt_field tempmain">
              </div>
            </div>
            <?php
			//echo $display;

			?>
            <div class="form_raw" id="extrainfo2" style="display:<?php echo $display; ?>" >
              <div class="user_txt">نشاط المشروع</div>
              <div class="user_field">
                <input name="project_activities" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $main->project_activities; ?>" id="project_activities" placeholder="نشاط المشروع" type="text" class="txt_field tempmain">
              </div>
              <div class="user_txt"  style="margin-right: 11px;">الاسم التجاري</div>
              <div class="user_field">
                <input name="project_cr_name" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $main->project_cr_name; ?>" id="project_cr_name" placeholder="الاسم التجاري" type="text" class="txt_field tempmain">
              </div>
            </div>
            <div class="form_raw" id="extrainfo_q" <?PHP if($main->confirmation=='N') { ?>style="display:none;"<?PHP } ?>>
              <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل سبق لك الحصول على قرض للمشروع؟</span> <br />
                <input id="is_loan" type="radio" <?PHP if($main->is_loan=='Y') { ?>checked="checked"<?PHP } ?> name="is_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="confirmation_q  tempmain" value="Y" />
                نعم
                <input id="is_loan" <?PHP if($main->is_loan=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="confirmation_q  tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" name="is_loan" value="N" />
                لا</div>
            </div>
            <div class="form_raw" id="question_details" <?PHP if($main->is_loan=='N') { ?>style="display:none;"<?PHP } ?>>
              <div class="user_txt"></div>
              <div class="user_field">
                <li>
                  <input id="is_bank_loan"  type="checkbox" <?PHP if($main->is_bank_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_bank_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="tempmain" value="1" />
                  بنك التنمية العماني </li>
                <li>
                  <input id="is_rafd_loan"  type="checkbox" <?PHP if($main->is_rafd_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_rafd_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="tempmain" value="1" />
                  صندوق شراكة
                  </liv>
                <li>
                  <input id="is_commercial_loan"  type="checkbox" <?PHP if($main->is_commercial_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_commercial_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="tempmain" value="1" />
                  بنك تجاري </li>
                <li>
                  <input id="is_other_loan"  type="checkbox" <?PHP if($main->is_other_loan =='1') { ?>checked="checked"<?PHP } ?> name="is_other_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="tempmain" value="1" />
                  اخرى <br />
                  
				  <?PHP if($main->is_other_loan =='1') { 
				 	 $dislay = "Block";
				 }
				 else{
					$dislay = "None";
				 }
				 
				 ?>
				  
                  <input id="other_value" name="other_value" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $main->project_location; ?>"  placeholder="اخرى" type="text" class="txt_field tempmain" style="display:<?php echo $dislay; ?>">
                </li>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt">نوع الاستفسار</div>
              <div class="user_field">
                <div class="multibox" style="max-height:450px;">
                  <?PHP inquiry_type_tree($main->tempid); ?>
                </div>
                <br clear="all" />
                <div class="multiboxsave"><span style="float: right; margin-right: 12px;" id="mulit_count"></span>حفظ نوع الاستفسار</div>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt">تفاصيل الإستفسار</div>
              <div class="user_field">
                <textarea class="form-control txt_textarea tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" name="inquiry_text" id="inquiry_text"><?PHP echo $main->inquiry_text; ?></textarea>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt">ملاحظات الموظف</div>
              <div class="user_field">
                <textarea class="form-control txt_textarea" data-handler="<?PHP echo $main->tempid; ?>" name="notestext" id="notestext"></textarea>
                <div class="savingdata" style="display:none;"><img src="<?PHP echo base_url(); ?>images/loader.gif" /></div>
              </div>
            </div>
            <?php if($t!='review') { ?>
            <div class="form_raw" id="extrainfo">
              <div class="user_txt"></div>
              <div class="user_field">
                <button type="button" id="save_data_inquery" class="btnx green">حفظ</button>
                <button style="display:none;" type="button" id="restart_data" class="btn default">إلغاء</button>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
	is_decision = '<?php echo $main->confirmation; ?>';
	$(document).ready(function(){
		if(is_decision == 'Y'){
			$("#extrainfo2").show();
			$("#extrainfo").show();
		}
		else{
				$("#extrainfo2").hide();
			$("#extrainfo").hide();
		}
	});
	$("#is_other_loan").click(function(){
			status = $(this).is(':checked');
			if(status){
				$("#other_value").show();
			}
			else{
				$("#other_value").show();
			}
		});
</script>
<div id="dialog-message2" title="  ملا حظة !!!!   " style="display:none;">
<form id="calc_form">
  <?php 
		if(!empty($loan_calculate)){
			foreach($loan_calculate as $calculate){
				?>
               <input type="hidden" value="<?php echo $calculate->loan_start_amount; ?>" id="loan_start<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_end_amount; ?>" id="loan_end<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_starting_day; ?>" id="loan_starting_day<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_percentage; ?>" id="loan_percentage<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_aplicant_percentage; ?>" id="loan_aplicant_percentage<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_expire_day; ?>" id="loan_expire_day<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_expire_timeperiod; ?>" id="loan_expire_time<?php echo $calculate->loan_category_id; ?>" /> 
                <?php
			}
		}
	?>
  <table width="100%">
  <tr>
    <td class="td_text_data center">اسم المقترض</td>
  	<td class="td_text_data center" colspan="3">اسم مقترض افتراضي</td>
  </tr>
  <tr>
    <td class="td_text_data center">نوع المنتج</td>
  	<td class="td_text_data center"><div class="form_field_selected"><select name="loan_limit" id="loan_limit"  onchange="add_data(this.value,'calc_form')">
    	<?php 
		if(!empty($loan_types)){
			foreach($loan_types as $types){
				?>
               <option value="<?php echo $types->loan_category_id;  ?>"><?php echo $types->loan_category_name;  ?></option> 
                <?php
			}
		//	print_r($loan_types);
		}
		?>
    </select></div></td>
    <td class="td_text_data center">نسبة الرسوم</td>
    <td class="td_text_data center"><input type="text" name="percenatage" id="percenatage"  class="txt_field NumberInput" onchange="calculate()"/></td>
  </tr>
  <tr>
    <td class="td_text_data center">مبلغ القرض</td>
    <td class="td_text_data center"><input type="text" name="amount" id="amount"  class="txt_field NumberInput" onchange="calculate()"/></td>
    <td class="td_text_data center">آلية السداد</td>
    <td class="td_text_data center"><div class="form_field_selected"><select name="type_installment" id="type_installment"  onchange="calculate()">
    	<option value="">اختار</option>
        <option value="12" selected="selected">شهري</option>
        <option value="3">ربع سنوي</option>
    </select></div></td>
  </tr>
  <tr>
    <td class="td_text_data center">عدد أقساط فترة السماح</td>
    <td class="td_text_data center"><input type="text" name="leave_installmment" id="leave_installmment"  class="txt_field NumberInput" onchange="calculate()"/></td>
    <td class="td_text_data center">عدد أقساط السداد</td>
    <td class="td_text_data center"><input type="text"  name="paid_instalment" id="paid_instalment"  class="txt_field NumberInput" onchange="calculate()"/></td>
  </tr>
  <tr>
    <td class="td_text_data center">قسط الأصل</td>
    <td class="td_text_data center"><input type="text" name="instalment_amount" id="instalment_amount" class="txt_field NumberInput" /></td>
    <td class="td_text_data center">مدة السداد (سنة)</td>
    <td class="td_text_data center"><input type="text"  name="total_no_years" id="total_no_years"  class="txt_field NumberInput"/></td>
  </tr>
  <tr><td class="td_text_data center">تاريخ الصرف المتوقع</td><td class="td_text_data center"><input type="text" id="start_date"  name="start_date" class="txt_field dateinput"/></td>
  	<td class="td_text_data center">المساهمة الشخصية</td><td class="td_text_data center"><input type="text" id="applicant_percentage"  name="applicant_percentage" class="txt_field dateinput"/></td>
  </tr>

	 <tr><td class="td_text_data center" colspan="3"><a id="getData" href="javascript:void(0)" class="addnewdata needtip" original-title="">حاسبة</a></td></tr>
</table>
</form>
<div id="response"></div>
</div>