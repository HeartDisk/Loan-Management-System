    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>
<?PHP
$main = $m;
//echo $type;

?>
 <script type="application/javascript">
 is_mushtarik = '<?php echo $main->user_type; ?>';
$(document).ready(function(){
	//alert('ready3');

	
	if(is_mushtarik == 'مشترك'){
		showmushtarik();
	}
	else{
			setTimeout('hidemushtarik()', 1000);
	}
	
	
	$(".user_type").click(function(){
			val = $(this).val();
			if(val == 'مشترك'){
				showmushtarik();
				
			}
			else{
				hidemushtarik();
			}
	});

});
 </script>
<?php

//echo "<pre>";
//print_r($main);
?>

<div class="data_raw">
  <div class="data">
    <div class="main_data">
      <div class="form_raw">
                <div class="user_txt">طبيعة المراجعين</div>
                <div class="user_field">
                  <label class="radio-inline">
                    <input type="radio" id="user_type" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>"  class="user_type temptypemain" <?PHP if($main->user_type=='فردي') { ?>checked="checked"<?PHP } ?> name="user_type" value="فردي" data-title="personal"  required />
                    فردي </label>
                  <label class="radio-inline" >
                    <input type="radio" id="user_type" class="user_type temptypemain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" name="user_type" <?PHP if($main->user_type=='مشترك') { ?>checked="checked"<?PHP } ?> value="مشترك" data-title="partner" />
                    مشترك </label>
                </div>
              </div>
  		 <?PHP $nt = 0; 		
		 	//echo "<pre>";
			$appli = $main->applicant[0];
			//print_r($appli);  
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
                      <?PHP reigons_partner_applicant($in,'province',$appli->province,$main->tempid,'req',$appli->applicantid); ?>
                    </div>
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">الولاية</div>
                  <div class="user_field">
                    <div class="form_field_selected">
                      <?PHP election_wilayats_partner_applicant('walaya',$appli->walaya,$appli->province,'req',$main->tempid,$appli->applicantid); ?>
                    </div>
                  </div>
                </div>
              </div>
              <?PHP
					
								  ?>
      <div class="applicant">
        
        
        <div class="personal" id="personal2">
                <div class="form_raw">
                  <div class="user_txt" style="width:176px;">رقم بطاقة سجل القوى العاملة</div>
                  <div class="user_field">
                    <input name="mr_number_<?PHP echo $appli->applicantid; ?>" id="mr_number" value="<?PHP echo $main->mr_number; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" placeholder="رقم بطاقة سجل القوى العاملة" type="text" class="txt_field NumberInput tempmain">
                  </div>
                </div>
              </div>
              <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل مسجل في التأمينات الإجتماعية؟</span> <br />
                <input id="is_insurance_" type="radio" <?PHP if($main->is_insurance=='Y') { ?>checked="checked"<?PHP } ?> name="is_insurance" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="ins tempmain" value="Y" />
                نعم
                <input id="is_insurance" <?PHP if($main->is_insurance=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="ins tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" name="is_insurance_<?PHP echo $appli->applicantid; ?>" value="N" />
                لا</div>
            </div>
        		<div class="form_raw" id="insinfo" <?PHP if($main->is_insurance=='Y') { ?>style="display:block !Important;"<?PHP } else{?> style="display:none !Important;"<?php } ?>>
              <div class="user_txt">رقم التسجيل</div>
              <div class="user_field">
                <input name="insurance_number_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $main->insurance_number; ?>" id="insurance_number_<?PHP echo $appli->applicantid; ?>" placeholder="رقم التسجيل" type="text" class="txt_field tempmain">
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل لديك مشروع؟</span> <br />
                <input id="confirmation" type="radio" <?PHP if($main->confirmation=='Y') { ?>checked="checked"<?PHP } ?> name="confirm_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="conf tempmain" value="Y" />
                نعم
                <input id="confirmation" <?PHP if($main->confirmation=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="conf tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" name="confirm_<?PHP echo $appli->applicantid; ?>" value="N" />
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
            <div class="form_raw" id="extrainfo" style="display:<?php // echo $display; ?>">
              <div class="user_txt">اسم المشروع</div>
              <div class="user_field">
                <input name="project_name_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $main->project_name; ?>" id="project_name" placeholder="اسم المشروع" type="text" class="txt_field tempmain">
              </div>
              <div class="user_txt"  style="margin-right: 11px;">موقع المشروع</div>
              <div class="user_field">
                <input name="project_location_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $main->project_location; ?>" id="project_location" placeholder="المكان" type="text" class="txt_field tempmain">
              </div>
            </div>
            <div class="form_raw" id="extrainfo2" style="display:<?php echo $display; ?>" >
              <div class="user_txt">نشاط المشروع</div>
              <div class="user_field">
                <input name="project_activities_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $main->project_activities; ?>" id="project_activities" placeholder="نشاط المشروع" type="text" class="txt_field tempmain">
              </div>
              <div class="user_txt"  style="margin-right: 11px;">الاسم التجاري</div>
              <div class="user_field">
                <input name="project_cr_name_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $main->project_cr_name; ?>" id="project_cr_name" placeholder="الاسم التجاري" type="text" class="txt_field tempmain">
              </div>
            </div>
            <div class="form_raw" id="extrainfo_q" <?PHP if($main->confirmation=='N') { ?>style="display:none;"<?PHP } ?>>
              <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل سبق لك الحصول على قرض للمشروع؟</span> <br />
                <input id="is_loan" type="radio" <?PHP if($main->is_loan=='Y') { ?>checked="checked"<?PHP } ?> name="is_loan_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="confirmation_q  tempmain" value="Y" />
                نعم
                <input id="is_loan" <?PHP if($main->is_loan=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="confirmation_q  tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" name="is_loan_<?PHP echo $appli->applicantid; ?>" value="N" />
                لا</div>
            </div>
            <div class="form_raw" id="question_details" <?PHP if($main->is_loan=='N') { ?>style="display:none;"<?PHP } ?>>
              <div class="user_txt"></div>
              <div class="user_field">
                <li>
                  <input id="is_bank_loan"  type="checkbox" <?PHP if($main->is_bank_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_bank_loan_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="tempmain" value="1" />
                  بنك التنمية العماني </li>
                <li>
                  <input id="is_rafd_loan"  type="checkbox" <?PHP if($main->is_rafd_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_rafd_loan_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="tempmain" value="1" />
                  صندوق شراكة
                  </liv>
                <li>
                  <input id="is_commercial_loan"  type="checkbox" <?PHP if($main->is_commercial_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_commercial_loan_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="tempmain" value="1" />
                  بنك تجاري </li>
                <li>
                  <input id="is_other_loan"  type="checkbox" <?PHP if($main->is_other_loan =='1') { ?>checked="checked"<?PHP } ?> name="is_other_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="tempmain" value="1" />
                  اخرى <br />
                  
				  <?PHP if($main->is_other_loan =='1') { 
				 	 $dislay = "Block";
				 }
				 else{
					$dislay = "None";
				 }
				 
				 ?>
				  
                  <input id="other_value" name="other_value_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $main->project_location; ?>"  placeholder="اخرى" type="text" class="txt_field tempmain" style="display:<?php echo $dislay; ?>">
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
                <textarea class="form-control txt_textarea tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" name="inquiry_text" id="inquiry_text"><?PHP echo $main->inquiry_text; ?></textarea>
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
</div>
<script type="text/javascript">

$(document).ready(function(){
		//alert('ready');
})
</script>