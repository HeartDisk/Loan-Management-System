<?PHP	

	$main = $m['applicant_loans'][0];

	

?>

<form id="validate_form_step3" name="validate_form_step3" method="post" action="<?PHP  echo base_url().'inquiries/requestphasethree'; ?>" autocomplete="off">

  <input type="hidden" name="form_step" id="form_step" value="3" />

  <input type="hidden" name="iscomplete" id="iscomplete" value="<?PHP echo sizeof($m['applicant_loans']); ?>" />

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

          <div class="user_txt">البرنامج المطلوب‎</div>

          <div class="user_field">

            <div class="form_field_selected">

              <?PHP loan_category('loan_limit',$main->loan_limit); ?>

            </div>

          </div>

        </div>

        <div class="form_raw">

          <div class="user_txt">قيمة القرض المطلوب</div>

          <div class="user_field">

            <input name="loan_amount" id="loan_amount" value="<?PHP echo $main->loan_amount; ?>" placeholder="قيمة القرض المطلوب" type="text" class="txt_field req NumberInput">

            <strong>ريال عماني</strong></div>

            <div class="user_field" id="loantxt"></div>

        </div>

        <div class="form_raw">

          <div class="user_txt">مساهمة شخصية بمبلغ وقدره (ان وجد)</div>

          <div class="user_field">

            <div class="perc" id="lp"></div>

            <div class="perc" id="ia"></div>

              

            <input name="interest_amount"  style="width: 87px !important; margin-right: 17px !important; " id="interest_amount" value="<?PHP echo $main->loan_percent; ?>" placeholder="منها مساهمه شخصية بمبلغ إن وجد قدره" type="hidden" class="txt_field req">

            <input name="loan_percent" style="width: 30px; margin-left: 7px;" id="loan_percent" value="<?PHP echo $main->loan_percent; ?>" placeholder="منها مساهمه شخصية بمبلغ إن وجد قدره" type="hidden" class="txt_field req">

            </div>

            

            

            

        </div>

        <input type="button" id="save_data_form_step3" name="save_data_form_step3" value="حفظ" class="btnx green"/>

        </div>

        <div class="form_raw" id="barchart"></div>

        

      </div>

    </div>

  </div>

</div>

<script>

$(function(){

	//-------------------------------------------------------------------				

		$('#save_data_form_step3').click(function()

		{

			$('.req').removeClass('redline');

			 var ht = '<ul>';

			 $('.req').each(function(index, element) 

			 {

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

				  var str	=	$("#validate_form_step3").serialize();

				  var request = $.ajax({

					  url: config.BASE_URL+'inquiries/requestphasethree/'+$('#applicant_id').val(),

					  type: "POST",

					  data: str,

					  dataType: "html",

					   beforeSend: function(){ 	$( "#dialog-confirm_dd" ).dialog({ resizable: false, height:150, width: 400, modal: true}); },

				  	complete: function(){ $( "#dialog-confirm_dd" ).dialog( "close" ); },

					  success: function(msg)

					  {

						  str = null;

						  $('#requestphasefour').attr('data-id',msg);

						  $('#requestphasefour').click();

					  }

				});

			}

			  else

			  {

				   ddx(ht);

			  }

		});

		

		$('#loan_amount').blur(function(){

			var loan_limit = $('#loan_limit').val();

			var loan_amount = $('#loan_amount').val();	

			var request = $.ajax({

					  url: config.AJAX_URL+'getLoanAmount',

					  type: "POST",

					  data: {loan_limit:loan_limit,loan_amount:loan_amount},

					  dataType: "json",

					  success: function(msg){

						  

						if(msg.er!='')

						{

							$('#loan_amount').val(0);

							ddx(msg.er);

						}

						else

						{							

							$('#loan_percent').val(msg.percentage);

							$('#interest_amount').val(msg.percent_amount);

							

							$('#lp').html(msg.percentage);

							$('#ia').html(msg.percent_amount);

							$('#barchart').highcharts({

									chart: {

										type: 'column',

										margin: 75,

										options3d: {

											enabled: true,

											alpha: 10,

											beta: 25,

											depth: 70

										}

									},

									title: {

										text: 'القرض المطلوب'

									},

									subtitle: {

										text: 'حساب القرض من قبل والمال العام'

									},

									plotOptions: {

										column: {

											depth: 25

										}

									},

									xAxis: {

										//categories: Highcharts.getOptions().lang.shortMonths

										categories:msg.cat

									},

									yAxis: {

										opposite: true

									},

									series: [{

										name: 'القرض',

										data: msg.loan_amount

									}]

								});

						}

						

					  }

					});

		});	

});

</script>