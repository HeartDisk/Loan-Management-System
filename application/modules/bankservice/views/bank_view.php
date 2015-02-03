<?php $this->load->view('common/meta');?>
<script type="text/javascript">
$(document).ready(function(e) {
	
		calculateAge();
    	$('.details').click(function(e){
			 //alert('click');
			var id = $(this).attr('id');
			// alert(id);
			 $(".show-content").html('');
			 $(".show-content").load(config.BASE_URL+'inquiries/get_applicant_data/'+id);
			 e.preventDefault();
			 
			 $( "#set-dialog-message-2" ).dialog({
					draggable: false,
					show: "fade", 
					hide: "explode",
					height:500,
					width:860,
					modal: true,
					buttons: {
					Ok: function() 
					{
						$(".show-content").val('');
						$( this ).dialog( "close" );
					}
					  }
					});
	});
	
	$(".ratings").change(function(){

			total_charges =0;			
				alert('asdasd');
					//$(".charges").each

					$(".ratings").each(function( i, l ){

					//alert( "Index #" + i + ": " + l );

					//console.log($(".charges").eq(i).val());

					

					//alert($(".charges").eq(i).val());

					if($(".ratings").eq(i).val() !=""){

					if($(".ratings").eq(i).val()<=5){
						//total_charges=total_charges+$(".charges").eq(i).val();

						val = $(".ratings").eq(i).val();

						//total_charges=total_charges+val;

						//console.log(parseInt(val));

						total_charges=parseInt(total_charges)+parseInt(val);	

						console.log(parseInt(total_charges));
						}
						else{
								$(".ratings").eq(i).val('');
						}
					}

					

					//total_charges=+parseInt($(".charges").eq(i).val());

					//$(".charges").eq(i).val();

				});

					$("#totalrating").val(total_charges);		

				});		
	
});

function calculateAge(){
			birthday = $("#birthday").val();
			birthday = new Date(birthday);
  			age = new Number((new Date().getTime() - birthday.getTime()) / 31536000000).toFixed(0);	
			if(isNaN(age)){
				//alert(age);
				$("#age_view").html(age);
			}else{
				///alert('age');	
				$("#age_view").html('0');
			}
			//alert(age);
}
</script>
<style>

.rowOne {

	background-color: #EFEFEF;

	padding: 6px 4px;

	text-align:right;

}

.rowTow {

	padding: 6px 4px;

	font-size: 13px;

	text-align: right;

	background-color: #ddd;

	font-weight: bold;

}

.rowThree {



}

.rowThree input {

	font-size: 11px;

	width: 90% !important;

	margin: 0px 0px;

}
.tab_control_last{
	float:left;
}

</style>
<div id="set-dialog-message-2" class="show-content" title="مشاهدة" style="display:none;"> </div>
<div class="body">

<div id="tasjeel"></div>

<?php $this->load->view('common/banner');?>

<div class="body_contant">

  <?php //$this->load->view('common/floatingmenu');

  	$applicant = $applicant_data['applicants'];
	
	//echo "<pre>";
//	print_r($applicant_data);

	$project = $applicant_data['applicant_project'][0];	
	$professional = $applicant_data['applicant_professional_experience'];
	$loan = $applicant_data['applicant_loans'][0];
	//echo "<pre>";
	//print_r($professional);
	$evo  = $applicant_data['project_evolution'][0];
	$phones = $applicant_data['applicant_phones'];

	$comitte = $applicant_data['comitte_decision'][0];

	$fullname = $applicant->applicant_first_name.' '.$applicant->applicant_middle_name.' '.$applicant->applicant_last_name.' '.$applicant->applicant_sur_name;

	foreach($phones as $p)

	{	$ar[] = '986'.$p->applicant_phone;	}

		$applicantphone = implode('<br>',$ar);

	

  ?>

  <style>

  .txt_f {

	 width:auto !important; 

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

      <div class="data_box_title">
        <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>

        <div class="data_title">تفاصيل البنك</div>

      </div>

      <div class="data_raw">

        <div class="data">

          <div class="main_data">

            <div class="personal" id="personal2">

              <div class="form_raw">

                <div class="user_txt txt_f"> تاريخ توقيع العقد:</div>

                <div class="user_field uft"> 23/12/2014 </div>
				
              </div>
              <div class="form_raw">
			  <div class="user_txt txt_f"> قيمة القرض:</div>

                <div class="user_field uft"> 20000 ريال عماني </div>
			  
			  </div>
			  <div class="form_raw">

                <div class="user_txt txt_f"> المبالغ المستلمة:</div>
				  <div class="user_field uft">15000 ريال عماني  </div>
                  <div class="user_txt txt_f">المبالغ المتبقية:</div>
                  <div class="user_field uft">5000 ريال عماني</div> 
              </div>
			  	<h3>رسالة الضمان البنكية (LG)</h3>
			  <div class="form_raw">

                <div class="user_txt txt_f"> مبلغ الضمان :</div>
				  <div class="user_field uft">5000 / الجهة الموردة  </div>
              </div>
			  <h3>صرف الدفعات</h3>
			  <div class="form_raw">

                <div class="user_txt txt_f"> الدفعة الأولى :</div>
				  <div class="user_field uft">21/12/2014  </div>
                  <div class="user_txt txt_f"> مبلغ الصرف:</div>
                  <div class="user_field uft">5000 ريال عماني</div> 
              </div>
			  <div class="form_raw">

                <div class="user_txt txt_f"> الدفعة الثانية :</div>
				  <div class="user_field uft">21/12/2014  </div>
                  <div class="user_txt txt_f"> مبلغ الصرف:</div>
                  <div class="user_field uft">5000 ريال عماني</div>
              </div>
              <div class="form_raw">
			  <hr/>
			  </div>
             <h3>جدول السداد</h3>
			  <div class="form_raw">
            	<div class="user_txt txt_f">فترة السماح:</div>
                <div class="user_field uft">4 أقساط = 12 شهر</div>
                  </div>
              <div class="form_raw">
            	<div class="user_txt txt_f">المبلغ المسدد</div>
                <div class="user_field uft">2000 ريال عماني</div>
            </div>
             <div class="form_raw">
            	<div class="user_txt txt_f">المبلغ المتبقي</div>
                <div class="user_field uft">18000 ريال عماني</div>
            </div>
			<div class="form_raw">
			<table width="650" border="1">
<tbody><tr style="background:#69F;"><td>التسلسل‬&lrm;</td><td>‫مبلغ القائم‬&lrm;‬&lrm;</td><td>‫التاريخ‬&lrm;‬&lrm;‬&lrm;</td><td>‫‫مبلغ القسط‬&lrm;‬&lrm;‬&lrm;</td><td>‫الرسوم</td><td>‫نوع الحركة‬&lrm;</td></tr> 
       
          <tr><td>1</td><td>20000.00</td><td>01/17/2015</td><td>00.00</td><td>00.00</td><td>سماح</td></tr>
                <tr><td>2</td><td>20000.00</td><td>02/17/2015</td><td>00.00</td><td>00.00</td><td>سماح</td></tr>
                <tr><td>3</td><td>20000.00</td><td>03/17/2015</td><td>00.00</td><td>00.00</td><td>سماح</td></tr>
                <tr><td>4</td><td>20000.00</td><td>04/17/2015</td><td>00.00</td><td>00.00</td><td>سماح</td></tr>
                <tr><td>5</td><td>19791.67</td><td>05/17/2015</td><td>208.33</td><td>197.92</td><td>قسط</td></tr>
                <tr><td>6</td><td>19583.34</td><td>06/17/2015</td><td>208.33</td><td>195.83</td><td>قسط</td></tr>
                <tr><td>7</td><td>19375.01</td><td>07/17/2015</td><td>208.33</td><td>193.75</td><td>قسط</td></tr>
                <tr><td>8</td><td>19166.68</td><td>08/17/2015</td><td>208.33</td><td>191.67</td><td>قسط</td></tr>
                <tr><td>9</td><td>18958.35</td><td>09/17/2015</td><td>208.33</td><td>189.58</td><td>قسط</td></tr>
                <tr><td>10</td><td>18750.02</td><td>10/17/2015</td><td>208.33</td><td>187.50</td><td>قسط</td></tr>
                <tr><td>11</td><td>18541.69</td><td>11/17/2015</td><td>208.33</td><td>185.42</td><td>قسط</td></tr>
                <tr><td>12</td><td>18333.36</td><td>12/17/2015</td><td>208.33</td><td>183.33</td><td>قسط</td></tr>
                <tr><td>13</td><td>18125.03</td><td>01/17/2016</td><td>208.33</td><td>181.25</td><td>قسط</td></tr>
                <tr><td>14</td><td>17916.70</td><td>02/17/2016</td><td>208.33</td><td>179.17</td><td>قسط</td></tr>
                <tr><td>15</td><td>17708.37</td><td>03/17/2016</td><td>208.33</td><td>177.08</td><td>قسط</td></tr>
                <tr><td>16</td><td>17500.04</td><td>04/17/2016</td><td>208.33</td><td>175.00</td><td>قسط</td></tr>
                <tr><td>17</td><td>17291.71</td><td>05/17/2016</td><td>208.33</td><td>172.92</td><td>قسط</td></tr>
                <tr><td>18</td><td>17083.38</td><td>06/17/2016</td><td>208.33</td><td>170.83</td><td>قسط</td></tr>
                <tr><td>19</td><td>16875.05</td><td>07/17/2016</td><td>208.33</td><td>168.75</td><td>قسط</td></tr>
                <tr><td>20</td><td>16666.72</td><td>08/17/2016</td><td>208.33</td><td>166.67</td><td>قسط</td></tr>
                <tr><td>21</td><td>16458.39</td><td>09/17/2016</td><td>208.33</td><td>164.58</td><td>قسط</td></tr>
                <tr><td>22</td><td>16250.06</td><td>10/17/2016</td><td>208.33</td><td>162.50</td><td>قسط</td></tr>
                <tr><td>23</td><td>16041.73</td><td>11/17/2016</td><td>208.33</td><td>160.42</td><td>قسط</td></tr>
                <tr><td>24</td><td>15833.40</td><td>12/17/2016</td><td>208.33</td><td>158.33</td><td>قسط</td></tr>
                
        </tbody></table>
            </div>
            <h3>إعادة جدولة</h3>
			<div class="form_raw">
            	<div class="user_txt txt_f">عدد الأقساط</div>
                <div class="user_field uft"><input type="text" value="4"></div>
            </div>
			<div class="form_raw">
            	<div class="user_txt txt_f">المستندات</div>
                <div class="user_field uft"><input type="file"></div>
            </div>
			<!--
            <!--
             
            <div class="form_raw yes_class_support">
            	<div class="user_txt txt_f"> الدعم التمويلي:</div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f"> مجال التدريب لصاحب المنشاة:</div>
                <div class="user_field uft"><?php  ?></div>
                
            </div>
            -->  </div>
              
<!--              <div class="form_raw">

                <div class="user_txt txt_f"> مبلغ القرض:</div>

                <div class="user_field uft"> <?php //echo arabic_date(number_format($loan->loan_amount,0)); ?> </div>

                <div class="user_txt txt_f"> الولاية:</div>

                <div class="user_field uft"> <?php //echo show_data('Walaya',$applicant->walaya); ?></div>

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
-->
			

            </div>
  
            </div>

          </div>

        </div>

      </div>
      

    </form>

  </div>

</div>

<script>
first_counter = 0;
second_counter = 0;
function deleteOption(id){
						//tab_control_last;
						//alert(id);
						$("."+id).remove();
				}


				function showMultiForms(){
					
					text = '<div class="form_raw fcounter'+first_counter+'"><div class="user_txt txt_f">قيمة المشروع الحالية:</div><div class="user_field"><input type="text" name="present_value_project[]" id="present_value_project[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>';
					text  += '</div><div class="user_txt txt_f fcounter'+first_counter+'">متوسط الايرادات الشهرية:</div><div class="user_field "><input type="text" name="average_monthly_revenue[]" id="average_monthly_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>';
					text  += '<div class="user_txt txt_f fcounter'+first_counter+'">السنوية الايرادات متوسط:</div><div class="user_field"><input type="text" name="average_anual_revenue[]" id="average_anual_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div></div>';
					text  += '<div class="user_txt txt_f fcounter'+first_counter+'" style="float: left;"><div class="tab_control_last" id="fcounter'+first_counter+'"  onclick="deleteOption(this.id)"> <img width="16" height="16" src="http://localhost/lm7DEC2014/images/body/contant/delete.png"></div></div>';
					text  += '<div class="form_raw fcounter"'+first_counter+'"><div class="user_txt txt_f"> الشهري الريح صافي متوسط:</div><div class="user_field "><input type="text" name="net_average_monthly_revenue[]" id="net_average_monthly_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>';
					text  += '<div class="user_txt txt_f fcounter'+first_counter+'"> السنوي الريح صافي متوسط:</div><div class="user_field"><input type="text" name="net_average_anual_revenue[]" id="net_average_anual_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div></div>'
					$("#first").prepend(text);
					first_counter++;
				}
				
				function showSecondMultiple(){
					//alert('asdasd');
					text2 = '<div class="form_raw scounter'+second_counter+'"><div class="user_txt txt_f"> الدعم التدريبي:</div><div class="user_field">نعم <input type="checkbox" name="support_training" id="support_training" value="1" /></div><div class="user_field">لا <input type="checkbox" name="support_training" id="support_training2" value="0" /></div></div>';
					text2 +='<div class="form_raw yes_class_support scounter'+second_counter+'"><div class="user_txt txt_f"> مجال التدريب لصاحب المنشأة </div><div class="user_field"><input  type="text"  name="training_owner_facility" id="training_owner_facility" /></div><div class="user_txt txt_f">  جهة التدريب  </div><div class="user_field"><input  type="text"  name="training" id="training" /></div></div>';
					text2 +='<div class="form_raw yes_class_support scounter'+second_counter+'"><div class="user_txt txt_f"> المدة </div><div class="user_field"><input  type="text"  name="duration" id="duration" /><div  style="float: left; margin-right: 7px;"> &nbsp;يوم/شهر</div></div><div class="user_txt txt_f" style="padding-right: 15px;">   قبل التأسيس:  </div><div class="user_field"><input  type="text"  name="before_incoporation" id="before_incoporation" /></div><div class="user_txt txt_f" style="padding-right: 15px;">   بعد التأسيس:  </div><div class="user_field uft"><input  type="text"  name="after_incoporation" id="after_incoporation" /></div></div>';
					text2 +='<div class="form_raw scounter'+second_counter+'"><div class="user_txt txt_f"> الدعم التمويلي:</div><div class="user_field ">نعم <input type="checkbox" name="funding_support" id="funding_support" value="1" /></div><div class="user_field">لا <input type="checkbox" name="funding_support" id="funding_support2" value="0" /></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+'"><div class="user_txt txt_f"> مبلغ الدعم  </div><div class="user_field"><input  type="text"  name="amount_support" id="amount_support" /><div  style="float: left; margin-right: 7px;"> &nbsp;رع</div></div><div class="user_txt txt_f" style="padding-right: 15px;">   جهة الدعم:  </div><div class="user_field"><input  type="text"  name="support_point" id="support_point" /></div><div class="user_txt txt_f" style="padding-right: 15px;">    قرض:  </div><div class="user_field uft"><input  type="text"  name="loan" id="loan" /></div><div class="user_txt txt_f" style="padding-right: 15px;">    منحة:  </div><div class="user_field uft"><input  type="text"  name="donation" id="donation"/></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+'"><div class="user_txt txt_f"> مبلغ الدعم  </div><div class="user_field"><input  type="text"  name="amount_support" id="amount_support" /><div  style="float: left; margin-right: 7px;"> &nbsp;رع</div></div><div class="user_txt txt_f" style="padding-right: 15px;">   جهة الدعم:  </div><div class="user_field"><input  type="text"  name="support_point" id="support_point" /></div><div class="user_txt txt_f" style="padding-right: 15px;">    قرض:  </div><div class="user_field uft"><input  type="text"  name="loan" id="loan" /></div><div class="user_txt txt_f" style="padding-right: 15px;">    منحة:  </div><div class="user_field uft"><input  type="text"  name="donation" id="donation"/></div></div>';
					text2 +='<div class="tab_control_last scounter'+second_counter+'" id="scounter'+second_counter+'"  onclick="deleteOption(this.id)" style="float: left;"> <img width="16" height="16" src="http://localhost/lm7DEC2014/images/body/contant/delete.png"></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+'"><div class="user_txt txt_f"> أخرى (يتم ذكرها)  </div><div class="user_field"><input  type="text"  name="mention_others" id="mention_others" /></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+'"><div class="user_txt txt_f"> وجه دعم أخرى </div><div class="user_field">نعم<input type="checkbox"  name="face_others_support" id="face_others_support1" value="1" /></div><div class="user_field">لا<input type="checkbox"  name="face_others_support" id="face_others_support2" value="0" /></div></div>';
					text2 += '<div class="form_raw yes_class_others scounter'+second_counter+'"><div class="user_field"><input  type="text"  name="face_others_support_text" id="face_others_support_text"  /></div></div>';
					$("#second").prepend(text2);
					second_counter++;
				}			  

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

				    $('#opendiag').click(function()

					{

						$( "#dialog_loan_view" ).dialog({

							resizable: false,

							height:700,

							width:900,

							

							modal: true});

					});

					

					$('#save_data_form_five').click(function(){

						$('#validate_form_data .req').removeClass('redline');

						var form_action = $('#validate_form_data').attr('action');

						 var ht = '<ul>';

							$('#validate_form_data .req').each(function(index, element) {

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

							  var dadx = $('#validate_form_data').serialize();

							  var taurusData = $.ajax({

									  url: form_action,

									  type:"POST",

									  data:dadx,									

									  success: function(msg){	$.amaran({

											  content:{

												  bgcolor:'#8e44ad',

												  color:'#fff',

												  message:'وقد أضيف إلى الاستعلام عن في النظام'},

												  theme:'colorful',

												  position:'bottom center',

												  closeButton:false,

												  cssanimationIn: 'rubberBand',

												  cssanimationOut: 'bounceOutUp'

													}); }

									});

						  }

						  else

						  {

							  ddx(ht);

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

				  });

			  </script>

                    

<?php $this->load->view('common/footer');?>

