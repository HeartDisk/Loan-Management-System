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
		var str	=	$("#save_data_form2").serialize();


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
<div id="dialog" class="web_dialog">
   <table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
      <tr>
         <td class="web_dialog_title">إضافة جديدة</td>
         <td class="web_dialog_title align_right">
            <a href="javascript:void(0)" id="btnClose" onClick="closePopup()">X</a>
         </td>
         
      </tr>
      <tr><td><input type="hidden" name="parent_id" id="parent_id" /></td></tr>
    </table>
   <div class="form_raw"  style="margin-top: 29px;">
      <div class="user_txt" style="width:auto; padding-left:26px;">إسم</div>
	    <div class="user_field">
        <input id="add_sub" name="add_sub" type="text" class="txt_field">
        </div>
    </div>
    <div class="user_field"><div class="add_team_btn"><input type="button" value="إضافة" class="transperant_btn" onclick=" addnew()" /> </div></div>    
</div>

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
   <form action="" method="POST" id="save_data_form2" name="save_data_form2">

                <div class="form_txt">قائمة الاسم</div>
                <div class="form_field">
                  <input type="text" class="txt_field req" name="list_name" id="list_name" placeholder="قائمة الاسم" value="<?php echo (isset($single_list->list_name) ? $single_list->list_name : NULL);?>"/>
                </div>
                
                <?php if($segment == ''):?>
                    <div class="form_txt"> اكتب قائمة</div>
                    <div class="form_field_selected">
                      <select name="list_type" id="list_type">
                        <option value="maritalstatus" <?php if($single_list->list_type	==	'maritalstatus'):?> selected="selected" <?php endif;?>>الحالة الزوجية</option>
                        <option value="current_situation" <?php if($single_list->list_type	==	'current_situation'):?> selected="selected" <?php endif;?>>الوضع الحالي</option>
                         <option value="inquiry_type" <?php if($single_list->list_type	==	'inquiry_type'):?> selected="selected" <?php endif;?>>الاستفسار عن قرض</option>
                      </select>
                    </div>
                <?php else:?>
                    <div class="form_txt"> اكتب قائمة</div>
                    <div class="form_field_selected">
                      <select name="list_type" id="list_type">
                      <?php if($segment == 'maritalstatus'):?>
                      	 <option value="maritalstatus" <?php if($single_list->list_type	==	'maritalstatus'):?> selected="selected" <?php endif;?>>الحالة الزوجية</option>
                      <?php endif;?>
                      <?php if($segment == 'current_situation'):?>
                      	 <option value="current_situation" <?php if($single_list->list_type	==	'current_situation'):?> selected="selected" <?php endif;?>>الوضع الحالي</option>
                      <?php endif;?>
                      <?php if($segment == 'inquiry_type'):?>
                      	<option value="inquiry_type" <?php if($single_list->list_type	==	'inquiry_type'):?> selected="selected" <?php endif;?>>الاستفسار عن قرض</option>
                      <?php endif;?>

                      </select>
                    </div>
                <?php endif;?>

                <div class="form_txt">وضع</div>
                <div class="form_field_selected">
                  <select name="list_status" id="list_status">
                    <option value="1" <?php if($single_list->list_status	==	'1'):?> selected="selected" <?php endif;?>>نشط</option>
                    <option value="0" <?php if($single_list->list_status	==	'0'):?> selected="selected" <?php endif;?>>دي نشط</option>
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
    <div class="user_field"><div class="add_team_btn"><input type="button" value="إضافة" class="transperant_btn" onclick=" addnew()" /> </div></div>    
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
          <!--<div class="data_box_title_icon"><img src="images/menu/question_s.png" width="22" height="20" /></div>-->
          <div class="data_title">‫<?php echo $type_name;?> </div>
          <div class="page_controls">
            <div class="page_control"><a class="addnewdata" href="#_" onclick="addTypes();">إضافة  </a></div>
          	<div class="page_control"><a style="float: left;margin-left: 93px;width: 104px;" class="addnewdata" href="<?php echo base_url();?>inquiries/listing">‫نوع القائمة‬‎</a></div>
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
          
          <?php $list_child_types	=	$this->listing->get_list_child_count($list->list_id);?>
          		<?php
				$type = $list->list_type;

				?>
                <div class="main_tab" id="bingo<?php echo $list->list_id;?>">
                  <div class="gray_main_right_icon"></div>
                  <div class="tab_txt" style="width:auto !important margin-right:50px;"><?php echo $list->list_name;?>
                  
                  <?php
				  	if($list->list_type != 'inquiry_type'){
				  ?>
                  <div class="other1" style="margin-right: 374px;margin-top: -18px;"> <input type="checkbox"  class="other" id="<?php echo $list->list_id;?>" name="other<?php echo $list->list_id;?>" <?php if($list->other):?> checked="checked" <?php endif;?>>
                  <div id="show<?php echo $list->list_id;?>" style="display:none; color:#060;margin-top: -20px; margin-right: 36px;">&#10004;</div>
                  <div id="hide<?php echo $list->list_id;?>" style="display:none; color:#060;margin-top: -20px; margin-right: 36px;"><img src="<?php echo base_url();?>images/body/contant/delete.png" width="16" height="16" /> </div>
                  </div>
                  <?php
					}
					else{
						?>
                        <?php if($list_child_types > 0):?>
                        <div class="tab_cotrols"> 
                          <a href="<?php echo base_url();?>inquiries/child_listing/<?PHP echo $list->list_id; ?>">
                              عرض الكل (<?php echo $list_child_types;?>)
                            </a> 
                      	</div>
                        <?php endif;?>
                      <div class="page_control" style="float:left;"><a id="addnew" href="javascript:void(0)" onclick="viewNew('<?php echo $list->list_id;?>')">إضافة</a></div>
                        <?php
					}
				  ?>
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
