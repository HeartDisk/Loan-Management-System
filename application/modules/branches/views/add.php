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
          <div class="data_title">إضافة الفروع</div>
          <!--<div class="page_controls">
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>-->
        </div>

        <div class="data">
          <div class="main_data">
            <form action="<?php echo current_url();?>" method="post" id="validate_form" name="validate_form" autocomplete="off">
              <div class="form_raw">
                <div class="form_txt">اسم الفرع</div>
                <div class="form_field">
                  <input type="text" class="txt_field req" name="branch_name" id="branch_name" value="<?php echo (isset($single_branche->branch_name) ? $single_branche->branch_name : NULL);?>" placeholder="اسم الفرع"/>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt">فرع كود</div>
                <div class="form_field">
                  <input type="text" class="txt_field req" name="branch_code"  id="branch_code" value="<?php echo (isset($single_branche->branch_code) ? $single_branche->branch_code : NULL);?>" placeholder="فرع كود"/>
                </div>
              </div>
              <div class="form_raw">
                  <div class="user_txt">محافظة</div>
                  <div class="user_field">
                  <div class="form_field_selected"><?PHP reigons('province',$single_branche->province); ?></div>
                  </div>
                  
                   <div class="user_txt" style="margin-right: 11px;">الولاية</div>
                  <div class="user_field">
                  <div class="form_field_selected"><?PHP election_wilayats('wilayats',$single_branche->wilayats); ?></div>
                  </div>
                  
                </div>
                <div class="form_raw">
                <div class="form_txt">عنوان الفرع</div>
                <div class="form_field_selected">
                  <textarea style="margin: 0px; width: 300px; height: 93px;" name="branch_address" id="branch_address"><?php echo (isset($single_branche->branch_address) ? $single_branche->branch_address : NULL);?></textarea>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt">وضع</div>
                <div class="form_field_selected">
                  <select name="status">
                    <option value="1" <?php if($single_branche->status	==	'1'):?> selected="selected" <?php endif;?>>نشط</option>
                    <option value="0" <?php if($single_branche->status	==	'0'):?> selected="selected" <?php endif;?>>دي نشط</option>
                  </select>
                </div>
              </div>
              <div class="main_withoutbg">
                <div class="add_question_btn">
                <input type="hidden" name="branch_id"  value="<?php echo $branch_id;?>" />
                <input type="button" name="save_data_form" id="save_data_form" class="transperant_btn"  value="حفظ" />
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
