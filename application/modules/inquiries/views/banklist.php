<style>

.team1_tab_top {

	width: 20% !important

}

.team1_tab_txt {

	width: 15% !important

}

.table tr{
	cursor:pointer;
}
</style>

<style type="text/css">

tfoot

{

	display: table-header-group !important;

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

            <div class="data_title">قائمة البنك  </div>

          </div>

          <div class="data">

            <table id="example" class="table table-striped table-bordered gridtable" cellspacing="0" width="100%">

              <thead>

                <tr>

                  <th class="codenumber">رقم</th>

                  <th class="codename">اسم</th>

                  <th class="mashrow">صيغة المشروع</th>

                  <th class="anwoa">النوع</th>

                  <th class="bataka">البطاقة الشخصية</th>

                  <th class="marhala">المرحلة</th>

                  <th class="action">الإجراءات</th>

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

                </tr>

                </tfoot>           

              <tbody>

                <?php if(!empty($all_applicatns)):?>

                <?php foreach($all_applicatns as $applicatnt):?>

                <tr id="bingo<?php echo $applicatnt->applicant_id;?>" ondblclick="viewFrom(<?php echo $applicatnt->applicant_id;?>)">

                  <td><?php echo applicant_number($applicatnt->applicant_id);?></td>

                  <td><?php echo $applicatnt->applicant_first_name.' '.$applicatnt->applicant_middle_name.' '.$applicatnt->applicant_last_name.' '.$applicatnt->applicant_sur_name;?></td>

                  <td><?php  echo $applicatnt->applicant_type;?></td>

                  <td><?php  echo $applicatnt->applicant_gender;?></td>

                  <td><?php  echo $applicatnt->appliant_id_number;?></td>

                  <td><?php if($applicatnt->form_step	==	'1'): echo 'تسجيل الطلبات'; endif;?>

                   <?php if($applicatnt->form_step	==	'2'): echo 'بيانات المشروع'; endif;?>

                   <?php if($applicatnt->form_step	==	'3'): echo 'القرض المطلوب'; endif;?>

                   <?php if($applicatnt->form_step	==	'4'): echo 'دراسه وتحليل الطلب'; endif;?>

                   <?php if($applicatnt->form_step	==	'5'): echo 'قرار اللجنة'; endif;?>

                   <?php if($applicatnt->form_step	==	'6'): echo 'موافقة أولية'; endif;?></td>

                  <td>

                  <?PHP if(check_permission($module,'u')==1) { ?><a href="<?php echo base_url() ?>followup/bankfollowup/<?php echo $applicatnt->applicant_id;?>"><img src="<?php  echo base_url();?>images/body/contant/edit.png" width="16" height="16" /></a><?PHP } ?>
                  <?PHP if(check_permission($module,'d')==1) { ?><a href="#" class="delete-btn" id="<?php echo $applicatnt->applicant_id;?>" data-url="<?php echo base_url();?>inquiries/delete_applicant/<?php echo $applicatnt->applicant_id;?>"><img src="<?php  echo base_url();?>images/body/contant/delete.png" width="16" height="16" /></a><?PHP } ?>
                      <a href="#" class="detail" id="<?php echo $applicatnt->applicant_id;?>">

                      <img src="<?php  echo base_url();?>images/view.png" width="16" height="16"/>

                      </a>
                      <a href="<?php echo base_url();?>followup/bankfollowup/19" >

                      <img src="<?php  echo base_url();?>images/US-dollar-icon.png" width="16" height="16"/>

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
<div id="set-dialog-message-3" class="show-content" title="كشف بالمستندات" style="display:none;"> </div>

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

