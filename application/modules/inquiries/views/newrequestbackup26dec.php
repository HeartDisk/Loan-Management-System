<?php $this->load->view('common/meta');
$main = $m;
if($type != "inquiry")
{
	$applicant = $main['applicants'];
	$applicant_qualification = $main['applicant_qualification'][0];
	$applicant_project = $main['applicant_project'];
	$applicant_professional_experience = $main['applicant_professional_experience'];
	$applicant_phones = $main['applicant_phones'];
	$applicant_partners = $main['applicant_partners'];
	$applicant_numbers = $main['applicant_numbers'];
	$applicant_loans = $main['applicant_loans'];
	$applicant_document = $main['applicant_document'];
	$applicant_businessrecord = $main['applicant_businessrecord'];	
	$step['s'] = 1;
	$step['temp'] = $applicant->applicant_id;
}
else
{
	$applicant = $main['main']->applicant[0];
	$phones = $main['main']->phones;
	$tempId = $main['main']->tempid;
}
if(isset($type) && $type == "inquiry") 
{}	
?>

<div class="body">
<div class="feedback_content"> </div>
<?PHP $this->load->view('viewforrequest');?>
<?php $this->load->view('common/banner');?>
<script>
$(function(){
	var aid = '<?PHP echo $a_id; ?>';
	var asteps = '<?PHP echo $a_step; ?>';
	var menuid = '<?PHP echo get_step_id($a_step); ?>';
	if(asteps!='' && asteps!=0 && asteps!=1)
	{
		$('#'+menuid).attr('data-id',aid);
		$('#'+menuid).click();
	}
	$("#option2").click(function(e) {
        slVal = $(this).val();
		//alert(slVal);
		$("#disable").show();
    });
	$("#option23").click(function(e) {
        slVal = $(this).val();
		//alert(slVal);
		$("#disable").hide();
    });
	$( "#nimbus" ).tabs();
});


function checkType(val){
		
	///slVal = $(this).val();
		//alert('sdfsdf');
		if(val == 'Y'){
				$("#disable").show();
		}
		else{
			$("#disable").hide();
		}
}
</script>
<div id="tasjeel"></div>
<div class="body_contant">
  <div id="dialog-confirm_dd" title="تحميل....." style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>من فضلك انتظر جاري تحميل البيانات .... <br />
      <img src="<?PHP echo base_url(); ?>images/ajaxloader.GIF"</p>
  </div>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <?PHP $this->load->view("breadcrumb",$step);?>
    <style>
	  .main_box {
			-webkit-border-radius:0px !important;
			-moz-border-radius:0px !important;
			border-radius:0px !important;			
		}
		.ui-widget-content { border:0px !important; }
		#presedientbox { background-image:url(<?PHP echo base_url(); ?>images/user-black.png); width: 128px;
						height: 128px;
						position: fixed;
						bottom: 0px;
						right: 161px;}
		#presedientbox:Hover { background-image:url(<?PHP echo base_url(); ?>images/user-color.png);}				
	  </style>
    <?php if($applicant->applicant_id):?>
    <a class="addnewdata needtip" style="margin-top:-30px !important;" target="_blank" href="<?php echo base_url(); ?>inquiries/get_sms_history/2/<?php echo $applicant->applicant_id;?>">قائمة الرسائل النصية</a>
    <?php endif;?>
    <span id="presedientbox"></span>
    <div class="main_box" id="maindata" >
      
      <form id="requestform1" name="requestform1" autocomplete="off" method="post" action="<?PHP echo md5(date('Ymdhisf')); ?>" autocomplete="off">
      <input type="hidden" name="applicant_id" id="applicant_id" value="<?PHP echo $applicant->applicant_id; ?>" />
      <input type="hidden" name="partnerCount" id="partnerCount" value="0" />
      <input type="hidden" name="form_step" id="form_step" value="1" />
      <input type="hidden" name="iscomplete" id="iscomplete" value="0" />
      <div id="nimbus">
        <ul>
          <li><a href="#nimbe-1">فردي</a></li>
          <?PHP for($k=1; $k<=4; $k++) {?>
          <li class="nimbxx"><a href="#nimbe-<?PHP echo $k+1; ?>"> مشترك <?PHP echo arabic_date($k); ?></a></li>
          <?PHP } ?>
        </ul>
        <div id="nimbe-1">
          <?PHP $this->load->view('tasgeel_single',array('m'=>$m,'type'=>$type)); ?>
        </div>
        <?PHP for($j=1; $j<=4; $j++) {?>
        <div id="nimbe-<?PHP echo $j+1; ?>">
          <?PHP $this->load->view('tasgeel_multiple',array('evo'=>$j,'aid'=>$applicant->applicant_id,'type'=>$type)); ?>
        </div>
       <?PHP } ?>
       
      </div>
      <div class="form_raw">
      <div class="user_txt"></div>
      <div class="user_field">
        <button type="button" id="save_next_move" class="btnx green">حفظ</button>
        <button style="display:none;" type="button" id="restart_data" class="btn default">إلغاء</button>
      </div>
    </div>
      </form>
      <?PHP noticeboard($main->tempid); ?>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');?>
