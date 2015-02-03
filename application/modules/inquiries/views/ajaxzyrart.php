<div id="zyara_detail<?php  echo $i;?>">
<h3>الزيارة<?php echo $zyara_counter; ?> </h3>
<div class="form_raw">
                  <div class="user_txt">قيمة الإجار الشهري</div>
                  <div class="user_field"><input type="text" value="" name="monthly_rent[]" id="monthly_rent"  class="txt_field"/>  
                  </div>
                  <div class="user_txt" style="padding-right: 21px;">اخرى</div>
                  <div class="user_field"><input type="text" value="" name="monthly_other_rent[]" id="monthly_other_rent" class="txt_field"/>  
                  </div>
                </div>
                <?php
				//echo "<pre>";
				//print_r($sad);
				//echo $sad->is_electricity;
				?>
                <div class="form_raw ">
                  <div class="user_txt">الكهرباء</div>
                  <div class="user_field">
                  		 نعم<input type="radio" name="is_electricity[]"  class="sForm" value="نعم" />
                         لا<input type="radio"  name="is_electricity[]" class="sForm"  value="لا"/>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">الماء</div>
                  <div class="user_field">
                  		 نعم<input type="radio"    name="is_water[]"  class="sForm" value="نعم" />
                         لا<input type="radio"   name="is_water[]" class="sForm"  value="لا"/>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt" style=" width:260px;">هل المقر مناسب للمشروع؟</div>
                  <div class="user_field">مناسب<input  type="radio"  name="is_suitable[]"  class="sForm" value="مناسب" />
                      غيرمناسب<input type="radio"  name="is_suitable[]" class="sForm"  value="غيرمناسب"/>
                  </div>
                </div>
                <div class="form_raw">
                  <div class="user_txt">المساحة الجملية  للمقر</div>
                  <div class="user_field">
                  		<input type="text" value="" name="fine_headquarter[]" id="fine_headquarter"  class="txt_field"/>
                         م2
                  </div>
                </div>
                <div class="form_raw musanif">
                  <div class="user_txt">منها مغطاة</div>
                  <div class="user_field">
                  		<input type="text" value="" name="which_covered[]" id="which_covered"  class="txt_field"/>
                       م2
                  </div>
                </div>
                <div class="form_raw musanif">
                  <div class="user_txt">ملاحظات الزيارة</div>
                  <div class="user_field">   <textarea name="visit_notes[]" id="visit_notes" placeholder="ملاحظات الزيارة"  class="sForm txt_field" ></textarea>
                  </div>
                  <div class="user_field" style="float:left;">
                             <a onclick="removezyara('<?php echo $i ?>','');" id="remove" href="javascript:void(0)"><img width="30" src="<?php echo base_url(); ?>images/delete.png"></a>
                </div>
                </div>
                <div class="form_raw musanif" >
                  <div class="user_txt">الرأي الفني</div>
                  <div class="user_field">   <textarea name="technical_notes[]" id="problem_notes" placeholder="الرأي الفني"  class="sForm txt_field" ></textarea>
                  </div>
                </div>
                
                <div class="form_raw musanif">
                  <div class="user_txt">التوصيات</div>
                  <div class="user_field">   <textarea name="notes[]" id="problem_notes" placeholder="التوصيات"  class="sForm txt_field" ></textarea>
                  </div>
                </div>
                <div class="form_raw " id="type_value2">
				
				  <!-- D&D Zone-->
				  <div id="drag<?php echo $counter; ?>" class="uploader">
						<div class="browser">
					  <label>
						<span>تحميل</span>
						<input type="file" name="files[]" multiple title='تحميل'>
                        
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files<?php echo $counter; ?>'>
					  <span class="demo-note"></span>
					</div>
				</div>
                </div>
                <script type="text/javascript">
                   $(document).ready(function(){
				  $('.uploader').dmUploader({
					url: config.BASE_URL+'inquiries/uploadFile',
					dataType: 'json',
					allowedTypes: 'image/*',
					/*extFilter: 'jpg;png;gif',*/
					onInit: function(){
					 idd = $(this).attr('id');
					 
					 console.log(idd);
					 id_index = idd.substring(4,5);
					 //alert(id_index);
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
					 
						demoFile = '#demo-files'+id_index;
						//id = idd.substring(4,5);
						//console.log(idd);
						id = idd.substring(4,5);
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
						$.danidemo.updateFileProgress(id, '100%');
						ff = data;	
						$("#document_file"+id).val(ff.filename);
						createElement(counter,ff.filename);
						 counter++;
						 
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