<?php $this->load->view('common/meta');?>
<?PHP
	$main = $m['main'];	
?>

<div class="body">
<?php $this->load->view('common/banner');?>
<div class="body_contant">
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
	 </script>
      <?PHP } ?>
      <div class="main_box">
        <div class="data_box_title"> <a class="addnewdata" href="<?PHP echo base_url(); ?>inquiries/resetinq">إضافة جديدة</a>
          <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
          <div class="data_title">تسجيل المراجعيين </div>
        </div>
        <div class="data_raw">
        <?PHP //noticeboard($main->tempid); ?>
          <div class="data">
            <div class="main_data">
              <div class="form_raw">
                <div class="user_txt">صيغة المشروع</div>
                <div class="user_field">
                  <label class="radio-inline">
                    <input type="radio" id="user_type" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>"  class="user_type tempmain" <?PHP if($main->user_type=='فردي') { ?>checked="checked"<?PHP } ?> name="user_type" value="فردي" data-title="personal"  required />
                    فردي </label>
                  <label class="radio-inline" >
                    <input type="radio" id="user_type" class="user_type tempmain" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" name="user_type" <?PHP if($main->user_type=='مشترك') { ?>checked="checked"<?PHP } ?> value="مشترك" data-title="partner" />
                    مشترك </label>
                  <div id="addmore_partner"  <?PHP if($main->user_type=='مشترك') { ?>style="display:block !important; <?PHP } ?>cursor:pointer;">إضافة مشترك </div>
                </div>
              </div>
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
                  <div class="user_txt" style="margin-right: 11px;">الإسم الثاني</div>
                  <div class="user_field">
                    <input name="middle_name_<?PHP echo $appli->applicantid; ?>"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->middle_name; ?>" placeholder="الإسم الثاني" id="middle_name" type="text" class="txt_field TextInput req tempapplicant">
                    <?php if($nt != 0) { ?>
                    <input class="hafaz" type="button" onclick="removeRow('<?PHP echo $appli->applicantid; ?>');" id="remove" value="حذف" />
                    <?php } $nt++; ?>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الإسم الثالث</div>
                  <div class="user_field">
                    <input name="last_name_<?PHP echo $appli->applicantid; ?>"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->last_name; ?>" placeholder="الإسم الثالث" id="last_name" type="text" class="txt_field TextInput req tempapplicant">
                  </div>
                  <div class="user_txt" style="margin-right: 11px;">القبيلة</div>
                  <div class="user_field">
                    <input name="sur_name_<?PHP echo $appli->applicantid; ?>"  data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $appli->applicantid; ?>" value="<?PHP echo $appli->family_name; ?>" placeholder="القبيلة" id="family_name" type="text" class="txt_field TextInput req tempapplicant">
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
                  <div class="user_txt">رقم بطاقة القوى العاملة</div>
                  <div class="user_field">
                    <input name="mr_number" id="mr_number" value="<?PHP echo $main->mr_number; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="رقم بطاقة القوى العاملة" type="text" class="txt_field NumberInput req tempmain">
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">تاريخ الميلاد</div>
                  <div class="user_field">
                    <input name="datepicker" type="text"  value="<?PHP echo $main->datepicker; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" class="txt_field tempmain" id="datepicker" placeholder="تاريخ الميلاد" size="15" maxlength="10">
                    <input name="age" type="text" class="txt_field smallfield" id="age" placeholder="العمر" size="5" maxlength="3" readonly="readonly">
                  </div>
                </div>
                <div class="form_raw">
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
              <div class="user_txt"  style="margin-right: 11px;">مكان</div>
              <div class="user_field">
                <input name="project_location" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" value="<?PHP echo $main->project_location; ?>" id="project_location" placeholder="مكان" type="text" class="txt_field tempmain">
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt">نوع الاستفسار</div>
              <div class="user_field">
                <div class="multibox">
                  <?PHP inquiry_type_tree($main->tempid); ?>
                </div>
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
                <button type="button" id="save_data" class="btnx green">حفظ</button>
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
