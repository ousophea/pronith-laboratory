create view `vie_patients_tests_ills_onlys` as
select CONCAT(tbl_ills_groups.ill_gro_name, ' ', tbl_ills_groups.ill_gro_nameKh ) AS groups_name, 
	CONCAT(tbl_ills.ill_name, ' ', tbl_ills.ill_nameKh ) AS ills_name,
	tbl_ills.ill_id as ill_id,
	tbl_patients_tests.*
from tbl_patients_tests
left join tbl_patients_tests_has_tbl_ills on tbl_patients_tests.pat_tes_id = tbl_patients_tests_has_tbl_ills.pat_tes_id
left join tbl_ills on tbl_patients_tests_has_tbl_ills.ill_id = tbl_ills.ill_id
left join tbl_ills_groups on tbl_ills.ill_ill_gro_id = tbl_ills_groups.ill_gro_id
left join tbl_ills_items on tbl_ills.ill_id = tbl_ills_items.ill_ite_ill_id
where tbl_ills.ill_id not in
(
    select tbl_ills.ill_id as ill_id
    from tbl_patients_tests
    inner join tbl_patients_tests_has_tbl_ills on tbl_patients_tests.pat_tes_id = tbl_patients_tests_has_tbl_ills.pat_tes_id
    inner join tbl_ills on tbl_patients_tests_has_tbl_ills.ill_id = tbl_ills.ill_id    
    inner join tbl_ills_items on tbl_ills.ill_id = tbl_ills_items.ill_ite_ill_id
)