<script src="<?PHP echo base_url();?>js/jquery2.js"></script>

<script type="text/javascript">

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

<?php $this->load->view('common/meta');?>

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

            <div class="data_title">قائمة رفض</div>
			            <div class="data_title" style="float:left;"><a id="prin" href="javascript:void(0)" class="addnewdata needtip" original-title="">طباعة</a></div>
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

                <td class="Number"><?php echo applicant_number($applicatnt->applicant_id);?></td>

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

                <td class="Number"><?php  echo $applicatnt->appliant_id_number;?></td>

                <td class="Number">

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

                  <?php if($applicatnt->form_step	==	'5'){ echo 'قرار اللجنة &nbsp;';  }
				  //	echo "<pre>";
					//print_r($applicatnt);
					if($applicatnt->commitee_decision_type =='postponed'){ echo "تأجيل ";}elseif($applicatnt->commitee_decision_type =='rejected'){ echo "الرفض ";}elseif($applicatnt->commitee_decision_type =='approved'){ echo "موافقة ";}
				  
				  ?></td>
				 &nbsp;
                <td>

                    <?PHP if(check_permission($module,'u')==1) { ?><a title="تعديل" class="needtip" href="<?php echo base_url() ?>inquiries/newrequest/<?php echo $applicatnt->applicant_id.'/'.$applicatnt->form_step;?>"><img src="<?php  echo base_url();?>images/body/contant/edit.png" width="16" height="16" /></a><?PHP } ?>

                    <?PHP if(check_permission($module,'d')==1) { ?><a title="حذف" class="delete-btn needtip" id="<?php echo $applicatnt->applicant_id;?>" href="#"  data-url="<?php echo base_url();?>inquiries/delete_applicant/<?php echo $applicatnt->applicant_id;?>"><img src="<?php  echo base_url();?>images/body/contant/delete.png" width="16" height="16" /></a><?PHP } ?>

                <a title="مشاهدة" class="detail needtip" href="#"  id="<?php echo $applicatnt->applicant_id;?>"><img src="<?php  echo base_url();?>images/view.png" width="16" height="16"/></a> 

                <a title="تاريخ" class="fancybox fancybox.ajax needtip" href="<?php  echo base_url();?>ajax/timeline/<?php echo($applicatnt->applicant_id);?>/<?php echo $applicatnt->form_step;?>"><img src="<?php  echo base_url();?>images/timeline.png" width="16" height="16"/></a>

                <a title="رسالة" class="needtip " onclick="showSMSBox('<?php echo $applicatnt->applicant_id;?>','')" href="#" id="<?php echo $applicatnt->applicant_id;?>"><img src="<?php  echo base_url();?>images/forward.png" width="16" height="16"/></a>

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

<?php $this->load->view('common/dialogue_box',array('need'=>'SMS'));?>

<?php $this->load->view('common/footer');?>

