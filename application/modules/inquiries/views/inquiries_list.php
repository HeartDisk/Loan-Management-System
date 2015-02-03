<script src="<?PHP echo base_url();?>js/jquery2.js"></script>

<style>

.team1_tab_top {

	width: 20% !important

}

.team1_tab_txt {

	width: 15% !important

}

.tab_control_last {

	margin-left: -5px !important;

}

</style>

<style type="text/css">

/*table.gridtable {

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

	font-weight: bold !important;

	padding: 2px;

	border-style: solid;

	border-color: #666666;

	background-color: #ffffff;

}*/



.modal_window {

	display: none; /* don't show it */

	position: fixed;

}

.web_dialog_overlay {

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

	display: none;

}

.web_dialog {

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

	display: none;

}

.web_dialog_form {

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

.web_dialog_title {

	border-bottom: solid 2px #0000;

	background-color: #CCC;

	padding: 4px;

	color: White;

	font-weight: bold;

	text-align: right;

}

.web_dialog_title a {

	color: White;

	text-decoration: none;

}

.align_right {

	text-align: Left;

}

.msg {

	text-align: center;

	padding-top: 16%;

}

.gridtable td a:visited {

	font-size: 12px !important;

}

.raqam {

	width: 8% !important;

}

.mashrooh {

	width: 12% !important;

}

.hatif {

	width: 10% !important;

}

.marhala {

	width: 10% !important;

}

.bataka {

	width: 13% !important;

}

.akhir {

	width: 13% !important;

}

.tareekh {

	width: 13% !important;

}

.ijrah {

	width: 15% !important;

}

.font-small {

	font-size: 12px !important

}

tfoot {

	display: table-header-group !important;

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

          <div class="data_title">القائمة ‬‎</div>

        </div>

        <div class="data">

          <table id="example" class="table table-striped table-bordered gridtable" cellspacing="0" width="100%">

            <thead>

              <tr>

                <th class="raqam">رقم </th>

                <th>الاسم</th>

                <th class="anwoa">النوع</th>

                <th class="bataka">البطاقة الشخصية</th>

                <th class="hatif">الهاتف</th>

                <th class="akhir">أخر الإستفسارات</th>

                <th class="tareekh">تاريخ التسجيل</th>

                <th class="ijrah">الإجراءات</th>

              </tr>

            </thead>

            <tfoot>

              <tr>

                <td></td>

                <td><input type="text" name="textfield" id="textfield"  class="flex_feild"/></td>

                <td><input type="text" name="textfield2" id="textfield2"  class="flex_feild"/></td>

                <td><input type="text" name="textfield9" id="textfield9"  class="flex_feild"/></td>

                <td><input type="text" name="textfield3" id="textfield3"  class="flex_feild"/></td>

                <td><input type="text" name="textfield7" id="textfield7"  class="flex_feild"/></td>

                <td>&nbsp;</td>

                <td>&nbsp;</td>

              </tr>

            </tfoot>

            <tbody>

              <?php if(!empty($inquiries)):?>

              <?php foreach($inquiries as $i=>$inq):?>

              <?php $all_data		=	$this->inq->getLastDetail($inq->tempid);?>

              <?php //echo '<pre>'; print_r($all_data['main']->applicant);?>

              <?php //echo '<pre>'; print_r($all_data['main']->phones);?>

              <?php $user_detail	=	$this->inq->get_user_name($inq->tempid);?>

              <?php $gender		=	$this->inq->get_gender($inq->tempid);?>

              <?php $phone		=	$this->inq->get_phone_number($inq->tempid);?>

              <?php $data		=	$this->inq->get_last_note($inq->tempid);?>

              <?php 

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

                <td class="Number"><?php echo applicant_number($inq->tempid);?></td>

                <td><?php foreach($all_data['main']->applicant as $names):?>

                  <?php echo $names->first_name.' '.$names->middle_name.' '.$names->last_name.' '.$names->family_name;?>

                  <?php endforeach;?></td>

                <td><?php foreach($all_data['main']->applicant as $gender):?>

                  <?php echo $gender->applicanttype;?>

                  <?php endforeach;?></td>

                <td class="Number"><?php foreach($all_data['main']->applicant as $idcard):?>

                  <?php echo $idcard->idcard;?>

                  <?php endforeach;?></td>

                <td class="Number"><?php foreach($phone as $ph):?>

                  <?php echo $ph->phonenumber;?>

                  <?php endforeach;?></td>

                <td><a href="javascript:void(0)" class="history" id="<?php echo $inq->tempid;?>"><span class="font-small"><?php echo $type_name;?></span></a></td>

                <td class="Number"><?php echo arabic_date($inq->applicantdate);?></td>

                <td>

                <a class="needtip" href="<?php echo base_url() ?>inquiries/newinquery/<?php echo $inq->tempid;?>"  title="تعديل"> <img src="<?php echo base_url() ?>images/listicon/edit.png" width="16" height="16" /> </a> 

                <a href="#" class="delete-btn needtip" id="<?php echo $inq->tempid;?>" data-url="<?php echo base_url();?>inquiries/delete_auditor/<?php echo $inq->tempid;?>" title="حذف"> <img src="<?php echo base_url() ?>images/body/contant/delete.png" width="16" height="16" /> </a> 

                <a href="#" title="مشاهدة" class="detail-view-inquiry needtip" id="<?php echo $inq->tempid;?>"> <img src="<?php  echo base_url();?>images/view.png" width="16" height="16"/> </a> 

                <a href="#" title="رسالة " onclick="showSMSBox('<?php echo $inq->tempid;?>','inquiry')" class="needtip" id="<?php echo $inq->tempid;?>"> <img src="<?php  echo base_url();?>images/forward.png" width="16" height="16"/> </a>

                <a href="<?php echo base_url(); ?>inquiries/get_sms_history/1/<?php echo $inq->tempid;?>" title="قائمة الرسائل النصية" class="needtip" id="<?php echo $inq->tempid;?>"> <img src="<?php  echo base_url();?>images/smssent.png" width="16" height="16"/> </a>

                </td>

              </tr>

              <?php 

				  	unset($user_detail,$gender,$array_size,$last_arry_key,$last_array,$type_id,$type_name);

				  	endforeach;?>

              <?php endif;?>

            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>

</div>

<div id="set-dialog-message" class="show-content modal_window" title="مشاهدة"c style="display:none;"></div>

<div id="dialog-confirm" title="تحذير" style="display:none;">

  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>هل أنت متأكد أنك تريد الحذف؟</p>

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

	//////////////////////////////////////////////////

	

	

});

</script>

<?php $this->load->view('common/dialogue_box',array('need'=>'SMS'));?>

<?php $this->load->view('common/footer');?>



