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
          <div class="data_title">‫<?php echo $type_name;?></div>
          <!--<div class="page_controls">
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>--> 
        </div>
        <div class="data">
          <div class="main_data">
            <?php if(!empty($all_branches)): ?>
            <?php foreach($all_branches as $branch):?>

            <?php $privince	=	$this->branches->get_province_name($branch->province);?>
            <?php $wilayats	=	$this->branches->get_wilayats_name($branch->wilayats);?>
            
            <div class="main_tab" id="bingo<?php echo $branch->branch_id;?>">
              <div class="gray_main_right_icon"></div>
              <div class="tab_txt" style="width:auto !important; margin-right:50px;"><?php echo $branch->branch_name;?></div>
              <div class="tab_txt" style="width:auto !important; margin-right:50px;"><?php echo $branch->branch_code;?></div>
              <div class="tab_txt" style="width:auto !important; margin-right:50px;"><?php echo $wilayats;?></div>
              <div class="tab_txt" style="width:auto !important; margin-right:50px;"><?php echo $privince;?></div>
              <div class="tab_cotrols"> <a href="<?php echo base_url();?>branches/add/<?php echo $branch->branch_id;?>">
              <div class="tab_control"> <img src="<?php echo base_url();?>images/body/contant/edit.png" width="16" height="16"> تعديل</div>
                </a> <a class="delete-btn" id="<?php echo $branch->branch_id;?>" href="#_" data-url="<?php echo base_url();?>branches/delete/<?php echo $branch->branch_id;?>">
               <div class="tab_control_last"> <img src="<?php echo base_url();?>images/body/contant/delete.png" width="16" height="16"> حذف</div>
                </a> </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>
          </div>
        </div>
        <div id="dialog-confirm" title="حذف">
  <p><span class="ui-icon ui-icon-alert" style="float:right; margin:0 7px 20px 0;"></span>أنه سيتم حذف بشكل دائم ولا يمكن استردادها. هل أنت متأكد؟</p>
</div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');?>
