    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>
<?PHP
	$main = $m;
?>
<div class="data_raw">
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
    </div>
    
  </div>
</div>
