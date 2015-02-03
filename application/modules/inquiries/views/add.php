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
          <div class="data_title">البحث في الأسئلة</div>
          <!--<div class="page_controls">
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>-->
        </div>
        <div class="data">
          <div class="main_data">
            <form action="<?php echo current_url();?>" method="POST" id="form2" name="form2">
              <div class="form_raw">
                <div class="form_txt">قائمة الاسم</div>
                <div class="form_field">
                  <input type="text" class="txt_field req" name="list_name" id="list_name" placeholder="قائمة الاسم" value="<?php echo (isset($single_list->list_name) ? $single_list->list_name : NULL);?>"/>
                </div>
              </div>
              <div class="form_raw">
                <div class="form_txt"> اكتب قائمة</div>
                <div class="form_field_selected">
                  <select name="list_type" id="list_type">
                    <option value="review_request" <?php if($single_list->list_type	==	'review_request'):?> selected="selected" <?php endif;?>> مراجعة طلب قرض</option>
                    <option value="completion" <?php if($single_list->list_type	==	'completion'):?> selected="selected" <?php endif;?>>استكمال مستندات القرض</option>
                    <option value="read_only" <?php if($single_list->list_type	==	'read_only'):?> selected="selected" <?php endif;?>>صرف دفعات</option>
                    <option value="receipt_approval" <?php if($single_list->list_type	==	'receipt_approval'):?> selected="selected" <?php endif;?>>استلام موافقة</option>
                    <option value="settlement_loans" <?php if($single_list->list_type	==	'settlement_loans'):?> selected="selected" <?php endif;?>>تسوية قروض</option>
                    <option value="attend_committee" <?php if($single_list->list_type	==	'attend_committee'):?> selected="selected" <?php endif;?>>حضور لجنة</option>
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
                <?php endif;?>
                  <input type="button" id="save_data" class="transperant_btn" name="save_data_form"  value="حفظ" />
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
