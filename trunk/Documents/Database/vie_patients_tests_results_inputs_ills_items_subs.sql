create view `vie_patients_tests_results_inputs_ills_items_subs` as 
SELECT CONCAT(tbl_ills_groups.ill_gro_name, ' ', tbl_ills_groups.ill_gro_nameKh ) AS groups_name, 
	CONCAT(tbl_ills.ill_name, ' ', tbl_ills.ill_nameKh ) AS ills_name,
	tbl_ills_items.ill_ite_name as ill_ite_name_parent,
	tbl_ills_items.ill_ite_nameKh as ill_ite_name_parentKh,
	item1.*,
	tbl_patients_tests.pat_tes_id
FROM tbl_ills_items
inner join tbl_ills_items as item1 on tbl_ills_items.ill_ite_id = item1.ill_ite_parentId
INNER JOIN tbl_ills ON tbl_ills_items.ill_ite_ill_id=tbl_ills.ill_id
INNER JOIN tbl_ills_groups ON tbl_ills.ill_ill_gro_id=tbl_ills_groups.ill_gro_id
INNER JOIN tbl_patients_tests_has_tbl_ills ON tbl_ills.ill_id=tbl_patients_tests_has_tbl_ills.ill_id
INNER JOIN tbl_patients_tests ON tbl_patients_tests_has_tbl_ills.pat_tes_id=tbl_patients_tests.pat_tes_id
WHERE tbl_ills_items.ill_ite_status=1 
	and tbl_ills_items.ill_ite_parentId=0 
	and tbl_ills_items.ill_ite_id in (
        SELECT t1.ill_ite_id FROM `tbl_ills_items` as t1
		inner join tbl_ills_items as t2 on t1.ill_ite_id=t2.ill_ite_parentId
		group by t1.ill_ite_id
    )
ORDER BY groups_name asc, ills_name asc