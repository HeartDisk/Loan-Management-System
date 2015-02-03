<?PHP
	$mustarik = '_'.$evo;
	$mqm = $this->inq->getPartnerInfo($aid,$evo);

	$p = $mqm['partners'];
	//echo "<pre>";
	//print_r($p);
	 $p->parnter_id;	
	$ape = $mqm['ape'];
	$apb = $mqm['apb'];
	
?>
    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>

<div class="data_raw">
  <div class="data">
    <div class="main_data">    
      <div class="applicant">
        <div class="form_raw">
          <div class="user_txt">الاسم الأول</div>
          <div class="user_field">
          <input type="hidden" name="partner_id<?PHP echo $mustarik; ?>" id="partner_id<?PHP echo $mustarik; ?>"  value="<?php $p->parnter_id; ?>"/>
            <input name="partner_first_name<?PHP echo $mustarik; ?>" value="<?PHP  if(isset($type) && $type != "inquiry") { echo $p->partner_first_name; } else{ if(isset($type) && $type == "inquiry") { echo $p->first_name; } } ?>" placeholder="الاسم الأول" id="partner_first_name<?PHP echo $mustarik; ?>" type="text" class="txt_field ">
          </div>
          <div class="user_txt" style="margin-right: 11px;">الاسم الثاني</div>
          <div class="user_field">
            <input name="partner_middle_name<?PHP echo $mustarik; ?>" value="<?PHP if(isset($type) && $type != "inquiry") { echo $p->partner_middle_name; } else{ if(isset($type) && $type == "inquiry") { echo  $p->middle_name; } } ?>" placeholder="الاسم الثاني" id="partner_middle_name<?PHP echo $mustarik; ?>" type="text" class="txt_field ">
          </div>
        </div>
        <div class="form_raw">
          <div class="user_txt">الاسم الثالث</div>
          <div class="user_field">
            <input name="partner_last_name<?PHP echo $mustarik; ?>" value="<?PHP  if(isset($type) && $type != "inquiry") { echo $p->partner_last_name; } else{ if(isset($type) && $type == "inquiry") { echo  $p->last_name; } } ?>" placeholder="الاسم الثالث" id="partner_last_name<?PHP echo $mustarik; ?>" type="text" class="txt_field ">
          </div>
          <div class="user_txt" style="margin-right: 11px;">القبيلة / العائلة</div>
          <div class="user_field">
            <input name="partner_sur_name<?PHP echo $mustarik; ?>" value="<?PHP  if(isset($type) && $type != "inquiry") { echo $p->partner_sur_name; } else{ if(isset($type) && $type == "inquiry") { echo  $p->family_name; } }  ?>" placeholder="القبيلة / العائلة" id="partner_sur_name<?PHP echo $mustarik; ?>" type="text" class="txt_field">
          </div>
        </div>
        <div class="form_raw">
          <div class="user_txt">النوع</div>
          <div class="user_field">
            <label class="radio-inline">
              <input type="radio" <?PHP if(isset($type) && $type != "inquiry") { if($p->partner_gender=='ذكر') { ?> checked="checked" <?PHP } } else{ if(isset($type) && $type == "inquiry") { if($p->applicanttype=='ذكر') { ?> checked="checked" <?PHP } } }  ?>  name="partner_gender<?PHP echo $mustarik; ?>" value="ذكر" id="partner_gender<?PHP echo $mustarik; ?>"/>
              ذكر </label>
            <label class="radio-inline">
              <input type="radio" <?PHP if(isset($type) && $type != "inquiry") { if($p->partner_gender=='أنثى') { ?> checked="checked" <?PHP } } else{ if(isset($type) && $type == "inquiry") { if($p->applicanttype=='أنثى') { ?> checked="checked" <?PHP } } } ?>  name="partner_gender<?PHP echo $mustarik; ?>" value="أنثى" id="partner_gender<?PHP echo $mustarik; ?>"/>
              أنثى </label>
          </div>
        </div>
        <div class="form_raw">
          <div class="user_txt">رقم البطاقة الشخصية</div>
          <div class="user_field">
            <input name="partner_id_number<?PHP echo $mustarik; ?>"  value="<?PHP  if(isset($type) && $type != "inquiry") { echo $p->partner_id_number; } else{ if(isset($type) && $type == "inquiry") { echo  $p->partner_id_number; } }  ?>" id="partner_id_number<?PHP echo $mustarik; ?>" placeholder="رقم البطاقة الشخصية" type="text" class="txt_field NumberInput">
          </div>
        </div>
        <div class="form_raw" id="hatfi<?PHP echo $evo;?>">
          <div class="user_txt">رقم الهاتف</div>
          <div class="user_field" id="phonexnumbers">
            <?php
				  	if(isset($type) && $type != "inquiry") { 
					?>
            <input name="phone_numbers<?PHP echo $mustarik; ?>[]" value="<?PHP echo $partner_phones[0]->partner_phone; ?>"  type="text" class="txt_field NumberInput p_number" id="phonenumber<?PHP echo $mustarik; ?>" placeholder="رقم الهاتف" maxlength="8">
            <?php
					} 
					else{
						?>
            <input name="phone_numbers<?PHP echo $mustarik; ?>[]" value="<?PHP echo $phones[$p->applicantid][0]->phonenumber; ?>"  type="text" class="txt_field NumberInput p_number" id="phonenumber<?PHP echo $mustarik; ?>" placeholder="رقم الهاتف" maxlength="8">
            <?php
					}
				  ?>
            <!--
                    <input type="button" data-table="hatfi" class="addpartnerphone" id="addnewphone" value="" />--> 
            <a  data-table="hatfi<?PHP echo $evo;?>" class="addpartnerphone2" data-calc="<?PHP echo $evo;?>" id="addnewphone" href="javascript:void(0)"><img src="<?php echo base_url(); ?>images/addnewphone.png"  width="30"/></a> </div>
        </div>
      </div>
      <div class="personal" id="personal2">
        <div class="form_raw">
          <div class="user_txt">رقم سجل القوى العاملة</div>
          <div class="user_field">
            <input name="partner_cr_number<?PHP echo $mustarik; ?>" id="partner_cr_number<?PHP echo $mustarik; ?>" value="<?PHP if(isset($type) && $type != "inquiry") { echo $p->partner_cr_number; } else { echo $main['main']->mr_number; }  ?>" placeholder="رقم سجل القوى العاملة" type="text" class="txt_field NumberInput">
          </div>
        </div>
        <div class="form_raw">
          <div class="user_txt">تاريخ الميلاد</div>
          <div class="user_field">
            <input name="partner_date_birth<?PHP echo $mustarik; ?>" data-bingo="<?PHP echo $mustarik; ?>" type="text"  value="<?PHP echo date('Y-m-d',strtotime($p->partner_date_birth)); ?>" class="txt_field birthdaate" id="partner_date_birth<?PHP echo $mustarik; ?>" placeholder="تاريخ الميلاد" size="15" maxlength="10">
            <input name="age<?PHP echo $mustarik; ?>" type="text" class="txt_field smallfield" id="age<?PHP echo $mustarik; ?>" placeholder="العمر" size="5" maxlength="3" readonly="readonly">
          </div>
        </div>
        <div class="form_raw">
          <div class="user_txt">الحالة الاجتماعية</div>
          <div class="user_field">
            <?PHP hd_dropbox('partner_marital_status'.$mustarik,$p->partner_marital_status,'اختر الحالة الاجتماعية','maritalstatus','',$p->partner_marital_status_text,'كم عدد الأطفال لديك','partner_marital_status_text'); ?>
          </div>
        </div>
      </div>
      <div class="form_raw">
        <div class="user_txt">الوضع الحالي</div>
        <div class="user_field">
          <?PHP hd_dropbox('partner_job_staus'.$mustarik,$p->partner_job_staus,'اختر الوضع الحالي','current_situation','',$p->partner_job_status_text,'','partner_job_status_text'); ?>
        </div>
      </div>
     
      
      <div class="form_raw">
        <div class="user_txt">فئة الضمان الإجتماعي</div>
        <div class="user_field">
          <input id="option1<?PHP echo $mustarik; ?>" class="option1" type="radio" <?PHP if($p->option1=='Y') { ?>checked="checked"<?PHP } ?> name="option1<?PHP echo $mustarik; ?>" value="Y" />
          نعم
          <input id="option1<?PHP echo $mustarik; ?>" class="option1" <?PHP if($p->option1=='N') { ?>checked="checked"<?PHP } ?> type="radio" name="option1<?PHP echo $mustarik; ?>" value="N" />
          لا </div>
        <div class="user_field" id="option_txt_id<?PHP echo $mustarik; ?>" style=" <?PHP if($p->option1!='Y') { ?>display:none;<?PHP } ?> margin-right: 33px;">
          <input type="text" class="txt_field" value="<?PHP echo $p->option_txt; ?>" name="option_txt<?PHP echo $mustarik; ?>" id="option_txt<?PHP echo $mustarik; ?>" placeholder="رقم بطاقة الضمان الاجتماعي">
        </div>
      </div>
      <div class="form_raw">
        <div class="user_txt">فئة من ذوي الإعاقة</div>
        <div class="user_field">
          <input id="option2<?PHP echo $mustarik; ?>" <?PHP if($p->option2=='Y') { ?>checked="checked"<?PHP } ?> type="radio" name="option2<?PHP echo $mustarik; ?>" value="Y" class="option2" />
          نعم
          <input id="option2<?PHP echo $mustarik; ?>" <?PHP if($p->option2=='N') { ?>checked="checked"<?PHP } ?> type="radio" name="option2<?PHP echo $mustarik; ?>" value="N" class="option2"/>
          لا </div>
        <div class="user_field" style="padding-right: 19px; <?PHP if($p->option2!='Y') { ?>display:none;<?PHP } ?>" id="disable<?PHP echo $mustarik; ?>">
          <?PHP 
					
					hd_dropbox('disable_type'.$mustarik,$p->disable_type,'اختر نوع الإعاقة','disable_type','',$p->partner_disable_type_text,'','partner_disable_type_text'.$mustarik) ?>
        </div>
      </div>
      <div class="form_raw">
        <div class="user_txt">العنوان الشخصي</div>
      </div>
      <div class="form_raw">
        <div class="user_field">
          <table width="100%" border="0" cellspacing="0" cellpadding="1">
            <tr>
              <td><div class="form_field_selected">
                  <?PHP reigons_partner('province'.$mustarik,$p->province); ?>
                </div></td>
              <td><div class="form_field_selected">
                  <?PHP wilayats_partner('walaya'.$mustarik,$p->walaya,$p->province); ?>
                </div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input type="text" value="<?PHP echo $p->village; ?>" class="txt_field" name="village<?PHP echo $mustarik; ?>" placeholder="القرية"></td>
              <td><input type="text" value="<?PHP echo $p->way; ?>" class="txt_field" name="way<?PHP echo $mustarik; ?>" placeholder="السكة"></td>
              <td><input type="text" value="<?PHP echo $p->home; ?>" class="txt_field" name="home<?PHP echo $mustarik; ?>" placeholder="المنزل/المبني"></td>
            </tr>
            <tr>
              <td><input type="text" value="<?PHP echo $p->deparment; ?>" class="txt_field" name="deparment<?PHP echo $mustarik; ?>" placeholder="الشقة"></td>
              <td><input type="text" value="<?PHP echo $p->zipcode; ?>" class="txt_field" name="zipcode<?PHP echo $mustarik; ?>" placeholder="ص.ب"></td>
              <td><input type="text" value="<?PHP echo $p->postalcode; ?>" class="txt_field" name="postalcode<?PHP echo $mustarik; ?>" placeholder="ر.ب"></td>
            </tr>
            <tr>
              <td><input type="text" value="<?PHP echo $p->mobile_number; ?>" class="txt_field" name="mobile_number<?PHP echo $mustarik; ?>" placeholder="الهاتف النقال"></td>
              <td><input type="text" value="<?PHP echo $p->linephone; ?>" class="txt_field" name="linephone<?PHP echo $mustarik; ?>" placeholder="الهاتف الثابت"></td>
              <td><input type="text" value="<?PHP echo $p->fax; ?>" class="txt_field" name="fax<?PHP echo $mustarik; ?>" placeholder="الفاكس"></td>
            </tr>
            <tr>
              <td><input type="text" value="<?PHP echo $p->email; ?>" class="txt_field" name="email<?PHP echo $mustarik; ?>" placeholder="البريد الإلكتروني"></td>
              <td><input type="text" value="<?PHP echo $p->refrence_number; ?>" class="txt_field" name="refrence_number<?PHP echo $mustarik; ?>" placeholder="هاتف نقال أحد الأقارب"></td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="form_raw">
        <div id="threeOption<?PHP echo $evo; ?>" style="text-align:right !important;">
          <ul>
            <li><a href="#tabs-1">المؤهلات</a></li>
            <li><a href="#tabs-2">الخبرة المهنية</a></li>
            <li><a href="#tabs-3">السجلات التجارية الأخرى</a></li>
          </ul>
          <div id="tabs-1">
            <table width="100%">
              <tr>
                <td colspan="2" class="td_text_head">1/ المستوى الدراسي</td>
              </tr>
              <tr>
                <td style="width:30% !important;" class="td_text_data">المؤهل</td>
                <td><?PHP hd_dropbox('partner_qualification'.$mustarik,$p->partner_qualification,'اختر المؤهل','qualification','',$p->partner_qualification_text,'','partner_qualification_text'.$mustarik); ?></td>
              </tr>
              <tr>
                <td class="td_text_data">التخصص</td>
                <td><input name="partner_specialization<?PHP echo $mustarik; ?>" type="text"  value="<?PHP echo $p->partner_specialization; ?>" class="txt_field" id="partner_specialization<?PHP echo $mustarik; ?>" placeholder="التخصص"></td>
              </tr>
              <tr>
                <td class="td_text_data">الجهة</td>
                <td><?PHP hd_dropbox('partner_institute'.$mustarik,$p->partner_institute,'اختر الجهة','institute','',$p->partner_institute_text,'الجهة','partner_institute_text'.$mustarik); ?></td>
              </tr>
              <tr>
                <td class="td_text_data">سنة التخرج</td>
                <td><input name="partner_institute_year<?PHP echo $mustarik; ?>" id="partner_institute_year<?PHP echo $mustarik; ?>" value="<?PHP echo $p->partner_institute_year; ?>" placeholder="سنة التخرج" type="text" class="txt_field NumberInput"></td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_head">2/ التدريب المهني</td>
              </tr>
              <tr>
                <td class="td_text_data">مركز التدريب</td>
                <td><input name="partner_trainningcenter<?PHP echo $mustarik; ?>" type="text"  value="<?PHP echo $p->partner_trainningcenter; ?>" class="txt_field" id="partner_trainningcenter<?PHP echo $mustarik; ?>" placeholder="مركز التدريب"></td>
              </tr>
              <tr>
                <td class="td_text_data">التخصص</td>
                <td><input name="partner_specializations<?PHP echo $mustarik; ?>" type="text"  value="<?PHP echo $p->partner_specializations; ?>" class="txt_field" id="partner_specializations<?PHP echo $mustarik; ?>" placeholder="التخصص"></td>
              </tr>
              <tr>
                <td class="td_text_data">مدة التدريب (بالأشهر)</td>
                <td><input name="partner_training_month<?PHP echo $mustarik; ?>" type="text"  value="<?PHP echo $p->partner_training_month; ?>" class="txt_field" id="partner_training_month<?PHP echo $mustarik; ?>" placeholder="مدة التدريب (بالأشهر)"></td>
              </tr>
              <tr>
                <td class="td_text_data">شهادة التدريب المهني المتحصل عليها</td>
                <td><input name="partner_vtco<?PHP echo $mustarik; ?>" type="text"  value="<?PHP echo $p->partner_vtco; ?>" class="txt_field" id="partner_vtco<?PHP echo $mustarik; ?>" placeholder="شهادة التدريب المهني المتحصل عليها"></td>
              </tr>
              <tr>
                <td class="td_text_data">سنة الحصول على الشهادة</td>
                <td><input name="partner_ytotc<?PHP echo $mustarik; ?>" type="text"  value="<?PHP echo $p->partner_ytotc; ?>" class="txt_field" id="partner_ytotc<?PHP echo $mustarik; ?>" placeholder="سنة الحصول على الشهادة"></td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_data">دورات تدريبية ميدانية أخرى (اختصاص التدريب, جهة التدريب, مدة التدريب (بالأشهر) )</td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_data"><textarea name="partner_other_trainning<?PHP echo $mustarik; ?>" id="partner_other_trainning<?PHP echo $mustarik; ?>" class="mytxt" placeholder="دورات تدريبية ميدانية أخرى (اختصاص التدريب, جهة التدريب, مدة التدريب (بالأشهر) )"><?PHP echo $p->partner_other_trainning; ?></textarea></td>
              </tr>
              <tr>
                <td  colspan="2" class="td_text_data"> دورات التدريب المتخصصة قبل إقامة المشروع: (تنمية المبادرة-إدارة المؤسسات-مجالات فنية أخرى)</td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_data"><textarea name="partner_other_specializations<?PHP echo $mustarik; ?>" id="partner_other_specializations<?PHP echo $mustarik; ?>" class="mytxt" placeholder="دورات التدريب المتخصصة قبل إقامة المشروع: (تنمية المبادرة-إدارة المؤسسات-مجالات فنية أخرى)"><?PHP echo $p->partner_other_specializations; ?></textarea></td>
              </tr>
            </table>
          </div>
          <div id="tabs-2">
            <table width="100%">
              <tr>
                <td colspan="2" class="td_text_head">الخبرة في نفس نشاط المشروع</td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="1">
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
                    <?php for($i=0; $i<=2; $i++) { 
								   $xp = $partner_professional_experience[$i]; 
								  ?>
                     <input name="experienceid<?PHP echo $mustarik; ?>[]" type="hidden"  value="<?PHP echo $xp->experienceid; ?>" class="txt_field xx dateinput" id="experienceid<?PHP echo $i.$mustarik; ?>" placeholder="">
                    <tr>
                    
                    
                      <td><input name="option_one<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $xp->option_one; ?>" class="txt_field xx dateinput" id="option_one<?PHP echo $i.$mustarik; ?>" placeholder="تاريخ"></td>
                      <td><input name="option_two<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $xp->option_two; ?>" class="txt_field xx" id="option_two<?PHP echo $mustarik; ?>" placeholder="اسم الجهة"></td>
                      <td><input name="option_three<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $xp->option_three; ?>" class="txt_field xx " id="option_three<?PHP echo $mustarik; ?>" placeholder="نشاط الجهة"></td>
                      <td><input name="option_four<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $xp->option_four; ?>" class="txt_field xx" id="option_four<?PHP echo $mustarik; ?>" placeholder="المهنة المزاولة بالجهة"></td>
                      <td><input name="option_five<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $xp->option_five; ?>" class="txt_field xx" id="option_five<?PHP echo $mustarik; ?>" placeholder="عدد سنوات الخبرة"></td>
                    </tr>
                    <?PHP } ?>
                    <tr>
                      <td colspan="5" height="5px;"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_head">الخبرة في أنشطة أخرى</td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="1">
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
                    <?php for($j=0; $j<=2; $j++) { 
									$pq = $ape[$j]; 
							?>
                    <tr>
                      <td><input name="activities_one<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $pq->activities_one; ?>" class="txt_field xx  dateinput" id="activities_one<?PHP echo $j.$mustarik; ?>" placeholder="تاريخ"></td>
                      <td><input name="activities_two<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $pq->activities_two; ?>" class="txt_field xx " id="activities_two<?PHP echo $mustarik; ?>" placeholder="اسم الجهة"></td>
                      <td><input name="activities_three<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $pq->activities_three; ?>" class="txt_field xx " id="activities_three<?PHP echo $mustarik; ?>" placeholder="نشاط الجهة"></td>
                      <td><input name="activities_four<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $pq->activities_four; ?>" class="txt_field xx " id="activities_four<?PHP echo $mustarik; ?>" placeholder="المهنة المزاولة بالجهة"></td>
                      <td><input name="activities_five<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $pq->activities_five; ?>" class="txt_field xx " id="activities_five<?PHP echo $mustarik; ?>" placeholder="عدد سنوات الخبرة"></td>
                    </tr>
                    <?PHP } ?>
                    <tr>
                      <td colspan="5" height="5px;"></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </div>
          <div id="tabs-3">
          <?php
		  //	echo "<pre>";
			//		print_r($apb);
					
		  ?>
            <table width="100%">
              <tr>
                <td colspan="2" class="td_text_head">الخبرة في نفس نشاط المشروع </td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_data"><input value="مالك" type="checkbox" name="partner_activity<?PHP echo $mustarik; ?>" />
                  مالك
                  <input value="شريك" type="checkbox" name="partner_activity<?PHP echo $mustarik; ?>" />
                  شريك
                  <input value="مفوض بالتوقيع" type="checkbox" name="partner_activity<?PHP echo $mustarik; ?>" />
                  مفوض بالتوقيع</td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                    <tr>
                      <td colspan="4" height="5"></td>
                    </tr>
                    <tr>
                      <td class="td_text_data center">اسم السجل</td>
                      <td class="td_text_data center">رقم السجل</td>
                      <td class="td_text_data center">عدد القوى العاملة الوطنية</td>
                      <td class="td_text_data center">عدد القوى العاملة الوافدة</td>
                    </tr>
                    <?php 
					
					for($i=0; $i<=2; $i++) { 
								$act = $apb[$i];
						//		echo "<pre>";
						//		print_r($act);
							?>
                            
                    <tr>
                      <input name="bid<?PHP echo $mustarik; ?>[]" type="hidden"  value="<?PHP echo $act->bid; ?>" class="txt_field " id="bid<?PHP echo $mustarik; ?>" placeholder="اسم الجهة">
                      <td><input name="activity_name<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $act->activity_name; ?>" class="txt_field " id="activity_name<?PHP echo $mustarik; ?>" placeholder="اسم الجهة"></td>
                      <td><input name="activity_registration_no<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $act->activity_registration_no; ?>" class="txt_field" id="activity_registration_no<?PHP echo $mustarik; ?>" placeholder="نشاط الجهة"></td>
                      <td><input name="activity_nationalmanpower<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $act->activity_nationalmanpower; ?>" class="txt_field" id="activity_nationalmanpower<?PHP echo $mustarik; ?>" placeholder="المهنة المزاولة بالجهة"></td>
                      <td><input name="activity_laborforce<?PHP echo $mustarik; ?>[]" type="text"  value="<?PHP echo $act->activity_laborforce; ?>" class="txt_field " id="activity_laborforce<?PHP echo $mustarik; ?>" placeholder="عدد سنوات الخبرة"></td>
                    </tr>
                    <?PHP } ?>
                    <tr>
                      <td colspan="4" height="5"></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!--<div class="form_raw">
        <div id="documentarea"></div>
      </div>-->
    </div>
    <iframe id="iframe<?php echo $mustarik ?>" name="iframe<?php echo $mustarik ?>" src="<?php echo base_url() ?>inquiries/attachment/<?php echo $mustarik ?>" style="width: 924px; height: 1124px; border: 0px none;">
    </iframe>
    
  </div>
</div>
