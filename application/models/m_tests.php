<?php

/**
 * Global model for using in this application
 * @package Model
 * @author PEN Vannak
 * @version 1.0
 */
if (!defined('BASEPATH'))
    exit('Permission Denied!');

class m_tests extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
	//return as array
	function ill_lists(){
		$arr_ills = array();
		$this->db->where('ill_gro_status',1);
		$query_groups = $this->db->get(TBL_PREFEX.'ills_groups');
		if($query_groups->num_rows() > 0){
			foreach($query_groups->result() as $rows_groups){
				$this->db->where('ill_status',1);
				$this->db->where('ill_ill_gro_id',$rows_groups->ill_gro_id);
				$query_ills = $this->db->get(TBL_PREFEX.'ills');
				if($query_ills->num_rows() > 0){
					$arr_ills[$rows_groups->ill_gro_name] = array();
					foreach($query_ills->result() as $rows_ills){
						$arr_ills[$rows_groups->ill_gro_name][$rows_ills->ill_id] = $rows_ills->ill_name.(($rows_ills->ill_nameKh == '')?'':' ('.$rows_ills->ill_nameKh.')').' - '.number_format($rows_ills->ill_price,0).'៛';
					}
				}
			}
		}
		return $arr_ills;
	}
	
	//return as array
	function ill_selected_lists($arr_selected_ills){
		$arr_ills = array();
		$this->db->where('ill_gro_status',1);
		$query_groups = $this->db->get(TBL_PREFEX.'ills_groups');
		if($query_groups->num_rows() > 0){
			foreach($query_groups->result() as $rows_groups){
				$this->db->where('ill_status',1);
				$this->db->where('ill_ill_gro_id',$rows_groups->ill_gro_id);
				$this->db->where_in('ill_id',$arr_selected_ills);
				$query_ills = $this->db->get(TBL_PREFEX.'ills');
				if($query_ills->num_rows() > 0){
					$arr_ills[$rows_groups->ill_gro_name] = array();
					foreach($query_ills->result() as $rows_ills){
						$arr_ills[$rows_groups->ill_gro_name][$rows_ills->ill_name.(($rows_ills->ill_nameKh == '')?'':' ('.$rows_ills->ill_nameKh.')')] = $rows_ills->ill_price;
					}
				}
			}
		}
		return $arr_ills;
	}
	
	//select ill item
	function ill_item_selected_lists($arr_selected_ill_items){
		$arr_ills = array();
		$this->db->where('ill_gro_status',1);
		$query_groups = $this->db->get(TBL_PREFEX.'ills_groups');
		if($query_groups->num_rows() > 0){
			foreach($query_groups->result() as $rows_groups){
				$this->db->where('ill_status',1);
				$this->db->where('ill_ill_gro_id',$rows_groups->ill_gro_id);
				//$this->db->where_in('ill_id',$arr_selected_ill_items);
				$query_ills = $this->db->get(TBL_PREFEX.'ills');
				if($query_ills->num_rows() > 0){
					foreach ($query_ills->result() as $rows_ills) {
						
						$this->db->where('ill_ite_status',1);
						$this->db->where('ill_ite_ill_id',$rows_ills->ill_id);
						//$this->db->where_in('ill_ite_id',$arr_selected_ill_items);
						$query_ills_items = $this->db->get(TBL_PREFEX.'ills_items');
						if($query_ills_items->num_rows() > 0){
							$arr_ills[$rows_groups->ill_gro_name] = array();
							foreach ($query_ills_items->result() as $rows_items) {
								$arr_ills[$rows_groups->ill_gro_name.(($rows_groups->ill_gro_nameKh != '')?' ('.$rows_groups->ill_gro_nameKh.')':'')][$rows_ills->ill_name.(($rows_ills->ill_nameKh !='')?' ('.$rows_ills->ill_nameKh.')':'')] = $rows_items; 
							}
						}
					}
					//$arr_ills[$rows_groups->ill_gro_name] = array();
					//foreach($query_ills->result() as $rows_ills){
					//	$arr_ills[$rows_groups->ill_gro_name][$rows_ills->ill_name.(($rows_ills->ill_nameKh == '')?'':' ('.$rows_ills->ill_nameKh.')')] = $rows_ills->ill_price;
					//}
				}
			}
		}
		return $arr_ills;
	}
	
	public function tests_results($pat_tes_id=0){
		$this->db->select("concat(tbl_ills_groups.ill_gro_name, ' ', tbl_ills_groups.ill_gro_nameKh ) AS groups_name, concat(tbl_ills.ill_name, ' ', tbl_ills.ill_nameKh ) AS ills_name, tbl_ills_items.*, tbl_patients_tests_results.*");
		$this->db->join(TBL_PREFEX.'ills_items',TBL_PREFEX.'patients_tests_results.pat_tes_res_ill_ite_id='.TBL_PREFEX.'ills_items.ill_ite_id','inner');
		$this->db->join(TBL_PREFEX.'ills',TBL_PREFEX.'ills_items.ill_ite_ill_id='.TBL_PREFEX.'ills.ill_id','inner');
		$this->db->join(TBL_PREFEX.'ills_groups',TBL_PREFEX.'ills.ill_ill_gro_id='.TBL_PREFEX.'ills_groups.ill_gro_id','inner');
		$this->db->where(TBL_PREFEX.'patients_tests_results.pat_tes_res_pat_tes_id',$pat_tes_id);
		$this->db->order_by('groups_name asc,ills_name asc');
		return $this->db->get(TBL_PREFEX.'patients_tests_results');
	}
	
}
?>