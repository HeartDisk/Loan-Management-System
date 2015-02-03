<?php $this->load->view('common/meta');?>
<?PHP
	$main = $m['main'];	
?>
<style>
.tableview{
	border:1px solid #bcc0c2;		
}
td{
	border:1px solid #bcc0c2;
}
</style>
<div class="body">
<?php $this->load->view('common/banner');?>
<div class="body_contant">
<div id="dialog-confirm_dd" title="تحميل....." style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>من فضلك انتظر جاري تحميل البيانات .... <br />
  <img src="<?PHP echo base_url(); ?>images/ajaxloader.GIF"</p>
</div>
  <?php //$this->load->view('common/floatingmenu');
  
  $msg = $this->session->flashdata('msg');
  if($msg !=""){
	  ?>
      <script type="text/javascript">
  		show_notification('مرسلة البيانات بنجاح...');
  	</script>
  <?php
  }
  ?>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <form id="validate_form" name="validate_form" method="post" action="<?PHP echo base_url(); ?>inquiries/add_analyze_data" autocomplete="off">
      <script>
		$(function(){
		$('.inquirytypeid').click(function(){			
			var val = $(this).val();
			var chd = '.child_'+val;
			if($(this).is(':checked'))
			{
				$(chd).slideDown('slow');
			}	
			else
			{
				$(chd).slideUp('slow');
			}
		});	
		
		$(".charges").change(function(){
			total_charges =0;			
					//$(".charges").each
					$(".charges").each(function( i, l ){
					//alert( "Index #" + i + ": " + l );
					//console.log($(".charges").eq(i).val());
					
					//alert($(".charges").eq(i).val());
					if($(".charges").eq(i).val() !=""){
						//total_charges=total_charges+$(".charges").eq(i).val();
						val = $(".charges").eq(i).val();
						//total_charges=total_charges+val;
						//console.log(parseInt(val));
						total_charges=parseInt(total_charges)+parseInt(val);	
						console.log(parseInt(total_charges));
					}
					
					//total_charges=+parseInt($(".charges").eq(i).val());
					//$(".charges").eq(i).val();
				});
					$("#total_cost").val(total_charges);		
				})
		
		$(".analize").change(function(){
				revenue = $("#revenue_first_year").val();
				depriciation = $("#anual_depriciation").val();
				if(revenue !="" && depriciation ==""){
					net_profit= revenue;
				}
				else if(revenue =="" && depriciation !=""){
					net_profit= depriciation;
				}
				else if(revenue !="" && depriciation !=""){
					net_profit= parseInt(revenue)-parseInt(depriciation);
				}
				$("#net_profit_year").val(net_profit);	
		})
		$(".expensis").change(function(){
			total_expensis=0;			
					//$(".charges").each
					$(".expensis").each(function( i, l ){
					//alert( "Index #" + i + ": " + l );
					//console.log($(".charges").eq(i).val());
					
					//alert($(".charges").eq(i).val());
					if($(".expensis").eq(i).val() !=""){
						//total_charges=total_charges+$(".charges").eq(i).val();
						val = $(".expensis").eq(i).val();
						//total_charges=total_charges+val;
						//console.log(parseInt(val));
						total_expensis=parseInt(total_expensis)+parseInt(val);	
						//console.log(parseInt(total_charges));
					}
					
					//total_charges=+parseInt($(".charges").eq(i).val());
					//$(".charges").eq(i).val();
				});
					$("#total_expensis").val(total_expensis);		
				})		
				
	//expensis			
		$('.childxxxxx').click(function(){			
			var val = $(this).val();
			var chd = '.smallchild_'+val;
			if($(this).is(':checked'))
			{
				$(chd).slideDown('slow');
			}	
			else
			{
				$(chd).slideUp('slow');
			}
		});	
			
		});
	</script>
      <?PHP if($t=='review') { ?>
      <script>
     $(function(){
     	var applicant_info = $.ajax({
					  url: config.AJAX_URL+'history/<?PHP echo $main->tempid; ?>',
					  type: "POST",
					  data:{value:1},
					  dataType: "html",
					  success: function(msg){ $('#feedback_content').html(msg);
					  	$('#feedback_content').show();
						$('#feedback_trigger').show();
						$('#feedback_trigger').click();
					  }
					});
     });
	 </script>
      <?PHP } ?>
      <div class="main_box">
        <div class="data_box_title"> <a class="addnewdata" href="<?PHP echo base_url(); ?>inquiries/resetinq">إضافة جديدة</a>
          <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
          <div class="data_title">بيانات توضيحية عن المشروع </div>
        </div>
        <div class="data_raw">
        <?PHP //noticeboard($main->tempid); ?>
        <div class="data_title">بيانات صاحب الطلب</div>
          <div class="data">
            <div class="main_data">
              <div class="personal" id="personal2">
                
                <div class="form_raw">
                  <div class="user_txt">الاسم</div>
                  <div class="user_field">
                     <input name="name" data-handler="<?PHP //echo $main->tempid; ?>_<?PHP //echo $appli->applicantid; ?>" value="" placeholder="الاسم " id="first_name" type="text" class="txt_field req TextInput  tempapplicant">
                  </div>
                  <div class="user_txt"  style="width: 52px; padding-right: 20px;">العمر</div>
                <div class="user_field"><input name="datepicker" type="text"  value="" data-handler="<?PHP //echo $main->tempid; ?>_<?PHP //echo $main->tempid; ?>" class=" txt_field req tempmain" id="datepicker" placeholder="العمر" size="15" maxlength="10"></div>	
                </div>
                
                <div class="form_raw">
                  <div class="user_txt">النشاط </div>
                  <div class="user_field">
                       <input name="activity" data-handler="<?PHP ///echo $main->tempid; ?>_<?PHP //echo $appli->applicantid; ?>" value="" placeholder="النشاط" id="activity" type="text" class="txt_field req TextInput  tempapplicant" style="width:500px;">
                    </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الشكل القانوني </div>
                  <div class="user_field">
                       <input name="legal_form"  data-handler="<?PHP // echo $main->tempid; ?>_<?PHP //echo $appli->applicantid; ?>" value="" placeholder="الشكل القانوني" id="legal_form" type="text" class="txt_field req TextInput  tempapplicant" style="width:500px;">
                    </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">المؤهلات والخبرة </div>
                  <div class="user_field">
                       <input name="qualification_expereince"  data-handler="<?PHP //echo $main->tempid; ?>_<?PHP //echo $appli->applicantid; ?>" value="" placeholder="المؤهلات والخبرة" id="qualification_expereince" type="text" class="txt_field req TextInput  tempapplicant" style="width:500px;">
                    </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الوضع الحالي</div>
                  <div class="user_field">
                       <input name="current_situation"  data-handler="<?PHP //echo $main->tempid; ?>_<?PHP //echo $appli->applicantid; ?>" value="" placeholder="الوضع الحالي" id="current_situation" type="text" class="txt_field req TextInput  tempapplicant" style="width:500px;">
                    </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">موقع المشروع</div>
                  <div class="user_field">
                       <input name="project_site"  data-handler="<?PHP //echo $main->tempid; ?>_<?PHP //echo $appli->applicantid; ?>" value="" placeholder="موقع المشروع" id="project_site" type="text" class="txt_field req TextInput  tempapplicant" style="width:500px;">
                    </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">المخاطر الائتمانية</div>
                  <div class="user_field">
                       <input name="credit_risk"   data-handler="<?PHP //echo $main->tempid; ?>_<?PHP // echo $appli->applicantid; ?>" value="" placeholder="المخاطر الائتمانية" id="credit_risk" type="text" class="txt_field req TextInput  tempapplicant" style="width:500px;">
                    </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">مبلغ القرض المطلوب</div>
                  <div class="user_field">
                       <input name="desire_loan"   data-handler="<?PHP //echo $main->tempid; ?>_<?PHP // echo $appli->applicantid; ?>" value="" placeholder="مبلغ القرض المطلوب" id="desire_loan" type="text" class="txt_field req TextInput  tempapplicant" style="width:500px;">
                    </div>
                </div>
                
              </div>
            </div>
            <div style="width:260px; text-decoration:underline;padding-right: 14px;" class="user_txt"><h3>الفكرة العامة للمشروع:</h3></div>
            <div class="form_raw">
              <div class="user_field">
				<textarea name="project_idea" id="project_idea" class="txt_field" style="width:800px;"></textarea>
              </div>
            </div>
            <div style="width:426px; text-decoration:underline;padding-right: 14px;" class="user_txt"><h3>التحليل المالي للمشروع حسب المذكور في دراسة الجدوى:</h3></div>
            <br  clear="all"/>
           <div style="width:226px; text-decoration:underline;padding-right: 14px;" class="user_txt"><h3>أ ) التكلفة الاستثمارية :</h3></div>
            
            <table cellspacing="0" cellpadding="1" border="1" width="100%"  style="border:1px solid #bcc0c2;">
                            <tbody>
                            <tr>
                              <td class="td_text_data center">الاثاث والتركيبات</td>
                              <td class="td_text_data center">الالات ومعدات</td>
                              <td class="td_text_data center">الاجهزة والبرامج</td>
                              <td class="td_text_data center">العاب كهربائية</td>
                              <td class="td_text_data center">رأس المال العامل</td>
                              <td class="td_text_data center">إجمالي التكلفة</td>
                            </tr>
                                                        <tr>
                              <td><input type="text" maxlength="10" size="15" placeholder="الاثاث والتركيبات" id="furniture_fixture" class="charges txt_field xx NumberInput" value="" name="furniture_fixture"></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="الالات ومعدات" id="machinery_equipment" class="charges txt_field xx NumberInput" value="" name="machinery_equipment"></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="الاجهزة والبرامج" id="hardware_software" class="charges txt_field xx NumberInput" value="" name="hardware_software"></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="العاب كهربائية" id="power_games" class="charges txt_field xx NumberInput" value="" name="power_games"></td>
                               <td><input type="text" maxlength="10" size="15" placeholder="رأس المال العامل" id="working_capital" class="charges txt_field xx NumberInput" value="" name="working_capital"></td>
                               <td><input type="text" maxlength="10" size="15" placeholder="إجمالي التكلفة" id="total_cost" class="txt_field xx NumberInput" value="" name="total_cost" readonly="readonly"></td>
                            </tr>
                              </tbody></table>
             <div style="width:226px; text-decoration:underline;padding-right: 14px;" class="user_txt"><h3>ب ) تحليل الأرباح والخسائر :</h3></div>                 
            <table cellspacing="0" cellpadding="1" border="1" width="100%">
                            <tbody>
                            <tr>
                              <td class="td_text_data center">الإيجار الشهري</td>
                              <td class="td_text_data center">الرواتب لشهر</td>
                              <td class="td_text_data center">الكهرباء والماء والانترنت للشهر</td>
                              <td class="td_text_data center">المشتريات </td>
                              <td class="td_text_data center">تكاليف أخرى</td>
                              <td class="td_text_data center">الإجمالي</td>
                              <td class="td_text_data center">الايرادات للسنة الاولى </td>
                              <td class="td_text_data center">الاهلاك السنوي </td>
                              <td class="td_text_data center">صافي الربح  للسنة الاولى</td>
                            </tr>
                                                        <tr>
                              <td><input type="text" maxlength="10" size="15" placeholder="الإيجار الشهري" id="monthly_rent" class="expensis txt_field xx NumberInput" value="" name="monthly_rent"></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="الرواتب لشهر" id="salaries_month" class="expensis txt_field xx NumberInput" value="" name="salaries_month"></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="الكهرباء والماء والانترنت للشهر" id="bills_monthly" class="expensis txt_field xx NumberInput" value="" name="bills_monthly"></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="المشتريات" id="procurement" class="expensis txt_field xx NumberInput" value="" name="procurement"></td>
                               <td><input type="text" maxlength="10" size="15" placeholder="تكاليف أخرى" id="other_costs" class="expensis txt_field xx NumberInput" value="" name="other_costs"></td>
                               <td><input type="text" maxlength="10" size="15" placeholder="الإجمالي" id="total_expensis" class=" txt_field xx NumberInput" value="" name="total_expensis" readonly="readonly"></td>
                               <td><input type="text" maxlength="10" size="15" placeholder="لايرادات للسنة الاولى" id="revenue_first_year" class="analize txt_field xx NumberInput" value="" name="revenue_first_year"></td>
                               <td><input type="text" maxlength="10" size="15" placeholder="الاهلاك السنوي" id="anual_depriciation" class="analize txt_field xx NumberInput" value="" name="anual_depriciation"></td>
                                <td><input type="text" maxlength="10" size="15" placeholder="صافي الربح  للسنة الاولى" id="net_profit_year"  class="txt_field xx NumberInput" value="" name="net_profit_year"></td>
                            </tr>
                              </tbody></table>
            
            <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field">
                <button  type="button" id="save_data_form" name="save_data_form" class="btnx green">حفظ</button>
                <button style="display:none;" type="button" id="restart_data" class="btn default">إلغاء</button>
              </div>
            </div>
         </div>
         
        </div>
      </div>
    </form>
  </div>
</div>
<?php $this->load->view('common/footer');?>
