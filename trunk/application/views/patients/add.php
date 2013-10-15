<div class="page-header position-relative">
    <h1>
        បង្កើត​អ្នក​ជំងឺ​ថ្មី
        <small>
            <i class="icon-double-angle-right"></i>
             	សូម​បំ​ពេញ​រាល់​ពត៌មាន​ អោយ​បាន​គ្រប់​ជ្រុង​ជ្រោយ 
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <?php echo form_open(site_url('patients/add_save'),'class="form-horizontal"');?>
            <div class="control-group">
                <label class="control-label" for="patFirstName">គោត្តនាម</label>

                <div class="controls">
                    <input required name="txt_patFirstName" type="text"  minlength="3" id="first_name" placeholder="គោត្តនាម">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="patLastName">នាម</label>

                <div class="controls">
                    <input required name="txt_patLastName" type="text"  minlength="3" id="last_name" placeholder="នាម">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="sex">ភេទ</label>
                <div class="controls">
                    <select name="txt_patSex">
                    	<option value="0">-ភេទ-</option>
                    	<option value="m">ប្រុស</option>
                    	<option value="f">ស្រី</option>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="patientIdentityCard">អាយុ</label>

                <div class="controls">
                    <input name="txt_patAge" type="number"  minlength="1" id="age" placeholder="អាយុ">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="patientIdentityCard">លេខ​អត្តសញ្ញាណប័ណ្ណ</label>

                <div class="controls">
                    <input name="txt_patIdentityCard" type="number"  minlength="3" id="identity_card" placeholder="លេខ​អត្តសញ្ញាណប័ណ្ណ">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="pat_phone">
            	<div class="control-group">
	                <label class="control-label" for="phone">លេខ​ទូរស័ព្ទ</label>
	                <div class="controls">
	                    <input required name="txt_patPhone[]" value="" type="number"  minlength="10" id="phone" placeholder="(855)">
	                    <span class="icon-plus-sign" style="cursor: pointer;" name="add_more"></span>
	                    <span class="help-inline"></span>
	                </div>
	            </div>
	            <div id="phone_container"></div>
            </div>
			<div class="control-group">
                <label class="control-label" for="patEmail">អ៊ី​ម៉ែល</label>
                <div class="controls">
                    <input name="txt_patEmail" type="email"  minlength="3" id="email" placeholder="name@example.com">
                    <span class="help-inline"></span>
                </div>
            </div>
			<div class="control-group">
                <label class="control-label" for="patPattor">ណែ​នាំ​ពី​វេជ្ជ​បណ្ឌិត</label>
                <div class="controls">
                    <select name="txt_patReference">
                    	<option value="0">-គ្មាន-</option>
                    	<?php
                    	if($doctors_data->num_rows() > 0){
                    		foreach($doctors_data->result() as $values){
                    			echo '<option value="'.$values->doc_id.'">'.$values->doc_firstName.' '.$values->doc_lastName.'</option>';
                    		}
                    	}
                    	?>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="patStatus">ស្ថានភាព</label>

                <div class="controls">
                    <input name="txt_patStatus" checked="checked" type="checkbox" id="status" placeholder="Status" class="ace ace-switch ace-switch-7">
                    <span class="lbl"></span>
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
                    	សារដើម
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
            
		$('.pat_phone span[name="add_more"]').click(function(){
        	var html = <?php echo json_encode(patient_phone()); ?>;
        	$('#phone_container').append(html);
        });
        
        $(document).on('click','.control-group span[name="remove_phone"]',function(){
        	$(this).parent().parent().remove();
        });
        
        $('form[name="add"]').find("input,select").not('[type="submit"]').jqBootstrapValidation(
                {
                    submitSuccess: function($form, event) {
                        var d = {data: $('form[name="add"]').toJSON()};
                        console.log(d);
                        go_loader();
                        $.ajax({
                            type: 'POST',
                            data: d,
                            dataType: 'json',
                            url: uri[0] + 'doctors/add_save'
                        }).done(function(data) {
                            console.log(data);
                            //data.result 0:Invalid, 1:Success, 2: Could not create
                            if (data.result == 1) {
                                notify('Done! ', 'Create new ill group successfully', 'gritter-success');
                                $('.loader').fadeOut();
                            }
                            else if (data.result == 3) {
                                notify('Fail! ', 'Ill group name already exist, please try another name!', 'gritter-error');
                                back_loader();
                            }
                            else if (data.result == 0) {
                                notify('Fail! ', 'Could not create new ill group, please try again', 'gritter-error');
                                back_loader();
                            }
                            else {
                                notify('Fail! ', 'System could not add new, please contact to system administrator', 'gritter-error');
                                back_loader();
                            }
                        });
                        event.preventDefault();

                    }
                }
        );
    });
</script>