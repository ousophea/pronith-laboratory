<div class="page-header position-relative">
    <h1>
        List ill group
        <small>
            <i class="icon-double-angle-right"></i>
            List all ill group information
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">
        <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable" aria-describedby="sample-table-2_info">
            <thead>
                <tr role="row">
                    <th class="center sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 56px;">
                        <label>
                            <input type="checkbox" class="ace">
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending" style="width: 168px;">Name</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" style="width: 121px;">Description</th>
                    <th class="hidden-480 sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Clicks: activate to sort column ascending" style="width: 132px;">Create</th>
                    <th class="hidden-phone sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Update: activate to sort column ascending" style="width: 197px;">Modifier</th>
                    <th class="hidden-480 sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 164px;">Status</th>
                    <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 161px;">Action</th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

                <?php
                if ($data->num_rows()) {
                    foreach ($data->result_array() as $row) {
                        ?>

                        <tr class="odd" data-object='<?php echo json_encode(array('data' => $row)); ?>'>
                            <td class="center  sorting_1">
                                <label>
                                    <input type="checkbox" name="id[]" value="<?php echo $row[ILG_ID]; ?>" class="ace">
                                    <span class="lbl"></span>
                                </label>
                                <?php echo form_hidden(ILLGROUPS . ILG_ID, json_encode(array('data' => $row))); ?>
                            </td>

                            <td class=" "><?php echo $row[ILG_NAME]; ?></td>
                            <td class=" "><?php echo $row[ILG_DESCRIPTION]; ?></td>
                            <td class=" "><?php echo $row[ILG_DATECREATED]; ?></td>
                            <td class=" "><?php echo $row[ILG_DATEMODIFIED]; ?></td>
                            <td class=" "><input data-status='<?php echo json_encode(array('data' => $row)); ?>' name="<?php echo STATUS; ?>" <?php echo ($row[STATUS])?'checked':''; ?> type="checkbox" id="<?php echo STATUS; ?>" placeholder="Status" class="ace status ace-switch ace-switch-7"><span class="lbl"></span></td>
                            
                            <td class=" ">
                                <div class="hidden-phone visible-desktop action-buttons">
                                    <a class="blue view" href="<?php echo base_url(); ?>ill_groups/view">
                                        <i class="icon-eye-open bigger-130"></i>
                                    </a>

                                    <a class="green ajax" href="<?php echo base_url(); ?>ill_groups/edit">
                                        <i class="icon-pencil bigger-130"></i>
                                    </a>

                                    <a class="red delete" href="<?php echo base_url(); ?>ill_groups/delete/<?php echo $row[ILG_ID]; ?>">
                                        <i class="icon-trash bigger-130"></i>
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
<script src="<?php echo base_url() . JS; ?>jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() . JS; ?>jquery.dataTables.bootstrap.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Register
        var uri = [$('[name="base_url"]').val(),
            $('[name="segment1"]').val(),
            $('[name="segment2"]').val()];

        // action ajax
        $('.ajax').on('click', function() {
            var parent = $(this).parent().parent().parent();
            var data = $(parent).data('object');
            console.log(data)
            $('.message').html('');
            $.ajax({
                type: "POST",
                url: this.href,
                data: data
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
            var parent = $(this).parent().parent().parent();
            var data = $(parent).data('object');
            console.log(data)
            $.ajax({
                   url:base_url+'ill_groups/status',
                   data:data,
                   type:"POST",
                   dataType:'json'
               }).done(function(data) {
                        console.log(data);
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
                            //bootbox.alert('Could not delete user');
                        }
                        else if (data.result == 2) {
                            notify('Fail!', data.result + ': System not allow to change status, please contact to system administrator', 'gritter-error');
                            back_loader();
                            return false;
                            //bootbox.alert(data.result + ':System not allow to delete user, please contact to system administrator');
                        }
                        else {
                            notify('Fail!', data.result + ': Could not change status, please try again', 'gritter-error');
                            back_loader();
                            return false;
                            //bootbox.alert(data.result + ':Could not delete user, please try again');
                        }
                    });
            
        });

        // Delete
        $(".delete").on('click', function() {
            var url = this.href;
            var parent = $(this).parent().parent().parent();
            bootbox.confirm("Are you sure want to delete user?", function(result) {
                if (result) {
                    //bootbox.alert("You are sure!");
                    go_loader();
                    $.post(
                            url,
                            {},
                            function(data) {
                                if (data.result == 1) {
                                    // call notification
                                    notify('Done!', 'Delete user successully.', 'gritter-success');
                                    $(parent).fadeOut(2000, function() {
                                        this.remove()
                                    });
                                    $('.loader').fadeOut();
                                }
                                else if (data.result == 0) {
                                    // call notification
                                    notify('Fail!', 'Could not delete ill group, please try again.', 'gritter-error');
                                    back_loader();
                                    //bootbox.alert('Could not delete user');
                                }
                                else if (data.result == 2) {
                                    notify('Fail!', data.result + ': System not allow to delete ill group, please contact to system administrator', 'gritter-error');
                                    back_loader();
                                    //bootbox.alert(data.result + ':System not allow to delete user, please contact to system administrator');
                                }
                                else {
                                    notify('Fail!', data.result + ': Could not delete ill group, please try again', 'gritter-error');
                                    back_loader();
                                    //bootbox.alert(data.result + ':Could not delete user, please try again');
                                }
                            }, 'json'
                            );
                }

            });
            return false;
        });
        
        // view
        $('.view').click(function(){
            bootbox.alert("Data view");
            var parent = $(this).parent().parent().parent();
            var data = $(parent).data('object');
            console.log(data)
            
            return false;
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

