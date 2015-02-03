<div id="non-printable">
<?php $type_name	=	$this->inq->get_type_name($applicatn_info->applicant_marital_status);?>
<?php $privince		=	$this->inq->get_province_name($applicatn_info->province);?>
<?php $wilayats		=	$this->inq->get_wilayats_name($applicatn_info->walaya);?>
<?php $phone		=	$this->inq->applicant_phone_number($applicatn_info->applicant_id);?>
<?php $tab_1		=	$this->inq->get_tab_data('applicant_qualification',$applicatn_info->applicant_id);?>
<?php $tab_2		=	$this->inq->get_tab_data('applicant_professional_experience',$applicatn_info->applicant_id);?>
<?php $tab_3		=	$this->inq->get_tab_data('applicant_businessrecord',$applicatn_info->applicant_id);?>
<?php $professional	=	$this->inq->getRequestInfo($applicatn_info->applicant_id);?>
<?php //echo '<pre>'; print_r($applicatn_info);?>
<?php //echo '<pre>'; print_r($phone);?>
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
</div>
<div id="printable">
<table class="gridtable">
  <tr>
    <td>رقم التسجيل</td>
    <td><?php echo applicant_number($applicatn_info->applicant_id);?></td>
  </tr>
  <tr>
    <td>اسم مقدم الطلب</td>
    <td><?php echo $applicatn_info->applicant_first_name.' '.$applicatn_info->applicant_middle_name.' '.$applicatn_info->applicant_last_name.' '.$applicatn_info->applicant_sur_name;?></td>
  </tr>
  <tr>
    <td>طبيعة المراجعين</td>
    <td><?php  echo $applicatn_info->applicant_type;?></td>
  </tr>
  <tr>
    <td>النوع</td>
    <td><?php  echo $applicatn_info->applicant_gender;?></td>
  </tr>
  <tr>
    <td>رقم البطاقة الشخصية</td>
    <td><?php  echo $applicatn_info->appliant_id_number;?></td>
  </tr>
  <tr>
    <td>تاريخ الميلاد</td>
    <td><?php echo $applicatn_info->applicant_date_birth; ?></td>
  </tr>
    <?php if(!empty($phone)):?>
    <tr>
    <td>رقم الهاتف</td>
    <td>
	<?php foreach($phone as $ph):?>
    	<?php echo $ph->applicant_phone.'<br>';?>
    <?php endforeach;?>
    </td>
  </tr>
  <tr>
    <td>الحالة الاجتماعية</td>
    <td><?php echo $this->inq->get_type_name($applicatn_info->applicant_marital_status); ?></td>
  </tr>
  <tr>
    <td>الوضع الحالي</td>
    <td><?php echo $this->inq->get_type_name($applicatn_info->applicant_job_staus); ?></td>
  </tr>
  <tr>
    <td>فئة الظمان الإجتماعي</td>
    <td>
    <?php if($applicatn_info->option1	==	'Y'):?>
		<?php echo $applicatn_info->option_txt; ?>
      <?php else:?>
      	<?php echo 'لا'; ?>
    <?php endif;?>
    </td>
  </tr>
  <tr>
   <td>فئة من ذوي الإعاقة</td>
     <td>
      <?php if($applicatn_info->option2	==	'Y'):?>
		<?php echo 'نعم'; ?>
      <?php else:?>
      	<?php echo 'لا'; ?>
    <?php endif;?>
    </td>
   </tr>
   <tr>
    <td colspan="2"><h3>العنوان الشخصي</h3></td>
  </tr>
  <?php if($privince):?>
  <tr>
    <td>محافظة</td>
    <td><?php  echo $privince;?></td>
  </tr>
  <?php endif;?>
  <?php if($wilayats):?>
  <tr>
    <td>الولاية</td>
    <td><?php  echo $wilayats;?></td>
  </tr>
  <?php endif;?>

  <tr>
    <td>القرية</td>
    <td><?php echo $applicatn_info->village; ?></td>
  </tr>
  <tr>
    <td>السكة</td>
    <td><?php echo $applicatn_info->way; ?></td>
  </tr>
  <tr>
    <td>المنزل/المبني</td>
    <td><?php echo $applicatn_info->home; ?></td>
  </tr>
  <tr>
    <td>الشقة</td>
    <td><?php echo $applicatn_info->deparment; ?></td>
  </tr>
  <tr>
    <td>ص.ب</td>
    <td><?php echo $applicatn_info->zipcode; ?></td>
  </tr>
  <tr>
    <td>ر.ب</td>
    <td><?php echo $applicatn_info->postalcode; ?></td>
  </tr>
  <tr>
    <td>رقم سجل القوى العاملة</td>
    <td><?php echo $applicatn_info->applicant_cr_number; ?></td>
  </tr>
  <tr>
    <td>الهاتف الثابت</td>
    <td><?php echo $applicatn_info->linephone; ?></td>
  </tr>
  <tr>
    <td>الفاكس</td>
    <td><?php  echo $applicatn_info->fax;?></td>
  </tr>
  <tr>
    <td>البريد الإلكتروني</td>
    <td><?php  echo $applicatn_info->email;?></td>
  </tr>
  <tr>
    <td>هاتف نقال أحد الأقارب</td>
    <td><?php  echo $applicatn_info->refrence_number;?></td>
  </tr>
  <tr>
    <td colspan="2"><h3>المؤهلات</h3></td>
  </tr>
  <tr>
    <td colspan="2"><strong>1/ المستوى الدراسي</strong></td>
  </tr>
  <tr>
    <td>المؤهل</td>
    <td><?php echo $this->inq->get_type_name($applicatn_info->applicant_qualification);?></td>
  </tr>
  <tr>
    <td>التخصص</td>
    <td><?php  echo $applicatn_info->applicant_specialization;?></td>
  </tr>
  <tr>
    <td>الجهة</td>
    <td><?php echo $this->inq->get_type_name($applicatn_info->applicant_institute);?></td>
  </tr>
  <tr>
    <td>سنة التخرج</td>
    <td><?php  echo $applicatn_info->applicant_institute_year;?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>2/ التدريب المهني</strong></td>
  </tr>
  <tr>
    <td>مركز التدريب</td>
    <td><?php echo $applicatn_info->applicant_institute;?></td>
  </tr>
  <tr>
    <td>التخصص</td>
    <td><?php  echo $applicatn_info->applicant_specializations;?></td>
  </tr>
  <tr>
    <td>مدة التدريب (بالأشهر)</td>
    <td><?php echo $applicatn_info->applicant_training_month;?></td>
  </tr>
  <tr>
    <td>شهادة التدريب المهني المتحصل عليها</td>
    <td><?php  echo $applicatn_info->applicant_vtco;?></td>
  </tr>
  <tr>
    <td>سنة الحصول على الشهادة</td>
    <td><?php  echo $applicatn_info->applicant_ytotc;?></td>
  </tr>
  <tr>
    <td> دورات تدريبية ميدانية أخرى</td>
    <td><?php  echo $applicatn_info->applicant_other_trainning;?></td>
  </tr>
  <tr>
    <td>دورات التدريب المتخصصة قبل إقامة المشروع</td>
    <td><?php  echo $applicatn_info->applicant_other_specializations;?></td>
  </tr>
  <?php endif;?>
  
   	<?php if(!empty($professional['applicant_partners'])):?>
    
    <?php 
	//echo "<pre>";
	//print_r($professional['applicant_partners']);
	
	foreach($professional['applicant_partners'] as $partners):?>
    <?php
	//mobile_number
	//echo "<pre>";
	//print_r($partners);
	
	
	//echo $partners->mobile_number;
	//	exit;
	?>
<tr>
	<td colspan="2"><h3>مشترك</h3></td>
</tr>
  <tr>
    <td>اسم مقدم الطلب</td>
    <td><?php echo $partners->partner_first_name.' '.$partners->partner_middle_name.' '.$partners->partner_last_name.' '.$partners->partner_sur_name;?></td>
  </tr>
  <tr>
    <td>النوع</td>
    <td><?php  echo $partners->partner_gender;?></td>
  </tr>
  <tr>
    <td>رقم البطاقة الشخصية</td>
    <td><?php  echo $partners->partner_id_number;?></td>
  </tr>
  <?php endforeach;?>
  <?php endif;?>
      <?php 
	  
	  //print_r($phone1);
	  if(!empty($phone1)):?>
    <tr>
    <td>رقم الهاتف</td>
    <td>
	<?php 
	//echo $partners->mobile_number.'<br>';
	foreach($phone as $ph):?>
    	<?php echo $ph->applicant_phone.'<br>';?>
    <?php endforeach;?>
    </td>
  </tr>
  <?php endif;?>

  <tr>
    <td>المرحلة</td>
    <td><?php if($applicatn_info->form_step	==	'1'): echo 'تسجيل الطلبات'; endif;?>
      <?php if($applicatn_info->form_step	==	'2'): echo 'بيانات المشروع'; endif;?>
      <?php if($applicatn_info->form_step	==	'3'): echo 'القرض المطلوب'; endif;?>
      <?php if($applicatn_info->form_step	==	'4'): echo 'دراسه وتحليل الطلب'; endif;?></td>
  </tr>
  <tr>
    <td>رقم بطاقة سجل القوى العاملة</td>
    <td><?php echo $partners->applicant_cr_number; ?></td>
  </tr>
  <?php if(!empty($phone)):?>
  <tr>
    <td>رقم الهاتف</td>
    <td><?php 
	echo $partners->mobile_number;	
	foreach($phone as $ph):?>
      <?php echo $ph->phonenumber.'<br>';?>
      <?php endforeach;?></td>
  </tr>
  <?php endif;?>
  <tr>
    <td>تاريخ الميلاد</td>
    <td><?php echo $partners->partner_date_birth; ?></td>
  </tr>
  <tr>
    <td>الحالة الاجتماعية</td>
    <td><?php echo $this->inq->get_type_name($partners->partner_marital_status); ?></td>
  </tr>
  <tr>
    <td>الوضع الحالي</td>
    <td><?php echo $this->inq->get_type_name($partners->partner_job_staus); ?></td>
  </tr>
  <tr>
    <td>فئة الظمان الإجتماعي</td>
    <td>
    <?php if($partners->option1	==	'Y'):?>
		<?php echo $partners->option_txt; ?>
      <?php else:?>
      	<?php echo 'لا'; ?>
    <?php endif;?>
    </td>
  </tr>
  <tr>
   <td>فئة من ذوي الإعاقة</td>
     <td>
      <?php if($applicatn_info->option2	==	'Y'):?>
		<?php echo 'نعم'; ?>
      <?php else:?>
      	<?php echo 'لا'; ?>
    <?php endif;?>
    </td>
   </tr> 
  <tr>
    <td colspan="2"><h3>العنوان الشخصي</h3></td>
  </tr>
  <?php if($privince):?>
  <tr>
    <td>محافظة</td>
    <td><?php  echo $privince;?></td>
  </tr>
  <?php endif;?>
  <?php if($wilayats):?>
  <tr>
    <td>الولاية</td>
    <td><?php  echo $wilayats;?></td>
  </tr>
  <?php endif;?>

  <tr>
    <td>القرية</td>
    <td><?php echo $partners->village; ?></td>
  </tr>
  <tr>
    <td>السكة</td>
    <td><?php echo $partners->way; ?></td>
  </tr>
  <tr>
    <td>المنزل/المبني</td>
    <td><?php echo $partners->home; ?></td>
  </tr>
  <tr>
    <td>الشقة</td>
    <td><?php echo $partners->deparment; ?></td>
  </tr>
  <tr>
    <td>ص.ب</td>
    <td><?php echo $partners->zipcode; ?></td>
  </tr>
  <tr>
    <td>ر.ب</td>
    <td><?php echo $partners->postalcode; ?></td>
  </tr>
  <tr>
    <td>رقم سجل القوى العاملة</td>
    <td><?php echo $partners->applicant_cr_number; ?></td>
  </tr>
  <tr>
    <td>الهاتف الثابت</td>
    <td><?php echo $partners->linephone; ?></td>
  </tr>
  <tr>
    <td>الفاكس</td>
    <td><?php  echo $partners->fax;?></td>
  </tr>
  <tr>
    <td>البريد الإلكتروني</td>
    <td><?php  echo $partners->email;?></td>
  </tr>
  <tr>
    <td>هاتف نقال أحد الأقارب</td>
    <td><?php  echo $partners->refrence_number;?></td>
  </tr>
  <tr>
    <td colspan="2"><h3>المؤهلات</h3></td>
  </tr>
  <tr>
    <td colspan="2"><strong>1/ المستوى الدراسي</strong></td>
  </tr>
  <tr>
    <td>المؤهل</td>
    <td><?php echo $this->inq->get_type_name($partners->partner_qualification);?></td>
  </tr>
  <tr>
    <td>التخصص</td>
    <td><?php  echo $partners->partner_specialization;?></td>
  </tr>
  <tr>
    <td>الجهة</td>
    <td><?php echo $this->inq->get_type_name($partners->partner_institute);?></td>
  </tr>
  <tr>
    <td>سنة التخرج</td>
    <td><?php  echo $partners->partner_institute_year;?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>2/ التدريب المهني</strong></td>
  </tr>
  <tr>
    <td>مركز التدريب</td>
    <td><?php echo $partners->partner_institute;?></td>
  </tr>
  <tr>
    <td>التخصص</td>
    <td><?php  echo $partners->partner_specializations;?></td>
  </tr>
  <tr>
    <td>مدة التدريب (بالأشهر)</td>
    <td><?php echo $partners->partner_training_month;?></td>
  </tr>
  <tr>
    <td>شهادة التدريب المهني المتحصل عليها</td>
    <td><?php  echo $partners->partner_vtco;?></td>
  </tr>
  <tr>
    <td>سنة الحصول على الشهادة</td>
    <td><?php  echo $partners->partner_ytotc;?></td>
  </tr>
  <tr>
    <td> دورات تدريبية ميدانية أخرى</td>
    <td><?php  echo $partners->partner_other_trainning;?></td>
  </tr>
  <tr>
    <td>دورات التدريب المتخصصة قبل إقامة المشروع</td>
    <td><?php  echo $partners->partner_other_specializations;?></td>
  </tr>
</table>

<table width="100%">
  <tbody>
    <tr>
    <td colspan="2"><h3>الخبرة المهنية</h3></td>
  </tr>
    <tr>
      <td colspan="2" class="td_text_head">الخبرة في نفس نشاط المشروع</td>
    </tr>
    <tr>
      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tbody>
            <tr>
              <td colspan="5" height="5px;"></td>
            </tr>
            <tr>
              <td class="td_text_data center">تاريخ بداية المشروع</td>
              <td class="td_text_data center">اسم الجهة/المؤسسة/ المشروع الخاص</td>
              <td class="td_text_data center">نشاط الجهة/المؤسسة/ المشروع الخاص</td>
              <td class="td_text_data center">المهنة المزاولة بالجهة/المؤسسة/ المشروع الخاص</td>
              <td class="td_text_data center">عدد سنوات الخبرة</td>
            </tr>
            
            
            <?php //echo '<pre>'; print_r($professional['applicant_professional_experience']);?>
            
             <?php if(!empty($professional['applicant_professional_experience'])):?>
             <?php $counter	=	'1';?>
				<?php foreach($professional['applicant_professional_experience'] as $tab):?>
                <?php if($counter <= '3'):?>
            <tr>
              <td><input type="text" value="<?php echo $tab->option_one;?>" class="txt_field xx NumberInput dateinput hasDatepicker" readonly="readonly"></td>
              <td><input name="option_two[]" type="text" value="<?php echo $tab->option_two;?>" class="txt_field xx " readonly="readonly"></td>
              <td><input type="text" value="<?php echo $tab->option_three;?>" class="txt_field xx NumberInput" readonly="readonly"></td>
              <td><input type="text" value="<?php echo $tab->option_four;?>" class="txt_field xx NumberInput" readonly="readonly"></td>
              <td><input type="text" value="<?php echo $tab->option_five;?>" class="txt_field xx NumberInput" readonly="readonly"></td>
            </tr>
                        <?php endif;?>
             <?php $counter	++;?>
                            <?php endforeach;?>
            <?php endif;?>
            

          </tbody>
        </table></td>
    </tr>
    <tr>
      <td colspan="2" class="td_text_head">الخبرة في أنشطة أخرى</td>
    </tr>
    <tr>
      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tbody>
            <tr>
              <td colspan="5" height="5px;"></td>
            </tr>
            <tr>
              <td class="td_text_data center">تاريخ بداية المشروع</td>
              <td class="td_text_data center">اسم الجهة/المؤسسة/ المشروع الخاص</td>
              <td class="td_text_data center">نشاط الجهة/المؤسسة/ المشروع الخاص</td>
              <td class="td_text_data center">المهنة المزاولة بالجهة/المؤسسة/ المشروع الخاص</td>
              <td class="td_text_data center">عدد سنوات الخبرة</td>
            </tr>
             <?php if(!empty($professional['applicant_professional_experience'])):?>
                <?php $counter	=	'1';?>
				<?php foreach($professional['applicant_professional_experience'] as $tab):?>
                <?php if($counter <= '3'):?>
                <tr>
              <td><input type="text" value="<?php echo $tab->activities_one;?>" class="txt_field xx NumberInput dateinput hasDatepicker" readonly="readonly"></td>
              <td><input type="text" value="<?php echo $tab->activities_two;?>" class="txt_field xx " readonly="readonly"></td>
              <td><input type="text" value="<?php echo $tab->activities_three;?>" class="txt_field xx NumberInput" readonly="readonly"></td>
              <td><input type="text" value="<?php echo $tab->activities_four;?>" class="txt_field xx NumberInput" readonly="readonly"></td>
              <td><input type="text" value="<?php echo $tab->activities_five;?>" class="txt_field xx NumberInput" readonly="readonly"></td>
            </tr>
            <?php endif;?>
             <?php $counter	++;?>
             
              <?php endforeach;?>
            <?php endif;?>
            
            <tr>
              <td colspan="5" height="5px;"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
<table width="100%">
  <tbody>
      <tr>
    <td colspan="2"><h3>السجلات التجارية الأخرى</h3></td>
  </tr>
    <tr>
      <td colspan="2" class="td_text_head">الخبرة في نفس نشاط المشروع</td>
    </tr>
    <tr>
      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tbody>
            <tr>
              <td colspan="4" height="5"></td>
            </tr>
            <tr>
              <td class="td_text_data center">اسم السجل</td>
              <td class="td_text_data center">رقم السجل</td>
              <td class="td_text_data center">عدد القوى العاملة الوطنية</td>
              <td class="td_text_data center">عدد القوى العاملة الوافدة</td>
            </tr>
            <?php if(!empty($professional['applicant_businessrecord'])):?>
				<?php foreach($professional['applicant_businessrecord'] as $tab):?>
                <tr>
              <td><input type="text" value="<?php echo $tab->activity_name;?>" class="txt_field xx NumberInput dateinput hasDatepicker" readonly="readonly"></td>
              <td><input type="text" value="<?php echo $tab->activity_registration_no;?>" class="txt_field xx " readonly="readonly"></td>
              <td><input type="text" value="<?php echo $tab->activity_nationalmanpower;?>" class="txt_field xx NumberInput" readonly="readonly"></td>
              <td><input type="text" value="<?php echo $tab->activity_laborforce;?>" class="txt_field xx NumberInput" readonly="readonly"></td>
            </tr>
               <?php endforeach;?>
            <?php endif;?>
            <tr>
              <td colspan="4" height="5"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</div>
