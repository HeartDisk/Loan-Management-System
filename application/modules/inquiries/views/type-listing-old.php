<?php $this->load->view('common/meta');?>
<script>
$(document).ready(function(){
 $(".other").click(function(){
				var id = $(this).attr('id');
				var ele = $("#"+id).find(':checkbox');
				if ($("#"+id).prop('checked')) 
				{
				  ///ele.prop('checked', false);
				  var entry	=	'1';
				  $("#show"+id).show().delay(2000).fadeOut();
				} 
				else 
				{
				  var entry	=	'0';
				   $("#hide"+id).show().delay(2000).fadeOut();
				  //ele.prop('checked', true);
				}
		
				var request = $.ajax({
					  url: config.BASE_URL+'inquiries/other',
					  type: "POST",
					  data: { id : id , entry : entry},
					  dataType: "html",
					  success: function(msg){
						

					  }
					});  
			});
			});
</script>
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

              

          <div class="data_title">‫<?php echo $type_name;?> </div>
          <div class="page_controls">
            <div class="page_control"><a class="addnewdata" href="<?php echo base_url();?>inquiries/add">إضافة</a></div>
            <div class="page_control"><a style="float: left;margin-left: 93px;width: 104px;" class="addnewdata" href="<?php echo base_url();?>inquiries/listing">‫الاستفسار عن قرض</a></div>
          </div>

          <!--<div class="page_controls">inquiries/add
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>--> 
        </div>
        
        <div class="data">
          <div class="main_data">
          <?php if(!empty($listing)):?>
          <?php foreach($listing as $list):?>

          		<?php
				 if($list->list_type	==	'maritalstatus')
				{
					$type	==	'marital';
				}
				else if($list->list_type	==	'current_situation' )
				{

					$type	==	'situation';
				}
				else
				{
					$type	==	'inquiry_type';
				}
				?>
                <div class="main_tab" id="bingo<?php echo $list->list_id;?>">
                  <div class="gray_main_right_icon"></div>
                  <div class="tab_txt" style="width:auto !important margin-right:50px;"><?php echo $list->list_name;?>
                  <div class="other1" style="margin-right: 374px;margin-top: -18px;"> <input type="checkbox"  class="other" id="<?php echo $list->list_id;?>" name="other<?php echo $list->list_id;?>" <?php if($list->other):?> checked="checked" <?php endif;?>>
                  <div id="show<?php echo $list->list_id;?>" style="display:none; color:#060;margin-top: -20px; margin-right: 36px;">&#10004;</div>
                  <div id="hide<?php echo $list->list_id;?>" style="display:none; color:#060;margin-top: -20px; margin-right: 36px;"><img src="<?php echo base_url();?>images/body/contant/delete.png" width="16" height="16" /> </div>
                  </div>
                  </div>
<!--                  <div class="tab_txt" style="width:auto !important margin-right:50px;">
                    <input type="checkbox"  class="other" id="<?php echo $list->list_id;?>" name="other<?php echo $list->list_id;?>" <?php if($list->other):?> checked="checked" <?php endif;?>>
                    </div>-->
                  <div class="tab_cotrols">
                    <a href="<?php echo base_url();?>inquiries/add/<?php echo $list->list_id;?>">
                    <div class="tab_control">
                    <img src="<?php echo base_url();?>images/body/contant/edit.png" width="16" height="16">
                    تعديل</div>
                    </a>
                    <a class="delete-btn" id="<?php echo $list->list_id;?>" data-url="<?php echo base_url();?>inquiries/delete/<?php echo $list->list_id.'/'.$type;?>" href="#_">
                    <div class="tab_control_last">
                    <img src="<?php echo base_url();?>images/body/contant/delete.png" width="16" height="16"> حذف</div>
                    </a>
                    
                    </div>
                </div>
            <?php endforeach;?>
            <?php endif;?>
           
          </div>
        </div>
        <div id="dialog-confirm" title="تحذير">
          <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>أنه سيتم حذف بشكل دائم ولا يمكن استردادها. هل أنت متأكد؟</p>
        </div>

      </div>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');?>
