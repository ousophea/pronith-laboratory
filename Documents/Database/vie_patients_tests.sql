create view `vie_patients_tests` as 
SELECT t.*,concat(p.pat_firstName,' ',p.pat_lastName) as pat_name, concat(u.use_firstName,' ',u.use_lastName) as use_name FROM `tbl_patients_tests` as t
inner join `tbl_patients` as p on t.pat_tes_pat_id=p.pat_id
inner join `tbl_users` as u on t.pat_tes_use_id=u.use_id