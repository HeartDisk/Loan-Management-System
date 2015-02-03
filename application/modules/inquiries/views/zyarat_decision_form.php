<?php $this->load->view('common/meta');?>

<div class="body">
<div id="tasjeel"></div>
<?php $this->load->view('common/banner');?>
    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>
<div class="body_contant">
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
    <form id="validate_form_data" name="validate_form_data" method="post" action="<?PHP echo base_url().'inquiries/add_zyarat' ?>" autocomplete="off">
      <input type="hidden" name="form_step" id="form_step" value="5" />      
      <input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $applicant_id;?>" />
      <div class="main_box">
      <div class="data_box_title">
        <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
        <div class="data_title">الطلبات الغير مكتملة </div>
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
			 <div id="details">  
              
                <div class="form_raw unmusanif" <?PHP if($sad->is_musanif=='مصنف') { ?> style="display:block;"<?PHP } else { ?>style="display:none;"<?PHP } ?>  >
               
                <input class="addpartnerphone" id="addnewmusanif" value="إضافة" type="button" style="float:left; cursor:pointer;" onclick="addMusanif()">
                <?php
/*					$financeData = json_decode($sad->financing);
					$loan_amount = json_decode($sad->loan_amount);
					$amount_paid = json_decode($sad->amount_paid);
					$residual = json_decode($sad->residual);
					$monthly_installment = json_decode($sad->monthly_installment);
					$project_difficulties = json_decode($sad->project_difficulties);
					$amount_problem = json_decode($sad->amount_problem);*/
					//amount_problem
					//project_difficulties
					// exit;
				?>
                
               </div>
				<div>
				<div class="form_raw musanif"  style="display:none;">
                  <div class="user_txt"> الطلبات الغير مكتملة  </div>
                  </div>
                </div>
				<!--<input type="button" onclick="addMuwafiq()" style="float:left; cursor:pointer;" value="إضافة" id="addnewmusanif" class="addpartnerphone">-->
                <div class="form_raw musanif" >
                <div id="TextBoxesGroup"></div>
                  <div class="user_txt"></div>
                  <div class="user_field">
                  		 مكتمل<input type="radio" <?PHP if(rQuote($complete_data)=='1') { ?> checked="checked"<?PHP } ?>  name="is_complete"  class="sForm" value="1" onclick="checkComplete(this.value)"/>
                     غيرمكتمل<input type="radio" <?PHP if(rQuote($complete_data)=='0') { ?> checked="checked"<?PHP } ?>  name="is_complete" class="sForm"  value="0"  onclick="checkComplete(this.value)"/>
                  </div>
                </div>
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
<?php   if(count($zyarat_data)>1) $total = count($zyarat_data); else $total =1;
$total_attachment = 0;
if(count($zyarat_data)>1)  $total_attachment = $total; else $total_attachment; 
//counter = 0;
  ?>
<script>
	zyarar_counter = '<?php echo $visit_counter; ?>';
			muwafiq_counter = '<?php echo $total; ?>' 
			counter = '<?php echo $total_attachment; ?>';
			 ind = '<?php echo $i; ?>'; 
			  function createElement(counter,val){
				//  var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
					 html_hiden= '<input type="hidden" name="attachment[]" id="attachment' + counter + '" value="' + val + '" >';
						$("#TextBoxesGroup").append(html_hiden);

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
				 
				 function removezyara(ind,id){
					 
					 $("#zyara_detail"+ind).remove();
					 if(id!=""){
							 var request = $.ajax({
							  url: config.BASE_URL+'inquiries/remove_zyara/',
							  type: "POST",
							  data:{'zyarat_id':id},
							  dataType: "html",
							  beforeSend: function() {		},
							  complete: function(){  },
							  success: function(msg){

								  }
							});
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
				
				function addMuwafiq(){
					
					
					h =  $(document).height() - 300;
					$("html, body").animate({ scrollTop:h}, 1000);
					ind++;
						var taurusData = $.ajax({
									  url: config.BASE_URL+'inquiries/getmuwafiq/',
									  type:"POST",
									  data:{'counter':muwafiq_counter,'zyara_counter':zyarar_counter,'ind':ind},									
									  success: function(msg){	
											muwafiq_counter++;
											$("#technical").append(msg);
	
									  }
									});
				
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
					$("#is_surf").click(function(){
					
						surf_status = $(this).is(':checked');
						if(surf_status){
							$(".surf").show();
						}
						else{
								$(".surf").hide();
						}	
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
              <script type="text/javascript">
			  
              $(document).ready(function(){
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
						createElement(counter,ff.filename);
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
				  
				  });
              </script>
              
<div id="dialog_loan_view" title="تقييم طلب القرض (لجنة سقف القروض)" style="display:none;">
  	<?PHP $this->load->view('request_loan_view',array('a'=>$evolution)); ?> 
</div>              
<?php $this->load->view('common/footer');?>
