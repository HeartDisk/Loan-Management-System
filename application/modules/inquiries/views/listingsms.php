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
          <div class="data_title">القائمة القصيرة‬‎</div>
          <!--<div class="page_controls">
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>--> 
        </div>
        
        <div class="data">
          <div class="main_data">
          	<?php
				//echo "<pre>";
				
				//print_r($sms);
				if(!empty($sms)){
				foreach($sms as $sm){
					if($sm->sms_status == 1){
						$class = "green_main_right_icon";
					}
					else{
					$class = "gray_main_right_icon";	
					}
					?>
                    <div class="main_tab">
              <div class="<?PHP echo $class; ?>"></div>
              <div class="team1_tab_txt" style="width:auto !important; padding-left:86px;"><?PHP echo $sm->auditor_name; ?></div>
              <div class="team1_tab_txt" style="width:auto !important;padding-left:86px;"><?PHP echo $sm->sms_receiver_number; ?></div>
              <div class="team2_tab_txt" style="width:auto !important;padding-left:86px;"><?PHP echo $sm->sms_sent_date; ?></div>
              <div class="tab_cotrols">
                    <?PHP if(check_permission($module,'d')==1) { ?><a class="delete-btn" id="<?php echo $list->list_id;?>" data-url="<?php echo base_url();?>listing_managment/delete/<?php echo $list->list_id.'/'.$type;?>" href="#_">
                    <div class="tab_control_last">
                    <img src="<?php echo base_url();?>images/body/contant/delete.png" width="16" height="16"> حذف</div>
                    </a>
                    <?PHP } ?>
                    </div>
                    </div>
                    <?php
				}
				}
				else{
					echo "العثور على أي سجل";
				}
				
			 /*foreach($this->listing->get_list_type() as $listdata) { 
					$typename = list_types($listdata->list_type);
			
			?>
            <div class="main_tab">
              <div class="gray_main_right_icon"></div>
              <div class="tab_txt" style="width:auto !important;"><?PHP //echo $typename['ar']; ?></div>
              <div class="tab_cotrols"> 
                (<?php // echo $this->listing->total_count($listdata->list_type); ?>) </div>
              
            </div>
            <?PHP }*/ ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');?>
