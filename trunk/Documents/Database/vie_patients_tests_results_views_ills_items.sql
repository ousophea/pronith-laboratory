create view `vie_patients_tests_results_views_ills_items` as
SELECT CONCAT(tbl_ills_groups.ill_gro_name, ' ', tbl_ills_groups.ill_gro_nameKh ) AS groups_name, 
	CONCAT(tbl_ills.ill_name, ' ', tbl_ills.ill_nameKh ) AS ills_name,
	CONCAT(tbl_ills_items.ill_ite_name, ' ', tbl_ills_items.ill_ite_nameKh) as ills_items_name,
	tbl_ills_items.ill_ite_dimention,
	tbl_ills_items.ill_ite_value_male,
	tbl_ills_items.ill_ite_value_female,
	tbl_patients_tests_results.*,
	tbl_patients_tests.pat_tes_id
FROM tbl_patients_tests_results
INNER JOIN tbl_ills_items on tbl_patients_tests_results.pat_tes_res_ill_ite_id = tbl_ills_items.ill_ite_id
INNER JOIN tbl_ills ON tbl_ills_items.ill_ite_ill_id=tbl_ills.ill_id
INNER JOIN tbl_ills_groups ON tbl_ills.ill_ill_gro_id=tbl_ills_groups.ill_gro_id
INNER JOIN tbl_patients_tests ON tbl_patients_tests_results.pat_tes_res_pat_tes_id=tbl_patients_tests.pat_tes_id
WHERE tbl_ills_items.ill_ite_parentId = 0
	and tbl_patients_tests_results.pat_tes_res_ill_id is null
	and tbl_ills_items.ill_ite_id not in (
        SELECT t1.ill_ite_id FROM tbl_ills_items as t1
		inner join tbl_ills_items as t2 on t1.ill_ite_id=t2.ill_ite_parentId
		group by t1.ill_ite_id
    )
ORDER BY groups_name asc, ills_name asc