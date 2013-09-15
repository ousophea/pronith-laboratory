<div class="page-header position-relative">
    <h1>
        List ills
        <small>
            <i class="icon-double-angle-right"></i>
            List all ills information
        </small>
    </h1>
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
                    <th class="sorting">Name</th>
                    <th class="sorting">Group</th>
                    <th class="sorting">Create</th>
                    <th class="sorting">Modifier</th>
                    <th class="sorting">Status</th>
                    <th style="width: 161px;">Action</th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

                <?php
                if ($data->num_rows()) {
                    foreach ($data->result_array() as $row) {
                        ?>

                        <tr class="odd object" data-object='<?php echo json_encode(array('data' => $row)); ?>'>
                            <td class="center">
                                <label>
                                    <input type="checkbox" name="id[]" value="<?php echo $row[ILL_ID]; ?>" class="ace">
                                    <span class="lbl"></span>
                                </label>
                                <?php echo form_hidden(ILLGROUPS . ILL_ID, json_encode(array('data' => $row))); ?>
                            </td>

                            <td class=" "><?php echo $row[ILL_NAME]; ?></td>
                            <td class=" "><?php echo $row[ILG_NAME]; ?></td>
                            <td class=" "><?php echo $row[ILL_DATECREATED]; ?></td>
                            <td class=" "><?php echo $row[ILL_DATEMODIFIED]; ?></td>
                            <td class=" "><input <?php echo ($row[ILL_STATUS])?'checked':''; ?> type="checkbox" id="<?php echo ILL_STATUS; ?>" class="ace status ace-switch ace-switch-7"><span class="lbl"></span></td>
                            
                            <td class=" ">
                                <div class="hidden-phone visible-desktop action-buttons">
                                    <a class="blue view-modal">
                                        <i class="icon-eye-open bigger-130"></i>
                                    </a>

                                    <a class="green edit" href="<?php echo base_url(); ?>ills/edit">
                                        <i class="icon-pencil bigger-130"></i>
                                    </a>

                                    <a class="red delete" href="<?php echo base_url(); ?>ills/delete/">
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
            object = $(this).data('object');
            console.log(object)
            $.ajax({
                   url:base_url+'ills/status',
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
            parents = $(this).parents(".object");
            object = $(parents).data('object');
            bootbox.confirm("Are you sure want to delete ill?", function(result) {
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
                                    notify('Done!', 'Delete user successully.', 'gritter-success');
                                    $(parents).fadeOut(2000, function() {
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
            html +=htmlView("Name", object['<?php echo ILL_NAME; ?>']);
            html +=htmlView("Ill group", object['<?php echo ILG_NAME; ?>']);
            html +=htmlView("Date created", object['<?php echo ILL_DATECREATED; ?>']);
            html +=htmlView("Date modified", object['<?php echo ILL_DATEMODIFIED; ?>']);
            html +=htmlView("Status", (object['<?php echo ILL_STATUS; ?>']==1)?'On':'Off');
            view(html,'Ill view detail');// Popup
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

