<style>
.team1_tab_top {
	width: 20% !important
}
.team1_tab_txt {
	width: 15% !important
}
</style>
<style type="text/css">
/*table.gridtable {
	font-size: 15px !important;
	color: #333333;
	border-width: 0px !important;
	border-color: #666666;
	border-collapse: separate !important;
	direction: rtl !important;
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
	text-align: right !important;
}
table.gridtable td {
	border-width: 0px !important;
	font-size: 12px !important;
	/*font-weight: bold !important;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}*/
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
            <div class="data_title">قائمةالزيارة الأولية  ‎</div>
            <a original-title="" class="addnewdata needtip" href="<?php echo base_url(); ?>inquiries/updatezyarat/<?php echo $app_id; ?>">اضافه</a>
          </div>
          <div class="data">
            <table id="example" class="table table-striped table-bordered gridtable" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="codenumber">الزيارة رقم</th>
                  <th class="codename">قيمة الإجار الشهري</th>
                  <th class="mashrow">هل المقر مناسب للمشروع؟</th>
                  <th class="anwoa">الكهرباء</th>
                  <th class="bataka">تاريخ الزيارة</th>
                  <th class="marhala">أضيفت من قبل</th>
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
                <?php  $counter = 0 ; if(!empty($all_applicatns)):?>
                <?php foreach($all_applicatns as $applicatnt):
                  		$counter++;
				?>
                <tr id="bingo<?php echo $applicatnt->applicant_id;?>">
                  <td><?php echo $counter;?></td>
                  <td><?php echo $applicatnt->monthly_rent;?></td>
                  <td><?php  echo $applicatnt->is_suitable;?></td>
                  <td><?php  echo $applicatnt->is_electricity;?></td>
                  <td><?php echo $applicatnt->created?></td>
                  <td><?php echo $applicatnt->firstname?></td>
                  <td>
                  <a href="<?php echo base_url() ?>inquiries/updatezyarat/<?php echo $applicatnt->applicant_id;?>/<?php echo $applicatnt->zyarat_id;?>">
                      <img src="<?php  echo base_url();?>images/body/contant/edit.png" width="16" height="16" />
                      </a><a href="#" class="delete-btn" id="<?php echo $applicatnt->applicant_id;?>" data-url="<?php echo base_url();?>inquiries/delete_applicant/<?php echo $applicatnt->applicant_id;?>">
                      <img src="<?php  echo base_url();?>images/body/contant/delete.png" width="16" height="16" />
                      </a> <a href="#" class="detail" id="<?php echo $applicatnt->applicant_id;?>">
                      <img src="<?php  echo base_url();?>images/view.png" width="16" height="16"/>
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
