<script src="<?PHP echo base_url();?>js/jquery2.js"></script>
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

function check_sms(val){
	if(val == 1){
		$("#show_time").hide();
	}
	else{
		$("#show_time").show();
	}
}

$(document).ready(function(){
	$('#date_time').datetimepicker({
		  
		});
});
</script>
<style>
.team1_tab_top {
	width: 20% !important
}
.team1_tab_txt { 
	width: 15% !important
}
.raqam
{
	width:8% !important;
}
.mashrooh
{
	width:12% !important;
}
.hatif
{
	width:10% !important;
}
.marhala
{
	width:10% !important;
}
tfoot
{
	display: table-header-group !important;
}

.action {
    width:15% !important;
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
	height: 300px;
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
.gridtable td a:visited
{
	font-size:12px !important;
}
.raqam
{
	width:8% !important;
}
.mashrooh
{
	width:11% !important;
}
.hatif
{
	width:10% !important;
}
.marhala1
{
	width:15% !important;
}
.bataka
{
	width:13% !important;
}
.akhir
{
	width:13% !important;
}
.tareekh
{
	width:13% !important;
}
.ijrah
{
	width:13% !important;
}
.font-small{
	font-size:12px !important;
}
.act{
	width:15% !important;
}
tfoot
{
	display: table-header-group !important;
}
.paginate_button 
{
	/*display:none !important;*/
}
</style>
<script type="text/javascript">
CharacterCount = function(TextArea,FieldToCount){
	
	var myField = document.getElementById(TextArea);
	var myLabel = document.getElementById(FieldToCount);
	if(myField.value.length>=70){
		
		$("#"+FieldToCount).css('color','red');
	}
	else{
		$("#"+FieldToCount).css('color','green');	
	}
	myLabel.innerHTML = myField.value.length;
}
function submit_form(){
		var sms_text = $("#sms_msg").val();
		var id = $("#pk_id").val();
		var dateTime = $("#date_time").val();
		var sms_time = $(".sms_time:checked").val();
		//sms_time
		var request = $.ajax({
		url: config.BASE_URL+'inquiries/sendSms',
		type: "POST",
		data:{xid:id,message:sms_text,dateTime,dateTime,sms_time:sms_time},
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
<?php $this->load->view('common/meta');?>
<div id="overlay" class="web_dialog_overlay"></div>
<div id="dialog-form" class="web_dialog_form">
<div class="data">
	   <form action="" method="POST" id="save_data_form1" name="save_data_form1">	
   <table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
      <tr>
         <td class="web_dialog_title">ارسال الرسائل القصيرة</td>
         <td class="web_dialog_title align_right">
            <a href="javascript:void(0)" id="btnClose" onClick="closePopup()">X</a>
         </td>
         
      </tr>
      <tr><td><input type="hidden" name="parent_id" id="parent_id" /></td></tr>
      <tr><td><label class="radio-inline">
                      <input type="radio" required=""  id="sms_time" class="sms_time" value="1" data-handler="128_204" checked="checked" name="sms_time" onchange="check_sms(this.value)">
                      الآن </label>
                    <label class="radio-inline">
                      <input type="radio" id="sms_time2" class="sms_time" value="0" data-handler="128_204" name="sms_time" onchange="check_sms(this.value)">
                      لاحقاً </label></td></tr> 
      </table>
   
   				<div id="show_time" style="display:none;">
   				<div class="form_txt" style="width: 99px;"> حدد التاريخ والوقت</div>
                <div class="form_field" style="padding-top: 5px; padding-bottom: 8px;">
       	         <input type="text"  class="txt_field" name="date_time" id="date_time" />
                </div>
                </div>	
                <br   clear="all"/>
               <div class="form_txt" style="width: 99px;">رسالة </div>
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
      <?php $success	=	$this->session->flashdata('success');?>
      <?php if(!empty($success)):?>
      <div class="right_nav_raw">
        <div class="nav_icon"><img src="<?php echo base_url();?>images/body/right.png" width="60" height="60"></div>
        <?php echo $success;?> </div>
      <?php endif;?>
      <div class="data_raw">
        <div class="main_box">
          <div class="data_box_title"> 
            <div class="data_title">قائمة المعاملات‬‎</div>
          </div>
          <div class="data">
           <table id="example" class="table table-striped table-bordered gridtable" cellspacing="0" width="100%">
           <thead>
              <tr>
                <th class="raqam">رقم</th>
                <th>الاسم</th>
                <th class="mashrooh">صيغة المشروع</th>
                <th class="anwoa">النوع</th>
                <th class="bataka">البطاقة الشخصية</th>
                <th class="hatif"> الهاتف</th>
                <th class="marhala1">المرحلة</th>
                <th class="act">الإجراءات</th>
              </tr>
            </thead>
            <tfoot>
                <tr>
                  <td><input type="text" name="textfield" id="textfield"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield2" id="textfield2"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield9" id="textfield9"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield3" id="textfield3"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield7" id="textfield7"  class="flex_feild"/></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
             </tfoot>
             <tbody>
              <?php if(!empty($all_applicatns)):?>
              <?php foreach($all_applicatns as $applicatnt):?>
              <?php $professional	=	$this->inq->getRequestInfo($applicatnt->applicant_id);?>
              <?php $phone			=	$this->inq->applicant_phone_number($applicatnt->applicant_id);?>
              <?php //echo '<pre>'; print_r($professional['applicant_partners']);?>
              <?php $professional	=	$this->inq->getRequestInfo($applicatnt->applicant_id);?>
              <?php //echo '<pre>'; print_r($professional['applicant_partners']);?>
              <tr id="bingo<?php echo $applicatnt->applicant_id;?>">
                <td><?php echo applicant_number($applicatnt->applicant_id);?></td>
                <td><?php echo $applicatnt->applicant_first_name.' '.$applicatnt->applicant_middle_name.' '.$applicatnt->applicant_last_name.' '.$applicatnt->applicant_sur_name .'<br>';?>
                  <?php //print_r($professional['applicant_partners']);?>
                  <?php if(!empty($professional['applicant_partners'])):?>
                  <?php foreach($professional['applicant_partners'] as $partners):?>
                  <?php echo $partners->partner_first_name.' '.$partners->partner_middle_name.' '.$partners->partner_last_name.' '.$partners->partner_sur_name .'<br>';?>
                  <?php endforeach;?>
                  <?php endif;?></td>
                <td><?php  echo $applicatnt->applicant_type;?></td>
                <td><?php  echo $applicatnt->applicant_gender;?>
                  <?php if(!empty($professional['applicant_partners'])):?>
                  <?php echo '<br>';?>
                  <?php foreach($professional['applicant_partners'] as $partners):?>
                  <?php echo $partners->partner_gender.'<br>';?>
                  <?php endforeach;?>
                  <?php endif;?></td>
                <td><?php  echo $applicatnt->appliant_id_number;?></td>
                <td>
                	<?php if(!empty($phone)):?>
						<?php foreach($phone as $ph):?>
                        <?php echo $ph->applicant_phone.'<br>';?>
                        <?php endforeach;?>
                    <?php endif;?>
                  
                  <?php //echo '<pre>'; print_r($professional['applicant_partners']);?>
                  <?php if(!empty($professional['applicant_partners']['partner_phone'])):?>
					  <?php echo '<br>';?>
                      <?php foreach($professional['applicant_partners']['partner_phone'] as $partners):?>
                      <?php //echo $partners->applicant_phone.'<br>';?>
                      <?php endforeach;?>
                  <?php endif;?>
               </td>
                <td>
				  <?php if($applicatnt->form_step	==	'1'): echo 'تسجيل الطلبات'; endif;?>
                  <?php if($applicatnt->form_step	==	'2'): echo 'بيانات المشروع'; endif;?>
                  <?php if($applicatnt->form_step	==	'3'): echo 'القرض المطلوب'; endif;?>
                  <?php if($applicatnt->form_step	==	'4'): echo 'دراسه وتحليل الطلب'; endif;?>
                  <?php if($applicatnt->form_step	==	'5'): echo 'قرار اللجنة'; endif;?></td>
                <td>
                <a href="<?php echo base_url() ?>inquiries/newrequest/<?php echo $applicatnt->applicant_id.'/'.$applicatnt->form_step;?>">
                <img src="<?php  echo base_url();?>images/body/contant/edit.png" width="16" height="16" /> <!--تعديل-->
                    </a> <a href="#" class="delete-btn" id="<?php echo $applicatnt->applicant_id;?>" data-url="<?php echo base_url();?>inquiries/delete_applicant/<?php echo $applicatnt->applicant_id;?>">
                    <img src="<?php  echo base_url();?>images/body/contant/delete.png" width="16" height="16" />
                    </a>
                    <a href="#_" class="detail" id="<?php echo $applicatnt->applicant_id;?>">
                    <img src="<?php  echo base_url();?>images/view.png" width="16" height="16"/>
                    </a> 
                  <a class="fancybox fancybox.ajax" href="<?php  echo base_url();?>ajax/timeline/<?php echo($applicatnt->applicant_id);?>/<?php echo $applicatnt->form_step;?>"><img src="<?php  echo base_url();?>images/timeline.png" width="16" height="16"/></a>
                  <a href="#_" title="رسالة " class=""  onclick="showPopup('<?php echo $applicatnt->applicant_id;?>')">
                        <img src="<?php  echo base_url();?>images/forward.png" width="16" height="16"/>
                        </a>
                  </td>
              </tr>

              <?php endforeach;?>
              <?php endif;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="set-dialog-message-2" class="show-content" title="مشاهدة" style="display:none;"> </div>
<div id="dialog-confirm" title="حذف" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float:right; margin:0 7px 20px 0;"></span>أنه سيتم حذف بشكل دائم ولا يمكن استردادها. هل أنت متأكد؟</p>
</div>
<script>
$(function(){
if($('#example').length > 0)
{
	 $('#example tfoot td').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
		var attr_id = $('#example thead th').eq( $(this).index() ).attr('id');
		$(this).html( '<input class="'+attr_id+' searchfilter" type="text" placeholder="'+title+'" />' );		
    } );
	
	
	
	var user_table = $('#example').DataTable();	
	user_table.columns().eq(0).each( function ( colIdx ) {		
        $( 'input', user_table.column( colIdx ).footer() ).on( 'keyup change', function () {
            user_table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
		
    } );
	$('#example_filter').hide();
	
	$('.searchfilter').keyup(function(){
		//console.log($(this).val());
		$('#example tbody td').removeHighlight().highlight($(this).val());
	});
	
}
	
	
});
</script>
<?php $this->load->view('common/footer');?>
