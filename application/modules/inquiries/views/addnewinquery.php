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

#nimbus{
	border-bottom:none;
	
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

function hidemushtarik(){
	//nimbus
	//$("#nimbus .ui-tabs-nav li").eq(0).html('فردي');
	
	$("#nimbus .ui-tabs-nav li").eq(1).hide();
	$("#nimbus .ui-tabs-nav li").eq(2).hide();
	$("#nimbus .ui-tabs-nav li").eq(3).hide();
	$("#nimbus .ui-tabs-nav li").eq(4).hide();
	//$("#nimbe-2").hide();
	//$("#nimbe-3").hide();
	//$("#nimbe-4").hide();
}

function addPartners(){
	var request = $.ajax({
					  url: config.AJAX_URL+'addNewPartner',
					  type: "POST",
					  data: { tempid : $('#tempid').val() },
					  dataType: "html",
					  success: function(msg){
						location.href = config.CURRENT_URL;
						//$('.bigbangtheory').after(msg);
					  }
					});
			
	
}

function showmushtarik(){
	//$("#nimbus .ui-tabs-nav li").eq(0).html(' مشترك 1');
	//$("#nimbus .ui-tabs-nav li").eq(0).html(' مشترك 1');
	
	
	$("#nimbus .ui-tabs-nav li").eq(1).show();
	$("#nimbus .ui-tabs-nav li").eq(2).show();
	$("#nimbus .ui-tabs-nav li").eq(3).show();
	$("#nimbus .ui-tabs-nav li").eq(4).show();
	
	//$("#nimbe-2").show();
	//$("#nimbe-3").show();
	//$("#nimbe-4").show();
}


//
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
        <div id="nimbus">
        <ul>
          <li id="ff"><a href="#nimbe-1">فردي</a></li>
          
          <?PHP for($k=1; $k<=4; $k++) {?>
          <li class="nimbxx"><a href="#nimbe-<?PHP echo $k+1; ?>"> مشترك <?PHP echo arabic_date($k); ?></a></li>
          <?PHP } ?>
        </ul>
        <div id="nimbe-1">
          <?PHP $this->load->view('inq_single',array('m'=>$main,'type'=>$type)); ?>
        </div>
        <?PHP for($j=1; $j<=4; $j++) {?>
        <div id="nimbe-<?PHP echo $j+1; ?>">
          <?PHP $this->load->view('inq_multiple',array('evo'=>$j,'aid'=>$applicant->applicant_id,'type'=>$type,'m'=>$main)); ?>
        </div>
       <?PHP } ?>
       
      </div>
          <?PHP //noticeboard($main->tempid); ?>
          
            <div class="main_data">
     <div class="form_raw">
      <div id="all_hidden"></div>
      <div class="user_txt"></div>
      <?php if($t!='review') { ?>
            <div class="form_raw" id="extrainfo">
              <div class="user_txt"></div>
              <div class="user_field">
                <button type="button" id="save_data_inquery" class="btnx green">حفظ</button>
                <button style="display:none;" type="button" id="restart_data" class="btn default">إلغاء</button>
              </div>
            </div>
            <?php }else{ ?>
                <div class="form_raw" id="extrainfo">
                  <div class="user_txt"></div>
                  <div class="user_field">
                    <button type="button" id="update_data_inquery" class="btnx green">حفظ</button>
                  </div>
                </div>	
			<?php } ?>
            
     	</div>
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
			$( "#nimbus" ).tabs();
		if(is_decision == 'Y'){
			$("#extrainfo2").show();
			$("#extrainfo").show();
		}
		else{
				$("#extrainfo2").hide();
			$("#extrainfo").hide();
		}
		
		$("#update_data_inquery").click(function(){
			
				updateMurajeenData();
				
			});
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