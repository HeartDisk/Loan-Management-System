<style>
.team1_tab_top {
	width: 20% !important
}
.team1_tab_txt {
	width: 15% !important
}
</style>
<style type="text/css">
table.gridtable {
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: separate !important;
	direction:rtl !important;
	width: 98% !important;
    border-radius: 5px !important;
    -moz-border-radius: 5px !important;
	margin: 2px 10px !important;
    border-spacing: 0 !important;
}
table.gridtable th {
	border-width: 1px;
	font-size: 16px !important;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	font-size: 15px !important;
	font-weight: bold;
	padding: 5px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>
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
      <?php echo $success;?> </div>
    <?php endif;?>
    <div class="data_raw">
      <div class="main_box">
        <div class="data_box_title"> 
          <!--<div class="data_box_title_icon"><img src="images/menu/question_s.png" width="22" height="20" /></div>-->
          <div class="data_title">قائمة قرار اللجنة ‬‎</div>
          <!--<div class="page_controls">
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>--> 
        </div>
        <div class="data">
          <table class="gridtable">
              <tr>
                <th>رقم التسجيل</th>
                <th>اسم مقدم الطلب</th>
                <th>صيغة المشروع</th>
                <th>النوع</th>
                <th>رقم البطاقة الشخصية</th>
                <th>المرحلة</th>
                <th>الإجراءات</th>
              </tr>
              
              <?php if(!empty($all_applicatns)):?>
				  <?php foreach($all_applicatns as $applicatnt):?>
                      <tr id="bingo<?php echo $applicatnt->applicant_id;?>">
                        <td><?php echo applicant_number($applicatnt->applicant_id);?></td>
                        <td><?php echo $applicatnt->applicant_first_name.' '.$applicatnt->applicant_middle_name.' '.$applicatnt->applicant_last_name.' '.$applicatnt->applicant_sur_name;?></td>
                        <td><?php  echo $applicatnt->applicant_type;?></td>
                        <td><?php  echo $applicatnt->applicant_gender;?></td>
                        <td><?php  echo $applicatnt->appliant_id_number;?></td>
                        <td>
							<?php if($applicatnt->form_step	==	'1'): echo 'تسجيل الطلبات'; endif;?>
                            <?php if($applicatnt->form_step	==	'2'): echo 'بيانات المشروع'; endif;?>
                            <?php if($applicatnt->form_step	==	'3'): echo 'القرض المطلوب'; endif;?>
                            <?php if($applicatnt->form_step	==	'4'): echo 'دراسه وتحليل الطلب'; endif;?>
                        </td>
                        <td>
                        <div class="tab_cotrols">
                        <a href="<?php echo base_url() ?>inquiries/newrequest/<?php echo $applicatnt->applicant_id.'/'.$applicatnt->form_step;?>">
                        	<div class="tab_control"> <img src="<?php  echo base_url();?>images/body/contant/edit.png" width="16" height="16" /> تعديل</div>
                        </a> <a href="#" class="delete-btn" id="<?php echo $applicatnt->applicant_id;?>" data-url="<?php echo base_url();?>inquiries/delete_applicant/<?php echo $applicatnt->applicant_id;?>">
                        <div class="tab_control"> <img src="<?php  echo base_url();?>images/body/contant/delete.png" width="16" height="16" /> حذف</div>
                        </a> 
                         <a href="#" class="detail" id="<?php echo $applicatnt->applicant_id;?>">
                        <div class="tab_control_last">مشاهدة</div>
                        </a></div>
                        </td>
                      </tr>
                  <?php endforeach;?>
              <?php endif;?>

            </table>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="dialog-message" class="show-content" title="مشاهدة" style="display:none;">
</div>
    <div id="dialog-confirm" title="حذف" style="display:none;">
      <p><span class="ui-icon ui-icon-alert" style="float:right; margin:0 7px 20px 0;"></span>أنه سيتم حذف بشكل دائم ولا يمكن استردادها. هل أنت متأكد؟</p>
    </div>
<?php $this->load->view('common/footer');?>

