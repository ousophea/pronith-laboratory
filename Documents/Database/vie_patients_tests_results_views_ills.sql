create view `vie_patients_tests_results_views_ills` as
select CONCAT(tbl_ills_groups.ill_gro_name, ' ', tbl_ills_groups.ill_gro_nameKh ) AS groups_name, 
	CONCAT(tbl_ills.ill_name, ' ', tbl_ills.ill_nameKh ) AS ills_name,
	tbl_ills.ill_id as ill_id,
	tbl_patients_tests_results.*,
	tbl_patients_tests.pat_tes_id
from tbl_patients_tests_results
inner join tbl_ills on tbl_patients_tests_results.pat_tes_res_ill_id = tbl_ills.ill_id
inner join tbl_ills_groups on tbl_ills.ill_ill_gro_id = tbl_ills_groups.ill_gro_id
inner join tbl_patients_tests on tbl_patients_tests_results.pat_tes_res_pat_tes_id=tbl_patients_tests.pat_tes_id
where tbl_patients_tests_results.pat_tes_res_ill_ite_id is null
ORDER BY groups_name asc, ills_name asc