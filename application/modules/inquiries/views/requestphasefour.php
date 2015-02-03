<?PHP
	$sad = $m['study_analysis_demand'][0];	
	$type_p = array('presonal'=>'شخصي','company'=>'تجاري');
	$type_p_array = json_decode($sad->type_p,TRUE);
?>
    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>
<form id="validate_form_step4" name="validate_form_step4" method="post" action="<?PHP echo base_url().'inquiries/requestphasefour'; ?>" autocomplete="off">
  <input type="hidden" name="form_step" id="form_step" value="4" />
  <input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $app_id;?>" />
  <?php if($t=='review') { ?>
  <input type="hidden" name="review" id="review" value="1" />
  <?PHP } ?>
  <?PHP if($t=='review') { ?>
  <?PHP } ?>       
        <div class="data_raw">
          
          <div class="data">
            <div class="main_data">
            <!--<div class="data_title" style="padding-right: 15px;">مخاطر الإئتمان </div>-->
              <div class="personal" id="personal2">
                <div class="form_raw">
                  <div class="user_txt">مخاطر الإئتمان </div>
                  <div class="user_field">
                  	نعم<input type="radio" <?PHP if($sad->credit_risk=='نعم') { ?> checked="checked"<?PHP } ?>  name="credit_risk" id="credit_risk" class="req"  placeholder='الإئتمان'  value="نعم" onchange="check_risk(this.value)" />
                    لا<input type="radio" <?PHP if($sad->credit_risk=='لا') { ?> checked="checked"<?PHP } ?>  name="credit_risk" id="credit_risk" class="req" placeholder='الإئتمان'  value="لا"  onchange="check_risk(this.value)"/>
                  </div>
				  <input type="hidden" name="document_file" id="document_file">
                </div>
				<div class="row demo-columns">
               <div class="form_raw"  id="type_value" <?PHP if($sad->credit_risk=='نعم') { ?>style="display:block;"<?PHP } else {  ?> style="display:none;"<?PHP }?>>
                  <div class="user_txt"></div>
                  <div class="user_field">
                  <?PHP foreach($type_p as $t => $td) { ?>
                  	<?PHP echo $td; ?><input type="checkbox" <?PHP if(in_array($t,$type_p_array)) { ?>checked="checked"<?PHP } ?>  name="type_p[]" id="type_p" class="req"  placeholder='نوع'  value="<?PHP echo $t; ?>" onchange="check_type()" />
                  <?PHP } ?> 
                    
                  </div>
                </div>
                <div class="form_raw risk_class"  id="type_value"  <?PHP if($sad->credit_risk=='لا') { ?>style="display:block;"<?PHP } else {  ?> style="display:none;"<?PHP }?>>
                  
                </div>
                
                
                <div class="form_raw" <?PHP if(isset($sad->is_musanif) && $sad->is_musanif !="") { ?>style="display:block;"<?PHP } else { ?>style="display:none;"<?PHP } ?> id="musanif_options">
                  <div class="user_txt"></div>
                  <div class="user_field">
                  	 مصنف<input type="radio" <?PHP if($sad->is_musanif=='unclassified') { ?> checked="checked"<?PHP } ?> class="bringmefood"  name="is_musanif" id="is_musanif" value="unclassified" onchange="check_clasi(this.value)" />
                    غير مصنف<input type="radio" <?PHP if($sad->is_musanif=='classified') { ?> checked="checked"<?PHP } ?> class="bringmefood"  name="is_musanif" id="is_musanif" value="classified"  onchange="check_clasi(this.value)"/>
                  </div>
                </div>
                <?PHP if($sad->is_musanif!='') { ?> 
						<script>
							$(function(){
								var valx = '<?PHP echo $sad->is_musanif; ?>';
								
								if(valx == 'unclassified')
								{
									$(".unmusanif").show();
									$("#details").show();
									$(".musanif").hide();
									$("#technical").hide();
									$("#problem_notes").removeClass('req');
									///$(".ssForm").addClass('req');									
									$("#problem_notes").removeClass('req');
									$("#technical").hide();
								}
								else
								{		
									$//("#problem_notes").addClass('req');
									$("#technical").show();
									$(".ssForm").removeClass('req');
									$(".unmusanif").hide();
									$("#details").hide();
									$(".musanif").show();
								}
								});
						</script>
				<?PHP } ?>
              <div id="details">  
              
                <div class="form_raw unmusanif" <?PHP if($sad->is_musanif=='مصنف') { ?> style="display:block;"<?PHP } else { ?>style="display:none;"<?PHP } ?>  >
               
                <input class="addpartnerphone" id="addnewmusanif" value="إضافة" type="button" style="float:left; cursor:pointer;" onclick="addMusanif()">
                <?php
					$financeData = json_decode($sad->financing);
					$loan_amount = json_decode($sad->loan_amount);
					$amount_paid = json_decode($sad->amount_paid);
					$residual = json_decode($sad->residual);
					$monthly_installment = json_decode($sad->monthly_installment);
					$project_difficulties = json_decode($sad->project_difficulties);
					$amount_problem = json_decode($sad->amount_problem);
					//amount_problem
					//project_difficulties
					if(!empty($financeData)){
						foreach($financeData as $i=>$finance){
							?>
                             <div class="form_raw unmusanif"  id="type_value2">
                		 <div class="user_txt">الجهة التمويلية</div>
                        <div class="user_field">
                   		<input name="financing[]" id="financing" value="<?PHP echo rQuote($financeData[$i]); ?>"  placeholder="الجهة التمويلية" type="text" class="ssForm txt_field ">
                  		</div>
                        </div>
                        <div class="form_raw unmusanif"  id="type_value2">
                         <div class="user_txt">مبلغ القرض</div>
                          <div class="user_field">
                           <input name="loan_amount[]" id="loan_amount" value="<?PHP echo rQuote($loan_amount[$i]); ?>"  placeholder="مبلغ القرض" type="text" class="ssForm txt_field NumberInput">
                          </div>
                		</div>
                        
   					
                        <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">المبلغ المسدد</div>
                  <div class="user_field">
                   <input name="amount_paid[]" id="amount_paid" value="<?PHP echo rQuote($amount_paid[$i]); ?>"  placeholder="المبلغ المسدد" type="text" class="ssForm txt_field NumberInput">
                  </div>
                </div>
                <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">المتبقي</div>
                  <div class="user_field">
                   <input name="residual[]" id="residual" value="<?PHP echo rQuote($residual[$i]); ?>"  placeholder="المتبقي" type="text" class="ssForm txt_field ">
                  </div>
                </div>
                <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">القسط الشهري</div>
                  <div class="user_field">
                   <input name="monthly_installment[]" id="monthly_installment" value="<?PHP echo rQuote($monthly_installment[$i]); ?>"  placeholder="القسط الشهري" type="text" class="ssForm txt_field ">
                  </div>
                </div>
                <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">الملاحظات</div>
                  <div class="user_field">
                   <textarea name="musanif_notes[]" id="notes" placeholder="الملاحظات"  class="ssForm txt_field" ><?PHP echo rQuote($musanif_notes[$i]); ?></textarea>
                  </div>
                  <div class="user_txt" style="display:none;">قيمة المخاطر‎</div>
                  <div class="user_field" style="display:none;">
                  	 <input name="amount_problem[]" id="amount_problem" value="<?PHP echo rQuote($amount_problem[$i]); ?>"  placeholder="كمية مشكلة" type="text" class=" txt_field ">
                  </div>
                </div>
				<input type="hidden" name="document_file[]" id="document_file<?php echo $i; ?>" value="<?php echo rQuote($sad->document_file); ?>">

                <div class="form_raw unmusanif" id="type_value2">
				
				  <!-- D&D Zone-->
				  <div id="drag<?php echo $i ?>" class="uploader">
						<div class="browser">
					  <label>
						<span>تحميل</span>
						<input type="file" name="files[]" multiple title='تحميل'>
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files<?php echo $i; ?>'>
					  <span class="demo-note"></span>
					</div>
				</div>
				<?php
						}		
					}
					else{
						?>
                        <div class="form_raw unmusanif"  id="type_value2">
                  <div class="user_txt">الجهة التمويلية</div>
                        <div class="user_field">
                   		<input name="financing[]" id="financing" value="<?PHP //echo $financeData[$i]; ?>"  placeholder="الجهة التمويلية" type="text" class="ssForm txt_field ">
                  		</div>  
                 </div>
                 <div class="form_raw unmusanif"  id="type_value2">
                         <div class="user_txt">مبلغ القرض</div>
                          <div class="user_field">
                           <input name="loan_amount[]" id="loan_amount" value="<?PHP //echo $financeData[$i]; ?>"  placeholder="مبلغ القرض" type="text" class="ssForm txt_field NumberInput">
                          </div>
                		</div>
                        <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">المبلغ المسدد</div>
                  <div class="user_field">
                   <input name="amount_paid[]" id="amount_paid" value="<?PHP echo rQuote($sad->amount_paid); ?>"  placeholder="المبلغ المسدد" type="text" class="ssForm txt_field NumberInput">
                  </div>
                </div>
				
                
				
                <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">المتبقي</div>
                  <div class="user_field">
                   <input name="residual[]" id="residual" value="<?PHP echo rQuote($sad->residual); ?>"  placeholder="المتبقي" type="text" class="ssForm txt_field ">
                  </div>
                </div>
                <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">القسط الشهري</div>
                  <div class="user_field">
                   <input name="monthly_installment[]" id="monthly_installment" value="<?PHP echo rQuote($sad->monthly_installment); ?>"  placeholder="القسط الشهري" type="text" class="ssForm txt_field ">
                  </div>
                </div>
                <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">الملاحظات</div>
                  <div class="user_field">
                   <textarea name="musanif_notes[]" id="notes" placeholder="الملاحظات"  class="ssForm txt_field" ><?PHP echo rQuote($sad->project_difficulties); ?></textarea>
                  </div>
                  <div class="user_txt " style="display:none;">قيمة المخاطر‎</div>
                  <div class="user_field" style="display:none;">
                  	 <input name="amount_problem[]" id="amount_problem" value="<?PHP echo rQuote($sad->amount_problem); ?>"  placeholder="كمية مشكلة" type="text" class=" txt_field ">
                  </div>
                </div>
				<!-- / Left column -->
				<div class="form_raw unmusanif" id="type_value2">
				
				  <!-- D&D Zone-->
				  <div id="drag0" class="uploader">
						<div class="browser">
					  <label>
						<span>تحميل</span>
						<input type="file" name="files[]" multiple title='تحميل'>
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files0'>
					  <span class="demo-note"></span>
					</div>
				</div>
				
				</div>
				
				
               	
				<?PHP  ?>
                        <?php
					}
				?>
                
                <!--<div class="form_raw unmusanif" style="display:none;">
                  <div class="user_txt" style="display:none;">ملاحظات</div>
                  <div class="user_field" style="display:none;">
                    <textarea name="amount_notes" id="amount_notes" placeholder="ملاحظات" class=" txt_field"  ><?PHP echo rQuote($sad->project_difficulties); ?></textarea>
                  </div>
                </div>-->
               
                
               </div> 
               
                <!--
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">تقرير الزيارة الأولية </div>
                  </div>
                </div>
				-->
                <div id="technical" style="display:none;">
                <div class="form_raw">
                  <div class="user_txt">قيمة الإجار الشهري</div>
                  <div class="user_field"><input type="text" value="<?PHP echo rQuote($sad->monthly_rent); ?>" name="monthly_rent" id="monthly_rent"  class="txt_field"/>  
                  </div>
                  <div class="user_txt" style="padding-right: 21px;">اخرى</div>
                  <div class="user_field"><input type="text" value="<?PHP echo rQuote($sad->monthly_other_rent); ?>" name="monthly_other_rent" id="monthly_other_rent" class="txt_field"/>  
                  </div>
                </div>
                <?php
				//echo "<pre>";
				//print_r($sad);
				//echo $sad->is_electricity;
				?>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">الكهرباء</div>
                  <div class="user_field">
                  		 نعم<input type="radio" <?PHP if(rQuote($sad->is_electricity)=='نعم') { ?> checked="checked"<?PHP } ?>  name="is_electricity"  class="sForm" value="1" />
                         لا<input type="radio" <?PHP if(rQuote($sad->is_electricity)=='لا') { ?> checked="checked"<?PHP } ?>  name="is_electricity" class="sForm"  value="0"/>
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">الماء</div>
                  <div class="user_field">
                  		 نعم<input type="radio"  <?PHP if(rQuote($sad->is_water)=='نعم') { ?> checked="checked"<?PHP } ?>  name="is_water"  class="sForm" value="1" />
                         لا<input type="radio"  <?PHP if(rQuote($sad->is_water)=='لا') { ?> checked="checked"<?PHP } ?>  name="is_water" class="sForm"  value="0"/>
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt" style=" width:260px;">هل المقر مناسب للمشروع؟</div>
                  <div class="user_field">مناسب<input <?PHP if(rQuote($sad->is_suitable)=='مناسب') { ?> checked="checked"<?PHP } ?> type="radio"  name="is_suitable"  class="sForm" value="1" />
                      غيرمناسب<input type="radio" <?PHP if(rQuote($sad->is_suitable)=='غيرمناسب') { ?> checked="checked"<?PHP } ?>  name="is_suitable" class="sForm"  value="0"/>
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">المساحة الجملية  للمقر</div>
                  <div class="user_field">
                  		<input type="text" value="<?PHP echo rQuote($sad->fine_headquarter); ?>" name="fine_headquarter" id="fine_headquarter"  class="txt_field"/>
                         م2
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">منها مغطاة</div>
                  <div class="user_field">
                  		<input type="text" value="<?PHP echo rQuote($sad->which_covered); ?>" name="which_covered" id="which_covered"  class="txt_field"/>
                       م2
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">ملاحظات الزيارة</div>
                  <div class="user_field">   <textarea name="visit_notes" id="visit_notes" placeholder="ملاحظات الزيارة"  class="sForm txt_field" ><?PHP echo rQuote($sad->visit_notes); ?></textarea>
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">الرأي الفني</div>
                  <div class="user_field">   <textarea name="technical_notes" id="problem_notes" placeholder="الرأي الفني"  class="sForm txt_field" ><?PHP echo rQuote($sad->technical_notes); ?></textarea>
                  </div>
                </div>
                
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">التوصيات</div>
                  <div class="user_field">   <textarea name="notes" id="problem_notes" placeholder="التوصيات"  class="sForm txt_field" ><?PHP echo rQuote($sad->notes); ?></textarea>
                  </div>
                </div>
                
                </div>
                <!-- <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt"></div>
                  <div class="user_field">
                  		 مكتمل<input type="radio" <?PHP if(rQuote($sad->is_complete)=='1') { ?> checked="checked"<?PHP } ?>  name="is_complete"  class="sForm" value="1" onclick="checkComplete(this.value)"/>
                     غيرمكتمل<input type="radio" <?PHP if(rQuote($sad->is_complete)=='0') { ?> checked="checked"<?PHP } ?>  name="is_complete" class="sForm"  value="0"  onclick="checkComplete(this.value)"/>
                  </div>
                </div>
                -->
                <div class="form_raw"  <?PHP if(rQuote($sad->is_complete)=='0') { ?> style="display:block;"<?PHP } else {  ?>style="display:none;"<?PHP } ?> id="uncomplete_notes">
                  <div class="user_txt">الملاحظات</div>
                  <div class="user_field">   <textarea name="uncomplete_notes" id="uncomplete_notes" placeholder="الملاحظات"  class="sForm txt_field" ><?PHP echo rQuote($sad->uncomplete_notes); ?></textarea>
                  </div>
                </div>
                <div id="TextBoxesGroup"></div>
            </div>
            
            <input type="button" id="save_data_form_step4" name="save_data_form_step4" value="حفظ" class="btnx green"/>
          </div>
        </div>
      
    </form> 
<script>
		$(document).ready(function (){
				
				 risk="<?php echo $sad->credit_risk; ?>";
				 check_risk(risk);
				 //alert(risk);
		});
					  
		
		
		function checkComplete(val){
			//alert(val);	
			if(val !=1){
				$("#uncomplete_notes").show();
			}
			else{
					$("#uncomplete_notes").hide();
			}
		}
	musanifIndex = 0;		  			
	function addMusanif(){
		//alert('asdasd');
		 var newphones = $.ajax({
						  url: config.AJAX_URL+'new_musanif',
						  type: "POST",
						  data: {'musanifIndex':musanifIndex,'counter':counter},
						  dataType: "html",
						  success: function(msg){
							  
							  musanifIndex++;
							$("#details").append(msg);
							//$('#hatfi'+vox[1]).last().after(msg)
							
						  }
						});
	}	
	
	 function createElement(counter,val){
				//  var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
					 html_hiden= '<input type="hidden" name="attachment[]" id="attachment' + counter + '" value="' + val + '" >';
						$("#TextBoxesGroup").append(html_hiden);

			}
	function removeMusanif(id){
		$(".ms"+id).remove();
		musanifIndex--;
	}
	
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
						//$("#details").show();
						$(".musanif").hide();
						$("#technical").hide();
						$("#problem_notes").removeClass('req');
						//
						
						//$(".ssForm").addClass('req');
						
						$("#problem_notes").removeClass('req');
						$("#technical").hide();
						//$("#check_clasi").
					}
					else{
						
						//$("#problem_notes").addClass('req');
						//$("#technical").show();
						

						$(".ssForm").removeClass('req');
						$(".unmusanif").hide();
						$("#details").hide();
						$(".musanif").show();
					}
					//$("musanif_option").show();
				}
				function check_risk(val){
					if(val == 'نعم'){
						$("#type_value").show();
						//$(".ssForm").addClass('req');
						$(".risk_class").hide();
						$("#technical").hide();
						$(".sForm").removeClass('req');
					}
					else{
						//$(".sForm").addClass('req');
						//$(".risk_class").show();
						$("#type_value").hide();
						//unmusanif
					//	$('#technical').hide();
						$(".unmusanif").hide();
						$("#musanif_options").hide();
						$(".ssForm").removeClass('req');
					
						//$("#problem_notes").addClass('req');
						//$("#technical").show();
						

						$(".ssForm").removeClass('req');
						$(".unmusanif").hide();
						$(".musanif").show();
					}
				}
				function check_credit(val){
					if(val == 1){
						$("#amount_risk").show();
					}
					else{
						$("#amount_risk").hide();
					}
				}
				
				function showUploader(){
					
				
				
				}
				counter=0;

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
						$("#document_file"+id).val(ff.filename);
						//createElement(counter,ff.filename);
						 counter++;
						 
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
					
					$("#is_complete").click(function(){
							
					});
					
					$('#save_data_form_step4').click(function(){
						//$("#save_data_form_step4").hide();
					 $('.req').removeClass('redline');
					 var ht = '<ul>';
						$('.req').each(function(index, element) {
							
							
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
							var validata	=	$("#validate_form_step4").serialize();
							
							var request = $.ajax({
							  url: config.BASE_URL+'inquiries/requestphasefour/'+$('#applicant_id').val(),
							  type: "POST",
							  data: validata,
							  dataType: "html",
							  success: function(msg){
								  
								  	show_notification('تمت إضافة البيانات الخاصة بك بنجاح');
									
								//	window.top.location = config.BASE_URL+'inquiries/transactions/';
								 
							  }
							});
					  }
					  else
					  {
						   ddx(ht);
					  }
				});
				  });
			  </script>
			  
