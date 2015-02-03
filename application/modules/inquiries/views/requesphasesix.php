<?php $this->load->view('common/meta');?>

<div class="body">
<div id="tasjeel"></div>
<?php $this->load->view('common/banner');?>
<div class="body_contant">
  <?php //$this->load->view('common/floatingmenu');?>
  <?PHP parentMenu(); ?>
  <div class="main_contant">
    <form id="form2" name="form2" method="post" action="<?PHP echo base_url().'index.php/inquiries/insertSecondForm'//echo md5(date('Ymdhisf')); ?>" autocomplete="off">
      <input type="hidden" name="tempid" id="tempid" value="<?PHP echo $main->tempid; ?>" />
      <?php if($t=='review') { ?>
      <input type="hidden" name="review" id="review" value="1" />
      <?PHP } ?>
      <?PHP if($t=='review') { ?>
      <?PHP } ?>
      <div class="main_box">
        <div class="data_box_title"> <a class="addnewdata" href="<?PHP echo base_url(); ?>inquiries/resetinq">إضافة جديدة</a>
          <div class="data_box_title_icon"><img src="<?PHP echo base_url(); ?><?PHP echo $module['module_icon']; ?>" width="22" height="22"></div>
          <div class="data_title">موافقة أولية علي تمويل المشروع</div>
        </div>
        <div class="data_raw">
          <div class="data">
            <div class="main_data">
              <div class="personal" id="personal2">
              <div class="form_raw">
                <div class="user_txt">  </div>
                <div class="user_field">
                  <div class="form_field_selected">
                   ‫تاسيس<input checked="checked" type="radio"  name="establishment" id="establishment" value="establishment" onchange="check_comitee(this.value)"  class="req" placeholder='قرار اللجنة' />
                   ‫تدعيم<input checked="checked" type="radio"  name="establishment" id="establishment" value="establishment" onchange="check_comitee(this.value)"  class="req" placeholder='‫تدعيم' />
                   ‫شراء<input checked="checked" type="radio"  name="establishment" id="establishment" value="establishment" onchange="check_comitee(this.value)"  class="req" placeholder='شراء' />
                   <br />
                   	<?php echo loan_category('loan_category_id',$single_loan->loan_category_id);?>
                  </div>
                </div>
              </div>
                
                <style>
				table, th, td {
    border: 1px solid black;
}


                </style>	
                <style>
table a:link {
	color: #666;
	font-weight: bold;
	text-decoration:none;
}
table a:visited {
	color: #999999;
	font-weight:bold;
	text-decoration:none;
}
table a:active,
table a:hover {
	color: #bd5a35;
	text-decoration:underline;
}
table {
	font-family:Arial, Helvetica, sans-serif;
	color:#666;
	font-size:12px;
	text-shadow: 1px 1px 0px #fff;
	background:#eaebec;
	margin:20px;
	border:#ccc 1px solid;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;
}
table th {
	padding:21px 25px 22px 25px;
	border-top:1px solid #fafafa;
	border-bottom:1px solid #e0e0e0;

	background: #ededed;
	background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
	background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child {
	text-align: left;
	padding-left:20px;
}
table tr:first-child th:first-child {
	-moz-border-radius-topleft:3px;
	-webkit-border-top-left-radius:3px;
	border-top-left-radius:3px;
}
table tr:first-child th:last-child {
	-moz-border-radius-topright:3px;
	-webkit-border-top-right-radius:3px;
	border-top-right-radius:3px;
}
table tr {
	text-align: center;
	padding-left:20px;
}
table td:first-child {
	text-align: left;
	padding-left:20px;
	border-left: 0;
}
table td {
	padding:18px;
	border-top: 1px solid #ffffff;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;

	background: #fafafa;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
	background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td {
	background: #f6f6f6;
	background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
	background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
table tr:last-child td {
	border-bottom:0;
}
table tr:last-child td:first-child {
	-moz-border-radius-bottomleft:3px;
	-webkit-border-bottom-left-radius:3px;
	border-bottom-left-radius:3px;
}
table tr:last-child td:last-child {
	-moz-border-radius-bottomright:3px;
	-webkit-border-bottom-right-radius:3px;
	border-bottom-right-radius:3px;
}
table tr:hover td {
	background: #f2f2f2;
	background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
	background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);	
}
</style>
                    
                <div class="form_raw">
                <table width="100%">
                	<tr><td class=" center">الاسم</td>
                               <td><input type="text" maxlength="10" size="15" placeholder="اسم" id="applicant_specialization" class="txt_field xx NumberInput dateinput hasDatepicker" value="" name="applicant_specialization"></td>
                              <td class=" center">رقم الهاتف</td>
                              <td><input type="text" maxlength="10" size="15" placeholder="رقم الهاتف" id="applicant_specialization" class="txt_field xx NumberInput" value="" name="applicant_specialization"></td>
                           </tr>
                      <tr><td class=" center">نشاط المشروع</td>
                               <td><input type="text" maxlength="10" size="15" placeholder="نشاط المشروع" id="applicant_specialization" class="txt_field xx NumberInput dateinput hasDatepicker" value="" name="applicant_specialization"></td>
                              <td class="center">ص.ب</td>
                              <td><input type="text" maxlength="10" size="15" placeholder="ص.ب" id="applicant_specialization" class="txt_field xx NumberInput" value="" name="applicant_specialization"></td>
                           </tr>
                           <tr><td class=" center"> موقع المشروع</td>
                               <td><input type="text" maxlength="10" size="15" placeholder=" موقع المشروع" id="applicant_specialization" class="txt_field xx NumberInput dateinput hasDatepicker" value="" name="applicant_specialization"></td>
                              <td class=" center">ر.ب</td>
                              <td><input type="text" maxlength="10" size="15" placeholder="ر.ب" id="applicant_specialization" class="txt_field xx NumberInput" value="" name="applicant_specialization"></td>
                           </tr>     
                </table>
                <div style="width:260px; text-decoration:underline;" class="user_txt"><h3>استخدامات القرض:</h3></div>
                  <table width="100%">
                        <thead>
                           <tr>
                              <th colspan="3">البرنامج التمويلي</th>
                              <th colspan="3">الموافقات الأولية</th>
                            </tr>
                           <tr>
                           	<th>البلند</th>
                            <th>التكلفة</th>
                            <th>المساهمة</th>
                            <th>البلند</th>
                            <th>المبلغ(ر.ع)</th>
                            <th>%النسبة</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>شسي</td>
                              <td>صث</td>
                              <td>ؤئءؤئ</td>
                              <td rowspan="2">شسشسي</td>
                              <td rowspan="2">شس</td>
                              <td rowspan="2">شسثقصثق</td>
                           </tr>
                           <tr>
                              <td>شسي</td>
                              <td>صث</td>
                              <td>ؤئءؤئ</td>
                           </tr>
                           
                           <tr>
                              <td>شسي</td>
                              <td>صث</td>
                              <td>ؤئءؤئ</td>
                              <td rowspan="4">شسشسي</td>
                              <td rowspan="4" colspan="2">شس</td>
                           </tr>
                           <tr>
                              <td>شسي</td>
                              <td>صث</td>
                              <td>ؤئءؤئ</td>
                           </tr>
                           <tr>
                              <td>شسي</td>
                              <td>صث</td>
                              <td>ؤئءؤئ</td>
                           </tr>
                           <tr>
                              <td>شسي</td>
                              <td>صث</td>
                              <td>ؤئءؤئ</td>
                           </tr>
                       		<tr>
                              <td>إلاجمالي</td>
                              <td colspan="2">صث</td>
                              <td >إلاجمالي</td>
                              <td colspan="2">شس</td>
                           </tr>
                           
                       </tbody>
                       
                         <!--<tbody>
                           <tr>
                              <td>طلبات القروض</td>
                              <td>Otto</td>
                              <td >makr124</td>
                              <td><span class="label label-sm label-success">Approved</span></td>
                           </tr>
                           <tr>
                              <td>الموافقات الأولية على القروض</td>
                              <td>Nilson</td>
                              <td >jac123</td>
                              <td><span class="label label-sm label-info">Pending</span></td>
                           </tr>
                           <tr>
                              <td>نسبة الموافقة مقارنة بالطلبات(%)</td>
                              <td>Cooper</td>
                              <td >lar</td>
                              <td><span class="label label-sm label-warning">Suspended</span></td>
                           </tr>
                           <tr>
                              <td>المبالغ المعتمدة</td>
                              <td>Lim</td>
                              <td >sanlim</td>
                              <td><span class="label label-sm label-danger">Blocked</span></td>
                           </tr>
                        </tbody>-->
                        </table>
                </div>
                <div class="form_raw">
                <div style="width:260px; text-decoration:underline;" class="user_txt"><h3>سداد القرض:</h3></div>
                       <table width="100%">
                        <tr><td class=" center">مبلغ القرض</td>
                                   <td><input type="text" maxlength="10" size="15" placeholder="مبلغ القرض" id="applicant_specialization" class="txt_field xx NumberInput dateinput hasDatepicker" value="" name="applicant_specialization"></td>
                                  <td class=" center">نسبة الرسوم الاداراية والفنية</td>
                                  <td><input type="text" maxlength="10" size="15" placeholder="نسبة" id="applicant_specialization" class="txt_field xx NumberInput" value="" name="applicant_specialization" style="width: 30% ! important;">% في السنة</td>
                               </tr>
                          <tr><td class=" center">فترة السماح</td>
                                   <td><input type="text" maxlength="10" size="15" placeholder="فترة" id="applicant_specialization" class="txt_field xx NumberInput dateinput hasDatepicker" value="" name="applicant_specialization"></td>
                                  <td class="center">مدة سداد القرض</td>
                                  <td><input type="text" maxlength="10" size="15" placeholder="مدة" id="applicant_specialization" class="txt_field xx NumberInput" value="" name="applicant_specialization"></td>
                               </tr>
                               <tr><td class=" center"> ألية السداد</td>
                                   <td><input type="text" maxlength="10" size="15" placeholder=" ألية" id="applicant_specialization" class="txt_field xx NumberInput dateinput hasDatepicker" value="" name="applicant_specialization"></td>
                                  <td class=" center">الضمانات المطلوبة</td>
                                  <td></td>
                                  </tr>
                                <tr>
                                <td class=" center">الشروط</td>
                                
                                  <td></td>
                                  <td class=" center">آليات الصرف</td>
                                  <td></td>
                               
                                </tr>       
                    </table>
                      </div>
                
            </div>
            
            <input type="button"  id="save_data"/>
            
            
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
			  
			  function check_comitee(val){
				  //	alert(val);
				  	if(val == 'approved'){
						$("#is_aprovedamount").hide();
						$("#is_aproved").show();	
						$("#is_forward").hide();
						$("#is_postponed").hide();
						$("#is_rejected").hide();
					}
					else if(val =='postponed'){
							$("#is_postponed").show();
							$("#is_aprovedamount").hide();
							$("#is_aproved").hide();
							$("#is_forward").hide();
							$("#is_rejected").hide();
						}
					else if(val =='convesion'){
							$("#is_forward").show();
							$("#is_postponed").hide();
							$("#is_aprovedamount").hide();
							$("#is_aproved").hide();
							$("#is_rejected").hide();
						}	
					else{
							$("#is_forward").hide();
							$("#is_aproved").hide();
							$("#is_rejected").show();
							$("#is_postponed").hide();
							$("#is_aprovedamount").hide();
							$("#is_aproved").hide();
						//rejected
					}
				  		
				 }
				 
				 function check_quez(val){
					 	//alert(val);
						if(val == 'queries'){
							$("#is_query").show();
							$("#is_aprovedamount").hide();
							$("#is_postponed").hide();
						}
						else{
							
							$("#is_query").hide();
							$("#is_aprovedamount").show();
						}
					}
				 
				 $("#is_project2").click(function(){
					 		//alert('click');
					 });
					 $("#committee_decision").click(function(){
					 		//alert('click');
					 });
			  function check_project(val){
				  //	alert(val);
				  	if(val == 1){
						$("#form_details").fadeIn();
						$(".sForm").addClass('req');
						$(".sNumber").addClass('NumberInput');
						//sForm sNumber
					}
					else{
							$("#form_details").fadeOut();
							$(".sForm").removeClass('req');
							$(".sNumber").removeClass('NumberInput');
					}
				 }
			  $(function(){
				  	$('.national').keyup(function(){
						var national_male_employes = $('#national_male_employes').val();
						var national_female_employes = $('#national_female_employes').val();
						if(!isNaN(national_male_employes) && !isNaN(national_female_employes))
						{
							var total_national = parseInt(national_male_employes)+parseInt(national_female_employes);
							$('#total_national').val(total_national);
						}
					});
					
					$('.foreign').keyup(function(){
						var foreign_male_employes = $('#foreign_male_employes').val();
						var foreign_female_employes = $('#foreign_female_employes').val();
						if(!isNaN(foreign_male_employes) && !isNaN(foreign_female_employes))
						{
							var total_foreign = parseInt(foreign_male_employes)+parseInt(foreign_female_employes);
							$('#total_foreign').val(total_foreign);
						}
					});
				  });
			  </script>
<?php $this->load->view('common/footer');?>
