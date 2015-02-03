<?php $this->load->view('common/meta');?>
<?PHP
	$main = $m['main'];	
?>

<div class="body">
<?php $this->load->view('common/banner');?>
<div class="body_contant">
<div id="dialog-confirm_dd" title="تحميل....." style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>من فضلك انتظر جاري تحميل البيانات .... <br />
  <img src="<?PHP echo base_url(); ?>images/ajaxloader.GIF"</p>
</div>
  <?php //$this->load->view('common/floatingmenu');?>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <form id="form2" name="form2" method="post" action="<?PHP echo md5(date('Ymdhisf')); ?>" autocomplete="off">
      
      <div class="main_box">
        <div class="data_box_title"> <a class="addnewdata" href="<?PHP echo base_url(); ?>inquiries/resetinq">إضافة جديدة</a>
          <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
          <div class="data_title">تسجيل المراجعيين </div>
        </div>
        <div class="data_raw">
        <?PHP //noticeboard($main->tempid); ?>
          <div class="data">
            <div class="main_data">
              
              <?PHP $nt = 0; 
			  		if($main->applicant)
					{
						foreach($main->applicant as $appli) {  
				if($nt!=0)
				{
					$class = 'ppback';
				}
			?>
              <div class="personal bigbangtheory <?PHP echo $class; ?>" id="personalbingo<?PHP echo $appli->applicantid; ?>">
                <div class="form_raw">
                  <div class="user_txt">الاسم الأول</div>
                  <div class="user_field">
                    <input name="first_name_<?PHP echo $appli->applicantid; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->first_name; ?>" placeholder="الاسم الأول" id="first_name" type="text" class="txt_field TextInput req tempapplicant">
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">الاسم الثاني</div>
                  <div class="user_field">
                    <input name="middle_name_<?PHP echo $appli->applicantid; ?>"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->middle_name; ?>" placeholder="الاسم الثاني" id="middle_name" type="text" class="txt_field TextInput req tempapplicant">
                    <?php if($nt != 0) { ?>
                    <input class="hafaz" type="button" onclick="removeRow('<?PHP echo $appli->applicantid; ?>');" id="remove" value="حذف" />
                    <?php } $nt++; ?>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الاسم الثالث</div>
                  <div class="user_field">
                    <input name="last_name_<?PHP echo $appli->applicantid; ?>"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->last_name; ?>" placeholder="الاسم الثالث" id="last_name" type="text" class="txt_field TextInput req tempapplicant">
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">القبيلة / العائلة</div>
                  <div class="user_field">
                    <input name="sur_name_<?PHP echo $appli->applicantid; ?>"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->family_name; ?>" placeholder="القبيلة / العائلة" id="family_name" type="text" class="txt_field TextInput req tempapplicant">
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
                    <input data-on="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" type="button" class="addnewphone" id="addnew" value="إضافة" />
                    <?PHP } else {  ?>
                    <input type="button" onclick="removePhone('<?PHP echo $phones->phoneid; ?>')" id="remove" value="حذف" />
                    <?PHP } ?>
                  </div>
                </div>
                <?PHP $p++; } ?>
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
                <div class="form_raw">
                  <div class="user_txt">تاريخ الميلاد</div>
                  <div class="user_field">
                    <input name="datepicker" type="text"  value="<?PHP echo $main->datepicker; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="txt_field tempmain" id="datepicker" placeholder="تاريخ الميلاد" size="15" maxlength="10">
                    <input name="age" type="text" class="txt_field smallfield" id="age" placeholder="العمر" size="5" maxlength="3" readonly="readonly">
                  </div>
                </div>
                <div class="form_raw" style="display:none;">
                  <div class="user_txt">الحالة الاجتماعية</div>
                  <div class="user_field">
                    <div class="form_field_selected">
                      <?PHP exdrobpx('marital_status',$main->marital_status,'الحالة الاجتماعية','maritalstatus',$main->tempid); ?>
                    </div>
                    <div class="user_field" style="margin-right: 4px; ">
                      <input name="marital_text" id="marital_text" value="<?PHP echo $main->marital_text; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="كم عدد الأطفال لديك" type="text" class="txt_field tempmain mmp">
                    </div>
                  </div>
                </div>
              </div>
              
              
              
              
            </div>
            <div class="form_raw">
              <div class="user_txt">العنوان الشخصي</div>
              <div class="user_field">
                <div class="form_field_selected">
                  <?PHP reigons('province',$main->province,$main->tempid); ?>
                </div>
              </div>
              <div class="user_txt" style="margin-right: 11px;">الولاية</div>
              <div class="user_field">
                <div class="form_field_selected">
                  <?PHP election_wilayats('walaya',$main->walaya,$main->province,$main->tempid); ?>
                </div>
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
            <div class="form_raw" id="extrainfo" <?PHP if($main->confirmation=='Y') { ?>style="display:block !Important;"<?PHP } ?>>
              <div class="user_txt">اسم المشروع</div>
              <div class="user_field">
                <input name="project_name" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $main->project_name; ?>" id="project_name" placeholder="اسم المشروع" type="text" class="txt_field tempmain">
              </div>
              <div class="user_txt"  style="margin-right: 11px;">موقع المشروع</div>
              <div class="user_field">
                <input name="project_location" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $main->project_location; ?>" id="project_location" placeholder="مكان" type="text" class="txt_field tempmain">
              </div>
           
            </div>
            <div class="form_raw" id="extrainfo_q" style="display:none;">
            <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل سبق لك الحصول على قرض للمشروع؟</span> <br />
                <input id="is_loan" type="radio" <?PHP if($main->confirmation=='Y') { ?>checked="checked"<?PHP } ?> name="is_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="confirmation_q  tempmain" value="Y" />
                نعم
                <input id="is_loan" <?PHP if($main->confirmation=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="confirmation_q  tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" name="is_loan" value="N" />
                لا</div>
           
            </div>
            <div class="form_raw" id="question_details" style="display:none;">
            <div class="user_txt"></div>
            <div class="user_field">
              <li>
              		 <input id="is_bank_loan"  type="checkbox" <?PHP if($main->is_bank_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_bank_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="tempmain" value="1" />
                بنك التنمية
              </li>
              <li>
              		 <input id="is_rafd_loan"  type="checkbox" <?PHP if($main->is_rafd_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_rafd_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="tempmain" value="1" />
                صندوق شراكة
              </liv>
               <li>
              		 <input id="is_commercial_loan"  type="checkbox" <?PHP if($main->is_commercial_loan=='1') { ?>checked="checked"<?PHP } ?> name="is_commercial_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="tempmain" value="1" />
                بنك تجاري
               </li>
               <li>
              		 <input id="is_other_loan"  type="checkbox" <?PHP if($main->is_other_loan =='1') { ?>checked="checked"<?PHP } ?> name="is_other_loan" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="tempmain" value="1" />
                اخرى
                <br />
                <input id="other_value" name="other_value" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $main->project_location; ?>"  placeholder="اخرى" type="text" class="txt_field tempmain" style="display:none;">
               </li>
               </div>
            </div>
            <div class="form_raw">
              <div class="user_txt">نوع الاستفسار</div>
              <div class="user_field">
                <div class="multibox">
                  <?PHP inquiry_type_tree($main->tempid); ?>
                </div>
                <br clear="all" />
                <div class="multiboxsave"><span style="float: right; margin-right: 12px;" id="mulit_count"></span>حفظ نوع الاستفسار</div>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt">نوع الاستفسار</div>
              <div class="user_field">
                <textarea class="form-control txt_textarea tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" name="inquiry_text" id="inquiry_text"><?PHP echo $main->inquiry_text; ?></textarea>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt">ملاحظات</div>
              <div class="user_field">
                <textarea class="form-control txt_textarea" data-handler="<?PHP echo $main->tempid; ?>" name="notestext" id="notestext">ملاحظات</textarea>
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