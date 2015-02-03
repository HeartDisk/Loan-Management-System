<div class="form_raw unmusanif ms<?php echo $a ?>">
  <input onclick="removeMusanif('<?php echo $a ?>')" id="remove" value="حذف" type="button" style="float:left !important;">
  <div class="user_txt">الجهة التمويلية</div>
  <div class="user_field">
    <input name="financing[]" id="financing[]" value="<?PHP //echo $main->financing; ?>"  placeholder="الجهة التمويلية" type="text" class="ssForm txt_field ">
  </div>
</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt">مبلغ القرض</div>
  <div class="user_field">
    <input name="loan_amount[]" id="loan_amount[]" value="<?PHP //echo $main->loan_amount; ?>"  placeholder="مبلغ القرض" type="text" class="ssForm txt_field NumberInput">
  </div>
</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt">المبلغ المسدد</div>
  <div class="user_field">
    <input name="amount_paid[]" id="amount_paid[]" value="<?PHP // echo $main->amount_paid; ?>"  placeholder="المبلغ المسدد" type="text" class="ssForm txt_field NumberInput">
  </div>
</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt"></div>
  <div class="user_field">
    <input name="amount_paid[]" id="amount_paid[]" value="<?PHP // echo $main->amount_paid; ?>"  placeholder="المبلغ المسدد" type="text" class="ssForm txt_field NumberInput">
  </div>
</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt">المتبقي</div>
  <div class="user_field">
    <input name="residual[]" id="residual[]" value="<?PHP //echo $main->residual; ?>"  placeholder="المتبقي" type="text" class="ssForm txt_field ">
  </div>

</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt">القسط الشهري</div>
  <div class="user_field">
    <input name="monthly_installment[]" id="monthly_installment[]" value="<?PHP //echo $main->monthly_installment; ?>"  placeholder="القسط الشهري" type="text" class="ssForm txt_field ">
  </div>
</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt">الملاحظات</div>
  <div class="user_field">
    <textarea name="musanif_notes[]" id="notes[]" placeholder="الملاحظات"  class="sForm txt_field" ><?PHP //echo $main->project_difficulties; ?>
</textarea>
  </div>
</div>
