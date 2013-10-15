<div class="page-header position-relative">
    <h1>
        	បង្ហាញ​ខ្នាត​នៃ​ ធាតុ​ជំងឺ
        <small>
            <i class="icon-double-angle-right"></i>
            	បង្ហាញ​រាល់​ឈ្មោះ ធាតុ​នៃ​ជំងឺ​ទាំង​អស់
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
                    <th class="center sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 56px;">
                        <label>
                            <input type="checkbox" class="ace">
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>លរ</th>
                    <th>តំលៃ ខ្នាត</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

                <?php
                if ($ills_items_dimentions_data->num_rows()) {
                    foreach ($ills_items_dimentions_data->result_array() as $row) {
                        //unset($row[USE_PASSWORD]); // remove password
                        ?>

                        <tr class="odd">
                            <td class="center  sorting_1">
                                <label>
                                    <input type="checkbox" class="ace">
                                    <span class="lbl"></span>
                                </label>
                                <?php echo form_hidden(USERS . USE_ID, json_encode(array('data' => $row))); ?>
                            </td>

                            <td class=" "><?php echo $row['ill_ite_dim_id']; ?></td>
                            <td class=" "><?php echo $row['ill_ite_dim_value']; ?></td>
                            <td class=" ">
                                <div class="hidden-phone visible-desktop action-buttons">
                                    <a class="blue ajax" href="<?php echo site_url('ill_items_dimentions/view/'.$row['ill_ite_dim_id']); ?>">
                                        <i class="icon-eye-open bigger-130"></i>
                                    </a>

                                    <a class="green" data-user='<?php echo json_encode(array('data' => $row)); ?>' href="<?php echo site_url('ill_items_dimentions/edit/'.$row['ill_ite_dim_id']); ?>">
                                        <i class="icon-pencil bigger-130"></i>
                                    </a>

                                    <a class="red delete" href="<?php echo site_url('ill_items_dimentions/delete/'.$row['ill_ite_dim_id']); ?>">
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
<script src="<?php echo site_url(JS.'jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo site_url(JS.'jquery.dataTables.bootstrap.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
    	$('.msg_success, .msg_error, .msg_info').click(function(){
    		$(this).fadeOut();
    	});
        // Register
        var uri = [$('[name="base_url"]').val(),
            $('[name="segment1"]').val(),
            $('[name="segment2"]').val()];

        // action ajax
        $('.ajax').on('click', function() {
            var user = $(this).data('user');
            console.log(user)
            $('.message').html('');
            $.ajax({
                type: "POST",
                url: this.href,
                data: user
            }).done(function(data) {
                content_loader(data);
            });
            return false;
        });

        //Delete
        $(".delete").on('click', function() {
            if(!confirm('តើ​អ្នក​ពិត​ជា​ចង់​លុប​មែន​ទេ?')){
            	return false;
            }
        });
    });
</script>
<script type="text/javascript">
    jQuery(function($) {
        var oTable1 = $('#sample-table-2').dataTable({
            "aoColumns": [
                {"bSortable": false},
                null, null
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

