<?php $this->load->view('common/meta'); ?>

<div class="body">
<?php $this->load->view('common/banner');?>
<div id="tasjeel"></div>
<div class="body_contant">
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <div class="main_box" id="maindata" style="margin-top:10px;">
      <div class="form_raw" id="user_toolbar" style="border-bottom:0px !important;">
        <fieldset>
          <legend>البحث تصفية (فلترة)</legend>
          <?PHP $this->inq->users_role($user_info['user_role_id']); ?>
          <input name="first_date"  placeholder="أولا التاريخ" id="first_date" type="text" class="txt_field">
          <input name="second_date"  placeholder="الثاني تاريخ" id="second_date" type="text" class="txt_field">
          <button type="button" id="search_filter" class="btn_search green">بحث</button>
        </fieldset>
      </div>
      <div class="form_raw">
        <fieldset>
          <legend>آخر المستعمل</legend>
          <div id="user_log"></div>
        </fieldset>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');?>
<script>
$(function(){
	$( "#first_date, #second_date" ).datepicker({
			 showAnim:'slide',
			 maxDate: "-1",
			 dateFormat:'yy-mm-dd'
	});
	
	function getHistoryData()
	{		
		var getHistory = $.ajax({
		url: config.AJAX_URL+'user_history',
		type: "POST",
		data:{first_date:$('#first_date').val(),second_date:$('#second_date').val(),userid:$('#userid').val()},
		dataType: "html",
		beforeSend: function(){ $('#alog').show(); },
		complete:function(){ $('#alog').hide(); },
		success: function(msg){	$('#user_log').html(msg);	
			//$('.needtip').tipsy({fade: true,html: true, gravity: 'w'});			
			//alert(msg);
			$('.ipbox').each(function(index, element) {                
				$('#'+$(this).attr('id')).tooltip({ 
				tooltipSourceURL:config.AJAX_URL+'getIplocation/'+$(this).attr('data-id'), 
				loader:1, 
				loaderImagePath:'../images/loader.gif', 
				loaderHeight:16, 
				loaderWidth:17, 
				tooltipSource:'ajax',
				tooltipHTTPType: 'post',
				borderSize:'1' 
				}); 
            });
			
			$('.tablenames').each(function(index, element) {
                $('#'+$(this).attr('id')).tooltip({ 
				tooltipSourceURL:config.AJAX_URL+'getlogdetail/'+$(this).attr('data-id'), 
				loader:1, 
				loaderImagePath:'../images/loader.gif', 
				loaderHeight:16,
				loaderWidth:17, 
				width:'300px', 				
				tooltipSource:'ajax',
				tooltipHTTPType: 'post',
				borderSize:'1' 
				});
            });
			
			}
		});
		setTimeout(getHistoryData,60000);
	}
	
	getHistoryData();
	
	$('#search_filter').click(function(){ getHistoryData(); });
	
	
});

function showtooltip(ip,div)
{
	var getHistory = $.ajax({
		url: config.AJAX_URL+'getIplocation',
		type: "POST",
		data:{ip:ip},
		dataType: "html",
		beforeSend: function(){ $('#p'+div).html(' wait.. '); },
		success: function(msg){	$('#p'+div).html(msg);	}
		});
}
</script> 
