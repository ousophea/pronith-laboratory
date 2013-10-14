CREATE VIEW `vie_patients_tests_results_inputs` AS
SELECT CONCAT(tbl_ills_groups.ill_gro_name, ' ', tbl_ills_groups.ill_gro_nameKh ) AS groups_name, 
	CONCAT(tbl_ills.ill_name, ' ', tbl_ills.ill_nameKh ) AS ills_name,
	tbl_ills_items.*,
	tbl_patients_tests.pat_tes_id
FROM tbl_ills_items
INNER JOIN tbl_ills ON tbl_ills_items.ill_ite_ill_id=tbl_ills.ill_id
INNER JOIN tbl_ills_groups ON tbl_ills.ill_ill_gro_id=tbl_ills_groups.ill_gro_id
INNER JOIN tbl_patients_tests_has_tbl_ills ON tbl_ills.ill_id=tbl_patients_tests_has_tbl_ills.ill_id
INNER JOIN tbl_patients_tests ON tbl_patients_tests_has_tbl_ills.pat_tes_id=tbl_patients_tests.pat_tes_id
WHERE tbl_ills_items.ill_ite_status=1
ORDER BY groups_name asc, ills_name asc