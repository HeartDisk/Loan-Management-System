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
    <div class="data_raw">
      <div class="main_box">
        <div class="data_box_title">
          <!--<div class="data_box_title_icon"><img src="images/menu/question_s.png" width="22" height="20" /></div>-->
          <div class="data_title">إضافة قوانين</div>
          <!--<div class="page_controls">
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>-->
        </div>
        <div class="data">
          <div class="main_data">
            <form action="<?php echo current_url();?>" method="POST" id="validate_form" name="validate_form">
              <div class="form_raw">
                <div class="form_txt">قواعد</div>
                <div class="form_field">
                  <input type="text" class="txt_field req" name="list_name" id="list_name" placeholder="قائمة الاسم" value="<?php echo (isset($single_list->list_name) ? $single_list->list_name : NULL);?>"/>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt">خطوات</div>
                <div class="form_field_selected">
                  <select name="steps" id="steps">
                  <?php for($x=1; $x<=10; $x++){?>
                    <option value="<?php echo $x;?>" ><?php echo $x;?></option>
                 <?php }?>
                  </select>
                </div>
              </div>
              
              <div class="form_raw">
                <div class="form_txt">وضع</div>
                <div class="form_field_selected">
                  <select name="list_status" id="list_status">
                    <option value="1" <?php if($single_list->list_status	==	'1'):?> selected="selected" <?php endif;?>>نشط</option>
                    <option value="0" <?php if($single_list->list_status	==	'0'):?> selected="selected" <?php endif;?>>دي نشط</option>
                  </select>
                </div>
              </div>
              
              <div class="main_withoutbg">
                <div class="add_question_btn">
                <?php if($list_id):?>
                	<input type="hidden" name="list_id" value="<?php echo $list_id;?>" />
                    <input type="hidden" name="list_type" value="rules" />
                <?php endif;?>
                  <input type="button" id="save_data_form" class="transperant_btn" name="save_data_form"  value="حفظ" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');?>
