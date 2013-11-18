create view `vie_patients_tests_results_views_ills_items_subs` as 
SELECT CONCAT(tbl_ills_groups.ill_gro_name, ' ', tbl_ills_groups.ill_gro_nameKh ) AS groups_name, 
	CONCAT(tbl_ills.ill_name, ' ', tbl_ills.ill_nameKh ) AS ills_name,
	CONCAT(tbl_ills_items_parents.ill_ite_name , ' ' ,tbl_ills_items_parents.ill_ite_nameKh) AS ills_items_parents_name,
	CONCAT(tbl_ills_items.ill_ite_name , ' ' ,tbl_ills_items.ill_ite_nameKh) AS ills_items_name,
	tbl_ills_items.ill_ite_dimention,
	tbl_ills_items.ill_ite_value_male,
	tbl_ills_items.ill_ite_value_female,
	tbl_ills_items.ill_ite_id,
	tbl_patients_tests_results.*,
	tbl_patients_tests.pat_tes_id
FROM tbl_patients_tests_results
inner join tbl_ills_items on tbl_patients_tests_results.pat_tes_res_ill_ite_id = tbl_ills_items.ill_ite_id
inner join tbl_ills_items as tbl_ills_items_parents on tbl_ills_items.ill_ite_parentId = tbl_ills_items_parents.ill_ite_id
INNER JOIN tbl_ills ON tbl_ills_items.ill_ite_ill_id=tbl_ills.ill_id
INNER JOIN tbl_ills_groups ON tbl_ills.ill_ill_gro_id=tbl_ills_groups.ill_gro_id
INNER JOIN tbl_patients_tests_has_tbl_ills ON tbl_ills.ill_id=tbl_patients_tests_has_tbl_ills.ill_id
INNER JOIN tbl_patients_tests ON tbl_patients_tests_has_tbl_ills.pat_tes_id=tbl_patients_tests.pat_tes_id
WHERE tbl_ills_items.ill_ite_status=1 
	and tbl_ills_items.ill_ite_parentId != 0
	and tbl_patients_tests_results.pat_tes_res_ill_id is null
ORDER BY groups_name asc, ills_name asc