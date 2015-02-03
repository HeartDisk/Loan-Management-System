<?php $this->load->view('common/meta');?>
<?php //echo '<pre>'; print_r($data);?>
<div class="body">
<?php $this->load->view('common/banner2');?>
<script src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
<div class="body_contant">
  <?php $this->load->view('common/floatingmenu');?>
<div class="main_contant">
<div class="shortcuts">

<div class="data_raw"><div class="main_box">
<div class="data_box_title">
<div class="data_box_title_icon"><img src="<?php echo base_url(); ?>images/menu/department_icon_s.png" width="22" height="19" /></div>
<div class="data_title">البحث</div>
</div>
<div class="data">
<div class="main_data">
<form action="" method="get">
<div class="form_raw">
                  <div class="user_txt">الاسم الأول</div>
                  <div class="user_field">
                    <input type="text" class="txt_field TextInput req tempapplicant" id="first_name" placeholder="الاسم الأول" value="" data-handler="112_186" name="first_name_186">
                  </div>
                  <div style="margin-right: 11px;" class="user_txt">الاسم الثاني</div>
                  <div class="user_field">
                    <input type="text" class="txt_field TextInput req tempapplicant" id="middle_name" placeholder="الاسم الثاني" value="" data-handler="112_186" name="middle_name_186">
                                      </div>
                </div>
<div class="form_raw">
                  <div class="user_txt">الاسم الثالث</div>
                  <div class="user_field">
                    <input type="text" class="txt_field TextInput req tempapplicant" id="last_name" placeholder="الاسم الثالث" value="" data-handler="112_186" name="last_name_186">
                  </div>
                  <div style="margin-right: 11px;" class="user_txt">القبيلة / العائلة</div>
                  <div class="user_field">
                    <input type="text" class="txt_field TextInput req tempapplicant" id="family_name" placeholder="القبيلة / العائلة" value="" data-handler="112_186" name="sur_name_186">
                  </div>
                </div>
<div class="form_raw">
                  <div class="user_txt">النوع</div>
                  <div class="user_field">
                    <label class="radio-inline">
                      <input type="radio" required="" id="applicanttype" class=" tempapplicant" value="ذكر" data-handler="112_186" checked="checked" name="applicanttype_186">
                      ذكر </label>
                    <label class="radio-inline">
                      <input type="radio" id="applicanttype" class=" tempapplicant" value="أنثى" data-handler="112_186" name="applicanttype_186">
                      أنثى </label>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">رقم البطاقة الشخصية</div>
                  <div class="user_field">
                    <input type="text" class="txt_field NumberInput req autocomplete  tempapplicant ui-autocomplete-input" data-handler="112_186" placeholder="رقم البطاقة الشخصية" id="idcard" value="" name="idcard_186" autocomplete="off">
                  </div>
                </div>
                <div id="hatfi186" class="form_raw">
                  <div class="user_txt">رقم الهاتف</div>
                  <div id="phonexnumbers" class="user_field">
                    <input type="text" maxlength="8" placeholder="رقم الهاتف" id="phonenumber" class="txt_field NumberInput req applicantphone ui-autocomplete-input" onblur="checkPhoneLen(this);" value="" name="phone_numbers" data-handler="112_186_228" autocomplete="off">
                  </div>
                </div>                
<div class="main_withoutbg">
<div class="add_department_btn"><input id="search" type="button" class="transperant_btn" value="بحـث" /></div></div>
</form>

<div class="data_raw" id="result" style="display:none;"><div class="main_box">
<div class="data_box_title">
<div class="data_box_title_icon"><img width="22" height="20" src="<?php echo base_url(); ?>images/menu/table_icon_s.png"></div>
<div class="data_title">البحث</div>
</div>
<div class="data" style="min-height: 30px;">
<div class="main_data">
<div class="main_tab">
<div class="green_main_right_icon"></div>
<div class="tab_txt"><div class="team1_tab_txt"><span class="green" id="nn" style="cursor:pointer;"> عبد الرحمن عبد الله</span></div></div>
<div class="tab_cotrols">
</div>
</div>

</div>

</div></div>


</div>
</div>
</div></div>
</div>
<script type="text/javascript">
$(document).ready(function (){
		///alert('asdasd');
			$("#search").click(function(){
		$("#result").fadeIn();
});
$("#nn").click(function(){
				//$("#details").fadeIn();
	});
});


</script>
<?php $this->load->view('common/footer');?>