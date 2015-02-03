<?php $this->load->view('common/meta');?>
    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>
 <script type="text/javascript">
query_variable = '';
function apply_name(id){
	//query_variable = id;
	//alert(query_variable);
	//$("#selected_name").val(id);
	var request = $.ajax({
					  url: config.BASE_URL+'inquiries/updateFileSession',
					  type: "POST",
					  dataType: "html",
					  data: { fileId :id},
					  beforeSend: function() {		},
					  complete: function(){  },
					  success: function(msg){
						  	console.log(msg);
						 			
						  }
					});

}


$(window).on('load', function() { 
 	//alert('ready');
 	$('.uploader').dmUploader({
				extraData: {
		  docId:$("#selected_name").val()

		},  
					url: config.BASE_URL+'inquiries/uploadDocument/',
					dataType: 'json',
					allowedTypes: 'image/*',
					/*extFilter: 'jpg;png;gif',*/
					onInit: function(){
					 idd = $(this).attr('id');
					 
					 console.log(idd);
					 
					 id_index = idd.substring(4,5);
					 if(id_index == '_'){
					 	id_index = idd.substring(5,7);
					 	
					 }
					// alert(id_index);
					 // $.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
					},
					onBeforeUpload: function(id){
					 // $.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);

					  //$.danidemo.updateFileStatus(id, 'default', 'Uploading...');
					},
					onNewFile: function(id, file){
						//alert(id);
						idd = $(this).attr('id');
						id_index = idd.substring(4,5);
						
						id_index = idd.substring(4,5);
					 	id = idd.substring(4,5);
						if(id_index == '_'){
					 		id_index = idd.substring(5,7);
					 		id = idd.substring(5,7);
					 	}
					 
						demoFile = '#demo-files'+id_index;
						//id = idd.substring(4,5);
						//console.log(idd);
						
						//alert(idd);
					  $.danidemo.addFile(demoFile, id, file);
					},
					onComplete: function(){
					 // $.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
					},
					onUploadProgress: function(id, percent){
					  var percentStr = percent + '%';

					  $.danidemo.updateFileProgress(id, percentStr);
					  
					},
					onUploadSuccess: function(id, data){
					 // $.danidemo.addLog('#demo-debug', 'success', 'Upload of file #' + id + ' completed');

					  //$.danidemo.addLog('#demo-debug', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));

					 // $.danidemo.updateFileStatus(id, 'success', 'Upload Complete');
						id = idd.substring(4,5);
						if(id == '_'){
					 		id_index = idd.substring(5,7);
					 		id = idd.substring(5,7);
					 	}
						
						$.danidemo.updateFileProgress(id, '100%');
						ff = data;	
						$("#document_name_"+ff.type).val(ff.name);
						 
					 console.log(JSON.stringify(data));
					 
					},
					onUploadError: function(id, message){
					  $.danidemo.updateFileStatus(id, 'error', message);

					  $.danidemo.addLog('#demo-debug', 'error', 'Failed to Upload file #' + id + ': ' + message);
					},
					onFileTypeError: function(file){
					  $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
					},
					onFileSizeError: function(file){
					  $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
					},
					/*onFileExtError: function(file){
					  $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' has a Not Allowed Extension');
					},*/
					onFallbackMode: function(message){
					  $.danidemo.addLog('#demo-debug', 'info', 'Browser not supported(do something else here!): ' + message);
					}
				  });	
});

</script>
<div class="body">
<?php //$this->load->view('common/banner');?>
     <div class="main_box">
        <div class="data_raw">
          <?PHP //noticeboard($main->tempid); ?>
          <div class="data">
            <div class="main_data">
              <div class="form_raw">

				  <!-- D&D Zone-->
				  <div id="drag<?PHP echo $mustarik; ?>1" class="uploader">
						<div class="browser">
					  <label style="width: 150px;">
						<span>بطاقة سجل القوى العاملة</span>
						<input type="file" name="document_id<?PHP echo $mustarik; ?>1" id="document_id<?PHP echo $mustarik; ?>1" multiple title='بطاقة سجل القوى العاملة' onchange="apply_name('document_id_<?PHP echo $mustarik; ?>1')">
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files<?PHP echo $mustarik; ?>1'>
					  <span class="demo-note"></span>
					</div>
                <!-- D&D Zone-->

      </div>
      <div class="form_raw">
      						  <div id="drag<?PHP echo $mustarik; ?>2" class="uploader">
						<div class="browser">
					  <label style="width: 150px;">
						<span>شهادة عدم محكومية</span>
						<input type="file" name="document_id<?PHP echo $mustarik; ?>3" id="document_id<?PHP echo $mustarik; ?>3" multiple title='البطاقة الشخصية' onchange="apply_name('document_id_<?PHP echo $mustarik; ?>3')">
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files<?PHP echo $mustarik; ?>2'>
					  <span class="demo-note"></span>
					</div>    
      </div>
      <div class="form_raw">
      						  <div id="drag<?PHP echo $mustarik; ?>2" class="uploader">
						<div class="browser">
					  <label style="width: 150px;">
						<span>شهادة عدم محكومية</span>
						<input type="file" name="document_id<?PHP echo $mustarik; ?>3" id="document_id<?PHP echo $mustarik; ?>3" multiple title='البطاقة الشخصية' onchange="apply_name('document_id_<?PHP echo $mustarik; ?>3')">
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files<?PHP echo $mustarik; ?>2'>
					  <span class="demo-note"></span>
					</div>    
      </div>
      <div class="form_raw">
      						  <div id="drag<?PHP echo $mustarik; ?>4" class="uploader">
						<div class="browser">
					  <label style="width: 150px;">
						<span>دراسة الجدوى الإقتصادية للمشروع</span>
						<input type="file" name="document_id<?PHP echo $mustarik; ?>4" id="document_id<?PHP echo $mustarik; ?>4" multiple title='دراسة الجدوى الإقتصادية للمشروع' onchange="apply_name('document_id_<?PHP echo $mustarik; ?>4')">
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files<?PHP echo $mustarik; ?>4'>
					  <span class="demo-note"></span>
					</div>    
      </div>
      <div class="form_raw">
      						  <div id="drag<?PHP echo $mustarik; ?>5" class="uploader">
						<div class="browser">
					  <label style="width: 150px;">
						<span>صورة شمسية</span>
						<input type="file" name="document_id<?PHP echo $mustarik; ?>6" id="document_id<?PHP echo $mustarik; ?>6" multiple title='صورة شمسية' onchange="apply_name('document_id_<?PHP echo $mustarik; ?>6')">
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files<?PHP echo $mustarik; ?>5'>
					  <span class="demo-note"></span>
					</div>    
      </div>
      <div class="form_raw">
      						  <div id="drag<?PHP echo $mustarik; ?>6" class="uploader">
						<div class="browser">
					  <label style="width: 150px;">
						<span>شهادات الخبرة / التدريب</span>
						<input type="file" name="document_id<?PHP echo $mustarik; ?>7" id="document_id<?PHP echo $mustarik; ?>7" multiple title='شهادات الخبرة / التدريب' onchange="apply_name('document_id_<?PHP echo $mustarik; ?>7')">
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files<?PHP echo $mustarik; ?>6'>
					  <span class="demo-note"></span>
					</div>    
      </div>
      <div class="form_raw">
      						  <div id="drag7" class="uploader">
						<div class="browser">
					  <label style="width: 150px;">
						<span>بطاقة الضمان الاجتماعي</span>
						<input type="file" name="document_id<?PHP echo $mustarik; ?>8" id="document_id<?PHP echo $mustarik; ?>8" multiple title='بطاقة الضمان الاجتماعي' onchange="apply_name('document_id_8')">
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files<?PHP echo $mustarik; ?>7'>
					  <span class="demo-note"></span>
					</div>    
      </div>
            </div>
            </div>
        </div>
      </div>
