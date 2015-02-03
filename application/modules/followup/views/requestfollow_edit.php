<?php $this->load->view('common/meta');?>
	<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('ckeditor');
		new nicEditor().panelInstance('ckeditor2');		
  });
</script>
						

<script type="text/javascript">
function change_val(obj){
//alert('vv');
				id_supporing = $(obj).attr('id');
				t_val = $(obj).val();
				//alert(t_val);
				//alert(id_supporing);
				if(t_val == '1'){
					$("."+id_supporing).show();
				}
				else{
					$("."+id_supporing).hide();
				}


}

function change_others(obbj){

				id_othres = $(obbj).attr('id');
				t_val = $(obbj).val();
			//	alert(t_val);
				//alert(id_othres);
				if(t_val == 'others'){
					$("#others"+id_othres).show();
				}
				else{
					$("#others"+id_othres).hide();
				}
}
$(document).ready(function(e) {
	
		calculateAge();
		$(".supporting_classs").change(function(){
			//	alert('cc');
				id_supporing = $(this).attr('id');
				t_val = $(this).val();
				//alert(t_val);
				//alert(id_supporing);
				if(t_val == '1'){
					$("."+id_supporing).show();
				}
				else{
					$("."+id_supporing).hide();
				}
				//alert(id_supporing);
				
				//$('#' + id_supporing).is(":checked")		
		});
		
		$(".others").change(function(){
				id_othres = $(this).attr('id');
				t_val = $(this).val();
				//alert(t_val);
				if(t_val == 'others'){
					$("#others"+id_othres).show();
				}
				else{
					$("#others"+id_othres).hide();
				}
				//alert(id_supporing);
				
				//$('#' + id_supporing).is(":checked")		
		});
		
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
	
	$("#manpower_project").keyup(function(){
		mn_power = $(this).val();
		$("#total_income").val(mn_power);
		
		
		ttex = $("#total_expence").val();
		if(ttex !="")
		$("#tt").html(ttex);
		ttic = $("#total_income").val();
		if(ttic!= "")
		$("#tt2").html(ttic);
		
		
		ttv = ttex-ttic;
		//alert(ttv);
		$("#tt3").html(ttv);
		$("#tt4").html(ttv);
		
	});
	$("#tt5").keyup(function(){
		
		
		tt5 = $(this).val();
		ttfinal = ttv-tt5;
		///alert(tt5);
		$("#tt6").html(ttfinal);
	});

	total_expence =0;
		$(".expence").keyup(function(){
		total_expence=0;
		$(".expence").each(function( i, l ){
					if($(".expence").eq(i).val() !=""){
					//alert(parseInt(total_expence));

						val = $(".expence").eq(i).val();
						total_expence = parseInt(total_expence)+parseInt(val);	
						//alert(parseInt(total_expence));
						
						console.log(parseInt(total_expence));

					}
		
		});
			$("#total_expence").val(total_expence);		

	});
		$(".ratings").keyup(function(){
		//alert('keyy');
			total_charges =0;			
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

							//alert(t_rating);
							percentage = 30;
							taqeem = total_charges/percentage;
							//alert(taqeem);
						$("#taqem_html").html(taqeem);
				});		
	
			mn_power = $("#total_income").val();
			$("#total_income").val(mn_power);
			ttex = $("#total_expence").val();
			if(ttex !="")
			$("#tt").html(ttex);
			ttic = $("#total_income").val();
			if(ttic!= "")
			$("#tt2").html(ttic);
			ttv = ttex-ttic;
			//alert(ttv);
			$("#tt3").html(ttv);
			$("#tt4").html(ttv);

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

function check_status(statusObj){
	check_status_val = $(statusObj).is(':checked');
	//alert(check_status_val);
	id = $(statusObj).attr('id');
	if(check_status_val){
		$("."+id).show();
					if(id == 'parwa_open'){
					
						c_activity = $('.activty_type').val();
						//alert(c_activity);
						if(c_activity == 'يواجه صعوبات'){
						$(".difficulties_details").show();
					}
			}
			else{
				is_class = $(".p_status").is(':checked');
				if(is_class)
				$('.reason').show();
			}
	}
	else{
			$("."+id).hide();
			//alert(id);
			if(id == 'parwa_open'){
				$(".difficulties_details").hide();
			}
			else{
				$('.reason').hide();
			}
			
	}

	
}

function check_status2(statusObj){
		
		c_p = $("#close_project").is(':checked');
		if(statusObj){
		
		//is_class = $(".p_status").is(':checked');
		//alert(c_p)
		if(c_p){
			$('.reason').show();
		}
		else{
		$('.reason').hide();
		}
	}
	else{
		$('.reason').hide();
	}
	
}
function check_activity(activityObj){
		c_activity = $(activityObj).val();
		//alert(c_activity);
		if(c_activity == 'يواجه صعوبات'){
		$(".difficulties_details").show();
	}
	else{
			$(".difficulties_details").hide();
	}
		
}

function check_close_project(proObj){
		c_proObj = $(proObj).val();
		//alert(c_activity);
		if(c_proObj == 'نهائي'){
		$(".reason").show();
	}
	else{
			$(".reason").hide();
	}
		
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
h3{
margin-right: 9px !important;

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
<style>
.td_text_data {
	font-size: 12px !important;
}
.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button {
	font-size: 12px !important;
}
.gridtable
{
font-size:12px !important;
}
</style>

<div id="set-dialog-message-2" class="show-content" title="المتابعات السابقة" style="display:none;"> </div>
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


	 .uft{ width: 140px !important;

font-size: 13px;

font-weight: bold;

padding-top: 3px;

padding-right: 6px;} 
.border {
  border-bottom:1pt solid black !important;
}
.user_txt{
width:112px !important;

}
.user_field{
padding-left:20px !important;
}
  </style>

  <?PHP parentMenu(); ?>

  
  <div class="main_contant">




    <form id="validate_form" name="validate_form" method="post" action="<?PHP echo base_url().'followup/update_follow_up' ?>" autocomplete="off">

      <input type="hidden" name="form_step" id="form_step" value="5" />      

      <input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $id;?>" />

      <div class="main_box">

      <div class="data_box_title">
        <div class="data_title">استمارة متابعة و مساندة المشاريع</div>
		<a  href="<?php echo base_url(); ?>followup/requestfollowup/<?php echo $id; ?>" class="addnewdata needtip" original-title="">اضافه</a>
      </div>
<div class="data_raw">

        <div class="data">
			
          <div class="main_data">
		  




          
		   
		  
            <?php
			//	$financial = $info;
			
			?>
            <div class="form_raw">
            <h3 style="float: right;">الاستمار والمردود المالي</h3>
            </div>
			<?php
					foreach($financial as  $i=>$finance){
						?>
			<input type="hidden" id="returns_id" name="returns_id" value="<?php echo $finance->returns_id; ?>">			
            <div id="first">
                    <div class="form_raw fcounter<?php echo $i; ?>">
                        <div class="user_txt txt_f">قيمة المشروع الحالية:</div>
                        <div class="user_field"><input type="text" class="NumberInput" id="present_value_project" name="present_value_project" value="<?php echo $finance->present_value_project; ?>"></div></div>
                    </div>
                    <div class="form_raw fcounter<?php echo $i; ?>">
                        <div class="user_txt txt_f">متوسط الايرادات الشهرية:</div>
                        <div class="user_field "><input type="text" class="NumberInput" id="average_monthly_revenue" name="average_monthly_revenue" value="<?php echo $finance->average_monthly_revenue; ?>"><div  style="float: left; margin-right: 7px;">رع</div></div>
                        <div class="user_txt txt_f">السنوية الايرادات متوسط:</div>
                        <div class="user_field"><input type="text" name="average_anual_revenue" id="average_anual_revenue" value="<?php echo $finance->average_anual_revenue; ?>" class="NumberInput"/><div  style="float: left; margin-right: 7px;">رع</div></div>  
</div>              </div>
						  <div class="form_raw fcounter<?php echo $i; ?>">
                        <div class="user_txt txt_f"> الشهري الريح صافي متوسط:</div>
                        <div class="user_field "><input type="text" name="net_average_monthly_revenue" id="net_average_monthly_revenue" value="<?php echo $finance->net_average_monthly_revenue; ?>" class="NumberInput"/><div  style="float: left; margin-right: 7px;">رع</div></div>
                        <div class="user_txt txt_f"> السنوي الريح صافي متوسط:</div>
                        <div class="user_field"><input type="text" name="net_average_anual_revenue" id="net_average_anual_revenue" value="<?php echo $finance->net_average_anual_revenue; ?>" class="NumberInput"/><div  style="float: left; margin-right: 7px;">رع</div></div>
                    </div>
					<div class="form_raw fcounter<?php echo $i; ?>">
						<div class="user_field">تاريخ:<?php echo $finance->created;  ?></div>
					</div>
                     <div class="form_raw yes_class_others">
                <div class="user_field">وأضاف المستعمل من قبل:<?php echo $finance->user_name;  ?></div> 
              </div>
              
					<?php
					}
				
			?>
			
                  
            </div>
            
            <div class="form_raw">
            
             <h3 style="float: right;">أوجه الدعم المقدمة من الجهات الاخرى</h3>
             </div>
			 <?php
			 	
					foreach($support as $i=>$sup){
					?>
                    <input type="hidden" id="support_id" name="support_id" value="<?php echo $sup->returns_id; ?>">
					<div id="second">
             <div class="form_raw">
            	<div class="user_txt txt_f"> الدعم التدريبي:</div>
				<?php
					$checked1 = "";
					$checked2 = "";
					if($sup->support_training == '1'){
						$checked1 ="checked";
						$display = "block";
					}
					else{
							$checked2 ="checked";
							$display = "none";
					}
				?>
                <div class="user_field">نعم <input type="radio" name="support_training" id="support_training<?php echo $i; ?>" value="1" <?php echo $checked1;  ?>  class="supporting_classs"/></div>
                <div class="user_field">لا <input type="radio" name="support_training" id="support_training<?php echo $i; ?>" value="0" <?php echo $checked2;  ?> class="supporting_classs"/></div>
            </div>
            <div class="form_raw yes_class_support support_training<?php echo $i; ?>"  style="display:<?php echo $display; ?>;">
            	<div class="user_txt txt_f"> مجال التدريب لصاحب المنشأة </div>
                <div class="user_field"><input  type="text"  name="training_owner_facility" id="training_owner_facility"  value="<?php echo $sup->training_owner_facility;  ?>"/></div>
                <div class="user_txt txt_f">  جهة التدريب  </div>
                <div class="user_field"><input  type="text"  name="training" id="training"  value="<?php echo $sup->training;  ?>"/></div>
            </div>
            <div class="form_raw yes_class_support">
            	<div class="user_txt txt_f" style="width:46px !important; "> المدة </div>
                <div class="user_field"><input id="duration" name="duration" value="<?php echo $sup->duration; ?>" /><select id="durationtype" name="durationtype">
					<?php 
						if($sup->duration == 'يوم'){
							?>
							<option value="يوم" select="select">يوم</option>
							<?php
						}
						elseif($sup->duration == 'شهر'){
						?>
						<option value="شهر" select="select">شهر</option>
						<?php
						}
						else{
						?>
							<option value="يوم">يوم</option>
						<option value="شهر">شهر</option>
						
						<?PHP
						}
					?></select></div>
                    
                 <?php
				 if($sup->before_incoporation == '1'){
					 $checked1 = "checked";
				 }
				 else{
					  $checked2 = "checked";
				 }
				 ?>   
				<div class="user_txt txt_f" style="padding-right: 15px;">   قبل التأسيس:  </div>
                <div class="user_field ">نعم <input type="radio" name="before_incoporation" id="before_incoporation1" value="1" class="supporting_classs" <?php echo $checked1; ?>/></div>
                <div class="user_field">لا <input type="radio" name="before_incoporation" id="before_incoporation" value="0" class="supporting_classs"  <?php echo $checked2; ?>/></div>

                <div class="user_field "></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">   بعد التأسيس:  </div>
                <div class="user_field uft" style="width:56px !important"><input  type="text"  name="after_incoporation" class="NumberInput" id="after_incoporation" style="width:99px !important" value="<?php echo $sup->after_incoporation;  ?>"/></div>

            </div>
            <div class="form_raw">
            	<div class="user_txt txt_f"> الدعم التمويلي:</div>
				<?php
					$fchecked1 = "";
					$fchecked2 = "";
					
					if($sup->funding_support == '1'){
						$fchecked1 ="checked";
						$display = "block";
					}
					else{
							$fchecked2 ="checked";
							$display = "none";
					}
					
				?>
                <div class="user_field ">نعم <input type="radio" name="funding_support" id="funding_support<?php echo $i; ?>" value="1" class="supporting_classs" <?php echo $fchecked1; ?>/></div>
                <div class="user_field">لا <input type="radio" name="funding_support" id="funding_support<?php echo $i; ?>" value="0" class="supporting_classs" <?php echo $fchecked2; ?>/></div>
            </div>
            <div class="form_raw yes_class_funds funding_support<?php echo $i; ?>" style="display:<?php echo $display; ?>;">
            	<div class="user_txt txt_f"> مبلغ الدعم  </div>
                <div class="user_field"><input  type="text"  name="amount_support" id="amount_support" class="NumberInput" value="<?php echo $sup->amount_support;  ?>"/><div  style="float: left; margin-right: 7px;"> &nbsp;رع</div></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">   جهة الدعم:  </div>
                <div class="user_field"><input  type="text"  name="support_point" id="support_point" class="NumberInput" value="<?php echo $sup->support_point;  ?>"/></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">    نوع الدعم:  </div>
                <!--<div class="user_field uft" style="width:29px !important"><input  type="text"  name="loan[]" id="loan" style="width:145px !important" value="<?php echo $sup->loan;  ?>"/></div> -->
				<div class="user_field uft" style="width:29px !important">
                <select name="support_type" id="<?php echo $i; ?>" class="others">
				<?php
				if($sup->support_type == 'قرض'){
							?>
							<option value="قرض" select="select">قرض </option>
							<?php
						}
			    elseif($sup->support_type == 'منحة'){
						?>
						<option value="منحة" select="select">منحة </option>
						<?php
						}
						elseif($sup->support_type == 'others'){
						?>
						<option value="others" select="select">اخرى يتم ذكرها </option>
						<?php
						}
						else{
						?>
							<option value="قرض">قرض </option><option value="منحة">منحة </option><option value="others">اخرى يتم ذكرها </option>
						<?PHP
						}
						?>
				</select>
                </div>
            </div>
			<div class="form_raw yes_class_funds">
			<!--	   <div class="user_txt txt_f" style="padding-right: 15px;">    منحة:  </div>
					<div class="user_field uft"><input  type="text"  name="donation[]" id="donation" value="<?php echo $sup->donation;  ?>"/></div>
   -->
			</div>
			<?php
				if($sup->support_type == 'others'){
						$dislpay= "block";
				}
				else{
					$dislpay= "none";
				}
			?>
            <div class="form_raw yes_class_funds" id="others<?php echo $i; ?>" style="display:<?php echo $dislpay; ?>;">
            <div class="user_txt txt_f"> أخرى (يتم ذكرها)  </div>
                <div class="user_field"><input  type="text"  name="mention_others" id="mention_others" value="<?php echo $sup->mention_others;  ?>"/></div> 
            </div>
            <div class="form_raw yes_class_funds">
			<?php
					$fcchecked1 = "";
					$fcchecked2 = "";
					if($sup->funding_support == '1'){
						$fcchecked1 ="checked";
						$display= "block";
					}
					else{
							$fcchecked2 ="checked";
							$display= "none";
					}
				?>
            	<div class="user_txt txt_f"> أوجه دعم اخرى </div>
                <div class="user_field">نعم<input type="radio"  name="face_others_support" id="face_others_support<?php echo $i; ?>" value="1" <?php  echo $fcchecked1;?>  class="supporting_classs"/></div> 
                <div class="user_field">لا<input type="radio"  name="face_others_support" id="face_others_support<?php echo $i; ?>" value="0" <?php  echo $fcchecked2;?> class="supporting_classs"/></div> 
            </div>
             <div class="form_raw yes_class_others face_others_support<?php echo $i; ?>" style="display:<?php echo $display; ?>;">
                <div class="user_field">اذكرها<input  type="text"  name="face_others_support_text" id="face_others_support_text"  value="<?php echo $sup->face_others_support_text;  ?>"/></div> 
              </div>
			  <div class="form_raw yes_class_others">
                <div class="user_field">تاريخ:<?php echo $sup->created;  ?></div> 
              </div>
               <div class="form_raw yes_class_others">
                <div class="user_field">وأضاف المستعمل من قبل:<?php echo $sup->user_name;  ?></div> 
              </div>
              
          </div>
					
					<?php
					}
					?>
					    
					<?php
				
			
			 if(!empty($annoted1) || !empty($annoted2)){
			 ?>
			
			<h3>المشروع</h3>
            <?php
			 }
			?>
             		 <?php
					foreach($annoted1  as $anot){
						//echo "<pre>";
				
						//print_r($anot);
						
						if($anot->anoted_type == '1'){
						
							$p_status = "checked";
							$display = 'block';
						}
						else{
							$p_status = "";
							$dislpay = 'none';

						}
						
						?>
                          <input type="hidden" id="anot_id1" name="anot_id1" value="<?php echo $anot->anoted_id; ?>">
                        <div class="form_raw">		
                        <div class="user_txt txt_f">مفتوح:</div>
                            <div class="user_field "><input type="checkbox" name="parwa_open" id="parwa_open" value="1" onclick = "check_status(this)"  <?php echo $p_status; ?>/></div>
                        </div>
                        <div class="form_raw parwa_open" style="display:<?php echo $display; ?>">
                        <?php
							$active1 = "";
							$active2 = "";
							$active3 = "";
							$active4 = "";
							//$anot->activty_type;
							if($anot->anoted_value =='نشاط متميز جدا'){
								$active1 = "checked";
								$display ="none";
							}
							elseif($anot->anoted_value =='نشاط  متميز'){
								$active2 = "checked";
								$display ="none";
							}
							elseif($anot->anoted_value =='نشاط عادي'){
								$active3 = "checked";
								$display ="none";
							}
							elseif($anot->anoted_value =='يواجه صعوبات'){
								$active4 = "checked";
								$display ="block";
							}
							
						
						?>
                    <div class="user_field ">نشاط متميز جدا<input type="radio" class="activty_type" name="activty_type" id="activty_type1" value="نشاط متميز جدا" <?php echo $active1; ?>  onclick="check_activity(this)" /></div>
                    <div class="user_field ">نشاط  متميز<input type="radio" class="activty_type" name="activty_type" id="activty_type2" value="نشاط  متميز" <?php echo $active2; ?> onclick="check_activity(this)"/></div>
                    <div class="user_field ">نشاط عادي<input type="radio" class="activty_type" name="activty_type" id="activty_type3" value="نشاط عادي" <?php echo $active3; ?> onclick="check_activity(this)"/></div>
                    <div class="user_field ">يواجه صعوبات<input type="radio" class="activty_type" name="activty_type" id="activty_type4" value="يواجه صعوبات" <?php echo $active4; ?> onclick="check_activity(this)"/></div>
					</div>
                    <div class="form_raw difficulties_details" style="display:<?php echo $display; ?>;">
				اذكرالصعوبات	
			<textarea id="difficulties" name="difficulties" style="width: 100%; height:100px;"><?php echo $anot->anoted_details; ?></textarea>
			</div>
                        <?php
						
					}
			?>

			

		
        <div class="user_txt txt_f"> مغلق :</div>
         	
            
            <?php
			 //	print_r($annoted2);
					foreach($annoted2  as $anot){
						
						if($anot->anoted_type == '2'){
						
							$p_status = "checked";
							$display = 'block';
						}
						else{
							$p_status = "";
							$display = 'none';

						}
						
						$p_status1 = '';
						$p_status2 = '';
						if($anot->anoted_value == 'نهائي'){
						
							$p_status1 = "checked";
							$display1 = 'block';
						}
						else{
							$p_status2 = "checked";
							$dislpay1 = 'none';

						}
						
						
						?>
                        <input type="hidden" id="anot_id2" name="anot_id2" value="<?php echo $anot->anoted_id; ?>">
                      <div class="user_field "><input type="checkbox" name="close_project" id="close_project" value="2" <?php echo $p_status ;?>/></div>
                        <div class="form_raw close_project" style="display:<?php echo $display; ?>;">
                <div class="user_field ">نهائي <input type="radio" name="project_status" id="project_status" class="p_status" value="نهائي" <?php echo $p_status1; ?> onclick = "check_status2(this)" /></div>
				<div class="user_field ">ظرفي <input type="radio" name="project_status" id="project_status2" class="p_status" value="ظرفي" <?php echo $p_status2; ?> /></div>	
           		</div>
           		<div class="form_raw reason" style='display:block;'>
				الأسباب (ان وجدت) 
					<textarea id="reason_text" name="reason_text" style="width: 100%; height:100px;"><?php echo $anot->anoted_details;  ?></textarea>
				</div>
                 			
			</div>
                        <?php
						
					}
		
			//$p = $prop['0'];
			
				//print_r($proposalDetails);
			$prop = $proposalDetails['0'];
			if($prop->project_type == 'proposal'){
			?>					
			
		 <h3>مقترحات صاحب المشروع لتخطي الصعوبات او تطوير الموسسة:</h3>
		
        <div class="form_raw">
        <input type="hidden" id="project_detail_id" name="project_detail_id" value="<?php echo $prop->project_detail_id; ?>">		
			<textarea id="ckeditor" name="project_propsel" style="width: 100%; height: 300px;"><?php echo $prop->project_details; ?></textarea>
		</div>
              <?php
			}
			//$evaluate_data = $info;
					
			if(!empty($evaluate_data)){
	
		?>
		<h3>بطاقة تقييم مشروع</h3>
		  <?php
		  
					//print_r($evaluate_data);
		  ?>
		  <div class="form_raw">
			<?php
						$evaluate_all = $evaluate_data;
						foreach($evaluate_all as $evaluate){
					//		print_r($evaluate);
							?>
                       <input type="hidden" id="evaluate_id" name="evaluate_id" value="<?php echo $evaluate->evaluate_id; ?>">     
					<table border="1" align="center" style="text-align:center;">
              <tr>
                        <td colspan='4'>عناصر التقييم</td>
                        <td>العدد ( 0-5)</td>
                        <td>ملاحظات</td>
                      </tr>
              <tr>
                        <td colspan='4'>موقع المشروع</td>
                        <td><input type="text" name="evaluate_project_card"  id="evaluate_project_card" value=" <?php echo  $evaluate->evaluate_project_card ?>"/></td>
                        <td><textarea name="project_card_text"><?php  echo $evaluate->project_card_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>اللوحات واللافتات التوجيهية الدالة على مقر المشروع</td>
                        <td><input type="text" name="evaluate_paint_signs"  id="evaluate_paint_signs" value="<?php  echo $evaluate->evaluate_paint_signs;  ?>"/></td>
                        <td><textarea name="paint_signs_text"><?php  echo $evaluate->paint_signs_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>واجهة مقر المشروع</td>
                        <td><input type="text" name="evaluate_interface_headquarter"  id="evaluate_interface_headquarter" value="<?php  echo $evaluate->evaluate_interface_headquarter;  ?>"/></td>
                        <td><textarea name="interface_headquarter_text"><?php  echo $evaluate->interface_headquarter_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>ملائمة المحل مع نشاط المشروع</td>
                        <td><input type="text" name="evaluate_convence_project"  id="evaluate_convence_project" value="<?php  echo $evaluate->evaluate_convence_project;  ?>"/></td>
                        <td><textarea name="convence_project_text"><?php  echo $evaluate->convence_project_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>نظافة المحل</td>
                        <td><input type="text" name="evaluate_shop_cleanliness"  id="evaluate_shop_cleanliness" value="<?php  echo $evaluate->evaluate_shop_cleanliness;  ?>"/></td>
                        <td><textarea name="shop_cleanliness_text"><?php  echo $evaluate->shop_cleanliness_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>تنظيم المحل وتنظيم  الأجنحة والوحدات والبضائع داخله</td>
                        <td><input type="text" name="evaluate_organize_shop"  id="evaluate_organize_shop" value="<?php  echo $evaluate->evaluate_organize_shop;  ?>"/></td>
                        <td><?php echo $evaluate->organize_shop_text;  ?></td>
                      </tr>
              <tr>
                        <td colspan='4'>طريقة تخزين المنتجات والبضائع وتوفرها </td>
                        <td><input type="text" name="evaluate_storage_products"  id="evaluate_storage_products" value="<?php  echo $evaluate->evaluate_storage_products;  ?>"/></td>
                        <td><?php  echo $evaluate->storage_products_text;  ?></td>
                      </tr>
              <tr>
                        <td colspan='4'>طريقة العرض والبيع/ مراحل ومسالك الإنتاج/ طريقة تقديم الخدمات</td>
                        <td><input type="text" name="evaluate_sales_stages"  id="evaluate_sales_stages" value="<?php  echo $evaluate->evaluate_sales_stages;  ?>"/></td>
                        <td><textarea name="sales_stages_text"><?php  echo $evaluate->sales_stages_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>وسائل الدعاية المعتمدة</td>
                        <td><input type="text" name="evaluate_advertise_method"  id="evaluate_advertise_method" value="<?php  echo $evaluate->evaluate_advertise_method;  ?>"/></td>
                        <td><textarea name="advertise_method_text"><?php  echo $evaluate->advertise_method_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>استقبال الزبائن والتعامل معهم</td>
                        <td><input type="text" name="evaluate_receive_deal"  id="evaluate_receive_deal" value="<?php  echo $evaluate->evaluate_receive_deal;  ?>"/></td>
                        <td><textarea name="receive_deal_text"><?php  echo $evaluate->receive_deal_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>جودة الخدمة/ المنتج/ البضائع وتنوعها</td>
                        <td><input type="text" name="evaluate_quality_service"  id="evaluate_quality_service" value="<?php  echo $evaluate->evaluate_quality_service;  ?>"/></td>
                        <td><textarea name="quality_service_text"><?php  echo $evaluate->quality_service_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>الأسعار المعتمدة</td>
                        <td><input type="text" name="evaluate_support_price"  id="evaluate_support_price" value="<?php  echo $evaluate->evaluate_support_price;  ?>"/></td>
                        <td><?php echo $evaluate->support_price_text;  ?></td>
                      </tr>
              <tr>
                        <td colspan='4'>طريقة الترويج والتسويق</td>
                        <td><input type="text" name="evaluate_method_promotion"  id="evaluate_method_promotion" value="<?php  echo $evaluate->evaluate_method_promotion;  ?>"/></td>
                        <td><textarea name="method_promotion_text"><?php  echo $evaluate->method_promotion_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>طريقة البيع (نقدا أو بالأجل)</td>
                        <td><input type="text" name="evaluate_method_sale"  id="evaluate_method_sale" value="<?php  echo $evaluate->evaluate_method_sale;  ?>"/></td>
                        <td><textarea name="method_sale"><?php  echo $evaluate->method_sale;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>كيفية مجابهة المنافسة</td>
                        <td><input type="text" name="evaluate_cope_competition"  id="evaluate_cope_competition" value="<?php  echo $evaluate->evaluate_cope_competition;  ?>"/></td>
                        <td><textarea name="cope_competition_text"><?php  echo $evaluate->cope_competition_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>نوعية المعدات والتجهيزات</td>
                        <td><input type="text" name="evaluate_quality_equipment"  id="evaluate_quality_equipment" value="<?php  echo $evaluate->evaluate_quality_equipment;  ?>"/></td>
                        <td><textarea name="quality_equipment_text"><?php  echo $evaluate->quality_equipment_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>المظهر العام لصاحب المشروع والعاملين معه</td>
                        <td><input type="text" name="evaluate_appearance"  id="evaluate_appearance" value="<?php  echo $evaluate->evaluate_appearance;  ?>"/></td>
                        <td><textarea name="appearance_text"><?php  echo $evaluate->appearance_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>احترام توقيت العمل</td>
                        <td><input type="text" name="evaluate_time"  id="evaluate_time" value="<?php  echo $evaluate->evaluate_time;  ?>"/></td>
                        <td><textarea name="time_text"><?php  echo $evaluate->time_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>طريقة تسيير للمشروع</td>
                        <td><input type="text" name="evaluate_conduct_product"  id="evaluate_conduct_product" value="<?php  echo $evaluate->evaluate_conduct_product;  ?>"/></td>
                        <td><textarea name="conduct_product_text"><?php echo $evaluate->conduct_product_text; ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>مسك الدفاتر المالية</td>
                        <td><input type="text" name="evaluate_keep_financial"  id="evaluate_keep_financial" value="<?php  echo $evaluate->evaluate_keep_financial;  ?>"/></td>
                        <td><textarea name="keep_financial_text"><?php echo $evaluate->keep_financial_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>تمكن صاحب المشروع من نشاط مشروعه ومختلف مكوناته</td>
                        <td><input type="text" name="evaluate_enables_project_activity"  id="evaluate_enables_project_activity" value="<?php  echo $evaluate->evaluate_enables_project_activity;  ?>"/></td>
                        <td><textarea name="project_activity_text"><?php  echo $evaluate->project_activity_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>التعامل مع المزودين (نقدا أو بالأجل) وانتظام التزويد</td>
                        <td><input type="text" name="evaluate_supplier_cash_regularity"  id="evaluate_supplier_cash_regularity" value="<?php  echo $evaluate->evaluate_supplier_cash_regularity;  ?>"/></td>
                        <td><textarea name="supplier_cash_regularity_text"><?php echo $evaluate->supplier_cash_regularity_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>معرفة السوق والحصة من السوق والوحدات المماثلة في نفس النشاط</td>
                        <td><input type="text" name="evaluate_knowledge_market"  id="evaluate_knowledge_market" value="<?php  echo $evaluate->evaluate_knowledge_market;  ?>"/></td>
                        <td><textarea name="knowledge_market_text"><?php echo $evaluate->knowledge_market_text; ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>العلاقة بالمحيط والجهات التي يتعامل معها المشروع (العمومية والخاصة)</td>
                        <td><input type="text" name="evaluate_ocean_realtionship"  id="evaluate_ocean_realtionship" value="<?php  echo $evaluate->evaluate_ocean_realtionship;  ?>"/></td>
                        <td><textarea name="ocean_realtionship_text"><?php  echo $evaluate->ocean_realtionship_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>تنمية شبكة علاقات وتحديثها</td>
                        <td><input type="text" name="evaluate_network_upload"  id="evaluate_network_upload" value="<?php  echo $evaluate->evaluate_network_upload;  ?>"/></td>
                        <td><textarea name="network_upload_text"><?php  echo $evaluate->network_upload_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>القوى العاملة بالمشروع (العدد، الكفاءة، التدريب)</td>
                        <td><input type="text" name="manpower_project"  id="manpower_project" value="<?php  echo $evaluate->manpower_project;  ?>"/></td>
                        <td><textarea name="manpower_project_text"><?php  echo $evaluate->manpower_project_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>التأمينات الاجتماعية والتقاعد (صاحب المشروع والعمال والموظفين)</td>
                        <td><input type="text" name="evaluate_social_security"  id="evaluate_social_security" value="<?php  echo $evaluate->evaluate_social_security;  ?>"/></td>
                        <td><textarea name="social_security_text"><?php  echo $evaluate->social_security_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>تأمين المحل والتجهيزات (الحوادث المهنية، السرقة، الحرائق، الكوارث،...)</td>
                        <td><input type="text" name="evaluate_shop_equipment_insurance"  id="evaluate_shop_equipment_insurance" value="<?php  echo $evaluate->evaluate_shop_equipment_insurance;  ?>"/></td>
                        <td><textarea name="shop_equipment_insurance"><?php echo $evaluate->shop_equipment_insurance;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>احترام قواعد الصحة والسلامة المهنية والبيئة</td>
                        <td><input type="text" name="evaluate_respect_occupation"  id="evaluate_respect_occupation" value="<?php  echo $evaluate->evaluate_respect_occupation;  ?>"/></td>
                        <td><textarea name="respect_occupation_text"><?php  echo $evaluate->respect_occupation_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td colspan='4'>آفاق تطوير المشروع</td>
                        <td><input type="text" name="evaluate_prospects_development"  id="evaluate_prospects_development" value="<?php  echo $evaluate->evaluate_prospects_development;  ?>"/></td>
                        <td><textarea name="prospects_development_development_text"><?php echo $evaluate_data->prospects_development_development_text;  ?></textarea></td>
                      </tr>
              <tr>
                        <td>المجموع</td>
                        <td><input type="text" name="totalrating"  id="totalrating" value="<?php  echo $evaluate->totalrating;  ?>"/></td>
                        <td>المتوسط: (مجموع/30)</td>
                        <td></td>
                        <td>التقييم</td>
                        <td id="taqem_html"><?php echo $evaluate->totalrating/30;  ?></td>
                      </tr>
            </table>
                            <?php
						}
			?>		
				  
		  </div>
          
		  <div class="form_raw">
			<h3>طريقة إسناد الأعداد:</h3>
			<li>(0أو0.5):غير مناسب تماما،غير متوفر،غير لائق تماما </li>
			<li>(1أو1.5أو 2):غير كاف </li>
			<li>(2.5):متوسط</li>
			<li>(3):فوق المتوسط</li>
			<li>(3.5):جيد  </li>
			<li>(4 أو 4.5):جيد جدا</li>
			<li>(5):ممتاز</li>
		  </div>
		  <?php
			}
		  ?>
		  <?php
		  if(!empty($monthly_financial)){
	
		  ?>
          <div class="form_raw">
		   <?php
		   //$monthly_financial = $info;
		   
		  				foreach($monthly_financial as $monthly){
					$total = '';
					?>
                      <input type="hidden" id="month_financial" name="month_financial" value="<?php echo $monthly->month_financial; ?>"> 
                 		  <h3 style="text-align: center;">تاريخ التقييم</h3>
		  	<h2 style="text-align: center;">تاريخ التقييم  :<?php echo $monthly->month ?>  </h2>
		  		<table border="1" align="center" style="text-align:center;width:100%;">
				<tr><td colspan='2'>المصروفات (ر.ع)</td><td colspan='2'>الإيرادات (ر.ع)</td></tr>
				<tr><td style="width: 37%;">مشتريات</td><td style="width: 12%;"><input  type="text" placeholder="مشتريات"  name="purchase" class="NumberInput req expence" id="purchase" style="width: 100%;" value="<?php echo $monthly->purchase;  ?>" readonly="readonly"/></td><td rowspan='4' >إيراد</td><td rowspan='7' style="width:26%"><input  type="text" placeholder="إيراد"  name="manpower_project" class="NumberInput req income" id="manpower_project" style="width: 100%;height:100%" value="<?php  echo $monthly->manpower_project;  ?>" /></td></tr>
				<tr><td  style="width: 37%;">راتب صاحب المشروع (بما في ذلك التأمينات الاجتماعية)</td><td style="width: 12%;"><input  type="text" placeholder="راتب صاحب المشروع (بما في ذلك التأمينات الاجتماعية)"  name="salary_project" class="NumberInput req expence" id="salary_project" style="width: 100%;" value="<?php echo $monthly->salary_project;  ?>" /></td></tr>
				<tr><td  style="width: 37%;">رواتب القوى العاملة بالمشروع (بما في ذلك التأمينات الاجتماعية)</td><td style="width: 12%;"><input  type="text" placeholder="راتب صاحب المشروع (بما في ذلك التأمينات الاجتماعية)"  name="manpower_project" class="NumberInput req expence" id="manpower_project" style="width: 100%;" value="<?php echo $monthly->manpower_project;  ?>" /></td></tr>
				<tr><td   style="width: 37%;">إيجار</td><td style="width: 12%;"><input  type="text" placeholder="إيجار"  name="rent" class="NumberInput req expence" id="rent" style="width: 100%;" value="<?php echo $monthly->rent;  ?>" /></td></tr>
				<tr><td  style="width: 37%;">إنترنت</td><td style="width: 12%;"><input  type="text" placeholder="إنترنت"  name="expence" class="NumberInput req expence" id="expence" style="width: 100%;" value="<?php echo $monthly->expence;   ?>" /></td><td rowspan='3' >إيرادات أخرى متصلة بالمشروع	</td></tr>
				<tr><td  style="width: 37%;">كهرباء</td><td style="width: 12%;"><input  type="text" placeholder="كهرباء"  name="wire_expence" class="NumberInput req expence" id="wire_expence" style="width: 100%;" value="<?php echo $monthly->wire_expence;   ?>" /></td></tr>
				<tr><td  style="width: 37%;">ماء</td><td style="width: 12%;"><input  type="text" placeholder="ماء"  name="water_expence" class="NumberInput req expence" id="water_expence" style="width: 100%;" value="<?php echo $monthly->number_expence;  ?>"/></td></tr>
				<tr><td  style="width: 37%;">هاتف</td><td style="width: 12%;"><input  type="text" placeholder="هاتف"  name="number_expence" class="NumberInput req expence" id="number_expence" style="width: 100%;" value="<?php echo $monthly->fax_expence;   ?>" /></td></tr>
				<tr><td  style="width: 37%;">فاكس</td><td style="width: 12%;"><input  type="text" placeholder="فاكس"  name="fax_expence" class="NumberInput req expence" id="fax_expence" style="width: 100%;" value="<?php echo  $monthly->purchase;   ?>"/></td></tr>
				<tr><td  style="width: 37%;">خدمات مختلفة</td><td style="width: 12%;"><input  type="text" placeholder="خدمات مختلفة"  name="diffrent_services" class="NumberInput req expence" id="diffrent_services" style="width: 100%;" value="<?php $monthly->diffrent_services;  ?>" /></td></tr>
				<tr><td  style="width: 37%;">مصروفات أخرى متصلة بالمشروع</td><td style="width: 12%;"><input  type="text" placeholder="مصروفات أخرى متصلة بالمشروع"  name="other_expence" class="NumberInput req expence" id="other_expence" style="width: 100%;" value="<?php echo $monthly->other_expence;   ?>" /></td></tr>
				<tr><td style="width: 37%;">الإجمالي</td><td style="width: 12%;"><input  type="text" placeholder="الإجمالي"  name="total_expence" class="NumberInput req" id="total_expence" style="width: 100%;" value="<?php echo $monthly->total_expence;   ?>"|/></td><td colspan='2'><input  type="text" placeholder="الإجمالي"  name="total_income" class="NumberInput req " id="total_income" style="width: 100%;" value="<?php echo $monthly->total_income; ?>" readonly="readonly"/></td></tr>				
			</table>
                    
					<?php
				}
				
		  ?>
		  </div>
		  		  <div class="form_raw">
		  صافي الدخل الشهري للمشروع   =  <span id="tt2"></span>- <span id="tt"></span>        =       <span id="tt3"></span>      ريال عماني
		  </div>
		  <div class="form_raw">
		  صافي الأرباح الشهرية   =             <span><input type="text" id="tt5" /></span>-   <span id="tt4"></span>              =<span id="tt6">              ريال عماني  
		  
		  </div>
		  
          
          
          <?php
		  		}
	
		  //$observer = $info;
			if(!empty($observer)){
				$obs = $observer['0'];
			?>					
			<input type="hidden" id="observer_id" name="observer_id" value="<?php echo $obs->project_detail_id; ?>">
			  <h3>رأي المتابـــع:</h3>
             <div class="form_raw">		
			<textarea id="ckeditor2" name="observe_view" style="width: 100%; height: 300px;"><?php echo $obs->project_details; ?></textarea>
		</div> 
		<?php
			}
			?>
	
		  
		      
			  <button type="button" id="save_data_form" class="btnx">حفظ</button>
  

            </div>
  
    
    </form>

  </div>

</div>

<script>

function changeVal(){
	
	$('.nicEdit-main').keyup(function(){
					//console.log('change');
					firstChild = $('.nicEdit-main').eq(0).html();
					$("#ckeditor").val(firstChild);
					//console.log(firstChild+'firstChild');
					secondChild = $('.nicEdit-main').eq(1).html();
					$("#ckeditor2").val(secondChild);
					//console.log(secondChild+'secondChild');
							
		});	
}
$(document).ready(function(){
	
	setTimeout('changeVal()',1000);
	<?php
	$mss = $this->session->flashdata('msg');
	if($mss){
	?>
	show_notification('تم تحديث البيانات بنجاح');
	<?php
		}
	?>
	
		$('.detail-view-folllow').click(function(e){
			 var id = $(this).attr('id');
			 $(".show-content").html('');
			e.preventDefault();
			 
			 	var request = $.ajax({
					  url: config.BASE_URL+'followup/getfollowupHistory/'+id,
					  type: "POST",
					  data: { id : id },
					  dataType: "html",
					  success: function(msg){
						  $(".show-content").html(msg);
						  
						  			$( "#set-dialog-message-2" ).dialog({
									resizable: false,
									height:500,
									width:600,
									modal: true,
									buttons: {
									Ok: function() {
										$(".show-content").html('');
									$( this ).dialog( "close" );
										}
									  }
									});
					  }
					});
			  
	});

});

first_counter = '<?php echo count($financial); ?>';
second_counter = '<?php echo count($support); ?>';
function deleteOption(id){
						//tab_control_last;
						//alert(id);
						$("."+id).remove();
				}


				function showMultiForms(){
					
					text = '<div class="form_raw fcounter'+first_counter+'"><div class="user_txt txt_f">قيمة المشروع الحالية:</div><div class="user_field fcounter'+first_counter+'"><input type="text" class="NumberInput" name="present_value_project[]" id="present_value_project[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>';
					text  += '</div><div class="user_txt txt_f fcounter'+first_counter+'">متوسط الايرادات الشهرية:</div><div class="user_field fcounter'+first_counter+'"><input type="text" class="NumberInput" name="average_monthly_revenue[]" id="average_monthly_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>';
					text  += '<div class="user_txt txt_f fcounter'+first_counter+'">السنوية الايرادات متوسط:</div><div class="user_field fcounter'+first_counter+'"><input type="text" class="NumberInput" name="average_anual_revenue[]" id="average_anual_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div></div>';
					text  += '<div class="user_txt txt_f fcounter'+first_counter+'" style="float: left;"><div class="tab_control_last" id="fcounter'+first_counter+'"  onclick="deleteOption(this.id)"> <img width="16" height="16" src="http://localhost/lm7DEC2014/images/body/contant/delete.png"></div></div>';
					text  += '<div class="form_raw fcounter"'+first_counter+'"><div class="user_txt txt_f"> الشهري الريح صافي متوسط:</div><div class="user_field fcounter'+first_counter+'"><input class="NumberInput" type="text" name="net_average_monthly_revenue[]" id="net_average_monthly_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>';
					text  += '<div class="user_txt txt_f fcounter'+first_counter+'"> السنوي الريح صافي متوسط:</div><div class="user_field fcounter'+first_counter+'"><input type="text" class="NumberInput" name="net_average_anual_revenue[]" id="net_average_anual_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div></div>'
					$("#first").prepend(text);
					first_counter++;
				}
				
				function showSecondMultiple(){
					//alert('asdasd');
					text2 = '<div class="form_raw scounter'+second_counter+'"><div class="user_txt txt_f"> الدعم التدريبي:</div><div class="user_field scounter'+second_counter+'">نعم <input type="radio" name="support_training[]" id="support_training'+second_counter+'" value="1" class="supporting_classs" onclick="change_val(this)"/></div><div class="user_field">لا <input type="radio" name="support_training[]" id="support_training'+second_counter+'" value="0" class="supporting_classs" onclick="change_val(this)"/></div></div>';
					text2 +='<div class="form_raw yes_class_support scounter'+second_counter+' support_training'+second_counter+'" style="display:none;"><div class="user_txt txt_f"> مجال التدريب لصاحب المنشأة </div><div class="user_field scounter'+second_counter+'"><input  type="text"  class="NumberInput" name="training_owner_facility[]" id="training_owner_facility[]" /></div><div class="user_txt txt_f">  جهة التدريب  </div><div class="user_field"><input  type="text"  name="training[]" id="training[]" /></div></div>';
					text2 +='<div class="form_raw yes_class_support scounter'+second_counter+' support_training'+second_counter+'" style="display:none;"><div class="user_txt txt_f " style="width:46px !important;"> المدة </div><div class="user_field scounter'+second_counter+'"><input  type="text"  name="duration[]" id="duration[]" style="margin-left: 14px;"/><select id="durationtype[]" name="durationtype[]"><option value="شهر">شهر</option><option value="يوم">يوم</option></select></div><div class="user_txt txt_f" style="padding-right: 15px;">   قبل التأسيس:  </div><div class="user_field ">نعم <input type="radio" name="before_incoporation[]" id="before_incoporation1" value="1" class="supporting_classs"/></div><div class="user_field">لا <input type="radio" name="before_incoporation[]" id="before_incoporation" value="0" class="supporting_classs" /></div><div class="user_txt txt_f" style="padding-right: 15px;">   بعد التأسيس:  </div><div class="user_field uft"><input  type="text"  name="after_incoporation[]" id="after_incoporation[]" /></div></div>';
					text2 +='<div class="form_raw scounter'+second_counter+'"><div class="user_txt txt_f"> الدعم التمويلي:</div><div class="user_field scounter'+second_counter+'">نعم <input type="radio" name="funding_support[]" id="funding_support'+second_counter+'" value="1" class="supporting_classs" onclick="change_val(this)"/></div><div class="user_field">لا <input type="radio" name="funding_support[]" id="funding_support'+second_counter+'" value="0" class="supporting_classs" onclick="change_val(this)"/></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+' funding_support'+second_counter+'" style="display:none;"><div class="user_txt txt_f"> مبلغ الدعم  </div><div class="user_field scounter'+second_counter+'"><input type="text"  name="amount_support[]" id="amount_support" />&nbsp;رع</div><div class="user_txt txt_f" style="padding-right: 15px;">   جهة الدعم:  </div><div class="user_field"><input  type="text"  name="support_point[]" id="support_point[]" /></div><div style="padding-right: 15px;" class="user_txt txt_f">    نوع الدعم:  </div><div class="user_field uft" style="width:29px !important"><select name="support_type[]" id="'+second_counter+'" class="others" onchange="change_others(this)"><option value="قرض">قرض </option><option value="منحة">منحة </option><option value="others">اخرى يتم ذكرها </option></select></div></div>';
					text2 +='<div class="tab_control_last scounter'+second_counter+'" id="scounter'+second_counter+'"  onclick="deleteOption(this.id)" style="float: left;"> <img width="16" height="16" src="http://localhost/lm7DEC2014/images/body/contant/delete.png"></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+'" id="others'+second_counter+'" style="display:none;"><div class="user_txt txt_f"> أخرى (يتم ذكرها)  </div><div class="user_field  scounter'+second_counter+'"><input  type="text"  name="mention_others[]" id="mention_others" /></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+'"><div class="user_txt txt_f"> وجه دعم أخرى </div><div class="user_field scounter'+second_counter+'">نعم<input type="radio"  name="face_others_support" id="face_others_support'+second_counter+'" value="1" onclick="change_val(this)"/></div><div class="user_field">لا<input type="radio"  name="face_others_support" id="face_others_support'+second_counter+'" value="0" onclick="change_val(this)"/></div></div>';
					text2 += '<div class="form_raw yes_class_others scounter'+second_counter+'"><div class="user_field scounter'+second_counter+' face_others_support'+second_counter+'" style="display:none;">اذكرها<input  type="text"  name="face_others_support_text" id="face_others_support_text"  /></div></div>';
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

					$('#save_data_form').click(function(){
					//alert('click');
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
			 	//alert(redline); 
			  if(redline <= 0)
			  {	
			  	$("#validate_form").submit();
			  }
			  else
			  {
				   ddx(ht);
			  }
		});

			  
				    $('#opendiag').click(function()

					{

						$( "#dialog_loan_view" ).dialog({

							resizable: false,

							height:700,

							width:900,

							

							modal: true});

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
<div id="dialog-message2" title="  ملا حظة !!!!   " style="display:none;">

</div>

