<?php $this->load->view('common/meta');?>

<div class="body">
<?php $this->load->view('common/banner');?>
<div class="body_contant">
  <?php $this->load->view('common/floatingmenu');?>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <!--<div class="shortcuts">
      <div class="short_cut_item"> <a href="departments_view.html">الأقسام</a></div>
      <div class="short_cut_item"> <a href="questions_view.html">الأسئلة</a></div>
      <div class="short_cut_item"> <a href="schedule_view.html">المتسابقين</a></div>
    </div>-->
        <?php $success	=	$this->session->flashdata('success');?>
        <?php if(!empty($success)):?>
            <div class="right_nav_raw">
            <div class="nav_icon"><img src="<?php echo base_url();?>images/body/right.png" width="60" height="60"></div>
            <?php echo $success;?>
            </div>
        <?php endif;?>
    <div class="data_raw">
      <div class="main_box">
        <div class="data_box_title">
          <!--<div class="data_box_title_icon"><img src="images/menu/question_s.png" width="22" height="20" /></div>-->
          <div class="data_title">تسجيلا لبنك  الموظف</div>
          <!--<div class="page_controls">
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>-->
        </div>
        <div class="data">
          <div class="main_data">
            <form action="<?php echo current_url();?>" method="POST" id="validate_form_new" name="validate_form_new">
              <div class="form_raw">
                <div class="form_txt">الاسم الأول</div>
                <div class="form_field">
                  <input type="text" class="txt_field req" name="firstname" id="firstname" placeholder="الاسم الأو" value="<?php echo (isset($single_user->firstname) ? $single_user->firstname : NULL);?>"/>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt">اسم العائلة</div>
                <div class="form_field">
                  <input type="text" class="txt_field req" name="lastname" id="lastname" placeholder="اسم العائلة" value="<?php echo (isset($single_user->lastname) ? $single_user->lastname : NULL);?>"/>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt">اسم المستخدم</div>
                <div class="form_field">
                <?PHP if($single_user->id=='') { ?>
                  <input type="text" class="txt_field req" name="user_name" id="user_name" placeholder="اسم المستخدم" value="<?php echo (isset($single_user->user_name) ? $single_user->user_name : NULL);?>"/>
                <?PHP } else { ?>
					<input type="hidden" class="txt_field req" name="user_name" id="user_name" placeholder="اسم المستخدم" value="<?php echo (isset($single_user->user_name) ? $single_user->user_name : NULL);?>"/>
					<strong><?php echo (isset($single_user->user_name) ? $single_user->user_name : NULL);?></strong>
				<?PHP } ?>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt">كلمة السر</div>
                <div class="form_field">
                  <input type="password" class="txt_field <?PHP if($single_user->id=='') { ?>req<?PHP } ?>" name="password" id="password" placeholder="******" value=""/>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt">تأكيد كلمة المرور</div>
                <div class="form_field">
                  <input type="password" class="txt_field  <?PHP if($single_user->id=='') { ?>req<?PHP } ?>" name="confirm_password" id="confirm_password" placeholder="******" value=""/>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt">البريد الإلكتروني</div>
                <div class="form_field">
                  <input type="text" class="txt_field " name="email" id="email" placeholder="البريد الإلكتروني" value="<?php echo (isset($single_user->email) ? $single_user->email : NULL);?>"/>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt">رقم الهاتف</div>
                <div class="form_field">
                  <input type="text" class="txt_field  NumberInput" name="number" id="number" placeholder="رقم الهاتف" value="<?php echo (isset($single_user->number) ? $single_user->number : NULL);?>"/>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt">عن مستخدم</div>
                <div class="form_field">
                  <input type="text" class="txt_field " name="about_user" id="about_user" placeholder="عن مستخدم" value="<?php echo (isset($single_user->about_user) ? $single_user->about_user : NULL);?>"/>
                </div>
              </div>
          	<div class="form_raw">
                <div class="form_txt">فرع</div>
                <div class="form_field_selected">
                	<?php get_bank_branches('bank_branch_id',$single_user->branch_id);?>
                </div>
              </div>
              

              <div class="main_withoutbg">
                <div class="add_question_btn">
                <?php if($single_user->id):?>
                	<input type="hidden" name="id" value="<?php echo $single_user->id;?>" />
                <?php endif;?>
                  <input type="button" id="save_data_form_new" class="transperant_btn" name="save_data_form_new"  value="حفظ" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(function(){
	$('#user_name').blur(function(){
		var loginid = $(this).val();
		var check_login_id = $.ajax({
			  url: config.AJAX_URL+'checkLoginID',
			  type: "POST",
			  data:{loginid:loginid},
			  dataType: "json",
			  success: function(msg){
				  if(msg.result=='error')
				  {
				  	$('#user_name').after('<span id="removeError">اسم المستخدم موجودة بالفعل</span>');
					$('#user_name').val(' ');
				  }
				  else
				  {
					  $('#removeError').remove();
				  }
				 }
			});
	});	
});
</script>
<?php $this->load->view('common/footer');?>
