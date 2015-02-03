<?php $this->load->view('common/meta');?>
<?PHP
	$main = $m['main'];	
?>
<style>
.tableview{
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
  <?php //$this->load->view('common/floatingmenu');?>
  <?PHP parentMenu(); ?>
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
  
  <div class="main_contant">
    <form id="validate_form" name="validate_form" method="post" action="<?PHP echo base_url(); ?>inquiries/add_evolution_data" autocomplete="off">
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
          <div class="data_title">تقييم طلب القرض (لجنة سقف القروض) </div>
        </div>
        <div class="data_raw">
        <?PHP //noticeboard($main->tempid); ?>
         <div class="data">
            <table cellspacing="0" cellpadding="1" border="1" width="100%">
                            <tbody>
                            <tr><td class="td_text_data center" rowspan="2">االاسم</td><td class="td_text_data center" rowspan="2"><textarea id="evolution_name" name="evolution_name" placeholder="االاسم"></textarea></td>
                            <td class="td_text_data center">مبلغ القرض</td><td class="td_text_data center">الولاية</td><td class="td_text_data center">رقم الهاتف</td>
                            </tr>
                            <tr>
                            	<td><input type="text"  placeholder="مبلغ القرض" id="evolution_amount"  class="charges txt_field xx NumberInput" value="" name="evolution_amount"></td>
                                <td><input type="text"  placeholder="الولاية" id="evolution_state" class="charges txt_field xx NumberInput" value="" name="evolution_state"></td>
                                <td><input type="text"  placeholder="رقم الهاتف" id="evolution_number" class="charges txt_field xx NumberInput" value="" name="evolution_number"></td>
                            </tr>
                            <tr><td class="td_text_data center" rowspan="2">النشاط</td><td class="td_text_data center" rowspan="2"><textarea id="evolution_activity" name="evolution_activity" placeholder="النشاط"></textarea>
                           </td>
                            <td class="td_text_data center">نوع البرنامج</td><td class="td_text_data center">الولاية</td><td class="td_text_data center">رقم الهاتف</td>
                            </tr>
                            <tr>
                            	<td colspan="3" style="text-align:center;">تأسيس <input type="radio"  name="evolution_program"  id="type_program1" value="تأسيس" /> مورد<input type="radio"  name="evolution_program"  id="type_program2" value="مورد" /> <br  clear="all" />ريادة<input type="radio"  name="evolution_program"  id="type_program2" value="ريادة" /> تعزيز<input type="radio"  name="evolution_program"  id="type_program2" value="تعزيز" /></td>
                            </tr>          
                    </tbody></table>
                    <p></p><p></p><p></p>
                    <table cellspacing="0" cellpadding="1" border="1" width="100%"  style="border:1px solid #bcc0c2;">
                            <tbody>
                            <tr style="border:none;">
                              <td class="td_text_data center" style="border:none;"></td>
                              <td class="td_text_data center" style="border:none;"></td>
                              <td class="td_text_data center" style="border:none;"></td>
                              <td class="td_text_data center" style="border:none;"><input type="checkbox" name="is_working_capital" id="is_working_capital"  value="1"/></td>
                              <td class="td_text_data center" style="border:none;"><input type="checkbox" name="is_furndloan" id="is_furndloan" value="1" /></td>
                              <td class="td_text_data center" style="border:none;"><input type="checkbox" name="is_contiribute" id="is_contiribute"  value="1"/></td>
                              <td class="td_text_data center" style="border:none;"><input type="checkbox" name="is_total" id="is_total" value="1" /></td>
                            </tr>
                            <tr>
                              <td class="td_text_data center">البند</td>
                              <td class="td_text_data center">اثاث وتركيبات</td>
                              <td class="td_text_data center">آلالات والمعدات</td>
                              <td class="td_text_data center">رأس المال العامل</td>
                              <td class="td_text_data center">قرض الصندوق</td>
                              <td class="td_text_data center">المساهمة</td>
                              <td class="td_text_data center">الاجمالي</td>
                            </tr>
                             <tr>
                              <td><input type="text" maxlength="10" size="15" placeholder="البند" id="furniture_fixture" class="charges txt_field xx NumberInput" value="" name="furniture_fixture"></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="اثاث وتركيبات" id="machinery_equipment" class="charges txt_field xx NumberInput" value="" name="machinery_equipment"></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="آلالات والمعدات" id="hardware_software" class="charges txt_field xx NumberInput" value="" name="hardware_software"></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="رأس المال العامل" id="power_games" class="charges txt_field xx NumberInput" value="" name="power_games"></td>
                               <td><input type="text" maxlength="10" size="15" placeholder="قرض الصندوق" id="working_capital" class="charges txt_field xx NumberInput" value="" name="working_capital"></td>
                               <td><input type="text" maxlength="10" size="15" placeholder="المساهمة" id="contribute" class="txt_field xx NumberInput" value="" name="contribute" readonly="readonly"></td>
                               <td><input type="text" maxlength="10" size="15" placeholder="الاجمالي" id="total_cost" class="txt_field xx NumberInput" value="" name="total_cost" readonly="readonly"></td>
                            </tr>
                              </tbody></table>
                              
                              <p></p><p></p>
                              <table cellspacing="0" cellpadding="1" border="1" width="100%"  style="border:1px solid #bcc0c2;">
                            <tbody>
                            <tr>
                              <td class="td_text_data center">الملاحظات</td>
                              </tr>
                             <tr>
                              <td><textarea style="width:942px;" id="evolution_notes" name="evolution_notes"></textarea></td>
                              </tr>
                              </tbody></table>
                              <div class="form_raw">
                                  <div class="user_txt">قرار اللجنة</div>
                                  <div style="width: 460px;" class="user_field">
                                    ‫الموافقة على القرض<input type="radio" placeholder="الموافقة على القرض" class="req" onchange="check_comitee(this.value)" value="loan_aproval" id="commitee_decision" name="commitee_decision">
                                    
                                    ‫ رفض الطلب<input type="radio" placeholder=" رفض الطلب" class="req" onchange="check_comitee(this.value)" value="rejection_applicants" id="is_project2" name="commitee_decision">
                                    
                                     ‫‫تأجيل الطلب<input type="radio" placeholder="تأجيل الطلب" class="req" onchange="check_comitee(this.value)" value="postponed" id="is_project2" name="commitee_decision">
                                    ‫‫تحويل للهيئة<input type="radio" placeholder="تحويل للهيئة" class="req" onchange="check_comitee(this.value)" value="conversion" id="is_project2" name="commitee_decision">
                                  </div>
                                </div>
                                
                                
                                <table cellspacing="0" cellpadding="1" border="1" width="100%"  style="border:1px solid #bcc0c2;">
                            <tbody>
                            <tr>
                              <td class="td_text_data center">اسم العضو</td>
                              <td class="td_text_data center">التوقيع</td>
                              <td class="td_text_data center">الملاحظات</td>
                              </tr>
                              <tr>
                              <td></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="الالات ومعدات" id="machinery_equipment_val" class="charges txt_field xx" value="" name="machinery_equipment_val"></td>
                              <td><input type="text" maxlength="10" size="15" placeholder="الاجهزة والبرامج" id="machinery_equipment_val" class="charges txt_field xx"="" name="hardware_software"></td>
                              </tr>
                              </tbody></table>
                              
            <!--<table cellspacing="0" cellpadding="1" border="1" width="100%">
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
                              </tbody></table>-->
          <!--   <div style="width:226px; text-decoration:underline;padding-right: 14px;" class="user_txt"><h3>ب ) تحليل الأرباح والخسائر :</h3></div>                 
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
          -->  
            <div class="form_raw">
              <div class="user_txt"></div>
              <div class="user_field">
                <button type="button" id="save_data_form" class="btnx green">حفظ</button>
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
