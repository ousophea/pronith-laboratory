<?php
$doctors_array[''] = '-- Select --';
foreach ($doctors->result_array() as $value) {
    $doctors_array[$value[DOC_ID]] = $value[DOC_LNAME] . ' ' . $value[DOC_FNAME];
}
$ills_array[''] = '-- Select --';
foreach ($ills->result_array() as $value) {
    $ills_array[$value[ILL_ID]] = $value[ILL_NAME] . ' ' . $value[ILL_NAMEKH];
}
?>
<div class="page-header position-relative">
    <h1>
        របាយការណ៍អ្នកជម្ងឺ
        <small>
            <i class="icon-double-angle-right"></i>
            តារាងបង្ហាញអំពីរបាយការណ៍អ្នកជម្ងឺ
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">
        <div>
        <form method="POST" action="<?php echo base_url(); ?>reports/patient">
                
                <label for="date" >ចណ្លោះថ្ងៃទី: <input type="text" name="date" value="<?php echo set_value('date'); ?>" class="date-range-picker" id="date" />
                <span class="input-group-addon">
                    <i class="icon-calendar bigger-110"></i>
                </span>
                </label>
                <label>
                    វេជ្ជបណ្ឌិត: <?php echo form_dropdown('pat_doc_id', $doctors_array, set_value('pat_doc_id')) ?>
                </label>
                <label>
                    ជម្ងឺ: <?php echo form_dropdown(ILL_ID, $ills_array, set_value(ILL_ID)) ?>
                </label>
                <input type="submit" value="Filter" class="btn btn-primary"/>
            </form>    
        <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable" aria-describedby="sample-table-2_info">
            <thead>
                <tr role="row">
                    <th class="center sorting_disabled">Nº</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending"">គោត្តនាម</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending">នាម</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending">ភេទ</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending">លេខ​ទូរស័ព្ទ</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending">លេខ​អត្តសញ្ញាណប័ណ្ណ</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending">អ៊ី​ម៉ែល</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending">ណែ​នាំ​ពី​វេជ្ជ​បណ្ឌិត</th>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

                <?php
                if ($data->num_rows()) {
                    $i = 1;
                    foreach ($data->result_array() as $row) {
                        //unset($row[USE_PASSWORD]); // remove password
                        ?>

                        <tr class="odd">
                            <td class="center"><?php echo $i++; ?></td>
                            <td class=" "><?php echo $row['pat_firstName']; ?></td>
                            <td class=" "><?php echo $row['pat_lastName']; ?></td>
                            <td class=" "><?php echo (strtolower($row['pat_sex']) == 'm')?'ប្រុស':'ស្រី'; ?></td>
                            <td class=" "><?php echo ($row['pat_pho_number'] != NULL)?$row['pat_pho_number'].'<span id="patient_phone" rel='.$row['pat_id'].'>...</span>':''; ?></td>
                            <td class=" "><?php echo $row['pat_identityCard']; ?></td>
                            <td class=" "><?php echo $row['pat_email']; ?></td>
                            <td class=" "><?php echo $row[DOC_LNAME].' '. $row[DOC_FNAME]; ?></td>
                        </tr>

                        <?php
                    }
                }
                ?>

            </tbody>
        </table>
        
        </div>
    </div>
</div>
<script src="<?php echo base_url() . JS; ?>data.table.js"></script>
<script src="<?php echo base_url() . JS; ?>daterangepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[name="date"]').daterangepicker({
            format: 'YYYY-MM-DD',
            separator:' to ',
            timePicker:true,
            showDropdowns:true,
            showWeekNumbers:true
        });

    });
</script>
