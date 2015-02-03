<?php $this->load->view('common/meta');?>

<div class="body">
<?php $this->load->view('common/banner');?>
<div class="body_contant">
  <?php $this->load->view('common/floatingmenu');?>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <div class="data_raw">
      <div class="main_box">
        <div class="data_box_title">
          <div class="data_title">الرسائل القصيرة تحرير النص.</div>
        </div>
        <div class="data">

          <div class="main_data">
          <?php
		  $msg = $this->session->flashdata('msg');
			if($this->session->flashdata('msg') !=""){
				?>
                <script type="text/javascript">
               	 show_notification('تم تحديث البيانات بنجاح');
                
                </script>
                <?php
			}
		  ?>
            <form action="<?php echo current_url();?>" method="POST">
              
			  
			  <?php if(!empty($inq_info_sms)):?>
			  <?php $counter	=	1;?>
				  <?php foreach($inq_info_sms as $sms):?>
				  <?php $lable_name	=	get_lable($sms->sms_type);?>
				  
					  <div class="form_raw">
						<div class="form_txt"><?php echo $lable_name['ar'];?></div>
						<div class="form_field">
						<input type="hidden" name="sms_id_<?php echo $counter;?>" id="sms_id_<?php echo $counter;?>" value="<?php echo (isset($sms->sms_id) ? $sms->sms_id : NULL);  ?>" />
						<textarea id="sms_value_<?php echo $counter;?>" class="txt_field" name="sms_value_<?php echo $counter;?>" onKeyUp="CharacterCount(this.id,'count_'+<?php echo $counter;?>)"><?php echo (isset($sms->sms_value) ? $sms->sms_value : NULL);?></textarea>
						</div>
						<span>عدد الأحرف المكتوبة</span>
						<?php
							if(strlen($sms->sms_value)>=70)
							{
								$color = "red";
							}
							else
							{
								$color = "green";
							}
						?>
						<span id="count_<?php echo $counter;?>" style="background-color:#f7f7f7; border:1px solid #bcc0c2; color:<?php echo $color; ?>"><?php echo strlen($sms->sms_value); ?></span>
						<div style="font-size: 11px; padding-right: 2px; color: gray;">للعلم: 70 حرفا باللغة العربية تساوي رسالة واحدة  </div>
						<div class="form_txt" style="width: 120px; padding-right: 279px; margin-top: -39px;">إرسال رسالة تذكير بعد</div>
						
						<div class="form_field" style="float: left; margin-top: -37px;">
							<input type="text" name="reminder_count_<?php echo $counter;?>" size="2" width="2" id="reminder_count_<?php echo $counter;?>" value="<?php echo (isset($sms->sms_reminder_counter) ? $sms->sms_reminder_counter : NULL);  ?>">
							<select id="sms_reminder_type_<?php echo $counter;?>" name="sms_reminder_type_<?php echo $counter;?>">
								<option value="day">يوم</option>
								<option value="week">أسبوع</option>
								<option value="month">شهر</option>
								<option value="year">سنة</option>
							</select>
						</div>
					  </div>
					  <?php $counter++;?>
				<?php endforeach;?>
			<?php endif;?>
              
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
CharacterCount = function(TextArea,FieldToCount){
	
	var myField = document.getElementById(TextArea);
	var myLabel = document.getElementById(FieldToCount); 

	if(myField.value.length>=70){
		
		$("#"+FieldToCount).css('color','red');
	}
	else{
		$("#"+FieldToCount).css('color','green');	
	}
	myLabel.innerHTML = myField.value.length;
}
</script>
<?php $this->load->view('common/footer');?>
