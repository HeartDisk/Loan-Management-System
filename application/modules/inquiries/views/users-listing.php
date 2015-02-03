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
            <div class="data_title">جميع الاعضاء</div>
          </div>
          <div class="data">
            <table id="example" class="table table-striped table-bordered gridtable" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>اسم</th>
                  <th>اسم المستخدم</th>
                  <th>البريد الإلكتروني</th>
                  <th>رقم الهاتف</th>
                  <th>فرع</th>
				  <th style="display:none;">فرع</th>
                  <th class="action">الإجراءات</th>
                </tr>               
              </thead>  
               <tfoot>
                <tr>
                  <td><input type="text" name="textfield2" id="textfield2"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield9" id="textfield9"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield3" id="textfield3"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield7" id="textfield7"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield7" id="textfield7"  class="flex_feild"/></td>
                  <td><input type="text" name="textfield7" id="textfield7"  class="flex_feild"/></td>
                </tr>
                </tfoot>           
              <tbody>
                <?php if(!empty($all_users)):?>
					<?php foreach($all_users as $user):?>
                    <tr>
						<td><?php echo $user->firstname.' '.$user->lastname; ?></td>
						<td><?php echo $user->user_name;?></td>
						<td class="Email"><?php echo $user->email;?></td>
						<td class="Number"><?php echo $user->number;?></td>
						<td><?php echo $user->branch_name;?></td>
						<td style="display:none;"><?php echo $user->total;?></td>
						<td>
							<?PHP if(check_permission($module,'u')==1) { ?><a title="تعديل" class="needtip" href="<?php echo base_url() ?>inquiries/add_user_registeration/<?php echo $user->id;?>">
								<img src="<?php  echo base_url();?>images/body/contant/edit.png" width="16" height="16" />
							</a>
                            <?PHP } ?>
                        <?PHP if(check_permission($module,'d')==1) { ?>
							<a title="حذف" href="#" class="delete-btn needtip" id="<?php echo $user->id;?>" data-url="<?php echo base_url();?>inquiries/delete_user/<?php echo $user->id;?>">
								<img src="<?php  echo base_url();?>images/body/contant/delete.png" width="16" height="16" />
							</a>
                            <?PHP } ?>
							<a href="<?php echo base_url();?>inquiries/user_applicants/<?PHP echo $user->id; ?>"> (<?php echo $user->total;?>)</a> 
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
	
	
	
	var user_table =  $('#example').DataTable();	
	user_table.columns().eq(0).each( function ( colIdx ) {		
        $( 'input', user_table.column( colIdx ).footer() ).on( 'keyup change', function () {
            user_table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
		
    } );
	
	user_table.order( [[ 5, 'desc' ]] ).draw();
	// "order": [[ 5, "desc" ]]
	$('#example_filter').hide();
	
	$('.searchfilter').keyup(function(){
		//console.log($(this).val());
		$('#example tbody td').removeHighlight().highlight($(this).val());
	});
	
}
	
	
});
</script>
<?php $this->load->view('common/footer');?>
