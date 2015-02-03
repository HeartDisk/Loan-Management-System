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
            <input name="applicant_first_name" value="<?PHP  if(isset($type) && $type != "inquiry") { echo $applicant->applicant_first_name; } else{ if(isset($type) && $type == "inquiry") { echo $applicant->first_name; } } ?>" placeholder="الاسم الأول" id="applicant_first_name" type="text" class="txt_field TextInput req">
          </div>
          <div class="user_txt" style="margin-right: 11px;">الاسم الثاني</div>
          <div class="user_field">
            <input name="applicant_middle_name" value="<?PHP if(isset($type) && $type != "inquiry") { echo $applicant->applicant_middle_name; } else{ if(isset($type) && $type == "inquiry") { echo  $applicant->middle_name; } } ?>" placeholder="الاسم الثاني" id="applicant_middle_name" type="text" class="txt_field TextInput req">
          </div>
        </div>
        <div class="form_raw">
          <div class="user_txt">الاسم الثالث</div>
          <div class="user_field">
            <input name="applicant_last_name" value="<?PHP  if(isset($type) && $type != "inquiry") { echo $applicant->applicant_last_name; } else{ if(isset($type) && $type == "inquiry") { echo  $applicant->last_name; } } ?>" placeholder="الاسم الثالث" id="applicant_last_name" type="text" class="txt_field TextInput req">
          </div>
          <div class="user_txt" style="margin-right: 11px;">القبيلة / العائلة</div>
          <div class="user_field">
            <input name="applicant_sur_name" value="<?PHP  if(isset($type) && $type != "inquiry") { echo $applicant->applicant_sur_name; } else{ if(isset($type) && $type == "inquiry") { echo  $applicant->family_name; } }  ?>" placeholder="القبيلة / العائلة" id="applicant_sur_name" type="text" class="txt_field TextInput req">
          </div>
        </div>
        <div class="form_raw">
          <div class="user_txt">النوع</div>
          <div class="user_field">
            <label class="radio-inline">
              <input type="radio" <?PHP if(isset($type) && $type != "inquiry") { if($applicant->applicant_gender=='ذكر') { ?> checked="checked" <?PHP } } else{ if(isset($type) && $type == "inquiry") { if($applicant->applicanttype=='ذكر') { ?> checked="checked" <?PHP } } }  ?> class="req" name="applicant_gender" value="ذكر" id="applicant_gender" class="apType"/>
              ذكر </label>
            <label class="radio-inline">
              <input type="radio" <?PHP if(isset($type) && $type != "inquiry") { if($applicant->applicant_gender=='أنثى') { ?> checked="checked" <?PHP } } else{ if(isset($type) && $type == "inquiry") { if($applicant->applicanttype=='أنثى') { ?> checked="checked" <?PHP } } } ?> class="req" name="applicant_gender" value="أنثى" id="applicant_gender" class="apType"/>
              أنثى </label>
          </div>
        </div>
        <div class="form_raw">
          <div class="user_txt">رقم البطاقة الشخصية</div>
          <div class="user_field">
            <input name="appliant_id_number"  value="<?PHP  if(isset($type) && $type != "inquiry") { echo $applicant->appliant_id_number; } else{ if(isset($type) && $type == "inquiry") { echo  $applicant->idcard; } }  ?>" id="appliant_id_number" placeholder="رقم البطاقة الشخصية" type="text" class="txt_field NumberInput req idcard_autocomplete">
          </div>
        </div>
        <div class="form_raw" id="hatfi">
          <div class="user_txt">رقم الهاتف</div>
          <div class="user_field" id="phonexnumbers">
            <?php
				  	if(isset($type) && $type != "inquiry") { 
					?>
            <input name="phone_numbers[]" value="<?PHP echo $applicant_phones[0]->applicant_phone; ?>"  type="text" class="txt_field NumberInput req p_number" id="phonenumber" placeholder="رقم الهاتف" maxlength="8">
            <?php
					} 
					else{
						?>
            <input name="phone_numbers[]" value="<?PHP echo $phones[$applicant->applicantid][0]->phonenumber; ?>"  type="text" class="txt_field NumberInput req p_number" id="phonenumber" placeholder="رقم الهاتف" maxlength="8">
            <?php
					}
				  ?>
            <!--
                    <input type="button" data-table="hatfi" class="addpartnerphone" id="addnewphone" value="" />--> 
            <a  data-table="hatfi" class="addpartnerphone2" id="addnewphone" href="javascript:void(0)"><img src="<?php echo base_url(); ?>images/addnewphone.png"  width="30"/></a> </div>
        </div>
      </div>
      <div class="personal" id="personal2">
        <div class="form_raw">
          <div class="user_txt">رقم سجل القوى العاملة</div>
          <div class="user_field">
            <input name="applicant_cr_number" id="applicant_cr_number" value="<?PHP if(isset($type) && $type != "inquiry") { echo $applicant->applicant_cr_number; } else { echo $main['main']->mr_number; }  ?>" placeholder="رقم سجل القوى العاملة" type="text" class="txt_field NumberInput">
          </div>
        </div>
        <div class="form_raw">
          <div class="user_txt">تاريخ الميلاد</div>
          <div class="user_field">
            <input name="applicant_date_birth" type="text"  value="<?PHP echo $applicant->applicant_date_birth; ?>" class="txt_field" id="applicant_date_birth" placeholder="تاريخ الميلاد" size="15" maxlength="10">
            <input name="age" type="text" class="txt_field smallfield" id="age" placeholder="العمر" size="5" maxlength="3" readonly="readonly">
          </div>
        </div>
        <div class="form_raw">
          <div class="user_txt">الحالة الاجتماعية</div>
          <div class="user_field">
            <?PHP hd_dropbox('applicant_marital_status',$applicant->applicant_marital_status,'اختر الحالة الاجتماعية','maritalstatus','req',$applicant->applicant_marital_status_text,'كم عدد الأطفال لديك','applicant_marital_status_text'); ?>
          </div>
        </div>
      </div>
      <div class="form_raw">
        <div class="user_txt">الوضع الحالي</div>
        <div class="user_field">
          <?PHP hd_dropbox('applicant_job_staus',$applicant->applicant_job_staus,'اختر الوضع الحالي','current_situation','req',$applicant->applicant_marital_status_text,'','applicant_job_status_text'); ?>
        </div>
      </div>
     
      
      <div class="form_raw">
        <div class="user_txt">فئة الضمان الإجتماعي</div>
        <div class="user_field">
          <input id="option1" class="option1" type="radio" <?PHP if($applicant->option1=='Y') { ?>checked="checked"<?PHP } ?> name="option1" value="Y" />
          نعم
          <input id="option1" class="option1" <?PHP if($applicant->option1=='N') { ?>checked="checked"<?PHP } ?> type="radio" name="option1" value="N" />
          لا </div>
        <div class="user_field" id="option_txt_id" style="display:none; margin-right: 33px;">
          <input type="text" class="txt_field" value="<?PHP echo $applicant->option_txt; ?>" name="option_txt" id="option_txt" placeholder="رقم بطاقة الضمان الاجتماعي">
        </div>
      </div>
      <div class="form_raw">
        <div class="user_txt">فئة من ذوي الإعاقة</div>
        <div class="user_field">
          <input id="option2" <?PHP if($applicant->option2=='Y') { ?>checked="checked"<?PHP } ?> type="radio" name="option2" value="Y" onclick="checkType(this.value)" />
          نعم
          <input id="option23" <?PHP if($applicant->option2=='N') { ?>checked="checked"<?PHP } ?> type="radio" name="option2" value="N" onclick="checkType(this.value)"/>
          لا </div>
        <div class="user_field" style="padding-right: 19px; display:none;" id="disable">
          <?PHP 
					
					hd_dropbox('disable_type',$applicant->disable_type,'اختر نوع الإعاقة','disable_type','',$applicant->applicant_disable_type_text,'','applicant_disable_type_text') ?>
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
                  <?PHP reigons('province',$applicant->province,$applicant->applicant_id); ?>
                </div></td>
              <td><div class="form_field_selected">
                  <?PHP election_wilayats('walaya',$applicant->walaya,$applicant->province,$applicant->applicant_id); ?>
                </div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input type="text" value="<?PHP echo $applicant->village; ?>" class="txt_field" name="village" placeholder="القرية"></td>
              <td><input type="text" value="<?PHP echo $applicant->way; ?>" class="txt_field" name="way" placeholder="السكة"></td>
              <td><input type="text" value="<?PHP echo $applicant->home; ?>" class="txt_field" name="home" placeholder="المنزل/المبني"></td>
            </tr>
            <tr>
              <td><input type="text" value="<?PHP echo $applicant->deparment; ?>" class="txt_field" name="deparment" placeholder="الشقة"></td>
              <td><input type="text" value="<?PHP echo $applicant->zipcode; ?>" class="txt_field" name="zipcode" placeholder="ص.ب"></td>
              <td><input type="text" value="<?PHP echo $applicant->postalcode; ?>" class="txt_field" name="postalcode" placeholder="ر.ب"></td>
            </tr>
            <tr>
              <td><input type="text" value="<?PHP echo $applicant->mobile_number; ?>" class="txt_field" name="mobile_number" placeholder="الهاتف النقال"></td>
              <td><input type="text" value="<?PHP echo $applicant->linephone; ?>" class="txt_field" name="linephone" placeholder="الهاتف الثابت"></td>
              <td><input type="text" value="<?PHP echo $applicant->fax; ?>" class="txt_field" name="fax" placeholder="الفاكس"></td>
            </tr>
            <tr>
              <td><input type="text" value="<?PHP echo $applicant->email; ?>" class="txt_field" name="email" placeholder="البريد الإلكتروني"></td>
              <td><input type="text" value="<?PHP echo $applicant->refrence_number; ?>" class="txt_field" name="refrence_number" placeholder="هاتف نقال أحد الأقارب"></td>
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
                <td><?PHP hd_dropbox('applicant_qualification',$applicant_qualification->applicant_qualification,'اختر المؤهل','qualification','',$applicant_qualification->applicant_qualification_text,'','applicant_qualification_text'); ?></td>
              </tr>
              <tr>
                <td class="td_text_data">التخصص</td>
                <td><input name="applicant_specialization" type="text"  value="<?PHP echo $applicant_qualification->applicant_specialization; ?>" class="txt_field" id="applicant_specialization" placeholder="التخصص"></td>
              </tr>
              <tr>
                <td class="td_text_data">الجهة</td>
                <td><?PHP hd_dropbox('applicant_institute',$applicant_qualification->applicant_institute,'اختر الجهة','institute','',$applicant_qualification->applicant_institute_text,'الجهة','applicant_institute_text'); ?></td>
              </tr>
              <tr>
                <td class="td_text_data">سنة التخرج</td>
                <td><input name="application_institute_year" id="application_institute_year" value="<?PHP echo $applicant_qualification->application_institute_year; ?>" placeholder="سنة التخرج" type="text" class="txt_field NumberInput"></td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_head">2/ التدريب المهني</td>
              </tr>
              <tr>
                <td class="td_text_data">مركز التدريب</td>
                <td><input name="applicant_trainningcenter" type="text"  value="<?PHP echo $applicant_qualification->applicant_trainningcenter; ?>" class="txt_field" id="applicant_trainningcenter" placeholder="مركز التدريب"></td>
              </tr>
              <tr>
                <td class="td_text_data">التخصص</td>
                <td><input name="applicant_specializations" type="text"  value="<?PHP echo $applicant_qualification->applicant_specializations; ?>" class="txt_field" id="applicant_specializations" placeholder="التخصص"></td>
              </tr>
              <tr>
                <td class="td_text_data">مدة التدريب (بالأشهر)</td>
                <td><input name="applicant_training_month" type="text"  value="<?PHP echo $applicant_qualification->applicant_training_month; ?>" class="txt_field" id="applicant_training_month" placeholder="مدة التدريب (بالأشهر)"></td>
              </tr>
              <tr>
                <td class="td_text_data">شهادة التدريب المهني المتحصل عليها</td>
                <td><input name="applicant_vtco" type="text"  value="<?PHP echo $applicant_qualification->applicant_vtco; ?>" class="txt_field" id="applicant_vtco" placeholder="شهادة التدريب المهني المتحصل عليها"></td>
              </tr>
              <tr>
                <td class="td_text_data">سنة الحصول على الشهادة</td>
                <td><input name="applicant_ytotc" type="text"  value="<?PHP echo $applicant_qualification->applicant_ytotc; ?>" class="txt_field" id="applicant_ytotc" placeholder="سنة الحصول على الشهادة"></td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_data">دورات تدريبية ميدانية أخرى (اختصاص التدريب, جهة التدريب, مدة التدريب (بالأشهر) )</td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_data"><textarea name="applicant_other_trainning" id="applicant_other_trainning" class="mytxt" placeholder="دورات تدريبية ميدانية أخرى (اختصاص التدريب, جهة التدريب, مدة التدريب (بالأشهر) )"><?PHP echo $applicant_qualification->applicant_other_trainning; ?></textarea></td>
              </tr>
              <tr>
                <td  colspan="2" class="td_text_data"> دورات التدريب المتخصصة قبل إقامة المشروع: (تنمية المبادرة-إدارة المؤسسات-مجالات فنية أخرى)</td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_data"><textarea name="applicant_other_specializations" id="applicant_other_specializations" class="mytxt" placeholder="دورات التدريب المتخصصة قبل إقامة المشروع: (تنمية المبادرة-إدارة المؤسسات-مجالات فنية أخرى)"><?PHP echo $applicant_qualification->applicant_other_specializations; ?></textarea></td>
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
								   $xp = $applicant_professional_experience[$i]; 
								  ?>
                    <tr>
                      <td><input name="option_one[]" type="text"  value="<?PHP echo $xp->option_one; ?>" class="txt_field xx dateinput" id="option_one<?php echo $i; ?>" placeholder="تاريخ"></td>
                      <td><input name="option_two[]" type="text"  value="<?PHP echo $xp->option_two; ?>" class="txt_field xx" id="option_two" placeholder="اسم الجهة"></td>
                      <td><input name="option_three[]" type="text"  value="<?PHP echo $xp->option_three; ?>" class="txt_field xx " id="option_three" placeholder="نشاط الجهة"></td>
                      <td><input name="option_four[]" type="text"  value="<?PHP echo $xp->option_four; ?>" class="txt_field xx" id="option_four" placeholder="المهنة المزاولة بالجهة"></td>
                      <td><input name="option_five[]" type="text"  value="<?PHP echo $xp->option_five; ?>" class="txt_field xx" id="option_five" placeholder="عدد سنوات الخبرة"></td>
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
									$pq = $applicant_professional_experience[$j]; 
							?>
                    <tr>
                      <td><input name="activities_one[]" type="text"  value="<?PHP echo $pq->activities_one; ?>" class="txt_field xx  dateinput" id="activities_one<?php echo $j; ?>" placeholder="تاريخ"></td>
                      <td><input name="activities_two[]" type="text"  value="<?PHP echo $pq->activities_two; ?>" class="txt_field xx " id="activities_two" placeholder="اسم الجهة"></td>
                      <td><input name="activities_three[]" type="text"  value="<?PHP echo $pq->activities_three; ?>" class="txt_field xx " id="activities_three" placeholder="نشاط الجهة"></td>
                      <td><input name="activities_four[]" type="text"  value="<?PHP echo $pq->activities_four; ?>" class="txt_field xx " id="activities_four" placeholder="المهنة المزاولة بالجهة"></td>
                      <td><input name="activities_five[]" type="text"  value="<?PHP echo $pq->activities_five; ?>" class="txt_field xx " id="activities_five" placeholder="عدد سنوات الخبرة"></td>
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
            <table width="100%">
              <tr>
                <td colspan="2" class="td_text_head">الخبرة في نفس نشاط المشروع</td>
              </tr>
              <tr>
                <td colspan="2" class="td_text_data"><input value="مالك" type="checkbox" name="applicant_activity[]" />
                  مالك
                  <input value="شريك" type="checkbox" name="applicant_activity[]" />
                  شريك
                  <input value="مفوض بالتوقيع" type="checkbox" name="applicant_activity[]" />
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
                    <?php for($i=0; $i<=2; $i++) { 
								$act = $applicant_businessrecord[$i];
							?>
                    <tr>
                      <td><input name="activity_name[]" type="text"  value="<?PHP echo $act->activity_name; ?>" class="txt_field  " id="activity_name" placeholder="اسم السجل"></td>
                      <td><input name="activity_registration_no[]" type="text"  value="<?PHP echo $act->activity_registration_no; ?>" class="txt_field" id="activity_registration_no" placeholder="رقم السجل"></td>
                      <td><input name="activity_nationalmanpower[]" type="text"  value="<?PHP echo $act->activity_nationalmanpower; ?>" class="txt_field" id="activity_nationalmanpower" placeholder="العاملة الوطنية"></td>
                      <td><input name="activity_laborforce[]" type="text"  value="<?PHP echo $act->activity_laborforce; ?>" class="txt_field " id="activity_laborforce" placeholder="العاملة الوافدة" style="width:100px;"></td>
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
      <div class="form_raw">
        <div id="documentarea"></div>
      </div>
    </div>
    <div class="form_raw">
      <div class="user_txt"></div>
      <div class="user_field">
        <button type="button" id="save_next_move" class="btnx green">حفظ</button>
        <button style="display:none;" type="button" id="restart_data" class="btn default">إلغاء</button>
      </div>
    </div>
  </div>
</div>
