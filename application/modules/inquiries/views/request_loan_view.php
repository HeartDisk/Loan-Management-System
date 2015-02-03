<?PHP

	//echo "<pre>";
	$loan = $a['loan'];
	//print_r($loan);
	
	//$a['applicants'];
	//echo $a['applicants']->applicant_id;
	$evo = project_evolution($a['applicants']->applicant_id);
	
	//echo "<pre>";
	//print_r($b);
	//echo $b->loan_end_amount;

?>

<style>

.rowOne {

	background-color: #EFEFEF;

	padding: 6px 4px;

	text-align: right;

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

#evolution_notes {

	font-size: 13px;

	font-family: 'Droid Arabic Kufi', serif !important;

	width: 98%;

	padding: 7px;

}

.rowFour {

	font-family: 'Droid Arabic Kufi', serif !important;

	font-size: 13px;

text-align: right;

padding: 5px 3px;

}



.rowFive {

	font-family: 'Droid Arabic Kufi', serif !important;

	font-size: 13px;

text-align: right;

padding: 5px 3px;

}

.ui-dialog .ui-dialog-content {

position: relative;

border: 0;

padding: 1px 2px;

background: none;

overflow: auto;

font-size: 17px;

}

</style>

<form id="validate_form_six" name="validate_form_six" method="post" action="<?PHP echo base_url(); ?>inquiries/add_evolution_data" autocomplete="off">

<input type="hidden" id="applicant_id" value="<?PHP echo $a['applicants']->applicant_id; ?>" name="applicant_id" />
<input type="hidden" id="loan_start" value="<?PHP echo $b->loan_start_amount; ?>" name="loan_start" />
<input type="hidden" id="loan_limit" value="<?PHP echo $b->loan_end_amount; ?>" name="loan_limit" />
<input type="hidden" id="loan_amount" name="loan_amount"  value="<?php echo $loan->loan_amount; ?>"/>

  <script>

	$(function(){

		$(".charges").change(function(){

			total_charges =0;			

					//$(".charges").each

					$(".charges").each(function( i, l ){

					//alert( "Index #" + i + ": " + l );

					//console.log($(".charges").eq(i).val());

					

					//alert($(".charges").eq(i).val());

					if($(".charges").eq(i).val() !=""){

						//total_charges=total_charges+$(".charges").eq(i).val();

						val = $(".charges").eq(i).val();

						//total_charges=total_charges+val;

						//console.log(parseInt(val));

						total_charges=parseInt(total_charges)+parseInt(val);	

						console.log(parseInt(total_charges));

					}

					

					//total_charges=+parseInt($(".charges").eq(i).val());

					//$(".charges").eq(i).val();

				});
					
					lm_am = $("#loan_limit").val();
					lm_st = $("#loan_start").val();	
					if(total_charges>=lm_st && total_charges<=lm_am){
					
								$("#total_cost").val(total_charges);
								percent = $("#percentage").val();
								p = percent*0.01;
								p_cost = p*total_charges;
								$("#contribute").val(p_cost);

					}
					else
						alert(lm_am+' من فضلك ادخل المبلغ في إطار هذا');		

				});		

		

		$(".expensis").change(function(){

			total_expensis=0;			

					//$(".charges").each

					$(".expensis").each(function( i, l ){

					//alert( "Index #" + i + ": " + l );

					//console.log($(".charges").eq(i).val());

					

					//alert($(".charges").eq(i).val());

					if($(".expensis").eq(i).val() !=""){

						//total_charges=total_charges+$(".charges").eq(i).val();

						val = $(".expensis").eq(i).val();

						//total_charges=total_charges+val;

						//console.log(parseInt(val));

						total_expensis=parseInt(total_expensis)+parseInt(val);	
						

						//console.log(parseInt(total_charges));

					}

					

					//total_charges=+parseInt($(".charges").eq(i).val());

					//$(".charges").eq(i).val();

				});
				
					if(check_loan()){
						$("#total_expensis").val(total_expensis);			
					}
					else{
						alert('')	
					}


				});

		$('#save_data_form_loan').click(function(){

				$('#validate_form_six .req').removeClass('redline');

				 var ht = '<ul>';

					$('#validate_form_six .req').each(function(index, element) {

						if($(this).val()=='')

						{

							$(this).addClass('redline');

							ht += '<li> طلب '+$(this).attr('placeholder')+'</li>';

						}

					});

				  var redline = $('.redline').length;

				  var form_action = $('#validate_form_six').attr('action');

				 

				  ht += '</ul>';

				  if(redline <= 0)

				  {

					  var dadx = $('#validate_form_six').serialize();

					  var virogoData = $.ajax({

					  url: form_action,

					  type:"POST",

					  data:dadx,

					  beforeSend: function(){},

					  complete: function(){},

					  success: function(msg){  $('#dialog_loan_view').dialog('close');

					  		$.amaran({

							  content:{

								  bgcolor:'#8e44ad',

								  color:'#fff',

								  message:'وقد أضيف إلى الاستعلام عن في النظام'},

								  theme:'colorful',

								  position:'bottom center',

								  closeButton:false,

								  cssanimationIn: 'rubberBand',

								  cssanimationOut: 'bounceOutUp'

								});

					   }

					});

				  }

				  else

				  {

					  ddx(ht);

				  }

				

		});

		


	  });
	  
	  function check_loan(){
		 	t_cost  = $("#total_cost").val();
		  	alert(t_cost);
		 }

	</script>

  <table cellspacing="0" cellpadding="0" border="0" width="100%">

    <tbody>

      <tr>

        <td></td>

        <td></td>

        <td></td>
<!--
        <td class="rowOne"><input type="checkbox" <?PHP if($evo->is_working_capital=='1') { ?> checked="checked"<?PHP } ?> name="is_working_capital" id="is_working_capital"  value="1"/></td>

        <td class="rowOne"><input type="checkbox" <?PHP if($evo->is_furndloan=='1') { ?> checked="checked"<?PHP } ?> name="is_furndloan" id="is_furndloan" value="1" /></td>

        <td class="rowOne"><input type="checkbox" <?PHP if($evo->is_contiribute=='1') { ?> checked="checked"<?PHP } ?> name="is_contiribute" id="is_contiribute"  value="1"/></td>

        <td class="rowOne"><input type="checkbox" <?PHP if($evo->is_total=='1') { ?> checked="checked"<?PHP } ?> name="is_total" id="is_total" value="1" /></td>-->

      </tr>
      <tr>
            <td class="rowOne">البند</td>
			<td class="rowOne">المبلغ</td>
      </tr>

      <tr>

         <td class="rowTow">مصاريف ما قبل التشغيل</td>

		<td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="مصاريف ما قبل التشغيل" id="evolution_pre_expenses" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->evolution_pre_expenses); ?>" name="evolution_pre_expenses"></td>
      </tr>
		<tr>
      	<td class="rowTow">اثاث وتركيبات</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="اثاث وتركيبات" id="furniture_fixture" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->furniture_fixture); ?>" name="furniture_fixture"></td>
      </tr>
      
      <tr>
		<td class="rowTow">الآلات والمعدات</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="الآلات والمعدات" id="machinery_equipment" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->machinery_equipment); ?>" name="machinery_equipment"></td>

      </tr>
      <tr>
      

      <td class="rowTow">المركبات</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="المركبات" id="vehicles" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->vehicles); ?>" name="vehicles"></td>
	  </tr>
      <tr>
     <td class="rowTow">رأس المال العامل</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="رأس المال العامل" id="working_capital" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->working_capital); ?>" name="working_capital"></td>
      </tr>
     <td class="rowTow">المبلغ المخصص للبائع
(بالنسبة لشراء المشاريع)</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="رأس المال العامل" id="seller_amount" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->seller_amount); ?>" name="seller_amount"></td>
     <tr>
      <td class="rowTow">الاجمالي</td>
	   <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="الاجمالي" id="total_cost" class="txt_field xx NumberInput req" value="<?PHP echo($evo->total_cost); ?>" name="total_cost" readonly="readonly"></td>

     
     </tr>

      <tr>

        <td colspan="7" >&nbsp;</td>

      </tr>
       <tr>
        <td class="rowTow">المساهمة <?php echo $loan->loan_percentage."%"; ?></td>
        <?php
				
				$p = $loan->loan_percentage*0.01;
				$percentage = $evo->total_cost*$p;
		?>
        <input type="hidden" maxlength="10" size="15" placeholder="المساهمة" id="percentage" class="txt_field xx NumberInput req" value="<?PHP echo $loan->loan_percentage; ?>" name="percentage">
       <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="المساهمة" id="contribute" class="txt_field xx NumberInput req" value="<?PHP echo $percentage; ?>" name="contribute"></td>
	 </tr>
      <tr>

        <td colspan="7" >&nbsp;</td>

      </tr>
      <tr>

        <td colspan="7"  class="rowTow">الملاحظات</td>

      </tr>

      <tr>

        <td colspan="7"><textarea class="txt_field req" placeholder="الملاحظات" id="evolution_notes" name="evolution_notes"><?PHP echo($evo->evolution_notes); ?></textarea></td>

      </tr>

      <tr>

        <td colspan="7">&nbsp;</td>

      </tr>

<!--      <tr>

        <td colspan="7"  class="rowTow">قرار اللجنة</td>

      </tr>

      <tr>

        <td colspan="7" class="rowFour"> ‫الموافقة على القرض

          <input type="radio" placeholder="الموافقة على القرض" class="req" onchange="check_comitee(this.value)" <?PHP if($evo->commitee_decision=='loan_aproval') { ?> checked="checked"<?PHP } ?> value="loan_aproval" id="commitee_decision" name="commitee_decision">

          ‫ رفض الطلب

          <input type="radio" placeholder=" رفض الطلب" class="req" onchange="check_comitee(this.value)" <?PHP if($evo->commitee_decision=='rejection_applicants') { ?> checked="checked"<?PHP } ?> value="rejection_applicants" id="commitee_decision" name="commitee_decision">

          ‫‫تأجيل الطلب

          <input type="radio" placeholder="تأجيل الطلب" class="req" onchange="check_comitee(this.value)" <?PHP if($evo->commitee_decision=='postponed') { ?> checked="checked"<?PHP } ?> value="postponed" id="commitee_decision" name="commitee_decision">

          ‫‫تحويل للهيئة

          <input type="radio" placeholder="تحويل للهيئة" class="req" onchange="check_comitee(this.value)" <?PHP if($evo->commitee_decision=='conversion') { ?> checked="checked"<?PHP } ?> value="conversion" id="commitee_decision" name="commitee_decision"></td>

      </tr>-->

      <tr>

        <td colspan="7">&nbsp;</td>

      </tr>

      <tr>

        <td colspan="7"><table cellspacing="0" cellpadding="0" border="0" width="100%">

            <tbody>

              <tr>

                <td class="rowTow">اسم العضو</td>

                <td class="rowTow">التوقيع</td>

                <td class="rowTow">الملاحظات</td>

              </tr>
              <?PHP foreach(people() as $pd => $px) { 

			  			$dd = json_decode($evo->managersigns,TRUE);

						$value = $dd[$pd];	  ?>

              <tr>

                <td class="rowFive"><?PHP echo $px; ?></td>

                <td class="rowThree"><input type="text" value="<?PHP echo $value['sign']; ?>" placeholder="التوقيع" id="sign" class="txt_field xx req" name="sign[]"></td>

                <td class="rowThree"><input type="text" value="<?PHP echo $value['notes']; ?>" placeholder="الملاحظات" id="notes" class="txt_field xx req" name="notes[]"></td>

              </tr>

              <?PHP } ?>

            </tbody>

          </table></td>

      </tr>

      <tr>

        <td colspan="7">&nbsp;</td>

      </tr>

      <tr>

        <td colspan="7"><button type="button" id="save_data_form_loan" name="save_data_form_loan" class="btnx green">حفظ</button>

          </td>

      </tr>

    </tbody>

  </table>
  

</form>

