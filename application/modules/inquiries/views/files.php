<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ajaxfileupload.js"></script>
<form name="form" action="" method="POST" enctype="multipart/form-data">
		<table cellpadding="0" cellspacing="0" class="tableForm">

		<thead>
			<tr>
				<th>Please select a file and click Upload button</th>
			</tr>
		</thead>
		<tbody>	
			<tr>
				<td><input id="fileToUpload"  type="file" size="45" name="fileToUpload" class="input files" style="display:none;"></td>			</tr>
             <td><input id="fileToUpload2" type="file" size="45" name="fileToUpload2" class="input files" style="display:none;"></td>			</tr>

		</tbody>
			<tfoot>
				<tr>
					<td><button class="button" id="buttonUpload1" onClick="return ajaxFileUpload();" style="display:none;">Upload</button>
                    <td><button class="button" id="buttonUpload2" onClick="return ajaxFileUpload();" style="display:none;">Upload</button>
                     <a href="javascript:void(0)" id="pdf" onClick="chooseFile()"><img src="<?php echo base_url();?>images/icons/pdf.png"  width="50" height="50"/> 
					   <a href="javascript:void(0)" id="pdf2" onClick="chooseFile(2)"><img src="<?php echo base_url();?>images/icons/pdf.png"  width="50" height="50"/> 

                    </td>
				</tr>
			</tfoot>
	
	</table>
		</form>
        <script type="text/javascript">
	function ajaxFileUpload(idd)
	{
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'<?php echo base_url(); ?>admin/doUpload',
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							alert(data.msg);
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;

	}

function ajaxFileUpload2(idd)
	{
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'<?php echo base_url(); ?>admin/doUpload',
				secureuri:false,
				fileElementId:'fileToUpload2',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							alert(data.msg);
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;

	}
	
		$(document).ready(function(e) {
        	//alert('asdasd');
			/*$("#pdf").click(function(e) {
				
             	$("#fileToUpload").trigger('click');   
            });*/
/*			$("#fileToUpload").change(function(e) {
               myobj = $(this);
			   alert(myId);
			   // return ajaxFileUpload();
            });*/
			
			$(".files").change(function(e) {
               myobj = $(this).attr('id');;
			   alert(myobj);
			   if(myobj == 'fileToUpload2'){
				   return ajaxFileUpload2();
				  }
				  else{
			   			return ajaxFileUpload();
				  }
			});
			
			
    });
	
	function chooseFile(id){
		
		$("#fileToUpload").trigger('click');   
    	
	}
	</script>	