<style>
.user_text{
	width:192px !important;
	
	
}
</style>
<?PHP	

	$main = $m['applicant_loans'][0];

	//echo "<pre>";
	//print_r($m['applicant_loans']);
	$app_loan = $m['applicant_loans'][0];
	//echo "<pre>";
	//print_r($app_loan);
	//echo $parentId;
		
?>

<form id="validate_form_step3" name="validate_form_step3" method="post" action="<?PHP  echo base_url().'inquiries/requestphasethree'; ?>" autocomplete="off">

				<input type="hidden" value="" id="loan_start" />
               <input type="hidden" value="" id="loan_end" />
               <input type="hidden" value="" id="loan_starting_day" />
               <input type="hidden" value="" id="loan_percentage" />
               <input type="hidden" value="" id="loan_aplicant_percentage" />
               <input type="hidden" value="" id="loan_expire_day" />
               <input type="hidden" value="" id="loan_expire_time" />
                
<?php 
		if(!empty($loan_calculate)){
			foreach($loan_calculate as $calculate){
				?>
               <input type="hidden" value="<?php echo $calculate->loan_start_amount; ?>" id="loan_start<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_end_amount; ?>" id="loan_end<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_starting_day; ?>" id="loan_starting_day<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_percentage; ?>" id="loan_percentage<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_aplicant_percentage; ?>" id="loan_aplicant_percentage<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_expire_day; ?>" id="loan_expire_day<?php echo $calculate->loan_category_id; ?>" />
               <input type="hidden" value="<?php echo $calculate->loan_expire_timeperiod; ?>" id="loan_expire_time<?php echo $calculate->loan_category_id; ?>" /> 
    
                <?php
			}
		}
	?>	
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

          <div class="user_txt">نوع المنتج</div>

          <div class="user_field" style="margin-right: 2%;">

            <div class="form_field_selected">

              <?PHP loan_category('loan_parent_limit',$parentId,''); ?>

            </div>
            
            <div class="user_txt" style="margin-right: 1%;"></div>
            
    		<div class="form_field_selected" id="child_c" style="display:none;padding-right: 44px;">

            </div>
    

          </div>
                 
        </div>
        
        <div class="form_raw">
          <div class="user_txt" style="margin-right: 1%;">نسبة الرسوم</div>
            <div class="user_field">
			<input type="text" name="loan_percentage" id="percenatage"  class="txt_field NumberInput" onchange="calculate()" value='<?php echo $app_loan->loan_percentage; ?>'/>
            </div>
           </div> 
        <div class="form_raw">

          <div class="user_txt" >مبلغ القرض</div>

          <div class="user_field" style="margin-right: 2%;">


              <input type="text" name="loan_amount" id="amount"  class="txt_field NumberInput" onchange="calculate()" value='<?php echo $app_loan->loan_amount; ?>'/>
            

          </div>
          
            <div class="user_txt" style="margin-right: 1%;">آلية السداد</div>
            <div class="user_field"><select name="type_installment" id="type_installment"  onchange="calculate()" value='<?php echo $app_loan->type_installment; ?>'>
    	<option value="">اختار</option>
        <option value="12" selected="selected">شهري</option>
        <option value="3">ربع سنوي</option>
	    </select>
            </div>


        <div class="form_raw">

          <div class="user_txt">:عدد أقساط فترة السماح</div>

          <div class="user_field">

              <input type="text" name="leave_installmment" id="leave_installmment"  class="txt_field NumberInput" onchange="calculate()" value='<?php echo $app_loan->leave_installmment; ?>'/>

            </div>
              <div class="user_txt">عدد أقساط السداد</div>
           
          <div class="user_field">
			 <input type="text"  name="paid_instalment" id="paid_instalment"  class="txt_field NumberInput" onchange="calculate()" value='<?php echo $app_loan->paid_instalment; ?>'/>
            </div>


          </div>
          
          <div class="form_raw">

          <div class="user_txt">قسط الأصل</div>

          <div class="user_field">
			 <input type="text" name="instalment_amount" id="instalment_amount" class="txt_field NumberInput" value='<?php echo $app_loan->instalment_amount; ?>' />
			</div>
               <div class="user_txt">مدة السداد (سنة)</div>
          <div class="user_field"> <input type="text"  name="total_no_years" id="total_no_years"  class="txt_field NumberInput" value='<?php echo $app_loan->total_no_years; ?>'/></div>
        </div>
        <div class="form_raw">

          <div class="user_txt">تاريخ الصرف المتوقع</div>

          <div class="user_field">
			<input type="text" id="start_date"  name="start_date" class="txt_field dateinput" value='<?php echo $app_loan->start_date; ?>'/>
			</div>
            <div class="user_txt">المساهمة الشخصية</div>
      		<div class="user_field"><input type="text" id="applicant_percentage"  name="applicant_percentage" class="txt_field dateinput" value='<?php echo $app_loan->applicant_percentage; ?>'/></div>	      
          </div>
		<div class="user_txt">	<a id="getData" href="javascript:void(0)" class="addnewdata needtip" original-title="">حاسبة</a></div>          
	</div>     
    <div class="form_raw">   
	<div id="response"></div>
    </div>
        <!--<div class="form_raw">

          <div class="user_txt">قيمة القرض المطلوب</div>

          <div class="user_field">

            <input name="loan_amount" id="loan_amount" value="<?PHP //echo $main->loan_amount; ?>" placeholder="قيمة القرض المطلوب" type="text" class="txt_field req NumberInput">

            <strong>ريال عماني</strong></div>

            <div class="user_field" id="loantxt"></div>

        </div>-->

        <!--<div class="form_raw">

          <div class="user_txt">مساهمة شخصية بمبلغ وقدره (ان وجد)</div>

          <div class="user_field">

            <div class="perc" id="lp"></div>

            <div class="perc" id="ia"></div>

              

            <input name="interest_amount"  style="width: 87px !important; margin-right: 17px !important; " id="interest_amount" value="<?PHP echo $main->loan_percent; ?>" placeholder="منها مساهمه شخصية بمبلغ إن وجد قدره" type="hidden" class="txt_field req">

            <input name="loan_percent" style="width: 30px; margin-left: 7px;" id="loan_percent" value="<?PHP echo $main->loan_percent; ?>" placeholder="منها مساهمه شخصية بمبلغ إن وجد قدره" type="hidden" class="txt_field req">

            </div>

            

            

            

        </div>-->

        <input type="button" id="save_data_form_step3" name="save_data_form_step3" value="حفظ" class="btnx green"/>

        </div>

        <div class="form_raw" id="barchart"></div>

        

      </div>

    </div>

  </div>

</div>
<script type="text/javascript">
$(document).ready(function(){
		child_id = ''
		
		
		<?php
		if(isset($parentId)){
		?>
		child_id = '<?php echo $app_loan->loan_limit ?>';
		load_child_category('<?php echo $parentId; ?>');
		<?php
		}
		?>
})
</script>

<script>

$(function(){

		var d = new Date();
		 var year = d.getFullYear();
		 var maxyear = d.getFullYear()-200;
		 d.setFullYear(maxyear);
		 d.setFullYear(year);
		//$('#BirthDate').datepicker({ changeYear: true, changeMonth: true, yearRange: '1920:' + year + '', defaultDate: d});
$( "#start_date" ).datepicker({
			showAnim:'slide',
			changeMonth: true,
			changeYear: true,
			dateFormat:'yy-mm-dd',
			onSelect: function(selected,evnt) {}
		  });
	//-------------------------------------------------------------------				
	
	$("#loan_parent_limit").change(function(){
		//alert('asdasd');
		parent_id  = $(this).val();
		//alert(parent_id);
		
		           /*var request = $.ajax({
					  url: config.BASE_URL+'ajax/loadHiddenData/',
					  type: "POST",
					  data: {'id':parent_id},
					  dataType: "html",
					  beforeSend: function() {		},
					  complete: function(){  },
					  success: function(msg){
								$("#response").html(msg);
						  }
					});*/
		
	});	
	$("#getData").click(function(e) {
			//alert('ajax');
			//calc_form
            var request = $.ajax({
					  url: config.BASE_URL+'inquiries/get_calc_data/',
					  type: "POST",
					  data: $("#validate_form_step3").serialize(),
					  dataType: "html",
					  beforeSend: function() {		},
					  complete: function(){  },
					  success: function(msg){
								$("#response").html(msg);
						  }
					});
        });
	


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


function check_data(val){
	
	 var request = $.ajax({
					  url: config.BASE_URL+'ajax/loadHiddenData/',
					  type: "POST",
					  data: {'id':val},
					  dataType: "html",
					  beforeSend: function() {		},
					  complete: function(){  },
					  success: function(msg){
								//$("#response").html(msg);
								mm = jQuery.parseJSON(msg);
								console.log(mm);
								//alert(mm.loan_percentage);
								$("#percenatage").val(mm.loan_percentage);
								$("#total_no_years").val(mm.loan_expire_day);
								$("#leave_installmment").val(mm.loan_starting_day);
								$("#applicant_percentage").val(mm.loan_applicant_percentage);
								
								$("#loan_start").val(mm.loan_start_amount);
								$("#loan_end").val(mm.loan_end_amount);
								//$("#loan_end").val(mm.loan_end);
								$("#loan_starting_day").val(mm.loan_starting_day);
								$("#loan_aplicant_percentage").val(mm.loan_aplicant_percentage);
								$("#loan_expire_day").val(mm.loan_expire_day);
								$("#loan_expire_time").val(mm.loan_expire_timeperiod);
								
	
						  }
					});
	//id = val;
	//loan_start_val = $("#loan_start"+id);
	//loan_end_val = $("#loan_end"+id);
	//percentage = $("#loan_percentage"+id).val();
	//fatritusamaa = $("#loan_starting_day"+id).val();
	//appPercentage = $("#loan_aplicant_percentage"+id).val();
	//loan_expire_day = $("#loan_expire_day"+id).val();
	//alert(id);
	//alert(loan_expire_day);
	
	//$("#leave_installmment").val(fatritusamaa);
	
			
			//alert(check_data);
			//add_data(c_val,'validate_form_step3');
}

</script>