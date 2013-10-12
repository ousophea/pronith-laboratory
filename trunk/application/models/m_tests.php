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
						$arr_ills[$rows_groups->ill_gro_name][$rows_ills->ill_id] = $rows_ills->ill_name.(($rows_ills->ill_nameEn == '')?'':'('.$rows_ills->ill_nameEn.')').' - '.number_format($rows_ills->ill_price,0).'៛';
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
						$arr_ills[$rows_groups->ill_gro_name][$rows_ills->ill_name.(($rows_ills->ill_nameEn == '')?'':'('.$rows_ills->ill_nameEn.')')] = $rows_ills->ill_price;
					}
				}
			}
		}
		return $arr_ills;
	}
	
}
?>