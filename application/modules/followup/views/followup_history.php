<?php $type_name	=	$this->inq->get_type_name($applicatn_info->applicant_marital_status);?>
<?php $privince		=	$this->inq->get_province_name($applicatn_info->province);?>
<?php $wilayats		=	$this->inq->get_wilayats_name($applicatn_info->walaya);?>
<?php $phone		=	$this->inq->applicant_phone_number($applicatn_info->applicant_id);?>
<?php $tab_1		=	$this->inq->get_tab_data('applicant_qualification',$applicatn_info->applicant_id);?>
<?php $tab_2		=	$this->inq->get_tab_data('applicant_professional_experience',$applicatn_info->applicant_id);?>
<?php $tab_3		=	$this->inq->get_tab_data('applicant_businessrecord',$applicatn_info->applicant_id);?>
<?php $professional	=	$this->inq->getRequestInfo($applicatn_info->applicant_id);

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
    <form id="validate_form" name="validate_form" method="post" action="<?PHP echo base_url().'followup/add_follow_up' ?>" autocomplete="off">

      <input type="hidden" name="form_step" id="form_step" value="5" />      

      <input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $applicant->applicant_id;?>" />

      <div class="main_box">


      <div class="data_raw">

        <div class="data">

          <div class="main_data">
            <div class="form_raw">
            <h3 style="float: right;">الاستمار والمردود المالي</h3>
            </div>
			<?php
				if(!empty($financial)){
					foreach($financial as  $i=>$finance){
						?>
						
            <div id="first">
                    <div class="form_raw fcounter<?php echo $i; ?>">
                        <div class="user_txt txt_f">قيمة المشروع الحالية:</div>
                        <div class="user_field"><?php echo $finance->present_value_project; ?>رع</div></div>
                    </div>
                    <div class="form_raw fcounter<?php echo $i; ?>">
                        <div class="user_txt txt_f">متوسط الايرادات الشهرية:</div>
                        <div class="user_field "><?php echo $finance->average_monthly_revenue; ?><div  style="float: left; margin-right: 7px;">رع</div></div>
                        <div class="user_txt txt_f">السنوية الايرادات متوسط:</div>
                        <div class="user_field"><?php echo $finance->average_anual_revenue; ?><div  style="float: left; margin-right: 7px;">رع</div></div>  
</div>              </div>
						  <div class="form_raw fcounter<?php echo $i; ?>">
                        <div class="user_txt txt_f"> الشهري الريح صافي متوسط:</div>
                        <div class="user_field "><?php echo $finance->average_anual_revenue; ?><div  style="float: left; margin-right: 7px;">رع</div></div>
                        <div class="user_txt txt_f"> السنوي الريح صافي متوسط:</div>
                        <div class="user_field"><?php echo $finance->net_average_anual_revenue; ?><div  style="float: left; margin-right: 7px;">رع</div></div>
                    </div>
					<div class="form_raw fcounter<?php echo $i; ?>">
						<div class="user_field">تاريخ:<?php echo $finance->created;  ?></div>
					</div>
					<?php
					}
				}
			
			?>
			
                  
            </div>
            <div class="form_raw">
             <h3 style="float: right;">أوجه الدعم المقدمة من الجهات الاخرى</h3>
             </div>
			 <?php
				if(!empty($support)){
					foreach($support as $i=>$sup){
					?>
					<div id="second">
             <div class="form_raw">
            	<div class="user_txt txt_f"> الدعم التدريبي:</div>
				<?php
					$checked1 = "";
					$checked2 = "";
					if($sup->support_training == '1'){
						$checked1 ="نعم";
						$display = "block";
					}
					else{
							$checked1 ="لا";
							$display = "none";
					}
				?>
                <div class="user_field"><?php echo $checked1; ?></div>
            </div>
            <div class="form_raw yes_class_support support_training<?php echo $i; ?>"  style="display:<?php echo $display; ?>;">
            	<div class="user_txt txt_f"> مجال التدريب لصاحب المنشأة </div>
                <div class="user_field"><?php echo $sup->training_owner_facility;  ?></div>
                <div class="user_txt txt_f">  جهة التدريب  </div>
                <div class="user_field"><?php echo $sup->training;  ?></div>
            </div>
            <div class="form_raw yes_class_support">
            	<div class="user_txt txt_f" style="width:46px !important; "> المدة </div>
                <div class="user_field"><?php echo $sup->duration; ?><?php echo $sup->durationtype; ?></div>
				<div class="user_txt txt_f" style="padding-right: 15px;">   قبل التأسيس:  </div>
                <div class="user_field "><?php if($sup->before_incoporation == '1') echo "نعم";else echo "لا"; ?></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">   بعد التأسيس:  </div>
                <div class="user_field uft" style="width:56px !important"><?php echo $sup->after_incoporation;  ?></div>

            </div>
            <div class="form_raw">
            	<div class="user_txt txt_f"> الدعم التمويلي:</div>
				<?php
					$fchecked1 = "";
					$fchecked2 = "";
					if($sup->funding_support == '1'){
						$fchecked1 ="نعم";
						$display = "block";
					}
					else{
							$fchecked1 ="لا";
							$display = "none";
					}
				?>
                <div class="user_field "><?php echo $fchecked1; ?></div>
            </div>
            <div class="form_raw yes_class_funds funding_support<?php echo $i; ?>" style="display:<?php echo $display; ?>;">
            	<div class="user_txt txt_f"> مبلغ الدعم  </div>
                <div class="user_field"><?php echo $sup->amount_support;  ?><div  style="float: left; margin-right: 7px;"> &nbsp;رع</div></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">   جهة الدعم:  </div>
                <div class="user_field"><?php echo $sup->support_point;  ?></div>
                <div class="user_txt txt_f" style="padding-right: 15px;">    نوع الدعم:  </div>
                <!--<div class="user_field uft" style="width:29px !important"><input  type="text"  name="loan[]" id="loan" style="width:145px !important" value="<?php echo $sup->loan;  ?>"/></div> -->
				<div class="user_field uft" style="width:29px !important"><?php echo $sup->support_type; ?></div>
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
                <div class="user_field"><?php echo $sup->mention_others;  ?></div> 
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
							$fcchecked1 ="checked";
							$display= "none";
					}
				?>
            	<div class="user_txt txt_f"> أوجه دعم اخرى </div>
                <div class="user_field"><?php echo $fcchecked1; ?></div> 
            </div>
             <div class="form_raw yes_class_others face_others_support<?php echo $i; ?>" style="display:<?php echo $display; ?>;">
                <div class="user_field">اذكرها<?php echo $sup->face_others_support_text;  ?></div> 
              </div>
			  <div class="form_raw yes_class_others">
                <div class="user_field">تاريخ:<?php echo $sup->created;  ?></div> 
              </div>
          </div>
					
					<?php
					}
					?>
					    
					<?php
				}
			 ?>
			
			<h3>مشروح</h3>
			<div class="form_raw">		
			<div class="user_txt txt_f">مفتوح:</div>
                <div class="user_field "><input type="checkbox" name="parwa_open" id="parwa_open" value="1" onclick = "check_status(this)"/></div>
			</div>
			</div>
			<div class="form_raw parwa_open" style="display:none;">
                <div class="user_field ">نشاط متميز جدا<input type="radio" class="activty_type" name="activty_type" id="activty_type1" value="نشاط متميز جدا"  onclick="check_activity(this)" /></div>
				<div class="user_field ">نشاط  متميز<input type="radio" class="activty_type" name="activty_type" id="activty_type2" value="نشاط  متميز" onclick="check_activity(this)"/></div>
				<div class="user_field ">نشاط عادي<input type="radio" class="activty_type" name="activty_type" id="activty_type3" value="نشاط عادي" onclick="check_activity(this)"/></div>
				<div class="user_field ">يواجه صعوبات<input type="radio" class="activty_type" name="activty_type" id="activty_type4" value="يواجه صعوبات" onclick="check_activity(this)"/></div>
			</div>
			<div class="form_raw difficulties_details" style="display:none;">
				اذكرالصعوبات	
			<textarea id="difficulties" name="difficulties" style="width: 100%; height:100px;"></textarea>
			</div>
		<div class="form_raw">						
		<div class="user_txt txt_f"> مغلق :</div>
                <div class="user_field "><input type="checkbox" name="close_project" id="close_project" value="1" onclick = "check_status(this)"/></div>
			</div>
			<div class="form_raw close_project" style="display:none;">
                <div class="user_field ">نهائي <input type="radio" name="project_status" id="project_status" class="p_status" value="نهائي" onclick = "check_status2(this)" /></div>
				<div class="user_field ">ظرفي <input type="radio" name="project_status" id="project_status2" class="p_status" value="ظرفي" /></div>				
			</div>
			<div class="form_raw reason" style='display:none;'>
				الأسباب (ان وجدت) 
			<textarea id="reason_text" name="reason_text" style="width: 100%; height:100px;"></textarea>
			</div>
			</div>
         <h3>مقترحات صاحب المشروع لتخطي الصعوبات او تطوير الموسسة:</h3>
		<div class="form_raw">		
			<textarea id="ckeditor" name="project_propsel" style="width: 100%; height: 300px;"></textarea>
		</div>
		<h3>بطاقة تقييم مشروع</h3>
		  <?php
					$evaluate_data = $evaluate['0'];
					//print_r($evaluate_data);
		  ?>
		  <div class="form_raw">
					<table border="1" align="center" style="text-align:center;">
				  <tr><td colspan='4'>عناصر التقييم</td><td>العدد ( 0-5)</td><td>ملاحظات</td></tr>
				  <tr><td colspan='4'>موقع المشروع</td><td><input placeholder="موقع المشروع"  type="text"  name="evaluate_project_card" id="evaluate_project_card" class="NumberInput req ratings"   style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_project_card;  ?>" /></td><td><textarea name="project_card_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->project_card_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>اللوحات واللافتات التوجيهية الدالة على مقر المشروع</td><td><input  placeholder="اللوحات واللافتات التوجيهية الدالة على مقر المشروع"  type="text"  name="evaluate_paint_signs" class="NumberInput req ratings" id="evaluate_paint_signs" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_paint_signs;  ?>"/></td><td><textarea name="paint_signs_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->paint_signs_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>واجهة مقر المشروع</td><td><input  type="text" placeholder="واجهة مقر المشروع"  name="evaluate_interface_headquarter" id="evaluate_interface_headquarter" class="NumberInput req ratings" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_interface_headquarter;  ?>"/></td><td><textarea name="interface_headquarter_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->interface_headquarter_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>ملائمة المحل مع نشاط المشروع</td><td><input  type="text"  placeholder="ملائمة المحل مع نشاط المشروع" name="evaluate_convence_project" class="NumberInput req ratings" id="evaluate_convence_project" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_convence_project;  ?>"/></td><td><textarea name="convence_project_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->convence_project_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>نظافة المحل</td><td><input  type="text"  placeholder="نظافة المحل" name="evaluate_shop_cleanliness" id="evaluate_shop_cleanliness" class="NumberInput req ratings" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_shop_cleanliness;  ?>"/></td><td><textarea name="shop_cleanliness_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->shop_cleanliness_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>تنظيم المحل وتنظيم  الأجنحة والوحدات والبضائع داخله</td><td><input placeholder="تنظيم المحل وتنظيم  الأجنحة والوحدات والبضائع داخله"  type="text" class="NumberInput req ratings"  name="evaluate_organize_shop" id="evaluate_organize_shop" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_organize_shop;  ?>" /></td><td><textarea name="organize_shop_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->organize_shop_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>طريقة تخزين المنتجات والبضائع وتوفرها	</td><td><input  type="text" placeholder="طريقة تخزين المنتجات والبضائع وتوفرها"  name="evaluate_storage_products" class="NumberInput req ratings" id="evaluate_storage_products" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_storage_products;  ?>"/></td><td><textarea name="storage_products_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->storage_products_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>طريقة العرض والبيع/ مراحل ومسالك الإنتاج/ طريقة تقديم الخدمات</td><td><input placeholder="ريقة تقديم الخدمات"  type="text" class="NumberInput req ratings"  name="evaluate_sales_stages" id="evaluate_sales_stages" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_sales_stages;  ?>" /></td><td><textarea name="sales_stages_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->sales_stages_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>وسائل الدعاية المعتمدة</td><td><input  type="text"  placeholder="وسائل الدعاية المعتمدة" name="evaluate_advertise_method" class="NumberInput req ratings" id="evaluate_advertise_method" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_advertise_method;  ?>"/></td><td><textarea name="advertise_method_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->advertise_method_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>استقبال الزبائن والتعامل معهم</td><td><input  type="text" placeholder="استقبال الزبائن والتعامل معهم" class="NumberInput req ratings"  name="evaluate_receive_deal" id="evaluate_receive_deal" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_receive_deal;  ?>"/></td><td><textarea name="receive_deal_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->receive_deal_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>جودة الخدمة/ المنتج/ البضائع وتنوعها</td><td><input  type="text" placeholder="ائع وتنوعها" class="NumberInput req ratings"  name="evaluate_quality_service" id="evaluate_quality_service" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_quality_service;  ?>"/></td><td><textarea name="quality_service_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->quality_service_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>الأسعار المعتمدة</td><td><input  type="text" placeholder="الأسعار المعتمدة"  name="evaluate_support_price" class="NumberInput req ratings" id="evaluate_support_price" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_support_price;  ?>"/></td><td><textarea name="support_price_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->support_price_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>طريقة الترويج والتسويق</td><td><input  type="text" placeholder="طريقة الترويج والتسويق"  name="evaluate_method_promotion" class="NumberInput req ratings" id="evaluate_method_promotion" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td><td><textarea name="method_promotion_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->method_promotion_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>طريقة البيع (نقدا أو بالأجل)</td><td><input  type="text"  placeholder="طريقة البيع (نقدا أو بالأجل)"  class="NumberInput req ratings" name="evaluate_method_sale" id="evaluate_method_sale" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_method_sale;  ?>"/></td><td><textarea name="method_sale"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->method_sale;  ?></textarea></td></tr>
				  <tr><td colspan='4'>كيفية مجابهة المنافسة</td><td><input  type="text" placeholder="كيفية مجابهة المنافسة" class="NumberInput req ratings"  name="evaluate_cope_competition" id="evaluate_cope_competition" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_cope_competition;  ?>"/></td><td><textarea name="cope_competition_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->cope_competition_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>نوعية المعدات والتجهيزات</td><td><input  type="text" placeholder="نوعية المعدات والتجهيزات"   class="NumberInput req ratings" name="evaluate_quality_equipment" id="evaluate_quality_equipment" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_quality_equipment;  ?>"/></td><td><textarea name="quality_equipment_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->quality_equipment_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>المظهر العام لصاحب المشروع والعاملين معه</td><td><input placeholder="المظهر العام لصاحب المشروع والعاملين معه"   type="text" class="NumberInput req ratings" name="evaluate_appearance" id="evaluate_appearance" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) e//cho $evaluate_data->evaluate_appearance;  ?>"/></td><td><textarea name="appearance_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->appearance_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>احترام توقيت العمل</td><td><input  type="text" placeholder="احترام توقيت العمل"  class="NumberInput req ratings" name="evaluate_time" id="evaluate_time" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_time;  ?>"/></td><td><textarea name="time_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->time_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>طريقة تسيير للمشروع</td><td><input  type="text" placeholder="طريقة تسيير للمشروع" class="NumberInput req ratings" name="evaluate_conduct_product" id="evaluate_conduct_product" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_conduct_product;  ?>"/></td><td><textarea name="conduct_product_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->conduct_product_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>مسك الدفاتر المالية</td><td><input  type="text" placeholder="مسك الدفاتر المالية"placeholder="مسك الدفاتر المالية" class="NumberInput req ratings"  name="evaluate_keep_financial" id="evaluate_keep_financial" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_keep_financial;  ?>"/></td><td><textarea name="keep_financial_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->keep_financial_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>تمكن صاحب المشروع من نشاط مشروعه ومختلف مكوناته</td><td><input placeholder="تمكن صاحب المشروع من نشاط مشروعه ومختلف مكوناته"  type="text" class="NumberInput req ratings"  name="evaluate_enables_project_activity" id="evaluate_enables_project_activity" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_enables_project_activity;  ?>"/></td><td><textarea name="project_activity_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->project_activity_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>التعامل مع المزودين (نقدا أو بالأجل) وانتظام التزويد</td><td><input placeholder="التعامل مع المزودين (نقدا أو بالأجل) وانتظام التزويد"  type="text" class="NumberInput req ratings"  name="evaluate_supplier_cash_regularity " id="evaluate_supplier_cash_regularity" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_supplier_cash_regularity;  ?>"/></td><td><textarea name="supplier_cash_regularity_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->supplier_cash_regularity_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>معرفة السوق والحصة من السوق والوحدات المماثلة في نفس النشاط</td><td><input  placeholder="معرفة السوق والحصة من السوق والوحدات المماثلة في نفس النشاط" type="text" class="NumberInput req ratings"  name="evaluate_knowledge_market" id="evaluate_knowledge_market" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_knowledge_market;  ?>"/></td><td><textarea name="knowledge_market_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->knowledge_market_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>العلاقة بالمحيط والجهات التي يتعامل معها المشروع (العمومية والخاصة)</td><td><input placeholder="العلاقة بالمحيط والجهات التي يتعامل معها المشروع (العمومية والخاصة)"  type="text" class="NumberInput req ratings"  name="evaluate_ocean_realtionship" id="evaluate_ocean_realtionship" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_ocean_realtionship;  ?>"/></td><td><textarea name="ocean_realtionship_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->ocean_realtionship_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>تنمية شبكة علاقات وتحديثها</td><td><input placeholder="تنمية شبكة علاقات وتحديثها" type="text" class="NumberInput req ratings"  name="evaluate_network_upload" id="evaluate_network_upload" style="height: 80px;"value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_network_upload;  ?>" /></td><td><textarea name="network_upload_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->network_upload_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>القوى العاملة بالمشروع (العدد، الكفاءة، التدريب)</td><td><input placeholder="القوى العاملة بالمشروع (العدد، الكفاءة، التدريب)"  type="text" class="NumberInput req ratings"  name="evaluate_manpower_project" id="evaluate_manpower_project" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_network_upload;  ?>"/></td><td><textarea name="manpower_project_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->manpower_project_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>التأمينات الاجتماعية والتقاعد (صاحب المشروع والعمال والموظفين)</td><td><input  placeholder="التأمينات الاجتماعية والتقاعد (صاحب المشروع والعمال والموظفين)" type="text" class="NumberInput req ratings" name="evaluate_social_security" style="height: 80px;" id="evaluate_social_security" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_social_security;  ?>"/></td><td><textarea name="social_security_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->social_security_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>تأمين المحل والتجهيزات (الحوادث المهنية، السرقة، الحرائق، الكوارث،...)</td><td><input  placeholder="تأمين المحل والتجهيزات (الحوادث المهنية، السرقة، الحرائق، الكوارث،...)" type="text" class="NumberInput req ratings" name="evaluate_shop_equipment_insurance" style="height: 80px;" id="evaluate_shop_equipment_insurance" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_shop_equipment_insurance;  ?>"/></td><td><textarea name="shop_equipment_insurance"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->shop_equipment_insurance;  ?></textarea></td></tr>
				  <tr><td colspan='4'>احترام قواعد الصحة والسلامة المهنية والبيئة</td><td><input placeholder="احترام قواعد الصحة والسلامة المهنية والبيئة"  type="text" class="NumberInput req ratings" name="evaluate_respect_occupation" id="evaluate_respect_occupation" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_respect_occupation;  ?>"/></td><td><textarea name="respect_occupation_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->respect_occupation_text;  ?></textarea></td></tr>
				  <tr><td colspan='4'>آفاق تطوير المشروع</td><td><input  type="text" placeholder="آفاق تطوير المشروع" class="NumberInput req ratings" name="evaluate_prospects_development" id="evaluate_prospects_development" style="height: 80px;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->evaluate_prospects_development;  ?>"/></td><td><textarea name="prospects_development_development_text"><?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->prospects_development_development_text;  ?></textarea></td></tr>
				  <tr><td>المجموع</td><td><input  type="text" placeholder="المجموع" class="NumberInput req" name="totalrating" id="totalrating" style="width:100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data)) //echo $evaluate_data->totalrating;  ?>" readonly/></td><td>المتوسط: (مجموع/30)</td><td></td><td>التقييم</td><td id="taqem_html"></td></tr>
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
		  	<h2 style="text-align: center;">الشهر/التقييم  :<input type="text" name="month" id="month" value="<?php echo date('m/d/Y'); ?>">  </h2>
		  		<table border="1" align="center" style="text-align:center;width:100%;">
				<tr><td colspan='2'>المصروفات (ر.ع)</td><td colspan='2'>الإيرادات (ر.ع)</td></tr>
				<tr><td style="width: 37%;">مشتريات</td><td style="width: 12%;"><input  type="text" placeholder="مشتريات"  name="purchase" class="NumberInput req expence" id="purchase" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td><td rowspan='4' >إيراد</td><td rowspan='7' style="width:26%"><input  type="text" placeholder="إيراد"  name="manpower_project" class="NumberInput req income" id="manpower_project" style="width: 100%;height:100%" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>
				<tr><td  style="width: 37%;">راتب صاحب المشروع (بما في ذلك التأمينات الاجتماعية)</td><td style="width: 12%;"><input  type="text" placeholder="راتب صاحب المشروع (بما في ذلك التأمينات الاجتماعية)"  name="salary_project" class="NumberInput req expence" id="salary_project" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>
				<tr><td  style="width: 37%;">رواتب القوى العاملة بالمشروع (بما في ذلك التأمينات الاجتماعية)</td><td style="width: 12%;"><input  type="text" placeholder="راتب صاحب المشروع (بما في ذلك التأمينات الاجتماعية)"  name="manpower_project" class="NumberInput req expence" id="manpower_project" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>
				<tr><td   style="width: 37%;">إيجار</td><td style="width: 12%;"><input  type="text" placeholder="إيجار"  name="rent" class="NumberInput req expence" id="rent" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>
				<tr><td  style="width: 37%;">إنترنت</td><td style="width: 12%;"><input  type="text" placeholder="إنترنت"  name="expence" class="NumberInput req expence" id="expence" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td><td rowspan='3' >إيرادات أخرى متصلة بالمشروع	</td></tr>
				<tr><td  style="width: 37%;">كهرباء</td><td style="width: 12%;"><input  type="text" placeholder="كهرباء"  name="wire_expence" class="NumberInput req expence" id="wire_expence" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>
				<tr><td  style="width: 37%;">ماء</td><td style="width: 12%;"><input  type="text" placeholder="ماء"  name="water_expence" class="NumberInput req expence" id="water_expence" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>
				<tr><td  style="width: 37%;">هاتف</td><td style="width: 12%;"><input  type="text" placeholder="هاتف"  name="number_expence" class="NumberInput req expence" id="number_expence" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>
				<tr><td  style="width: 37%;">فاكس</td><td style="width: 12%;"><input  type="text" placeholder="فاكس"  name="fax_expence" class="NumberInput req expence" id="fax_expence" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>
				<tr><td  style="width: 37%;">خدمات مختلفة</td><td style="width: 12%;"><input  type="text" placeholder="خدمات مختلفة"  name="diffrent_services" class="NumberInput req expence" id="diffrent_services" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>
				<tr><td  style="width: 37%;">مصروفات أخرى متصلة بالمشروع</td><td style="width: 12%;"><input  type="text" placeholder="مصروفات أخرى متصلة بالمشروع"  name="other_expence" class="NumberInput req expence" id="other_expence" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>
				<tr><td style="width: 37%;">الإجمالي</td><td style="width: 12%;"><input  type="text" placeholder="الإجمالي"  name="total_expence" class="NumberInput req" id="total_expence" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td><td colspan='2'><input  type="text" placeholder="الإجمالي"  name="total_income" class="NumberInput req " id="total_income" style="width: 100%;" value="<?php if(isset($evaluate_data) && !empty($evaluate_data))// echo $evaluate_data->evaluate_method_promotion;  ?>"/></td></tr>				
			</table>
		  </div>
		  		  <div class="form_raw">
		  صافي الدخل الشهري للمشروع   =  <span id="tt2"></span>- <span id="tt"></span>        =       <span id="tt3"></span>      ريال عماني
		  </div>
		  <div class="form_raw">
		  صافي الأرباح الشهرية   =             <span><input type="text" id="tt5" /></span>-   <span id="tt4"></span>              =<span id="tt6">              ريال عماني  
		  
		  </div>
		  
		  <h3>رأي المتابـــع:</h3>
		<div class="form_raw">		
			<textarea id="ckeditor2" name="observe_view" style="width: 100%; height: 300px;"></textarea>
		</div>
	
		   </div>
          
            </div>
  
            </div>

          </div>

        </div>

      </div>
      
        
    </form>