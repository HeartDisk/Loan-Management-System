<?php $this->load->view('common/meta');?>
<script type="text/javascript">
$(document).ready(function(e) {
	
		calculateAge();
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
	
	$(".ratings").change(function(){

			total_charges =0;			
				alert('asdasd');
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

				});		
	
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
.tab_control_last{
	float:left;
}

</style>
<div id="set-dialog-message-2" class="show-content" title="مشاهدة" style="display:none;"> </div>
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

  .txt_f {

	 width:auto !important; 

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

      <div class="data_box_title">
        <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>

        <div class="data_title">استمارة متابعة و مساندة المشاريع</div>

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

                <div class="user_txt txt_f"> المحافظة:</div>

                <div class="user_field uft"> <?php echo show_data('Region',$applicant->province); //echo show_data('Walaya',$applicant->walaya);//echo $project->activity_project_text; ?> </div>
               <div class="user_txt txt_f"> الولاية:</div>
			  <div class="user_field uft"> <?php echo show_data('walaya',$applicant->walaya); //echo show_data('Walaya',$applicant->walaya);//echo $project->activity_project_text; ?> </div>
				<div class="user_txt txt_f"> القرية:</div>
			  <div class="user_field uft"> <?php echo $applicant->village; //echo show_data('Walaya',$applicant->walaya);//echo $project->activity_project_text; ?> </div>

              </div>
              <div class="form_raw">

                <div class="user_txt txt_f"> مشروع:</div>

                <div class="user_field uft"> <?php echo $applicant->applicant_type; ?> </div>
                
                <?php
					if($applicant->applicant_type == 'مشترك'){
				?>
                <div class="user_txt txt_f">عدد الشركاء</div>
                <div class="user_field uft"><?php  if(!empty($applicant_partner)){
						echo count($applicant_partner);
					}else{
						
						echo "0";	
					}
					
					 ?></div>
                    <?php
					}
					
					?>
  
              </div>
              <div class="form_raw">

                <div class="user_txt txt_f"> البرنامج التمويلي:</div>
				  <div class="user_field uft"> <?php echo show_data('LoanLimit',$loan->loan_limit); //echo show_data('Walaya',$applicant->walaya);//echo $project->activity_project_text; ?> </div>
              </div>
              <div class="form_raw">
              	<div class="user_txt txt_f">طبيعة موقع المشروع</div>
                <div class="user_field uft"><?php echo getlistType('nature_project_site',$project->nature_project_site); ?></div>
              </div>
              <h3>بيانات صاحب المشروع</h3>
              <div class="form_raw">

                <div class="user_txt txt_f"> الاسم:</div>
				  <div class="user_field uft"><?php //echo "<pre>"; //print_r($applicant);
				  	echo $applicant->applicant_first_name." ".$applicant->applicant_middle_name." ".$applicant->applicant_last_name;
				   ?>  </div>
                  <div class="user_txt txt_f">النوع:</div>
                  <div class="user_field uft"><?php echo $applicant->applicant_gender; ?></div> 
              </div>
              <div class="form_raw">

				<input type="hidden" value="<?php echo date('d/m/Y',strtotime($applicant->applicant_date_birth)); ?>" name="birthday" id="birthday" />
                <div class="user_txt txt_f"> العمر:</div>
				  <div class="user_field" id="age_view"> </div><span>سنة</span>
                  
              </div>
              <div class="form_raw">
				<div class="user_txt txt_f"> رقم البطاقة الشخصية:</div>
				  <div class="user_field uft"><?php //echo "<pre>"; //print_r($applicant);
				  	echo $applicant->appliant_id_number;
				   ?>  </div>
                  <div class="user_txt txt_f">رقم سجل القوي العاملة:</div>
                  <div class="user_field uft"><?php echo $applicant->applicant_cr_number; ?></div> 
              </div>
              <div class="form_raw">
				<div class="user_txt txt_f"> تسجيل الهينة:</div>
				  <div class="user_field uft">مسجل</div> 
              </div>
              <div class="form_raw">
                  <div class="user_txt txt_f">الهاتف:</div>
                  <div class="user_field uft"><?php echo $project->project_linephone; ?></div> 
                  <div class="user_txt txt_f">الفاكس:</div>
                  <div class="user_field uft"><?php echo $project->project_faxnumber; ?></div>
                  <div class="user_txt txt_f">البريد الالكتروني:</div>
                  <div class="user_field uft"><?php echo $project->project_email; ?></div> 
              </div>
              <?php
			  	//echo "<pre>";
				//print_r($professional);
			  ?>
               <div class="form_raw">
				<div class="user_txt txt_f"> المستوى التعليمي:</div>
				  <div class="user_field uft"><?php echo getlistType('qualification',$applicant->applicant_qualification); ?></div> 
              </div>
              <div class="form_raw">
                  <div class="user_txt txt_f"> الخبر في نفس النشاط:</div>
				  <div class="user_field"><table>
				  <tr><td>تاريخ بداية المشروع</td><td>اسم الجهة/المؤسسة/ المشروع الخاص</td><td>نشاط الجهة/المؤسسة/ المشروع الخاص</td><td>المهنة المزاولة بالجهة/المؤسسة/ المشروع الخاص</td><td>عدد سنوات الخبرة</td></tr>
				  <?php foreach($professional as $profess){
					  	?>
                        	<tr>
							<td><?php if($profess->option_one !='0000-00-00') echo $profess->option_one; ?></td>
							<td><?php if($profess->option_two !='') echo $profess->option_two; ?></td>
							<td><?php if($profess->option_three !='') echo $profess->option_three; ?></td>
							<td><?php if($profess->option_four !='') echo $profess->option_four; ?></td>
							<td><?php if($profess->option_five !='') echo $profess->option_five; ?></td>
                            </tr>
					  <?php
                      
					  } ?> </table></div>  
              </div>
              <div class="form_raw">
                  <div class="user_txt txt_f"> الخبر في مجالات أخرى:</div>
				  <div class="user_field uft"><?php //echo show_data('qualification',$applicant->applicant_qualification); ?></div>  
              </div>
			<div class="form_raw">
    			<div class="user_txt txt_f">الوضع قبل المشروع</div> 
                <div class="user_field uft"><?php echo getlistType('current_situation',$applicant->applicant_job_staus);  ?></div>       
            </div>
            <div class="form_raw">
            	<div class="user_txt txt_f">التفرغ لادارة المشروع</div>
                <div class="user_field uft"><?php ?></div>
            </div>
              <h3>بيانات حول المشروع</h3>    
              <div class="form_raw">
            	<div class="user_txt txt_f">اسم المنشاة:</div>
                <div class="user_field uft"><?php echo $project->commercial_name;//commercial_name  ?></div>
                <div class="user_txt txt_f">رقم السجل التجاري:</div>
                <div class="user_field uft"><?php echo $project->project_registration_number; ?></div>
            </div>
              <div class="form_raw">
            	<div class="user_txt txt_f">النشاط</div>
                <div class="user_field uft"><?php echo $project->activity_project_text; ?></div>
            </div>
            <div class="form_raw">
            	<div class="user_txt txt_f">طبيعة النشاط</div>
                <div class="user_field uft"><?php echo getlistType('nature_project',$applicant->nature_project); // ?></div>
            </div>
            <div class="form_raw">
            	<div class="user_txt txt_f">تعمين نشط المشروع</div>
                <div class="user_field uft"><?php ?></div>
            </div>	
            <div class="form_raw">
            	<div class="user_txt txt_f"> نوع المشروع</div>
                <div class="user_field uft"><?php echo getlistType('project_type',$applicant->project_type); ?></div>
            </div>	
            <div class="form_raw">
            	<div class="user_txt txt_f">عنوان المشروع</div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f">المحافظة:</div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f">الولاية:</div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f">القرية:</div>
                <div class="user_field uft"><?php  ?></div>
            </div>	
            <div class="form_raw">
            	<div class="user_txt txt_f">المشروع/رقم الهاتف</div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f">النقال:</div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f">البريد الالكتروني:</div>
                <div class="user_field uft"><?php ?></div>
            </div>
            <div class="form_raw">
            	<div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f">قيمة المشروع(في حلة مشروع قائم)</div>
                <div class="user_field uft"><?php ?>رع</div>
                <div class="user_txt txt_f">منها قرض: </div>
                <div class="user_field uft"><?php ?>رع</div>
                <div class="user_txt txt_f">منها تمويل ذاتي: </div>
                <div class="user_field uft"><?php ?>رع</div>
            </div>
            <div class="form_raw">
            	<div class="user_txt txt_f"></div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f">تاريخ تأسيس أو تدعيم \ شراء المشروع:</div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f">تاريخ آخر  شراء\  توسعة المشروع:</div>
                <div class="user_field uft"><?php ?></div>
            </div>
            <div class="form_raw">
            	<div class="user_txt txt_f"></div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f">وضع المحل:</div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f">آخرى(يتيم ذكرها:</div>
                <div class="user_field uft"><?php ?></div>
            </div>
            
            <div class="form_raw">
            <h3 style="float: right;">الاستمار والمردود المالي</h3>
            <a  href="javascript:void(0)" onclick="showMultiForms()"><img width="25" height="25" src="<?php echo base_url(); ?>images/listicon/001_01.png"></a>
            </div>
            <div id="first">
                    <div class="form_raw">
                        <div class="user_txt txt_f">قيمة المشروع الحالية:</div>
                        <div class="user_field"><input type="text" name="present_value_project[]" id="present_value_project[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>
                    </div>
                    <div class="form_raw">
                        <div class="user_txt txt_f">متوسط الايرادات الشهرية:</div>
                        <div class="user_field "><input type="text" name="average_monthly_revenue[]" id="average_monthly_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>
                        <div class="user_txt txt_f">السنوية الايرادات متوسط:</div>
                        <div class="user_field"><input type="text" name="average_anual_revenue[]" id="average_anual_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>  
</div>
                      </div>
                    <div class="form_raw">
                        <div class="user_txt txt_f"> الشهري الريح صافي متوسط:</div>
                        <div class="user_field "><input type="text" name="net_average_monthly_revenue[]" id="net_average_monthly_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>
                        <div class="user_txt txt_f"> السنوي الريح صافي متوسط:</div>
                        <div class="user_field"><input type="text" name="net_average_anual_revenue[]" id="net_average_anual_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>
                    </div>
            </div>
            <div class="form_raw">
             <h3 style="float: right;">أوجه الدعم المقدمة من الجهات الاخرى</h3>
             <a  href="javascript:void(0)" onclick="showSecondMultiple()"><img width="25" height="25" src="<?php echo base_url(); ?>images/listicon/001_01.png"></a>
             </div>
            <div id="second">
             <div class="form_raw">
            	<div class="user_txt txt_f"> الدعم التدريبي:</div>
                <div class="user_field">نعم <input type="checkbox" name="support_training" id="support_training" value="1" /></div>
                <div class="user_field">لا <input type="checkbox" name="support_training" id="support_training2" value="0" /></div>
            </div>
            <div class="form_raw yes_class_support">
            	<div class="user_txt txt_f"> مجال التدريب لصاحب المنشأة </div>
                <div class="user_field"><input  type="text"  name="training_owner_facility" id="training_owner_facility" /></div>
                <div class="user_txt txt_f">  جهة التدريب  </div>
                <div class="user_field"><input  type="text"  name="training" id="training" /></div>
            </div>
            <div class="form_raw yes_class_support">
            	<div class="user_txt txt_f"> المدة </div>
                <div class="user_field"><input  type="text"  name="duration" id="duration" /><div  style="float: left; margin-right: 7px;"> &nbsp;يوم/شهر</div></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">   قبل التأسيس:  </div>
                <div class="user_field"><input  type="text"  name="before_incoporation" id="before_incoporation" /></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">   بعد التأسيس:  </div>
                <div class="user_field uft"><input  type="text"  name="after_incoporation" id="after_incoporation" /></div>

            </div>
            <div class="form_raw">
            	<div class="user_txt txt_f"> الدعم التمويلي:</div>
                <div class="user_field ">نعم <input type="checkbox" name="funding_support" id="funding_support" value="1" /></div>
                <div class="user_field">لا <input type="checkbox" name="funding_support" id="funding_support2" value="0" /></div>
            </div>
            <div class="form_raw yes_class_funds">
            	<div class="user_txt txt_f"> مبلغ الدعم  </div>
                <div class="user_field"><input  type="text"  name="amount_support" id="amount_support" /><div  style="float: left; margin-right: 7px;"> &nbsp;رع</div></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">   جهة الدعم:  </div>
                <div class="user_field"><input  type="text"  name="support_point" id="support_point" /></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">    قرض:  </div>
                <div class="user_field uft"><input  type="text"  name="loan" id="loan" /></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">    منحة:  </div>
                <div class="user_field uft"><input  type="text"  name="donation" id="donation"/></div>
            </div>
            <div class="form_raw yes_class_funds">
            	<div class="user_txt txt_f"> أخرى (يتم ذكرها)  </div>
                <div class="user_field"><input  type="text"  name="mention_others" id="mention_others" /></div> 
            </div>
            <div class="form_raw yes_class_funds">
            	<div class="user_txt txt_f"> وجه دعم أخرى </div>
                <div class="user_field">نعم<input type="checkbox"  name="face_others_support" id="face_others_support1" value="1" /></div> 
                <div class="user_field">لا<input type="checkbox"  name="face_others_support" id="face_others_support2" value="0" /></div> 
            </div>
             <div class="form_raw yes_class_others">
                <div class="user_field"><input  type="text"  name="face_others_support_text" id="face_others_support_text"  /></div> 
              </div>
          </div>    
		  <h3>بطاقة تقييم مشروع</h3>
		  <div class="form_raw">
					<table border="1" align="center" style="text-align:center;">
				  <tr><td colspan='4'>عناصر التقييم</td><td>العدد ( 0-5)</td><td>ملاحظات</td></tr>
				  <tr><td colspan='4'>موقع المشروع</td><td><input  type="text"  name="rating" id="rating" class="NumberInput req ratings"   style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>اللوحات واللافتات التوجيهية الدالة على مقر المشروع</td><td><input  type="text"  name="rating" class="NumberInput req ratings" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>واجهة مقر المشروع</td><td><input  type="text"  name="rating" id="rating" class="NumberInput req ratings" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>ملائمة المحل مع نشاط المشروع</td><td><input  type="text"  name="rating" class="NumberInput req ratings" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>نظافة المحل</td><td><input  type="text"  name="rating" id="rating" class="NumberInput req ratings" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>تنظيم المحل وتنظيم  الأجنحة والوحدات والبضائع داخله</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>طريقة تخزين المنتجات والبضائع وتوفرها	</td><td><input  type="text"  name="rating" class="NumberInput req ratings" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>طريقة العرض والبيع/ مراحل ومسالك الإنتاج/ طريقة تقديم الخدمات</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>وسائل الدعاية المعتمدة</td><td><input  type="text"  name="rating" class="NumberInput req ratings" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>استقبال الزبائن والتعامل معهم</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>جودة الخدمة/ المنتج/ البضائع وتنوعها</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>الأسعار المعتمدة</td><td><input  type="text"  name="rating" class="NumberInput req ratings" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>طريقة الترويج والتسويق</td><td><input  type="text"  name="rating" class="NumberInput req ratings" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>طريقة البيع (نقدا أو بالأجل)</td><td><input  type="text"  class="NumberInput req ratings" name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>كيفية مجابهة المنافسة</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>نوعية المعدات والتجهيزات</td><td><input  type="text"  class="NumberInput req ratings" name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>المظهر العام لصاحب المشروع والعاملين معه</td><td><input  type="text"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>احترام توقيت العمل</td><td><input  type="text"  class="NumberInput req ratings" name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>طريقة تسيير للمشروع</td><td><input  type="text" class="NumberInput req ratings" name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>مسك الدفاتر المالية</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>تمكن صاحب المشروع من نشاط مشروعه ومختلف مكوناته</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>التعامل مع المزودين (نقدا أو بالأجل) وانتظام التزويد</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>معرفة السوق والحصة من السوق والوحدات المماثلة في نفس النشاط</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>العلاقة بالمحيط والجهات التي يتعامل معها المشروع (العمومية والخاصة)</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>تنمية شبكة علاقات وتحديثها</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>القوى العاملة بالمشروع (العدد، الكفاءة، التدريب)</td><td><input  type="text" class="NumberInput req ratings"  name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>التأمينات الاجتماعية والتقاعد (صاحب المشروع والعمال والموظفين)</td><td><input  type="text" class="NumberInput req ratings" name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>تأمين المحل والتجهيزات (الحوادث المهنية، السرقة، الحرائق، الكوارث،...)</td><td><input  type="text" class="NumberInput req ratings" name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>احترام قواعد الصحة والسلامة المهنية والبيئة</td><td><input  type="text" class="NumberInput req ratings" name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td colspan='4'>آفاق تطوير المشروع</td><td><input  type="text" class="NumberInput req ratings" name="rating" id="rating" style="height: 80px;" /></td><td><textarea></textarea></td></tr>
				  <tr><td>المجموع</td><td><input  type="text" class="NumberInput req" name="totalrating" id="totalrating" style="width:100%;" readonly/></td><td>المتوسط: (مجموع/30)</td><td></td><td>التقييم</td><td>فوق المتوسط</td></tr>
				  </table>
				  
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
		  <div class="form_raw">
		  <h3 style="text-align: center;">التقييم المالي الشهري</h3>
		  	<h2 style="text-align: center;">الشهر/العام :<input type="text" name="month" id="month">  </h2>
		  		<table border="1" align="center" style="text-align:center;width:100%;">
				<tr><td colspan='2'>المصروفات (ر.ع)</td><td colspan='2'>الإيرادات (ر.ع)</td></tr>
				<tr><td>مشتريات</td><td></td><td rowspan='4' >إيراد</td><td rowspan='7'>&nbsp;</td></tr>
				<tr><td>راتب صاحب المشروع (بما في ذلك التأمينات الاجتماعية)</td><td>&nbsp;</td></tr>
				<tr><td>رواتب القوى العاملة بالمشروع (بما في ذلك التأمينات الاجتماعية)</td><td>&nbsp;</td></tr>
				<tr><td>إيجار</td><td>&nbsp;</td></tr>
				<tr><td>كهرباء/ ماء/ هاتف+فاكس +إنترنت</td><td>&nbsp;</td><td rowspan='3' >إيرادات أخرى متصلة بالمشروع	</td></tr>
				<tr><td>خدمات مختلفة</td><td>&nbsp;</td></tr>
				<tr><td>مصروفات أخرى متصلة بالمشروع</td><td>&nbsp;</td></tr>
				<tr><td>الإجمالي</td><td>&nbsp;</td><td colspan='2'>&nbsp;</td></tr>				
			</table>
		  </div>
		  		  <div class="form_raw">
		  صافي الدخل الشهري للمشروع   =              -         =             ريال عماني
		  </div>
		  <div class="form_raw">
		  صافي الأرباح الشهرية   =             -                 =              ريال عماني  
		  </div>
            <!--
            <!--
             
            <div class="form_raw yes_class_support">
            	<div class="user_txt txt_f"> الدعم التمويلي:</div>
                <div class="user_field uft"><?php  ?></div>
                <div class="user_txt txt_f"> مجال التدريب لصاحب المنشاة:</div>
                <div class="user_field uft"><?php  ?></div>
                
            </div>
            -->  </div>
              
<!--              <div class="form_raw">

                <div class="user_txt txt_f"> مبلغ القرض:</div>

                <div class="user_field uft"> <?php //echo arabic_date(number_format($loan->loan_amount,0)); ?> </div>

                <div class="user_txt txt_f"> الولاية:</div>

                <div class="user_field uft"> <?php //echo show_data('Walaya',$applicant->walaya); ?></div>

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
			

            </div>
  
            </div>

          </div>

        </div>

      </div>
      

    </form>

  </div>

</div>

<script>
first_counter = 0;
second_counter = 0;
function deleteOption(id){
						//tab_control_last;
						//alert(id);
						$("."+id).remove();
				}


				function showMultiForms(){
					
					text = '<div class="form_raw fcounter'+first_counter+'"><div class="user_txt txt_f">قيمة المشروع الحالية:</div><div class="user_field"><input type="text" name="present_value_project[]" id="present_value_project[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>';
					text  += '</div><div class="user_txt txt_f fcounter'+first_counter+'">متوسط الايرادات الشهرية:</div><div class="user_field "><input type="text" name="average_monthly_revenue[]" id="average_monthly_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>';
					text  += '<div class="user_txt txt_f fcounter'+first_counter+'">السنوية الايرادات متوسط:</div><div class="user_field"><input type="text" name="average_anual_revenue[]" id="average_anual_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div></div>';
					text  += '<div class="user_txt txt_f fcounter'+first_counter+'" style="float: left;"><div class="tab_control_last" id="fcounter'+first_counter+'"  onclick="deleteOption(this.id)"> <img width="16" height="16" src="http://localhost/lm7DEC2014/images/body/contant/delete.png"></div></div>';
					text  += '<div class="form_raw fcounter"'+first_counter+'"><div class="user_txt txt_f"> الشهري الريح صافي متوسط:</div><div class="user_field "><input type="text" name="net_average_monthly_revenue[]" id="net_average_monthly_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div>';
					text  += '<div class="user_txt txt_f fcounter'+first_counter+'"> السنوي الريح صافي متوسط:</div><div class="user_field"><input type="text" name="net_average_anual_revenue[]" id="net_average_anual_revenue[]" /><div  style="float: left; margin-right: 7px;">رع</div></div></div>'
					$("#first").prepend(text);
					first_counter++;
				}
				
				function showSecondMultiple(){
					//alert('asdasd');
					text2 = '<div class="form_raw scounter'+second_counter+'"><div class="user_txt txt_f"> الدعم التدريبي:</div><div class="user_field">نعم <input type="checkbox" name="support_training" id="support_training" value="1" /></div><div class="user_field">لا <input type="checkbox" name="support_training" id="support_training2" value="0" /></div></div>';
					text2 +='<div class="form_raw yes_class_support scounter'+second_counter+'"><div class="user_txt txt_f"> مجال التدريب لصاحب المنشأة </div><div class="user_field"><input  type="text"  name="training_owner_facility" id="training_owner_facility" /></div><div class="user_txt txt_f">  جهة التدريب  </div><div class="user_field"><input  type="text"  name="training" id="training" /></div></div>';
					text2 +='<div class="form_raw yes_class_support scounter'+second_counter+'"><div class="user_txt txt_f"> المدة </div><div class="user_field"><input  type="text"  name="duration" id="duration" /><div  style="float: left; margin-right: 7px;"> &nbsp;يوم/شهر</div></div><div class="user_txt txt_f" style="padding-right: 15px;">   قبل التأسيس:  </div><div class="user_field"><input  type="text"  name="before_incoporation" id="before_incoporation" /></div><div class="user_txt txt_f" style="padding-right: 15px;">   بعد التأسيس:  </div><div class="user_field uft"><input  type="text"  name="after_incoporation" id="after_incoporation" /></div></div>';
					text2 +='<div class="form_raw scounter'+second_counter+'"><div class="user_txt txt_f"> الدعم التمويلي:</div><div class="user_field ">نعم <input type="checkbox" name="funding_support" id="funding_support" value="1" /></div><div class="user_field">لا <input type="checkbox" name="funding_support" id="funding_support2" value="0" /></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+'"><div class="user_txt txt_f"> مبلغ الدعم  </div><div class="user_field"><input  type="text"  name="amount_support" id="amount_support" /><div  style="float: left; margin-right: 7px;"> &nbsp;رع</div></div><div class="user_txt txt_f" style="padding-right: 15px;">   جهة الدعم:  </div><div class="user_field"><input  type="text"  name="support_point" id="support_point" /></div><div class="user_txt txt_f" style="padding-right: 15px;">    قرض:  </div><div class="user_field uft"><input  type="text"  name="loan" id="loan" /></div><div class="user_txt txt_f" style="padding-right: 15px;">    منحة:  </div><div class="user_field uft"><input  type="text"  name="donation" id="donation"/></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+'"><div class="user_txt txt_f"> مبلغ الدعم  </div><div class="user_field"><input  type="text"  name="amount_support" id="amount_support" /><div  style="float: left; margin-right: 7px;"> &nbsp;رع</div></div><div class="user_txt txt_f" style="padding-right: 15px;">   جهة الدعم:  </div><div class="user_field"><input  type="text"  name="support_point" id="support_point" /></div><div class="user_txt txt_f" style="padding-right: 15px;">    قرض:  </div><div class="user_field uft"><input  type="text"  name="loan" id="loan" /></div><div class="user_txt txt_f" style="padding-right: 15px;">    منحة:  </div><div class="user_field uft"><input  type="text"  name="donation" id="donation"/></div></div>';
					text2 +='<div class="tab_control_last scounter'+second_counter+'" id="scounter'+second_counter+'"  onclick="deleteOption(this.id)" style="float: left;"> <img width="16" height="16" src="http://localhost/lm7DEC2014/images/body/contant/delete.png"></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+'"><div class="user_txt txt_f"> أخرى (يتم ذكرها)  </div><div class="user_field"><input  type="text"  name="mention_others" id="mention_others" /></div></div>';
					text2 += '<div class="form_raw yes_class_funds scounter'+second_counter+'"><div class="user_txt txt_f"> وجه دعم أخرى </div><div class="user_field">نعم<input type="checkbox"  name="face_others_support" id="face_others_support1" value="1" /></div><div class="user_field">لا<input type="checkbox"  name="face_others_support" id="face_others_support2" value="0" /></div></div>';
					text2 += '<div class="form_raw yes_class_others scounter'+second_counter+'"><div class="user_field"><input  type="text"  name="face_others_support_text" id="face_others_support_text"  /></div></div>';
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

