<div id="non-printable">
<?php 
	//echo "<pre>";
	//print_r($main_info);
	
	$inq_detail = $this->inq->getLastDetail($main_info->tempid);
	$main_detail = $inq_detail['main'];
	$applicant = $main_detail->applicant;
	//echo "<pre>";
	//print_r($applicant);
	$user_detail	=	$this->inq->get_user_name($main_info->tempid);?>
<?php $gender		=	$this->inq->get_gender($main_info->tempid);?>
<?php $phone		=	$this->inq->get_phone_number($main_info->tempid);?>
<?php $notes		=	$this->inq->get_notes($main_info->tempid);?>
<?php $privince		=	$this->inq->get_province_name($main_info->province);?>
<?php $wilayats		=	$this->inq->get_wilayats_name($main_info->walaya);?>
<?php $user_name	=	$this->inq->get_user_name_of_added($main_info->userid);?>
<?php 

$data			=	$this->inq->get_last_note($main_info->tempid);



//echo '<pre>'; print_r($phone);

$user_name_last_added	=	$this->inq->get_user_name_of_added($data->userid);



if($data->inquerytype)

{

	$data->userid;

	$type_string	=	rtrim($data->inquerytype,',');

	$types_array 	=	explode(",", $type_string);

	$array_size		=	sizeof($types_array);

	

	if($array_size > 0)

	{

		$last_arry_key	=	end(array_keys($types_array));

		

		$last_array		=	$types_array[$last_arry_key] ;

		

		$type_id		=	explode("_", $last_array);

		

		$type_name	=	$this->inq->get_type_name($type_id['0']);

	}

	

}



?>
<style type="text/css">
table.gridtable {
	border-width: 1px !important;
	border-color: #F7F7F7 !important;
	font-size: 12px !important;
}
</style>
<?php $all_data		=	$this->inq->getLastDetail($main_info->tempid);?>
</div>
<div id="printable">
<table class="gridtable" style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
  <tr>
    <td>رقم</td>
    <td><?php echo arabic_date($main_detail->tempid_value); ?></td>
  </tr>
  <?php $counter	=	'1';

 // 	echo "<pre>";

  //	print_r($all_data['main']);

  ?>
  <?php foreach($all_data['main']->applicant as $list_data):?>
  <tr>
    <td>طبيعة المراجعين</td>
    <td><?php echo $all_data['main']->user_type;?></td>
  </tr>
  <?php if($counter == '2'){ echo '<tr><td colspan="2"><h3>مشترك</h3></td></tr>';}?>
  <tr>
    <td>الاسم</td>
    <td><?php echo $list_data->first_name.' '.$list_data->middle_name.' '.$list_data->last_name.' '.$list_data->family_name;?></td>
  </tr>
  <tr>
    <td>النوع</td>
    <td><?php echo $list_data->applicanttype;?></td>
  </tr>
  <tr>
    <td>رقم البطاقة الشخصية</td>
    <td><?php  echo arabic_date($list_data->idcard);?></td>
  </tr>
  
  <tr>
    <td>هل مسجل في التأمينات الإجتماعية؟</td>
    <td><?php   if($all_data['main']->is_insurance == 'Y') { echo 'نعم '; } else { echo 'لا '; }?></td>
  </tr>
  <tr>
    <td>رقم التسجيل</td>
    <td><?php   if($all_data['main']->is_insurance == 'Y') { echo $all_data['main']->insurance_number; }?></td>
  </tr>
 <tr>
    <td>هل لديك مشروع؟</td>
    <td><?php   if($all_data['main']->confirmation == 'Y') { echo 'نعم '; } else { echo 'لا '; }?></td>
  </tr>
  <tr>
    <td>اسم المشروع</td>
    <td><?php   if($all_data['main']->confirmation == 'Y') { echo $all_data['main']->project_name; }?></td>
  </tr>
  <tr>
    <td>المكان</td>
    <td><?php  if($all_data['main']->confirmation == 'Y') { echo $all_data['main']->project_location; }?></td>
  </tr>
  <tr>
    <td>نشاط المشروع</td>
    <td><?php   if($all_data['main']->confirmation == 'Y') { echo $all_data['main']->project_activities; }?></td>
  </tr>
   <tr>
    <td>الحالة الاجتماعية</td>
    <td><?php echo $this->inq->get_type_name($list_data->marital_status); ?></td>
  </tr>
  <tr>
    <td>الوضع الحالي</td>
    <td><?php echo  $this->inq->get_type_name($list_data->job_status);  ?></td>
  </tr>
	<tr>
  	<td><?php  if($applicant->job_status_text !="") echo $applicant->job_status_text;  if($all_data['main']->other_value !="") echo $all_data['main']->other_value;?></td>
  </tr>
  <tr>
    <td>الاسم التجاري</td>
    <td><?php  if($all_data['main']->confirmation == 'Y') { echo $all_data['main']->project_cr_name; }?></td>
  </tr>
  
  <tr>
    <td>هل سبق لك الحصول على قرض للمشروع؟</td>
    <td><?php  if($all_data['main']->is_loan == 'Y') { echo 'نعم '; } else { echo 'لا '; } ?></td>
  </tr>
  <?php  if($all_data['main']->is_loan == 'Y') { ?>
  <tr>
    <td>&nbsp;</td>
    <td><strong>
    <?PHP if($all_data['main']->is_bank_loan=='1') { echo 'بنك التنمية العماني'; } else {} ?>
    <?PHP if($all_data['main']->is_rafd_loan=='1') { echo 'صندوق شراكة'; } else {} ?>
    <?PHP if($all_data['main']->is_commercial_loan=='1') { echo 'بنك تجاري'; } else {} ?>
    <?PHP if($all_data['main']->is_other_loan=='1') { echo 'اخرى'; } else {} ?>
    </strong>
    </td>
  </tr>
  <?PHP } ?>
  <tr>
    <td>رقم الهاتف</td>
    <td><?php foreach($all_data['main']->phones[$list_data->applicantid] as $phone):?>
      <?php echo arabic_date($phone->phonenumber);?>
      <?php endforeach;?></td>
  </tr>
  <?php $counter++;?>
  <?php endforeach; ?>
  <tr>
    <td colspan="2"></td>
  </tr>
  <?php if($type_name):?>
  <tr>
    <td>التغييرات الأخيرة</td>
    <td><?php echo $type_name;?></td>
  </tr>
  <?php endif;?>
  <?php if($main_info->mr_number):?>
  <tr>
    <td>رقم بطاقة سجل القوى العاملة</td>
    <td><?php  echo $main_info->mr_number;?></td>
  </tr>
  <?php endif;?>
  <?php if($main_info->datepicker):?>
  <tr>
    <td>تاريخ الميلاد</td>
    <td><?php  echo arabic_date($main_info->datepicker);?></td>
  </tr>
   <tr>
    <td>عمر</td>
    <td><?PHP echo arabic_date(ageCalculator($main_info->datepicker)); ?></td>
  </tr>
  <?php endif;?>
  <?php if($privince):?>
  <tr>
    <td>العنوان الشخصي</td>
    <td><?php  echo $privince;?></td>
  </tr>
  <?php endif;?>
  <?php if($wilayats):?>
  <tr>
    <td>الولاية</td>
    <td><?php  echo $wilayats;?></td>
  </tr>
  <?php endif;?>
  <?php if($type_name):?>
  <tr>
    <td>نوع الاستفسار</td>
    <td><?php  echo $type_name;?></td>
  </tr>
  <?php endif;?>
  
  <!-- ----------------------------------------------------------------------------------------- -->
  
  <?php if($main_info->inquiry_text):?>
  <tr>
    <td>نوع الاستفسار</td>
    <td><?php  echo $main_info->inquiry_text;?></td>
  </tr>
  <?php endif;?>
  <?php if($notes->notestext):?>
  <tr>
    <td>ملاحظات</td>
    <td><?php  echo $notes->notestext;?></td>
  </tr>
  <?php endif;?>
  
  <!-- ----------------------------------------------------------------------------------------- -->
  
  <?php if($main_info->applicantdate):?>
  <tr>
    <td>تاريخ التسجيل</td>
    <td><?php  echo arabic_date($main_info->applicantdate);?></td>
  </tr>
  <?php endif;?>
  <?php if($main_info->applicantdate):?>
  <tr>
    <td colspan="2"><?php echo $type_name;?> أخر  تعديل بواسطة <strong style="color:#F00;">
      <?php  echo $user_name_last_added->firstname." ".$user_name_last_added->lastname;?>
      </strong></td>
  </tr>
  <?php endif;?>
</table>
</div>
