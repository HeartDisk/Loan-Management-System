<?php $this->load->view('common/meta');?>
<?php $segment	=	 $this->uri->segment(3);?>
<script>
function closePopup(){
		$("#overlay").hide();
		$("#dialog").hide();
		$("#dialog-form").hide();
}
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
					  success: function(msg)
					  {

					  }
					});  
			});
		
			});
			
			function viewNew(id){
				$("#overlay").show();
				$("#dialog").show();
				$("#parent_id").val(id);
			}
			
			function addTypes()
			{
				$("#overlay").show();
				$("#dialog-form").show();
			}
			
			function addnew(){
				
				var parent_id	= $("#parent_id").val();
				var add_sub		= $("#add_sub").val();
				
				
					var request = $.ajax({
					  url: config.BASE_URL+'inquiries/add_new',
					  type: "POST",
					  data: { parent_id : parent_id , add_sub : add_sub},
					  dataType: "html",
					  success: function(msg)
					  {
							$("#overlay").hide();
							$("#dialog").hide();
							
							window.location.href	=	config.CURRENT_URL;
					  }
					});
			}
function submit_form()
{
		var str	=	$("#save_data_form1").serialize();

		 var request = $.ajax({
		  url: config.BASE_URL+'inquiries/add',
		  type: "POST",
		  data: str,
		  dataType: "html",
		  success: function(msg){
			  
			  window.location.href	=	config.CURRENT_URL;
		  }
		});
}
</script>
 <style type="text/css">

.web_dialog_overlay
{
   position: fixed;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   height: 100%;
   width: 100%;
   margin: 0;
   padding: 0;
   background: #000000;
   opacity: .15;
   filter: alpha(opacity=15);
   -moz-opacity: .15;
   z-index: 101;
   display:none;
}
.web_dialog
{
   position: fixed;
   width: 380px;
   height: 140px;
   top: 50%;
   left: 50%;
   margin-left: -190px;
   margin-top: -100px;
   background-color: #ffffff;
   border: 2px solid #0000;
   padding: 0px;
   z-index: 102;
   font-family: Verdana;
   font-size: 10pt;
   display:none;
}
.web_dialog_form
{
	position: fixed;
	width: 405px;
	height: 230px;
	top: 50%;
	left: 50%;
	margin-left: -212px;
	margin-top: -100px;
	background-color: #ffffff;
	border: 2px solid #0000;
	padding: 13px;
	z-index: 102;
	font-family: Verdana;
	font-size: 10pt;
	display: none;
}
.web_dialog_title
{
   border-bottom: solid 2px #0000;
   background-color: #CCC;
   padding: 4px;
   color: White;
   font-weight:bold;
   text-align:right;
}
.web_dialog_title a
{
   color: White;
   text-decoration: none;
}
.align_right
{
   text-align: Left;
}
.msg{
	text-align: center;
	padding-top: 16%;
}

</style>

<div class="body">
<div id="overlay" class="web_dialog_overlay"></div>
<div id="dialog-form" class="web_dialog_form">
<div class="data">

   <table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
      <tr>
         <td class="web_dialog_title">إضافة جديدة</td>
         <td class="web_dialog_title align_right">
            <a href="javascript:void(0)" id="btnClose" onClick="closePopup()">X</a>
         </td>
         
      </tr>
      <tr><td><input type="hidden" name="parent_id" id="parent_id" /></td></tr>
    </table>
   <form action="" method="POST" id="save_data_form1" name="save_data_form1">

                <div class="form_txt">اسم القائمة</div>
                <div class="form_field">
                  <input type="text" class="txt_field req" name="list_name" id="list_name" placeholder="اسم القائمة" value="<?php echo (isset($single_list->list_name) ? $single_list->list_name : NULL);?>"/>
                </div>
                
                <?php if($segment == ''):?>
                    <div class="form_txt"></div>
                    <div class="form_field_selected">
                      <select name="list_type" id="list_type">
                        <option value="rules" <?php if($single_list->list_type	==	'rules'):?> selected="selected" <?php endif;?>> قواعد</option>
                        <option value="qualification" <?php if($single_list->list_type	==	'qualification'):?> selected="selected" <?php endif;?>>المؤهل</option>
                        <option value="nature_project_site" <?php if($single_list->list_type	==	'nature_project_site'):?> selected="selected" <?php endif;?>>‫طبيعة موقع المشروع‬‎</option>
                        <option value="nature_project" <?php if($single_list->list_type	==	'nature_project'):?> selected="selected" <?php endif;?>>‫طبيعة محل المشروع‬‎</option>
                        <option value="business_type" <?php if($single_list->list_type	==	'business_type'):?> selected="selected" <?php endif;?>>‫القطاع الإقتصادي‬‎</option>
                        <option value="activity_project" <?php if($single_list->list_type	==	'activity_project'):?> selected="selected" <?php endif;?>>‫نشاط المشروع‬‎</option>
                        <option value="project_employment" <?php if($single_list->list_type	==	'project_employment'):?> selected="selected" <?php endif;?>>‫التعمين‬‎</option>
                        <option value="project_type" <?php if($single_list->list_type	==	'qualification'):?> selected="selected" <?php endif;?>>‫نوع المشروع‬‎</option>
                       </select>
                    </div>
                <?php else:?>
                    <div class="form_txt"></div>
                    <div class="form_field_selected">
                      <select name="list_type" id="list_type">
						  <?php if($segment == 'rules'):?>
                             <option value="rules" <?php if($single_list->list_type	==	'rules'):?> selected="selected" <?php endif;?>>قواعد</option>
                          <?php endif;?>
                          <?php if($segment == 'qualification'):?>
                             <option value="qualification" <?php if($single_list->list_type	==	'qualification'):?> selected="selected" <?php endif;?>>المؤهل</option>
                          <?php endif;?>
                          <?php if($segment == 'nature_project_site'):?>
                             <option value="nature_project_site" <?php if($single_list->list_type	==	'nature_project_site'):?> selected="selected" <?php endif;?>>‫طبيعة موقع المشروع</option>
                          <?php endif;?>
                          <?php if($segment == 'nature_project'):?>
                             <option value="nature_project" <?php if($single_list->list_type	==	'nature_project'):?> selected="selected" <?php endif;?>>‫طبيعة محل المشروع‬‎</option>
                          <?php endif;?>
                          <?php if($segment == 'business_type'):?>
                             <option value="business_type" <?php if($single_list->list_type	==	'business_type'):?> selected="selected" <?php endif;?>>القطاع الإقتصادي‬‎</option>
                          <?php endif;?>
                          <?php if($segment == 'activity_project'):?>
                             <option value="activity_project" <?php if($single_list->list_type	==	'activity_project'):?> selected="selected" <?php endif;?>>‫نشاط المشروع</option>
                          <?php endif;?>
                          <?php if($segment == 'project_employment'):?>
                             <option value="project_employment" <?php if($single_list->list_type	==	'project_employment'):?> selected="selected" <?php endif;?>>التعمين‬‎</option>
                          <?php endif;?>
                          <?php if($segment == 'project_type'):?>
                             <option value="project_type" <?php if($single_list->list_type	==	'project_type'):?> selected="selected" <?php endif;?>>نوع المشروع</option>
                          <?php endif;?>
                      </select>
                    </div>
                <?php endif;?>

                <div class="form_txt">الوضع</div>
                <div class="form_field_selected">
                  <select name="list_status" id="list_status">
                    <option value="1" <?php if($single_list->list_status	==	'1'):?> selected="selected" <?php endif;?>>نشط</option>
                    <option value="0" <?php if($single_list->list_status	==	'0'):?> selected="selected" <?php endif;?>>غير نشط</option>
                  </select>
                </div>
              <div class="main_withoutbg">
                <div class="add_question_btn">
                <input type="hidden" name="list_id" value="<?php echo $list_id;?>" />
                  <input type="button" class="transperant_btn" name="submit"  onclick="submit_form();" value="حفظ" />
                </div>
              </div>
            </form>

        </div>
    <?PHP if(check_permission($module,'a')==1) { ?><div class="user_field"><div class="add_team_btn"><input type="button" value="إضافة" class="transperant_btn" onclick="addnew()" /> </div></div><?PHP } ?>
</div>
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
          <div class="data_title">كل قائمة</div>
          <div class="page_controls">
             <div class="page_control"><a class="addnewdata" href="#_" onclick="addTypes();">إضافة  </a></div>
            <!--<div class="page_control"><a style="float: left;margin-left: 93px;width: 104px;" class="addnewdata" href="<?php echo base_url();?>inquiries/rule_qualification_listing">‫Rules Qual Listing</a></div>-->
          </div>
          <div class="page_controls">
           <!-- <div class="page_control"><a href="#"><img src="<?php echo base_url();?>images/body/contant/back.png" width="28" height="26" border="0" /></a></div>-->
          </div>
        </div>
               
        <div class="data">
          <div class="main_data">
          
            <?php foreach($this->listing->get_list_type_rule_qualification() as $listdata) { 
					$typename = list_types($listdata->list_type);
			
			?>
            <div class="main_tab">
              <div class="gray_main_right_icon"></div>
              <div class="tab_txt" style="width:auto !important;"><?php echo $typename['ar']; ?></div>
              <div class="tab_cotrols"> 
                إجمالي عدد (<?php echo $this->listing->total_count($listdata->list_type); ?>) </div>
              <div class="tab_cotrols"> 
                  <a href="<?php echo base_url();?>inquiries/rule_qualification_listing/<?php echo $listdata->list_type; ?>">
                     عرض الكل
                    </a> 
              </div>
            </div>
            <?PHP } ?>
     
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');?>
