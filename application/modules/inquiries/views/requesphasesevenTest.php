<?php $this->load->view('common/meta');?>

<div class="body">
<div id="tasjeel"></div>
<?php $this->load->view('common/banner');?>
<div class="body_contant">
  <?php //$this->load->view('common/floatingmenu');
  	$applicant = $applicant_data['applicants'];
	$project = $applicant_data['applicant_project'][0];
	$loan = $applicant_data['applicant_loans'][0];
	$phones = $applicant_data['applicant_phones'];
	$comitte = $applicant_data['comitte_decision'][0];
	$fullname = $applicant->applicant_first_name.' '.$applicant->applicant_middle_name.' '.$applicant->applicant_last_name.' '.$applicant->applicant_sur_name;
	foreach($phones as $p)
	{	$ar[] = '986'.$p->applicant_phone;	}
		$applicantphone = implode('<br>',$ar);
	
  ?>
  <style>
  .txt_f {
	 width:83px !important; 
	  }
	 .uft{ width: 140px !important;
font-size: 13px;
font-weight: bold;
padding-top: 3px;
padding-right: 6px;} 
  </style>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <form id="validate_form_data" name="validate_form_data" method="post" action="<?PHP echo base_url().'inquiries/comittie_decision' ?>" autocomplete="off">
      <input type="hidden" name="form_step" id="form_step" value="5" />      
      <input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $applicant->applicant_id;?>" />
      <div class="main_box">
      <div class="data_box_title"> <a class="addnewdata" href="<?PHP echo base_url(); ?>inquiries/resetinq">إضافة جديدة</a>
        <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
        <div class="data_title">قرار اللجنة</div>
      </div>
      <div class="data_raw">
        <div class="data">
          <div class="main_data">
            <div class="personal" id="personal2">
              <div class="form_raw">
                <div class="user_txt txt_f"> الأسم:</div>
                <div class="user_field uft" style="width: 500px !important;"> <?php echo $fullname; ?> </div>
              </div>
              <div class="form_raw">
                <div class="user_txt txt_f"> النشاط:</div>
                <div class="user_field uft"  style="width: 500px !important;"> <?php echo $project->activity_project_text; ?> </div>
              </div>
              <div class="form_raw">
                <div class="user_txt txt_f"> مبلغ القرض:</div>
                <div class="user_field uft"> <?php echo arabic_date(number_format($loan->loan_amount,0)); ?> </div>
                <div class="user_txt txt_f"> الولاية:</div>
                <div class="user_field uft"> <?php echo show_data('Walaya',$applicant->walaya); ?></div>
                <div class="user_txt txt_f"> رقم الهاتف:</div>
                <div class="user_field uft phonefield"> <?php echo $applicantphone; ?> </div>
                <div class="user_txt txt_f"> نوع البرنامج:</div>
                <div class="user_field uft"> <?php echo show_data('LoanLimit',$loan->loan_limit); ?> </div>
              </div>
              <div class="form_raw">
                <div class="user_txt"> نموذج قرار اللجنة </div>
                <div class="user_field">
                  <div class="form_field_selected">
                    <input name="comission_decision" id="comission_decision" value="<?PHP echo $comitte->comission_decision; ?>"  placeholder="نموذج قرار اللجنة" type="text" class="txt_field req">
                  </div>
                </div>
              </div>
              <div class="form_raw">
                <div class="user_txt"><a id="opendiag" href="#">استماارة تقييم المقابلات</a></div>
                <div class="user_field">
                  <textarea style="width: 657px; height: 100px;" id="astamaarah_value"  class="txt_field req" name="astamaarah_value"  placeholder="استماارة تقييم المقابلات"><?PHP echo $comitte->astamaarah_value; ?></textarea>
                 
                </div>
              </div>
              <div class="form_raw">
                <div class="user_txt">قرار اللجنة</div>
                <div class="user_field" style="width: 460px;"> ‫الموافق
                  <input type="radio" <?PHP if($comitte->commitee_decision_type=='approved') { ?> checked="checked"<?PHP } ?>  name="commitee_decision_type" id="is_project2" value="approved" onchange="check_comitee(this.value)"  class="req comitee" placeholder='قرار اللجنة' />
                  ‫تأجيل
                  <input type="radio" <?PHP if($comitte->commitee_decision_type=='postponed') { ?> checked="checked"<?PHP } ?>  name="commitee_decision_type" id="is_project2" value="postponed" onchange="check_comitee(this.value)"  class="req comitee" placeholder='قرار اللجنة'/>
                  
                  <!--   ‫‫تحويل<input type="radio"  name="commitee_decision_type" id="is_project2" value="convesion" onchange="check_comitee(this.value)"  class="req" placeholder='قرار اللجنة'/>--> 
                  ‫‫الرفض
                  <input type="radio" <?PHP if($comitte->commitee_decision_type=='rejected') { ?> checked="checked"<?PHP } ?>  name="commitee_decision_type" id="is_project2" value="rejected" onchange="check_comitee(this.value)"  class="req comitee" placeholder='قرار اللجنة'/>
                <?PHP if($comitte->commitee_decision_type!='') { ?>
               
                <?PHP } ?>
                </div>
              </div>
              <div class="form_raw" id="is_aproved" <?PHP if($comitte->commitee_decision_type!='approved') { ?>style="display:none;"<?PHP } ?>>
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;"> ‫مشروطة
                  <input type="radio"  name="committee_decision_is_aproved" id="committee_decision_is_query" value="queries"  class="" onchange="check_quez(this.value)" placeholder='الموافق' <?php if($comitte->committee_decision_is_aproved == "queries"){ ?> checked="checked" <?php }?> />
                  ‫موافقة اولية
                  <input type="radio"  name="committee_decision_is_aproved" id="committee_decision_is_aproved" value="approval"  class="" onchange="check_quez(this.value)" placeholder='الموافق' <?php if($comitte->committee_decision_is_aproved == "approval"){ ?> checked="checked" <?php }?>/>
                </div>
              </div>
              <div class="form_raw" id="is_query" <?PHP if($comitte->committee_decision_is_aproved!='queries') { ?>style="display:none;"<?PHP } ?>>
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;">
                  <input name="query_text" id="query_text" value="<?PHP echo $comitte->query_text; ?>"  placeholder="موافقة اولية" type="text" class="txt_field">
                </div>
              </div>
              <div class="form_raw" id="is_postponed" <?PHP if($comitte->commitee_decision_type!='postponed') { ?>style="display:none;"<?PHP } ?>>
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;">         
                  <?PHP exdrobpx('postponed',$comitte->project_type,'سبب التأجيل ','postponed',''); ?>
                </div>
              </div>
              <div class="form_raw" id="is_forward" style="display:none;">
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;">                
                  <?PHP exdrobpx('project_type',$comitte->project_type,'سبب التأجيل ','project_type',''); ?>
                </div>
              </div>
              <div class="form_raw" id="is_rejected"  <?PHP if($comitte->commitee_decision_type!='rejected') { ?>style="display:none;"<?PHP } ?>>
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;">
                  <?PHP exdrobpx('rejected',$comitte->project_type,'سبب الرفض','rejected',''); ?>
                </div>
              </div>
              <div class="form_raw" id="is_aprovedamount"  style="display:none;">
                <div class="user_txt">قيمة التمويل </div>
                <div class="user_field">
                  <input name="approv_text" id="approv_text" value="<?PHP echo $comitte->approv_text; ?>" placeholder="قيمة التمويل" type="text" class="txt_field">
                </div>
                ريال عماني </div>
            </div>
            <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field">
                <button type="button" id="save_data_form_five" class="btnx green">حفظ</button>
                <button style="display:none;" type="button" id="restart_data" class="btn default">إلغاء</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

              
<div id="dialog_loan_view" title="تقييم طلب القرض (لجنة سقف القروض)" style="display:none;">
  	<?PHP $this->load->view('request_loan_view',array('a'=>$applicant)); ?> 
</div>              
<?php $this->load->view('common/footer');?>
