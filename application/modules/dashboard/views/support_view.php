<?php $this->load->view('common/meta');?>

<div class="body">
<div id="tasjeel"></div>
<?php $this->load->view('common/banner');?>
<div class="body_contant">
  <?php //$this->load->view('common/floatingmenu');?>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <form id="form2" name="form2" method="post" action="<?PHP echo base_url().'index.php/inquiries/insertSecondForm'//echo md5(date('Ymdhisf')); ?>" autocomplete="off">
      <input type="hidden" name="tempid" id="tempid" value="<?PHP echo $main->tempid; ?>" />
      <?php if($t=='review') { ?>
      <input type="hidden" name="review" id="review" value="1" />
      <?PHP } ?>
      <?PHP if($t=='review') { ?>
      <?PHP } ?>
      <div class="main_box">
        <div class="data_box_title">
          <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
          <div class="data_title">الدعم الفني</div>
        </div>
        <div class="data_raw">
          <div class="data">
            <div class="main_data">
            <div class="main_data"><div class="main_txt"> 
             <div class="form_raw">
            تمتع بالدعم الفني على مدار الساعة
            <p></p>
              <span class="blue_txt">شركة درر للحلول الذكية. </span>
            <p></p><span class="blue_txt">
           
العنــوان:
 
الغبرة
(أبراج الأصالة), البناية الثانية, الطابق الثاني, مكتب رقم 216
,سلطنـة عمـان
<br />
            مسقط ,الخوض <br />
            سلطنة عمــان 
            </span>
            <p></p>
              <div class="user_txt">
            البريد الإلكترونى :</div> <div class="user_field"><a href="mailto:info@durar-it.com" target="_blank">info@durar-it.com</a></div>
            <br /><br />
              <div class="user_txt">
             تليفون :
                     </div>  <div class="user_field">97890223 </div> 
                  </div>
              <div class="personal" id="personal2">
              <div class="main_data">
              <form id="validate_form" name="validate_form" method="post" action="<?PHP echo base_url().'index.php/admin/submitData'//echo md5(date('Ymdhisf')); ?>" autocomplete="off">
                  <div class="form_raw">
                  <div class="user_txt">الإسم بالكامل</div>
                <div class="user_field"><input name="name" id="name" type="text" class="req txt_field" placeholder='الإسم بالكامل' /></div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">البريد الإلكتروني</div>
                <div class="user_field"><input name="email" id="email" type="text" class="req txt_field" placeholder='البريد الإلكتروني' /></div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">عنوان الرسالة</div>
                <div class="user_field"><input name="title" id="title"  type="text" class="req txt_field" placeholder='عنوان الرسالة'/></div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الرسالة</div>
                <div class="user_field"><textarea name="message" id="message" cols="" rows="" class="req txt_area_l" placeholder=' الرسالة'></textarea></div>
                </div>
                <div class="main_withoutbg">
                  <div class="user_txt">&nbsp;</div>
                <div class="user_field"><div class="add_team_btn"><input id="save_data_form_ok" type="button" class="transperant_btn" value="إرسل" /></div></div>
                </div>
                </div>                  
                
                
            </div>
                        
            
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>

			$(document).ready(function(){
						$("#save_data_form_ok").click(function(){
							alert('sdasd');
						 name = $("#name").val();
						 email =  $("#email").val();
					   	title =  $("#title").val();
						message = $("#message").val();
							 if(name !="" && title !="" && email !="" && message !=""){
								//$("#validate_form").submit();
							 $.ajax({
							  url: '<?php echo base_url(); ?>admin/submitData',
							  type: "POST",
							  data:{name:name,email:email,title:title,message:message},
							  dataType: "html",
							  beforeSend: function(){},					  
							  success: function(msg){
										alert('aasd')  
								});
								 
								}	
							});
						
				});
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
