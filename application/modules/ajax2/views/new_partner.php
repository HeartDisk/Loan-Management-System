<?PHP $this->load->view('forajax'); ?>
<div class="personal ppback" id="personalbingo<?PHP echo $a; ?>">

              <div class="form_raw">
                <div class="user_txt">الاسم الأول</div>
                <div class="user_field">
                  <input name="first_name_<?PHP echo $a; ?>"  data-handler="<?PHP echo $t; ?>_<?PHP echo $a; ?>" value="<?PHP echo $appli->first_name; ?>" placeholder="الاسم الأول" id="first_name" type="text" class="txt_field TextInput tempapplicant">
                </div>
                <div class="user_txt" style="margin-right: 11px;">الإسم الثاني</div>
                <div class="user_field">
                  <input name="middle_name_<?PHP echo $a; ?>"  data-handler="<?PHP echo $t; ?>_<?PHP echo $a; ?>" value="<?PHP echo $appli->middle_name; ?>" placeholder="الإسم الثاني" id="middle_name" type="text" class="txt_field TextInput tempapplicant">
                <input class="hafaz" type="button" onclick="removeRow('<?PHP echo $a; ?>');" id="remove" value="حذف" />
                </div>
              </div>
              <div class="form_raw">
                <div class="user_txt">الإسم الثالث</div>
                <div class="user_field">
                  <input name="last_name_<?PHP echo $a; ?>"  data-handler="<?PHP echo $t; ?>_<?PHP echo $a; ?>" value="<?PHP echo $appli->last_name; ?>" placeholder="الإسم الثالث" id="last_name" type="text" class="txt_field TextInput tempapplicant">
                </div>
                <div class="user_txt" style="margin-right: 11px;">القبيلة / العائلة</div>
                <div class="user_field">
                  <input name="sur_name_<?PHP echo $a; ?>"  data-handler="<?PHP echo $t; ?>_<?PHP echo $a; ?>" value="<?PHP echo $appli->family_name; ?>" placeholder="القبيلة" id="family_name" type="text" class="txt_field TextInput tempapplicant">
                </div>
              </div>
              <div class="form_raw">
                <div class="user_txt">النوع</div>
                <div class="user_field">
                  <label class="radio-inline">
                    <input type="radio" name="applicanttype_<?PHP echo $a; ?>" data-handler="<?PHP echo $t; ?>_<?PHP echo $a; ?>" value="ذكر" class=" tempapplicant" id="applicanttype" required  />
                    ذكر </label>
                  <label class="radio-inline">
                    <input type="radio" name="applicanttype_<?PHP echo $a; ?>" data-handler="<?PHP echo $t; ?>_<?PHP echo $a; ?>" value="أنثى" class=" tempapplicant" id="applicanttype"/>
                    أنثى </label>
                </div>
              </div>
              <div class="form_raw">
                <div class="user_txt">رقم البطاقة الشخصية</div>
                <div class="user_field">
                  <input name="idcard_<?PHP echo $a; ?>"  value="<?PHP echo $appli->idcard; ?>" id="idcard" placeholder="رقم البطاقة الشخصية" type="text" data-handler="<?PHP echo $t; ?>_<?PHP echo $a; ?>" class="txt_field NumberInput autocomplete  tempapplicant">
                </div>
              </div>
              <?PHP 
			  $p = 0;
			  $q = $this->db->query("SELECT * FROM temp_main_phone WHERE tempid='".$t."' AND applicantid='".$a."'");
			  foreach($q->result() as $dd) {  ?>
              <div class="form_raw" <?PHP if($p==0) { ?>id="hatfi"<?PHP } ?>>
                <div class="user_txt">رقم الهاتف</div>
                <div class="user_field" id="phonexnumbers">
                  <input data-handler="<?PHP echo $t; ?>_<?PHP echo $a; ?>_<?PHP echo $phones->phoneid; ?>" name="phone_numbers_<?PHP echo $a; ?>_<?PHP echo $phones->phoneid; ?>" value="<?PHP echo $phones->phonenumber; ?>"  type="text"   class="txt_field NumberInput applicantphone" id="phonenumber" placeholder="رقم الهاتف" maxlength="8">
                  <?PHP if($p==0) { ?><input onclick="addnewphone();" type="button" class="addnew" id="addnew" value="إضافة" /><?PHP } ?>
                </div>
              </div>
              <?PHP $p++; } ?>
            </div>