<?php $this->load->view('common/meta');?>
<?PHP
	$main = $m['main'];	
?>

<div class="body">
<?PHP $this->load->view('viewforrequest');?>
<?php $this->load->view('common/banner');?>
<div class="body_contant">
 
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <form id="requestform1" name="requestform1" method="post" action="<?PHP echo md5(date('Ymdhisf')); ?>" autocomplete="off">
      <input type="hidden" name="applicant_id" id="applicant_id" value="<?PHP echo $main->applicant_id; ?>" />
      <div class="main_box">
        <div class="data_box_title">
          <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
          <div class="data_title">تسجيل المراجعيين </div>
        </div>
        <div class="data_raw">
        <?PHP noticeboard($main->tempid); ?>
          <div class="data">
            <div class="main_data">
              <div class="form_raw">
                <div class="user_txt">صيغة المشروع</div>
                <div class="user_field">
                  <label class="radio-inline">
                    <input type="radio" id="applicant_type" class="applicant_type" name="applicant_type" value="فردي" />
                    فردي </label>
                  <label class="radio-inline" >
                    <input type="radio" id="applicant_type" class="applicant_type" name="applicant_type" value="مشترك" />
                    مشترك </label>
                  <div id="addmore_partner" style="cursor:pointer;">إضافة مشترك </div>
                </div>
              </div>
             
              <div class="applicant">
                <div class="form_raw">
                  <div class="user_txt">الاسم الأول</div>
                  <div class="user_field">
                    <input name="applicant_first_name" value="<?PHP echo $appli->applicant_first_name; ?>" placeholder="الاسم الأول" id="applicant_first_name" type="text" class="txt_field TextInput req">
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">الإسم الثاني</div>
                  <div class="user_field">
                    <input name="applicant_middle_name>" value="<?PHP echo $appli->applicant_middle_name; ?>" placeholder="الإسم الثاني" id="applicant_middle_name" type="text" class="txt_field TextInput req">
                  
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الإسم الثالث</div>
                  <div class="user_field">
                    <input name="applicant_last_name" value="<?PHP echo $appli->applicant_last_name; ?>" placeholder="الإسم الثالث" id="applicant_last_name" type="text" class="txt_field TextInput req">
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">القبيلة</div>
                  <div class="user_field">
                    <input name="applicant_sur_name" value="<?PHP echo $appli->applicant_sur_name; ?>" placeholder="القبيلة" id="applicant_sur_name" type="text" class="txt_field TextInput req">
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">النوع</div>
                  <div class="user_field">
                    <label class="radio-inline">
                      <input type="radio" name="applicant_gender" value="ذكر" id="applicant_gender"/>
                      ذكر </label>
                    <label class="radio-inline">
                      <input type="radio" name="applicant_gender" value="أنثى" id="applicant_gender"/>
                      أنثى </label>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">رقم البطاقة الشخصية</div>
                  <div class="user_field">
                    <input name="appliant_id_number"  value="<?PHP echo $appli->appliant_id_number; ?>" id="appliant_id_number" placeholder="رقم البطاقة الشخصية" type="text" class="txt_field NumberInput req idcard_autocomplete">
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
             
              <div class="personal" id="personal2">
                <div class="form_raw">
                  <div class="user_txt">رقم بطاقة القوى العاملة</div>
                  <div class="user_field">
                    <input name="applicant_cr_number" id="applicant_cr_number" value="<?PHP echo $main->applicant_cr_number; ?>" placeholder="رقم بطاقة القوى العاملة" type="text" class="txt_field NumberInput req">
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">تاريخ الميلاد</div>
                  <div class="user_field">
                    <input name="applicant_date_birth" type="text"  value="<?PHP echo $main->applicant_date_birth; ?>" class="txt_field req" id="applicant_date_birth" placeholder="تاريخ الميلاد" size="15" maxlength="10">
                    <input name="age" type="text" class="txt_field smallfield" id="age" placeholder="العمر" size="5" maxlength="3" readonly="readonly">
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الحالة الاجتماعية</div>
                  <div class="user_field">                    
                      <?PHP hd_dropbox('applicant_marital_status',$main->applicant_marital_status,'الحالة الاجتماعية','maritalstatus','req',$main->applicant_marital_status_text,'كم عدد الأطفال لديك','applicant_marital_status_text'); ?>
                  </div>
                </div>
              </div>
              <div class="form_raw">
                <div class="user_txt">الوضع الحالي</div>
                <div class="user_field">
                  <?PHP hd_dropbox('applicant_job_staus',$main->applicant_job_staus,'الوضع الحالي','current_situation','req',$main->applicant_marital_status_text,'','applicant_job_status_text'); ?>
                 
                </div>
              </div>
              <div class="form_raw">
                <div class="user_txt">المؤهل</div>
                <div class="user_field">
                  <?PHP hd_dropbox('applicant_qualification',$main->applicant_qualification,'المؤهل','qualification','req',$main->applicant_qualification_text,'','applicant_qualification_text'); ?>
                  
                </div>
              </div>
              <div class="form_raw">
                <div class="user_txt">فئة الظمان الإجتماعي</div>
                <div class="user_field">
                  <input id="option1" type="radio" <?PHP if($main->option1=='Y') { ?>checked="checked"<?PHP } ?> name="option1" value="Y" />
                  نعم
                  <input id="option1" <?PHP if($main->option1=='N') { ?>checked="checked"<?PHP } ?> type="radio" name="option1" value="N" />
                  لا </div>
              </div>
              <div class="form_raw">
                <div class="user_txt">فئة من ذوي الإعاقة</div>
                <div class="user_field">
                  <input id="option2" <?PHP if($main->option2=='Y') { ?>checked="checked"<?PHP } ?> type="radio" name="option2" value="Y" />
                  نعم
                  <input id="option2" <?PHP if($main->option2=='N') { ?>checked="checked"<?PHP } ?> type="radio" name="option2" value="N" />
                  لا </div>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt">محافظة</div>
              <div class="user_field">
                <div class="form_field_selected">
                  <?PHP reigons('province',$main->province,$main->tempid); ?>
                </div>
              </div>
              <div class="user_txt" style="margin-right: 11px;">محافظة</div>
              <div class="user_field">
                <div class="form_field_selected">
                  <?PHP election_wilayats('walaya',$main->walaya,$main->province,$main->tempid); ?>
                </div>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field"> <span class="confirmation">هل لديك مشروع؟</span> <br />
                <input id="applicant_confirm" type="radio" <?PHP if($main->applicant_confirm=='Y') { ?>checked="checked"<?PHP } ?> name="applicant_confirm" class="conf" value="Y" />
                نعم
                <input id="applicant_confirm" <?PHP if($main->applicant_confirm=='N') { ?>checked="checked"<?PHP } ?> type="radio" class="conf" name="applicant_confirm" value="N" />
                لا</div>
            </div>
            <div class="form_raw" id="extrainfo" <?PHP if($main->applicant_confirm=='Y') { ?>style="display:block !Important;"<?PHP } ?>>
              <div class="user_txt">اسم المشروع</div>
              <div class="user_field">
                <input name="applicant_project_name" value="<?PHP echo $main->applicant_project_name; ?>" id="applicant_project_name" placeholder="اسم المشروع" type="text" class="txt_field">
              </div>
              <div class="user_txt"  style="margin-right: 11px;">مكان</div>
              <div class="user_field">
                <input name="applicant_project_location" value="<?PHP echo $main->applicant_project_location; ?>" id="applicant_project_location" placeholder="مكان" type="text" class="txt_field">
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
                <button type="button" id="save_datssa" class="btnx green">حفظ</button>
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
