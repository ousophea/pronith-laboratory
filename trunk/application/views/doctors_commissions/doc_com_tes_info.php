            <div class="control-group">
				<table class="table table-bordered" style="border-bottom: 0px;">
					<tr class="success">
                                                <th class="success">លរ</th>
						<th class="success">ឈ្មោះអ្នក​ជំ​ងឺ</th>
                                                <th class="success">ថ្ងៃ​ខែ​ធ្វើតេស្ថ</th>
						<th class="success">កំរៃ​ជើងសារ (៛)</th>	
					</tr>
					<?php
					$total_price = 0;
					$no = 1;
					if( $doc_com_data->num_rows() > 0){
						foreach ($doc_com_data->result_array() as $row) {
//							foreach($arr_values as $keys=>$values){
								$total_price += $row[DOCCOMM_AMMOUNT];
					?>
					<tr>
						<td style="<?php echo (($no == 1)?'border-bottom:0px;':'border-bottom:0px;border-top:0px;');?>"><?php echo $no; ?></td>
						<td style="<?php echo ($no == 1)?'border-bottom:0px;':'border-bottom:0px;border-top:0px;';?>"><?php echo $row[PARTIENT_FNAME].' '.$row[PARTIENT_LNAME]; ?></td>
                                                <td style="<?php echo ($no == 1)?'border-bottom:0px;':'border-bottom:0px;border-top:0px;';?>"><?php echo $row[PARTIENTSTEST_DATE]?></td>
						<td class="ali_right" style="<?php echo ($no == 1)?'border-bottom:0px;':'border-bottom:0px;border-top:0px;';?>"><?php echo formatMoney($row[DOCCOMM_AMMOUNT],TRUE,"៛"); ?></td>
					</tr>
					<?php
								$no++;
							}
//						}
					}
					?>
					<tr class="sub_total_price">
						<td style="border-left: 0px solid; border-bottom: 0px solid; border-right: 0px solid;">&nbsp;</td>
						<td style="border-left: 0px solid; border-bottom: 0px solid; border-right: 0px solid;">&nbsp;</td>
                                                <td class="ali_right" style="border-left: 0px solid; border-bottom: 0px solid;">សរុប (៛)</td>
						<td class="ali_right" style="border-bottom: 0px solid;"><b><?php echo formatMoney($total_price,TRUE,'៛'); ?></b></td>
					</tr>
					
					
				</table>
				<?php
				if($this->session->userdata('txt_isPaid') == 1){
				?>
				<div><p>*សំគាល់៖ វិក័យ​ប័ត្រ​ ត្រូវ​បាន​បង់​ប្រាក់​គ្រប់</p></div>
				<?php
				}
				?>
            </div>
           