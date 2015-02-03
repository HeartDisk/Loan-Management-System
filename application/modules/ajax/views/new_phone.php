<div id="hatfi<?PHP echo $p; ?>"  class="form_raw">
  <div class="user_txt">رقم الهاتف</div>
  <div class="user_field" id="phonexnumbers">
    <input onblur="checkPhoneLen(this);" data-handler="<?PHP echo $t; ?>_<?PHP echo $a; ?>_<?PHP echo $p; ?>" name="phone_numbers_<?PHP echo $a; ?>_<?PHP echo $p; ?>" type="text"   class="txt_field NumberInput req applicantphone" id="phonenumber" placeholder="رقم الهاتف" maxlength="8">
    
   <!-- <input type="button" onclick="removePhone('<?PHP //echo $p; ?>')" id="remove" value="حذف" />-->
    <a href="javascript:void(0)" id="remove"  onclick="removePhone('<?PHP echo $p; ?>')"><img width="30" src="<?php echo base_url(); ?>/images/delete.png"></a>
  </div>
</div>
