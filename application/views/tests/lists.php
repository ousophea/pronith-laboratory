<div class="page-header position-relative">
    <h1>
        បង្ហាញ​របាយការណ៍ តេស្ថ​ជំងឺ​
        <small>
            <i class="icon-double-angle-right"></i>
            បង្ហាញ​រាល់​ពត៌មាន ដែល​ទាក់​ទង​នឹង​​ការ​ធ្វើ​តេស្ថ
        </small>
    </h1>
    <?php
	if($this->session->flashdata('msg_success')){
	?>
	<div class="msg_success">
		<?php echo '<p>'.$this->session->flashdata('msg_success').'</p>'; ?>
	</div>
	<?php	
	}
	if($this->session->flashdata('msg_error')){
	?>
	<div class="msg_error">
		<?php echo '<p>'.$this->session->flashdata('msg_error').'</p>'; ?>
	</div>
	<?php
	}
	if($this->session->flashdata('msg_info')){
	?>
	<div class="msg_info">
		<?php echo '<p>'.$this->session->flashdata('msg_info').'</p>'; ?>
	</div>
	<?php
	}
	?>
</div>
<div class="row-fluid">
    <div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">
        <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable" aria-describedby="sample-table-2_info">
            <thead>
                <tr role="row">
                    <th class="center sorting_disabled">
                        <label>
                            <input type="checkbox" class="ace">
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th class="sorting">អ្នក​ជំ​ងឺ</th>
                    <th class="sorting">អ្នក​បង្កើត</th>
                    <th class="sorting">ថ្ងៃ​ខែ​បង្កើត</th>
                    <th class="sorting">ថ្ងៃ​មក​យក​លទ្ធផល</th>
                    <th class="sorting">លទ្ធផល​បាន​យក</th>
                    <th class="sorting">លទ្ធផល​ចេញ</th>
                    <th class="sorting">ទទួល​ជំ​ងឺ​តេស្ថ</th>
                    <th class="sorting">តំ​លៃ</th>
                    <th class="sorting">ប្រាក់​កក់</th>
                    <th class="sorting">ជំ​ពាក់</th>
                    <th class="sorting">បង់​រួច</th>
                    <th class="sorting">បញ្ចុះ​តំ​លៃ</th>
                    <th class="sorting">ពន្ធ</th>
                    <th class="sorting">កំរៃ​ជើងសារ</th>
                    <th style="width: 161px;">Action</th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

                <?php
                if ($patients_tests_data->num_rows()) {
                    foreach ($patients_tests_data->result_array() as $row) {
                        ?>

                        <tr class="odd object" data-object='<?php echo json_encode(array('data' => $row)); ?>'>
                            <td class="center">
                                <label>
                                    <input type="checkbox" name="id[]" value="<?php echo $row['pat_tes_id']; ?>" class="ace">
                                    <span class="lbl"></span>
                                </label>
                                <?php echo form_hidden(TBL_PREFEX.'patients_tests' . 'pat_tes_id', json_encode(array('data' => $row))); ?>
                            </td>

                            <td class=" "><?php echo $row['pat_name']; ?></td>
                            <td class=" "><?php echo $row['use_name']; ?></td>
                            <td class=" "><?php echo $row['pat_tes_dateCreated']; ?></td>
                            <td class=" "><?php echo $row['pat_tes_dateTimeReceived']; ?></td>
                            <td class=" "><?php echo ($row['pat_tes_isReceive'] == 1)?'មក​យក​រួច':'មិន​ទាន់​មក​យក'; ?></td>
                            <td class=" "><?php echo ($row['pat_tes_isResult'] == 1)?'លទ្ធផល​បាន​ចេញ':'លទ្ធផល​មិន​ទាន់​ចេញ'; ?></td>
                            <td class=" "><?php echo ($row['pat_tes_isReceiveIll'] == 1)?'ទទួល​បាន':'មិនទទួល​បាន'; ?></td>
                            <td class=" "><?php echo number_format($row['pat_tes_subTotal'],0); ?>៛</td>
                            <td class=" "><?php echo number_format($row['pat_tes_deposit'],0); ?>៛</td>
                            <td class=" "><?php echo number_format($row['pat_tes_owe'],0); ?>៛</td>
                            <td class=" "><?php echo ($row['pat_tes_isPaid'] == 1)?'បង់​រួច':'មិន​ទាន់​បង់​រួច'; ?></td>
                            <td class=" "><?php echo $row['pat_tes_discount']; ?>%</td>
                            <td class=" "><?php echo $row['pat_tes_tax']; ?>%</td>
                            <td class=" "><?php echo ($row['pat_tes_doctorCommission'] == 0)?'ពុំមាន':number_format($row['pat_tes_doctorCommission'],0).'៛'; ?></td>
                            <td class=" ">
                                <div class="hidden-phone visible-desktop action-buttons">
                                <?php
                                if($row['pat_tes_isPaid'] == 0){
                                ?>
                                	<a class="blue" href="<?php echo site_url('tests/pay_tests/'.$row['pat_tes_id']); ?>">
                                		បង់​ប្រាក់
                                	</a>
                                <?php
                                }else{
                                ?>
                                	<a style="color: green;">បង់​ប្រាក់</a>
                                <?php
                                }
								if($row['pat_tes_isResult'] == 0){
								?>
									<a class="blue" href="<?php echo site_url('tests/input_result_tests/'.$row['pat_tes_id']); ?>">
                                		បញ្ចូល​លទ្ធផល
                                	</a>
								<?php
								}else{
								?>
									<a style="color: green;">បញ្ចូល​លទ្ធផល</a>
								<?php
								}
                                ?>
                                	<a class="blue" href="<?php echo site_url('tests/print_result_tests/'.$row['pat_tes_id']); ?>">
                                		ព្រីន​​លទ្ធផល
                                	</a>
                                </div>
                            </td>
                        </tr>

                        <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
        var object, parents;
        // Register
        var uri = [$('[name="base_url"]').val(),
            $('[name="segment1"]').val(),
            $('[name="segment2"]').val()];

        // Load page edit and passing data
        $('.edit').on('click', function() {
            parents = $(this).parents(".object");
            object = $(parents).data('object');
            $('.message').html('');
            $.ajax({
                type: "POST",
                url: this.href,
                data: object
            }).done(function(data) {
                content_loader(data);
            });
            return false;
        });

        // status
        $(".status").on('click', function() {
                    //bootbox.alert("You are sure!");
            var base_url = $('[name="base_url"]').val();
            go_loader();
            parents = $(this).parents(".object");
            object = $(parents).data('object');
            $.ajax({
                   url:base_url+'ill_groups/status',
                   data:object,
                   type:"POST",
                   dataType:'json'
               }).done(function(data) {
                        if (data.result == 1) {
                            // call notification
                            notify('Done!', 'Status have been changed.', 'gritter-success');
                            $('.loader').fadeOut();
                            return true;
                            
                        }
                        else if (data.result == 0) {
                            // call notification
                            notify('Fail!', 'Could not change status, please try again.', 'gritter-error');
                            back_loader();
                            return false;
                            //bootbox.alert('Could not delete ill group');
                        }
                        else if (data.result == 2) {
                            notify('Fail!', data.result + ': System not allow to change status, please contact to system administrator', 'gritter-error');
                            back_loader();
                            return false;
                            //bootbox.alert(data.result + ':System not allow to delete ill group, please contact to system administrator');
                        }
                        else {
                            notify('Fail!', data.result + ': Could not change status, please try again', 'gritter-error');
                            back_loader();
                            return false;
                            //bootbox.alert(data.result + ':Could not delete ill group, please try again');
                        }
                    });
            
        });

        // Delete
        $(".delete").on('click', function() {
            var url = this.href;
            parents = $(this).parents(".object");
            object = $(parents).data('object');
            bootbox.confirm("Are you sure want to delete ill group?", function(result) {
                if (result) {
                    //bootbox.alert("You are sure!");
                    go_loader();
                    $.ajax({
                        url:url,
                        data:object,
                        type:"POST",
                        dataType:'json'
                    }).done(function(data) {
                                if (data.result == 1) {
                                    // call notification
                                    notify('Done!', 'Delete ill group successully.', 'gritter-success');
                                    $(parents).fadeOut(2000, function() {
                                        this.remove()
                                    });
                                    $('.loader').fadeOut();
                                }
                                else if (data.result == 0) {
                                    // call notification
                                    notify('Fail!', 'Could not delete ill group, please try again.', 'gritter-error');
                                    back_loader();
                                    //bootbox.alert('Could not delete ill group');
                                }
                                else if (data.result == 2) {
                                    notify('Fail!', data.result + ': System not allow to delete ill group, please contact to system administrator', 'gritter-error');
                                    back_loader();
                                    //bootbox.alert(data.result + ':System not allow to delete ill group, please contact to system administrator');
                                }
                                else {
                                    notify('Fail!', data.result + ': Could not delete ill group, please try again', 'gritter-error');
                                    back_loader();
                                    //bootbox.alert(data.result + ':Could not delete ill group, please try again');
                                }
                            });
                }

            });
            return false;
        });
        
        // View detail modal popup
        $('.view-modal').on('click',function(){
            parents = $(this).parents(".object");
            object = $(parents).data('object').data;
            var html = '';
            html +=htmlView("Name", object['<?php echo ILG_NAME; ?>']);
            html +=htmlView("Description", object['<?php echo ILG_DESCRIPTION; ?>']);
            html +=htmlView("Date created", object['<?php echo ILG_DATECREATED; ?>']);
            html +=htmlView("Date modified", object['<?php echo ILG_DATEMODIFIED; ?>']);
            html +=htmlView("Status", (object['<?php echo ILG_STATUS; ?>']==1)?'On':'Off');
            view(html,'Ill group view detail');// Popup
        });



    });
</script>

<script type="text/javascript">
    jQuery(function($) {
        var oTable1 = $('#sample-table-2').dataTable({
            "aoColumns": [
                {"bSortable": false},
                null, null, null, null, null,
                {"bSortable": false}
            ]});


        $('table th input:checkbox').on('click', function() {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function() {
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });

        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                return 'right';
            return 'left';
        }
    })
</script>