<?php $this->load->view('common/meta');?>
    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>
 <script type="application/javascript">
   $(function(){
					//alert('asdas');	
				  	$('.uploader').dmUploader({
					url: config.BASE_URL+'inquiries/uploadFile',
					dataType: 'json',
					allowedTypes: 'image/*',
					/*extFilter: 'jpg;png;gif',*/
					onInit: function(){
					 idd = $(this).attr('id');
					 
					 console.log(idd);
					 id_index = idd.substring(4,5);
					 //alert(id_index);
					 // $.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
					},
					onBeforeUpload: function(id){
					 // $.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);

					  //$.danidemo.updateFileStatus(id, 'default', 'Uploading...');
					},
					onNewFile: function(id, file){
						//alert(id);
						idd = $(this).attr('id');
						id_index = idd.substring(4,5);
					 
						demoFile = '#demo-files'+id_index;
						//id = idd.substring(4,5);
						//console.log(idd);
						id = idd.substring(4,5);
						//alert(idd);
					  $.danidemo.addFile(demoFile, id, file);
					},
					onComplete: function(){
					 // $.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
					},
					onUploadProgress: function(id, percent){
					  var percentStr = percent + '%';

					  $.danidemo.updateFileProgress(id, percentStr);
					  
					},
					onUploadSuccess: function(id, data){
					 // $.danidemo.addLog('#demo-debug', 'success', 'Upload of file #' + id + ' completed');

					  //$.danidemo.addLog('#demo-debug', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));

					 // $.danidemo.updateFileStatus(id, 'success', 'Upload Complete');
						id = idd.substring(4,5);
						$.danidemo.updateFileProgress(id, '100%');
						ff = data;	
						//$("#document_file"+id).val(ff.filename);
						$("#attachment").val(ff.filename);
						 
					 console.log(JSON.stringify(data));
					},
					onUploadError: function(id, message){
					  $.danidemo.updateFileStatus(id, 'error', message);

					  $.danidemo.addLog('#demo-debug', 'error', 'Failed to Upload file #' + id + ': ' + message);
					},
					onFileTypeError: function(file){
					  $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
					},
					onFileSizeError: function(file){
					  $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
					},
					/*onFileExtError: function(file){
					  $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' has a Not Allowed Extension');
					},*/
					onFallbackMode: function(message){
					  $.danidemo.addLog('#demo-debug', 'info', 'Browser not supported(do something else here!): ' + message);
					}
				  });
					
				  });
 
 </script>
<script type="text/javascript">
$(document).ready(function(e) {
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
	
});

$(document).ready(function(e) {
	//alert('readyh');
        $('.checkOption').click(function(e) {
			//alert('readyh');	
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
							url: config.BASE_URL+'inquiries/updatefinacialList/',
							type: "POST",
							data:{'id':id,'val':status_val,'appId':appId},
							dataType: "html",
							success: function(msg){
								//alert(msg);	 
						  }
					});
			
        });
    });
	
function add_requestmuwafiq(){
		$.ajax({
							url: config.BASE_URL+'inquiries/add_request/',
							type: "POST",
							data:$("#request_form").serialize(),
							dataType: "html",
							success: function(msg){
								//alert(msg);	 
									  	show_notification('تمت إضافة البيانات الخاصة بك بنجاح');
							
						  }
					});
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

</style>
<div id="set-dialog-message-2" class="show-content" title="مشاهدة" style="display:none;"> </div>
<div class="body">

<div id="tasjeel"></div>

<?php $this->load->view('common/banner');?>

<div class="body_contant">

  <?php //$this->load->view('common/floatingmenu');

  	$applicant = $applicant_data['applicants'];

	$project = $applicant_data['applicant_project'][0];

	$loan = $applicant_data['applicant_loans'][0];
	//echo "<pre>";
	//print_r($loan);
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

	 width:83px !important; 

	  }

	 .uft{ width: 140px !important;

font-size: 13px;

font-weight: bold;

padding-top: 3px;

padding-right: 6px;} 

  </style>

  <?PHP parentMenu(); 
  
  $percentage = $loan->loan_percentage*0.001;
  $val_p = $evo->total_cost*$percentage;
	//echo "<pre>";
	//echo $guarantee_data->gurantee_val;
	//print_r($guarantee_data);
	//exit;
	//$gurantee_val = json_decode($guarantee_data->gurantee_val);
	//$guarantee_data['conditions'];
	$instalment_points = json_decode($guarantee_data->instalment_points,true);
  	//print_r($gurantee_val);
	//print_r($instalment_points);
  ?>

  <div class="main_contant">

    <form id="request_form" name="request_form" method="post" action="<?PHP echo base_url().'inquiries/update_muwafiq' ?>" autocomplete="off">

      <input type="hidden" name="form_step" id="form_step" value="5" />      

      <input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $applicant->applicant_id;?>" />

      <div class="main_box">

      <div class="data_box_title">
        <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>

        <div class="data_title">موافقة أولية على تمويل المشروع</div>

      </div>

      <div class="data_raw">

        <div class="data">

          <div class="main_data">

            <div class="personal" id="personal2">

              <div class="form_raw">

                <div class="user_txt txt_f"> الرقم:</div>

                <div class="user_field uft" style="width: 500px !important;"> <?php echo applicant_number($applicant_id); ?> </div>
  
              </div>
              <div class="form_raw">

                <div class="user_txt txt_f"> التاريخ:</div>

                <div class="user_field uft" style="width: 500px !important;"> <?php echo show_date($applicatnt->applicant_regitered_date,1); ?> </div>
  
              </div>

              <div class="form_raw">

                <div class="user_txt txt_f"> الموافق:</div>

                <div class="user_field uft"  style="width: 500px !important;"> <?php //echo $project->activity_project_text; ?> </div>

              </div>
              
                <div class="form_raw">

                <div class="user_txt txt_f"> البرنامج المطلوب‎:</div>

                <div class="user_field uft"  style="width: 500px !important;"> <?php echo getLoanListType($loan->loan_limit);//echo $project->activity_project_text; ?> </div>

              </div>
              <div class="form_raw unmusanif">
				
				  <!-- D&D Zone-->
				  <div id="drag0" class="uploader">
						<div class="browser">
					  <label>
						<span>تحميل</span>
						<input type="file" name="files[]" multiple title='تحميل'>
                        <input type="hidden" name="attachment" id="attachment" />
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files0'>
					  <span class="demo-note"></span>
					</div>
				</div>
              
              
<!--              <div class="form_raw">

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
-->
			

			<?php
			//print_r($guarantee_data->gurantee_val);
			//$gurantee_val=  json_decode($guarantee_data->gurantee_val);
			$gurantee_val= json_decode($guarantee_data->gurantee_val,true);
			//$g =  json_decode($gurantee_val);
			//print_r($gurantee_val);
			?>
            </div>
            <table cellspacing="0" cellpadding="0" border="0" width="100%">

    <tbody>

      <tr>
         <td class="rowOne">الاسم</td>

		<td class="rowOne"><?php echo $fullname; ?></td>

        <td class="rowOne">رقم الهاتف</td>

        <td class="rowOne"><?php echo $applicantphone; ?></td>
      </tr>
            <tr>
         <td class="rowOne">نشاط المشروع</td>

		<td class="rowOne"><?php echo $project->activity_project_text; ?></td>

        <td class="rowOne">ص.ب</td>

        <td class="rowOne"><?php echo $applicant->zipcode; ?></td>
      </tr>
       <tr>
         <td class="rowOne">موقع المشروع</td>

		<td class="rowOne"><?php //echo $fullname; ?></td>

        <td class="rowOne">ر.ب</td>

        <td class="rowOne"><?php echo $applicant->postalcode; ?></td>
      </tr>
</tbody>
</table>

<p>يسرني إفادتكم بالموافقة المبدئية على طلبكم المتعلق بالحصول على قرض من صندوق الرفد وفقا للآتي:</p>
<h3>1-استخدامات القرض:</h3>
<table cellspacing="0" cellpadding="0" border="1" width="100%">

<tbody>
	     <tr>

        <td class="rowOne" colspan="2">الاستثمار </td>

		<td class="rowOne" colspan="3" >التمويل </td>
      </tr>
      	     <tr>

        <td class="rowOne">البند </td>

		<td class="rowOne">التكلفة </td>
        <td class="rowOne">البند </td>
        <td class="rowOne">المبلغ(ر.ع) </td>
        <td class="rowOne">لنسبة %</td>
        
      </tr>
      <tr>

        <td class="rowTow">مصاريف ما قبل التشغيل</td>

		<td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="البند" id="evolution_pre_expenses" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->evolution_pre_expenses); ?>" name="evolution_pre_expenses" readonly></td>
      	<td class="rowOne">مساهمة المقترض</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="مساهمة المقترض" id="furniture_fixture" class="charges txt_field xx NumberInput req" value="<?PHP echo $val_p; ?>" name="furniture_fixture" readonly></td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="مساهمة المقترض" id="furniture_fixture" class="charges txt_field xx NumberInput req" value="<?PHP echo $loan->loan_percentage; ?>" name="furniture_fixture" readonly></td>
      </tr>
		<!--<tr>
        <td class="rowTow">الآلات والمعدات</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="الآلات والمعدات" id="furniture_fixture" class="charges txt_field xx NumberInput req" value="<?PHP //echo($evo->furniture_fixture); ?>" name="furniture_fixture"></td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="مساهمة المقترض" id="furniture_fixture" class="charges txt_field xx NumberInput req" value="<?PHP //echo($evo->furniture_fixture); ?>" name="furniture_fixture"></td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="مساهمة المقترض" id="furniture_fixture" class="charges txt_field xx NumberInput req" value="<?PHP //echo($evo->furniture_fixture); ?>" name="furniture_fixture"></td>
        </tr>-->
      
      <tr>
		<td class="rowTow">الآلات والمعدات</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="الآلات والمعدات" id="machinery_equipment" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->machinery_equipment); ?>" name="machinery_equipment" readonly></td>
		<td class="rowOne" colspan="2" rowspan="6">قرض صندوق الرفد</td>
        <td class="rowOne" colspan="2" rowspan="6"><?PHP echo($evo->total_cost); ?></td>
      </tr>
      <tr>
		<td class="rowTow">اثاث وتركيبات</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="اثاث وتركيبات" id="furniture_fixture" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->furniture_fixture); ?>" name="furniture_fixture" readonly></td>
		</tr>
      <tr>
      	<td class="rowTow">المركبات</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="المركبات" id="vehicles" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->vehicles); ?>" name="vehicles" readonly></td>

      </tr>
      <tr>
      	<td class="rowTow">رأس المال العامل</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="رأس المال العامل" id="working_capital" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->working_capital); ?>" name="working_capital" readonly></td>

      </tr>
      <tr>
      

        <td class="rowTow">المبلغ المخصص للبائع
(بالنسبة لشراء المشاريع)</td>
        <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="رأس المال العامل" id="seller_amount" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->seller_amount); ?>" name="seller_amount" readonly></td>
	  </tr>
      <tr>
       <!--<td class="rowTow">قرض الصندوق</td>
      <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="قرض الصندوق" id="working_capital" class="charges txt_field xx NumberInput req" value="<?PHP echo($evo->working_capital); ?>" name="working_capital"></td>

      </tr>
-->      <!--<tr>
        <td class="rowTow">المساهمة</td>
       <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="المساهمة" id="contribute" class="txt_field xx NumberInput req" value="<?PHP echo($evo->contribute); ?>" name="contribute"></td>
	 </tr>-->
     <tr>
      <td class="rowTow">الاجمالي</td>
	   <td class="rowThree"><input type="text" maxlength="10" size="15" placeholder="الاجمالي" id="total_cost" class="txt_field xx NumberInput req" value="<?PHP echo($evo->total_cost); ?>" name="total_cost" readonly="readonly"></td>
      <td class="rowTow" colspan="2">الاجمالي</td>
	   <td class="rowThree" colspan="2"><input type="text" maxlength="10" size="15" placeholder="الاجمالي" id="total_cost" class="txt_field xx NumberInput req" value="<?PHP echo $evo->total_cost+$val_p; ?>" name="total_cost" readonly="readonly"></td>

     
     </tr>

    </tbody>

  </table>
  <h3>2-سداد القرض </h3>
<table cellspacing="0" cellpadding="0" border="1" width="100%">

<tbody>
	     <tr>

        <td class="rowOne" colspan="2">مبلغ القرض </td>

		<td class="rowOne" colspan="3" ><?PHP echo($evo->total_cost); ?> </td>
      </tr>
      <tr>

        <td class="rowOne" colspan="2">نسبة الرسوم الإدارية و الفنية </td>

		<td class="rowOne" colspan="3" >(<?php echo $loan->loan_percentage; ?> %) في السنة </td>
      </tr>
      <tr>

        <td class="rowOne" colspan="2">فترة السماح</td>

		<td class="rowOne" colspan="3" ><?php echo $loan->leave_installmment; ?> </td>
      </tr>
      <tr>

        <td class="rowOne" colspan="2">مدة سداد القرض</td>

		<td class="rowOne" colspan="3" >(<?php echo $loan->paid_instalment; ?>) سنوات  </td>
      </tr>
      <tr>

        <td class="rowOne" colspan="2">آلية السداد</td>

		<td class="rowOne" colspan="3" >أ-أصــــــــــل القـــــــــــرض:
•	عدد الأقساط (    <?php echo $loan->leave_installmment; ?> ) قسطا ربع سنوي                                            
•	البدء في السداد بعد فترة (   <?php echo $loan->paid_instalment; ?> )شهرا من تاريخ توقيع الاتفاقية                   
ب-الرسوم الإدارية و المالية:
•	لا تحتسب أية رسوم على فترة السماح المحدودة
  </td>
      </tr>
</tbody>
</table>
<p></p>
  <table cellspacing="0" cellpadding="0" border="2" width="100%">

    <tbody>
    <tr>

        <td class="rowOne" colspan="2">الضــــــمانــــــــات المطـــــــــلوبـــــــــة </td>

		<td class="rowOne" colspan="3" >قبل التوقيع على الاتفاقية: <br />
        <input type="checkbox" id="insurance_borrower" name="gurantee_val[0]" value="1" <?php if(isset($gurantee_val[0])) { ?> checked="checked" <?php } ?> class="checkOption" />التأمين على المقترض<br />
        <input type="checkbox" id="vehicle_insurance" name="gurantee_val[1]" value="1" <?php if(isset($gurantee_val[1])) { ?> checked="checked" <?php } ?>  class="checkOption"/>توفير تأمين شامل على المركبات<br />
        <input type="checkbox"  id="owner_ship" name="gurantee_val[2]" value="1" <?php if(isset($gurantee_val[2])) { ?> checked="checked" <?php } ?>  class="checkOption"/>رهن ملكية المركبات<br />
        <input type="checkbox" id="commercial_register" name="gurantee_val[3]" <?php if(isset($gurantee_val[3])) { ?> checked="checked" <?php } ?>  value="1" class="checkOption"/>رهن السجل التجاري لدى وزارة التجارة والصناعة<br />
        <input type="checkbox" id="project_assets" name="gurantee_val[4]" <?php if(isset($gurantee_val[4])) { ?> checked="checked" <?php } ?>  value="1" class="checkOption"/> رهن أصول المشروع (إن وجد)<br />
        <input type="checkbox" id="munciple_license" name="gurantee_val[5]" <?php if(isset($gurantee_val[5])) { ?> checked="checked" <?php } ?>  value="1" class="checkOption"/>توفير الترخيص البلدي و عقد الإيجار للمحل<br />
        <input type="checkbox" id="commitment_project_management" name="gurantee_val[6]" <?php if(isset($gurantee_val[0])) { ?> checked="checked" <?php } ?>  value="1" class="checkOption"/>الالتزام بالتفرغ الكلي لإدارة المشروع <br />
         </td>
      </tr>
      <tr>
        <td class="rowOne" colspan="2">الشــــــــــروط </td>
        <td class="rowOne" colspan="3" ><textarea style="width: 100%;" id="conditions" name="conditions"><?php echo $guarantee_data->conditions; ?></textarea>                    
</td>
      </tr>
      <tr>
        <td class="rowOne" colspan="2">آليات الصرف </td>
        <td class="rowOne" colspan="3" >•	يصرف مبلغ القرض بعد موافقة صندوق الرفد كالتالي:<br />• صرف مبلغ الآلات والمعدات للمورد مباشرة: <br /> 
        <input type="checkbox" id="exchange_first_pay" name="instalment_points[0]" value="1" <?php if(isset($instalment_points[0])) { ?> checked="checked" <?php } ?>    class="checkOption"/>دفعة واحدة <br />
        <input type="checkbox" id="exchange_second_pay" name="instalment_points[1]" value="1" <?php if(isset($instalment_points[1])) { ?> checked="checked" <?php } ?> class="checkOption"/>دفعتين <br />
        •	صرف مبلغ رأس المال في حساب المورد مباشرة:<br />
        <input type="checkbox" id="captial_amount_first_pay" name="instalment_points[2]" value="1" <?php if(isset($instalment_points[2])) { ?> checked="checked" <?php } ?> class="checkOption"/>دفعة واحدة <br />
        <input type="checkbox" id="capital_amount_second_pay" name="instalment_points[3]" value="1" <?php if(isset($instalment_points[3])) { ?> checked="checked" <?php } ?> class="checkOption"/>دفعتين <br />
        •	صرف جزء القرض المخصص لشراء المشروع مباشرة لصاحب المشروع (البائع) <br />
        <input type="checkbox" id="exchange_allocation_first_pay" name="instalment_points[4]" value="1" <?php if(isset($instalment_points[4])) { ?> checked="checked" <?php } ?> class="checkOption"/>دفعة واحدة <br />
        <input type="checkbox" id="exchange_allocation_second_pay" name="instalment_points[5]" value="1" <?php if(isset($instalment_points[5])) { ?> checked="checked" <?php } ?> class="checkOption" />دفعتين <br />
        </td>
      
      </tr>
    </tbody>
</table>
    <p>يرجى منكم التكرم بمراجعة بنك التنمية العماني في محافظتكم لاستكمال باقي الاجراءات الخاصة بالقرض, مع العلم أن في حالة عدم إبرام اتفاقية القرض مع بنك التنمية العماني في مدة أقصاها ستة أشهر من تاريخ هذه الرسالة يعتبر القرض لاغيا.</p>
	<p> و تفضلوا بقبول فائق الاحترام,,,  </p>
    <p>ونس بن محمد النصري                  </p>
    <p>مدير فرع صندوق الرفد بمحافظة مسقط </p>
    <p>وصل التسليم</p>
    <p>تاريخ التسليم: (        /       /      )</p>
    <p>
الموضوع:.........................................................................
</p>
<p>الاسم والتوقيع:</p>
<button type="button" id="save_data_form" name="save_data_form" class="btnx green" onclick="add_requestmuwafiq()">حفظ</button>
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

