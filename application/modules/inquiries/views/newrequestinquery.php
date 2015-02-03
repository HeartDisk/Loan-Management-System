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
	//echo "<pre>";
	//print_r($main);
	//exit;
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

<?php if($applicant->applicant_type=='فردي') { ?>
<script type="text/javascript">

$(document).ready(function(){
	//alert('ready1');
});
</script>
<?php
}elseif($applicant->applicant_type=='مشترك'){
?>
<script type="text/javascript">
$(document).ready(function(){
	//alert('ready2');
});
</script>
<?php
}
else{
?>
<script type="text/javascript">

$(document).ready(function(){
	//alert('ready3');
	setTimeout('hidemushtarik()', 1000);

});

</script>
<?php
}
?>

<script>
function hidemushtarik(){
	//nimbus
	//$("#nimbus .ui-tabs-nav li").eq(0).html('فردي');
	
	$("#nimbus .ui-tabs-nav li").eq(1).hide();
	$("#nimbus .ui-tabs-nav li").eq(2).hide();
	$("#nimbus .ui-tabs-nav li").eq(3).hide();
	$("#nimbus .ui-tabs-nav li").eq(4).hide();
}

function showmushtarik(){
	//$("#nimbus .ui-tabs-nav li").eq(0).html(' مشترك 1');
	//$("#nimbus .ui-tabs-nav li").eq(0).html(' مشترك 1');
	$("#nimbus .ui-tabs-nav li").eq(1).show();
	$("#nimbus .ui-tabs-nav li").eq(2).show();
	$("#nimbus .ui-tabs-nav li").eq(3).show();
	$("#nimbus .ui-tabs-nav li").eq(4).show();
}

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
	
		$(".applicant_type").click(function(){
			val = $(this).val();
			if(val == 'مشترك'){
				showmushtarik();
			}
			else{
				//hidemushtarik();
			}
	});
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

    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>
 <script type="text/javascript">
query_variable = '';
function apply_name(id){
	//query_variable = id;
	//alert(query_variable);
	//$("#selected_name").val(id);
	var request = $.ajax({
					  url: config.BASE_URL+'inquiries/updateFileSession',
					  type: "POST",
					  dataType: "html",
					  data: { fileId :id},
					  beforeSend: function() {		},
					  complete: function(){  },
					  success: function(msg){
						  	console.log(msg);
						 			
						  }
					});

}
function take_hidden(){
	        var iframeContent = $(iframe).contents(); //alert(iframeContent);
        //$("#result").text("Hello World");
        $("#result").html(iframeContent.find('body').html);alert(iframeContent.find('body').html());
}
</script>
<div id="tasjeel"></div>
<div class="body_contant">
  
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
      
      <form  id="requestform1" name="requestform1" autocomplete="off" method="post" action="<?PHP echo md5(date('Ymdhisf')); ?>" autocomplete="off">
      <input type="hidden" name="applicant_id" id="applicant_id" value="<?PHP echo $applicant->applicant_id; ?>" />
      <input type="hidden" name="partnerCount" id="partnerCount" value="0" />
      <input type="hidden" name="form_step" id="form_step" value="1" />
      <input type="hidden" name="iscomplete" id="iscomplete" value="0" />
      <div id="nimbus">
        <ul>
          <li id="ff"><a href="#nimbe-1">فردي</a></li>
          
          <?PHP for($k=1; $k<=4; $k++) {?>
          <li class="nimbxx"><a href="#nimbe-<?PHP echo $k+1; ?>"> مشترك <?PHP echo arabic_date($k); ?></a></li>
          <?PHP } ?>
        </ul>
        <div id="nimbe-1">
          <?PHP $this->load->view('inquiries_single',array('m'=>$m,'type'=>$type)); ?>
        </div>
        <?PHP for($j=1; $j<=4; $j++) {?>
        <div id="nimbe-<?PHP echo $j+1; ?>">
          <?PHP $this->load->view('inquiries_multiplle',array('evo'=>$j,'aid'=>$applicant->applicant_id,'type'=>$type)); ?>
        </div>
       <?PHP } ?>
       
      </div>
      <div class="form_raw">
      <div id="all_hidden"></div>
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
