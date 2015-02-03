<style>
.team1_tab_top {
	width: 20% !important
}
.team1_tab_txt {
	width: 15% !important
}
.tab_control_last
{
	margin-left:-5px !important;
}
</style>
<style type="text/css">
table.gridtable {
	font-size:15px !important;
	color:#333333;
	border-width: 0px !important;
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
	border-width: 0px !important;
	font-size: 12px !important;
	padding: 6px !important;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
	text-align:right !important;
}
table.gridtable td {
	border-width: 0px !important;
	font-size: 12px !important;
	/*font-weight: bold !important;*/
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
.modal_window{    
	display:none; /* don't show it */
	position: fixed;
 
}

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
<script type="text/javascript">
function closePopup(){
		$("#overlay").hide();
		$("#dialog").hide();
		$("#dialog-form").hide();
}

function showPopup(id){
		$("#pk_id").val(id);	
		$("#dialog-form").show();
		$("#overlay").show();
		$("#dialog").show();
		$("#sms_msg").val('');
}
</script>
<?php $this->load->view('common/meta');?>
<div id="overlay" class="web_dialog_overlay"></div>
<div id="dialog-form" class="web_dialog_form">
<div class="data">
	
   <table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
      <tr>
         <td class="web_dialog_title">ارسال الرسائل القصيرة</td>
         <td class="web_dialog_title align_right">
            <a href="javascript:void(0)" id="btnClose" onClick="closePopup()">X</a>
         </td>
         
      </tr>
      <tr><td><input type="hidden" name="parent_id" id="parent_id" /></td></tr>
      <tr><td><label class="radio-inline">
                      <input type="radio" required="" id="sms_time" class="" value="1" data-handler="128_204" checked="checked" name="applicanttype_204">
                      الآن </label>
                    <label class="radio-inline">
                      <input type="radio" id="sms_time2" class="" value="0" data-handler="128_204" name="applicanttype_204">
                      فيما بعد </label></td></tr>
                      
            <tr id="show_time"><td><input type="text" name="date_time" id="date_time" /></td></tr>               
    </table>
   <form action="" method="POST" id="save_data_form1" name="save_data_form1">
               
               
               
               <div class="form_txt" style="width: 31px;">رسالة </div>
                <div class="form_field">
                <input type="hidden" name="pk_id" id="pk_id" value="" />
                <textarea id="sms_msg" class="txt_field" name="expiry_msg" onKeyUp="CharacterCount(this.id,'expiry_count')"><?php echo (isset($inq_info_sms[0]->sms_value) ? $inq_info_sms[0]->sms_value : NULL);?></textarea>
                </div>
                <span style="float: right; padding-right: 29px;">عدد الأحرف المكتوبة</span>
                <span id="expiry_count" style="background-color:#f7f7f7; border:1px solid #bcc0c2;float:right;color:#030;"></span>
              	<div class="main_withoutbg">
                <div class="add_question_btn">
                <input type="hidden" name="list_id" value="<?php echo $list_id;?>" />
                  <input type="button" class="transperant_btn" name="submit"  onclick="submit_form()" value="إرسال" />
                </div>
              </div>
            </form>

        </div>
    <div class="user_field"><div class="add_team_btn"><input type="button" value="إضافة" class="transperant_btn" onclick="addnew()" /> </div></div>    
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
          <div class="data_title">القائمة ‬‎</div>
          <!--<div class="page_controls">
            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>
            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>
          </div>--> 
        </div>
        
        <div class="data">
           <table class="gridtable">
              <tr>
                <!--<th>رقم </th>
                <th>الاسم</th>
                <th>رقم البطاقة الشخصية</th>
                <th>صيغة المشروع</th>
                <th>اسم المشروع</th>
                <th>التغييرات الأخيرة</th>
                <th>تاريخ التسجيل</th>-->
                <th>رقم </th>
                <th>الاسم</th>
                <th>النوع</th>
                <th> البطاقة الشخصية</th>
                <th> الهاتف</th>
                <th>أخر الإستفسارات</th>
                <th>تاريخ التسجيل</th>
                <th style="text-align:center !important;">الإجراءات</th>
              </tr>
              <?php if(!empty($inquiries)):?>
				  <?php foreach($inquiries as $i=>$inq):?>
                  
                  <?php $user_detail	=	$this->inq->get_user_name($inq->tempid);?>
                  
                  <?php $gender		=	$this->inq->get_gender($inq->tempid);?>
                  <?php $phone		=	$this->inq->get_phone_number($inq->tempid);?>
                  <?php 
				  	$data			=	$this->inq->get_last_note($inq->tempid);
	
					if($data->inquerytype)
					{
						$type_string	=	rtrim($data->inquerytype,',');
						$types_array 	=	explode(",", $type_string);
						$array_size		=	sizeof($types_array);
						
						if($array_size > 0)
						{
							$last_arry_key	=	end(array_keys($types_array));
							
							$last_array		=	$types_array[$last_arry_key] ;
							
							$type_id		=	explode("_", $last_array);
							
							$type_name	=	$this->inq->get_type_name($type_id['0']);
						}
						
					}
				  
				  ?>

                      <tr id="bingo<?php echo $inq->tempid;?>">
                        <td><?php echo applicant_number($inq->tempid);?></td>
                       <td><?php echo $user_detail->first_name.' '.$user_detail->middle_name.' '.$user_detail->last_name.' '.$user_detail->family_name;?></td>
                       <td><?php echo $gender;?></td>
                       <td><?php echo $user_detail->idcard;?></td>
                       <td>
                       	<?php foreach($phone as $ph):?>
							<?php echo $ph->phonenumber;?>
                        <?php endforeach;?>
                       </td>
                       <td><?php echo $type_name;?></td>
                       <td><?php echo $inq->applicantdate;?></td>
                        <td>
                        <div class="tab_cotrols">
                        <a href="<?php echo base_url() ?>inquiries/newinquery/<?php echo $inq->tempid;?>"  title="تعديل">
                        	<div class="tab_control"> <img src="<?php  echo base_url();?>images/body/contant/edit.png" width="16" height="16" /></div>
                        </a> <a href="#_" class="delete-btn" id="<?php echo $inq->tempid;?>" data-url="<?php echo base_url();?>inquiries/delete_auditor/<?php echo $inq->tempid;?>" title="حذف">
                        <div class="tab_control"> <img src="<?php  echo base_url();?>images/body/contant/delete.png" width="16" height="16" /></div>
                        </a> 
                         <a href="#_" title="مشاهدة" class="detail-view-inquiry" id="<?php echo $inq->tempid;?>">
                        <div class="tab_control_last"><img src="<?php  echo base_url();?>images/view.png" width="16" height="16"/> <!--مشاهدة--></div>
                        </a>
                         <!--<a href="#_" title="تاريخ" class="history" id="<?php echo $inq->tempid;?>">
                        <div class="tab_control_last"><img src="<?php  echo base_url();?>images/time_machine.png" width="16" height="16"/> <!--مشاهدة</div>
                        </a>-->
                        <a href="#_" title="رسالة " class="history" id="<?php echo $inq->tempid;?>"  onclick="showPopup('<?php echo $inq->tempid;?>')">
                        <div class="tab_control_last"><img src="<?php  echo base_url();?>images/forward.png" width="16" height="16"/> <!--مشاهدة--></div>
                        </a>
                        </div>
                        </td>
                      </tr>
                  <?php 
				  	unset($user_detail,$gender,$array_size,$last_arry_key,$last_array,$type_id,$type_name);
				  	endforeach;?>
              <?php endif;?>

            </table>

          <!--<div class="main_data">
          	<?php
				if(!empty($inquiries)){
				foreach($inquiries as $i=>$inq){
					if($i%2 == 0){
							$class = "green_main_right_icon";	
					}
					else{
						$class = "gray_main_right_icon";	
					}

					?>
                    <div class="main_tab">
              <div class="<?PHP echo $class; ?>"></div>
              <div class="team1_tab_txt" style="width:143px !important;"><?PHP echo $inq->auditor_name; ?></div>
              <div class="team1_tab_txt" style="width:100px !important;"><?PHP echo $inq->auditor_type; ?></div>
              <div class="team2_tab_txt" style="width:100px !important;"><?PHP echo $inq->auditor_id_number; ?></div>
              <div class="team2_tab_txt" style="width:100px !important;"><?PHP echo $inq->auditor_main_powrnumber; ?></div>
              <div class="team2_tab_txt" style="width:160px !important;"><?PHP echo $inq->auditor_job_staus; ?></div>
              <div class="team2_tab_txt" style="width:140px !important;"><?PHP echo $inq->auditor_regitered_date; ?></div>
              <div class="tab_cotrols">
                    <a class="delete-btn" id="<?php //echo $list->list_id;?>" data-url="<?php echo base_url();?>listing_managment/delete/<?php //echo $list->list_id.'/'.$type;?>" href="#_">
                    <div class="tab_control_last">
                    <img src="<?php echo base_url();?>images/body/contant/delete.png" width="16" height="16"> حذف</div>
                    </a>
                    
                    </div>
                    </div>
                    <?php
				}
				}
				else{
					echo "العثور على أي سجل";
				}
				?>
          </div>-->
        </div>
      </div>
    </div>
  </div>
</div>
<div id="dialog-message" class="show-content modal_window" title="مشاهدة">
<div id="dialog-confirm" title="تحذير" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>هل أنت متأكد أنك تريد الحذف؟</p>
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
CharacterCount = function(TextArea,FieldToCount){
	
	var myField = document.getElementById(TextArea);
	var myLabel = document.getElementById(FieldToCount); 
	//alert(myField);
	//alert(myLabel);
	//if(!myField || !myLabel){return false}; // catches errors
	//var MaxChars =  myField.maxLengh;
	//if(!MaxChars){MaxChars =  myField.getAttribute('maxlength') ; }; 	if(!MaxChars){return false};
	//var remainingChars =   MaxChars - myField.value.length
	if(myField.value.length>=70){
		
		$("#"+FieldToCount).css('color','red');
	}
	else{
		$("#"+FieldToCount).css('color','green');	
	}
	myLabel.innerHTML = myField.value.length;
}
function submit_form(){
		sms_text= $("#sms_msg").val();
		id= $("#pk_id").val();
	var request = $.ajax({
					  url: config.BASE_URL+'inquiries/sendSms',
					  type: "POST",
					  data: { id : id , message : sms_text},
					  dataType: "html",
					  success: function(msg)
					  {
							 $("#sms_msg").val('');
							 CharacterCount('sms_msg','expiry_count');
							 show_notification('أرسلت الرسائل القصيرة بنجاح');
							 closePopup();	
					  }
					}); 
}
</script>