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
        <div class="data_title">صرف الدفعات</div>
      </div>
      <div class="data_raw">
        <div class="data">
          <div class="main_data">
            <div class="personal" id="personal2">
              <div class="form_raw">
                <div class="user_txt txt_f"> تاريخ الاستلام:</div>
                <div class="user_field uft" style="width:244px !important;"><input name="comission_decision" id="comission_decision" value="<?PHP //echo $comitte->comission_decision; ?>"  placeholder="نموذج قرار اللجنة" type="text" class="txt_field req db"></div>
              	<div class="user_txt txt_f" style="width:244px !important;margin-right: 71px;">تاريخ تحويل الملف الى بنك التنمية:</div>
                <div class="user_field uft"><input name="comission_decision" id="comission_decision" value="<?PHP //echo $comitte->comission_decision; ?>"  placeholder="تاريخ تحويل الملف الى بنك التنمية" type="text" class="txt_field req db"></div>
              </div>
            </div>
            	<div><h3 class="block"><span style="float: left; padding-left: 32px;"><strong><span id="total_payment" style="padding-left: 10px;"></span>مجموع الدفعات المستلمة</strong></span>صرف الدفعة الأولى</h3></div>	
            	<div class="form_raw">
                <div class="user_txt txt_f"> التاريخ:</div>
                <div class="user_field uft" style="width:244px !important;"><input name="comission_decision" id="comission_decision" value="<?PHP //echo $comitte->comission_decision; ?>"  placeholder="نموذج قرار اللجنة" type="text" class="txt_field req"></div>
              	<div class="user_txt txt_f" style="width:244px !important;margin-right: 71px;">المبلغ:</div>
                <div class="user_field uft"><input name="payment_amount" value="<?PHP //echo $comitte->comission_decision; ?>"  placeholder="تاريخ تحويل الملف الى بنك التنمية" type="text" class="txt_field req"><span>ريال عماني</span></div>
              </div>
            <div class="payment_exchange"></div>
            <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field">
                <button type="button" id="save_data" class="btnx green" onClick="addmorepayment()">إضافة</button>
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
<script type="text/javascript">
paymentIndex = 0;
function addmorepayment(){
	
		if(paymentIndex ==1)
			paymentNumber = "الثانية";
		if(paymentIndex ==2)
			paymentNumber = "الثالثة";
		if(paymentIndex ==3)
			paymentNumber = "الرابعة";
		if(paymentIndex ==4){
			paymentNumber = "الخامسة";
			$("#addPayment").hide();
			
		}
		payment='<h3 class="block">صرف الدفعة '+paymentNumber+'</h3>';
	payment+='<div class="form-group"><label class="control-label col-md-2">التاريخ </label><div class="col-md-4">';
	payment+='<input type="text" class="form-control date-picker" style="width:243px;" id="datepickerNew'+paymentIndex+'" name="payment_date['+paymentIndex+']" size="30"></div>';
	payment+='<label class="control-label col-md-2">المبلغ</label><div class="col-md-3"><input type="text" class="form-control payment_amount"  name="payment_amount['+paymentIndex+']"  value="" onchange="calculatePaymentAmount()" /></div><span>ريال عماني</span></div>';
	payment+='<div class="form-group"><label class="control-label col-md-2">تاريخ الريارة </label><div class="col-md-4">';
	payment+='<input type="text" class="form-control date-picker" style="width:243px;" id="visitdatepickerNew'+paymentIndex+'" name="visiting_date['+paymentIndex+']" size="30"></div></div>';
	payment+='<div class="form-group"><label class="control-label col-md-3">الرأي الفني</label><div class="col-md-8">';
	payment+='<textarea class="form-control" name="review_visit['+paymentIndex+']" style="height: 137px; width: 680px;"></textarea></div></div>';
	$(".payment_exchange").append(payment);
		
			//$("#datepickerNew"+paymentIndex+"").datepicker();
			//$("#visitdatepickerNew"+paymentIndex+"").datepicker();
			
	paymentIndex++;
			
	}
</script>