<?PHP	
	$main = $m['applicant_project'][0];
?>
<form id="validate_form_step2" name="validate_form_step2" method="post" action="" autocomplete="off">
  <input type="hidden" name="form_step" id="form_step" value="2" />
  <input type="hidden" name="iscomplete" id="iscomplete" value="0" />
  <input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $app_id;?>" />
  <?php if($t=='review') { ?>
  <input type="hidden" name="review" id="review" value="1" />
  <?PHP } ?>
  <?PHP if($t=='review') { ?>
  <?PHP } ?>
  <div class="data_raw">
    <div class="data">
      <div class="main_data">
        <div class="personal" id="personal2">
          <div class="form_raw">
            <div class="user_txt"> نوع المشروع</div>
            <div class="user_field">
              <div class="form_field_selected">
                <?PHP exdrobpx('project_type',$main->project_type,'نوع المشروع','project_type','req'); ?>
              </div>
            </div>
          </div>
          <div class="form_raw">
              <div class="user_txt">القطاع الإقتصادي</div>
              <div class="user_field">
                <div class="form_field_selected">
                  <?PHP hd_dropbox('business_type',$main->business_type,'اختر القطاع الإقتصادي','business_type','','',''); ?>
                </div>
              </div>
            </div>
          <div class="form_raw">
            <div class="user_txt">نشاط المشروع</div>
            <div class="user_field">
              <input name="activity_project_text" id="activity_project_text" value="<?PHP echo $main->activity_project_text; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="نشاط المشروع" type="text" class="txt_field req">
            </div>
          </div>
          <div class="form_raw">
            <div class="user_txt">نبذة عن المشروع</div>
            <div class="user_field">
              <input name="about_project" id="about_project" value="<?PHP echo $main->about_project; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="نبذة عن المشروع" type="text" class="txt_field req">
            </div>
          </div>
          <div class="form_raw">
            <div class="user_txt">رقم السجل التجاري</div>
            <div class="user_field">
              <input name="project_registration_number" id="project_registration_number" value="<?PHP echo $main->project_registration_number; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="رقم السجل التجاري" type="text" class="txt_field req">
            </div>
          </div>
          
          <div class="form_raw" style="display:none;">
            <div class="user_txt" style="width: 454px;">هل لديك مشروع؟</div>
            <div class="user_field" style="width: 460px;"> نعم
              <input type="radio"  name="is_project" id="is_project" value="1" onchange="check_project(this.value)" class="req" placeholder='هل لديك' />
              لا
              <input type="radio"  name="is_project" id="is_project2" value="0" onchange="check_project(this.value)"  class="req" placeholder='هل لديك'/>
            </div>
          </div>
          <div id="form_details" <?PHP if($main->project_type=='جديد') { ?>style="display:none;"<?PHP } ?>>
          <div class="form_raw">
            <div class="user_txt" style="width:260px; text-decoration:underline;">
              <h3>بالنسبة للمشاريع القائمة:</h3>
            </div>
          </div>
            <div class="form_raw">
              <div class="user_txt" style="width: 250px;">تاريخ التأسيس الأول للمشروع:</div>
              <div class="user_field">
                <input name="foundation_date" id="foundation_date" value="<?PHP echo $main->foundation_date; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="تاريخ التأسيس الأول للمشروع" type="text" class="txt_field dateinput">
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt" style="width: 250px;">في حالة تواجد صعوبات أذكر أهمها:</div>
              <div class="user_field">
                <textarea name="project_difficulties" id="project_difficulties" class=" txt_field" placeholder="في حالة تواجد" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>"><?PHP echo $main->project_difficulties; ?></textarea>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt" style="width: 250px;">القيمة التقديرية للتأسيسات والتجهيزات الموجودة حاليا بالمشروع:</div>
              <div class="user_field">
                <input name="estimated_value" id="estimated_value" value="<?PHP echo $main->estimated_value; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="القيمة التقديرية" type="text" class="txt_field  sNumber">
              </div>
            </div>
            <!--<div class="form_raw">
              <div class="user_txt" style="width: 250px;"> نشاط المشروع:</div>
              <div class="user_field" style="width:210px;">
                <div class="form_field_selected">
                  <?PHP //exdrobpx('project_activity',$main->project_activity,'نشاط المشروع','project_activity',''); ?>
                </div>
              </div>
            </div>-->
            <div class="form_raw">
              <div class="user_txt" style="width:160px;">عنوان المشروع (المقترح)</div>
            </div>
            <div class="form_raw">
              <table width="100%">
                <tr>
                  <td width="33%"><div class="user_txt" style="padding-bottom:7px;">المحافظة</div>
                    <div class="user_field">
                      <div class="form_field_selected">
                        <?PHP reigons('province',$main->province,'','muzaffar'); ?>
                      </div>
                    </div></td>
                  <td width="33%"><div class="user_txt" style="padding-bottom:7px;">الولاية</div>
                    <div class="user_field">
                      <div class="form_field_selected">
                        <?PHP election_wilayats('walaya',$main->walaya,$main->province,'','muzaffar'); ?>
                      </div>
                    </div></td>
                  <td width="33%"><div class="user_txt" style="padding-bottom:7px;">القرية</div>
                    <input name="project_village" id="project_village" value="<?PHP echo $main->mr_number; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="القرية" type="text" class="txt_field "></td>
                </tr>
                <tr>
                  <td width="33%"><div class="user_txt" style="padding-bottom:7px;">الهاتف</div>
                    <input name="project_linephone" id="project_linephone" value="<?PHP echo $main->mr_number; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="الهاتف" type="text" class="txt_field  sNumber"></td>
                  <td width="33%"><div class="user_txt" style="padding-bottom:7px;">الفاكس</div>
                    <input name="project_faxnumber" id="project_faxnumber" value="<?PHP echo $main->mr_number; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="الفاكس" type="text" class="txt_field sNumber"></td>
                  <td width="33%"><div class="user_txt" style="padding-bottom:7px;">البريد الالكتروني</div>
                    <input name="project_email" id="project_email" value="<?PHP echo $main->mr_number; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="البريد الالكتروني" type="text" class="txt_field "></td>
                </tr>
              </table>
            </div>
            
            <div class="form_raw">
              <div class="user_txt">طبيعة محل المشروع</div>
              <div class="user_field">
                <div class="form_field_selected">
                  <?PHP exdrobpx('nature_project',$main->nature_project,'اختر القطاع الإقتصادي','nature_project',''); ?>
                </div>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt">طبيعة موقع المشروع</div>
              <div class="user_field">
                <div class="form_field_selected">
                  <?PHP exdrobpx('nature_project_site',$main->nature_project_site,'اختر طبيعة موقع المشروع','nature_project_site',''); ?>
                </div>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_txt">التعمين</div>
              <div class="user_field">
                <div class="form_field_selected">
                  <?PHP exdrobpx('project_employment',$main->project_employment,'اختر التعمين','project_employment',''); ?>
                </div>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_field" style="padding-bottom:7px;">عدد القوى العاملة الوطنية بالمشروع</div>
            </div>
            <div class="form_raw">
              <div class="user_txt"  style="width: auto; padding: 7px;">ذكر:</div>
              <div class="user_field">
                <div class="form_field_selected">
                  <input name="national_male_employes" id="national_male_employes" value="<?PHP echo $main->national_male_employes; ?>"  type="text" class="txt_field national sNumber " placeholder='ذكر الوطنية'>
                </div>
                <div class="user_txt" style="width: auto; padding: 7px;">أنثى:</div>
                <div class="form_field_selected">
                  <input name="national_female_employes" id="national_female_employes" value="<?PHP echo $main->national_female_employes; ?>"  type="text" class="txt_field national sNumber" placeholder='أنثى الوطنية'>
                </div>
                <div class="user_txt" style="width: auto; padding: 7px;">مجموع:</div>
                <div class="form_field_selected"  style="padding-right: 14px; width: 56px;">
                  <input name="total_national" id="total_national" value="0" placeholder="<?PHP echo $main->national_female_employes+$main->national_male_employes; ?>" type="text" class="txt_field national" size="50" width="50px" readonly="readonly">
                </div>
              </div>
            </div>
            <div class="form_raw">
              <div class="user_field">عدد القوى العاملة الوافدة إن وجد</div>
            </div>
            <div class="form_raw">
              <div class="user_txt"  style="width: auto; padding: 7px;">ذكر:</div>
              <div class="user_field">
                <div class="form_field_selected">
                  <input name="foreign_male_employes" id="foreign_male_employes"  value="<?PHP echo $main->foreign_male_employes; ?>" placeholder=" ذكر الوافدة " type="text" class="txt_field foreign sNumber">
                </div>
                <div class="user_txt" style="width: auto; padding: 7px;">أنثى:</div>
                <div class="form_field_selected">
                  <input name="foreign_female_employes" id="foreign_female_employes"  value="<?PHP echo $main->foreign_female_employes; ?>" placeholder=" أنثى الوافدة " type="text" class="txt_field foreign sNumber">
                </div>
                <div class="user_txt" style="width: auto; padding: 7px;">مجموع:</div>
                <div class="form_field_selected"  style="padding-right: 14px; width: 56px;">
                  <input name="total_foreign" id="total_foreign"  value="<?PHP echo $main->foreign_male_employes+$main->foreign_female_employes; ?>" placeholder="0" type="text" class="txt_field" size="50" width="50px" readonly="readonly">
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- <input type="button"  id="save_data"/>-->
        <input type="button" id="save_data_form_step2" name="save_data_form_step2" value="حفظ" class="btnx green"/>
      </div>
    </div>
  </div>
</form>
<script>
			  
			  function check_project(val){
				  //	alert(val);
				  	if(val != 183){
						$("#form_details").fadeIn();
						$(".sForm").addClass('req');
						$(".sNumber").addClass('NumberInput');
						//sForm sNumber
					}
					else{
							$("#form_details").fadeOut();
							$(".sForm").removeClass('req');
							$(".sNumber").removeClass('NumberInput');
					}
				 }
			  $(function(){
				  $( "#foundation_date" ).datepicker({
							showAnim:'slide',
							changeMonth: true,
							changeYear: true,
							dateFormat:'yy-mm-dd',
							onSelect: function(selected,evnt) {}
						  });
				  
				  	$('#project_type').change(function(){
						var val = $(this).val();
							if(val != 183){
						$("#form_details").fadeIn();
						$(".sForm").addClass('req');
						$(".sNumber").addClass('NumberInput');
						//sForm sNumber
					}
					else{
							$("#form_details").fadeOut();
							$(".sForm").removeClass('req');
							$(".sNumber").removeClass('NumberInput');
					}
					});
				  
				  
				  	$('.national').keyup(function(){
						var national_male_employes = $('#national_male_employes').val();
						var national_female_employes = $('#national_female_employes').val();
						if(!isNaN(national_male_employes) && !isNaN(national_female_employes))
						{
							var total_national = parseInt(national_male_employes)+parseInt(national_female_employes);
							$('#total_national').val(total_national);
						}
					});
					
					$('.foreign').keyup(function(){
						var foreign_male_employes = $('#foreign_male_employes').val();
						var foreign_female_employes = $('#foreign_female_employes').val();
						if(!isNaN(foreign_male_employes) && !isNaN(foreign_female_employes))
						{
							var total_foreign = parseInt(foreign_male_employes)+parseInt(foreign_female_employes);
							$('#total_foreign').val(total_foreign);
						}
					});
//-------------------------------------------------------------------						
					
		$('#save_data_form_step2').click(function(){
			
			 $('.req').removeClass('redline');
			 var ht = '<ul>';
			 	$('.req').each(function(index, element) {
					
					
                    if($(this).val()=='')
					{
						$(this).addClass('redline');
						ht += '<li> طلب '+$(this).attr('placeholder')+'</li>';
					}
                });
			  var redline = $('.redline').length;
			  ht += '</ul>';
			 	 
			  if(redline <= 0)
			  {	
				var str	=	$("#validate_form_step2").serialize();
				
				var request = $.ajax({
				  url: config.BASE_URL+'inquiries/requestphasetwo/'+$('#applicant_id').val(),
				  data: str,
				  type: "post",
				  dataType: "html",
				  beforeSend: function(){ 	$( "#dialog-confirm_dd" ).dialog({ resizable: false, height:150, width: 400, modal: true}); },
				  complete: function(){ $( "#dialog-confirm_dd" ).dialog( "close" ); },
				  success: function(msg){
					  str = null;					  
					  $('#requestphasethree').attr('data-id',msg);
					  $('#requestphasethree').click();
				  }
				});
				
			  }
			  else
			  {
				   ddx(ht);
			  }
		});
		
//-------------------------------------------------------------------		
				$('#province').change(function(){
				var province = $(this).val();
				var request = $.ajax({
					  url: config.AJAX_URL+'getWilayats',
					  type: "POST",
					  data: { province : province },
					  dataType: "html",
					  success: function(msg){
						  var walayalen = $('#walaya').length;
						  if(walayalen > 0)
						  {
							  $('#walaya').html(msg);
						  }
						  else
						  {
							  $('#wilayats').html(msg);
						  }
					  }
					});
				
			});	
//-------------------------------------------------------------------					
				  });
			  </script>