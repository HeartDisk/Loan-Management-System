    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>
<?PHP
$main = $m;

//echo $type;

?>
<div class="data_raw">
  <div class="data">
    <div class="main_data">
      
  		 <?PHP $nt = 0; 			 		
			 $appli= 	$main->applicant[$evo];	
					  
				
			?>
            <input type="hidden" name="applicantid[<?php echo $evo; ?>]" id="applicantid<?php echo $in ?>" value="<?php echo $appli->applicantid; ?>" />
              <div class="personal bigbangtheory <?PHP echo $class; ?>" id="personalbingo<?PHP echo $appli->applicantid; ?>">
                <div class="form_raw">
                  <div class="user_txt">الاسم الأول</div>
                  <div class="user_field">
                    <input name="first_name[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->first_name; ?>" placeholder="الاسم الأول" id="first_name" type="text" class="txt_field ">
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">الاسم الثاني</div>
                  <div class="user_field">
                    <input name="middle_name[<?php echo $evo; ?>]"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->middle_name; ?>" placeholder="الاسم الثاني" id="middle_name" type="text" class="txt_field">
                    <?php if($nt != 0) { ?>
                    <!--<input class="hafaz" type="button" onclick="removeRow('<?PHP echo $appli->applicantid; ?>');" id="remove" value="حذف" />--> 
                    <a href="javascript:void(0)" id="remove"onclick="removeRow('<?PHP echo $appli->applicantid; ?>');"><img width="30" src="<?php echo base_url(); ?>/images/delete.png"></a>
                    <?php } $nt++; ?>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الاسم الثالث</div>
                  <div class="user_field">
                    <input name="last_name[<?php echo $evo; ?>]"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->last_name; ?>" placeholder="الاسم الثالث" id="last_name" type="text" class="txt_field ">
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">القبيلة / العائلة</div>
                  <div class="user_field">
                    <input name="sur_name[<?php echo $evo; ?>]"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->family_name; ?>" placeholder="القبيلة / العائلة" id="family_name" type="text" class="txt_field">
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">النوع</div>
                  <div class="user_field">
                    <label class="radio-inline">
                      <input type="radio" name="applicanttype[<?php echo $evo; ?>]" <?PHP if($appli->applicanttype=='ذكر') { ?>checked="checked"<?PHP } ?>   data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="ذكر" class=" " id="applicanttype" required  />
                      ذكر </label>
                    <label class="radio-inline">
                      <input type="radio" name="applicanttype[<?php echo $evo; ?>]" <?PHP if($appli->applicanttype=='أنثى') { ?>checked="checked"<?PHP } ?>   data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="أنثى" class="" id="applicanttype"/>
                      أنثى </label>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">رقم البطاقة الشخصية</div>
                  <div class="user_field">
                    <input name="idcard[<?php echo $evo; ?>]"  value="<?PHP echo $appli->idcard; ?>" id="idcard" placeholder="رقم البطاقة الشخصية" type="text" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="txt_field NumberInput  autocomplete ">
                  </div>
                </div>
                <?PHP 
			  $p = 0;
			  if($appli->applicantid !=""){
			  foreach($main->phones[$appli->applicantid] as $phones) { ?>
                <div class="form_raw" <?PHP if($p==0) { ?>id="hatfi<?PHP echo $appli->applicantid; ?>"<?PHP } else { ?>id="hatfi<?PHP echo $phones->phoneid; ?>" <?PHP } ?>>
                  <div class="user_txt">رقم الهاتف</div>
                  <div class="user_field" id="phonexnumbers">
                    <input data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>_<?PHP echo $phones->phoneid; ?>" name="phone_numbers[]" value="<?PHP echo $phones->phonenumber; ?>"  type="text" onblur="checkPhoneLen(this);"   class="txt_field NumberInput applicantphone" id="phonenumber" placeholder="رقم الهاتف" maxlength="8">
                    <?PHP if($p==0) { ?>
                    <!--<input data-on="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" type="button" class="addnewphone" id="addnew" value="إضافة" />--> 
                    <a  data-on="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>"  class="addnewphone" id="addnew" href="javascript:void(0)"><img src="<?php echo base_url(); ?>images/addnewphone.png"  width="30"/></a>
                    <?PHP } else {  ?>
                    <input type="button" onclick="removePhone('<?PHP echo $phones->phoneid; ?>')" id="remove" value="حذف" />
                    <?PHP } ?>
                  </div>
                </div>
                <?PHP $p++; } 
			  }
				?>
                <div class="form_raw">
                  <div class="user_txt">رقم سجل القوى العاملة</div>
                  <div class="user_field">
                    <input name="cr_number[<?php echo $evo; ?>]"  value="<?PHP echo $appli->cr_number; ?>" id="cr_number" placeholder="رقم سجل القوى العاملة" type="text" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="txt_field NumberInput autocomplete ">
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
                    <input name="datepicker[<?php echo $evo; ?>]" type="text"  value="<?PHP echo $appli->datepicker; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="txt_field age_datepicker p_age"  id="datepicker_<?php echo $evo; ?>" placeholder="تاريخ الميلاد" size="15" maxlength="10">
                    <input name="age[<?php echo $evo; ?>]" type="text" class="txt_field smallfield" id="age_datepicker_<?php echo $evo; ?>" value="<?PHP echo $agenumber ?>"  placeholder="العمر" size="5" maxlength="3" readonly="readonly">
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الحالة الاجتماعية</div>
                  <div class="user_field">
                    <?PHP multiporpose_dropbox_partner($evo,'marital_status',$appli->applicantid,$main->tempid,$appli->marital_status,'اختر الحالة الاجتماعية','maritalstatus','',$appli->marital_status_text,'كم عدد الأطفال لديك','marital_status_text'); ?>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الوضع الحالي</div>
                  <div class="user_field">
                    <?PHP multiporpose_dropbox_partner($evo,'job_status',$appli->applicantid,$main->tempid,$appli->job_status,'اختر الوضع الحالي','current_situation','',$appli->job_status_text,'الوضع الحالي','job_status_text'); ?>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">العنوان الشخصي</div>
                  <div class="user_field">
                    <div class="form_field_selected">
                      <?PHP reigons_partner_inq($evo,'province',$appli->province,'',$main->tempid,$appli->applicantid); ?>
                    </div>
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">الولاية</div>
                  <div class="user_field">
                    <div class="form_field_selected">
                      <?PHP election_wilayats_partner_inq($evo,'walaya',$appli->walaya,$appli->province,'',$main->tempid,$appli->applicantid); ?>
                    </div>
                  </div>
                </div>
              </div>
              <?PHP  ?>
      <div class="applicant">
        
        
        <div class="personal" id="personal2">
                <div class="form_raw">
                  <div class="user_txt" style="width:176px;">رقم بطاقة سجل القوى العاملة</div>
                  <div class="user_field">
                    <input name="mr_number[<?php echo $evo; ?>]" id="mr_number" value="<?PHP echo $appli->mr_number; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" placeholder="رقم بطاقة سجل القوى العاملة" type="text" class="txt_field NumberInput">
                  </div>
                </div>
              </div>
              <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل مسجل في التأمينات الإجتماعية؟</span> <br />
                <input id="is_insurance" onclick="pass_id(this,'insinfo','<?php echo $evo; ?>')" type="radio" <?PHP if($appli->is_insurance=='Y') { ?>checked="checked"<?PHP } ?> name="is_insurance[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="ins" value="Y" />
                نعم
                <input id="is_insurance"  onclick="pass_id(this,'insinfo','<?php echo $evo; ?>')"  <?PHP if($appli->is_insurance=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="ins " data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" name="is_insurance[<?php echo $evo; ?>]" value="N" />
                لا</div>
            </div>
        		<div class="form_raw" id="insinfo<?php echo $evo; ?>" <?PHP if($appli->is_insurance=='Y') { ?>style="display:block !Important;"<?PHP } else{?> style="display:none !Important;"<?php } ?>>
              <div class="user_txt">رقم التسجيل</div>
              <div class="user_field">
                <input name="insurance_number[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $appli->insurance_number; ?>" id="insurance_number" placeholder="رقم التسجيل" type="text" class="txt_field ">
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل لديك مشروع؟</span> <br />
                <input id="confirmation"  onclick="pass_id(this,'extrainfo','<?php echo $evo; ?>')" type="radio" <?PHP if($appli->confirmation=='Y') { ?>checked="checked"<?PHP } ?> name="confirm[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="conf" value="Y" />
                نعم
                <input id="confirmation" onclick="pass_id(this,'extrainfo','<?php echo $evo; ?>')" <?PHP if($appli->confirmation=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="conf " data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" name="confirm[<?php echo $evo; ?>]" value="N" />
                لا</div>
            </div>
            <?php
					//echo "<pre>";
					//print_r($main);
				$display = 'none';	
				if($appli->confirmation == 'Y'){
				$display = 'block';
			}

		
			?>
            
            <div class="form_raw" id="extrainfo<?php echo $evo; ?>" style="display:<?php echo $display; ?>">
              <div class="user_txt">اسم المشروع</div>
              <div class="user_field">
                <input name="project_name[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->project_name; ?>" id="project_name" placeholder="اسم المشروع" type="text" class="txt_field ">
              </div>
              <div class="user_txt"  style="margin-right: 11px;">موقع المشروع</div>
              <div class="user_field">
                <input name="project_location[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->project_location; ?>" id="project_location" placeholder="المكان" type="text" class="txt_field ">
              </div>
            </div>
            <div class="form_raw" id="extrainfo2<?php echo $evo; ?>" style="display:<?php echo $display; ?>" >
              <div class="user_txt">نشاط المشروع</div>
              <div class="user_field">
                <input name="project_activities[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->project_activities; ?>" id="project_activities" placeholder="نشاط المشروع" type="text" class="txt_field ">
              </div>
              <div class="user_txt"  style="margin-right: 11px;">الاسم التجاري</div>
              <div class="user_field">
                <input name="project_cr_name[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->project_cr_name; ?>" id="project_cr_name" placeholder="الاسم التجاري" type="text" class="txt_field ">
              </div>
            </div>
            <div class="form_raw" id="extrainfo_q">
              <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل سبق لك الحصول على قرض للمشروع؟</span> <br />
                <input id="is_loan[<?php echo $evo; ?>]" onclick="pass_id(this,'question_details','<?php echo $evo; ?>')" type="radio" <?PHP if($appli->is_loan=='Y') { ?>checked="checked"<?PHP } ?> name="is_loan[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="confirmation_q  " value="Y" />
                نعم
                <input id="is_loan[<?php echo $evo; ?>]" onclick="pass_id(this,'question_details','<?php echo $evo; ?>')" <?PHP if($appli->is_loan=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="confirmation_q  " data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" name="is_loan[<?php echo $evo; ?>]" value="N" />
                لا</div>
            </div>
            <div class="form_raw" id="question_details<?php echo $evo; ?>" <?PHP if($main->is_loan=='N') { ?>style="display:none;"<?PHP } ?>>
              <div class="user_txt"></div>
              <div class="user_field">
                <li>
                  <input id="is_bank_loan"  type="checkbox" <?PHP if($main->is_bank_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_bank_loan[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="" value="1" />
                  بنك التنمية العماني </li>
                <li>
                  <input id="is_rafd_loan"  type="checkbox" <?PHP if($main->is_rafd_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_rafd_loan[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="" value="1" />
                  صندوق شراكة
                  </liv>
                <li>
                  <input id="is_commercial_loan"  type="checkbox" <?PHP if($main->is_commercial_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_commercial_loan[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="" value="1" />
                  بنك تجاري </li>
                <li>
                  <input id="is_other_loan<?php echo $evo; ?>"  onclick="pass_id(this,'other_value','<?php echo $evo; ?>')"  type="checkbox" <?PHP if($main->is_other_loan =='1') { ?>checked="checked"<?PHP } ?> name="is_other_loan[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" class="" value="1" />
                  اخرى <br />
                  
				  <?PHP if($main->is_other_loan =='1') { 
				 	 $dislay = "Block";
				 }
				 else{
					$dislay = "None";
				 }
				 
				 ?>
				  
                  <input id="other_value<?php echo $evo; ?>" name="other_value[<?php echo $evo; ?>]" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $main->project_location; ?>"  placeholder="اخرى" type="text" class="txt_field " style="display:<?php echo $dislay; ?>">
                </li>
              </div>
            </div>
            
            
            
        
      </div>
       
      
      
    </div>
    
  </div>
</div>
<script type="text/javascript">


function check_dob(obj,ind){
	
	selcted_date = $('#datepicker_'+ind).val();
	//alert(selcted_date);
	//alert('sss');
	if(selcted_date != ""){
		birthday = selcted_date;
  		birthday = new Date(birthday);
  		age = new Number((new Date().getTime() - birthday.getTime()) / 31536000000).toFixed(0);
						
		$("#age_datepicker_"+ind).val(age);
	}
	
}

function pass_id(obj,id,ind){
	ob = obj;
	c_val = $(obj).val();
	if(id == 'other_value'){
			status = $(obj).is(':checked');
			if(status){
				$("#other_value"+ind).show();
			}
			else{
				$("#other_value"+ind).hide();
			}
	}
	else{
		if(c_val == 'Y'){
			//console.log(obj);
			//alert(id);
			//alert(ind);
			$("#"+id+ind).show();
			if(id == 'extrainfo'){
				$("#extrainfo2"+ind).show();
			}
			
		}
		else{
			$("#"+id+ind).hide();
			if(id == 'extrainfo'){
				$("#extrainfo2"+ind).hide();
			}		
		}
	
	}
}
$(document).ready(function(){
		//alert('ready');
		
/*		$('.ins').click(function(){
			
			ind_ins = $(this).index();
				//alert(ind_ins);
				val_ins = $(this).val();
				ind_ins = ind_ins-1;
				if(val_ins == 'Y' ){
					ind_ins-1;
					$("#insinfo"+ind_ins).show();
				}
				else{
					$("#insinfo"+ind_ins).hide();
				}
			});*/
})
</script>