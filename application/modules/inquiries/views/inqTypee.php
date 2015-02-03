<?php $this->load->view('common/meta');?>

<div class="body">
<?php $this->load->view('common/banner');?>
<div class="body_contant">
  <?php $this->load->view('common/floatingmenu');?>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <!--<div class="shortcuts">
      <div class="short_cut_item"> <a href="departments_view.html">الأقسام</a></div>
      <div class="short_cut_item"> <a href="questions_view.html">الأسئلة</a></div>
      <div class="short_cut_item"> <a href="schedule_view.html">المتسابقين</a></div>
    </div>-->
    <div class="data_raw">
      <div class="main_box">
        <div class="data_box_title">
          <!--<div class="data_box_title_icon"><img src="images/menu/question_s.png" width="22" height="20" /></div>-->
          <div class="data_title">الرسائل القصيرة تحرير النص.</div>
          <!--<div class="page_controls">
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>-->
        </div>
        <div class="data">
        <?php
			//echo "<pre>";
			//print_r($inq_info_sms);
			//echo $inq_info_sms[0]->sms_value;
			//echo $this->session->flashdata('msg');
			
		?>
          <div class="main_data">
          <?php
		  $msg = $this->session->flashdata('msg');
		  //echo $this->session->flashdata('msg');
			//exit;
			if($this->session->flashdata('msg') !=""){
				?>
                <script type="text/javascript">
               	 show_notification('تم تحديث البيانات بنجاح');
                
                </script>
                <?php
			}
		  ?>
            <form action="<?php echo current_url();?>" method="POST">
              
              <div class="form_raw">
                <div class="form_txt">تذكير للانتهاء</div>
                <div class="form_field">
                <input type="hidden" name="thanks_id" id="thanks_id" value="<?php echo (isset($inq_info_sms[1]->sms_id) ? $inq_info_sms[1]->sms_id : NULL);  ?>" />
                <textarea id="thank_msg" class="txt_field" name="thank_msg" onKeyUp="CharacterCount(this.id,'thanku_count')"><?php echo (isset($inq_info_sms[1]->sms_value) ? $inq_info_sms[1]->sms_value : NULL);?></textarea>
                </div>
                <span>عدد الأحرف المكتوبة</span>
                <?php
					if(strlen($inq_info_sms[1]->sms_value)>=70){
						$color = "red";
					}else{
						$color = "green";
					}
				?>
                <span id="thanku_count" style="background-color:#f7f7f7; border:1px solid #bcc0c2; color:<?php echo $color; ?>"><?php echo strlen($inq_info_sms[1]->sms_value); ?></span>
                <div style="font-size: 11px; padding-right: 2px; color: gray;">للعلم: 70 حرفا باللغة العربية تساوي رسالة واحدة  </div>
                <div class="form_txt" style="width: 120px; padding-right: 279px; margin-top: -39px;">إرسال رسالة تذكير بعد</div>
                
                <div class="form_field" style="float: left; margin-top: -37px;">
                     	<input type="text" name="reminder_count" size="2" width="2" id="reminder_count" value="<?php echo (isset($inq_info_sms[0]->sms_reminder_counter) ? $inq_info_sms[0]->sms_reminder_counter : NULL);  ?>">
                        <select id="sms_reminder_type" name="sms_reminder_type">
                        <?php
						
						
						//isset($inq_info_sms[0]->sms_reminder_counter) ? $inq_info_sms[0]->sms_reminder_counter : NULL);
						if(isset($inq_info_sms[0]->sms_reminder_counter) && $inq_info_sms[0]->sms_reminder_counter !=""){
							foreach($period as $i=>$p){
									?>
                                <option value="<?php echo $i; ?>"><?php echo $p; ?></option>
                                <?php
							}
						}
						?>
                        <option value="day">يوم</option>
                        <option value="week">أسبوع</option>
                        <option value="month">شهر</option>
                        <option value="year">سنة</option>
                        </select>
                </div>
              </div>
              <div class="form_raw">
                
                <div class="form_txt">رسالة ناجحة</div>
                <div class="form_field">
                <input type="hidden" name="expiry_id" id="expiry_id" value="<?php echo (isset($inq_info_sms[0]->sms_id) ? $inq_info_sms[0]->sms_id : NULL);  ?>" />
                <textarea id="expiry_msg" class="txt_field" name="expiry_msg" onKeyUp="CharacterCount(this.id,'expiry_count')"><?php echo (isset($inq_info_sms[0]->sms_value) ? $inq_info_sms[0]->sms_value : NULL);?></textarea>
                </div>
                <span style="padding-right:11px;">عدد الأحرف المكتوبة</span>
                <?php
					if(strlen($inq_info_sms[0]->sms_value)>=70){
						$color = "red";
					}else{
						$color = "green";
					}
				?>
                <span id="expiry_count" style="background-color:#f7f7f7; border:1px solid #bcc0c2;color:<?php echo $color; ?>"><?php echo strlen($inq_info_sms[0]->sms_value); ?></span>
                <div style="font-size: 11px; padding-right: 2px; color: gray;width: 588px;">للعلم: 70 حرفا باللغة العربية تساوي رسالة واحدة </div>
              	<div class="form_txt" style="width: 120px; padding-right: 279px; margin-top: -39px;">إرسال رسالة تذكير بعد</div>
                <div class="form_field" style="float: left; margin-top: -37px;">
                     	<input type="text" name="register_count" size="2" width="2" id="register_count" value="">
                        <select id="sms_register" name="sms_register">
                        <option value="minutes">دقائق</option>
                        <option value="seconds">ثواني</option>
                        </select>
                </div>
                
                
              </div>
              
            <div class="main_withoutbg">
                <div class="add_question_btn" style="width:104px;">
                  <input type="submit" class="transperant_btn" name="submit" value="حفظ" style="width:95px;" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

$(document).ready(function(){
	CharacterCount('expiry_msg','expiry_count');
	CharacterCount('thank_msg','thanku_count');
	});
///document.getElementById('myfield').setAttribute('maxlength',250);
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

$(document).ready(function(){
		//alert("asd");
		//CharacterCount('expiry_msg','expiry_count');
		//$("#expiry_msg").val();
		//$("#thank_msg").val();
		//expLen = $("#expiry_msg").length;
		//$("#expiry_count").val(expLen);
		
		//thkLen = $("#thank_msg").length;
		//$("#thanku_count").val(thkLen);
		//CharacterCount('thank_msg','thanku_count');
	});
</script>
<?php $this->load->view('common/footer');?>
