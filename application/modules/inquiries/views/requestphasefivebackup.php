<?php $this->load->view('common/meta');?>
<style>
.data {
}
</style>
<div class="body">
<div id="tasjeel"></div>
<?php $this->load->view('common/banner');?>
<div class="body_contant">
  <?php //$this->load->view('common/floatingmenu');
  	//echo "<pre>";
  //	print_r($applicant_data);
  ?>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <form id="validate_form" name="validate_form" method="post" action="<?PHP echo base_url().'inquiries/comittie_decision' ?>" autocomplete="off">
      <div class="main_box">
      <div class="data_box_title"> <a class="addnewdata" href="<?PHP echo base_url(); ?>inquiries/resetinq">إضافة جديدة</a>
        <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
        <div class="data_title">قرار اللجنة</div>
      </div>
      <div class="data">
        <table cellspacing="0" cellpadding="1" border="1" width="100%">
          <tbody>
            <tr>
              <td class="td_text_data center" rowspan="2">االاسم</td>
              <td class="td_text_data center" rowspan="2"><textarea id="" name="" placeholder="االاسم"><?php echo $applicant_data->applicant_first_name; ?></textarea></td>
              <td class="td_text_data center">مبلغ القرض</td>
              <td class="td_text_data center">الولاية</td>
              <td class="td_text_data center">رقم الهاتف</td>
            </tr>
            <tr>
              <td><input type="text"  placeholder="مبلغ القرض" id="evolution_amount"  class="charges txt_field xx NumberInput" value="" name="evolution_amount"></td>
              <td><input type="text"  placeholder="الولاية" id="evolution_state" class="charges txt_field xx NumberInput" value="" name="evolution_state"></td>
              <td><input type="text"  placeholder="رقم الهاتف" id="evolution_number" class="charges txt_field xx NumberInput" value="" name="evolution_number"></td>
            </tr>
            <tr>
              <td class="td_text_data center" rowspan="2">النشاط</td>
              <td class="td_text_data center" rowspan="2"><textarea id="evolution_activity" name="evolution_activity" placeholder="النشاط"></textarea></td>
              <td class="td_text_data center">نوع البرنامج</td>
              <td class="td_text_data center">الولاية</td>
              <td class="td_text_data center">رقم الهاتف</td>
            </tr>
            <tr>
              <td colspan="3" style="text-align:center;">تأسيس
                <input type="radio"  name="evolution_program"  id="type_program1" value="تأسيس" />
                مورد
                <input type="radio"  name="evolution_program"  id="type_program2" value="مورد" />
                <br  clear="all" />
                ريادة
                <input type="radio"  name="evolution_program"  id="type_program2" value="ريادة" />
                تعزيز
                <input type="radio"  name="evolution_program"  id="type_program2" value="تعزيز" /></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="data_raw">
        <div class="data">
          <div class="main_data">
            <div class="personal" id="personal2">
              
              <div class="form_raw">
                <div class="user_txt"> الأسم:</div>
                <div class="user_field">
                  <?php echo $applicant_data->applicant_first_name." ".$applicant_data->applicant_last_name; ?>
                </div>
                <div class="user_txt"> النشاط:</div>
                <div class="user_field">
                  <?php echo $applicant_data->evolution_activity; ?>
                </div>
              </div>
              
              <div class="form_raw">
                <div class="user_txt"> مبلغ القرض:</div>
                <div class="user_field">
                  <?php echo $applicant_data->evolution_amount; ?>
                </div>
                <div class="user_txt"> الولاية:</div>
                <div class="user_field">
                  <?php echo $applicant_data->evolution_state; ?>
                </div>
                <div class="user_txt"> رقم الهاتف:</div>
                <div class="user_field">
                  <?php echo $applicant_data->evolution_number; ?>
                </div>
                <div class="user_txt"> نوع البرنامج:</div>
                <div class="user_field">
                  <?php echo $applicant_data->evolution_number; ?>
                </div>
              </div>
              
              <div class="form_raw">
                <div class="user_txt"></div>
                <div class="user_field">
                  تأسيس
                <input type="radio"  name="evolution_program"  id="type_program1" value="تأسيس" />
                مورد
                <input type="radio"  name="evolution_program"  id="type_program2" value="مورد" />
                <br  clear="all" />
                ريادة
                <input type="radio"  name="evolution_program"  id="type_program2" value="ريادة" />
                تعزيز
                <input type="radio"  name="evolution_program"  id="type_program2" value="تعزيز" />
                </div>
              
              </div>
              
              <div class="form_raw">
                <div class="user_txt"> نموذج قرار اللجنة </div>
                <div class="user_field">
                  <div class="form_field_selected">
                    <input name="comission_decision" id="comission_decision" value="<?PHP echo $main->comission_decision; ?>"  placeholder="نموذج قرار اللجنة" type="text" class="txt_field req">
                  </div>
                </div>
              </div>
              <div class="form_raw">
                <div class="user_txt">استماارة تقييم المقابلات </div>
                <div class="user_field">
                  <input name="astamaarah_value" id="astamaarah_value" value="<?PHP echo $main->astamaarah_value; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="استماارة تقييم المقابلات" type="text" class="txt_field req">
                </div>
              </div>
              <div class="form_raw">
                <div class="user_txt">قرار اللجنة</div>
                <div class="user_field" style="width: 460px;"> ‫الموافق
                  <input type="radio"  name="commitee_decision_type" id="is_project2" value="approved" onchange="check_comitee(this.value)"  class="req" placeholder='قرار اللجنة' />
                  ‫تأجيل
                  <input type="radio"  name="commitee_decision_type" id="is_project2" value="postponed" onchange="check_comitee(this.value)"  class="req" placeholder='قرار اللجنة'/>
                  
                  <!--   ‫‫تحويل<input type="radio"  name="commitee_decision_type" id="is_project2" value="convesion" onchange="check_comitee(this.value)"  class="req" placeholder='قرار اللجنة'/>--> 
                  ‫‫الرفض
                  <input type="radio"  name="commitee_decision_type" id="is_project2" value="rejected" onchange="check_comitee(this.value)"  class="req" placeholder='قرار اللجنة'/>
                </div>
              </div>
              <div class="form_raw" id="is_aproved"  style="display:none;">
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;"> ‫مشروطة
                  <input type="radio"  name="committee_decision_is_aproved" id="committee_decision_is_query" value="<?PHP echo "queries";?>"  class="" onchange="check_quez(this.value)" placeholder='الموافق' <?php if($main->committee_decision == "queries"){ ?> checked="checked" <?php }?> />
                  ‫موافقة اولية
                  <input type="radio"  name="committee_decision_is_aproved" id="committee_decision_is_aproved" value="<?PHP echo "approval"; ?>"  class="" onchange="check_quez(this.value)" placeholder='الموافق' <?php if($main->committee_decision == "approval"){ ?> checked="checked" <?php }?>/>
                </div>
              </div>
              <div class="form_raw" id="is_query"  style="display:none;">
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;">
                  <input name="query_text" id="query_text" value="<?PHP echo $main->query_text; ?>"  placeholder="موافقة اولية" type="text" class="txt_field req">
                </div>
              </div>
              <div class="form_raw" id="is_postponed"  style="display:none;">
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;"> 
                  <!--<select name="project_type"> 
                  <option value="">اعادة دراسة جدول للمشروع</option>
                  <option value=""> تحويل للهيئة للتدريب</option> 
                  <option value="">زيارة الموقع</option>
                  <option value="">التأكد  من مخاطر الاتمان </option>                                     
                    </select>-->
                  <?PHP exdrobpx('postponed',$main->project_type,'سبب التأجيل ','postponed',''); ?>
                </div>
              </div>
              <div class="form_raw" id="is_forward"  style="display:none;">
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;"> 
                  <!--<select name="project_type"> 
                  <option value="">بالمشروع </option>
                  <option value=""> عدم وجود جدوى في المشروع</option> 
                  <option value="">وجود مخاطر اتمان عالية للمشروع</option>
                  <option value="">عدم تغرغ صاحب المشروع</option>
                  <option value=""> نشاط المشروع لا يتم تمويلة من قبل الصندوق </option>                                     
                    </select>-->
                  <?PHP exdrobpx('project_type',$main->project_type,'سبب التأجيل ','project_type',''); ?>
                  <?PHP //exdrobpx('project_type',$main->project_type,'كان ألاول ','project_type',''); ?>
                </div>
              </div>
              <div class="form_raw" id="is_rejected"  style="display:none;">
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;">
                  <?PHP exdrobpx('rejected',$main->project_type,'سبب الرفض','rejected',''); ?>
                </div>
              </div>
              <div class="form_raw" id="is_aprovedamount"  style="display:none;">
                <div class="user_txt">قيمة التمويل </div>
                <div class="user_field">
                  <input name="approv_text" id="approv_text" value="<?PHP echo $main->approv_text; ?>" placeholder="قيمة التمويل" type="text" class="txt_field req">
                </div>
                ريال عماني </div>
            </div>
            <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field">
                <button type="button" id="save_data_form" class="btnx green">حفظ</button>
                <button style="display:none;" type="button" id="restart_data" class="btn default">إلغاء</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
			  
			  function check_comitee(val){
				  	//alert(val);
				  	if(val == 'approved'){
						$("#is_aprovedamount").hide();
						//$("#committee_decision_is_query").val();
						$("#committee_decision_is_query").addClass('req');
						$("#committee_decision_is_aproved").addClass('req');
						//$("#is_query").hide();
						//committee_decision_is_aproved
						$("#is_aproved").show();	
						$("#is_forward").hide();
						$("#is_postponed").hide();
						$("#is_rejected").hide();
					}
					else if(val =='postponed'){
							$("#committee_decision_is_query").removeClass('req');
							$("#committee_decision_is_aproved").removeClass('req');
							
							$("#query_text").removeClass('req');
							$("#approv_text").removeClass('req');
							
							$("#is_query").hide();
							
							$("#is_postponed").show();
							$("#is_aprovedamount").hide();
							$("#is_aproved").hide();
							$("#is_forward").hide();
							$("#is_rejected").hide();
						}
					else if(val =='convesion'){
						$("#committee_decision_is_query").removeClass('req');
						$("#committee_decision_is_aproved").removeClass('req');
						
						$("#query_text").removeClass('req');
						$("#approv_text").removeClass('req');
							
						$("#is_query").hide();	
							$("#is_forward").show();
							$("#is_postponed").hide();
							$("#is_aprovedamount").hide();
							$("#is_aproved").hide();
							$("#is_rejected").hide();
						}	
					else{
							$("#query_text").removeClass('req');
							$("#approv_text").removeClass('req');
							$("#is_query").hide();
							$("#is_forward").hide();
							$("#is_aproved").hide();
							$("#is_rejected").show();
							$("#is_postponed").hide();
							$("#is_aprovedamount").hide();
							$("#is_aproved").hide();
						//rejected
					}
				  		
				 }
				 
				 function check_quez(val){
					 	//alert(val);
						
						if(val == 'queries'){
							$("#is_query").show();
							$("#is_aprovedamount").hide();
							$("#is_postponed").hide();
							
							$("#query_text").addClass('req');
							$("#approv_text").removeClass('req');
						}
						else{
							
							$("#query_text").removeClass('req');
							$("#approv_text").addClass('req');
							
							$("#query_text").removeClass('req');
							$("#approv_text").addClass('req');
							$("#is_query").hide();
							$("#is_aprovedamount").show();
						}
					}
				 
				 $("#is_project2").click(function(){
					 		//alert('click');
					 });
					 $("#committee_decision").click(function(){
					 		//alert('click');
					 });
			  function check_project(val){
				  //	alert(val);
				  	if(val == 1){
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
				  });
			  </script>
<?php $this->load->view('common/footer');?>
