<?php $this->load->view('common/meta');?>

<div class="body">
<div id="tasjeel"></div>
<?php $this->load->view('common/banner');?>
<div class="body_contant">
  <?php //$this->load->view('common/floatingmenu');?>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <form id="form_update_requestchangephasefive" name="form2" method="post" action="<?PHP echo base_url().'index.php/inquiries/insertSecondForm'//echo md5(date('Ymdhisf')); ?>" autocomplete="off">
      <input type="hidden" name="tempid" id="tempid" value="<?PHP echo $main->tempid; ?>" />
      <?php if($t=='review') { ?>
      <input type="hidden" name="review" id="review" value="1" />
      <?PHP } ?>
      <?PHP if($t=='review') { ?>
      <?PHP } ?>
      <div class="main_box">
      
      <?php
	  //echo "<pre>";
	  //print_r($get_result);
	  //echo "</pre>";
	  $main = $get_result;	 
	   ?>
      
        <div class="data_box_title"> 
          <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
          <div class="data_title">قرار اللجنة</div>
        </div>
        <div class="data_raw">
          <div class="data">
            <div class="main_data">
              <div class="personal" id="personal2">
              <div class="form_raw">
                <div class="user_txt"> نموذج قرار اللجنة </div>
                <div class="user_field">
                  <div class="form_field_selected">
                    <input name="comission_decision" id="comission_decision" value="<?PHP echo $main->comission_decision; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="نموذج قرار اللجنة" type="text" class="txt_field req">
                  </div>
                </div>
              </div>
                <div class="form_raw">
                  <div class="user_txt">استمارة تقييم المقابلات </div>
                  <div class="user_field">
                    <?php /*?><input name="astamaarah_value" id="astamaarah_value" value="<?PHP echo $main->astamaarah_value; ?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="استمارة تقييم المقابلات" type="text" class="txt_field req"><?php */?>
                    
                     ‫<textarea name="astamaarah_value" id="astamaarah_value" class="txt_field req"><?PHP echo $main->astamaarah_value; ?></textarea>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">قرار اللجنة</div>
                  <div class="user_field" style="width: 460px;">
                    ‫موافق<input <?php  if($main->committee_decision_is_aproved!='queries') {?> checked="checked" <?php } ?>  type="radio"  name="commitee_decision_type" id="commitee_decision" value="approved" onchange="check_comitee(this.value)"  class="req" placeholder='قرار اللجنة' />
				  </div>
                </div>
                <div class="form_raw" id="is_aproved">
                  <div class="user_txt"></div>
                  <div class="user_field" style="width: 460px;">
                    ‫مشروطة<input <?php  if($main->committee_decision_is_aproved=='queries') {?> checked="checked" <?php } ?> type="radio"  name="committee_decision_is_aproved" id="conditional_notes" value="queries"  class="req" onchange="check_quez(this.value)" placeholder='الموافق' />
                    </div>
                    
                </div>
                <div class="form_raw" id="is_aproveds">
                  <div class="user_txt">ملاحظات مشروطة</div>
                  <div class="user_field" style="width: 460px;">
                  <?php  if($main->committee_decision_is_aproved=='queries') {
				  	$query_text = $main->query_text;
				  }else{
				  $query_text = '';
				  }
					  ?>
             	     <input name="query_text" id="conditional_notes" value="<?php echo $query_text;?>" data-handler="<?PHP echo $main->tempid; ?>_<?PHP echo $main->tempid; ?>" placeholder="ملاحظات مشروطة" type="text" class="txt_field req">
                    ‫<!--<textarea name="conditional_notes" id="conditional_notes" class="txt_field"></textarea>-->
                    </div>
                    <input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $main->applicant_id;?>" />
                </div>
                
            </div>
            
            <br />
            <input type="button"  id="save_data" value="تحرير" class="addnewdata" style="float:right;margin-right:170px;padding:4px 28px" onclick="submit_form();"/>
            
            
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>


			function submit_form()
			{
				
				var str	=	$("#form_update_requestchangephasefive").serialize();
				
				var request = $.ajax({
					url: config.BASE_URL+'inquiries/udpate_request_change_phase_five',
					type: "POST",
					data: str,
					dataType: "json",
					success: function(msg){
						window.location.href	=	config.CURRENT_URL;
					}
				});
			}
		  
			  function check_comitee(val){
				  //	alert(val);
				  	if(val == 'approved'){
						$("#is_aprovedamount").hide();
						$("#is_aproved").show();	
						$("#is_forward").hide();
						$("#is_postponed").hide();
						$("#is_rejected").hide();
					}
					else if(val =='postponed'){
							$("#is_postponed").show();
							$("#is_aprovedamount").hide();
							$("#is_aproved").hide();
							$("#is_forward").hide();
							$("#is_rejected").hide();
						}
					else if(val =='convesion'){
							$("#is_forward").show();
							$("#is_postponed").hide();
							$("#is_aprovedamount").hide();
							$("#is_aproved").hide();
							$("#is_rejected").hide();
						}	
					else{
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
						}
						else{
							
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
				  
				
				  
				$('#commitee_decision').click(function() {
				   if($('#commitee_decision').is(':checked')) { 
				   		$( "#conditional_notes" ).prop( "checked", false );
						$('#is_aproveds').hide();
				   }
				});

				$('#conditional_notes').click(function() {
				   if($('#conditional_notes').is(':checked')) { 
				   		$( "#commitee_decision" ).prop( "checked", false );
						$('#is_aproveds').show();
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
