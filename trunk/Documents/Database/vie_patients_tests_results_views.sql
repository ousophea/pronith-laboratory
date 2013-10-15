create view `vie_patients_tests_results_views` AS
SELECT concat(tbl_ills_groups.ill_gro_name, ' ', tbl_ills_groups.ill_gro_nameKh ) AS groups_name, 
	concat(tbl_ills.ill_name, ' ', tbl_ills.ill_nameKh ) AS ills_name, 
	tbl_ills_items.*, 
	tbl_patients_tests_results.*,
	tbl_ills_items_dimentions.*
FROM tbl_patients_tests_results
INNER JOIN tbl_ills_items ON tbl_patients_tests_results.pat_tes_res_ill_ite_id=tbl_ills_items.ill_ite_id 
INNER JOIN tbl_ills_items_dimentions on tbl_ills_items.ill_ite_ill_ite_dim_id=tbl_ills_items_dimentions.ill_ite_dim_id
INNER JOIN tbl_ills ON tbl_ills_items.ill_ite_ill_id=tbl_ills.ill_id 
INNER JOIN tbl_ills_groups ON tbl_ills.ill_ill_gro_id=tbl_ills_groups.ill_gro_id 
WHERE tbl_ills_items.ill_ite_status = 1
ORDER BY groups_name asc, ills_name asc