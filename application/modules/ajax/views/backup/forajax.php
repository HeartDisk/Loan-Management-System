<script src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url();?>js/bootstrap.js"></script>
<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>js/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url();?>js/jquery.filter_input.js"></script>
<script src="<?php echo base_url();?>js/jquery.feedback_me.js"></script>
<script src="<?php echo base_url();?>js/jquery.amaran.min.js"></script>
<script src="<?php echo base_url();?>js/hd_script.js"></script>
<script src="<?php echo base_url();?>js/highcharts-custom.js"></script>
<script src="<?PHP echo base_url();?>js/highcharts-3d.js"></script>
<script src="<?PHP echo base_url();?>js/exporting.js"></script>
<script src="<?PHP echo base_url();?>js/raphael-min.js"></script>
<script src="<?PHP echo base_url();?>js/raphael-font.js"></script>
<script src="<?PHP echo base_url();?>js/breadcrumb.js"></script>
<script src="<?PHP echo base_url();?>js/shortcut.js"></script>
<script src="<?PHP echo base_url();?>js/jquery.tipsy.js"></script>
<script src="<?PHP echo base_url();?>js/jquery.datetimepicker.js"></script>
<script src="<?PHP echo base_url();?>js/jquery.fancybox.js?v=2.1.5"></script>
<script src="<?PHP echo base_url();?>js/html5.js"></script>
<script src="<?PHP echo base_url();?>js/jquery.dataTables.js"></script>
<script src="<?PHP echo base_url();?>js/jquery.highlight-4.js"></script>
<script>
var config	=	
{
	BASE_URL		: '<?php echo base_url();?>',
	AJAX_URL		: '<?php echo base_url();?>ajax/',
	CURRENT_URL		: '<?php echo current_url();?>',
	MODULE_ID		: '<?php echo $module['moduleid'];?>',
	ORDER_ID		: '<?php echo get_order_id();?>',
	MODULE_NAME		: '<?php echo $module['module_name'];?>',
	CONTROLLER_NAME	: '<?php echo $this->uri->segment('1');?>',
	METHOD_NAME		: '<?php echo $this->uri->segment('2');?>'
}

function addclass()
{
	$(".menu_items li").parent().find('li').removeClass("close");
}
function ddx(msg)
{
	$('#msgx').html(' ');
	$('#msgx').html(msg);
	$( "#dialog-message" ).dialog({
	  modal: true,
	  buttons: {
		"موافق": function() {
		  $( this ).dialog( "close" );
		}
	  }
	});
}

</script>
<script type="text/javascript">
	
	$(document).ready(function () {
		
		 $('#addmore_partner').hide();
		 $('.needtip').tipsy({fade: true,html: true, gravity: 'w'});
		 shortcut.add("Ctrl+F1",function() { location.href = config.BASE_URL+'inquiries/resetinq'; });
		 
		 $('.fancybox').fancybox({
			maxWidth	: 1024,
			maxHeight	: 109,
			fitToView	: true,
			width		: '90%',
			height		: '80%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'fade',
    		closeEffect	: 'fade'
			 
			 });
		 $('.timeline').click(function(){
				var aad = $(this).attr('id');
				$('.hidetimeline').hide();
					var applicant_info = $.ajax({
						  url: config.AJAX_URL+'timeline',
						  type: "POST",
						  data:{pid:aad},
						  dataType: "html",
						  success: function(msg){
							  $('#timeline'+aad).show();
							  $('#time_data_'+aad).html(msg);
							 }
						});
		 });
		 
		 //Saving Applicant Info
		///////////////////////////////////		 
		 $('.tempapplicant').blur(function(){
			  var reviews = $.trim($('#review').val());
			 var value = $.trim($(this).val());
			 var column = $.trim($(this).attr('id'));
			 var data_attribute = $(this).attr('data-handler').split('_');
			 if(value!='')
			 {	var applicant_info = $.ajax({
					  url: config.AJAX_URL+'saveTempInfo',
					  type: "POST",
					  data:{value:value,tempid:data_attribute[0],applicantid:data_attribute[1],type:'Applicant',column:column,reviews:reviews},
					  dataType: "html",
					  success: function(msg){}
					});
			 }
			 
		 });
		 
		 $('.checkother').change(function(){
				var dataid = $('#'+$(this).attr('id')+' option:selected').attr('dataid').split(':');
				var vali = dataid[0];
				var nali = dataid[1];
				
				if(vali=='1')
				{
					$('#'+nali).fadeIn('slow');
				}
				else
				{
					$('#'+nali).fadeOut('slow');
				}
		 });
		 

		 
		 $('.tempmain').blur(function(){
			  var reviews = $.trim($('#review').val());
			 var value = $.trim($(this).val());
			 var column = $.trim($(this).attr('id'));
			 var data_attribute = $(this).attr('data-handler').split('_');			 
			 if(value!='')
			 {	var applicant_info = $.ajax({
					  url: config.AJAX_URL+'saveTempInfo',
					  type: "POST",
					  data:{value:value,tempid:data_attribute[0],applicantid:data_attribute[1],type:'Main',column:column,reviews:reviews},
					  dataType: "html",
					  success: function(msg){}
					});
			 }			 
		 });
		 
		 $('.saveoptions').blur(function(){
			  var reviews = $.trim($('#review').val());
			 var value = $.trim($(this).val());
			 var column = $.trim($(this).attr('id'));
			 var data_attribute = $(this).attr('data-handler').split('_');			 
			 if(value!='')
			 {	var applicant_info = $.ajax({
					  url: config.AJAX_URL+'saveTempInfo',
					  type: "POST",
					  data:{value:value,tempid:data_attribute[0],applicantid:data_attribute[1],type:'Main',column:column,reviews:reviews},
					  dataType: "html",
					  success: function(msg){}
					});
			 }			 
		 });
		 
		 $('.inquirytypeid').click(function(){
			 var cntlen = 0;
			 var reviews = $.trim($('#review').val());
			 if(reviews!='')
			 {
				 $('.inquirytypeid').each(function(index, element) {
					if ( $(this).is(':checked') ) 
					{
						cntlen+=1;
					}
				});
				$('#mulit_count').html(cntlen);
				if(cntlen > 0)
				{
					$('.multiboxsave').slideDown('slow');
				}
				else
				{
					$('.multiboxsave').slideUp('slow');
				}
			 }
		 });
		 
		 
		 
		 $('#notestext').blur(function(){
			 var reviews = $.trim($('#review').val());
			 var value = $.trim($(this).val());
			 var column = $.trim($(this).attr('id'));
			 var data_attribute = $(this).attr('data-handler');			 
			 if(value!='' && value!='ملاحظات' && reviews!='')
			 {	
			 	var mytxt = '';
			 	$('.inquirytypeid').each(function(index, element) {
                    if($(this).prop('checked'))
					{						
						var propData = $('#inqirydate'+$(this).val()).val();						
						mytxt += $(this).val()+'_'+propData+',';					
					}
                });
			 	var applicant_info = $.ajax({
					  url: config.AJAX_URL+'saveTempInfo',
					  type: "POST",
					  data:{value:value,tempid:data_attribute,type:'Notes',column:column,reviews:reviews,txt:mytxt},
					  dataType: "html",
					  beforeSend: function(){
						  
						  },					  
					  success: function(msg){
						  if($.trim(msg)==1)
						  {
						  		var coming = $.ajax({
								  url: config.AJAX_URL+'history/'+data_attribute,
								  type: "POST",
								  data:{value:1},
								  dataType: "html",
								  success: function(msg){ 
								   if(reviews!='')
								   { 
									$('#feedback_content').html(msg);
									$('#feedback_content').show();
									$('#feedback_trigger').show();
									$('#feedback_trigger').click();
								   }
									$('#notestext').val(' ');
								  }
								});
						  }
						}
					});
			 }			 
		 });

		 	$('.tempinqury').click(function(){
			 var reviews = $.trim($('#review').val());
			 var value = $.trim($(this).val());
			 var column = $.trim($(this).attr('id'));
			 var data_attribute = $(this).attr('data-handler').split('_');		
			 if($(this).prop('checked'))
			 {
				 $('.mydatepicker'+value).show();
			 }
			 else
			 {
				 $('.mydatepicker'+value).hide();
			 }
			 /*if(value!='')
			 {	var applicant_info = $.ajax({
					  url: config.AJAX_URL+'saveTempInfo',
					  type: "POST",
					  data:{value:value,tempid:data_attribute[0],applicantid:data_attribute[1],type:'Inquiry',column:column,reviews:reviews},
					  dataType: "html",
					  success: function(msg){}
					});
			 }		*/	 
		 });
		 	$('.addnewphone').click(function(){
				 var vox = $(this).attr('data-on').split('_');
				 var reviews = $.trim($('#review').val());
				 var newphones = $.ajax({
					 url: config.AJAX_URL+'new_phone',
				  	type: "POST",
				  data: { tempid:vox[0],applicantid:vox[1],reviews:reviews},
				  dataType: "html",
				  success: function(msg){
					
					$('#hatfi'+vox[1]).last().after(msg)
					
				  }
				});
				
				});
				
				$('#addnewmusanif').click(function(){
				 var newphones = $.ajax({
						  url: config.AJAX_URL+'new_musanif',
						  type: "POST",
						  data: {},
						  dataType: "html",
						  success: function(msg){
							
							//$('#hatfi'+vox[1]).last().after(msg)
							
						  }
						});
				
				});
		     //Auto Complete/////////////////////////////////
			$( ".autocomplete" ).autocomplete({
			  source:config.AJAX_URL+'getIDCardNumber',
			  minLength:3,
			  select: function( event, ui ) {	
			  	location.href = config.CURRENT_URL+'/'+ui.item.id			
									
			  }
			});
			$( ".applicantphone" ).autocomplete({
			  source:config.AJAX_URL+'getApplicantPhone',
			  minLength:3,
			  select: function( event, ui )
			  {	
			  	location.href = config.BASE_URL+'inquiries/newinquery/'+ui.item.id			
									
			  }
			});
			
			
			
			$( ".search_field" ).autocomplete({
			  source:config.AJAX_URL+'getListofApplicant',
			  minLength:3,
			  select: function( event, ui )
			  {	
			  	location.href = config.BASE_URL+'inquiries/newinquery/'+ui.item.id			
									
			  }
			});
			/////////////////////////////////////////////////
		 fm_options = {
        position: "left-bottom",
        name_required: true,
        message_placeholder: "Go ahead, type your feedback here...",
        message_required: true,
        show_asterisk_for_required: true,
        feedback_url: "send_feedback_clean",
        custom_params: {
            csrf: "my_secret_token",
            user_id: "john_doe",
            feedback_type: "clean"
        }
    };
    //init feedback_me plugin
    fm.init(fm_options);
		 //Form Validation
		 /*$('.req').blur(function(){
			if($.trim($(this).val())=='')
			{
				$(this).addClass('redline');
				$(this).removeClass('greenline');
				var place_holder = ' طلب '+$(this).attr('placeholder');
				var objid = $(this).attr('id');
				$('#'+objid).focus(); 
				ddx(place_holder);
				
			}
			else
			{
				$(this).removeClass('redline');
				$(this).addClass('greenline');
			}
		 });*/
		 
		
		 
		 $('.delete-btn').click(function(){

			 var url_redirect	=	$(this).attr("data-url");
			 var did = $(this).attr('id');
			 
			

			 $( "#dialog-confirm" ).dialog({
			  resizable: false,
			  height:200,
			  buttons: {
				"حذف": function() {
					 $('#bingo'+did).hide();
					var request = $.ajax({
					  url: url_redirect,
					  dataType: "html",
					  success: function(msg){
						$('#bingo'+did).hide();
					  }
					});
				  $( this ).dialog( "close" );
				},
				"إلغاء": function() {
				  $( this ).dialog( "close" );
				}
			  }
			});
				
				
			});
	
	$('.detail').click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			 
			 $(".show-content").html('');
			 $(".show-content").load(config.BASE_URL+'inquiries/get_applicant_data/'+id);
			 $( "#set-dialog-message-2" ).dialog({
					resizable: false,
					height:500,
					width:600,
					modal: true,
					buttons: {
					Ok: function() 
					{
						$(".show-content").val('');
						$( this ).dialog( "close" );
					}
					  }
					});

			/* var request = $.ajax({
					  url: config.BASE_URL+'inquiries/get_applicant_data/'+id,
					  type: "POST",
					  data: { id : id },
					  dataType: "html",
					  success: function(msg){
						  $(".show-content").html(msg);
						  
						  			$( "#dialog-message" ).dialog({
									resizable: false,
									height:500,
									width:600,
									modal: true,
									buttons: {
									Ok: function() {
										$(".show-content").html('');
									$( this ).dialog( "close" );
										}
									  }
									});
					  }
					});*/
	});
	
	
	$('.history').click(function(){
				var id = $(this).attr('id');
			 
			 $(".show-content").html('');
			 $(".show-content").load(config.BASE_URL+'inquiries/getHistory/'+id);
			 
			 $( "#set-dialog-message" ).dialog({
					resizable: false,
					height:500,
					width:600,
					modal: true,
					buttons: {
					Ok: function() 
					{
						$(".show-content").val('');
						$( this ).dialog( "close" );
					}
					  }
					});
		
		});
	//
	$('.detail-view-inquiry').click(function(e){
			 var id = $(this).attr('id');
			 $(".show-content").html('');
			e.preventDefault();
			 
			 	var request = $.ajax({
					  url: config.BASE_URL+'inquiries/get_auditor_data/'+id,
					  type: "POST",
					  data: { id : id },
					  dataType: "html",
					  success: function(msg){
						  $(".show-content").html(msg);
						  
						  			$( "#set-dialog-message" ).dialog({
									resizable: false,
									height:500,
									width:600,
									modal: true,
									buttons: {
									Ok: function() {
										$(".show-content").html('');
									$( this ).dialog( "close" );
										}
									  }
									});
					  }
					});
			  
	});
	
	$('.detail-view-folllow').click(function(e){
			 var id = $(this).attr('id');
			 $(".show-content").html('');
			e.preventDefault();
			 
			 	var request = $.ajax({
					  url: config.BASE_URL+'followup/getfollowupHistory/'+id,
					  type: "POST",
					  data: { id : id },
					  dataType: "html",
					  success: function(msg){
						  $(".show-content").html(msg);
						  
						  			$( "#set-dialog-message" ).dialog({
									resizable: false,
									height:500,
									width:600,
									modal: true,
									buttons: {
									Ok: function() {
										$(".show-content").html('');
									$( this ).dialog( "close" );
										}
									  }
									});
					  }
					});
			  
	});
	
	$('.multiboxsave').click(function(){
				var reviews = $.trim($('#review').val());
				var value = $.trim($('#notestext').val());
				var column = $.trim($('#notestext').attr('id'));
				var data_attribute = $('#notestext').attr('data-handler');				 		
					var mytxt = '';
					$('.inquirytypeid').each(function(index, element) 
					{
						if($(this).prop('checked'))
						{
							var propData = $('#inqirydate'+$(this).val()).val();
							mytxt += $(this).val()+'_'+propData+',';
						}
					});
					var applicant_info = $.ajax({
						  url: config.AJAX_URL+'saveTempInfo',
						  type: "POST",
						  data:{value:value,tempid:$('#tempid').val(),type:'Notes',column:column,reviews:reviews,txt:mytxt},
						  dataType: "html",					  
						  success: function(msg){
							  if($.trim(msg)==1)
						  		{
						  		var coming = $.ajax({
								  url: config.AJAX_URL+'history/'+data_attribute,
								  type: "POST",
								  data:{value:1},
								  dataType: "html",
								  success: function(msg){ 
								   if(reviews!='')
								   { 
									$('#feedback_content').html(msg);
									$('#feedback_content').show();
									$('#feedback_trigger').show();
									$('#feedback_trigger').click();
								   }
									$('#notestext').val(' ');
								  }
								});
						  }
							  }
						});	
			
		});	
	$('#save_data_inquery').click(function(){
			//Checking Error of The Form
			 $('.req').removeClass('redline');
			 var ht = '<ul>';
			 	$('.req').each(function(index, element) {
                    if($(this).val()=='')
					{
						$(this).addClass('redline');
						ht += '<li> طلب '+$(this).attr('placeholder')+'</li>';
					}
                });
			  
			  ht += '</ul>';
			  var redline = $('.redline').length;
			  alert(redline);
			  //IF no error found in form it will execute the first part			 
			  if(redline <= 0)
			  {	 
			  	  //Saving Mulazhat///////////////
				  ////////////////////////////////
					var reviews = $.trim($('#review').val());
					var value = $.trim($('#notestext').val());
					var column = $.trim($('#notestext').attr('id'));
					var data_attribute = $('#notestext').attr('data-handler');				 		
						var mytxt = '';
						$('.inquirytypeid').each(function(index, element) 
						{
							if($(this).prop('checked'))
							{
								var propData = $('#inqirydate'+$(this).val()).val();
								mytxt += $(this).val()+'_'+propData+',';
							}
						});
						if(value!='' && value!='ملاحظات')
						{	var applicant_info = $.ajax({
							  url: config.AJAX_URL+'saveTempInfo',
							  type: "POST",
							  data:{value:value,tempid:$('#tempid').val(),type:'Notes',column:column,reviews:reviews,txt:mytxt},
							  dataType: "html",					  
							  success: function(msg){
								  	saveMurageen();
								  }
							});	}
						saveMurageen();
					}
					else
					{
						ddx(ht);
					}
				});
	function saveMurageen()
	{
			var tempid = $('#tempid').val();
			var request = $.ajax({
			  url: config.BASE_URL+'inquiries/add_data_into_main/'+tempid,					  
			  dataType: "html",
			  beforeSend: function(){
				 $( "#dialog-confirm_dd" ).dialog({
									resizable: false,
									height:500,
									width:600,
									modal: true,
									buttons: {
									Ok: function() {
										$(".show-content").html('');
									$( this ).dialog( "close" );
										}
									  }
									}); 
				  },
			  complete: function(){$( "#dialog-confirm_dd" ).dialog( "close" );},					  
			  success: function(msg)
			  {/*
				  $.amaran({
					  content:{
						  bgcolor:'#8e44ad',
						  color:'#fff',
						  message:'وقد أضيف إلى الاستعلام عن في النظام'},
						  theme:'colorful',
						  position:'bottom center',
						  closeButton:false,
						  cssanimationIn: 'rubberBand',
						  cssanimationOut: 'bounceOutUp',
						  beforeStart: function()
						  {	
						  location.href = config.CURRENT_URL;	
						  }
						});
					*/}
			});
		}
		
		/*$('#save_data_form_step2').click(function(){
			location.href = 'http://www.hotmail.com';
			console.log('ewrwer');
			
			return;
			 $('.req').removeClass('redline');
			 var ht = '<ul>';
			 	$('.req').each(function(index, element) {
					
					
                    if($(this).val()=='')
					{
						$(this).addClass('redline');
						ht += '<li> طلب '+$(this).attr('placeholder')+'</li>';
					}
                });
			  var redline = $('.redline').length;
			  ht += '</ul>';
			 	 
			  if(redline <= 0)
			  {	
			  	$("#validate_form_step2").submit();
			  }
			  else
			  {
				   ddx(ht);
			  }
		});*/
		
		//Adding Key Event in The Doc
		
		//////////////////////////////////////////////////////
		$('#save_data_form').click(function(){
			 $('.req').removeClass('redline');
			 var ht = '<ul>';
			 	$('.req').each(function(index, element) {
					
					
                    if($(this).val()=='')
					{
						$(this).addClass('redline');
						ht += '<li> طلب '+$(this).attr('placeholder')+'</li>';
					}
                });
			  var redline = $('.redline').length;
			  ht += '</ul>';
			 	 
			  if(redline <= 0)
			  {	
			  	$("#validate_form").submit();
			  }
			  else
			  {
				   ddx(ht);
			  }
		});
		$('#save_data_form_new').click(function(){
			 $('.req').removeClass('redline');
			 var ht = '<ul>';
			 	$('.req').each(function(index, element) {
					
					
                    if($(this).val()=='')
					{
						$(this).addClass('redline');
						ht += '<li> طلب '+$(this).attr('placeholder')+'</li>';
					}
                });
			  var redline = $('.redline').length;
			  ht += '</ul>';
			 	 
			  if(redline <= 0)
			  {	
			  	var pass			=	$("#password").val();
				var confirm_pass	=	$("#confirm_password").val();
				
				
				if(pass	!= confirm_pass)
				{
					$("#password").addClass('redline');
					$("#confirm_password").addClass('redline');
					
					ddx("و كلمات السر لا تتطابق مطابقة");
					
				}
				else
				{
					$("#validate_form_new").submit();
				}
			  }
			  else
			  {
				   ddx(ht);
			  }
		});
		 
		$('.TextInput').filter_input({regex:'[a-zA-Z\u0600-\u06FF]'}); 
		$('.NumberInput').filter_input({regex:'[0-9]'});  
		
		 var d = new Date();
		 var year = d.getFullYear();
		 var maxyear = d.getFullYear()-200;
		 d.setFullYear(maxyear);
		 d.setFullYear(year);
		//$('#BirthDate').datepicker({ changeYear: true, changeMonth: true, yearRange: '1920:' + year + '', defaultDate: d});
		 
		  $( "#datepicker" ).datepicker({
			 showAnim:'slide',
			 changeMonth: true,
			  changeYear: true,
			  dateFormat:'yy-mm-dd',
			  yearRange: '1920:' + year + '', defaultDate: d,
			  onSelect: function(selected,evnt) {
					 	birthday = selected
  						birthday = new Date(birthday);
  						age = new Number((new Date().getTime() - birthday.getTime()) / 31536000000).toFixed(0);
						if(age < 18)
						{
							$(this).val(' ');
							ddx('غير مطابق لشروط العمر‎ شروط العمر ما بين ١٨ - ٥٥');
							$('#age').val(' ');
						}
						else if(age > 55)
						{
							$(this).val(' ');
							ddx("غير مطابق لشروط العمر‎ شروط العمر ما بين ١٨ - ٥٥");
							$('#age').val(' ');
						}
						else
						{
							$('#age').val(age-1);
						}
						
						
				}
		  });
		  
		 		  
		  
		  $('.inquiry_type').click(function(){
			  var id = '#datepicker'+$(this).val();
			  if($(this).is(':checked'))
			  {
				  $(id).fadeIn('slow');
			  }
			  else
			  {
				  $(id).fadeOut('slow');
			  }
			 });
		  
		 var dx = new Date();
		 var start_year = dx.getFullYear();
		 var end_year = dx.getFullYear()+55;
		 dx.setFullYear(start_year);
		 dx.setFullYear(end_year);
		  
		  
		  $( "#loan_date" ).datepicker({
			 showAnim:'slide',
			 changeMonth: true,
			  changeYear: true,
			  dateFormat:'yy-mm-dd',
			  yearRange: start_year+':' + end_year + '', defaultDate: start_year
		  });
		  
		  $( "#foundation_date" ).datepicker({
			 showAnim:'slide',
			 changeMonth: true,
			  changeYear: true,
			  dateFormat:'yy-mm-dd'
		  });
		  
		  
		  $('.dpicker').hide();
		  $( ".dpicker" ).datepicker({
			 showAnim:'slide',
			 changeMonth: true,
			  changeYear: true,
			  dateFormat:'yy-mm-dd'
		  });
		  
		  $('#loan_reason1').change(function(){
			 	if($(this).val()!='')
				{
					$('.ddx').show();
				}
				else
				{
					$('.ddx').hide();
				}
			 });
		  
		  $(".user_type").change(function(){
				if($(this).val() == "مشترك")
				{					
					$("#addmore_partner").show();
					$('#personal2').hide();
				}
				else
				{
					$('#personal2').show();
					$("#addmore_partner").hide();
				}					
			});
			
			$('#extrainfo').hide();
			$(".conf").change(function(){
				if($(this).val() == "Y")
				{
					$('#extrainfo').slideDown('slow');
					//
					$("#extrainfo_q").slideDown('slow');
					$('#project_name, #project_location').addClass('req');
				}
				else
				{
					$("#extrainfo_q").slideUp('slow');
					$('#extrainfo').slideUp('slow');
					$('#project_name, #project_location').removeClass('req');
				}					
			});	
			
			$(".confirmation_q").change(function(){
				//alert($(this).val());
				if($(this).val() == "Y")
				{
					$('#question_details').slideDown('slow');
				}
				else
				{
					$("#question_details").slideUp('slow');
				}					
			});	
			//confirmation_q
			$('#province').change(function(){
				var province = $(this).val();
				var request = $.ajax({
					  url: config.AJAX_URL+'getWilayats',
					  type: "POST",
					  data: { province : province },
					  dataType: "html",
					  success: function(msg){
						  var walayalen = $('#walaya').length;
						  if(walayalen > 0)
						  {
							  $('#walaya').html(msg);
						  }
						  else
						  {
							  $('#wilayats').html(msg);
						  }
					  }
					});
				
			});
		$('#user_role_id').change(function(){
				var role_id = $(this).val();
				var request = $.ajax({
					  url: config.AJAX_URL+'getChilds',
					  type: "POST",
					  data: { role_id : role_id },
					  dataType: "html",
					  success: function(msg){
						$('#user_parent_role').html(msg);
					  }
					});
				
			});
			
			var cxt = 1;
			$('#addmore_partner').click(function(){
				var request = $.ajax({
					  url: config.AJAX_URL+'addNewPartner',
					  type: "POST",
					  data: { tempid : $('#tempid').val() },
					  dataType: "html",
					  success: function(msg){
						$('.bigbangtheory').after(msg);
					  }
					});
			
			
			
				
				//var personal = '<div class="personal" style="background-color:#EFEFEF;" id="pp'+cxt+'"><input style="float: left; font-size: 20px;" type="button" onclick="removeRow(\'pp'+cxt+'\')" id="remove" value="حذف" />'+$('#personalbingo').html()+'</div>';
				//$('#personalbingo').last().after(personal); // adding new tr after last tr of table
				//cxt++;				
			});
	});
	</script>
<!--end of hover -->
<!-- menu -->

<!-- Include JQuery Vertical Tabs plugin -->
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-jvert-tabs-1.1.4.js"></script>

<script type="text/javascript">
classParent = '<?php echo $classParent?>';
function selectMenu(){
	//
	sMenu = $("#selectedMenu").val();	
	$("#vtabs1").jVertTabs({
				selected: sMenu
			});
}

$(document).ready(function(){
			
			$("#vtabs1").jVertTabs({
				selected:config.ORDER_ID
			});
			
			//setTimeout('selectMenu()',100);
		});

function removeRow(v)
{
	var request = $.ajax({
		  url: config.AJAX_URL+'removePartner',
		  type: "POST",
		  data: { applicant : v},
		  dataType: "html",
		  success: function(msg){
			$('#personalbingo'+v).remove();
		  }
		});
}

function removePhone(v)
{
	var request = $.ajax({
		  url: config.AJAX_URL+'removePhone',
		  type: "POST",
		  data: { phoneid : v},
		  dataType: "html",
		  success: function(msg){
			$('#hatfi'+v).remove();
		  }
		});
}
function checkPhoneLen(v)
{
	var phoneNumberLength = $(v).val().length;
	var phoneNumber = $(v).val();
	if(phoneNumberLength < 8)
	{
		$(v).addClass('redline').removeClass('greenline');
		ddx('يجب أن يكون رقم الهاتف المكون من 8 أرقام');
	}
	else
	{
		if(phoneNumber!='')
		{
			var reviews = $.trim($('#review').val());
			var value = $.trim($(v).val());
			var column = $.trim($(v).attr('id'));
			var data_attribute = $(v).attr('data-handler').split('_');
			if(value!='')
			 {	var applicant_info = $.ajax({
					  url: config.AJAX_URL+'saveTempInfo',
					  type: "POST",
					  data:{value:value,tempid:data_attribute[0],applicantid:data_attribute[1],phoneid:data_attribute[2],type:'Phone',column:column,reviews:reviews},
					  dataType: "html",
					  success: function(msg){ ; }
					});
			 }
			
			$(v).addClass('greenline').removeClass('redline');
		}
	}
		 
}
</script>
