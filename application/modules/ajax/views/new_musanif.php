<div class="form_raw unmusanif ms<?php echo $a ?>">
  <input onclick="removeMusanif('<?php echo $a ?>')" id="remove" value="حذف" type="button" style="float:left !important;">
  <div class="user_txt">الجهة التمويلية</div>
  <div class="user_field">
    <input name="financing[]" id="financing[]" value="<?PHP //echo $main->financing; ?>"  placeholder="الجهة التمويلية" type="text" class="ssForm txt_field ">
  </div>
</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt">مبلغ القرض</div>
  <div class="user_field">
    <input name="loan_amount[]" id="loan_amount[]" value="<?PHP //echo $main->loan_amount; ?>"  placeholder="مبلغ القرض" type="text" class="ssForm txt_field NumberInput">
  </div>
</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt">المبلغ المسدد</div>
  <div class="user_field">
    <input name="amount_paid[]" id="amount_paid[]" value="<?PHP // echo $main->amount_paid; ?>"  placeholder="المبلغ المسدد" type="text" class="ssForm txt_field NumberInput">
  </div>
</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt"></div>
  <div class="user_field">
    <input name="amount_paid[]" id="amount_paid[]" value="<?PHP // echo $main->amount_paid; ?>"  placeholder="المبلغ المسدد" type="text" class="ssForm txt_field NumberInput">
  </div>
</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt">المتبقي</div>
  <div class="user_field">
    <input name="residual[]" id="residual[]" value="<?PHP //echo $main->residual; ?>"  placeholder="المتبقي" type="text" class="ssForm txt_field ">
  </div>

</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt">القسط الشهري</div>
  <div class="user_field">
    <input name="monthly_installment[]" id="monthly_installment[]" value="<?PHP //echo $main->monthly_installment; ?>"  placeholder="القسط الشهري" type="text" class="ssForm txt_field ">
  </div>
</div>
<div class="form_raw unmusanif ms<?php echo $a ?>"  id="type_value2">
  <div class="user_txt">الملاحظات</div>
  <div class="user_field">
    <textarea name="musanif_notes[]" id="notes[]" placeholder="الملاحظات"  class="sForm txt_field" ><?PHP //echo $main->project_difficulties; ?>
</textarea>
  </div>
  <div class="form_raw unmusanif">
				  <!-- D&D Zone-->
				  <div id="drag<?php echo $a ?>" class="uploader">
						<div class="browser">
					  <label>
						<span>تحميل</span>
						<input type="file" name="files[]" multiple title='تحميل'>
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files<?php echo $a ?>'>
					  <span class="demo-note"></span>
					</div>
								<input type="hidden" name="document_file[]" id="document_file<?php echo $a ?>">

				</div>
</div>
<script>
counter = '<?php echo $counter; ?>';
$('.uploader').dmUploader({
					url: config.BASE_URL+'inquiries/uploadFile',
					dataType: 'json',
					allowedTypes: 'image/*',
					/*extFilter: 'jpg;png;gif',*/
					onInit: function(){
					 idd = $(this).attr('id');
					 console.log(idd);
					 id_index = idd.substring(4,5);
					 // $.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
					},
					onBeforeUpload: function(id){
					 // $.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);

					  //$.danidemo.updateFileStatus(id, 'default', 'Uploading...');
					},
					onNewFile: function(id, file){
						//alert(id);
						demoFile = '#demo-files'+id_index;
						id = idd.substring(4,5);
						//alert(id);
					  $.danidemo.addFile(demoFile, id, file);
					},
					onComplete: function(){
					 // $.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
					},
					onUploadProgress: function(id, percent){
					  var percentStr = percent + '%';
						id = idd.substring(4,5);
						//alert(id);
					  $.danidemo.updateFileProgress(id, percentStr);
					},
					onUploadSuccess: function(id, data){
					 // $.danidemo.addLog('#demo-debug', 'success', 'Upload of file #' + id + ' completed');

					  //$.danidemo.addLog('#demo-debug', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));

					 // $.danidemo.updateFileStatus(id, 'success', 'Upload Complete');
						id = idd.substring(4,5);
						//alert(id);
				
					  $.danidemo.updateFileProgress(id, '100%');
						ff = data;	
						//$("#document_file").val(ff.filename);
						$("#document_file"+id).val(ff.filename);
						//createElement(counter,ff.filename);
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
</script>