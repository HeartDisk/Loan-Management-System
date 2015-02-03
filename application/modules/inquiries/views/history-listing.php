<style>
.team1_tab_top {
	width: 20% !important
}
.team1_tab_txt {
	width: 15% !important
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
            <div class="data_title">قائمة الرسائل المرسلة ‬‎</div>
          </div>
          <div class="data">
            <table id="example" class="table table-striped table-bordered gridtable" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>اسم المتلقي</th>
                  <th>رقم المتلقي</th>
                  <th>رسالة</th>
                  <th>اسم المرسل</th>
                  <th>التاريخ</th>
                </tr>               
              </thead>  
               <tfoot>
                <tr>
                  <td><input type="text" name="textfield2" id="textfield2"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield9" id="textfield9"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield3" id="textfield3"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield7" id="textfield7"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield7" id="textfield7"  class="flex_feild"/></td>
                </tr>
                </tfoot>           
              <tbody>
                <?php if(!empty($sms_history)):?>
                <?php foreach($sms_history as $history):?>
                <tr>
                  <?php if($module_id	==	'1'):?>
                  	<td><?php echo $history->first_name.' '.$history->middle_name.' '.$history->last_name.' '.$history->family_name; ?></td>
                  <?php else:?>
                  	<td><?php echo $history->applicant_first_name.' '.$history->applicant_middle_name.' '.$history->applicant_last_name.' '.$history->applicant_sur_name ?></td>
                  <?php endif;?>
                  <td><?php echo $history->sms_receiver_number;?></td>
                  <td><?php echo $history->sms_message;?></td>
                  <td><?php echo $history->firstname.' '.$history->lastname;?></td>
                  <td><?php echo date('M d y',strtotime($history->sms_sent_date));?></td>
                  
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
<?php $this->load->view('common/footer');?>
