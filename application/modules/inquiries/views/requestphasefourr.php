<?PHP
	$sad = $m['study_analysis_demand'][0];	
	$type_p = array('presonal'=>'شخصي','company'=>'تجاري');
	$type_p_array = json_decode($sad->type_p,TRUE);
?>
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
                </div>
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
                
                
                <div class="form_raw" <?PHP if(in_array($t,$type_p_array)) { ?>style="display:block;"<?PHP } else { ?>style="display:none;"<?PHP } ?> id="musanif_options">
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
									$(".ssForm").addClass('req');									
									$("#problem_notes").removeClass('req');
									$("#technical").hide();
								}
								else
								{		
									$("#problem_notes").addClass('req');
									$("#technical").show();
									$(".ssForm").removeClass('req');
									$(".unmusanif").hide();
									$("#details").hide();
									$(".musanif").show();
								}
								});
						</script>
				<?PHP } ?>
              <div id="details" >  
              
                <div class="form_raw unmusanif" <?PHP if($sad->is_musanif=='مصنف') { ?> style="display:block;"<?PHP } else { ?>style="display:none;"<?PHP } ?>  >
                <input style="display:none;"  class="addpartnerphone" id="addnewmusanif" value="إضافة" type="button" style="float:left;" onclick="addMusanif()">
                <div class="user_txt">الجهة التمويلية</div>
                  <div class="user_field">
                   <input name="financing" id="financing" value="<?PHP echo $sad->financing; ?>"  placeholder="الجهة التمويلية" type="text" class="ssForm txt_field ">
                  </div>
                </div>
                <div class="form_raw unmusanif"  id="type_value2" <?PHP if($sad->is_musanif=='غير مصنف') { ?> style="display:block;"<?PHP } else { ?>style="display:none;"<?PHP } ?>>
                
                  <div class="user_txt">مبلغ القرض</div>
                  <div class="user_field">
                   <input name="loan_amount" id="loan_amount" value="<?PHP echo rQuote($sad->loan_amount); ?>"  placeholder="مبلغ القرض" type="text" class="ssForm txt_field NumberInput">
                  </div>
                </div>
                <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">المبلغ المسدد</div>
                  <div class="user_field">
                   <input name="amount_paid" id="amount_paid" value="<?PHP echo rQuote($sad->amount_paid); ?>"  placeholder="المبلغ المسدد" type="text" class="ssForm txt_field NumberInput">
                  </div>
                </div>
                <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">المتبقي</div>
                  <div class="user_field">
                   <input name="residual" id="residual" value="<?PHP echo rQuote($sad->residual); ?>"  placeholder="المتبقي" type="text" class="ssForm txt_field ">
                  </div>
                </div>
                <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">القسط الشهري</div>
                  <div class="user_field">
                   <input name="monthly_installment" id="monthly_installment" value="<?PHP echo rQuote($sad->monthly_installment); ?>"  placeholder="القسط الشهري" type="text" class="ssForm txt_field ">
                  </div>
                </div>
                <div class="form_raw unmusanif"  id="type_value2" style="display:none;">
                  <div class="user_txt">الملاحظات</div>
                  <div class="user_field">
                   <textarea name="musanif_notes" id="notes" placeholder="الملاحظات"  class="sForm txt_field" ><?PHP echo rQuote($sad->project_difficulties); ?></textarea>
                  </div>
                  <div class="user_txt" style="display:none;">قيمة المخاطر‎</div>
                  <div class="user_field" style="display:none;">
                  	 <input name="amount_problem" id="amount_problem" value="<?PHP echo rQuote($sad->amount_problem); ?>"  placeholder="كمية مشكلة" type="text" class=" txt_field ">
                  </div>
                </div>
                <!--<div class="form_raw unmusanif" style="display:none;">
                  <div class="user_txt" style="display:none;">ملاحظات</div>
                  <div class="user_field" style="display:none;">
                    <textarea name="amount_notes" id="amount_notes" placeholder="ملاحظات" class=" txt_field"  ><?PHP echo rQuote($sad->project_difficulties); ?></textarea>
                  </div>
                </div>-->
                <?PHP showFileUpload($app_id); ?>
                
               </div> 
               
                
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">تقرير الزيارة الأولية </div>
                  </div>
                </div>
                <div id="technical" style="display:none;">
                <div class="form_raw">
                  <div class="user_txt">قيمة الإجار الشهري</div>
                  <div class="user_field"><input type="text" value="<?PHP echo rQuote($sad->monthly_rent); ?>" name="monthly_rent" id="monthly_rent"  class="txt_field"/>  
                  </div>
                  <div class="user_txt" style="padding-right: 21px;">اخرى</div>
                  <div class="user_field"><input type="text" value="<?PHP echo rQuote($sad->monthly_other_rent); ?>" name="monthly_other_rent" id="monthly_other_rent" class="txt_field"/>  
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">الكهرباء</div>
                  <div class="user_field">
                  		 نعم<input type="radio" <?PHP if(rQuote($sad->is_electricity)=='1') { ?> checked="checked"<?PHP } ?>  name="is_electricity"  class="sForm" value="1" />
                         لا<input type="radio" <?PHP if(rQuote($sad->is_electricity)=='0') { ?> checked="checked"<?PHP } ?>  name="is_electricity" class="sForm"  value="0"/>
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt">الماء</div>
                  <div class="user_field">
                  		 نعم<input type="radio"  <?PHP if(rQuote($sad->is_water)=='1') { ?> checked="checked"<?PHP } ?>  name="is_water"  class="sForm" value="1" />
                         لا<input type="radio"  <?PHP if(rQuote($sad->is_water)=='0') { ?> checked="checked"<?PHP } ?>  name="is_water" class="sForm"  value="0"/>
                  </div>
                </div>
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt" style=" width:260px;">هل المقر مناسب للمشروع؟</div>
                  <div class="user_field">مناسب<input <?PHP if(rQuote($sad->is_suitable)=='1') { ?> checked="checked"<?PHP } ?> type="radio"  name="is_suitable"  class="sForm" value="1" />
                      غيرمناسب<input type="radio" <?PHP if(rQuote($sad->is_suitable)=='0') { ?> checked="checked"<?PHP } ?>  name="is_suitable" class="sForm"  value="0"/>
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
                  <div class="user_field">   <textarea name="visit_notes" id="problem_notes" placeholder="ملاحظات الزيارة"  class="sForm txt_field" ><?PHP echo rQuote($sad->visit_notes); ?></textarea>
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
                <div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt"></div>
                  <div class="user_field">
                  		 مكتمل<input type="radio" <?PHP if(rQuote($sad->is_complete)=='1') { ?> checked="checked"<?PHP } ?>  name="is_complete"  class="sForm" value="1" onclick="checkComplete(this.value)"/>
                     غيرمكتمل<input type="radio" <?PHP if(rQuote($sad->is_complete)=='0') { ?> checked="checked"<?PHP } ?>  name="is_complete" class="sForm"  value="0"  onclick="checkComplete(this.value)"/>
                  </div>
                </div>
                
                <div class="form_raw"  <?PHP if(rQuote($sad->is_complete)=='1') { ?> style="display:block;"<?PHP } else {  ?>style="display:none;"<?PHP } ?> id="uncomplete_notes">
                  <div class="user_txt">الملاحظات</div>
                  <div class="user_field">   <textarea name="uncomplete_notes" id="uncomplete_notes" placeholder="الملاحظات"  class="sForm txt_field" ><?PHP echo rQuote($sad->uncomplete_notes); ?></textarea>
                  </div>
                </div>
                
            </div>
            
            <input type="button" id="save_data_form_step4" name="save_data_form_step4" value="حفظ" class="btnx green"/>
          </div>
        </div>
      
    </form> 
<script>
			  
		$('.fileupload').unbind('change').change(function(){
			
			var dataattribute = $(this).attr('data-attribute');
			//console.log(dataattribute);
			var form = '#frm'+$(this).attr('data-value');
			console.log(form);
			$('#'+dataattribute).addClass('fileselected');			
			$(form).submit();
			/*$('#uploader_document').load(function(){
				var fileupload = $.ajax({
					  url: config.BASE_URL+'inquiries/getsavedocument',
					  dataType: "json",
					  success: function(msg){
						    var lix = '';
							var icon = config.BASE_URL+'images/icons/';					
							$(msg).each(function(index, element) {								
                                lix += '<li class="upload_document"><a target="_blank" href="'+config.BASE_URL+'upload_files/'+element.userid+'/'+element.documentname+'"><img src="'+icon+element.documentname.split('.').pop().toLowerCase()+'.png"></a><li>';
                            });
							$('#documentarea').html(lix);
							$('#documentarea li').each(function(index, element) {
                                if(!$(this).hasClass('upload_document'))
								{
									$(this).remove();
								}
                            });
						  }
					});	
			});*/
			
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
						  data: {'musanifIndex':musanifIndex},
						  dataType: "html",
						  success: function(msg){
							  
							  musanifIndex++;
							$("#details").append(msg);
							//$('#hatfi'+vox[1]).last().after(msg)
							
						  }
						});
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
						$("#details").show();
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
						$("#details").hide();
						$(".musanif").show();
					}
					//$("musanif_option").show();
				}
				function check_risk(val){
					if(val == 'نعم'){
						$("#type_value").show();
						$(".ssForm").addClass('req');
						$(".risk_class").hide();
						$("#technical").hide();
						$(".sForm").removeClass('req');
					}
					else{
						$(".sForm").addClass('req');
						$(".risk_class").show();
						$("#type_value").hide();
						//unmusanif
					//	$('#technical').hide();
						$(".unmusanif").hide();
						$("#musanif_options").hide();
						$(".ssForm").removeClass('req');
					
						$("#problem_notes").addClass('req');
						$("#technical").show();
						

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
					
					$("#is_complete").click(function(){
							
					});
					
					$('#save_data_form_step4').click(function(){
			
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