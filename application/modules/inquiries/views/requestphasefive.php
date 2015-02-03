<?php $this->load->view('common/meta');?>

    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>
<div class="body">
<div id="tasjeel"></div>
<?php $this->load->view('common/banner');?>
<div class="body_contant">
<input type="hidden"  name="loan_limit" id="loan_limit"  value="<?php echo $loan_data->loan_end_amount ?>"/>
  <?php //$this->load->view('common/floatingmenu');
  
  
  	$applicant = $applicant_data['applicants'];
	$project = $applicant_data['applicant_project'][0];
	$loan = $applicant_data['applicant_loans'][0];
	$phones = $applicant_data['applicant_phones'];
	$comitte = $applicant_data['comitte_decision'][0];
	$evolution['applicants'] = $applicant; 
	$evolution['loan'] = $loan; 
	
	//echo "<pre>";
	//print_r($evolution);
	
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
                <div class="user_txt">استماارة تقييم المقابلات<a id="opendiag" href="#"><img src="<?php echo base_url(); ?>images/evolutionstatus.png" /></a></div>
                <div class="user_field">
                  <textarea style="width: 657px; height: 100px;" id="astamaarah_value"  class="txt_field req" name="astamaarah_value"  placeholder="استماارة تقييم المقابلات"><?PHP echo $comitte->astamaarah_value; ?></textarea>
                 
                </div>
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
              <div class="form_raw" id="is_query" <?PHP if($comitte->committee_decision_is_aproved!='queries' && $comitte->commitee_decision_type == 'approved') { ?>style="display:none;"<?PHP } ?>>
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;">
                  <input name="query_text" id="query_text" value="<?PHP echo $comitte->query_text; ?>"  placeholder="موافقة اولية" type="text" class="txt_field">
                </div>
              </div>
              <div class="form_raw" id="is_postponed" <?PHP if($comitte->commitee_decision_type!='postponed') { ?>style="display:none;"<?PHP } ?>>
                <div class="user_txt"></div>
                <div class="user_field" style="width: 460px;">  
                <div class="form_field_selected">       
                  <?PHP exdrobpx('postponed',$comitte->postponed,'سبب التأجيل ','postponed',''); ?>
                  </div>
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
                <div class="form_field_selected">
                  <?PHP 
				  
				  exdrobpx('rejected',$comitte->rejected,'سبب الرفض','rejected',''); 
				  
				   if($comitte->committee_decision_is_aproved == "approval"){ 
				   		$approve_status = 'block';
				   }else{
					   $approve_status = 'none';
				   } ?>
				  
                  </div>
                </div>
              </div>
              <div class="form_raw" id="is_aprovedamount"  style="display:<?php echo $approve_status; ?>;">
                <div class="user_txt">قيمة التمويل </div>
                <div class="user_field">
                  <input name="approv_text" id="approv_text" value="<?PHP echo $comitte->approv_text; ?>" placeholder="قيمة التمويل" type="text" class="txt_field" readonly="readonly">
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
				 
				 
				 function showamount(){
					 
					 	appId = $("#applicant_id").val();
						 $.ajax({

							  url: config.BASE_URL+'inquiries/getEvolutionAmount',

							  type: "POST",

							  data: { applicant_id : appId },

							  dataType: "html",

							  beforeSend: function(){	$('.ui-dialog-buttonpane').slideUp('slow');	},

							  success: function(msg)

							  {
								 
								  //$('#dialog-confirm-sms').dialog( 'close' );
									  $("#approv_text").val(msg);

							  }

							}); 	 
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
						
						
								showamount();
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
              
<div id="dialog_loan_view" title="تقييم طلب القرض (لجنة سقف القروض)" style="display:none;">
  	<?PHP $this->load->view('request_loan_view',array('a'=>$evolution,'b'=>$loan_data)); ?> 
</div>              
<?php $this->load->view('common/footer');?>
