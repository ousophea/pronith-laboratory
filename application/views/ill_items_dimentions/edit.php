<?php
if (isset($edit_data)) {
	$edit_data = $edit_data -> result_array();
}else{
	$edit_data = FALSE;
}
?>
<div class="page-header position-relative">
    <h1>
        កែប្រែ​ខ្នាត​ធាតុ​ជំងឺ : <?php echo $edit_data[0]['ill_ite_dim_value']; ?>
        <small>
            <i class="icon-double-angle-right"></i>
            	សូម​បំ​ពេញ​រាល់​ពត៌មាន​ អោយ​បាន​គ្រប់​ជ្រុង​ជ្រោយ
        </small>
    </h1>
</div>
<script type="text/javascript" src="<?php echo site_url(JS.'nicEdit.js') ?>"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { 
		//nicEditors.allTextAreas();
		new nicEditor({buttonList : ['subscript','superscript'],iconsPath : '<?php echo site_url(IMAGES."nicEditorIcons.gif");?>'}).panelInstance('ill_dimension'); 
		
		});
</script>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <?php echo form_open(site_url('ill_items_dimentions/edit_save'), 'class="form-horizontal"', array('ill_ite_dim_id' => $edit_data[0]['ill_ite_dim_id'])); ?>
            <div class="control-group">
                <label class="control-label" for="name">ឈ្មោះ</label>

                <div class="controls">
                    <textarea id="ill_dimension" name="txt_illItemDimentionValue" cols="10" rows="3"><?php echo $edit_data[0]['ill_ite_dim_value']; ?></textarea>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-info" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    	បង្កើត
                </button>

                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    	សារ​ដើម
                </button>
            </div>
        <?php echo form_close(); ?>
    </div><!--/.span-->
</div>
<script type="text/javascript">
    	$(document).ready(function() {
        var uri = [$('[name="base_url"]').val(),
            $('[name="segment1"]').val(),
            $('[name="segment2"]').val()];
            
        $('.doc_phone span[name="add_more"]').click(function(){
        	var html = <?php echo json_encode(doctor_phone()); ?>;
				$('#phone_container').append(html);
		});

		$(document).on('click', '.control-group span[name="remove_phone"]', function() {
			$(this).parent().parent().remove();
		});

		$('.control-group span[name="ajax_remove_phone"]').click(function() {
			var pho_id = $(this).attr('rel');
			$.post(<?php echo json_encode(site_url('doctors/ajax_remove_phone')); ?>, {
				id : pho_id
			}).done(function(data) {
				$('#phone_group_'+pho_id).html('<label class="control-label"></label><div class="controlls" style="color:green;">phone number removed</div>');
			}).fail(function(err){
				//case false of ajax do
				$('#phone_group_'+pho_id).html('<label class="control-label"></label><div class="controlls" style="color:red;">phone number removed with error</div>');
			});
		});

				$('form[name="add"]').find("input,select").not('[type="submit"]').jqBootstrapValidation({
					submitSuccess : function($form, event) {
						var d = {
							data : $('form[name="add"]').toJSON()
						};
						console.log(d);
						go_loader();
						$.ajax({
							type : 'POST',
							data : d,
							dataType : 'json',
							url : uri[0] + 'doctors/add_save'
						}).done(function(data) {
							console.log(data);
							//data.result 0:Invalid, 1:Success, 2: Could not create
							if (data.result == 1) {
								notify('Done! ', 'Create new ill group successfully', 'gritter-success');
								$('.loader').fadeOut();
							} else if (data.result == 3) {
								notify('Fail! ', 'Ill group name already exist, please try another name!', 'gritter-error');
								back_loader();
							} else if (data.result == 0) {
								notify('Fail! ', 'Could not create new ill group, please try again', 'gritter-error');
								back_loader();
							} else {
								notify('Fail! ', 'System could not add new, please contact to system administrator', 'gritter-error');
								back_loader();
							}
						});
						event.preventDefault();

					}
				});
				});
</script>