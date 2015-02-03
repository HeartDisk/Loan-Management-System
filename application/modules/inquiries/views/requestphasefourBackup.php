<?php $this->load->view('common/meta');?>

<div class="body">
<div id="tasjeel"></div>
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
      <?PHP if($t=='review') { ?>
      <?PHP } ?>
      <div class="main_box">
        <div class="data_box_title"> <a class="addnewdata" href="<?PHP echo base_url(); ?>inquiries/resetinq">إضافة جديدة</a>
          <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
          <div class="data_title">دراسه وتحليل الطلب</div>
        </div>
        <div class="data_raw">
          <div class="data">
            <div class="main_data">
            <!--<div class="data_title" style="padding-right: 15px;">مخاطر الإئتمان </div>-->
              <div class="personal" id="personal2">
                <div class="form_raw">
                  <div class="user_txt"></div>
                  <div class="user_field">
                  	الشخصية<input type="radio"  name="type_p" class="req"  placeholder='نوع'  value="presonal" onchange="check_type()" />
                    تجاري<input type="radio"  name="type_p"  class="req" placeholder='نوع'  value="company"  onchange="check_type()"/>
                  </div>
                </div>
                <div class="form_raw" style="display:none;" id="musanif_options">
                  <div class="user_txt"></div>
                  <div class="user_field">
                  	 مصنف<input type="radio"  name="is_musanif"  value="unclassified" onchange="check_clasi(this.value)" />
                    غير مصنف<input type="radio"  name="is_musanif"  value="classified"  onchange="check_clasi(this.value)"/>
                  </div>
                </div>
                <div class="form_raw unmusanif"  style="display:none;">
                  <div class="user_txt">كمية مشكلة</div>
                  <div class="user_field">
                  	 <input name="amount_problem" id="amount_problem" value="<?PHP echo $main->amount_problem; ?>"  placeholder="كمية مشكلة" type="text" class="ssForm txt_field ">
                  </div>
                </div>
                <div class="form_raw unmusanif" style="display:none;">
                  <div class="user_txt">ملاحظات</div>
                  <div class="user_field">
                    <textarea name="amount_notes" id="amount_notes" placeholder="ملاحظات" class="ssForm txt_field"  ><?PHP echo $main->project_difficulties; ?></textarea>
                  </div>
                </div>
                
                <!--<div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">مخاطر الإئتمان </div>
                  <div class="user_field">
                  		 نعم<input type="radio"  name="risk_credit"  value="1" onchange="check_credit(this.value)" />
                    لا<input type="radio"  name="risk_credit"  value="0"  onchange="check_credit(this.value)"/>
                  </div>
                </div>-->
                <!--<div class="form_raw" id="amount_risk"  style="display:none;">
                  <div class="user_txt">قيمة المبلغ  </div>
                  <div class="user_field">
                  	ريال عماني <input name="risk_amount" id="risk_amount" value="<?PHP echo $main->mr_number; ?>"   placeholder="" type="text" class="txt_field ">
                  </div>
                </div>-->
                
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">تقرير الزيارة الأولية </div>
                  </div>
                </div>
                <div id="technical" style="display:none;">
                <div class="form_raw">
                  <div class="user_txt">قيمة الإجار الشهري</div>
                  <div class="user_field"><input type="text" name="monthly_rent" id="monthly_rent"  class="txt_field"/>  
                  </div>
                  <div class="user_txt" style="padding-right: 21px;">اخرى</div>
                  <div class="user_field"><input type="text" name="monthly_other_rent" id="monthly_other_rent" class="txt_field"/>  
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">الكهر باء</div>
                  <div class="user_field">
                  		 نعم<input type="radio"  name="is_electricity"  class="sForm" value="1" />
                         لا<input type="radio"  name="is_electricity" class="sForm"  value="0"/>
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">الماء</div>
                  <div class="user_field">
                  		 نعم<input type="radio"  name="is_water"  class="sForm" value="1" />
                         لا<input type="radio"  name="is_water" class="sForm"  value="0"/>
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">المساحة الجملية  للمقر</div>
                  <div class="user_field">
                  		<input type="text" name="fine_headquarter" id="fine_headquarter"  class="txt_field"/>
                         م2
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">منها مغطاة</div>
                  <div class="user_field">
                  		<input type="text" name="which_covered" id="which_covered"  class="txt_field"/>
                       م2
                  </div>
                </div>
                
                <div class="form_raw">
                  <div class="user_txt">اهل ان المقر مناسب لنشاط المشروع؟</div>
                  <div class="user_field">   <textarea name="problem_notes" id="problem_notes" placeholder="الرأي الفني"  class="sForm txt_field" ><?PHP echo $main->project_difficulties; ?></textarea>
                  </div>
                </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt"></div>
                  <div class="user_field">
                  		 مكتمل<input type="radio"  name="is_complete"  class="sForm" value="1" />
                     غيرمكتمل<input type="radio"  name="is_complete" class="sForm"  value="0"/>
                  </div>
                </div>
                
            </div>
            
            
            
            <input type="button"  id="save_data"/>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
			  
			  function check_project(val){
				  //	alert(val);
				  	if(val == 1){
						$("#form_details").fadeIn();
					}
					else{
							$("#form_details").fadeOut();
					}
				 }
				 
				 function check_type(){
					 
					$("#musanif_options").show(); 
					}
				
				function check_clasi(val){
					//classified
					if(val == 'unclassified'){
						
						$(".unmusanif").show();
						$(".musanif").hide();
						$("#technical").hide();
						$("#problem_notes").removeClass('req');
						//
						
						$(".ssForm").addClass('req');
						
						$("#problem_notes").removeClass('req');
						$("#technical").hide();
						//$("#check_clasi").
					}
					else{
						
						$("#problem_notes").addClass('req');
						$("#technical").show();
						

						$(".ssForm").removeClass('req');
						$(".unmusanif").hide();
						$(".musanif").show();
					}
					//$("musanif_option").show();
				}
				
				function check_credit(val){
					if(val == 1){
						$("#amount_risk").show();
					}
					else{
						$("#amount_risk").hide();
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
					
;
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
