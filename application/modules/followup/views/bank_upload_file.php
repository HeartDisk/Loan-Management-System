<?php $this->load->view('common/meta');?>

    <link href="<?php echo base_url(); ?>/css/new.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/demo.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/dmuploader.js"></script>


<div class="body">

<?php $this->load->view('common/banner');?>

<div class="body_contant">

  <?php $this->load->view('common/floatingmenu');?>

  <?PHP parentMenu(); ?>

  <div class="main_contant">

    <!--<div class="shortcuts">

      <div class="short_cut_item"> <a href="departments_view.html">الأقسام</a></div>

      <div class="short_cut_item"> <a href="questions_view.html">الأسئلة</a></div>

      <div class="short_cut_item"> <a href="schedule_view.html">المتسابقين</a></div>

    </div>-->

    <div class="data_raw">

      <div class="main_box">

        <div class="data_box_title">

          <!--<div class="data_box_title_icon"><img src="images/menu/question_s.png" width="22" height="20" /></div>-->

          <div class="data_title">تحميل الملف</div>

          <!--<div class="page_controls">

            <div class="page_control"><a href="#"><img src="images/body/contant/refresh.png" width="28" height="26"  border="0" /></a></div>

            <div class="page_control"><a href="#"><img src="images/body/contant/back.png" width="28" height="26" border="0" /></a></div>

          </div>-->

        </div>



        <div class="data">

          <div class="main_data">

            <form action="<?php echo base_url();?>followup/add_excel" method="post" id="validate_form" name="validate_form" autocomplete="off" enctype="multipart/form-data">

              <!--<div class="form_raw">

                <div class="form_txt">تحميل</div>

                <div class="form_field_selected">

       				<input type="file" name="file" id="file">
                </div>

              </div>-->
              <div class="form_raw unmusanif">
				
				  <!-- D&D Zone-->
				  <div id="drag0" class="uploader">
						<div class="browser">
					  <label>
						<span>تحميل</span>
						<input type="file" name="files[]" multiple title='تحميل'>
                        <input type="hidden" name="attachment" id="attachment" />
					  </label>
					</div>
				  </div>
				  
				  <!-- /D&D Zone -->
				<div class="panel-body demo-panel-files" id='demo-files0'>
					  <span class="demo-note"></span>
					</div>
				</div>
			<!--<div class="main_withoutbg">

                <div class="add_question_btn">

                <input type="button" name="save_data_form" id="save_data_form" class="transperant_btn"  value="حفظ" />

                </div>

              </div>-->

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>
<?php
	$mss = $this->session->flashdata('msg');
	if($mss){
	?>
    <script type="text/javascript">
	show_notification('تم تحديث البيانات بنجاح');
	</script>
	<?php
		}
	?>
    <script type="text/javascript">
    $(function(){
					//alert('asdas');	
				  	$('.uploader').dmUploader({
					url: config.BASE_URL+'followup/add_excel',
					dataType: 'json',
					allowedTypes: '*',
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
						//$("#document_file"+id).val(ff.filename);
						//$("#attachment").val(ff.filename);
						if(ff.status == 'ok'){
							show_notification('تم تحديث البيانات بنجاح');
						}
						else{
							show_notification(ff.status);
						}
						 
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
    
<?php $this->load->view('common/footer');?>

