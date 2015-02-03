<?php $this->load->view('common/meta');?>
<script>
function closePopup()
{
		$("#overlay").hide();
		$("#dialog").hide();
		$("#dialog-form").hide();
}
function open_form()
{
	$("#overlay").show();
	$("#dialog-form").show();
}
function submitdata()
{
	var str	=	$("#save_data_form3").serialize();

	 var request = $.ajax({
	  url: config.BASE_URL+'inquiries/addrules',
	  type: "POST",
	  data: str,
	  dataType: "html",
	  success: function(msg){
		  //console.log(msg);
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

<div id="dialog-form" class="web_dialog_form">
<div class="data">

   <table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
      <tr>
         <td class="web_dialog_title">إضافة جديدة</td>
         <td class="web_dialog_title align_right">
            <a href="javascript:void(0)" id="btnClose" onClick="closePopup()">X</a>
         </td>
         
      </tr>
    </table>
   <form action=""  id="save_data_form3" name="save_data_form3">

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
                <?php endif;?>
                  <input type="hidden" name="list_type" value="rules" />
                  <input type="button" id="save_data_form" class="transperant_btn" name="save_data_form"  value="حفظ" onclick="submitdata();"/>
                </div>
              </div>
            </form>
        </div>
    <div class="user_field"><div class="add_team_btn"><input type="button" value="إضافة" class="transperant_btn"  /> </div></div>    
</div>

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
          <div class="data_title">قواعد القيد و</div>
          <div class="page_controls">
            <div class="page_control"><a class="addnewdata" href="#_" onclick="open_form();">إضافة</a></div>
            <!--<div class="page_control"><a style="float: left;margin-left: 93px;width: 104px;" class="addnewdata" href="<?php echo base_url();?>inquiries/listing">‫الاستفسار عن قرض</a></div>-->
          </div>
          <!--<div class="page_controls">
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>--> 
        </div>
        
        <div class="data">
          <div class="main_data">
          	<?php foreach($listing as $listdata) { ?>
            <div class="main_tab" id="bingo<?php echo $listdata->list_id;?>">
              <div class="gray_main_right_icon"></div>
              <div class="tab_txt" style="width:auto !important;"><?PHP echo $listdata->list_name; ?></div>
            <div class="tab_cotrols">
            <a href="<?php echo base_url();?>inquiries/addrules/<?php echo $listdata->list_id;?>">
            <div class="tab_control">
            <img src="<?php echo base_url();?>images/body/contant/edit.png" width="16" height="16">
            تعديل</div>
            </a>
            <a class="delete-btn" id="<?php echo $listdata->list_id;?>" data-url="<?php echo base_url();?>inquiries/delete_rule/<?php echo $listdata->list_id;?>" href="#_">
            <div class="tab_control_last">
            <img src="<?php echo base_url();?>images/body/contant/delete.png" width="16" height="16"> حذف</div>
            </a>
            
            </div>
            </div>
            <?PHP } ?>
          </div>
        </div>
        <div id="dialog-confirm" title="تحذير" style="display:none;">
          <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>أنه سيتم حذف بشكل دائم ولا يمكن استردادها. هل أنت متأكد؟</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');?>
