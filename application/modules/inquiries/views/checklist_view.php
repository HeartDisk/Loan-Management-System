<?PHP

//print_r($checkList);
$ckList = $checkList[0];
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

<input type="hidden" id="applicant_id" value="<?PHP echo $appId; ?>" name="applicant_id" />

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

					$("#total_cost").val(total_charges);		

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

					$("#total_expensis").val(total_expensis);		

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
	$(document).ready(function(e) {
        $('.checkoption').click(function(e) {
            status = $(this).is(':checked');
			//alert(status);
			if(status == 'true'){
				status_val  =1;
			}
			else{
				status_val  =0;
			}
			//alert(status);
			id = $(this).attr('id');
			appId = $("#applicant_id").val();
			$.ajax({
							url: config.BASE_URL+'inquiries/updatecheckList/',
							type: "POST",
							data:{'id':id,'val':status_val,'appId':appId},
							dataType: "html",
							success: function(msg){
								//alert(msg);	 
						  }
					});
			
        });
    });
	</script>
<h3>كشف بالمستندات المطلوبة بعد الموافقة:</h3>
  <table cellspacing="0" cellpadding="0" border="0" width="100%">

    <tbody>

      <tr>

        <td></td>

      </tr>

      <tr>
		 <td class="rowTow"><input type="checkbox"  name="sealed_company" id="sealed_company" <?php if(!empty($ckList) && $ckList->sealed_company !="0") { ?> checked="checked" <?php  } ?> class="checkoption"/></td>	
         <td class="rowTow">1-أصل عروض الأسعار (مزود بأرقام حساب الموردين و مختومة بختم الشركة الموردة و

تكون باسم المؤسسة /الشركة).
</td>

		</tr>
		<tr>
      	<td class="rowTow"><input type="checkbox"  name="commercial_papers" id="commercial_papers" <?php if(!empty($ckList) && $ckList->commercial_papers !="0") { ?> checked="checked" <?php  } ?> class="checkoption"/></td>
        <td class="rowTow">2-أصل أوراق السجل التجاري+ ختم الشركة أو المؤسسة </td>
      </tr>
      
      <tr>
      	<td class="rowTow"><input type="checkbox"  name="municipal_contractrent" id="municipal_contractrent" <?php if(!empty($ckList) && $ckList->municipal_contractrent !="0") { ?> checked="checked" <?php  } ?>  class="checkoption"/></td>
		<td class="rowTow">3-أصل الترخيص البلدي و عقد الايجار (لا يشمل نشاط النقل).  </td>
       </tr>
       <tr>
		<td class="rowTow"><input type="checkbox"  name="membership_certificate" id="membership_certificate" <?php if(!empty($ckList) && $ckList->membership_certificate !="0") { ?> checked="checked" <?php  } ?> class="checkoption"/></td>
        <td class="rowTow">4-أصل شهادة الانتساب .  </td>
       </tr>
      <tr>
      <tr>
		<td class="rowTow"><input type="checkbox"  name="company_general_authority" id="company_general_authority" <?php if(!empty($ckList) && $ckList->company_general_authority !="0") { ?> checked="checked" <?php  } ?> class="checkoption"/></td>
        
        <td class="rowTow">5-تسجيل المؤسسة /الشركة بالهيئة العامة للمؤسسات الصغيرة والمتوسطة .  </td>
       </tr>
      <tr>
      <tr>
		<td class="rowTow"><input type="checkbox"  name="open_account" id="open_account" <?php if(!empty($ckList) && $ckList->open_account !="0") { ?> checked="checked" <?php  } ?> class="checkoption"/></td>
    	<td class="rowTow">6-فتح حساب باسم (المؤسسة/ الشركة) بعد استخراج (السجل التجاري+ شهادة الانتساب)   </td>
       </tr>
       <tr>
       <td class="rowTow"><input type="checkbox"  name="check_book" id="check_book" <?php if(!empty($ckList) && $ckList->check_book !="0") { ?> checked="checked" <?php  } ?> class="checkoption"/></td>
		<td class="rowTow">7-دفتر الشيكات (.........................شيك).  </td>
       </tr>
       <tr>
		<td class="rowTow"><input type="checkbox"  name="registration_zip" id="registration_zip" <?php if(!empty($ckList) && $ckList->check_book !="0") { ?> checked="checked" <?php  } ?> class="checkoption"/></td>
        <td class="rowTow">8-تسجيل الرمز البريدي و صندوق البريد.  </td>
       </tr>      
    </tbody>

  </table>
  

</form>

