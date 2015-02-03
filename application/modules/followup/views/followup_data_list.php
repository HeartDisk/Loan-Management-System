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

            <div class="data_title">قائمة المتابعة</div>
			<a  href="<?php echo base_url(); ?>followup/requestfollowup/<?php echo $applicant_id; ?>" class="addnewdata needtip" original-title="">اضافه</a>
          </div>

          <div class="data">

            <table id="example" class="table table-striped table-bordered gridtable" cellspacing="0" width="100%">

              <thead>

                <tr>

                  <th class="codenumber">عدد زيارة</th>

                  <th class="codename">تاريخ الزيارة</th>

                  <th class="anwoa">اسم فيستر</th>
                  <th class="anwoa">الإجراءات</th>
                </tr>               

              </thead>  

               <tfoot>

                <tr>

                  <td></td>

                  <td><input type="text" name="textfield" id="textfield"  class="flex_feild"/></td>
                 
                  <td>&nbsp;</td>

                </tr>

                </tfoot>           

              <tbody>
						<?php
						$counter =1;
						if(!empty($financial)){
							foreach($financial as $i=>$finance){
								//date('Y-m-d')
								 $visit = strtotime($finance->visit);
								?>
                      
                                <tr id="<?php echo $finance->applicant_id ?>" class="details" ondblclick="viewfollwdata(this.id,'<?php echo  $visit;  ?>')">
                                <td><?php echo $counter; ?>     	<input type="hidden" id="type<?php echo $finance->returns_id ?>" name="type<?php echo $finance->returns_id ?>" value="return"  />
                    </td>
                                <td><?php echo $finance->visit; ?></td>
                                <td><?php echo $finance->user_name; ?></td>
                                
								  <td>
					    <a href="<?php echo base_url() ?>index.php/followup/editVisit/<?php echo $finance->applicant_id ?>/<?php echo  $visit;  ?>" id="<?php echo $finance->returns_id;?>">

                      <img src="<?php  echo base_url();?>images/body/contant/edit.png" width="16" height="16"/>

                      </a>
                   </td>
                                </tr>
								<?php	
							
							$counter++;
							}	
						}						
						?>
                
                

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

function viewfollwdata(id,typ){
		id_v = id;
		//alert(id_v)
		type_v = $("#type"+id_v).val();
		//alert(type_v);
		location.href = config.BASE_URL+'followup/requestfollowupdata/'+id_v+'/'+typ;
}
	
function viewfollwup(id){
	 location.href = config.BASE_URL+'followup/requestfollowupdetails/'+id; 	
}
</script>

<?php $this->load->view('common/footer');?>

