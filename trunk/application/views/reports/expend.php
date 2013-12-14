<div class="page-header position-relative">
    <h1>
        បង្ហាញ​ ការ​ចំ​ណាយ​ផ្សេងៗ
        <small>
            <i class="icon-double-angle-right"></i>
            	បង្ហាញ​​របាយ​ការណ៍​នៃ​ការ​ចំ​ណាយ​​
        </small>
    </h1>
    <?php
	if($this->session->flashdata('msg_success')){
	?>
	<div class="msg_success">
		<?php echo '<p>' . $this -> session -> flashdata('msg_success') . '</p>'; ?>
	</div>
	<?php
		}
		if($this->session->flashdata('msg_error')){
	?>
	<div class="msg_error">
		<?php echo '<p>' . $this -> session -> flashdata('msg_error') . '</p>'; ?>
	</div>
	<?php
	}
	if($this->session->flashdata('msg_info')){
	?>
	<div class="msg_info">
		<?php echo '<p>' . $this -> session -> flashdata('msg_info') . '</p>'; ?>
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
                    <th class="sorting_disabled">
                        <label>
                            <input type="checkbox" class="ace">
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th class="sorting_asc">លរ</th>
                    <th>ថ្ងៃ​ខែ​បង្កើត</th>
                    <th class="sorting">ឈ្មោះ​​ការ​ចំ​ណាយ</th>
                    <th class="sorting">ចំ​នួន​</th>
                    <th class="sorting_disabled">បាន​បង់​ប្រាក់?</th>
                    <th class="sorting_disabled">ស្ថាន​ភាព</th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php
                if ($data->num_rows()) {
                	$i = 1;
                	$total_not_paid = 0;
                	$total_paid = 0;
                    foreach ($data->result_array() as $row) {
                    	if($row['isPaid'] == 1){
                    		$total_paid += $row['amount'];
                    	}else{
                    		$total_not_paid += $row['amount'];
                    	}
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
							<td><?php echo $i++; ?></td>
							<td class=" "><?php echo $row['dateCreated']; ?></td>
                            <td class=" "><?php echo $row['title']; ?></td>
                            <td class=" "><?php echo formatMoney($row['amount'], 2); ?>៛</td>
                            <td class=" "><input name="is_paid" <?php echo ($row['isPaid'])?'checked':''; ?> type="checkbox" placeholder="Is Paid?" class="ace ace-switch ace-switch-7 is_paid" /><span class="lbl"></span></td>
                            <td class=" "><input data-user="<?php echo json_encode(array('data' => $row)); ?>" name="<?php echo 'status'; ?>" <?php echo ($row['status'])?'checked':''; ?> type="checkbox" id="<?php echo 'status'; ?>" placeholder="Status" class="ace ace-switch ace-switch-7" /><span class="lbl"></span></td>
                        </tr>

                        <?php
						}
				}
                ?>
					
            </tbody>            
        </table>
        <table class="table table-striped table-bordered table-hover">
        	<tr>
					<th style="text-align: right; width: 150px;">សរុប បាន​បង់</th>
					<th><?php echo formatMoney($total_paid, 2); ?>៛</th>
				</tr>
				<tr>
					<th style="text-align: right;">សរុប មិន​ទាន់​បាន​បង់</th>
					<th><?php echo formatMoney($total_not_paid, 2); ?>៛</th>
				</tr>
				<tr>
					<th style="text-align: right;">សរុប</th>
					<th><?php echo formatMoney($total_paid + $total_not_paid, 2); ?>៛</th>
				</tr>
        </table>
    </div>
</div>
<script src="<?php echo site_url(JS . 'jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo site_url(JS . 'jquery.dataTables.bootstrap.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.is_paid').click(function() {
			alert('Option not yet available');
			return false;
		});
		$('.msg_success, .msg_error, .msg_info').click(function() {
			$(this).fadeOut();
		});
		// Register
		var uri = [$('[name="base_url"]').val(), $('[name="segment1"]').val(), $('[name="segment2"]').val()];

		// action ajax
		$('.ajax').on('click', function() {
			var user = $(this).data('user');
			console.log(user)
			$('.message').html('');
			$.ajax({
				type : "POST",
				url : this.href,
				data : user
			}).done(function(data) {
				content_loader(data);
			});
			return false;
		});

		// Delete
		$(".delete").on('click', function() {
			var url = this.href;
			var parent = $(this).parent().parent().parent();
			bootbox.alert('ប្រព័ន្ធ​មិន​អនុញ្ញាត​អោយ​លុប​ទិន្ន័យ​​ទេ។ អ្នក​អាច​ប្តូរ​ ស្ថាន​ភាព ជំនួស​អោយ​ការ​លុប​បាន។');
			return false;
		});
	}); 
</script>
<script type="text/javascript">
	jQuery(function($) {
		$('table th input:checkbox').on('click', function() {
			var that = this;
			$(this).closest('table').find('tr > td:first-child input:checkbox').each(function() {
				this.checked = that.checked;
				$(this).closest('tr').toggleClass('selected');
			});

		});

		$('[data-rel="tooltip"]').tooltip({
			placement : tooltip_placement
		});
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
<script src="<?php echo base_url() . JS; ?>data.table.js"></script>